<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Test");

// if (!empty($_GET)) {
//   CSaleUserAccount::UpdateAccount(
//     $USER,
//     $_GET['bally'],
//     "RUB",
//   );

// }

$order = \Bitrix\Sale\Order::load(32);

$scores = 0;

foreach($order->getBasket() as $item) {
  $id = $item->getField('PRODUCT_ID');
  debuger($id);
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

debuger($scores);

?>

<span class="btn" onclick="clearStore()">Clear LocalStorage</span>

<form action="/test" method="get">
<input type="text" name="bally">
<input type="submit" value="Отправить">
</form>

<script>
  function clearStore() {
    localStorage.clear();
  }
</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>