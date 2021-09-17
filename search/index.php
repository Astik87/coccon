<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");
?>

<? $APPLICATION->IncludeComponent(
	"bitrix:search.page", 
	"search", 
	array(
		"RESTART" => "N",
		"CHECK_DATES" => "N",
		"USE_TITLE_RANK" => "N",
		"DEFAULT_SORT" => "rank",
		"arrFILTER" => array(
			0 => "no",
			1 => "iblock_catalog",
		),
		"arrFILTER_main" => "",
		"arrFILTER_iblock_services" => array(
			0 => "all",
		),
		"arrFILTER_iblock_news" => array(
			0 => "all",
		),
		"arrFILTER_iblock_catalog" => array(
			0 => "2",
		),
		"SHOW_WHERE" => "N",
		"SHOW_WHEN" => "N",
		"PAGE_RESULT_COUNT" => "25",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Результаты поиска",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "arrows",
		"USE_SUGGEST" => "N",
		"SHOW_ITEM_TAGS" => "N",
		"SHOW_ITEM_DATE_CHANGE" => "N",
		"SHOW_ORDER_BY" => "N",
		"SHOW_TAGS_CLOUD" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "search",
		"NO_WORD_LOGIC" => "N",
		"FILTER_NAME" => "",
		"USE_LANGUAGE_GUESS" => "Y",
		"SHOW_RATING" => "",
		"RATING_TYPE" => "",
		"PATH_TO_USER_PROFILE" => "",
		"arrFILTER_forum" => array(
			0 => "all",
		),
		"arrFILTER_iblock_offers" => array(
			0 => "all",
		),
		"arrFILTER_iblock_references" => array(
			0 => "all",
		),
		"arrFILTER_iblock_COMMENTS" => array(
			0 => "all",
		),
		"arrFILTER_iblock_lookbook" => array(
			0 => "all",
		),
		"arrFILTER_iblock_site_data" => array(
			0 => "all",
		),
		"arrFILTER_iblock_size_table" => array(
			0 => "all",
		),
		"arrFILTER_iblock_main_slider" => array(
			0 => "all",
		),
		"arrFILTER_iblock_rest_entity" => array(
			0 => "all",
		),
		"arrFILTER_blog" => array(
			0 => "all",
		)
	),
	false
); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>