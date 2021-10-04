<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
CModule::IncludeModule('cuser');

// $res = ['result' => false];

// if (empty($_POST)) die;

// if ($_POST['password']) {
// 	if ($_POST['confirm_password'] == $_POST['password']) {
// 		$CHECKWORD = $USER->CHECKWORD;
// 		var_dump($CHECKWORD);
// 	} else
// 		$res['message'] = 'Неверное подтверждение пароля';
// }

// if ($_POST['name']) {
// 	if ($_POST['confirm_password'] != $_POST['password'])
// 		$res['message'] = 'Неверное подтверждение пароля';
// }

if (isset($_GET['name'])) {
	$_GET['NAME'] = explode(' ', $_GET['name'])[0];
	$_GET['LAST_NAME'] = explode(' ', $_GET['name'])[1] ? explode(' ', $_GET['name'])[1] : '';
	$_GET['SECOND_NAME'] = explode(' ', $_GET['name'])[2] ? explode(' ', $_GET['name'])[2] : '';
}

var_dump($_GET);
