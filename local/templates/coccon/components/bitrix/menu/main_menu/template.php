<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?

if (!$USER->IsAuthorized()) {
	$favourites = (array) json_decode($_COOKIE['favourites']);
	$count = count($favourites);
} else {
	$connection = Bitrix\Main\Application::getConnection();
	$sqlHelper = $connection->getSqlHelper();

	$sql = 'SELECT count(*) AS c FROM favourites WHERE user_id=' . $sqlHelper->forSql($USER->GetID());
	$recordset = $connection->query($sql);
	$count = $recordset->fetch()['c'];
}

?>

<? if (!empty($arResult)) : ?>
	<ul class="menu" id="menu">
		<?
		foreach ($arResult as $arItem) :
			if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
				continue;
		?>
			<? if ($arItem["SELECTED"]) : ?>
				<li><a href="<?= $arItem["LINK"] ?>" class="selected"><?= $arItem["TEXT"] ?></a></li>
			<? else : ?>
				<li><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
			<? endif ?>

		<? endforeach ?>

		<li class="header__icons--mobil">
			<div class="header__icons">
				<!-- Search -->
				<div class="header__icon search">
					<form action="/search/index.php" method="get" class="search-field">
						<input type="text" class="search__input" placeholder="Введите запрос...">
						<svg class="search__close">
							<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#close"> </use>
						</svg>
					</form>

					<a class="search__icon">
						<svg>
							<use xlink:href="/local/templates/assets/img/sprite.svg#search"> </use>
						</svg>
					</a>

				</div>
				<!-- End Search -->

				<a class="header__icon user" <?= $USER->IsAuthorized() ? 'href="/personal/"' : "" ?>>
					<svg>
						<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#woman"> </use>
					</svg>
				</a>
				<a href="/favourites" class="header__icon heart">
					<svg>
						<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#heart"> </use>
					</svg>
					<div class="header-count<?= !$count ? " hide-block" : '' ?>">
						<span><?= $count ?></span>
					</div>
				</a>

				<? $APPLICATION->IncludeComponent(
					"bitrix:sale.basket.basket.line",
					"cart",
					array(
						"HIDE_ON_BASKET_PAGES" => "Y",    // Не показывать на страницах корзины и оформления заказа
						"PATH_TO_AUTHORIZE" => "",    // Страница авторизации
						"PATH_TO_BASKET" => SITE_DIR . "personal/cart/",    // Страница корзины
						"PATH_TO_ORDER" => SITE_DIR . "personal/order/make/",    // Страница оформления заказа
						"PATH_TO_PERSONAL" => SITE_DIR . "personal/",    // Страница персонального раздела
						"PATH_TO_PROFILE" => SITE_DIR . "personal/",    // Страница профиля
						"PATH_TO_REGISTER" => SITE_DIR . "login/",    // Страница регистрации
						"POSITION_FIXED" => "N",    // Отображать корзину поверх шаблона
						"SHOW_AUTHOR" => "N",    // Добавить возможность авторизации
						"SHOW_EMPTY_VALUES" => "Y",    // Выводить нулевые значения в пустой корзине
						"SHOW_NUM_PRODUCTS" => "Y",    // Показывать количество товаров
						"SHOW_PERSONAL_LINK" => "Y",    // Отображать персональный раздел
						"SHOW_PRODUCTS" => "Y",    // Показывать список товаров
						"SHOW_REGISTRATION" => "Y",    // Добавить возможность регистрации
						"SHOW_TOTAL_PRICE" => "Y",    // Показывать общую сумму по товарам
					),
					false
				); ?>
			</div>
		</li>

	</ul>
<? endif ?>