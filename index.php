<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Интернет-магазин \"Одежда\"");

$res = CIBlockElement::GetList(
	array(),
	array(
		"IBLOCK_ID" => 8,
	),
	false,
	false
);

$mailing = [];
while ($obj = $res->GetNextElement()) {
	$mailing['NAME'] = $obj->GetFields()["NAME"];
	$mailing['PREVIEW_TEXT'] = $obj->GetFields()["PREVIEW_TEXT"];
	$mailing['DETAIL_TEXT'] = $obj->GetFields()["DETAIL_TEXT"];
	$mailing['IMG'] = CFile::GetPath($obj->GetFields()["PREVIEW_PICTURE"]);
	break;
}

?>

<? $APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"main_slider",
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "ID",
			1 => "CODE",
			2 => "XML_ID",
			3 => "NAME",
			4 => "TAGS",
			5 => "SORT",
			6 => "PREVIEW_TEXT",
			7 => "PREVIEW_PICTURE",
			8 => "DETAIL_TEXT",
			9 => "DETAIL_PICTURE",
			10 => "DATE_ACTIVE_FROM",
			11 => "ACTIVE_FROM",
			12 => "DATE_ACTIVE_TO",
			13 => "ACTIVE_TO",
			14 => "SHOW_COUNTER",
			15 => "SHOW_COUNTER_START",
			16 => "IBLOCK_TYPE_ID",
			17 => "IBLOCK_ID",
			18 => "IBLOCK_CODE",
			19 => "IBLOCK_NAME",
			20 => "IBLOCK_EXTERNAL_ID",
			21 => "DATE_CREATE",
			22 => "CREATED_BY",
			23 => "CREATED_USER_NAME",
			24 => "TIMESTAMP_X",
			25 => "MODIFIED_BY",
			26 => "USER_NAME",
			27 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "6",
		"IBLOCK_TYPE" => "main_slider",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "BTN_TEXT",
			1 => "LINK",
			2 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "main_slider"
	),
	false
); ?>

<section class="news">
	<div class="headding-wrap">
		<h2 class="heading">
			Новинки
			<div>
				<span>new</span>
			</div>
		</h2>
	</div>

	<div class="container products-wrapper">

		<div class="product-item">
			<div class="img">
				<img src="<?= TEMPLATE_PATH ?>/assets/img/products/product1.jpg" alt="">
				<a href="#" class="heart">
					<svg>
						<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#heart"> </use>
					</svg>
				</a>
				<a href="#" class="cart">
					<svg>
						<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#shopping-bags"> </use>
					</svg>
				</a>
			</div>

			<div class="desc">
				Платье-жилет из хлопка
			</div>

			<div class="price">
				3 500 ₽
			</div>
		</div>

		<div class="product-item">
			<div class="img">
				<img src="<?= TEMPLATE_PATH ?>/assets/img/products/product2.jpg" alt="">
				<a href="#" class="heart">
					<svg>
						<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#heart"> </use>
					</svg>
				</a>
				<a href="#" class="cart">
					<svg>
						<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#shopping-bags"> </use>
					</svg>
				</a>
			</div>

			<div class="desc">
				Платье-жилет из хлопка
			</div>

			<div class="price">
				3 500 ₽
			</div>
		</div>

		<div class="product-item">
			<div class="img">
				<img src="<?= TEMPLATE_PATH ?>/assets/img/products/product3.jpg" alt="">
				<a href="#" class="heart">
					<svg>
						<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#heart"> </use>
					</svg>
				</a>
				<a href="#" class="cart">
					<svg>
						<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#shopping-bags"> </use>
					</svg>
				</a>
			</div>

			<div class="desc">
				Платье-жилет из хлопка
			</div>

			<div class="price">
				3 500 ₽
			</div>
		</div>

		<div class="product-item">
			<div class="img">
				<img src="<?= TEMPLATE_PATH ?>/assets/img/products/product4.jpg" alt="">
				<a href="#" class="heart">
					<svg>
						<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#heart"> </use>
					</svg>
				</a>
				<a href="#" class="cart">
					<svg>
						<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#shopping-bags"> </use>
					</svg>
				</a>
			</div>

			<div class="desc">
				Платье-жилет из хлопка
			</div>

			<div class="price">
				3 500 ₽
			</div>
		</div>

	</div>
</section>

<section class="mailing" style="background-image: url(<?= $mailing['IMG'] ?>); display:flex; background-color: #F0F7FB">
	<div class="container">
		<h2 class="title"><?= $mailing['NAME'] ?></h2>
		<p class="desc"><?= $mailing['PREVIEW_TEXT'] ?></p>
		<!-- <form action="" class="mailing-form"> -->
		<!-- <input id="email" type="text" placeholder="Ваш E-mail">
			<input id="submit" type="submit" value="Подписаться"> -->
		<? $APPLICATION->IncludeComponent(
			"asd:subscribe.quick.form",
			"subscribe",
			array(),
			false
		); ?><br>
		<!-- </form> -->
		<p class="subdesc">
			<?= $mailing['DETAIL_TEXT'] ?>
		</p>
	</div>
</section>

<section class="category container">
	<div class="center">
		<h2 class="heading">
			Популярные категории
			<div><span>popular</span></div>
		</h2>
	</div>

	<div class="categry-wrapper">

		<div class="category-items">

			<div class="item">
				<div class="img">
					<img src="<?= TEMPLATE_PATH ?>/assets/img/category/category1.jpg" alt="">
				</div>
				<div class="name">
					Платья
				</div>
			</div>

			<div class="item">
				<div class="img">
					<img src="<?= TEMPLATE_PATH ?>/assets/img/category/category1.jpg" alt="">
				</div>
				<div class="name">
					Кардиганы
				</div>
			</div>

		</div>

		<div class="category-items">

			<div class="item">
				<div class="img">
					<img src="<?= TEMPLATE_PATH ?>/assets/img/category/category1.jpg" alt="">
				</div>
				<div class="name">
					Платья
				</div>
			</div>

			<div class="item">
				<div class="img">
					<img src="<?= TEMPLATE_PATH ?>/assets/img/category/category1.jpg" alt="">
				</div>
				<div class="name">
					Кардиганы
				</div>
			</div>

		</div>

		<div class="category-items">

			<div class="item">
				<div class="img">
					<img src="<?= TEMPLATE_PATH ?>/assets/img/category/category1.jpg" alt="">
				</div>
				<div class="name">
					Платья
				</div>
			</div>

			<div class="item">
				<div class="img">
					<img src="<?= TEMPLATE_PATH ?>/assets/img/category/category1.jpg" alt="">
				</div>
				<div class="name">
					Кардиганы
				</div>
			</div>

		</div>

		<div class="category-items">

			<div class="item">
				<div class="img">
					<img src="<?= TEMPLATE_PATH ?>/assets/img/category/category1.jpg" alt="">
				</div>
				<div class="name">
					Платья
				</div>
			</div>

			<div class="item">
				<div class="img">
					<img src="<?= TEMPLATE_PATH ?>/assets/img/category/category1.jpg" alt="">
				</div>
				<div class="name">
					Кардиганы
				</div>
			</div>

		</div>

		<span class="btn">
			Больше категорий
		</span>

	</div>

</section>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>