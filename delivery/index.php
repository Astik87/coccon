<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Доставка и оплата");
?>

<div class="container delivery-wrapper">

	<? $APPLICATION->IncludeComponent(
		"bitrix:breadcrumb",
		"main_breadcrumb",
		array(
			"PATH" => "",
			"SITE_ID" => "s1",
			"START_FROM" => "0"
		)
	); ?>

	<div class="center">
		<? $APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			array(
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "inc",
				"EDIT_TEMPLATE" => "",
				"PATH" => "../include/delivery/delivery_title.php"
			)
		); ?>
	</div>

	<div class="delivery-block">
		<div class="text list content-title">

			<h2>Регистрация</h2>

			<h3>Для осуществления заказа регистрация на сайте обязательна.</h3>

			<ul>
				<li>Оформить Заказ в Интернет-магазине могут только зарегистрированные Покупатели.</li>
				<li>Продавец не несет ответственности за точность и правильность информации, предоставляемой Покупателем при регистрации.</li>
				<li>Покупатель, зарегистрировавшийся в Интернет-магазине, получает индивидуальную идентификацию путем предоставления логина и пароля.</li>
				<li>Индивидуальная идентификация Покупателя позволяет избежать несанкционированных действий третьих лиц от имени Покупателя и открывает доступ к дополнительным сервисам. Передача Покупателем логина и пароля третьим лицам запрещена.</li>
			</ul>

			<h2>Оплата</h2>

			<ul>
				<li>Заказ оплачивается 100% предоплатой банковским переводом на расчетный счет Продавца в Сбербанке России.</li>
				<li>Оплата заказа производится только после подтверждения менеджером о наличии готового изделия.</li>
				<li>Наложенный платеж увеличивает стоимость заказа на 20%, и возможен при условии предоплаты стоимости доставки.</li>
			</ul>

		</div>
		<div class="img">
			<? $APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				array(
					"AREA_FILE_SHOW" => "file",
					"AREA_FILE_SUFFIX" => "inc",
					"EDIT_TEMPLATE" => "",
					"PATH" => "../include/delivery/img1.php"
				)
			); ?>
		</div>
	</div>

	<div class="delivery-block">

		<div class="img">
			<? $APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				array(
					"AREA_FILE_SHOW" => "file",
					"AREA_FILE_SUFFIX" => "inc",
					"EDIT_TEMPLATE" => "",
					"PATH" => "../include/delivery/img2.php"
				)
			); ?>
		</div>
		<div class="text list content-title">

			<h2>Доставка и упаковка</h2>

			<ul>
				<li>Доставка курьером по Казани 300 рублей.</li>
				<li>Стоимость доставки 350 рублей для центральной полосы России. Для более отдаленных регионов возможны повышенные тарифы, уточняйте у менеджера СOCCON.</li>
				<li>Доставку по России осуществляем ТК СДЭК и Почта России.</li>
				<li>Интернет-магазин COCCON не несет ответственности за риск утери или повреждения товара после передачи его Перевозчику.</li>
				<li>Для перевозки транспортной компанией заказ поставляется трижды упакованным в полиэтиленовые пакеты.</li>
				<li>Товар страхуется на полную стоимость, если иное не указал покупатель в момент оформления заказа.</li>
			</ul>

			<h2>Сроки и стоимость</h2>

			<ul>
				<li>Срок доставки зависит от удаленности вашего региона от Казани, при расчете стоимости доставки уточняйте у менеджера COCCON примерные сроки.</li>
				<li>При наличии изделия, заказ отправляется Покупателю в течении 2 дней (после оплаты).</li>
				<li>Срок поставки изделия, которого нет в наличии на момент оформления заказа обсуждается индивидуально с менеджером СOCCON.</li>
			</ul>

		</div>

	</div>

</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>