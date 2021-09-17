<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
// require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

use Bitrix\Sale;

CModule::IncludeModule('iblock');
CModule::IncludeModule('sale');

$basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());

// $basket = \Bitrix\Sale\Basket::create('s1');

$productID = $_GET['id'];

if (!$basket->getExistsItem('catalog', $productID)) {
	$item = $basket->createItem('catalog', $productID);
	$item->setField('QUANTITY', 1);
	$item->setField('CURRENCY', 'RUB');
	$item->setField('PRODUCT_PROVIDER_CLASS', '\Bitrix\Catalog\Product\CatalogProvider');

	echo $basket->save()->isSuccess();
}
