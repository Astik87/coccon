<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Склады");
?><? $APPLICATION->IncludeComponent(
		"bitrix:catalog.store",
		"bootstrap_v4",
		array(
			"SEF_MODE" => "Y",
			"PHONE" => "N",
			"SCHEDULE" => "N",
			"SET_TITLE" => "Y",
			"TITLE" => "Список складов с подробной информацией",
			"MAP_TYPE" => "0",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "3600",
			"CACHE_NOTES" => "",
			"SEF_FOLDER" => "/store/",
			"SEF_URL_TEMPLATES" => array(
				"liststores" => "index.php",
				"element" => "#store_id#"
			),
			"VARIABLE_ALIASES" => array(
				"liststores" => array(),
				"element" => array(),
			)
		),
		false
	); ?> <? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>