<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
CModule::IncludeModule('cuser');

if (!isset($_GET['email'])) die();

$status = CUser::SendPassword($_GET['email'], $_GET['email']);

$res['result'] = $status['TYPE'] == 'OK';
if (!$res['result']) {
	$res['error'] = $status['MESSAGE'];
}

var_dump($res);
