<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
CModule::IncludeModule('iblock');

$images = [];

foreach ($_FILES as $value) {
	$images[] = $value;
}

$comment = [
	'IBLOCK_ID' => '9',
	'NAME' => $_POST['username'],
	'PROPERTY_VALUES' => [
		'PRODUCT_ID' => $_POST['id'],
		'NAME' => $_POST['username'],
		'EMAIL' => $_POST['email'],
		'RATING' => $_POST['rating'],
		'TEXT' => $_POST['message'],
		'IMAGES' => $images,
	],
];

$el = new CIBlockElement;

$res = [
	'status' => $el->Add($comment, false, false, true)
];

echo json_encode($res);
