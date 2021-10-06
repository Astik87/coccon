<?php

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