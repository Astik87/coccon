<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Интернет-магазин \"Одежда\"");

$res = CIBlockElement::GetList(
	array(),
	array(
		"IBLOCK_ID" => 8,
	),
	false,
	false
);

$mailing = [];
while ($obj = $res->GetNextElement()) {
	$mailing['NAME'] = $obj->GetFields()["NAME"];
	$mailing['PREVIEW_TEXT'] = $obj->GetFields()["PREVIEW_TEXT"];
	$mailing['DETAIL_TEXT'] = $obj->GetFields()["DETAIL_TEXT"];
	$mailing['IMG'] = CFile::GetPath($obj->GetFields()["PREVIEW_PICTURE"]);
	break;
}

global $home_filter;

$home_filter = [
	'PROPERTY' => [
		'SHOW_MAIN_PAGE' => 1,
	]
];
?>

<? $APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"main_slider",
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "ID",
			1 => "CODE",
			2 => "XML_ID",
			3 => "NAME",
			4 => "TAGS",
			5 => "SORT",
			6 => "PREVIEW_TEXT",
			7 => "PREVIEW_PICTURE",
			8 => "DETAIL_TEXT",
			9 => "DETAIL_PICTURE",
			10 => "DATE_ACTIVE_FROM",
			11 => "ACTIVE_FROM",
			12 => "DATE_ACTIVE_TO",
			13 => "ACTIVE_TO",
			14 => "SHOW_COUNTER",
			15 => "SHOW_COUNTER_START",
			16 => "IBLOCK_TYPE_ID",
			17 => "IBLOCK_ID",
			18 => "IBLOCK_CODE",
			19 => "IBLOCK_NAME",
			20 => "IBLOCK_EXTERNAL_ID",
			21 => "DATE_CREATE",
			22 => "CREATED_BY",
			23 => "CREATED_USER_NAME",
			24 => "TIMESTAMP_X",
			25 => "MODIFIED_BY",
			26 => "USER_NAME",
			27 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "6",
		"IBLOCK_TYPE" => "main_slider",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "BTN_TEXT",
			1 => "LINK",
			2 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "main_slider"
	),
	false
); ?>

<section class="news">
	<div class="headding-wrap">
		<? $APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			array(
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "inc",
				"EDIT_TEMPLATE" => "",
				"PATH" => "include/main_page/news.php"
			)
		); ?>
	</div>

	<div class="container">

		<?

		$APPLICATION->IncludeComponent(
			"bitrix:catalog.section",
			"bootstrap_v4",
			array(
				"ACTION_VARIABLE" => "action",
				"ADD_PROPERTIES_TO_BASKET" => "Y",
				"ADD_SECTIONS_CHAIN" => "N",
				"ADD_TO_BASKET_ACTION" => "ADD",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"BACKGROUND_IMAGE" => "-",
				"BASKET_URL" => "/personal/basket.php",
				"BROWSER_TITLE" => "-",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"COMPATIBLE_MODE" => "Y",
				"CONVERT_CURRENCY" => "N",
				"DETAIL_URL" => "",
				"DISABLE_INIT_JS_IN_COMPONENT" => "N",
				"DISPLAY_BOTTOM_PAGER" => "N",
				"DISPLAY_COMPARE" => "N",
				"DISPLAY_TOP_PAGER" => "N",
				"ELEMENT_SORT_FIELD" => "sort",
				"ELEMENT_SORT_FIELD2" => "id",
				"ELEMENT_SORT_ORDER" => "asc",
				"ELEMENT_SORT_ORDER2" => "desc",
				"ENLARGE_PRODUCT" => "STRICT",
				"FILTER_NAME" => "home_filter",
				"HIDE_NOT_AVAILABLE" => "N",
				"HIDE_NOT_AVAILABLE_OFFERS" => "N",
				"IBLOCK_ID" => "2",
				"IBLOCK_TYPE" => "catalog",
				"INCLUDE_SUBSECTIONS" => "Y",
				"LAZY_LOAD" => "N",
				"LINE_ELEMENT_COUNT" => "3",
				"LOAD_ON_SCROLL" => "N",
				"MESSAGE_404" => "",
				"MESS_BTN_ADD_TO_BASKET" => "В корзину",
				"MESS_BTN_BUY" => "Купить",
				"MESS_BTN_DETAIL" => "Подробнее",
				"MESS_BTN_LAZY_LOAD" => "Показать ещё",
				"MESS_BTN_SUBSCRIBE" => "Подписаться",
				"MESS_NOT_AVAILABLE" => "Нет в наличии",
				"META_DESCRIPTION" => "-",
				"META_KEYWORDS" => "-",
				"OFFERS_LIMIT" => "5",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_TITLE" => "Товары",
				"PAGE_ELEMENT_COUNT" => "4",
				"PARTIAL_PRODUCT_PROPERTIES" => "N",
				"PRICE_CODE" => array(),
				"PRICE_VAT_INCLUDE" => "Y",
				"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
				"PRODUCT_ID_VARIABLE" => "id",
				"PRODUCT_PROPS_VARIABLE" => "prop",
				"PRODUCT_QUANTITY_VARIABLE" => "quantity",
				"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false}]",
				"PRODUCT_SUBSCRIPTION" => "Y",
				"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
				"RCM_TYPE" => "personal",
				"SECTION_CODE" => "",
				"SECTION_ID" => $_REQUEST["SECTION_ID"],
				"SECTION_ID_VARIABLE" => "SECTION_ID",
				"SECTION_URL" => "",
				"SECTION_USER_FIELDS" => array(
					0 => "",
					1 => "",
				),
				"SEF_MODE" => "N",
				"SET_BROWSER_TITLE" => "Y",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "Y",
				"SET_META_KEYWORDS" => "Y",
				"SET_STATUS_404" => "N",
				"SET_TITLE" => "Y",
				"SHOW_404" => "N",
				"SHOW_ALL_WO_SECTION" => "N",
				"SHOW_CLOSE_POPUP" => "N",
				"SHOW_DISCOUNT_PERCENT" => "N",
				"SHOW_FROM_SECTION" => "N",
				"SHOW_MAX_QUANTITY" => "N",
				"SHOW_OLD_PRICE" => "N",
				"SHOW_PRICE_COUNT" => "1",
				"SHOW_SLIDER" => "Y",
				"SLIDER_INTERVAL" => "3000",
				"SLIDER_PROGRESS" => "N",
				"TEMPLATE_THEME" => "blue",
				"USE_ENHANCED_ECOMMERCE" => "N",
				"USE_MAIN_ELEMENT_SECTION" => "N",
				"USE_PRICE_COUNT" => "N",
				"USE_PRODUCT_QUANTITY" => "N",
				"COMPONENT_TEMPLATE" => "bootstrap_v4",
				"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
				"OFFERS_SORT_FIELD" => "sort",
				"OFFERS_SORT_ORDER" => "asc",
				"OFFERS_SORT_FIELD2" => "id",
				"OFFERS_SORT_ORDER2" => "desc",
				"PROPERTY_CODE_MOBILE" => array(),
				"OFFERS_FIELD_CODE" => array(
					0 => "",
					1 => "",
				),
				"PRODUCT_DISPLAY_MODE" => "N",
				"ADD_PICT_PROP" => "-",
				"LABEL_PROP" => array()
			),
			false
		); ?>

	</div>
</section>

<section class="mailing" style="background-image: url(<?= $mailing['IMG'] ?>); display:flex; background-color: #F0F7FB">
	<div class="container">
		<h2 class="title"><?= $mailing['NAME'] ?></h2>
		<p class="desc"><?= $mailing['PREVIEW_TEXT'] ?></p>
		<!-- <form action="" class="mailing-form"> -->
		<!-- <input id="email" type="text" placeholder="Ваш E-mail">
			<input id="submit" type="submit" value="Подписаться"> -->
		<? $APPLICATION->IncludeComponent(
			"asd:subscribe.quick.form",
			"subscribe",
			array(),
			false
		); ?><br>
		<!-- </form> -->
		<p class="subdesc">
			<?= $mailing['DETAIL_TEXT'] ?>
		</p>
	</div>
</section>

<section class="category container">

	<div class="center">
		<? $APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			array(
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "inc",
				"EDIT_TEMPLATE" => "",
				"PATH" => "include/main_page/popular.php"
			)
		); ?>
	</div>

	<!-- <div class="categry-wrapper">

		<div class="category-items">

			<div class="item">
				<div class="img">
					<img src="<?= TEMPLATE_PATH ?>/assets/img/category/category1.jpg" alt="">
				</div>
				<div class="name">
					Платья
				</div>
			</div>

			<div class="item">
				<div class="img">
					<img src="<?= TEMPLATE_PATH ?>/assets/img/category/category1.jpg" alt="">
				</div>
				<div class="name">
					Кардиганы
				</div>
			</div>

		</div>

		<div class="category-items">

			<div class="item">
				<div class="img">
					<img src="<?= TEMPLATE_PATH ?>/assets/img/category/category1.jpg" alt="">
				</div>
				<div class="name">
					Платья
				</div>
			</div>

			<div class="item">
				<div class="img">
					<img src="<?= TEMPLATE_PATH ?>/assets/img/category/category1.jpg" alt="">
				</div>
				<div class="name">
					Кардиганы
				</div>
			</div>

		</div>

		<div class="category-items">

			<div class="item">
				<div class="img">
					<img src="<?= TEMPLATE_PATH ?>/assets/img/category/category1.jpg" alt="">
				</div>
				<div class="name">
					Платья
				</div>
			</div>

			<div class="item">
				<div class="img">
					<img src="<?= TEMPLATE_PATH ?>/assets/img/category/category1.jpg" alt="">
				</div>
				<div class="name">
					Кардиганы
				</div>
			</div>

		</div>

		<div class="category-items">

			<div class="item">
				<div class="img">
					<img src="<?= TEMPLATE_PATH ?>/assets/img/category/category1.jpg" alt="">
				</div>
				<div class="name">
					Платья
				</div>
			</div>

			<div class="item">
				<div class="img">
					<img src="<?= TEMPLATE_PATH ?>/assets/img/category/category1.jpg" alt="">
				</div>
				<div class="name">
					Кардиганы
				</div>
			</div>

		</div>

		<span class="btn">
			Больше категорий
		</span>

	</div> -->

	<? $APPLICATION->IncludeComponent(
		"bitrix:catalog.section.list",
		"main_page",
		array(
			"ELEMENT_SORT_FIELD" => "",
			"ADD_SECTIONS_CHAIN" => "Y",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"COUNT_ELEMENTS" => "Y",
			"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
			"FILTER_NAME" => "sectionsFilter",
			"IBLOCK_ID" => "2",
			"IBLOCK_TYPE" => "catalog",
			"SECTION_CODE" => "",
			"SECTION_FIELDS" => array(
				0 => "",
				1 => "",
			),
			"SECTION_ID" => $_REQUEST["SECTION_ID"],
			"SECTION_URL" => "",
			"SECTION_USER_FIELDS" => array(
				0 => "UF_SHOW_MAIN_PAGE",
				1 => "UF_SORT",
			),
			"SHOW_PARENT_NAME" => "Y",
			"TOP_DEPTH" => "2",
			"VIEW_MODE" => "LINE",
			"COMPONENT_TEMPLATE" => "main_page"
		),
		false
	); ?>

</section>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>