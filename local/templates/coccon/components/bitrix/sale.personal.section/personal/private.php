<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

if (isset($_POST['date'])) {
	$date = implode('.', array_reverse(explode('-', $_POST['date'])));
	$USER->Update($USER->GetID(), ['PERSONAL_BIRTHDAY' => $date]);
}

if (isset($_POST['name'])) {
	$userData['NAME'] = explode(' ', $_POST['name'])[0];
	$userData['LAST_NAME'] = explode(' ', $_POST['name'])[1] ? explode(' ', $_POST['name'])[1] : '';
	$userData['SECOND_NAME'] = explode(' ', $_POST['name'])[2] ? explode(' ', $_POST['name'])[2] : '';
	$USER->Update($USER->GetID(), $userData);
}

$APPLICATION->AddChainItem('Личные данные', '/personal/');
?>
<?
if ($arParams['SHOW_PRIVATE_PAGE'] !== 'Y' && $arParams['USE_PRIVATE_PAGE_TO_AUTH'] !== 'Y') {
	LocalRedirect($arParams['SEF_FOLDER']);
}
// if ($arParams["MAIN_CHAIN_NAME"] <> '') {
// 	$APPLICATION->AddChainItem(htmlspecialcharsbx($arParams["MAIN_CHAIN_NAME"]), $arResult['SEF_FOLDER']);
// }
// $APPLICATION->AddChainItem(Loc::getMessage("SPS_CHAIN_PRIVATE"));
// if ($arParams['SET_TITLE'] == 'Y') {
// 	$APPLICATION->SetTitle(Loc::getMessage("SPS_TITLE_PRIVATE"));
// }
if (!$USER->IsAuthorized() || $arResult['SHOW_LOGIN_FORM'] === 'Y') {
	if ($arParams['USE_PRIVATE_PAGE_TO_AUTH'] !== 'Y') {
		ob_start();
		$APPLICATION->AuthForm('', false, false, 'N', false);
		$authForm = ob_get_clean();
	} else {
		if ($arResult['SHOW_FORGOT_PASSWORD_FORM'] === 'Y') {
			ob_start();
			$APPLICATION->IncludeComponent(
				'bitrix:main.auth.forgotpasswd',
				'.default',
				array(
					'AUTH_AUTH_URL' => $arResult['PATH_TO_PRIVATE'],
					//					'AUTH_REGISTER_URL' => 'register.php',
				),
				false
			);
			$authForm = ob_get_clean();
		} elseif ($arResult['SHOW_CHANGE_PASSWORD_FORM'] === 'Y') {
			ob_start();
			$APPLICATION->IncludeComponent(
				'bitrix:main.auth.changepasswd',
				'.default',
				array(
					'AUTH_AUTH_URL' => $arResult['PATH_TO_PRIVATE'],
					//					'AUTH_REGISTER_URL' => 'register.php',
				),
				false
			);
			$authForm = ob_get_clean();
		} else {
			ob_start();
			$APPLICATION->IncludeComponent(
				'bitrix:main.auth.form',
				'.default',
				array(
					'AUTH_FORGOT_PASSWORD_URL' => $arResult['PATH_TO_PASSWORD_RESTORE'],
					//					'AUTH_REGISTER_URL' => 'register.php',
					'AUTH_SUCCESS_URL' => $arResult['AUTH_SUCCESS_URL'],
					'DISABLE_SOCSERV_AUTH' => $arParams['DISABLE_SOCSERV_AUTH'],
				),
				false
			);
			$authForm = ob_get_clean();
		}
	}

?>
	<div class="row">
		<?
		if ($arParams['USE_PRIVATE_PAGE_TO_AUTH'] !== 'Y') {
		?>
			<div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">
				<div class="alert alert-danger"><?= GetMessage("SPS_ACCESS_DENIED") ?></div>
			</div>
		<?
		}
		?>
		<div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">
			<?= $authForm ?>
		</div>
	</div>
<?
} else {
	$APPLICATION->IncludeComponent(
		"bitrix:main.profile",
		"",
		array(
			"SET_TITLE" => $arParams["SET_TITLE"],
			"AJAX_MODE" => $arParams['AJAX_MODE_PRIVATE'],
			"SEND_INFO" => $arParams["SEND_INFO_PRIVATE"],
			"CHECK_RIGHTS" => $arParams['CHECK_RIGHTS_PRIVATE'],
			"EDITABLE_EXTERNAL_AUTH_ID" => $arParams['EDITABLE_EXTERNAL_AUTH_ID'],
			"DISABLE_SOCSERV_AUTH" => $arParams['DISABLE_SOCSERV_AUTH']
		),
		$component
	);
}
?>

<?

$rsUser = CUser::GetByID($USER->GetID());
$rsUser = $rsUser->Fetch();

?>
<div class="private-wrapper">
	<div class="pers-data">
		<a href="/personal?logout=Y" class="logout hover">Выход</a>
		<div class="ava" id="ava" style="background-image: url(<?= $USER->GetParam('PERSONAL_PHOTO') ? CFile::GetPath($USER->GetParam('PERSONAL_PHOTO')) : TEMPLATE_PATH . '/assets/img/ava.png' ?>);">
			<div class="hover" style="background-image: url(<?= TEMPLATE_PATH ?>/assets/img/ava_hover.png);">
			</div>
		</div>

		<div class="name">
			<?= $USER->GetFullName() ?>
		</div>
	</div>
	<form class="data-form" id="private-form" name="form1" action="/personal/private?login=yes" method="post" enctype="multipart/form-data" role="form">
		<input type="hidden" name="sessid" id="sessid" value="<?= bitrix_sessid() ?>">
		<input type="hidden" name="lang" value="s1">
		<input type="hidden" name="ID" value="<?= $USER->GetID() ?>">
		<input type="hidden" name="LOGIN" value="<?= $USER->GetLogin() ?>">
		<div class="item">
			<label for="">ФИО</label>
			<input name="name" type="text" value="<?= $USER->GetFullName() . " " . $rsUser['SECOND_NAME'] ?>">
		</div>
		
		<div class="item">
			<label for="">Телефон</label>
			<input name="PERSONAL_PHONE" type="tel" value="<?= $rsUser['PERSONAL_PHONE'] ?>">
		</div>
		
		<div class="item">
			<label for="">E-mail</label>
			<input name="EMAIL" type="email" value="<?= $USER->GetEmail() ?>">
		</div>

		<div class="item">
			<label for="">Дата рождения</label>
			<input type="date" name="date" value="<?= implode('-', array_reverse(explode('.', $rsUser['PERSONAL_BIRTHDAY']))) ?>">
		</div>

		<div class="item">
			<label for="">Пароль</label>
			<input name="NEW_PASSWORD" type="password">
		</div>


		<div class="item">
			<label for="">Повторите пароль</label>
			<input name="NEW_PASSWORD_CONFIRM" type="password">
		</div>

		<input type="file" name="PERSONAL_PHOTO" id="ava-input" class="hide-block">

		<div class="submit-wrap">
			<input type="submit" name="save" value="Сохранить изменения" class="btn submit">
		</div>
	</form>
</div>