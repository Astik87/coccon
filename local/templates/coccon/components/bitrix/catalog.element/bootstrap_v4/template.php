<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */


$productsCount = [];
$stores = [];

<<<<<<< HEAD
$select_fields = array();
$filter = array("ACTIVE" => "Y");
$resStore = CCatalogStore::GetList(array(), $filter, false, false, $select_fields);
$i = 0;
while ($sklad = $resStore->Fetch()) {
=======
$select_fields = Array();
$filter = Array("ACTIVE" => "Y");
$resStore = CCatalogStore::GetList(array(),$filter,false,false,$select_fields);
$i = 0;
while($sklad = $resStore->Fetch())
{
>>>>>>> 6484ccaad4b7f7345b17f57215042fd16c1e7de1
	$stores[$i]['ID'] = $sklad['ID'];
	$stores[$i]['TITLE'] = $sklad['TITLE'] . '<br>' . $sklad['ADDRESS'];
	$stores[$i]['SCHEDULE'] = $sklad['SCHEDULE'];
	$i++;
}

<<<<<<< HEAD
foreach ($arResult['OFFERS'] as $product) {
	foreach ($stores as $store) {
		$arFilter = array("PRODUCT_ID" => $product['ID'], "STORE_ID" => $store['ID']);
		$storesAmount = CCatalogStoreProduct::GetList(array(), $arFilter, false, false, array());
=======
foreach($arResult['OFFERS'] as $product) {
	foreach($stores as $store) {
		$arFilter = Array("PRODUCT_ID"=>$product['ID'],"STORE_ID"=>$store['ID']);
		$storesAmount = CCatalogStoreProduct::GetList(Array(),$arFilter,false,false,Array());
>>>>>>> 6484ccaad4b7f7345b17f57215042fd16c1e7de1
		$productsCount[$store['ID']][$product['ID']] = $storesAmount->GetNext()['AMOUNT'];
	}
}

$this->setFrameMode(true);

$templateLibrary = array('popup', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES'])) {
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList,
	'ITEM' => array(
		'ID' => $arResult['ID'],
		'IBLOCK_ID' => $arResult['IBLOCK_ID'],
		'OFFERS_SELECTED' => $arResult['OFFERS_SELECTED'],
		'JS_OFFERS' => $arResult['JS_OFFERS']
	)
);
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
	'ID' => $mainId,
	'DISCOUNT_PERCENT_ID' => $mainId . '_dsc_pict',
	'STICKER_ID' => $mainId . '_sticker',
	'BIG_SLIDER_ID' => $mainId . '_big_slider',
	'BIG_IMG_CONT_ID' => $mainId . '_bigimg_cont',
	'SLIDER_CONT_ID' => $mainId . '_slider_cont',
	'OLD_PRICE_ID' => $mainId . '_old_price',
	'PRICE_ID' => $mainId . '_price',
	'DISCOUNT_PRICE_ID' => $mainId . '_price_discount',
	'PRICE_TOTAL' => $mainId . '_price_total',
	'SLIDER_CONT_OF_ID' => $mainId . '_slider_cont_',
	'QUANTITY_ID' => $mainId . '_quantity',
	'QUANTITY_DOWN_ID' => $mainId . '_quant_down',
	'QUANTITY_UP_ID' => $mainId . '_quant_up',
	'QUANTITY_MEASURE' => $mainId . '_quant_measure',
	'QUANTITY_LIMIT' => $mainId . '_quant_limit',
	'BUY_LINK' => $mainId . '_buy_link',
	'ADD_BASKET_LINK' => $mainId . '_add_basket_link',
	'BASKET_ACTIONS_ID' => $mainId . '_basket_actions',
	'NOT_AVAILABLE_MESS' => $mainId . '_not_avail',
	'COMPARE_LINK' => $mainId . '_compare_link',
	'TREE_ID' => $mainId . '_skudiv',
	'DISPLAY_PROP_DIV' => $mainId . '_sku_prop',
	'DESCRIPTION_ID' => $mainId . '_description',
	'DISPLAY_MAIN_PROP_DIV' => $mainId . '_main_sku_prop',
	'OFFER_GROUP' => $mainId . '_set_group_',
	'BASKET_PROP_DIV' => $mainId . '_basket_prop',
	'SUBSCRIBE_LINK' => $mainId . '_subscribe',
	'TABS_ID' => $mainId . '_tabs',
	'TAB_CONTAINERS_ID' => $mainId . '_tab_containers',
	'SMALL_CARD_PANEL_ID' => $mainId . '_small_card_panel',
	'TABS_PANEL_ID' => $mainId . '_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob' . preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
	: $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
	: $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
	: $arResult['NAME'];

$haveOffers = !empty($arResult['OFFERS']);
if ($haveOffers) {
	$actualItem = $arResult['OFFERS'][$arResult['OFFERS_SELECTED']] ?? reset($arResult['OFFERS']);
	$showSliderControls = false;

	foreach ($arResult['OFFERS'] as $offer) {
		if ($offer['MORE_PHOTO_COUNT'] > 1) {
			$showSliderControls = true;
			break;
		}
	}
} else {
	$actualItem = $arResult;
	$showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}

$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

if ($arParams['SHOW_SKU_DESCRIPTION'] === 'Y') {
	$skuDescription = false;
	foreach ($arResult['OFFERS'] as $offer) {
		if ($offer['DETAIL_TEXT'] != '' || $offer['PREVIEW_TEXT'] != '') {
			$skuDescription = true;
			break;
		}
	}
	$showDescription = $skuDescription || !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
} else {
	$showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
}
$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-primary' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-primary' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['PRODUCT']['SUBSCRIBE'] === 'Y' || $haveOffers);

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');
$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
$arParams['MESS_BTN_COMPARE'] = $arParams['MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCE_CATALOG_COMPARE');
$arParams['MESS_PRICE_RANGES_TITLE'] = $arParams['MESS_PRICE_RANGES_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_PRICE_RANGES_TITLE');
$arParams['MESS_DESCRIPTION_TAB'] = $arParams['MESS_DESCRIPTION_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB');
$arParams['MESS_PROPERTIES_TAB'] = $arParams['MESS_PROPERTIES_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_PROPERTIES_TAB');
$arParams['MESS_COMMENTS_TAB'] = $arParams['MESS_COMMENTS_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_COMMENTS_TAB');
$arParams['MESS_SHOW_MAX_QUANTITY'] = $arParams['MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCE_CATALOG_SHOW_MAX_QUANTITY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_FEW');

$positionClassMap = array(
	'left' => 'product-item-label-left',
	'center' => 'product-item-label-center',
	'right' => 'product-item-label-right',
	'bottom' => 'product-item-label-bottom',
	'middle' => 'product-item-label-middle',
	'top' => 'product-item-label-top'
);

$discountPositionClass = 'product-item-label-big';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION'])) {
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos) {
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
	}
}

$labelPositionClass = 'product-item-label-big';
if (!empty($arParams['LABEL_PROP_POSITION'])) {
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos) {
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
	}
}

$themeClass = isset($arParams['TEMPLATE_THEME']) ? ' bx-' . $arParams['TEMPLATE_THEME'] : '';

$colors = [];

$arSKU = CCatalogSKU::getOffersList(
	$arResult["ID"],
	0,
	array('ACTIVE' => 'Y'),
	array(),
	array("CODE" => [
		"COLOR_IMG",
		"COLOR_REF"
	])
);

foreach ($arSKU[$arResult['ID']] as $item) {

	if (!$item['PROPERTIES']['COLOR_IMG']['VALUE']) continue;

	$colors[$item['PROPERTIES']['COLOR_REF']['VALUE']] = CFile::GetPath($item['PROPERTIES']['COLOR_IMG']['VALUE']);
}

$ARTNUMBER = $arResult['PROPERTIES']['ARTNUMBER']['VALUE'];
$STRUCTURE = $arResult['PROPERTIES']['STRUCTURE']['VALUE'];
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];

$arFilter = array(
	"IBLOCK_ID" => 9,
	"PROPERTY_PRODUCT_ID" => $arResult['ID'],
);

$res = CIBlockElement::GetList([], $arFilter, false, false);

$comments = [];
while ($obj = $res->GetNextElement()) {
	$el = $obj->GetProperties();
	$elFields = $obj->GetFields();
	$images = [];
	foreach ($el['IMAGES']['VALUE'] as $img) {
		$images[] = CFile::GetPath($img);
	}

	$months = [
		'01' => 'Январь',
		'02' => 'Февраль',
		'03' => 'Март',
		'04' => 'Апрель',
		'05' => 'Май',
		'06' => 'Июнь',
		'07' => 'Июль',
		'08' => 'Август',
		'09' => 'Сентябрь',
		'10' => 'Октябрь',
		'11' => 'Ноябрь',
		'12' => 'Декабрь'
	];

	$m = $DB->FormatDate($elFields['DATE_CREATE'], 'DD.MM.YYYY HH:MI:SS', "MM");
	$d = $DB->FormatDate($elFields['DATE_CREATE'], 'DD.MM.YYYY HH:MI:SS', "DD");
	$y = $DB->FormatDate($elFields['DATE_CREATE'], 'DD.MM.YYYY HH:MI:SS', "YYYY");
	$date = $d . " " . $months[$m] . " " . $y;

	$item = [
		'DATE' => $date,
		'NAME' => $el['NAME']['VALUE'],
		'TEXT' => $el['TEXT']['VALUE'],
		'RATING' => $el['RATING']['VALUE'],
		'IMAGES' => $images,
	];
	$comments[] = $item;
}

$res = CIBlockElement::GetList(
	array(),
	array(
		"IBLOCK_ID" => 11,
	),
	false,
	false
);

$sizes = [];

while ($obj = $res->GetNextElement()) {
	$fields = $obj->GetFields();
	$properties = $obj->GetProperties();
	$sizes[$fields['NAME']] = [
		'SIZE' => $properties['SIZE']['VALUE'],
		'SIZE_IN_TABLE' => $properties['SIZE_IN_TABLE']['VALUE'],
		'OBKHFAT_GRUDI' => $properties['OBKHFAT_GRUDI']['VALUE'],
		'OBKHFAT_TALII' => $properties['OBKHFAT_TALII']['VALUE'],
		'OBKHFAT_BEDRA' => $properties['OBKHFAT_BEDRA']['VALUE'],
	];
}

if (!$USER->IsAuthorized()) {
	$favourites = (array) json_decode($_COOKIE['favourites']);

	$action = in_array($arResult['ID'], $favourites) ? "del" : "add";
	$class = in_array($arResult['ID'], $favourites) ? " active" : "";
} else {
	$connection = Bitrix\Main\Application::getConnection();
	$sqlHelper = $connection->getSqlHelper();

	$sql = 'SELECT count(*) AS c FROM favourites WHERE user_id=' . $sqlHelper->forSql($USER->GetID()) . ' and product_id=' . $sqlHelper->forSql($arResult['ID']);
	$recordset = $connection->query($sql);
	$count = (bool)$recordset->fetch()['c'];

	$action = $count ? "del" : "add";
	$class = $count ? " active" : "";
}


?>

<script>
	window.productsCountKeys = <?= json_encode(array_keys($productsCount)) ?>;
	window.productsCount = <?= json_encode($productsCount) ?>;
</script>

<div class="container element-container">

	<? $APPLICATION->IncludeComponent(
		"bitrix:breadcrumb",
		"main_breadcrumb",
		array(
			"PATH" => "",
			"SITE_ID" => "s1",
			"START_FROM" => "0"
		)
	); ?>

	<div class="bx-catalog-element<?= $themeClass ?>" id="<?= $itemIds['ID'] ?>" itemscope itemtype="http://schema.org/Product">
		<div class="product-wrapper center">

			<!-- Start bitrix slider  -->
			<div class="product-images hide-block">
				<?php
				if ($showSliderControls) {
					if ($haveOffers) {
						foreach ($arResult['OFFERS'] as $keyOffer => $offer) {
							if (!isset($offer['MORE_PHOTO_COUNT']) || $offer['MORE_PHOTO_COUNT'] <= 0)
								continue;

							$strVisible = $arResult['OFFERS_SELECTED'] == $keyOffer ? '' : 'none';
				?>
							<div class="product-item-detail-slider-controls-block" id="<?= $itemIds['SLIDER_CONT_OF_ID'] . $offer['ID'] ?>" style="display: <?= $strVisible ?>;">
								<?php
								foreach ($offer['MORE_PHOTO'] as $keyPhoto => $photo) {
								?>
									<div class="product-item-detail-slider-controls-image<?= ($keyPhoto == 0 ? ' active' : '') ?>" data-entity="slider-control" data-value="<?= $offer['ID'] . '_' . $photo['ID'] ?>">
										<img src="<?= $photo['SRC'] ?>">
									</div>
								<?php
								}
								?>
							</div>
						<?php
						}
					} else {
						?>
						<div class="product-item-detail-slider-controls-block" id="<?= $itemIds['SLIDER_CONT_ID'] ?>">
							<?php
							if (!empty($actualItem['MORE_PHOTO'])) {
								foreach ($actualItem['MORE_PHOTO'] as $key => $photo) {
							?>
									<div class="product-item-detail-slider-controls-image<?= ($key == 0 ? ' active' : '') ?>" data-entity="slider-control" data-value="<?= $photo['ID'] ?>">
										<img src="<?= $photo['SRC'] ?>">
									</div>
							<?php
								}
							}
							?>
						</div>
				<?php
					}
				}
				?>

				<div class="product-item-detail-slider-container" id="<?= $itemIds['BIG_SLIDER_ID'] ?>">
					<span class="product-item-detail-slider-close" data-entity="close-popup"></span>
					<div class="product-item-detail-slider-block
				<?= ($arParams['IMAGE_RESOLUTION'] === '1by1' ? 'product-item-detail-slider-block-square' : '') ?>" data-entity="images-slider-block">
						<span class="product-item-detail-slider-left" data-entity="slider-control-left" style="display: none;"></span>
						<span class="product-item-detail-slider-right" data-entity="slider-control-right" style="display: none;"></span>
						<div class="product-item-label-text <?= $labelPositionClass ?>" id="<?= $itemIds['STICKER_ID'] ?>" <?= (!$arResult['LABEL'] ? 'style="display: none;"' : '') ?>>
							<?php
							if ($arResult['LABEL'] && !empty($arResult['LABEL_ARRAY_VALUE'])) {
								foreach ($arResult['LABEL_ARRAY_VALUE'] as $code => $value) {
							?>
									<div<?= (!isset($arParams['LABEL_PROP_MOBILE'][$code]) ? ' class="hidden-xs"' : '') ?>>
										<span title="<?= $value ?>"><?= $value ?></span>
						</div>
				<?php
								}
							}
				?>
					</div>
					<?php
					if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y') {
						if ($haveOffers) {
					?>
							<div class="product-item-label-ring <?= $discountPositionClass ?>" id="<?= $itemIds['DISCOUNT_PERCENT_ID'] ?>" style="display: none;">
							</div>
							<?php
						} else {
							if ($price['DISCOUNT'] > 0) {
							?>
								<div class="product-item-label-ring <?= $discountPositionClass ?>" id="<?= $itemIds['DISCOUNT_PERCENT_ID'] ?>" title="<?= -$price['PERCENT'] ?>%">
									<span><?= -$price['PERCENT'] ?>%</span>
								</div>
					<?php
							}
						}
					}
					?>
					<div class="product-item-detail-slider-images-container" data-entity="images-container">
						<?php
						if (!empty($actualItem['MORE_PHOTO'])) {
							foreach ($actualItem['MORE_PHOTO'] as $key => $photo) {
						?>
								<div class="product-item-detail-slider-image<?= ($key == 0 ? ' active' : '') ?>" data-entity="image" data-id="<?= $photo['ID'] ?>">
									<img src="<?= $photo['SRC'] ?>" alt="<?= $alt ?>" title="<?= $title ?>" <?= ($key == 0 ? ' itemprop="image"' : '') ?>>
								</div>
							<?php
							}
						}

						if ($arParams['SLIDER_PROGRESS'] === 'Y') {
							?>
							<div class="product-item-detail-slider-progress-bar" data-entity="slider-progress-bar" style="width: 0;"></div>
						<?php
						}
						?>
					</div>
				</div>

			</div>

			<?php
			$showOffersBlock = $haveOffers && !empty($arResult['OFFERS_PROP']);
			$mainBlockProperties = array_intersect_key($arResult['DISPLAY_PROPERTIES'], $arParams['MAIN_BLOCK_PROPERTY_CODE']);
			$showPropsBlock = !empty($mainBlockProperties) || $arResult['SHOW_OFFERS_PROPS'];
			$showBlockWithOffersAndProps = $showOffersBlock || $showPropsBlock;
			?>
		</div>

		<!-- End bitrix slider -->

		<?
		$images  = [];

		foreach ($arResult['OFFERS'] as $offer) {
			if (count($offer) < 1) continue;

			foreach ($offer['MORE_PHOTO'] as $img) {
				if (in_array($img['SRC'], $images)) continue;

				$images[] = $img['SRC'];
			}
		}
		?>

		<!-- Product images slider -->
		<div class="product-images">

			<!-- Slider nav -->
			<div id="slider-nav-wrapper">
				<div class="next-arrow">
					<svg>
						<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#br-vector"> </use>
					</svg>
				</div>

				<div id="slider-nav">

					<? foreach ($images as $img) : ?>

						<div class="slide">
							<img src="<?= $img ?>" alt="">
						</div>

					<? endforeach; ?>

				</div>

				<div class="prev-arrow">
					<svg>
						<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#br-vector"> </use>
					</svg>
				</div>
			</div>
			<!-- End Slider nav -->

			<!-- Slider -->
			<div id="slider">

				<? foreach ($images as $img) : ?>

					<div class="slide">
						<img src="<?= $img ?>" alt="">
					</div>

				<? endforeach; ?>

			</div>
			<!-- End Slider -->

		</div>
		<!-- End product images slider -->

		<div class="detail">
			<span class="artnumber">Артикул: <?= $ARTNUMBER ?></span>
			<h1 class="card-title"><?= $name ?></h1>
			<div class="feedback">
				<a href="#comments" class="comments hover" id="comment-form-btn"><?= count($comments) ?> отзывов</a>
				<span class="share hover" id="share-btn">
					Поделиться
					<svg>
						<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#share"> </use>
					</svg>
				</span>
			</div>

			<? if ($STRUCTURE) : ?>
				<div class="structure"><?= $STRUCTURE ?></div>
			<? endif; ?>

			<?php
			if ($showBlockWithOffersAndProps) {
			?>
				<div class="col-lg-5">
					<?php
					foreach ($arParams['PRODUCT_INFO_BLOCK_ORDER'] as $blockName) {
						switch ($blockName) {
							case 'sku':
								if ($showOffersBlock) {
					?>
									<div class="mb-3" id="<?= $itemIds['TREE_ID'] ?>">
										<?php
										foreach ($arResult['SKU_PROPS'] as $key => $skuProperty) {
											if (!isset($arResult['OFFERS_PROP'][$skuProperty['CODE']]))
												continue;

											$propertyId = $skuProperty['ID'];
											$skuProps[] = array(
												'ID' => $propertyId,
												'SHOW_MODE' => $skuProperty['SHOW_MODE'],
												'VALUES' => $skuProperty['VALUES'],
												'VALUES_COUNT' => $skuProperty['VALUES_COUNT']
											);
										?>
											<div data-entity="sku-line-block" class="mb-3">
												<div class="product-item-scu-container-title scu-title">
													<?= htmlspecialcharsEx($skuProperty['NAME']) ?>:
													<? if ($key == "SIZES_CLOTHES") : ?>

														<div class="size-table-link hover" id="size-table-link">
															<svg>
																<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#ruler"> </use>
															</svg>

															<span>
																Таблица размеров
															</span>
														</div>

													<? endif; ?>

													<? if ($key == "COLOR_REF") : ?>

														<span id="current-color">

														</span>

													<? endif; ?>
												</div>
												<div class="product-item-scu-container">
													<div class="product-item-scu-block">
														<div class="product-item-scu-list">
															<ul class="product-item-scu-item-list">
																<?php
																foreach ($skuProperty['VALUES'] as &$value) {
																	$value['NAME'] = htmlspecialcharsbx($value['NAME']);

																	if ($skuProperty['SHOW_MODE'] === 'PICT') {
																?>
																		<li class="product-item-scu-item-color-container" title="<?= $value['NAME'] ?>" data-treevalue="<?= $propertyId ?>_<?= $value['ID'] ?>" data-onevalue="<?= $value['ID'] ?>">
																			<div class="product-item-scu-item-color-block">
																				<div class="product-item-scu-item-color" title="<?= $value['NAME'] ?>" style="background-image: url('<?= $colors[$value['XML_ID']] ?? $value['PICT']['SRC'] ?>');">
																				</div>
																			</div>
																		</li>
																	<?php
																	} else {
																	?>
																		<li class="product-item-scu-item-text-container" title="<?= $value['NAME'] ?>" data-treevalue="<?= $propertyId ?>_<?= $value['ID'] ?>" data-onevalue="<?= $value['ID'] ?>">
																			<div class="size">
																				<?= $sizes[$value['NAME']]['SIZE'] ?>
																			</div>
																			<div class="product-item-scu-item-text-block">
																				<div class="product-item-scu-item-text"><?= $value['NAME'] ?></div>
																			</div>
																		</li>
																<?php
																	}
																}
																?>
															</ul>
															<div style="clear: both;"></div>
														</div>
													</div>
												</div>
											</div>
										<?php
										}
										?>
									</div>
								<?php
								}

								break;

							case 'props':
								if ($showPropsBlock) {
								?>
									<div class="mb-3">
										<?php
										if (!empty($mainBlockProperties)) {
										?>
											<ul class="product-item-detail-properties">
												<?php
												foreach ($mainBlockProperties as $property) {
												?>
													<li class="product-item-detail-properties-item">
														<span class="product-item-detail-properties-name text-muted"><?= $property['NAME'] ?></span>
														<span class="product-item-detail-properties-dots"></span>
														<span class="product-item-detail-properties-value"><?= (is_array($property['DISPLAY_VALUE'])
																																									? implode(' / ', $property['DISPLAY_VALUE'])
																																									: $property['DISPLAY_VALUE']) ?>
														</span>
													</li>
												<?php
												}
												?>
											</ul>
										<?php
										}

										if ($arResult['SHOW_OFFERS_PROPS']) {
										?>
											<ul class="product-item-detail-properties" id="<?= $itemIds['DISPLAY_MAIN_PROP_DIV'] ?>"></ul>
										<?php
										}
										?>
									</div>
					<?php
								}

								break;
						}
					}
					?>
				</div>
			<?php
			}
			?>

			<div class="count">
				<?
				if ($arParams['USE_PRODUCT_QUANTITY']) {
				?>
					<?php
					if (Loc::getMessage('CATALOG_QUANTITY')) {
					?>
						<div class="count-title">Количество:</div>
					<?php
					}
					?>

					<div class="product-item-amount">
						<div class="product-item-amount-field-container">
							<span class="product-item-amount-field-btn-minus no-select" id="<?= $itemIds['QUANTITY_DOWN_ID'] ?>"></span>
							<div class="product-item-amount-field-block">
								<input class="product-item-amount-field" id="<?= $itemIds['QUANTITY_ID'] ?>" type="number" value="<?= $price['MIN_QUANTITY'] ?>">
							</div>
							<span class="product-item-amount-field-btn-plus no-select" id="<?= $itemIds['QUANTITY_UP_ID'] ?>"></span>
						</div>

					</div>
					<span class="inventory-balances hover">
						Остатки по складам
<<<<<<< HEAD
					</span>
=======
				</span>
>>>>>>> 6484ccaad4b7f7345b17f57215042fd16c1e7de1
				<?php
				}
				?>
			</div>

			<div class="price">
				<div class="product-item-detail-price-current mb-1" id="<?= $itemIds['PRICE_ID'] ?>"><?= $price['PRINT_PRICE'] ?></div>


				<div data-entity="main-button-container" class="mb-3">
					<div id="<?= $itemIds['BASKET_ACTIONS_ID'] ?>" style="display: <?= ($actualItem['CAN_BUY'] ? '' : 'none') ?>;">
						<?php
						if ($showAddBtn) {
						?>
							<a class="btn <?= $showButtonClassName ?> product-item-detail-buy-button" id="<?= $itemIds['ADD_BASKET_LINK'] ?>" href="javascript:void(0);">
								<svg>
									<use xlink:href="/local/templates/assets/img/sprite.svg#shopping-bags"> </use>
								</svg>
								Добавить в корзину
							</a>
						<?php
						}

						if ($showBuyBtn) {
						?>
							<a class="btn <?= $buyButtonClassName ?> product-item-detail-buy-button" id="<?= $itemIds['BUY_LINK'] ?>" href="javascript:void(0);">
								<svg>
									<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#shopping-bags"> </use>
								</svg>
								Добавить в корзину
							</a>
						<?php
						}
						?>
					</div>
				</div>

				<div class="favourites <?= $class ?>" data-a="<?= $action ?>" data-id="<?= $arResult['ID'] ?>" onclick="favourites(this)">
					<svg>
						<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#heart"> </use>
					</svg>
				</div>
			</div>

			<div class="<?= ($showBlockWithOffersAndProps ? "col-lg-7" : "col-lg"); ?> hide-block">
				<div class="product-item-detail-pay-block">
					<?php
					foreach ($arParams['PRODUCT_PAY_BLOCK_ORDER'] as $blockName) {
						switch ($blockName) {
							case 'rating':
								if ($arParams['USE_VOTE_RATING'] === 'Y') {
					?>
									<div class="mb-3 hide-block">
										<?php
										$APPLICATION->IncludeComponent(
											'bitrix:iblock.vote',
											'bootstrap_v4',
											array(
												'CUSTOM_SITE_ID' => $arParams['CUSTOM_SITE_ID'] ?? null,
												'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
												'IBLOCK_ID' => $arParams['IBLOCK_ID'],
												'ELEMENT_ID' => $arResult['ID'],
												'ELEMENT_CODE' => '',
												'MAX_VOTE' => '5',
												'VOTE_NAMES' => array('1', '2', '3', '4', '5'),
												'SET_STATUS_404' => 'N',
												'DISPLAY_AS_RATING' => $arParams['VOTE_DISPLAY_AS_RATING'],
												'CACHE_TYPE' => $arParams['CACHE_TYPE'],
												'CACHE_TIME' => $arParams['CACHE_TIME']
											),
											$component,
											array('HIDE_ICONS' => 'Y')
										);
										?>
									</div>
								<?php
								}

								break;

							case 'price':
								?>
								<div class="mb-3">
									<?php
									if ($arParams['SHOW_OLD_PRICE'] === 'Y') {
									?>
										<div class="product-item-detail-price-old mb-1" id="<?= $itemIds['OLD_PRICE_ID'] ?>" <?= ($showDiscount ? '' : 'style="display: none;"') ?>><?= ($showDiscount ? $price['PRINT_RATIO_BASE_PRICE'] : '') ?></div>
									<?php
									}
									?>

									<div class="product-item-detail-price-current mb-1" id="<?= $itemIds['PRICE_ID'] ?>"><?= $price['PRINT_RATIO_PRICE'] ?></div>

									<?php
									if ($arParams['SHOW_OLD_PRICE'] === 'Y') {
									?>
										<div class="product-item-detail-economy-price mb-1" id="<?= $itemIds['DISCOUNT_PRICE_ID'] ?>" <?= ($showDiscount ? '' : 'style="display: none;"') ?>><?php
																																																																																					if ($showDiscount) {
																																																																																						echo Loc::getMessage('CT_BCE_CATALOG_ECONOMY_INFO2', array('#ECONOMY#' => $price['PRINT_RATIO_DISCOUNT']));
																																																																																					}
																																																																																					?></div>
									<?php
									}
									?>
								</div>
								<?php
								break;

							case 'priceRanges':
								if ($arParams['USE_PRICE_COUNT']) {
									$showRanges = !$haveOffers && count($actualItem['ITEM_QUANTITY_RANGES']) > 1;
									$useRatio = $arParams['USE_RATIO_IN_RANGES'] === 'Y';
								?>
									<div class="mb-3" <?= $showRanges ? '' : 'style="display: none;"' ?> data-entity="price-ranges-block">
										<?php
										if ($arParams['MESS_PRICE_RANGES_TITLE']) {
										?>
											<div class="product-item-detail-info-container-title text-center">
												<?= $arParams['MESS_PRICE_RANGES_TITLE'] ?>
												<span data-entity="price-ranges-ratio-header">
													(<?= (Loc::getMessage(
															'CT_BCE_CATALOG_RATIO_PRICE',
															array('#RATIO#' => ($useRatio ? $measureRatio : '1') . ' ' . $actualItem['ITEM_MEASURE']['TITLE'])
														)) ?>)
												</span>
											</div>
										<?php
										}
										?>
										<ul class="product-item-detail-properties" data-entity="price-ranges-body">
											<?php
											if ($showRanges) {
												foreach ($actualItem['ITEM_QUANTITY_RANGES'] as $range) {
													if ($range['HASH'] !== 'ZERO-INF') {
														$itemPrice = false;

														foreach ($arResult['ITEM_PRICES'] as $itemPrice) {
															if ($itemPrice['QUANTITY_HASH'] === $range['HASH']) {
																break;
															}
														}

														if ($itemPrice) {
											?>
															<li class="product-item-detail-properties-item">
																<span class="product-item-detail-properties-name text-muted">
																	<?php
																	echo Loc::getMessage(
																		'CT_BCE_CATALOG_RANGE_FROM',
																		array('#FROM#' => $range['SORT_FROM'] . ' ' . $actualItem['ITEM_MEASURE']['TITLE'])
																	) . ' ';

																	if (is_infinite($range['SORT_TO'])) {
																		echo Loc::getMessage('CT_BCE_CATALOG_RANGE_MORE');
																	} else {
																		echo Loc::getMessage(
																			'CT_BCE_CATALOG_RANGE_TO',
																			array('#TO#' => $range['SORT_TO'] . ' ' . $actualItem['ITEM_MEASURE']['TITLE'])
																		);
																	}
																	?>
																</span>
																<span class="product-item-detail-properties-dots"></span>
																<span class="product-item-detail-properties-value"><?= ($useRatio ? $itemPrice['PRINT_RATIO_PRICE'] : $itemPrice['PRINT_PRICE']) ?></span>
															</li>
											<?php
														}
													}
												}
											}
											?>
										</ul>
									</div>
									<?php
									unset($showRanges, $useRatio, $itemPrice, $range);
								}

								break;

							case 'quantityLimit':
								if ($arParams['SHOW_MAX_QUANTITY'] !== 'N') {
									if ($haveOffers) {
									?>
										<div class="mb-3" id="<?= $itemIds['QUANTITY_LIMIT'] ?>" style="display: none;">
											<div class="product-item-detail-info-container-title text-center">
												<?= $arParams['MESS_SHOW_MAX_QUANTITY'] ?>:
											</div>
											<span class="product-item-quantity" data-entity="quantity-limit-value"></span>
										</div>
										<?php
									} else {
										if (
											$measureRatio
											&& (float)$actualItem['PRODUCT']['QUANTITY'] > 0
											&& $actualItem['CHECK_QUANTITY']
										) {
										?>
											<div class="mb-3 text-center" id="<?= $itemIds['QUANTITY_LIMIT'] ?>">
												<span class="product-item-detail-info-container-title"><?= $arParams['MESS_SHOW_MAX_QUANTITY'] ?>:</span>
												<span class="product-item-quantity" data-entity="quantity-limit-value">
													<?php
													if ($arParams['SHOW_MAX_QUANTITY'] === 'M') {
														if ((float)$actualItem['PRODUCT']['QUANTITY'] / $measureRatio >= $arParams['RELATIVE_QUANTITY_FACTOR']) {
															echo $arParams['MESS_RELATIVE_QUANTITY_MANY'];
														} else {
															echo $arParams['MESS_RELATIVE_QUANTITY_FEW'];
														}
													} else {
														echo $actualItem['PRODUCT']['QUANTITY'] . ' ' . $actualItem['ITEM_MEASURE']['TITLE'];
													}
													?>
												</span>
											</div>
									<?php
										}
									}
								}

								break;

							case 'quantity':
								if ($arParams['USE_PRODUCT_QUANTITY']) {
									?>
									<div class="mb-3" <?= (!$actualItem['CAN_BUY'] ? ' style="display: none;"' : '') ?> data-entity="quantity-block">
										<?php
										if (Loc::getMessage('CATALOG_QUANTITY')) {
										?>
											<div class="product-item-detail-info-container-title text-center"><?= Loc::getMessage('CATALOG_QUANTITY') ?></div>
										<?php
										}
										?>

										<div class="product-item-amount">
											<div class="product-item-amount-field-container">
												<span class="product-item-amount-field-btn-minus no-select" id="<?= $itemIds['QUANTITY_DOWN_ID'] ?>"></span>
												<div class="product-item-amount-field-block">
													<input class="product-item-amount-field" id="<?= $itemIds['QUANTITY_ID'] ?>" type="number" value="<?= $price['MIN_QUANTITY'] ?>">
													<span class="product-item-amount-description-container">
														<span id="<?= $itemIds['QUANTITY_MEASURE'] ?>"><?= $actualItem['ITEM_MEASURE']['TITLE'] ?></span>
														<span id="<?= $itemIds['PRICE_TOTAL'] ?>"></span>
													</span>
												</div>
												<span class="product-item-amount-field-btn-plus no-select" id="<?= $itemIds['QUANTITY_UP_ID'] ?>"></span>
											</div>
										</div>
									</div>
								<?php
								}

								break;

							case 'buttons':
								?>
								<div data-entity="main-button-container" class="mb-3">
									<div id="<?= $itemIds['BASKET_ACTIONS_ID'] ?>" style="display: <?= ($actualItem['CAN_BUY'] ? '' : 'none') ?>;">
										<?php
										if ($showAddBtn) {
										?>
											<div class="mb-3">
												<a class="btn <?= $showButtonClassName ?> product-item-detail-buy-button" id="<?= $itemIds['ADD_BASKET_LINK'] ?>" href="javascript:void(0);">
													<?= $arParams['MESS_BTN_ADD_TO_BASKET'] ?>
												</a>
											</div>
										<?php
										}

										if ($showBuyBtn) {
										?>
											<div class="mb-3">
												<a class="btn <?= $buyButtonClassName ?> product-item-detail-buy-button" id="<?= $itemIds['BUY_LINK'] ?>" href="javascript:void(0);">
													<?= $arParams['MESS_BTN_BUY'] ?>
												</a>
											</div>
										<?php
										}
										?>
									</div>
								</div>
								<?php
								if ($showSubscribe) {
								?>
									<div class="mb-3">
										<?php
										$APPLICATION->IncludeComponent(
											'bitrix:catalog.product.subscribe',
											'',
											array(
												'CUSTOM_SITE_ID' => $arParams['CUSTOM_SITE_ID'] ?? null,
												'PRODUCT_ID' => $arResult['ID'],
												'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
												'BUTTON_CLASS' => 'btn u-btn-outline-primary product-item-detail-buy-button',
												'DEFAULT_DISPLAY' => !$actualItem['CAN_BUY'],
												'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
											),
											$component,
											array('HIDE_ICONS' => 'Y')
										);
										?>
									</div>
								<?php
								}
								?>
								<div class="mb-3" id="<?= $itemIds['NOT_AVAILABLE_MESS'] ?>" style="display: <?= (!$actualItem['CAN_BUY'] ? '' : 'none') ?>;">
									<a class="btn btn-primary product-item-detail-buy-button" href="javascript:void(0)" rel="nofollow"><?= $arParams['MESS_NOT_AVAILABLE'] ?></a>
								</div>
						<?php
								break;
						}
					}

					if ($arParams['DISPLAY_COMPARE']) {
						?>
						<div class="product-item-detail-compare-container">
							<div class="product-item-detail-compare">
								<div class="checkbox">
									<label class="m-0" id="<?= $itemIds['COMPARE_LINK'] ?>">
										<input type="checkbox" data-entity="compare-checkbox">
										<span data-entity="compare-title"><?= $arParams['MESS_BTN_COMPARE'] ?></span>
									</label>
								</div>
							</div>
						</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>

	</div>
	<?php
	if ($haveOffers) {
		if ($arResult['OFFER_GROUP']) {
	?>
			<div class="row">
				<div class="col">
					<?php
					foreach ($arResult['OFFER_GROUP_VALUES'] as $offerId) {
					?>
						<span id="<?= $itemIds['OFFER_GROUP'] . $offerId ?>" style="display: none;">
							<?php
							$APPLICATION->IncludeComponent(
								'bitrix:catalog.set.constructor',
								'bootstrap_v4',
								array(
									'CUSTOM_SITE_ID' => $arParams['CUSTOM_SITE_ID'] ?? null,
									'IBLOCK_ID' => $arResult['OFFERS_IBLOCK'],
									'ELEMENT_ID' => $offerId,
									'PRICE_CODE' => $arParams['PRICE_CODE'],
									'BASKET_URL' => $arParams['BASKET_URL'],
									'OFFERS_CART_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'],
									'CACHE_TYPE' => $arParams['CACHE_TYPE'],
									'CACHE_TIME' => $arParams['CACHE_TIME'],
									'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
									'TEMPLATE_THEME' => $arParams['~TEMPLATE_THEME'],
									'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
									'CURRENCY_ID' => $arParams['CURRENCY_ID'],
									'DETAIL_URL' => $arParams['~DETAIL_URL']
								),
								$component,
								array('HIDE_ICONS' => 'Y')
							);
							?>
						</span>
					<?php
					}
					?>
				</div>
			</div>
		<?php
		}
	} else {
		if ($arResult['MODULES']['catalog'] && $arResult['OFFER_GROUP']) {
		?>
			<div class="row">
				<div class="col">
					<?php $APPLICATION->IncludeComponent(
						'bitrix:catalog.set.constructor',
						'bootstrap_v4',
						array(
							'CUSTOM_SITE_ID' => $arParams['CUSTOM_SITE_ID'] ?? null,
							'IBLOCK_ID' => $arParams['IBLOCK_ID'],
							'ELEMENT_ID' => $arResult['ID'],
							'PRICE_CODE' => $arParams['PRICE_CODE'],
							'BASKET_URL' => $arParams['BASKET_URL'],
							'CACHE_TYPE' => $arParams['CACHE_TYPE'],
							'CACHE_TIME' => $arParams['CACHE_TIME'],
							'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
							'TEMPLATE_THEME' => $arParams['~TEMPLATE_THEME'],
							'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
							'CURRENCY_ID' => $arParams['CURRENCY_ID']
						),
						$component,
						array('HIDE_ICONS' => 'Y')
					);
					?>
				</div>
			</div>
	<?php
		}
	}
	?>

	<!-- Bitrix description -->
	<div class="row hide-block">
		<div class="col">
			<div class="row" id="<?= $itemIds['TABS_ID'] ?>">
				<div class="col">
					<div class="product-item-detail-tabs-container">
						<ul class="product-item-detail-tabs-list">
							<?php
							if ($showDescription) {
							?>
								<li class="product-item-detail-tab active" data-entity="tab" data-value="description">
									<a href="javascript:void(0);" class="product-item-detail-tab-link">
										<span><?= $arParams['MESS_DESCRIPTION_TAB'] ?></span>
									</a>
								</li>
							<?php
							}

							if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS']) {
							?>
								<li class="product-item-detail-tab" data-entity="tab" data-value="properties">
									<a href="javascript:void(0);" class="product-item-detail-tab-link">
										<span><?= $arParams['MESS_PROPERTIES_TAB'] ?></span>
									</a>
								</li>
							<?php
							}

							if ($arParams['USE_COMMENTS'] === 'Y') {
							?>
								<li class="product-item-detail-tab" data-entity="tab" data-value="comments">
									<a href="javascript:void(0);" class="product-item-detail-tab-link">
										<span><?= $arParams['MESS_COMMENTS_TAB'] ?></span>
									</a>
								</li>
							<?php
							}
							?>
						</ul>
					</div>
				</div>
			</div>
			<div class="row" id="<?= $itemIds['TAB_CONTAINERS_ID'] ?>">
				<div class="col">
					<?php
					if ($showDescription) {
					?>
						<div class="product-item-detail-tab-content active" data-entity="tab-container" data-value="description" itemprop="description" id="<?= $itemIds['DESCRIPTION_ID'] ?>">
							<?php
							if (
								$arResult['PREVIEW_TEXT'] != ''
								&& ($arParams['DISPLAY_PREVIEW_TEXT_MODE'] === 'S'
									|| ($arParams['DISPLAY_PREVIEW_TEXT_MODE'] === 'E' && $arResult['DETAIL_TEXT'] == ''))
							) {
								echo $arResult['PREVIEW_TEXT_TYPE'] === 'html' ? $arResult['PREVIEW_TEXT'] : '<p>' . $arResult['PREVIEW_TEXT'] . '</p>';
							}

							if ($arResult['DETAIL_TEXT'] != '') {
								echo $arResult['DETAIL_TEXT_TYPE'] === 'html' ? $arResult['DETAIL_TEXT'] : '<p>' . $arResult['DETAIL_TEXT'] . '</p>';
							}
							?>
						</div>
					<?php
					}

					if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS']) {
					?>
						<div class="product-item-detail-tab-content" data-entity="tab-container" data-value="properties">
							<?php
							if (!empty($arResult['DISPLAY_PROPERTIES'])) {
							?>
								<ul class="product-item-detail-properties">
									<?php
									foreach ($arResult['DISPLAY_PROPERTIES'] as $property) {
									?>
										<li class="product-item-detail-properties-item">
											<span class="product-item-detail-properties-name"><?= $property['NAME'] ?></span>
											<span class="product-item-detail-properties-dots"></span>
											<span class="product-item-detail-properties-value"><?= (is_array($property['DISPLAY_VALUE'])
																																						? implode(' / ', $property['DISPLAY_VALUE'])
																																						: $property['DISPLAY_VALUE']) ?>
											</span>
										</li>
									<?php
									}
									unset($property);
									?>
								</ul>
							<?php
							}

							if ($arResult['SHOW_OFFERS_PROPS']) {
							?>
								<ul class="product-item-detail-properties" id="<?= $itemIds['DISPLAY_PROP_DIV'] ?>"></ul>
							<?php
							}
							?>
						</div>
					<?php
					}

					if ($arParams['USE_COMMENTS'] === 'Y') {
					?>
						<div class="product-item-detail-tab-content" data-entity="tab-container" data-value="comments" style="display: none;">
							<?php
							$componentCommentsParams = array(
								'ELEMENT_ID' => $arResult['ID'],
								'ELEMENT_CODE' => '',
								'IBLOCK_ID' => $arParams['IBLOCK_ID'],
								'SHOW_DEACTIVATED' => $arParams['SHOW_DEACTIVATED'],
								'URL_TO_COMMENT' => '',
								'WIDTH' => '',
								'COMMENTS_COUNT' => '5',
								'BLOG_USE' => $arParams['BLOG_USE'],
								'FB_USE' => $arParams['FB_USE'],
								'FB_APP_ID' => $arParams['FB_APP_ID'],
								'VK_USE' => $arParams['VK_USE'],
								'VK_API_ID' => $arParams['VK_API_ID'],
								'CACHE_TYPE' => $arParams['CACHE_TYPE'],
								'CACHE_TIME' => $arParams['CACHE_TIME'],
								'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
								'BLOG_TITLE' => '',
								'BLOG_URL' => $arParams['BLOG_URL'],
								'PATH_TO_SMILE' => '',
								'EMAIL_NOTIFY' => $arParams['BLOG_EMAIL_NOTIFY'],
								'AJAX_POST' => 'Y',
								'SHOW_SPAM' => 'Y',
								'SHOW_RATING' => 'N',
								'FB_TITLE' => '',
								'FB_USER_ADMIN_ID' => '',
								'FB_COLORSCHEME' => 'light',
								'FB_ORDER_BY' => 'reverse_time',
								'VK_TITLE' => '',
								'TEMPLATE_THEME' => $arParams['~TEMPLATE_THEME']
							);
							if (isset($arParams["USER_CONSENT"]))
								$componentCommentsParams["USER_CONSENT"] = $arParams["USER_CONSENT"];
							if (isset($arParams["USER_CONSENT_ID"]))
								$componentCommentsParams["USER_CONSENT_ID"] = $arParams["USER_CONSENT_ID"];
							if (isset($arParams["USER_CONSENT_IS_CHECKED"]))
								$componentCommentsParams["USER_CONSENT_IS_CHECKED"] = $arParams["USER_CONSENT_IS_CHECKED"];
							if (isset($arParams["USER_CONSENT_IS_LOADED"]))
								$componentCommentsParams["USER_CONSENT_IS_LOADED"] = $arParams["USER_CONSENT_IS_LOADED"];
							$APPLICATION->IncludeComponent(
								'bitrix:catalog.comments',
								'',
								$componentCommentsParams,
								$component,
								array('HIDE_ICONS' => 'Y')
							);
							?>
						</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
		<?php
		if ($arParams['BRAND_USE'] === 'Y') {
		?>
			<div class="col-sm-4 col-md-3">
				<?php $APPLICATION->IncludeComponent(
					'bitrix:catalog.brandblock',
					'bootstrap_v4',
					array(
						'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
						'IBLOCK_ID' => $arParams['IBLOCK_ID'],
						'ELEMENT_ID' => $arResult['ID'],
						'ELEMENT_CODE' => '',
						'PROP_CODE' => $arParams['BRAND_PROP_CODE'],
						'CACHE_TYPE' => $arParams['CACHE_TYPE'],
						'CACHE_TIME' => $arParams['CACHE_TIME'],
						'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
						'WIDTH' => '',
						'HEIGHT' => ''
					),
					$component,
					array('HIDE_ICONS' => 'Y')
				);
				?>
			</div>
		<?php
		}
		?>
	</div>
	<!-- End Bitrix description -->

	<!-- custom description -->
	<div class="description">
		<div class="description-item">

			<div class="description-title hover">
				<h2>Описание</h2>
				<div class="plus">
					<span></span>
					<span></span>
				</div>
			</div>

			<div class="description-content">
				<?= $arResult['PREVIEW_TEXT']  ?>
			</div>

		</div>

		<div class="description-item">

			<div class="description-title hover">
				<h2>Уход</h2>
				<div class="plus">
					<span></span>
					<span></span>
				</div>
			</div>

			<div class="description-content">
				<?= $arResult['DETAIL_TEXT'] ?>
			</div>

		</div>

		<div class="description-item">

			<div class="description-title hover">
				<h2>Индивидуальный заказ</h2>
				<div class="plus">
					<span></span>
					<span></span>
				</div>
			</div>

			<div class="description-content">
				Если Вы не нашли своего размера или цвета напишите нам, и возможно мы сможем выполнить его на заказ.
			</div>

		</div>

		<div class="description-item">

			<div class="description-title hover" id="comments">
				<h2>Отзывы(<?= count($comments) ?>)</h2>
				<div class="plus">
					<span></span>
					<span></span>
				</div>
			</div>

			<div class="description-content">
				<div class="add-comment">
					<div class="add-comment-btn" id="add-comment-btn">
						Оставить отзыв
					</div>

					<div class="form-wrapper hide-block" id="form-wrapper">

						<div class="desc">
							<? if (empty($comments)) : ?>
								<p>
									Будьте первым, кто оставил отзыв на «Шорты-бермуды (лён)»
								</p>
							<? endif; ?>
							<p>
								Ваш адрес Е-mail не будет опубликован. Обязательные поля помечены *
							</p>
						</div>

						<div class="rating">
							<span>Ваша оценка</span>
							<div class="stars" id="stars" data-dir="<?= TEMPLATE_PATH ?>">
								<svg data-num="1">
									<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#star"> </use>
								</svg>

								<svg data-num="2">
									<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#star"> </use>
								</svg>

								<svg data-num="3">
									<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#star"> </use>
								</svg>

								<svg data-num="4">
									<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#star"> </use>
								</svg>

								<svg data-num="5">
									<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#star"> </use>
								</svg>
							</div>
							<span id="close-comment-form" class="hover">
								Закрыть форму
							</span>
						</div>

						<form action="/ajax/comments.php" method="post" enctype="multipart/form-data" class="comment-form" id="comment-form">
							<input type="text" name="id" value="<?= $arResult['ID'] ?>" class="hide-block">
							<input type="number" id="rating" name="rating" value="0" min="0" max="5" class="hide-block">
							<div class="oneline">
								<div class="item">
									<label for="name">Имя *</label>
									<input type="text" name="username" id="name" required>
								</div>

								<div class="item">
									<label for="email">E-mail *</label>
									<input type="email" name="email" id="email" required>
								</div>
							</div>

							<div class="item">
								<label for="message">Ваш отзыв *</label>
								<textarea name="message" id="message" required></textarea>
							</div>


							<div class="files">

								<div class="lef">
									<div class="add-file" id="add-file">
										<svg>
											<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#file"> </use>
										</svg>
										<span class="hover">Прикрепить фото</span>
									</div>

									<input type="submit" value="Отправить отзыв" class="submit">
								</div>

								<div class="right">
									<div class="hide-block" id="comment-files">

									</div>
									<div class="images" id="comment-images">

									</div>
								</div>
							</div>

						</form>
					</div>

				</div>

				<? if (!empty($comments)) : ?>
					<div class="comment-list" id="comment-list">

						<? foreach ($comments as $value) : ?>

							<div class="item">
								<div class="head">
									<div class="name">
										<div class="ava">
											<?= $value['NAME'][0] ?>
										</div>

										<span class="name"><?= $value['NAME'] ?></span>
									</div>

									<div class="right">
										<div class="date">
											<?= $value['DATE'] ?>
										</div>


										<div class="stars" data-dir="<?= TEMPLATE_PATH ?>">

											<? for ($i = 1; $i <= 5; $i++) : ?>

												<?
												if ($i <= $value['RATING']) $svg = 'star-active';
												else $svg = 'star';
												?>

												<svg data-num="1">
													<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#<?= $svg ?>"> </use>
												</svg>

											<? endfor; ?>

										</div>
									</div>
								</div>

								<div class="text">
									<?= $value['TEXT'] ?>
								</div>

								<div class="images">

									<? foreach ($value['IMAGES'] as $img) : ?>
										<div class="images-item">
											<img src="<?= $img ?>" alt="">
										</div>
									<? endforeach; ?>

								</div>
							</div>

						<? endforeach; ?>

					</div>
				<? endif; ?>
			</div>

		</div>
	</div>

</div>

<div class="row hide-block">
	<div class="col">
		<?php
		if ($arResult['CATALOG'] && $actualItem['CAN_BUY'] && \Bitrix\Main\ModuleManager::isModuleInstalled('sale')) {
			$APPLICATION->IncludeComponent(
				'bitrix:sale.prediction.product.detail',
				'',
				array(
					'CUSTOM_SITE_ID' => $arParams['CUSTOM_SITE_ID'] ?? null,
					'BUTTON_ID' => $showBuyBtn ? $itemIds['BUY_LINK'] : $itemIds['ADD_BASKET_LINK'],
					'POTENTIAL_PRODUCT_TO_BUY' => array(
						'ID' => $arResult['ID'] ?? null,
						'MODULE' => $arResult['MODULE'] ?? 'catalog',
						'PRODUCT_PROVIDER_CLASS' => $arResult['~PRODUCT_PROVIDER_CLASS'] ?? \Bitrix\Catalog\Product\Basket::getDefaultProviderName(),
						'QUANTITY' => $arResult['QUANTITY'] ?? null,
						'IBLOCK_ID' => $arResult['IBLOCK_ID'] ?? null,

						'PRIMARY_OFFER_ID' => $arResult['OFFERS'][0]['ID'] ?? null,
						'SECTION' => array(
							'ID' => $arResult['SECTION']['ID'] ?? null,
							'IBLOCK_ID' => $arResult['SECTION']['IBLOCK_ID'] ?? null,
							'LEFT_MARGIN' => $arResult['SECTION']['LEFT_MARGIN'] ?? null,
							'RIGHT_MARGIN' => $arResult['SECTION']['RIGHT_MARGIN'] ?? null,
						),
					)
				),
				$component,
				array('HIDE_ICONS' => 'Y')
			);
		}

		if ($arResult['CATALOG'] && $arParams['USE_GIFTS_DETAIL'] == 'Y' && \Bitrix\Main\ModuleManager::isModuleInstalled('sale')) {
		?>
			<div data-entity="parent-container">
				<?php
				if (!isset($arParams['GIFTS_DETAIL_HIDE_BLOCK_TITLE']) || $arParams['GIFTS_DETAIL_HIDE_BLOCK_TITLE'] !== 'Y') {
				?>
					<div class="catalog-block-header" data-entity="header" data-showed="false" style="display: none; opacity: 0;">
						<?= ($arParams['GIFTS_DETAIL_BLOCK_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_GIFT_BLOCK_TITLE_DEFAULT')) ?>
					</div>
				<?php
				}

				CBitrixComponent::includeComponentClass('bitrix:sale.products.gift');
				$APPLICATION->IncludeComponent(
					'bitrix:sale.products.gift',
					'bootstrap_v4',
					array(
						'CUSTOM_SITE_ID' => $arParams['CUSTOM_SITE_ID'] ?? null,
						'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
						'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],

						'PRODUCT_ROW_VARIANTS' => "",
						'PAGE_ELEMENT_COUNT' => 0,
						'DEFERRED_PRODUCT_ROW_VARIANTS' => \Bitrix\Main\Web\Json::encode(
							SaleProductsGiftComponent::predictRowVariants(
								$arParams['GIFTS_DETAIL_PAGE_ELEMENT_COUNT'],
								$arParams['GIFTS_DETAIL_PAGE_ELEMENT_COUNT']
							)
						),
						'DEFERRED_PAGE_ELEMENT_COUNT' => $arParams['GIFTS_DETAIL_PAGE_ELEMENT_COUNT'],

						'SHOW_DISCOUNT_PERCENT' => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
						'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
						'SHOW_OLD_PRICE' => $arParams['GIFTS_SHOW_OLD_PRICE'],
						'PRODUCT_DISPLAY_MODE' => 'Y',
						'PRODUCT_BLOCKS_ORDER' => $arParams['GIFTS_PRODUCT_BLOCKS_ORDER'],
						'SHOW_SLIDER' => $arParams['GIFTS_SHOW_SLIDER'],
						'SLIDER_INTERVAL' => $arParams['GIFTS_SLIDER_INTERVAL'] ?? '',
						'SLIDER_PROGRESS' => $arParams['GIFTS_SLIDER_PROGRESS'] ?? '',

						'TEXT_LABEL_GIFT' => $arParams['GIFTS_DETAIL_TEXT_LABEL_GIFT'],

						'LABEL_PROP_' . $arParams['IBLOCK_ID'] => array(),
						'LABEL_PROP_MOBILE_' . $arParams['IBLOCK_ID'] => array(),
						'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],

						'ADD_TO_BASKET_ACTION' => ($arParams['ADD_TO_BASKET_ACTION'] ?? ''),
						'MESS_BTN_BUY' => $arParams['~GIFTS_MESS_BTN_BUY'],
						'MESS_BTN_ADD_TO_BASKET' => $arParams['~GIFTS_MESS_BTN_BUY'],
						'MESS_BTN_DETAIL' => $arParams['~MESS_BTN_DETAIL'],
						'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],

						'SHOW_PRODUCTS_' . $arParams['IBLOCK_ID'] => 'Y',
						'PROPERTY_CODE_' . $arParams['IBLOCK_ID'] => $arParams['LIST_PROPERTY_CODE'],
						'PROPERTY_CODE_MOBILE' . $arParams['IBLOCK_ID'] => $arParams['LIST_PROPERTY_CODE_MOBILE'],
						'PROPERTY_CODE_' . $arResult['OFFERS_IBLOCK'] => $arParams['OFFER_TREE_PROPS'],
						'OFFER_TREE_PROPS_' . $arResult['OFFERS_IBLOCK'] => $arParams['OFFER_TREE_PROPS'],
						'CART_PROPERTIES_' . $arResult['OFFERS_IBLOCK'] => $arParams['OFFERS_CART_PROPERTIES'],
						'ADDITIONAL_PICT_PROP_' . $arParams['IBLOCK_ID'] => ($arParams['ADD_PICT_PROP'] ?? ''),
						'ADDITIONAL_PICT_PROP_' . $arResult['OFFERS_IBLOCK'] => ($arParams['OFFER_ADD_PICT_PROP'] ?? ''),

						'HIDE_NOT_AVAILABLE' => 'Y',
						'HIDE_NOT_AVAILABLE_OFFERS' => 'Y',
						'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
						'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
						'PRICE_CODE' => $arParams['PRICE_CODE'],
						'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
						'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
						'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
						'BASKET_URL' => $arParams['BASKET_URL'],
						'ADD_PROPERTIES_TO_BASKET' => $arParams['ADD_PROPERTIES_TO_BASKET'],
						'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
						'PARTIAL_PRODUCT_PROPERTIES' => $arParams['PARTIAL_PRODUCT_PROPERTIES'],
						'USE_PRODUCT_QUANTITY' => 'N',
						'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
						'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
						'POTENTIAL_PRODUCT_TO_BUY' => array(
							'ID' => $arResult['ID'] ?? null,
							'MODULE' => $arResult['MODULE'] ?? 'catalog',
							'PRODUCT_PROVIDER_CLASS' => $arResult['~PRODUCT_PROVIDER_CLASS'] ?? \Bitrix\Catalog\Product\Basket::getDefaultProviderName(),
							'QUANTITY' => $arResult['QUANTITY'] ?? null,
							'IBLOCK_ID' => $arResult['IBLOCK_ID'] ?? null,

							'PRIMARY_OFFER_ID' => $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['ID'] ?? null,
							'SECTION' => array(
								'ID' => $arResult['SECTION']['ID'] ?? null,
								'IBLOCK_ID' => $arResult['SECTION']['IBLOCK_ID'] ?? null,
								'LEFT_MARGIN' => $arResult['SECTION']['LEFT_MARGIN'] ?? null,
								'RIGHT_MARGIN' => $arResult['SECTION']['RIGHT_MARGIN'] ?? null,
							),
						),

						'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
						'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
						'BRAND_PROPERTY' => $arParams['BRAND_PROPERTY']
					),
					$component,
					array('HIDE_ICONS' => 'Y')
				);
				?>
			</div>
		<?php
		}

		if ($arResult['CATALOG'] && $arParams['USE_GIFTS_MAIN_PR_SECTION_LIST'] == 'Y' && \Bitrix\Main\ModuleManager::isModuleInstalled('sale')) {
		?>
			<div data-entity="parent-container">
				<?php
				if (!isset($arParams['GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE']) || $arParams['GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE'] !== 'Y') {
				?>
					<div class="catalog-block-header" data-entity="header" data-showed="false" style="display: none; opacity: 0;">
						<?= ($arParams['GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_GIFTS_MAIN_BLOCK_TITLE_DEFAULT')) ?>
					</div>
				<?php
				}

				$APPLICATION->IncludeComponent(
					'bitrix:sale.gift.main.products',
					'bootstrap_v4',
					array(
						'CUSTOM_SITE_ID' => $arParams['CUSTOM_SITE_ID'] ?? null,
						'PAGE_ELEMENT_COUNT' => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT'],
						'LINE_ELEMENT_COUNT' => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT'],
						'HIDE_BLOCK_TITLE' => 'Y',
						'BLOCK_TITLE' => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE'],

						'OFFERS_FIELD_CODE' => $arParams['OFFERS_FIELD_CODE'],
						'OFFERS_PROPERTY_CODE' => $arParams['OFFERS_PROPERTY_CODE'],

						'AJAX_MODE' => $arParams['AJAX_MODE'],
						'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
						'IBLOCK_ID' => $arParams['IBLOCK_ID'],

						'ELEMENT_SORT_FIELD' => 'ID',
						'ELEMENT_SORT_ORDER' => 'DESC',
						'FILTER_NAME' => 'searchFilter',
						'SECTION_URL' => $arParams['SECTION_URL'],
						'DETAIL_URL' => $arParams['DETAIL_URL'],
						'BASKET_URL' => $arParams['BASKET_URL'],
						'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
						'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
						'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],

						'CACHE_TYPE' => $arParams['CACHE_TYPE'],
						'CACHE_TIME' => $arParams['CACHE_TIME'],

						'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
						'SET_TITLE' => $arParams['SET_TITLE'],
						'PROPERTY_CODE' => $arParams['PROPERTY_CODE'],
						'PRICE_CODE' => $arParams['PRICE_CODE'],
						'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
						'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],

						'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
						'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
						'CURRENCY_ID' => $arParams['CURRENCY_ID'],
						'HIDE_NOT_AVAILABLE' => 'Y',
						'HIDE_NOT_AVAILABLE_OFFERS' => 'Y',
						'TEMPLATE_THEME' => ($arParams['TEMPLATE_THEME'] ?? ''),
						'PRODUCT_BLOCKS_ORDER' => $arParams['GIFTS_PRODUCT_BLOCKS_ORDER'],

						'SHOW_SLIDER' => $arParams['GIFTS_SHOW_SLIDER'],
						'SLIDER_INTERVAL' => $arParams['GIFTS_SLIDER_INTERVAL'] ?? '',
						'SLIDER_PROGRESS' => $arParams['GIFTS_SLIDER_PROGRESS'] ?? '',

						'ADD_PICT_PROP' => ($arParams['ADD_PICT_PROP'] ?? ''),
						'LABEL_PROP' => ($arParams['LABEL_PROP'] ?? ''),
						'LABEL_PROP_MOBILE' => ($arParams['LABEL_PROP_MOBILE'] ?? ''),
						'LABEL_PROP_POSITION' => ($arParams['LABEL_PROP_POSITION'] ?? ''),
						'OFFER_ADD_PICT_PROP' => ($arParams['OFFER_ADD_PICT_PROP'] ?? ''),
						'OFFER_TREE_PROPS' => ($arParams['OFFER_TREE_PROPS'] ?? ''),
						'SHOW_DISCOUNT_PERCENT' => ($arParams['SHOW_DISCOUNT_PERCENT'] ?? ''),
						'DISCOUNT_PERCENT_POSITION' => ($arParams['DISCOUNT_PERCENT_POSITION'] ?? ''),
						'SHOW_OLD_PRICE' => ($arParams['SHOW_OLD_PRICE'] ?? ''),
						'MESS_BTN_BUY' => ($arParams['~MESS_BTN_BUY'] ?? ''),
						'MESS_BTN_ADD_TO_BASKET' => ($arParams['~MESS_BTN_ADD_TO_BASKET'] ?? ''),
						'MESS_BTN_DETAIL' => ($arParams['~MESS_BTN_DETAIL'] ?? ''),
						'MESS_NOT_AVAILABLE' => ($arParams['~MESS_NOT_AVAILABLE'] ?? ''),
						'ADD_TO_BASKET_ACTION' => ($arParams['ADD_TO_BASKET_ACTION'] ?? ''),
						'SHOW_CLOSE_POPUP' => ($arParams['SHOW_CLOSE_POPUP'] ?? ''),
						'DISPLAY_COMPARE' => ($arParams['DISPLAY_COMPARE'] ?? ''),
						'COMPARE_PATH' => ($arParams['COMPARE_PATH'] ?? ''),
					)
						+ array(
							'OFFER_ID' => empty($arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['ID'])
								? $arResult['ID']
								: $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['ID'],
							'SECTION_ID' => $arResult['SECTION']['ID'],
							'ELEMENT_ID' => $arResult['ID'],

							'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
							'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
							'BRAND_PROPERTY' => $arParams['BRAND_PROPERTY']
						),
					$component,
					array('HIDE_ICONS' => 'Y')
				);
				?>
			</div>
		<?php
		}
		?>
	</div>
</div>

<!--Small Card-->
<div class="hide-block p-2 product-item-detail-short-card-fixed d-none d-md-block" id="<?= $itemIds['SMALL_CARD_PANEL_ID'] ?>">
	<div class="product-item-detail-short-card-content-container">
		<div class="product-item-detail-short-card-image">
			<img src="" style="height: 65px;" data-entity="panel-picture">
		</div>
		<div class="product-item-detail-short-title-container" data-entity="panel-title">
			<div class="product-item-detail-short-title-text"><?= $name ?></div>
			<?php
			if ($haveOffers) {
			?>
				<div>
					<div class="product-item-selected-scu-container" data-entity="panel-sku-container">
						<?php
						$i = 0;

						foreach ($arResult['SKU_PROPS'] as $skuProperty) {
							if (!isset($arResult['OFFERS_PROP'][$skuProperty['CODE']])) {
								continue;
							}

							$propertyId = $skuProperty['ID'];

							foreach ($skuProperty['VALUES'] as $value) {
								$value['NAME'] = htmlspecialcharsbx($value['NAME']);
								if ($skuProperty['SHOW_MODE'] === 'PICT') {
						?>
									<div class="product-item-selected-scu product-item-selected-scu-color selected" title="<?= $value['NAME'] ?>" style="background-image: url('<?= $value['PICT']['SRC'] ?>'); display: none;" data-sku-line="<?= $i ?>" data-treevalue="<?= $propertyId ?>_<?= $value['ID'] ?>" data-onevalue="<?= $value['ID'] ?>">
									</div>
								<?php
								} else {
								?>
									<div class="product-item-selected-scu product-item-selected-scu-text selected" title="<?= $value['NAME'] ?>" style="display: none;" data-sku-line="<?= $i ?>" data-treevalue="<?= $propertyId ?>_<?= $value['ID'] ?>" data-onevalue="<?= $value['ID'] ?>">
										<?= $value['NAME'] ?>
									</div>
						<?php
								}
							}

							$i++;
						}
						?>
					</div>
				</div>
			<?php
			}
			?>

		</div>
		<div class="product-item-detail-short-card-price">
			<?php
			if ($arParams['SHOW_OLD_PRICE'] === 'Y') {
			?>
				<div class="product-item-detail-price-old" style="display: <?= ($showDiscount ? '' : 'none') ?>;" data-entity="panel-old-price">
					<?= ($showDiscount ? $price['PRINT_RATIO_BASE_PRICE'] : '') ?>
				</div>
			<?php
			}
			?>
			<div class="product-item-detail-price-current" data-entity="panel-price"><?= $price['PRINT_RATIO_PRICE'] ?></div>
		</div>
		<?php
		if ($showAddBtn) {
		?>
			<div class="product-item-detail-short-card-btn" style="display: <?= ($actualItem['CAN_BUY'] ? '' : 'none') ?>;" data-entity="panel-add-button">
				<a class="btn <?= $showButtonClassName ?> product-item-detail-buy-button" id="<?= $itemIds['ADD_BASKET_LINK'] ?>" href="javascript:void(0);">
					<?= $arParams['MESS_BTN_ADD_TO_BASKET'] ?>
				</a>
			</div>
		<?php
		}

		if ($showBuyBtn) {
		?>
			<div class="product-item-detail-short-card-btn" style="display: <?= ($actualItem['CAN_BUY'] ? '' : 'none') ?>;" data-entity="panel-buy-button">
				<a class="btn <?= $buyButtonClassName ?> product-item-detail-buy-button" id="<?= $itemIds['BUY_LINK'] ?>" href="javascript:void(0);">
					<?= $arParams['MESS_BTN_BUY'] ?>
				</a>
			</div>
		<?php
		}
		?>
		<div class="product-item-detail-short-card-btn" style="display: <?= (!$actualItem['CAN_BUY'] ? '' : 'none') ?>;" data-entity="panel-not-available-button">
			<a class="btn btn-link product-item-detail-buy-button" href="javascript:void(0)" rel="nofollow">
				<?= $arParams['MESS_NOT_AVAILABLE'] ?>
			</a>
		</div>
	</div>
</div>
<!--Top tabs-->
<div class="hide-block pt-2 pb-0 product-item-detail-tabs-container-fixed d-none d-md-block hide-block" id="<?= $itemIds['TABS_PANEL_ID'] ?>">
	<ul class="product-item-detail-tabs-list">
		<?php
		if ($showDescription) {
		?>
			<li class="product-item-detail-tab active" data-entity="tab" data-value="description">
				<a href="javascript:void(0);" class="product-item-detail-tab-link">
					<span><?= $arParams['MESS_DESCRIPTION_TAB'] ?></span>
				</a>
			</li>
		<?php
		}

		if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS']) {
		?>
			<li class="product-item-detail-tab" data-entity="tab" data-value="properties">
				<a href="javascript:void(0);" class="product-item-detail-tab-link">
					<span><?= $arParams['MESS_PROPERTIES_TAB'] ?></span>
				</a>
			</li>
		<?php
		}

		if ($arParams['USE_COMMENTS'] === 'Y') {
		?>
			<li class="product-item-detail-tab" data-entity="tab" data-value="comments">
				<a href="javascript:void(0);" class="product-item-detail-tab-link">
					<span><?= $arParams['MESS_COMMENTS_TAB'] ?></span>
				</a>
			</li>
		<?php
		}
		?>
	</ul>
</div>

<meta itemprop="name" content="<?= $name ?>" />
<meta itemprop="category" content="<?= $arResult['CATEGORY_PATH'] ?>" />
<?php
if ($haveOffers) {
	foreach ($arResult['JS_OFFERS'] as $offer) {
		$currentOffersList = array();

		if (!empty($offer['TREE']) && is_array($offer['TREE'])) {
			foreach ($offer['TREE'] as $propName => $skuId) {
				$propId = (int)substr($propName, 5);

				foreach ($skuProps as $prop) {
					if ($prop['ID'] == $propId) {
						foreach ($prop['VALUES'] as $propId => $propValue) {
							if ($propId == $skuId) {
								$currentOffersList[] = $propValue['NAME'];
								break;
							}
						}
					}
				}
			}
		}

		$offerPrice = $offer['ITEM_PRICES'][$offer['ITEM_PRICE_SELECTED']];
?>
		<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
			<meta itemprop="sku" content="<?= htmlspecialcharsbx(implode('/', $currentOffersList)) ?>" />
			<meta itemprop="price" content="<?= $offerPrice['RATIO_PRICE'] ?>" />
			<meta itemprop="priceCurrency" content="<?= $offerPrice['CURRENCY'] ?>" />
			<link itemprop="availability" href="http://schema.org/<?= ($offer['CAN_BUY'] ? 'InStock' : 'OutOfStock') ?>" />
		</span>
	<?php
	}

	unset($offerPrice, $currentOffersList);
} else {
	?>
	<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
		<meta itemprop="price" content="<?= $price['RATIO_PRICE'] ?>" />
		<meta itemprop="priceCurrency" content="<?= $price['CURRENCY'] ?>" />
		<link itemprop="availability" href="http://schema.org/<?= ($actualItem['CAN_BUY'] ? 'InStock' : 'OutOfStock') ?>" />
	</span>
<?php
}
?>
<?php
if ($haveOffers) {
	$offerIds = array();
	$offerCodes = array();

	$useRatio = $arParams['USE_RATIO_IN_RANGES'] === 'Y';

	foreach ($arResult['JS_OFFERS'] as $ind => &$jsOffer) {
		$offerIds[] = (int)$jsOffer['ID'];
		$offerCodes[] = $jsOffer['CODE'];

		$fullOffer = $arResult['OFFERS'][$ind];
		$measureName = $fullOffer['ITEM_MEASURE']['TITLE'];

		$strAllProps = '';
		$strMainProps = '';
		$strPriceRangesRatio = '';
		$strPriceRanges = '';

		if ($arResult['SHOW_OFFERS_PROPS']) {
			if (!empty($jsOffer['DISPLAY_PROPERTIES'])) {
				foreach ($jsOffer['DISPLAY_PROPERTIES'] as $property) {
					$current = '<li class="product-item-detail-properties-item">
					<span class="product-item-detail-properties-name">' . $property['NAME'] . '</span>
					<span class="product-item-detail-properties-dots"></span>
					<span class="product-item-detail-properties-value">' . (is_array($property['VALUE'])
						? implode(' / ', $property['VALUE'])
						: $property['VALUE']) . '</span></li>';
					$strAllProps .= $current;

					if (isset($arParams['MAIN_BLOCK_OFFERS_PROPERTY_CODE'][$property['CODE']])) {
						$strMainProps .= $current;
					}
				}

				unset($current);
			}
		}

		if ($arParams['USE_PRICE_COUNT'] && count($jsOffer['ITEM_QUANTITY_RANGES']) > 1) {
			$strPriceRangesRatio = '(' . Loc::getMessage(
				'CT_BCE_CATALOG_RATIO_PRICE',
				array('#RATIO#' => ($useRatio
					? $fullOffer['ITEM_MEASURE_RATIOS'][$fullOffer['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']
					: '1') . ' ' . $measureName)
			) . ')';

			foreach ($jsOffer['ITEM_QUANTITY_RANGES'] as $range) {
				if ($range['HASH'] !== 'ZERO-INF') {
					$itemPrice = false;

					foreach ($jsOffer['ITEM_PRICES'] as $itemPrice) {
						if ($itemPrice['QUANTITY_HASH'] === $range['HASH']) {
							break;
						}
					}

					if ($itemPrice) {
						$strPriceRanges .= '<dt>' . Loc::getMessage(
							'CT_BCE_CATALOG_RANGE_FROM',
							array('#FROM#' => $range['SORT_FROM'] . ' ' . $measureName)
						) . ' ';

						if (is_infinite($range['SORT_TO'])) {
							$strPriceRanges .= Loc::getMessage('CT_BCE_CATALOG_RANGE_MORE');
						} else {
							$strPriceRanges .= Loc::getMessage(
								'CT_BCE_CATALOG_RANGE_TO',
								array('#TO#' => $range['SORT_TO'] . ' ' . $measureName)
							);
						}

						$strPriceRanges .= '</dt><dd>' . ($useRatio ? $itemPrice['PRINT_RATIO_PRICE'] : $itemPrice['PRINT_PRICE']) . '</dd>';
					}
				}
			}

			unset($range, $itemPrice);
		}

		$jsOffer['DISPLAY_PROPERTIES'] = $strAllProps;
		$jsOffer['DISPLAY_PROPERTIES_MAIN_BLOCK'] = $strMainProps;
		$jsOffer['PRICE_RANGES_RATIO_HTML'] = $strPriceRangesRatio;
		$jsOffer['PRICE_RANGES_HTML'] = $strPriceRanges;
	}

	$templateData['OFFER_IDS'] = $offerIds;
	$templateData['OFFER_CODES'] = $offerCodes;
	unset($jsOffer, $strAllProps, $strMainProps, $strPriceRanges, $strPriceRangesRatio, $useRatio);

	$jsParams = array(
		'CONFIG' => array(
			'USE_CATALOG' => $arResult['CATALOG'],
			'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'SHOW_PRICE' => true,
			'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
			'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
			'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
			'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
			'SHOW_SKU_PROPS' => $arResult['SHOW_OFFERS_PROPS'],
			'OFFER_GROUP' => $arResult['OFFER_GROUP'],
			'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
			'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
			'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
			'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
			'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
			'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
			'USE_STICKERS' => true,
			'USE_SUBSCRIBE' => $showSubscribe,
			'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
			'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
			'ALT' => $alt,
			'TITLE' => $title,
			'MAGNIFIER_ZOOM_PERCENT' => 200,
			'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
			'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
			'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
				? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
				: null,
			'SHOW_SKU_DESCRIPTION' => $arParams['SHOW_SKU_DESCRIPTION'],
			'DISPLAY_PREVIEW_TEXT_MODE' => $arParams['DISPLAY_PREVIEW_TEXT_MODE']
		),
		'PRODUCT_TYPE' => $arResult['PRODUCT']['TYPE'],
		'VISUAL' => $itemIds,
		'DEFAULT_PICTURE' => array(
			'PREVIEW_PICTURE' => $arResult['DEFAULT_PICTURE'],
			'DETAIL_PICTURE' => $arResult['DEFAULT_PICTURE']
		),
		'PRODUCT' => array(
			'ID' => $arResult['ID'],
			'ACTIVE' => $arResult['ACTIVE'],
			'NAME' => $arResult['~NAME'],
			'CATEGORY' => $arResult['CATEGORY_PATH'],
			'DETAIL_TEXT' => $arResult['DETAIL_TEXT'],
			'DETAIL_TEXT_TYPE' => $arResult['DETAIL_TEXT_TYPE'],
			'PREVIEW_TEXT' => $arResult['PREVIEW_TEXT'],
			'PREVIEW_TEXT_TYPE' => $arResult['PREVIEW_TEXT_TYPE']
		),
		'BASKET' => array(
			'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'BASKET_URL' => $arParams['BASKET_URL'],
			'SKU_PROPS' => $arResult['OFFERS_PROP_CODES'],
			'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
			'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
		),
		'OFFERS' => $arResult['JS_OFFERS'],
		'OFFER_SELECTED' => $arResult['OFFERS_SELECTED'],
		'TREE_PROPS' => $skuProps
	);
} else {
	$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
	if ($arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !$emptyProductProperties) {
?>
		<div id="<?= $itemIds['BASKET_PROP_DIV'] ?>" style="display: none;">
			<?php
			if (!empty($arResult['PRODUCT_PROPERTIES_FILL'])) {
				foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propId => $propInfo) {
			?>
					<input type="hidden" name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]" value="<?= htmlspecialcharsbx($propInfo['ID']) ?>">
				<?php
					unset($arResult['PRODUCT_PROPERTIES'][$propId]);
				}
			}

			$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
			if (!$emptyProductProperties) {
				?>
				<table>
					<?php
					foreach ($arResult['PRODUCT_PROPERTIES'] as $propId => $propInfo) {
					?>
						<tr>
							<td><?= $arResult['PROPERTIES'][$propId]['NAME'] ?></td>
							<td>
								<?php
								if (
									$arResult['PROPERTIES'][$propId]['PROPERTY_TYPE'] === 'L'
									&& $arResult['PROPERTIES'][$propId]['LIST_TYPE'] === 'C'
								) {
									foreach ($propInfo['VALUES'] as $valueId => $value) {
								?>
										<label>
											<input type="radio" name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]" value="<?= $valueId ?>" <?= ($valueId == $propInfo['SELECTED'] ? '"checked"' : '') ?>>
											<?= $value ?>
										</label>
										<br>
									<?php
									}
								} else {
									?>
									<select name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]">
										<?php
										foreach ($propInfo['VALUES'] as $valueId => $value) {
										?>
											<option value="<?= $valueId ?>" <?= ($valueId == $propInfo['SELECTED'] ? '"selected"' : '') ?>>
												<?= $value ?>
											</option>
										<?php
										}
										?>
									</select>
								<?php
								}
								?>
							</td>
						</tr>
					<?php
					}
					?>
				</table>
			<?php
			}
			?>
		</div>
<?php
	}

	$jsParams = array(
		'CONFIG' => array(
			'USE_CATALOG' => $arResult['CATALOG'],
			'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'SHOW_PRICE' => !empty($arResult['ITEM_PRICES']),
			'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
			'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
			'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
			'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
			'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
			'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
			'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
			'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
			'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
			'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
			'USE_STICKERS' => true,
			'USE_SUBSCRIBE' => $showSubscribe,
			'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
			'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
			'ALT' => $alt,
			'TITLE' => $title,
			'MAGNIFIER_ZOOM_PERCENT' => 200,
			'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
			'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
			'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
				? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
				: null
		),
		'VISUAL' => $itemIds,
		'PRODUCT_TYPE' => $arResult['PRODUCT']['TYPE'],
		'PRODUCT' => array(
			'ID' => $arResult['ID'],
			'ACTIVE' => $arResult['ACTIVE'],
			'PICT' => reset($arResult['MORE_PHOTO']),
			'NAME' => $arResult['~NAME'],
			'SUBSCRIPTION' => true,
			'ITEM_PRICE_MODE' => $arResult['ITEM_PRICE_MODE'],
			'ITEM_PRICES' => $arResult['ITEM_PRICES'],
			'ITEM_PRICE_SELECTED' => $arResult['ITEM_PRICE_SELECTED'],
			'ITEM_QUANTITY_RANGES' => $arResult['ITEM_QUANTITY_RANGES'],
			'ITEM_QUANTITY_RANGE_SELECTED' => $arResult['ITEM_QUANTITY_RANGE_SELECTED'],
			'ITEM_MEASURE_RATIOS' => $arResult['ITEM_MEASURE_RATIOS'],
			'ITEM_MEASURE_RATIO_SELECTED' => $arResult['ITEM_MEASURE_RATIO_SELECTED'],
			'SLIDER_COUNT' => $arResult['MORE_PHOTO_COUNT'],
			'SLIDER' => $arResult['MORE_PHOTO'],
			'CAN_BUY' => $arResult['CAN_BUY'],
			'CHECK_QUANTITY' => $arResult['CHECK_QUANTITY'],
			'QUANTITY_FLOAT' => is_float($arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']),
			'MAX_QUANTITY' => $arResult['PRODUCT']['QUANTITY'],
			'STEP_QUANTITY' => $arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'],
			'CATEGORY' => $arResult['CATEGORY_PATH']
		),
		'BASKET' => array(
			'ADD_PROPS' => $arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y',
			'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
			'EMPTY_PROPS' => $emptyProductProperties,
			'BASKET_URL' => $arParams['BASKET_URL'],
			'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
			'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
		)
	);
	unset($emptyProductProperties);
}

if ($arParams['DISPLAY_COMPARE']) {
	$jsParams['COMPARE'] = array(
		'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
		'COMPARE_DELETE_URL_TEMPLATE' => $arResult['~COMPARE_DELETE_URL_TEMPLATE'],
		'COMPARE_PATH' => $arParams['COMPARE_PATH']
	);
}
?>
</div>

<!-- RECOMMEND products -->

<div class="modal-wrapp" id="size-modal" style="display: none;">
	<div class="size-table">

		<div class="modal-close">
			<span></span>
			<span></span>
		</div>

		<div class="table-wrapp">
			<?

			$tr = [
				'SIZE_IN_TABLE' => 'Размер',
				'OBKHFAT_GRUDI' => 'Обхват груди(см)',
				'OBKHFAT_TALII' => 'Обхват талии(см)',
				'OBKHFAT_BEDRA' => 'Обхват бедер(см)'
			];

			?>
			<table>

				<? foreach ($tr as $key => $value) : ?>

					<tr>
						<td><?= $value ?></td>
						<? foreach ($sizes as $item) : ?>

							<td><?= $item[$key] ?></td>

						<? endforeach; ?>
					</tr>

				<? endforeach; ?>
			</table>
		</div>
	</div>
</div>

<div class="modal-wrapp" id="share-modal" style="display: none;">
	<div class="share-modal">

		<div class="modal-close">
			<span></span>
			<span></span>
		</div>

		<h3 class="modal-heading">Поделиться</h3>

		<div class="share-icons">
			<div class="social">
				<div class="item">
					<a href="https://t.me/share/url?url=" target="_blank">
						<svg>
							<use xlink:href="<?= TEMPLATE_PATH . '/assets/img/sprite.svg#telegram' ?>"> </use>
						</svg>
					</a>
				</div>

				<div class="item">
					<a href="whatsapp://send?text=" target="_blank">
						<svg>
							<use xlink:href="<?= TEMPLATE_PATH . '/assets/img/sprite.svg#whatsapp' ?>"> </use>
						</svg>
					</a>
				</div>

				<div class="item" onclick="shareInstagram()" target="_blank">
					<img src="<?= TEMPLATE_PATH . '/assets/img/instagram.png' ?>"> </img>
				</div>
			</div>
		</div>

		<div class="link">
			<label for="link-input">Ссылка на товар</label>
			<input type="text" value="<?= $url ?>" id="link-input">
			<span class="copy" id="copy-link">
				Копировать ссылку
			</span>
		</div>

	</div>
</div>

<?
global $DATA;
CModule::IncludeModule("iblock");
$arFilter = array("IBLOCK_ID" => 5, "ACTIVE" => "Y");
$res = CIBlockElement::GetList(array(), $arFilter, false, array(), array());
while ($ob = $res->GetNextElement()) {
	$arFields = $ob->GetProperties();
	$DATA[] = $arFields;
}

?>

<div class="md-wrapper" id="stores-modal">
	<div class="stores" title="Вы можете оформить \n доставку из другого города, где данный товар есть в наличии">
		<div class="modal-close">
			<span></span>
			<span></span>
		</div>

		<div class="title">Остатки по складам</div>
<<<<<<< HEAD

=======
		
>>>>>>> 6484ccaad4b7f7345b17f57215042fd16c1e7de1
		<table class="table">

			<tr class="head">
				<td>Адрес</td>
				<td>Наличие</td>
				<td>Режим работы</td>
			</tr>

<<<<<<< HEAD
			<? foreach ($stores as $store) : ?>
				<tr id="store_<?= $store['ID'] ?>">
					<td data-schedule="<?= $store['SCHEDULE'] ?>">
						<?= $store['TITLE'] ?> <br>
=======
			<? foreach($stores as $store): ?>
				<tr id="store_<?= $store['ID'] ?>">
					<td>
						<?= $store['TITLE'] ?>
>>>>>>> 6484ccaad4b7f7345b17f57215042fd16c1e7de1
					</td>
					<td class="availability">в наличии</td>
					<td><?= $store['SCHEDULE'] ?></td>
				</tr>
			<? endforeach; ?>
<<<<<<< HEAD

=======
			
>>>>>>> 6484ccaad4b7f7345b17f57215042fd16c1e7de1
		</table>
	</div>
</div>

<script>
	function shareInstagram() {
		$('#copy-link').click();
		window.open("<?= $DATA[0]['DATA_INSTAGRAM']['VALUE'] ?>");
	}

	function productInit() {
		$('.product-item-scu-item-list').on('click', function() {
			let title = $('.product-item-scu-item-color-container.selected').attr('title');

			$('#current-color').html(title);
		})

		$('.product-item-scu-item-list').click();
	}

	productInit();

	window.onload = function() {
		productInit();

		let startDetailOffset = $('.detail').offset();

		function detailScroll() {
			if (!$('.element-container').length) return false;
			let left = $('.element-container').offset().left + $('.element-container').width() - $('.detail').width() - 25;
			if (!$('.detail').hasClass('absolute')) $('.detail').css('left', left);
			let detailHeight = $('.detail').height();
			let containerHeight = $('.element-container').height();
			let containerOffset = $('.element-container').offset();
			let maxTop = containerHeight + containerOffset.top;
			let headerOffset = $('.header').offset();
			let detailOffset = $('.detail').offset();
			if (headerOffset.top >= detailOffset.top - 81 && !$('.detail').hasClass('absolute')) {
				$('.detail').addClass('fixed');
			}

			if (detailOffset.top < startDetailOffset.top && $('.detail').hasClass('fixed')) {
				$('.detail').removeClass('fixed');
			}

			if (detailHeight + detailOffset.top >= maxTop && !$('.detail').hasClass('absolute')) {
				$('.detail').removeClass('fixed');
				$('.detail').css('left', 'auto');
				$('.detail').css('right', '15px');
				$('.detail').addClass('absolute');
			}

			if (detailHeight + detailOffset.top <= maxTop && headerOffset.top <= detailOffset.top - 81 && $('.detail').hasClass('absolute')) {
				$('.detail').removeClass('absolute');
				$('.detail').css('right', 'auto');
				$('.detail').css('left', left)
				$('.detail').addClass('fixed');
			}
		}

		// setInterval(detailScroll, 10);

		detailScroll();
		$(window).scroll(detailScroll);

		$('.share-modal a').each((i, e) => {
			$(e).attr('href', $(e).attr('href') + document.location.href);
		});

		// Catalog comment rrating 
		$('#stars svg').on('click', function() {
			let dir = $('#stars').data('dir');
			let num = +$(this).data('num');
			$('#rating').val(num);
			$('#stars svg').each((i, e) => {
				if (+$(e).data('num') <= num) {
					$(e).html(`<use xlink:href="${dir}/assets/img/sprite.svg#star-active"> </use>`);
				} else {
					$(e).html(`<use xlink:href="${dir}/assets/img/sprite.svg#star"> </use>`);
				}
			});
		});

		// Comment add image
		$('#add-file').on('click', () => {
			let num = $('#comment-files input').length;

			let input = $(`<input type="file" name="img${num}" id="img${num}">`);
			$('#comment-files').append(input);
			input.click();
			input.on('change', function() {
				if (this.files && this.files[0]) {
					var reader = new FileReader();

					reader.onload = function(e) {
						let src = e.target.result;
						let img = $(`
                        <div class="image">
                        <img src="${src}" alt="">
                        </div>`);

						let remove = $(`<div class="image-remove">
                        <span></span>
                        <span></span>
                    </div>`);

						remove.on('click', function() {
							$(`#img${num}`).remove();
							$(this).parent().remove();
						});

						img.append(remove);
						$('#comment-images').append(img);
					};

					reader.readAsDataURL(input[0].files[0]);
				}
			});
		});

		$("#comment-form").ajaxForm({
			url: '/ajax/comments.php',
			type: 'post',
			success: (d) => {
				let res = JSON.parse(d);
				if (res.status) window.location.reload(false);
			}
		});

		$('#add-comment-btn, #close-comment-form').on('click', function() {
			$('#comment-list').toggleClass('hide-block');
			$('#add-comment-btn').toggleClass('hide-block');
			$('#form-wrapper').toggleClass('hide-block');
		});

		$('#size-table-link').on('click', () => {
			$('body').css('overflow-y', 'hidden');
			$('#size-modal').toggle();
		});

		$('#size-modal .modal-close').on('click', () => {
			$('#size-modal').toggle();
			$('body').css('overflow-y', 'auto');
		});

		$('#share-btn').on('click', () => {
			$('#share-modal').toggle();
			$('body').css('overflow-y', 'hidden');
		});

		$('#share-modal .modal-close').on('click', () => {
			$('#share-modal').toggle();
			$('body').css('overflow-y', 'auto');
		});
		
		$('#stores-modal .modal-close').on('click', () => {
			$('#stores-modal').toggleClass('active');
			$('body').css('overflow-y', 'auto');
		});
		
		$('.inventory-balances').on('click', () => {
			$('#stores-modal').toggleClass('active');
			$('body').css('overflow-y', 'hidden');
		});

		$('#stores-modal .modal-close').on('click', () => {
			$('#stores-modal').toggleClass('active');
			$('body').css('overflow-y', 'auto');
		});

		$('.inventory-balances').on('click', () => {
			$('#stores-modal').toggleClass('active');
			$('body').css('overflow-y', 'hidden');
		});

		// Product description
		$('.description-title').on('click', function() {
			$(this).parent().toggleClass('active');
			$(this).siblings('.description-content').slideToggle();
		});

		$('#copy-link').on('click', () => {
			let link = $('#link-input').val();
			copyStringToClipboard(link);
		});

		$('#link-input').val(document.location.href);

		$('#comment-form-btn').on('click', function() {

			let href = $(this).attr('href');

			$(href).click();

			$('html, body').animate({
				scrollTop: $(href).offset().top - 150
			}, {
				duration: 370, // по умолчанию «400» 
				easing: "linear" // по умолчанию «swing» 
			});

			return false;
		});

	};
	// Product Slider
	$('#slider').not('.slick-initialized').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		asNavFor: '#slider-nav',
	});

	$('#slider-nav').not('.slick-initialized').slick({
		slidesToShow: 2,
		slidesToScroll: 1,
		vertical: true,
		asNavFor: '#slider',
		nextArrow: $('.next-arrow'),
		prevArrow: $('.prev-arrow')
	});
</script>

<?
global $filter;
$filter = [
	'ID' => $arResult['PROPERTIES']['RECOMMEND']['VALUE']
];
?>

<? if (!empty($filter['ID'])) : ?>

	<div class="recommend">
		<div class="container">
			<div class="headding-wrap">
				<h2 class="catalog-head">С этим товаром также покупают</h2>
			</div>

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
					"FILTER_NAME" => "filter",
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
					"PRICE_CODE" => array(
						0 => "BASE",
					),
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
	</div>

<? endif; ?>
<!-- RECOMMEND products -->

<script>
	BX.message({
		ECONOMY_INFO_MESSAGE: '<?= GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO2') ?>',
		TITLE_ERROR: '<?= GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR') ?>',
		TITLE_BASKET_PROPS: '<?= GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS') ?>',
		BASKET_UNKNOWN_ERROR: '<?= GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
		BTN_SEND_PROPS: '<?= GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS') ?>',
		BTN_MESSAGE_BASKET_REDIRECT: '<?= GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT') ?>',
		BTN_MESSAGE_CLOSE: '<?= GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE') ?>',
		BTN_MESSAGE_CLOSE_POPUP: '<?= GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP') ?>',
		TITLE_SUCCESSFUL: '<?= GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK') ?>',
		COMPARE_MESSAGE_OK: '<?= GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK') ?>',
		COMPARE_UNKNOWN_ERROR: '<?= GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
		COMPARE_TITLE: '<?= GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE') ?>',
		BTN_MESSAGE_COMPARE_REDIRECT: '<?= GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
		PRODUCT_GIFT_LABEL: '<?= GetMessageJS('CT_BCE_CATALOG_PRODUCT_GIFT_LABEL') ?>',
		PRICE_TOTAL_PREFIX: '<?= GetMessageJS('CT_BCE_CATALOG_MESS_PRICE_TOTAL_PREFIX') ?>',
		RELATIVE_QUANTITY_MANY: '<?= CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY']) ?>',
		RELATIVE_QUANTITY_FEW: '<?= CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW']) ?>',
		SITE_ID: '<?= CUtil::JSEscape($component->getSiteId()) ?>'
	});

	var <?= $obName ?> = new JCCatalogElement(<?= CUtil::PhpToJSObject($jsParams, false, true) ?>);
</script>
<?php
unset($actualItem, $itemIds, $jsParams);
