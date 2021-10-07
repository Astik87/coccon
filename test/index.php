<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Test");
?>

<span class="btn" onclick="clearStore()">Clear LocalStorage</span>

<script>
  function clearStore() {
    localStorage.clear();
  }
</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>