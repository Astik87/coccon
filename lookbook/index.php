<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Lookbook");
?>

<?

$res = CIBlockElement::GetList(
	array(),
	array(
		"IBLOCK_ID" => 10,
	),
	false,
	false
);

$lookbooks = [];

while ($obj = $res->GetNextElement()) {
	$lookbooks[] = [
		'IMAGE' => CFile::GetPath($obj->GetProperties()['IMAGE']['VALUE']),
		'LINK' => $obj->GetProperties()['LINK']['VALUE'],
	];
}
?>

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
</div>

<div class="headding-wrap">
	<? $APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => TEMPLATE_PATH . "/../../include/lookbook/lookbook_title.php"
		)
	); ?>
</div>
<div class="container center">


	<div class="categry-wrapper lookbook">

		<div class="category-items">
			<div class="item">
				<a href="<?= $lookbooks[0]['LINK'] ?>">
					<img src="<?= $lookbooks[0]['IMAGE'] ?>" alt="">
				</a>
			</div>

			<div class="item">
				<a href="<?= $lookbooks[1]['LINK'] ?>">
					<img src="<?= $lookbooks[1]['IMAGE'] ?>" alt="">
				</a>
			</div>
		</div>

		<div class="category-items">
			<div class="item">
				<a href="<?= $lookbooks[2]['LINK'] ?>">
					<img src="<?= $lookbooks[2]['IMAGE'] ?>" alt="">
				</a>
			</div>

			<div class="item">
				<a href="<?= $lookbooks[3]['LINK'] ?>">
					<img src="<?= $lookbooks[3]['IMAGE'] ?>" alt="">
				</a>
			</div>
		</div>

		<div class="item item-center">
			<a href="<?= $lookbooks[4]['LINK'] ?>">
				<img src="<?= $lookbooks[4]['IMAGE'] ?>" alt="">
			</a>
		</div>

	</div>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>