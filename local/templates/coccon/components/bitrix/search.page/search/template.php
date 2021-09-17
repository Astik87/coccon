<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$q = '';

$q = isset($arResult["REQUEST"]["ORIGINAL_QUERY"]) ? $arResult["REQUEST"]["ORIGINAL_QUERY"] : $arResult["REQUEST"]["QUERY"];

$APPLICATION->AddChainItem("Результаты поиска «" . $q . "»", '/search/index.php?q=' . $arResult["REQUEST"]["QUERY"]);

?>

<div class="search-page container">
	<? $APPLICATION->IncludeComponent(
		"bitrix:breadcrumb",
		"main_breadcrumb",
		array(
			"PATH" => "",
			"SITE_ID" => "s1",
			"START_FROM" => "0"
		)
	); ?>

	<? if ((bool)$q) : ?>
		<div class="headding-wrap">
			<h2 class="catalog-head">Результаты поиска по запросу «<?= $q ?>»</h2>
		</div>
	<? endif; ?>

	<?

	global $searchFilter;

	$searchFilter = [
		'ID' => [],
	];

	if (isset($arResult['SEARCH'])) {

		foreach ($arResult["SEARCH"] as $key => $item) {
			if (ctype_digit($item["ITEM_ID"])) array_push($searchFilter["ID"], $item["ITEM_ID"]);
		}
	}

	?>

	<? if (!empty($searchFilter['ID'])) : ?>
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
		"AJAX_OPTION_HISTORY" => "Y",
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
		"DETAIL_URL" => "/catalog/#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"ENLARGE_PRODUCT" => "STRICT",
		"FILTER_NAME" => "searchFilter",
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
		"OFFERS_LIMIT" => "0",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "round",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "8",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false}]",
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
		"PROPERTY_CODE_MOBILE" => array(
		),
		"OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PRODUCT_DISPLAY_MODE" => "N",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => array(
		),
		"SEF_RULE" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
		"SECTION_CODE_PATH" => $_REQUEST["SECTION_CODE_PATH"]
	),
	false
); ?>
	<? endif ?>

	<? /*
	<? if ($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false) : ?>
	<? elseif ($arResult["ERROR_CODE"] != 0) : ?>
		<p><?= GetMessage("SEARCH_ERROR") ?></p>
		<? ShowError($arResult["ERROR_TEXT"]); ?>
		<p><?= GetMessage("SEARCH_CORRECT_AND_CONTINUE") ?></p>
		<br /><br />
		<p><?= GetMessage("SEARCH_SINTAX") ?><br /><b><?= GetMessage("SEARCH_LOGIC") ?></b></p>
		<table border="0" cellpadding="5">
			<tr>
				<td align="center" valign="top"><?= GetMessage("SEARCH_OPERATOR") ?></td>
				<td valign="top"><?= GetMessage("SEARCH_SYNONIM") ?></td>
				<td><?= GetMessage("SEARCH_DESCRIPTION") ?></td>
			</tr>
			<tr>
				<td align="center" valign="top"><?= GetMessage("SEARCH_AND") ?></td>
				<td valign="top">and, &amp;, +</td>
				<td><?= GetMessage("SEARCH_AND_ALT") ?></td>
			</tr>
			<tr>
				<td align="center" valign="top"><?= GetMessage("SEARCH_OR") ?></td>
				<td valign="top">or, |</td>
				<td><?= GetMessage("SEARCH_OR_ALT") ?></td>
			</tr>
			<tr>
				<td align="center" valign="top"><?= GetMessage("SEARCH_NOT") ?></td>
				<td valign="top">not, ~</td>
				<td><?= GetMessage("SEARCH_NOT_ALT") ?></td>
			</tr>
			<tr>
				<td align="center" valign="top">( )</td>
				<td valign="top">&nbsp;</td>
				<td><?= GetMessage("SEARCH_BRACKETS_ALT") ?></td>
			</tr>
		</table>
	<? elseif (count($arResult["SEARCH"]) > 0) : ?>
		<? if ($arParams["DISPLAY_TOP_PAGER"] != "N") echo $arResult["NAV_STRING"] ?>
		<br />
		<hr />
		<? foreach ($arResult["SEARCH"] as $arItem) : ?>
			<a href="<? echo $arItem["URL"] ?>"><? echo $arItem["TITLE_FORMATED"] ?></a>
			<p><? echo $arItem["BODY_FORMATED"] ?></p>
			<? if (
				$arParams["SHOW_RATING"] == "Y"
				&& $arItem["RATING_TYPE_ID"] <> ''
				&& $arItem["RATING_ENTITY_ID"] > 0
			) : ?>
				<div class="search-item-rate">
					<?
					$APPLICATION->IncludeComponent(
						"bitrix:rating.vote",
						$arParams["RATING_TYPE"],
						array(
							"ENTITY_TYPE_ID" => $arItem["RATING_TYPE_ID"],
							"ENTITY_ID" => $arItem["RATING_ENTITY_ID"],
							"OWNER_ID" => $arItem["USER_ID"],
							"USER_VOTE" => $arItem["RATING_USER_VOTE_VALUE"],
							"USER_HAS_VOTED" => $arItem["RATING_USER_VOTE_VALUE"] == 0 ? 'N' : 'Y',
							"TOTAL_VOTES" => $arItem["RATING_TOTAL_VOTES"],
							"TOTAL_POSITIVE_VOTES" => $arItem["RATING_TOTAL_POSITIVE_VOTES"],
							"TOTAL_NEGATIVE_VOTES" => $arItem["RATING_TOTAL_NEGATIVE_VOTES"],
							"TOTAL_VALUE" => $arItem["RATING_TOTAL_VALUE"],
							"PATH_TO_USER_PROFILE" => $arParams["~PATH_TO_USER_PROFILE"],
						),
						$component,
						array("HIDE_ICONS" => "Y")
					); ?>
				</div>
			<? endif; ?>
			<small><?= GetMessage("SEARCH_MODIFIED") ?> <?= $arItem["DATE_CHANGE"] ?></small><br /><?
																																															if ($arItem["CHAIN_PATH"]) : ?>
				<small><?= GetMessage("SEARCH_PATH") ?>&nbsp;<?= $arItem["CHAIN_PATH"] ?></small><?
																																															endif;
																																													?>
			<hr />
		<? endforeach; ?>
		<? if ($arParams["DISPLAY_BOTTOM_PAGER"] != "N") echo $arResult["NAV_STRING"] ?>
		<br />
		<p>
			<? if ($arResult["REQUEST"]["HOW"] == "d") : ?>
				<a href="<?= $arResult["URL"] ?>&amp;how=r<? echo $arResult["REQUEST"]["FROM"] ? '&amp;from=' . $arResult["REQUEST"]["FROM"] : '' ?><? echo $arResult["REQUEST"]["TO"] ? '&amp;to=' . $arResult["REQUEST"]["TO"] : '' ?>"><?= GetMessage("SEARCH_SORT_BY_RANK") ?></a>&nbsp;|&nbsp;<b><?= GetMessage("SEARCH_SORTED_BY_DATE") ?></b>
			<? else : ?>
				<b><?= GetMessage("SEARCH_SORTED_BY_RANK") ?></b>&nbsp;|&nbsp;<a href="<?= $arResult["URL"] ?>&amp;how=d<? echo $arResult["REQUEST"]["FROM"] ? '&amp;from=' . $arResult["REQUEST"]["FROM"] : '' ?><? echo $arResult["REQUEST"]["TO"] ? '&amp;to=' . $arResult["REQUEST"]["TO"] : '' ?>"><?= GetMessage("SEARCH_SORT_BY_DATE") ?></a>
			<? endif; ?>
		</p>
	<? else : ?>
		<? ShowNote(GetMessage("SEARCH_NOTHING_TO_FOUND")); ?>
	<? endif; ?>
</div>