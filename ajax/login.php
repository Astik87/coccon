<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
\Bitrix\Main\Context::getCurrent()->getResponse()->writeHeaders();
CModule::IncludeModule('cuser');

use Bitrix\Main\Application;
use Bitrix\Main\Web\Cookie;

$application = Application::getInstance();
$context = $application->getContext();

$res = [];

if (empty($_POST)) die();

$data = [];

foreach ($_POST as $key => $value) {
	$data[$key] = trim($value);

	if (!$data[$key])
		$res['errors'][$key][] = 'Поле обязательно для заполнения';
}

if (!empty($res['errors'])) {
	$res['result'] = false;
	echo json_encode($res);
	die();
}

$u = $USER->Login($data['email'], $data['password']);

if ($u !== true) {
	$res['cerror'] = $u['MESSAGE'];
	$res['result'] = false;
} else {
	$res['result'] = true;
	session_start();
	$_SESSION['REMEMBER'] = $_POST['remember'] ? 'Y' : 'N';
}

echo json_encode($res);
