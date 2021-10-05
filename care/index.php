<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Об уходе");
?>

<div class="container">

  <?$APPLICATION->IncludeComponent(
    "bitrix:breadcrumb",
    "main_breadcrumb",
    Array(
      "PATH" => "",
      "SITE_ID" => "s1",
      "START_FROM" => "0"
    )
  );?>

  <div class="care-wrapper">
  
    <div class="center">
      <? $APPLICATION->IncludeComponent(
          "bitrix:main.include",
          "",
          array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "EDIT_TEMPLATE" => "",
            "PATH" => "../include/care/title.php"
          )
        ); ?>
    </div>

    <div class="about">

      <div class="text">
        <span class="title">Основное</span>
        <p>Правильный уход требует соблюдения определенных правил. Ткани необходимо стирать и гладить при определенной температуре, чтобы они не потеряли цвет и форму. Для одежды из натуральных тканей также рекомендуется использовать особые средства для стирки, которые способствуют сохранению яркого цвета и плотности ткани. Чтобы даже после многократной стирки и глажки любимая хлопковая футболка выглядела привлекательно, достаточно соблюсти ряд несложных правил.</p>
        <div class="list">
          <ul>
            <li>Вискоза:  ручная стирка (30 градусов, 400 оборотов) или химчистка.</li>
            <li>Шёлк:  ручная стирка (30 градусов, 400 оборотов) или химчистка.</li>
            <li>Шерсть, кашемир:  ручная стирка (30 градусов) или химчистка.</li>
            <li>Хлопок:  ручная стирка (30 градусов) или химчистка.</li>
          </ul>
        </div>
      </div>
      <div class="images">
        <div class="left">
          <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "inc",
              "EDIT_TEMPLATE" => "",
              "PATH" => "../include/care/img2.php"
            )
          ); ?>
        </div>
        <div class="right">
          <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "inc",
              "EDIT_TEMPLATE" => "",
              "PATH" => "../include/care/img1.php"
            )
          ); ?>
        </div>
      </div>
    </div>

    <div class="about rev">

      <div class="images">
      <div class="right">
          <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "inc",
              "EDIT_TEMPLATE" => "",
              "PATH" => "../include/care/img4.php"
            )
          ); ?>
        </div>

        <div class="left">
          <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "inc",
              "EDIT_TEMPLATE" => "",
              "PATH" => "../include/care/img3.php"
            )
          ); ?>
        </div>
      </div>

      <div class="text">

        <span class="title">Хлопок</span>
        <p>Одежда из натурального хлопка хорошо переносит стирку даже при высоких температурах, правильно обработанный материал не усаживается и не теряет плотности. Важное правило, которое следует применять при стирке хлопковых вещей: на стирать их слишком сильными и концентрированными порошками. Такие средства можно использовать только для вещей белого цвета, лишенных какого-либо декора, цветные вещи от такой стирки могут полинять.</p>
        <p>Правильная глажка тоже может существенно продлить срок службы вещей, практически на всех предметах одежды есть специальная бирка, на которой указан оптимальный температурный режим глажки. Он во многом зависит от толщины и плотности ткани, чем толще хлопковое полотно, тем при более высокой температуре его можно гладить</p>
        <p>Воздействие высоких температур способствует  выгоранию ткани, поэтому при глажке не стоит использовать без необходимости слишком высокие режимы. По аналогичной причине вещи из хлопка не стоит просушивать на открытом солнце.</p>
      </div>
    </div>

  </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>