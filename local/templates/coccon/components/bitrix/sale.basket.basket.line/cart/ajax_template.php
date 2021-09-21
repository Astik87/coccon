<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

$this->IncludeLangFile('template.php');

$cartId = $arParams['cartId'];

require(realpath(dirname(__FILE__)) . '/top_template.php');

if ($arParams["SHOW_PRODUCTS"] == "Y") {
	// debuger($arResult);
?>

	<div data-role="basket-item-list" class="bx-basket-item-list hide-block">

		<? if ($arParams["POSITION_FIXED"] == "Y") : ?>
			<div id="<?= $cartId ?>status" class="bx-basket-item-list-action" onclick="<?= $cartId ?>.toggleOpenCloseCart()"><?= GetMessage("TSB1_COLLAPSE") ?></div>
		<? endif ?>

		<? if ($arParams["PATH_TO_ORDER"] && $arResult["CATEGORIES"]["READY"]) : ?>
			<div class="bx-basket-item-list-button-container">
				<a href="<?= $arParams["PATH_TO_ORDER"] ?>" class="btn btn-primary"><?= GetMessage("TSB1_2ORDER") ?></a>
			</div>
		<? endif ?>

		<div id="<?= $cartId ?>products" class="bx-basket-item-list-container">
			<? foreach ($arResult["CATEGORIES"] as $category => $items) :
				if (empty($items))
					continue;
			?>
				<div class="bx-basket-item-list-item-status hide-block"><?= GetMessage("TSB1_$category") ?></div>
				<? foreach ($items as $v) : ?>
					<div class="bx-basket-item-list-item">
						<div class="bx-basket-item-list-item-img">
							<? if ($arParams["SHOW_IMAGE"] == "Y" && $v["PICTURE_SRC"]) : ?>
								<? if ($v["DETAIL_PAGE_URL"]) : ?>
									<a href="<?= $v["DETAIL_PAGE_URL"] ?>"><img src="<?= $v["PICTURE_SRC"] ?>" alt="<?= $v["NAME"] ?>"></a>
								<? else : ?>
									<img src="<?= $v["PICTURE_SRC"] ?>" alt="<?= $v["NAME"] ?>" />
								<? endif ?>
							<? endif ?>
							<div class="bx-basket-item-list-item-remove" onclick="<?= $cartId ?>.removeItemFromCart(<?= $v['ID'] ?>)" title="<?= GetMessage("TSB1_DELETE") ?>"></div>
						</div>
						<div class="bx-basket-item-list-item-name">
							<? if ($v["DETAIL_PAGE_URL"]) : ?>
								<a href="<?= $v["DETAIL_PAGE_URL"] ?>"><?= $v["NAME"] ?></a>
							<? else : ?>
								<?= $v["NAME"] ?>
							<? endif ?>
						</div>
						<? if (true) :/*$category != "SUBSCRIBE") TODO */ ?>
							<div class="bx-basket-item-list-item-price-block">
								<? if ($arParams["SHOW_PRICE"] == "Y") : ?>
									<div class="bx-basket-item-list-item-price"><strong><?= $v["PRICE_FMT"] ?></strong></div>
									<? if ($v["FULL_PRICE"] != $v["PRICE_FMT"]) : ?>
										<div class="bx-basket-item-list-item-price-old"><?= $v["FULL_PRICE"] ?></div>
									<? endif ?>
								<? endif ?>
								<? if ($arParams["SHOW_SUMMARY"] == "Y") : ?>
									<div class="bx-basket-item-list-item-price-summ">
										<strong><?= $v["QUANTITY"] ?></strong> <?= $v["MEASURE_NAME"] ?> <?= GetMessage("TSB1_SUM") ?>
										<strong><?= $v["SUM"] ?></strong>
									</div>
								<? endif ?>
							</div>
						<? endif ?>
					</div>
				<? endforeach ?>
			<? endforeach ?>
		</div>
	</div>


	<span href="#" class="header__icon cart">
		<svg onclick="toggleCart()">
			<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#shopping-bags"> </use>
		</svg>

		<div class="header-count<?= $arResult['NUM_PRODUCTS'] ? "" : " hide-block" ?>" onclick="toggleCart()">
			<span><?= $arResult['NUM_PRODUCTS'] ?></span>
		</div>

		<div class="cart-modal" id="cart-modal">

			<div class="modal-close" onclick="toggleCart()">
				<span></span>
				<span></span>
			</div>

			<div class="scrollbar">

				<? if (empty($items)) : ?>
					<div class="empty">
						<span>Корзина пуста</span>
					</div>
				<? endif; ?>

				<? foreach ($items as $v) : ?>

					<?

					$res = [];

					$productInfo = CCatalogSku::GetProductInfo($v['PRODUCT_ID']);

					CModule::IncludeModule("iblock");
					$arFilter = array("IBLOCK_ID" => 2, "ID" => $productInfo['ID'], "ACTIVE" => "Y");
					$iblock = CIBlockElement::GetList(array(), $arFilter, false, array(), array());
					while ($ob = $iblock->GetNextElement()) {
						$res['ARTNUMBER'] = $ob->GetProperties()['ARTNUMBER']['VALUE'];
					}

					$rsOffers = CIBlockElement::GetList(
						array(), // Свойства, по которым идет сортировка
						array('IBLOCK_ID' => 3, 'ID' => $v['PRODUCT_ID'], "ACTIVE" => "Y"), // Фильтрация
						false,
						false,
						array("ID", "IBLOCK_ID", "PROPERTY_LENGTH_WIDTH", "NAME", 'PROPERTY_THIKNESS_HEIGHT', 'PROPERTY_SIZES_CLOTHES', 'PROPERTY_COLOR_REF', 'CATALOG_GROUP_1') // Свойства, которые нужно получить.
					);

					$offer = $rsOffers->GetNext();

					$arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById(2)->fetch();
					$obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
					$strEntityDataClass = $obEntity->getDataClass();
					$resData = $strEntityDataClass::getList(array(
						'select' => array('ID', 'UF_NAME', 'UF_XML_ID'),
						'filter' => array('UF_XML_ID' => $offer['PROPERTY_COLOR_REF_VALUE']),
						'order'  => array('ID' => 'ASC'),
						'limit'  => 10000,
					));

					$arItem = $resData->Fetch();

					$res["COLOR"] = $arItem["UF_NAME"];
					$res['PROPERTY_SIZES_CLOTHES_VALUE'] = $offer['PROPERTY_SIZES_CLOTHES_VALUE'];

					?>

					<div href="<?= $v['DETAIL_PAGE_URL'] ?>" class="cart-item">
						<div class="img">
							<a href="<?= $v['DETAIL_PAGE_URL'] ?>">
								<img src="<?= $v["PICTURE_SRC"] ?>" alt="">
							</a>
						</div>
						<div class="cart-detail">
							<a href="<?= $v['DETAIL_PAGE_URL'] ?>">
								<div class="artnumber">
									Артикул: <?= $res['ARTNUMBER'] ?>
								</div>
							</a>
							<div class="title">
								<a href="<?= $v['DETAIL_PAGE_URL'] ?>" class="product-name"><?= $v["NAME"] ?></a>
								<span class="del" onclick="<?= $cartId ?>.removeItemFromCart(<?= $v['ID'] ?>)">
									<svg>
										<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#del"> </use>
									</svg>
								</span>
							</div>
							<a class="h-100" href="<?= $v['DETAIL_PAGE_URL'] ?>">
								<span class="color">Цвет: <?= $res["COLOR"] ?></span>
								<span class="size">Размер: <?= $res["PROPERTY_SIZES_CLOTHES_VALUE"] ?></span>
								<div class="price--cart">
									<span class="count">
										<?= $v["QUANTITY"] ?> x
										<? if ($v['FULL_PRICE'] != $v['PRICE_FORMATED']) : ?>
											<strike>&nbsp<?= $v['FULL_PRICE'] ?></strike>&nbsp<span><?= $v['PRICE_FORMATED'] ?></span>
										<? else : ?>
											<?= $v['FULL_PRICE'] ?>
										<? endif; ?>
									</span>
									<span class="item-price">
										<?= $v["SUM"] ?>
									</span>
								</div>
							</a>
						</div>
					</div>

				<? endforeach; ?>
			</div>
			<div class="total-price">
				<span>Итого</span>
				<span><?= $arResult['TOTAL_PRICE'] ?></span>
			</div>

			<!-- <div class="making btn"> -->
			<a class="btn making" href="/personal/order/make/">
				Перейти к оформлению
			</a>
			<!-- </div> -->
		</div>

	</span>
	<script>
		BX.ready(function() {
			<?= $cartId ?>.fixCart();
		});
	</script>
<?
}
