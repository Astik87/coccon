<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вакансии");

CModule::IncludeModule("iblock");

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

  <div class="center">
    <? $APPLICATION->IncludeComponent(
      "bitrix:main.include",
      "",
      array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => "../include/vacancy/title.php"
      )
    ); ?>
  </div>

  <div class="center">

    <div class="vacancy-wrapper">

    <?
    
    $arFilter = array("IBLOCK_ID" => 12, "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(array(), $arFilter, false, array(), array());
    while ($ob = $res->GetNextElement()) {
        $arProps = $ob->GetProperties();
        $arFields = $ob->GetFields();
    ?>

<div class="item">
        <div class="head">
          <?= $arFields['NAME'] ?>
          <span></span>
        </div>
        <div class="content">
          <div class="table">
            <div class="col">
              <div class="title">
                Обязанности
              </div>
              <div class="text">
                <ul>
                  <? foreach($arProps['RESPONSIBILITIES']['VALUE'] as $value): ?>
                    <li><?= $value ?></li>
                  <? endforeach; ?>
                </ul>
              </div>
            </div>
  
            <div class="col">
              <div class="title">
                Требования
              </div>
              <div class="text">
                <ul>
                  <? foreach($arProps['REQUIREMENTS']['VALUE'] as $value): ?>
                    <li><?= $value ?></li>
                  <? endforeach; ?>
                </ul>
              </div>
            </div>
  
            <div class="col">
              <div class="title">
                Условия
              </div>
              <div class="text">
                <ul>
                  <? foreach($arProps['CONDITIONS']['VALUE'] as $value): ?>
                    <li><?= $value ?></li>
                  <? endforeach; ?>
                </ul>
              </div>
            </div>
          </div>
  
          <span class="btn form-btn">
            Откликнуться на вакансию
          </span>

          <div class="form">

            <?$APPLICATION->IncludeComponent(
            "asd:main.feedback", 
            ".default", 
            array(
              "EMAIL_TO" => "sale@coccon.loc",
              "EVENT_MESSAGE_ID" => array(
              ),
              "OK_TEXT" => "Спасибо, ваше сообщение принято.",
              "REQUIRED_FIELDS" => array(
                0 => "NAME",
                1 => "MESSAGE",
              ),
              "USE_CAPTCHA" => "Y",
              "VACANCY" => $arFields['NAME'],
              "COMPONENT_TEMPLATE" => ".default"
            ),
            false
          );?>
          </div>
        </div>
      </div>

    <?
      }
    ?>
    </div>
  </div>
 </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>