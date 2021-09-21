<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
CModule::IncludeModule('cuser');
// CModule::IncludeModule('Application');

$connection = Bitrix\Main\Application::getConnection();
$sqlHelper = $connection->getSqlHelper();

$action = $_GET['action'];
$productId = $_GET['id'];

$res = [
	'result' => false,
];

if (!$action || !$productId)
	die();

if ($_COOKIE['favourites'])
	$favourites = (array) json_decode($_COOKIE['favourites']);
else $favourites = [];

if ($action == 'add') {
	if (!$USER->IsAuthorized()) {

		if (!in_array($productId, $favourites)) {
			$favourites[] = $productId;
			setcookie('favourites', json_encode($favourites), time() + (3600 * 24 * 60), "/");
			$res['result'] = true;
			$res['count'] = count($favourites);
		}
	} else {
		$sql = 'SELECT count(*) AS c FROM favourites WHERE user_id=' . $sqlHelper->forSql($USER->GetID()) . ' and product_id=' . $sqlHelper->forSql($productId);
		$recordset = $connection->query($sql);
		$count = $recordset->fetch()['c'];

		if (!$count) {
			$sql = "INSERT INTO `favourites`(`user_id`, `product_id`) VALUES (" . $sqlHelper->forSql($USER->GetID()) . "," . $sqlHelper->forSql($productId) . ")";
			$recordset = $connection->query($sql);
			$res['result'] = (bool)$recordset;
			$sql = 'SELECT count(*) AS c FROM favourites WHERE user_id=' . $sqlHelper->forSql($USER->GetID());
			$recordset = $connection->query($sql);
			$count = $recordset->fetch()['c'];
			$res['count'] = $count;
		}
	}
}

if ($action == 'del') {
	if (!$USER->IsAuthorized()) {
		if (in_array($productId, $favourites)) {
			$temp = [];
			foreach ($favourites as $key => $val) {
				if ($val != $productId)
					$temp[] = $val;
			}
			$favourites = $temp;
			setcookie('favourites', json_encode($favourites), time() + (3600 * 24 * 60), "/");
			$res['result'] = true;
			$res['count'] = count($favourites);
		}
	} else {
		$sql = 'SELECT count(*) AS c FROM favourites WHERE user_id=' . $sqlHelper->forSql($USER->GetID()) . ' and product_id=' . $sqlHelper->forSql($productId);
		$recordset = $connection->query($sql);
		$count = $recordset->fetch()['c'];

		if ($count) {
			$sql = 'DELETE FROM `favourites` WHERE user_id=' . $sqlHelper->forSql($USER->GetID()) . ' and product_id=' . $sqlHelper->forSql($productId);
			$recordset = $connection->query($sql);
			$res['result'] = (bool)$recordset;
			$sql = 'SELECT count(*) AS c FROM favourites WHERE user_id=' . $sqlHelper->forSql($USER->GetID());
			$recordset = $connection->query($sql);
			$count = $recordset->fetch()['c'];
			$res['count'] = $count;
		}
	}
}


echo json_encode($res);
