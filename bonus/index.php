<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Бонусная система");
?>
<div class="bonus-wrapper">

	<div class="container">

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
					"PATH" => "../include/bonus/title.php"
				)
			); ?>
		</div>

		<div class="blocks">

			<?
			CModule::IncludeModule("iblock");
			$arFilter = array("IBLOCK_ID" => 14, "ACTIVE" => "Y");
			$res = CIBlockElement::GetList(array(), $arFilter, false, array(), array());
			while ($ob = $res->GetNextElement()) {
				$arFields = $ob->GetProperties();
				$name = $ob->GetFields()['NAME'];
				$title = $arFields['TITLE']['VALUE'];
				$text = $arFields['TEXT']['VALUE']['TEXT'];
				$img = CFile::GetPath($arFields['IMAGE']['VALUE']);
			?>

				<div class="item" style="background-image: url(<?= TEMPLATE_PATH ?>/assets/img/bonus/bg.jpg);">
					<div class="left">
						<div class="title">
							<?= $name ?>
						</div>
						<span class="detaile">
							Подробнее
							<svg>
								<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#vector"> </use>
							</svg>
						</span>
					</div>

					<div class="right">
						<img src="<?= $img ?>" alt="">
					</div>

					<div class="content" style="background-image: url(<?= TEMPLATE_PATH ?>/assets/img/bonus/bg.jpg);">
						<div class="title">
							<?= $title ?>
						</div>
						<div class="text">
							<?= $text ?>
						</div>
						<span class="back">
							<svg>
								<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#vector"> </use>
							</svg>
							Назад
						</span>
					</div>

					<div class="content-mobile">
						<div class="md-wrapper">
							<div class="center-content" style="background-image: url(<?= TEMPLATE_PATH ?>/assets/img/bonus/bg.jpg);">
								<div class="modal-close">
									<span></span>
									<span></span>
								</div>

								<div class="title">
									<?= $name ?>
								</div>
								<div class="text">
									<?= $text ?>
								</div>
							</div>
						</div>
					</div>
				</div>

			<?
			}
			?>

		</div>

	</div>

</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>