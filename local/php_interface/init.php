<?php

use Bitrix\Main\Loader;

Define("TEMPLATE_PATH", "/local/templates");

function debuger($var, $all = false, $die = false)
{
    global $USER;
    if (($USER->GetID() == 1) || ($all == true)) {
        $bt =  debug_backtrace();
        $bt = $bt[0];
        $dRoot = $_SERVER["DOCUMENT_ROOT"];
        $dRoot = str_replace("/", "\\", $dRoot);
        $bt["file"] = str_replace($dRoot, "", $bt["file"]);
        $dRoot = str_replace("\\", "/", $dRoot);
        $bt["file"] = str_replace($dRoot, "", $bt["file"]);
?>
        <div style='font-size:9pt; color:#000; background:#fff; border:1px dashed #000;'>
            <div style='padding:3px 5px; background:#99CCFF; font-weight:bold;'>File: <?= $bt["file"] ?> [<?= $bt["line"] ?>]</div>
            <pre style='padding:10px;'><? print_r($var) ?></pre>
        </div>
<?
    }
    if ($die) {
        die;
    }
}


AddEventHandler("main", "OnBeforeEventAdd", array("MailEventHandler", "onBeforeEventAddHandler"));

class MailEventHandler
{
    static function onBeforeEventAddHandler(&$event, &$lid, &$arFields, &$message_id, &$files)
    {
        // Меняем тип почтового события и ID почтового шаблона на свои
        if ($event === 'FORM_FILLING_SIMPLE_FORM_1') {

            if (!is_array($files)) $files = [];

            foreach ($arFields as $key => $field) {

                if ($link = self::getLinkFromField($field)) {

                    if ($arFile = self::getFileFromLink($link)) {

                        $files[] = $arFile['FILE_ID'];
                    }
                }
            }
        }
    }

    // Ищем ссылки на скачивания файлов в письме
    static function getLinkFromField($field)
    {
        // Укажите https или http, в зависимости от того, как работает ваш сайт
        preg_match("/(https\:.*form_show_file.*action\=download)/", $field, $out);
        return ($out[1] ?: false);
    }


    static function getFileFromLink($link)
    {
        $uri = new \Bitrix\Main\Web\Uri($link);
        parse_str($uri->getQuery(), $query);
        return CFormResult::GetFileByHash($query["rid"], $query["hash"]);
    }
}

AddEventHandler("sale", "OnSaleStatusOrder", "OrderComplete");
function OrderComplete($orderID, &$arFields)
{
    Loader::includeModule("sale");
    if ($arFields == 'F') {
        $order = \Bitrix\Sale\Order::load($orderID);

        $scores = 0;

        foreach ($order->getBasket() as $item) {
            $id = $item->getField('PRODUCT_ID');
            $count = $item->getField('QUANTITY');

            $rsOffers = CIBlockElement::GetList(
                array(), // Свойства, по которым идет сортировка
                array('IBLOCK_ID' => 3, 'ID' => $id, "ACTIVE" => "Y"), // Фильтрация
                false,
                false,
                array("ID", "IBLOCK_ID", "PROPERTY_SCORES") // Свойства, которые нужно получить.
            );

            $offer = $rsOffers->GetNext();
            $scores += $offer['PROPERTY_SCORES_VALUE'] * $count;
        }

        $orderUser = $order->getUserId();

        CSaleUserAccount::UpdateAccount(
            $orderUser,
            $scores,
            "RUB",
            false,
            $orderID,
            false
        );
    }
}

function retailCrmApiResult($methodApi, $res, $code)
{

    require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
    $connection = Bitrix\Main\Application::getConnection();

    // Подготовка строки для использования в sql-запросе
    $login = 'admin';
    $sqlHelper = $connection->getSqlHelper();
    $data = $sqlHelper->forSql($login, 50);

    $query = "INSERT INTO `testcrm`(`name`, `json`) VALUES ('test','" . json_encode(['res' => $res, 'methodApi' => $methodApi, 'code' => $code]) . "');";
    $result = $connection->query($query);

    return;
}


function retailCrmBeforeCustomerSend($customer)
{
    $f = fopen('log.txt', 'a');
    fwrite($f, 'asdasd' . "\n");
    //Ваши изменения
    return $customer;
    //либо return false; и тогда данные отправлены в систему не будут
}

function retailCrmBeforeOrderSend($order, $arFields)
{

    // require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
    // $connection = Bitrix\Main\Application::getConnection();

    // // Подготовка строки для использования в sql-запросе
    // $login = 'admin';
    // $sqlHelper = $connection->getSqlHelper();
    // $data = $sqlHelper->forSql($login, 50);

    // $query = "INSERT INTO `testcrm`(`name`, `json`) VALUES ('test','" . json_encode($order) . "');";
    // $result = $connection->query($query);

    //Ваши изменения
    return $order;
    //либо return false; и тогда данные отправлены в систему не будут
}
