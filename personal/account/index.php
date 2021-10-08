<?
define("HIDE_SIDEBAR", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");


$balance = \CSaleUserAccount::getList(array(), array('USER_ID' => $USER->GetID()))->Fetch();

CModule::IncludeModule("sale");

$transacts = [];

$res = CSaleUserTransact::GetList(Array("ID" => "DESC"), array("USER_ID" => $USER->GetID()));
$i = 0;
while ($arFields = $res->Fetch())
{

	$transacts[$i]['date'] = explode( ' ', $arFields['TRANSACT_DATE'])[0];
	$transacts[$i]['status'] = $arFields['DEBIT'] == 'Y' || (int)$arFields['AMOUNT'] == 0 ?  'Начислено' : 'Списано';
	$transacts[$i]['order-id'] =  'Начисление баллов в рамках заказа №' . $arFields['ORDER_ID'];
	$transacts[$i]['amount'] = $arFields['DEBIT'] == 'Y' || (int)$arFields['AMOUNT'] == 0 ?  '+ ' : '- ';
	$transacts[$i]['amount'] .= round($arFields['AMOUNT'], 2) . " Б";
	
	$i++;
}
?>


<div class="container personal-wrapper">

	<? $APPLICATION->IncludeComponent(
		"bitrix:breadcrumb",
		"main_breadcrumb",
		array(
			"PATH" => "/personal",
			"SITE_ID" => "s1",
			"START_FROM" => "0",
			"COMPONENT_TEMPLATE" => "main_breadcrumb"
		),
		false
	); ?>

	<div class="tabs__caption" data-id="private">
		<a href="/personal/private" class="item">
			Личные данные
		</a>

		<a href="/personal/orders" class="item">
			Мои заказы
		</a>

		<a href="/personal/account" class="item active">
			Бонусы
		</a>
	</div>

	<div class="tabs__content" id="account">

		<div class="account">
			<svg>
				<use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#scores"> </use>
			</svg>
			<?= round($balance['CURRENT_BUDGET'], 2) ?>
		</div>

		<table class="table">
			<tr class="head">
				<td class="date">Дата</td>
				<td class="status">Статус</td>
				<td class="order-id">Операция</td>
				<td class="amount">Сумма</td>
			</tr>
			
			<?foreach($transacts as $row):?>
				
				<tr>
					<?foreach($row as $key => $col):?>
						<td class="<?= $key ?>"><?= $col ?></td>
					<? endforeach; ?>
				</tr>

			<? endforeach; ?>
		</table>

	</div>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>