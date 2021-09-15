<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
CModule::IncludeModule('cuser');

$res = [];

if ($USER->IsAuthorized()) $res['result'] = false;

if (empty($_POST)) die();

$data = [];

foreach ($_POST as $key => $value) {
	$data[$key] = trim($value);

	if (!$data[$key])
		$res['errors'][$key][] = 'Поле обязательно для заполнения';
}

if ($data['password'] != $data['repeat_password']) $res['errors']['repeat_password'][] = "Неверное подтверждение пароля";
if (strlen($data['password']) < 6)  $res['errors']['password'][] = "Пароль должен быть не менее 6 символов длиной";

if (!empty($res['errors'])) {
	$res['result'] = false;
	echo json_encode($res);
	die();
}

$user_data = [
	'LOGIN' => $data['email'],
	'EMAIL' => $data['email'],
	'PASSWORD' => $data['password'],
	'CONFIRM_PASSWORD' => $data['repeat_password'],
];

$USER->Add($user_data);

$res['result'] = !$USER->LAST_ERROR;
$res['cerror'] = $USER->LAST_ERROR;

echo json_encode($res);

if ($res['result']) {
	$USER->Login($user_data['email'], $user_data['password'], 'Y');
}
