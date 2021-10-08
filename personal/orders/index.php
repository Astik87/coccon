<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
$APPLICATION->AddChainItem('Мои заказы', '/personal/orders');
?>

<div class="container personal-wrapper">

	<? $APPLICATION->IncludeComponent(
		"bitrix:breadcrumb",
		"main_breadcrumb",
		array(
			"PATH" => "/personal",
			"SITE_ID" => "s1",
			"START_FROM" => "0",
			"COMPONENT_TEMPLATE" => "main_breadcrumb"
		),
		false
	); ?>

	<div class="tabs__caption" data-id="private">
		<a href="/personal/private" class="item">
			Личные данные
		</a>

		<a href="/personal/orders" class="item active">
			Мои заказы
		</a>

		<a href="/personal/account" class="item">
			Бонусы
		</a>
	</div>

	<div class="tabs__content" id="private">

		<?
		// LocalRedirect('/personal/');

		$APPLICATION->IncludeComponent(
			"bitrix:sale.personal.order.list",
			"orders",
			array(
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"CACHE_GROUPS" => "Y",
				"CACHE_TIME" => "3600",
				"CACHE_TYPE" => "A",
				"DEFAULT_SORT" => "STATUS",
				"DISALLOW_CANCEL" => "N",
				"HISTORIC_STATUSES" => array(
					0
				),
				"ID" => $ID,
				"NAV_TEMPLATE" => "Мои заказы",
				"ORDERS_PER_PAGE" => "20",
				"PATH_TO_BASKET" => "",
				"PATH_TO_CANCEL" => "",
				"PATH_TO_CATALOG" => "/catalog/",
				"PATH_TO_COPY" => "",
				"PATH_TO_DETAIL" => "",
				"PATH_TO_PAYMENT" => "payment.php",
				"REFRESH_PRICES" => "N",
				"RESTRICT_CHANGE_PAYSYSTEM" => array(
					0 => "0",
				),
				"SAVE_IN_SESSION" => "Y",
				"SET_TITLE" => "Y",
				"STATUS_COLOR_F" => "gray",
				"STATUS_COLOR_N" => "green",
				"STATUS_COLOR_P" => "yellow",
				"STATUS_COLOR_PSEUDO_CANCELLED" => "red",
				"COMPONENT_TEMPLATE" => "orders"
			),
			false
		);

		?>

	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>