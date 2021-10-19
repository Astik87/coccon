<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
$connection = Bitrix\Main\Application::getConnection();

// Подготовка строки для использования в sql-запросе
$login = 'admin';
$sqlHelper = $connection->getSqlHelper();
$data = $sqlHelper->forSql($login, 50);

$query = "INSERT INTO `testcrm`(`name`, `json`) VALUES ('test','" . json_encode(['name' => 'asd']) . "');";
$result = $connection->query($query);
