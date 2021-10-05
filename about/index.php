<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О магазине");
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

  <div class="about-wrapper">
  
    <div class="center">
      <? $APPLICATION->IncludeComponent(
          "bitrix:main.include",
          "",
          array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "EDIT_TEMPLATE" => "",
            "PATH" => "../include/about/title.php"
          )
        ); ?>
    </div>

    <div class="about">

      <div class="about-logo">
        <img src="<?= TEMPLATE_PATH ?>/assets/img/about-logo.png" alt="">
      </div>

      <div class="text">
        <p>В коллекциях представлены повседневные костюмы, платья, трикотажные изделия, блузы и рубашки, брюки и юбки. Мы самостоятельно разрабатываем лекала, постоянно экспериментируя и совершенствуя крой, с особым вниманием относимся к каждой детали. Благодаря этому у нас есть собственный узнаваемый стиль — это лаконичные модели, которые подчеркивают фигуру и создают гармоничный образ.</p>
        <p>Мы за то, чтобы образ был стильным и в то же время комфортным. Благодаря своему продуманному и правильному крою, не сковывающему движения, высокому качеству, гармоничному сочетанию легких базовых оттенков и фактур, каждое наше изделие легко впишется в любой гардероб, станет основой для множества стильных образов, актуальных вне сезонов и трендов.</p>
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
              "PATH" => "../include/about/img2.php"
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
              "PATH" => "../include/about/img1.php"
            )
          ); ?>
        </div>
      </div>
    </div>

  </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>