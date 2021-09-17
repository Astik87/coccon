<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
CModule::IncludeModule('cuser');

$connection = Bitrix\Main\Application::getConnection();
$sqlHelper = $connection->getSqlHelper();

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

if ($res['result']) {

	$USER->Login($user_data['LOGIN'], $user_data['PASSWORD'], 'Y');

	if ($_COOKIE['favourites'])
		$favourites = (array) json_decode($_COOKIE['favourites']);
	else $favourites = false;

	if ($favourites != false && $USER->IsAuthorized()) {
		$sql = "INSERT INTO `favourites`(`user_id`, `product_id`) VALUES ";
		$values = [];
		foreach ($favourites as $key => $productId) {
			$values[] = "(" . $sqlHelper->forSql($USER->GetID()) . "," . $sqlHelper->forSql($productId) . ")";
		}

		$sql .= implode(',', $values);
		$recordset = $connection->query($sql);
		setcookie('favourites', null, -1, '/');
	}
}

echo json_encode($res);
