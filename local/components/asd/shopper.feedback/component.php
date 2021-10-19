<?php
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
 
$strFilesName = $_FILES["profile"]["name"];
$strContent = file_get_contents($_FILES["profile"]["tmp_name"]);
// $strHeader .= "--".$strSid."\n";  
// $strHeader .= "Content-Type: application/octet-stream; name='".$strFilesName."'\n";
// $strHeader .= "Content-Transfer-Encoding: base64\n";
// $strHeader .= "Content-Disposition: attachment; filename='".$strFilesName."'\n\n";  
// $strHeader .= $strContent."\n\n";

$res = [
	'result' => false
];

$arResult["PARAMS_HASH"] = md5(serialize($arParams).$this->GetTemplateName());

$arParams["USE_CAPTCHA"] = (($arParams["USE_CAPTCHA"] != "N" && !$USER->IsAuthorized()) ? "Y" : "N");
$arParams["EVENT_NAME"] = trim($arParams["EVENT_NAME"]);
if($arParams["EVENT_NAME"] == '')
	$arParams["EVENT_NAME"] = "FEEDBACK_FORM";
$arParams["EMAIL_TO"] = trim($arParams["EMAIL_TO"]);
if($arParams["EMAIL_TO"] == '')
	$arParams["EMAIL_TO"] = COption::GetOptionString("main", "email_from");
$arParams["OK_TEXT"] = trim($arParams["OK_TEXT"]);
if($arParams["OK_TEXT"] == '')
	$arParams["OK_TEXT"] = GetMessage("MF_OK_MESSAGE");

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] <> '' && (!isset($_POST["PARAMS_HASH"]) || $arResult["PARAMS_HASH"] === $_POST["PARAMS_HASH"]))
{
	$arResult["ERROR_MESSAGE"] = array();
	if(check_bitrix_sessid())
	{
		if(empty($arParams["REQUIRED_FIELDS"]) || !in_array("NONE", $arParams["REQUIRED_FIELDS"]))
		{
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])) && mb_strlen($_POST["user_name"]) <= 1)
				$arResult["ERROR_MESSAGE"]["user_name"] = GetMessage("MF_REQ_NAME");		
			if((empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])) && mb_strlen($_POST["user_email"]) <= 1)
				$arResult["ERROR_MESSAGE"]["user_email"] = GetMessage("MF_REQ_EMAIL");
			if(mb_strlen(str_replace('_', '', $_POST["user_phone"])) != 16)
				$arResult["ERROR_MESSAGE"]["user_phone"] = "Некорректный номер телефона";
			if(mb_strlen($_POST["activity"]) <= 0)
				$arResult["ERROR_MESSAGE"]["activity"] = "Не указан род деятельности";
				if(mb_strlen($_POST["channel"]) <= 0)
					$arResult["ERROR_MESSAGE"]["channel"] = "Не указан канал продаж";
					if(mb_strlen($_POST["website"]) <= 0)
						$arResult["ERROR_MESSAGE"]["website"] = "Не указан адрес сайта";
						if(mb_strlen($_POST["instagram"]) <= 0)
						$arResult["ERROR_MESSAGE"]["instagram"] = "Не указан адрес инстаграм аккаунта";
					}
		if(mb_strlen($_POST["user_email"]) > 1 && !check_email($_POST["user_email"]))
			$arResult["ERROR_MESSAGE"][] = GetMessage("MF_EMAIL_NOT_VALID");
		if($arParams["USE_CAPTCHA"] == "Y")
		{
			$captcha_code = $_POST["captcha_sid"];
			$captcha_word = $_POST["captcha_word"];
			$cpt = new CCaptcha();
			$captchaPass = COption::GetOptionString("main", "captcha_password", "");
			if ($captcha_word <> '' && $captcha_code <> '')
			{
				if (!$cpt->CheckCodeCrypt($captcha_word, $captcha_code, $captchaPass))
					$arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTCHA_WRONG");
			}
			else
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTHCA_EMPTY");

		}
		if(empty($arResult["ERROR_MESSAGE"]))
		{
			$arFields = Array(
				"AUTHOR" => $_POST["user_name"],
				"ACTIVITY" => $_POST["activity"],
				"CHANNEL" => $_POST["channel"],
				"WEBSITE" => $_POST["website"],
				"INSTAGRAM" => $_POST["instagram"],
				"OFFLINE" => $_POST["offline"],
				"PHONE" => $_POST["user_phone"],
				"USEREMAIL" => $_POST["user_email"],
				"EMAIL_TO" => $arParams["EMAIL_TO"],
				"TEXT" => $_POST["MESSAGE"],
			);

			if(!empty($arParams["EVENT_MESSAGE_ID"]))
			{
				foreach($arParams["EVENT_MESSAGE_ID"] as $v)
					if(intval($v) > 0){
						CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields, "N", intval($v));
					}
			}
			else
				CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields);
			$_SESSION["MF_NAME"] = htmlspecialcharsbx($_POST["user_name"]);
			$_SESSION["MF_EMAIL"] = htmlspecialcharsbx($_POST["user_email"]);
			// LocalRedirect($APPLICATION->GetCurPageParam("success=".$arResult["PARAMS_HASH"], Array("success")));
			$res['result'] = true;
		}
		
		$arResult["MESSAGE"] = htmlspecialcharsbx($_POST["MESSAGE"]);
		$arResult["AUTHOR_NAME"] = htmlspecialcharsbx($_POST["user_name"]);
		$arResult["AUTHOR_EMAIL"] = htmlspecialcharsbx($_POST["user_email"]);
	}
	else
		$arResult["ERROR_MESSAGE"][] = GetMessage("MF_SESS_EXP");
}
elseif($_REQUEST["success"] == $arResult["PARAMS_HASH"])
{
	$arResult["OK_MESSAGE"] = $arParams["OK_TEXT"];
}

if(empty($arResult["ERROR_MESSAGE"]))
{
	if($USER->IsAuthorized())
	{
		$arResult["AUTHOR_NAME"] = $USER->GetFormattedName(false);
		$arResult["AUTHOR_EMAIL"] = htmlspecialcharsbx($USER->GetEmail());
	}
	else
	{
		if($_SESSION["MF_NAME"] <> '')
			$arResult["AUTHOR_NAME"] = htmlspecialcharsbx($_SESSION["MF_NAME"]);
		if($_SESSION["MF_EMAIL"] <> '')
			$arResult["AUTHOR_EMAIL"] = htmlspecialcharsbx($_SESSION["MF_EMAIL"]);
	}
}

if($arParams["USE_CAPTCHA"] == "Y")
	$arResult["capCode"] =  htmlspecialcharsbx($APPLICATION->CaptchaGetCode());

$res['errors'] = $arResult["ERROR_MESSAGE"];

if (empty($_POST))
	$this->IncludeComponentTemplate();
else {

	if ($res['result']) {
		CModule::IncludeModule('iblock');

		$el = new CIBlockElement();
		$p = $el->Add([
			'MODIFIED_BY' => $USER->GetID(),
			'IBLOCK_SECTION_ID' => false,
			'IBLOCK_ID' => 13,
			'PROPERTY_VALUES' => $arFields,
			'NAME' => $_POST['user_name'],
			'ACTIVE' => 'Y',
	]);
	}

	echo json_encode($res);
}