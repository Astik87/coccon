<?

if (!empty($_POST)) {
	require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
  \Bitrix\Main\Context::getCurrent()->getResponse()->writeHeaders();
}


if (empty($_POST)) {
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Оптовым покупателям");

?>

<div class="container">
<?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"main_breadcrumb",
	Array(
		"PATH" => "",
		"SITE_ID" => "s1",
		"START_FROM" => "0"
	)
);?> 
	<div class="shopper-wrapper">
		<div class="left">

			<? $APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "../include/shopper/title.php"
					)
				); ?>

				<div class="desc">
					Для сотрудничества с нами просим заполнить информацию в форме. После ознакомления мы с вами свяжемся.
				</div>

				<div class="form">
<? } ?>
	<?$APPLICATION->IncludeComponent(
	"asd:shopper.feedback", 
	".default", 
	array(
		"EMAIL_TO" => "astiksheriev@yandex.ru",
		"EVENT_MESSAGE_ID" => array(
			0 => "52",
		),
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"REQUIRED_FIELDS" => array(
			0 => "NAME",
			1 => "EMAIL",
			2 => "MESSAGE",
		),
		"USE_CAPTCHA" => "N",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>

<? if(empty($_POST)) { ?>
				</div>

		</div>
		</div>

		<div class="right">
		<? $APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				array(
					"AREA_FILE_SHOW" => "file",
					"AREA_FILE_SUFFIX" => "inc",
					"EDIT_TEMPLATE" => "",
					"PATH" => "../include/shopper/img.php"
				)
			); ?>
		</div>

	</div>
</div>

<div class="md-wrapper shopper-modal">
	<div class="shopper-seccess">
		<div class="modal-close">
			<span></span>
			<span></span>
		</div>
		<span class="title">Ваша заявка отправлена</span>
		<span class="text">После ознакомления мы с вами свяжемся для уточнения деталей.</span>
	</div>
</div>

<script>
	$('.shopper-seccess .modal-close').on('click', () => {
		$('.shopper-modal').css('display', 'none');
	});
</script>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
}
?>