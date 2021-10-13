<?
define("HIDE_SIDEBAR", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
?>
<?

// Создание скидок

$DISCOUNT_VALUE = 40; //процент скидки
$arItemIds = [42]; //Массив с ID элементов товаров

$arDiscountFields = [
	"LID" => SITE_ID,
	"SITE_ID" => SITE_ID,
	"NAME" => "Скидка " . $DISCOUNT_VALUE . "%",
	"DISCOUNT_VALUE" => $DISCOUNT_VALUE,
	"DISCOUNT_TYPE" => "P",
	"LAST_LEVEL_DISCOUNT" => "Y",
	"LAST_DISCOUNT" => "Y",
	"ACTIVE" => "Y",
	"CURRENCY" => "EUR",
	"USER_GROUPS" => [2],
	'ACTIONS' => [
		"CLASS_ID" => "CondGroup",
		"DATA" => [
			"All" => "AND"
		],
		"CHILDREN" => [
			[
				"CLASS_ID" => "ActSaleBsktGrp",
				"DATA" => [
					"Type" => "Discount",
					"Value" => $DISCOUNT_VALUE,
					"Unit" => "Perc",
					"Max" => 0,
					"All" => "OR",
					"True" => "True",
				],
				"CHILDREN" => [
					[
						"CLASS_ID" => "ActSaleSubGrp",
						"DATA" => [
							"All" => "AND",
							"True" => "True",
						],
						"CHILDREN" => [
							[
								"CLASS_ID" => "CondBsktFldProduct",
								"DATA" => [
									"logic" => "Equal",
									"value" => $arItemIds,
								]
							]
						]
					]
				]
			]
		]
	],
	"CONDITIONS" =>  [
		'CLASS_ID' => 'CondGroup',
		'DATA' => [
			'All' => 'AND',
			'True' => 'True',
		],
	]
];
// $iDiscountNumber = \CSaleDiscount::Add($arDiscountFields);

?>

<div class="container">

	<? $APPLICATION->IncludeComponent(
		"bitrix:breadcrumb",
		"main_breadcrumb",
		array(
			"PATH" => "",
			"SITE_ID" => "s1",
			"START_FROM" => "0",
			"COMPONENT_TEMPLATE" => "main_breadcrumb"
		),
		false
	); ?>

	<? $APPLICATION->IncludeComponent(
	"asd:sale.order.ajax", 
	"order", 
	array(
		"ACTION_VARIABLE" => "soa-action",
		"ADDITIONAL_PICT_PROP_2" => "-",
		"ADDITIONAL_PICT_PROP_3" => "-",
		"ALLOW_APPEND_ORDER" => "Y",
		"ALLOW_AUTO_REGISTER" => "Y",
		"ALLOW_NEW_PROFILE" => "N",
		"ALLOW_USER_PROFILES" => "N",
		"BASKET_IMAGES_SCALING" => "standard",
		"BASKET_POSITION" => "after",
		"COMPATIBLE_MODE" => "Y",
		"DELIVERIES_PER_PAGE" => "9",
		"DELIVERY_FADE_EXTRA_SERVICES" => "N",
		"DELIVERY_NO_AJAX" => "N",
		"DELIVERY_NO_SESSION" => "Y",
		"DELIVERY_TO_PAYSYSTEM" => "d2p",
		"DISABLE_BASKET_REDIRECT" => "N",
		"EMPTY_BASKET_HINT_PATH" => "/",
		"HIDE_ORDER_DESCRIPTION" => "N",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
		"PATH_TO_AUTH" => "/auth/",
		"PATH_TO_BASKET" => "/personal/cart/",
		"PATH_TO_PAYMENT" => "payment.php",
		"PATH_TO_PERSONAL" => "index.php",
		"PAY_FROM_ACCOUNT" => "Y",
		"PAY_SYSTEMS_PER_PAGE" => "9",
		"PICKUPS_PER_PAGE" => "5",
		"PICKUP_MAP_TYPE" => "yandex",
		"PRODUCT_COLUMNS_HIDDEN" => array(
		),
		"PRODUCT_COLUMNS_VISIBLE" => array(
		),
		"PROPS_FADE_LIST_1" => array(
		),
		"PROPS_FADE_LIST_2" => array(
		),
		"SEND_NEW_USER_NOTIFY" => "Y",
		"SERVICES_IMAGES_SCALING" => "standard",
		"SET_TITLE" => "Y",
		"SHOW_BASKET_HEADERS" => "N",
		"SHOW_COUPONS" => "Y",
		"SHOW_COUPONS_BASKET" => "Y",
		"SHOW_COUPONS_DELIVERY" => "Y",
		"SHOW_COUPONS_PAY_SYSTEM" => "Y",
		"SHOW_DELIVERY_INFO_NAME" => "Y",
		"SHOW_DELIVERY_LIST_NAMES" => "Y",
		"SHOW_DELIVERY_PARENT_NAMES" => "Y",
		"SHOW_MAP_IN_PROPS" => "N",
		"SHOW_NEAREST_PICKUP" => "N",
		"SHOW_NOT_CALCULATED_DELIVERIES" => "L",
		"SHOW_ORDER_BUTTON" => "final_step",
		"SHOW_PAY_SYSTEM_INFO_NAME" => "Y",
		"SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",
		"SHOW_PICKUP_MAP" => "Y",
		"SHOW_STORES_IMAGES" => "Y",
		"SHOW_TOTAL_ORDER_BUTTON" => "Y",
		"SHOW_VAT_PRICE" => "Y",
		"SKIP_USELESS_BLOCK" => "Y",
		"SPOT_LOCATION_BY_GEOIP" => "Y",
		"TEMPLATE_LOCATION" => "popup",
		"TEMPLATE_THEME" => "blue",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "0",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"USE_CUSTOM_ADDITIONAL_MESSAGES" => "N",
		"USE_CUSTOM_ERROR_MESSAGES" => "N",
		"USE_CUSTOM_MAIN_MESSAGES" => "N",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_PHONE_NORMALIZATION" => "Y",
		"USE_PRELOAD" => "N",
		"USE_PREPAYMENT" => "N",
		"USE_YM_GOALS" => "N",
		"COMPONENT_TEMPLATE" => "order"
	),
	false
); ?>

</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>