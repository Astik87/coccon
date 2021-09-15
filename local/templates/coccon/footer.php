<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<footer>
	<div class="container footer">
		<div class="logo">
			<a href="/">
				<img src="<?= TEMPLATE_PATH ?>/assets/img/logo.png" alt="">
				<span>Вязаные тренды</span>
			</a>
		</div>

		<div class="bottom-menu">
			<? $APPLICATION->IncludeComponent(
				"bitrix:menu",
				"bottom_menu",
				array(
					"ALLOW_MULTI_SELECT" => "N",
					"CHILD_MENU_TYPE" => "kompaniya",
					"DELAY" => "N",
					"MAX_LEVEL" => "1",
					"MENU_CACHE_GET_VARS" => array(""),
					"MENU_CACHE_TIME" => "3600",
					"MENU_CACHE_TYPE" => "N",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"ROOT_MENU_TYPE" => "kompaniya",
					"USE_EXT" => "N",
					"TITLE" => "Компания"
				)
			); ?>

			<? $APPLICATION->IncludeComponent(
				"bitrix:menu",
				"bottom_menu",
				array(
					"ALLOW_MULTI_SELECT" => "N",
					"CHILD_MENU_TYPE" => "poleznoe",
					"DELAY" => "N",
					"MAX_LEVEL" => "1",
					"MENU_CACHE_GET_VARS" => array(""),
					"MENU_CACHE_TIME" => "3600",
					"MENU_CACHE_TYPE" => "N",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"ROOT_MENU_TYPE" => "poleznoe",
					"USE_EXT" => "N",
					"TITLE" => "Полезное"
				)
			); ?>

			<? $APPLICATION->IncludeComponent(
				"bitrix:menu",
				"bottom_menu",
				array(
					"ALLOW_MULTI_SELECT" => "N",
					"CHILD_MENU_TYPE" => "pokupatelyu",
					"DELAY" => "N",
					"MAX_LEVEL" => "1",
					"MENU_CACHE_GET_VARS" => array(""),
					"MENU_CACHE_TIME" => "3600",
					"MENU_CACHE_TYPE" => "N",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"ROOT_MENU_TYPE" => "pokupatelyu",
					"USE_EXT" => "N",
					"TITLE" => "Покупателю"
				)
			); ?>

		</div>

		<div class="contacts">
			<h3 class="title">Мы в социальных сетях</h3>
			<div class="social">
				<div class="item">
					<a href="<?= $DATA[0]['DATA_TELEGRAM']['VALUE'] ?>">
						<svg>
							<use xlink:href="<?= TEMPLATE_PATH . '/assets/img/sprite.svg#telegram' ?>"> </use>
						</svg>
					</a>
				</div>

				<div class="item">
					<a href="<?= $DATA[0]['DATA_WHATSAPP']['VALUE'] ?>">
						<svg>
							<use xlink:href="<?= TEMPLATE_PATH . '/assets/img/sprite.svg#whatsapp' ?>"> </use>
						</svg>
					</a>
				</div>

				<div class="item">
					<a href="<?= $DATA[0]['DATA_INSTAGRAM']['VALUE'] ?>"><img src="<?= TEMPLATE_PATH . '/assets/img/instagram.png' ?>"> </img></a>
				</div>
			</div>
		</div>
	</div>
</footer>
</div>
<script src="<?= TEMPLATE_PATH ?>/assets/js/main.min.js"></script>
</body>

</html>