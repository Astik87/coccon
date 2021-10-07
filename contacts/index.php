<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
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

  <div class="contacts-wrapper">

  <div class="center">
    <div class="headding-wrap">
      <? $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
          "AREA_FILE_SHOW" => "file",
          "AREA_FILE_SUFFIX" => "inc",
          "EDIT_TEMPLATE" => "",
          "PATH" => "../include/contacts/title.php"
        )
      ); ?>
    </div>
  </div>

    <div class="row">
      <div class="contacts">
        <div class="right">
          <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "inc",
              "EDIT_TEMPLATE" => "",
              "PATH" => "../include/contacts/img1.php"
            )
          ); ?>
        </div>
        <div class="left">
          <div class="title">
            Казань
          </div> 

          <div class="desc">
            <div class="item">

              <div class="subtitle">
              <svg>
                  <use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#point">
                </svg>
                <span>Адрес:</span>
              </div>
              <div class="text">
                ул. Пр. Победы 138а (ост. Сахарова)
                Вход через «Магнит» 2 эт., направо 
                и прямо до упора.
              </div>

            </div>

            <div class="item">

              <div class="subtitle">
                <svg>
                  <use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#clock">
                </svg>
                <span>Режим работы:</span>
              </div>
              <div class="text">
                <p>Пн-Пт: 9.00 — 21.00</p>
                <p>Сб-Вс: 11.00 — 20.00</p>
              </div>
              
            </div>

            <div class="item">

              <div class="subtitle">
                <svg>
                  <use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#phone">
                </svg>
                <span>Номер телефона:</span>
              </div>
              <div class="text">
                <a href="tel:+7(939)-333-39-33">+7(939)-333-39-33</a>
              </div>
              
            </div>
          </div>
        </div>
      </div>
      <div class="map">
        <div class="right">
          <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Aeb67a6b2bdf097067ad4c9c923e9134af659add9016593445ee5eee7afc29a2f&amp;source=constructor" width="320" height="372" frameborder="0"></iframe>
        </div>
        <div class="left">
          <div class="title">Как добраться</div>
          <div class="text">
            <p>При возврате товара надлежащего качества, Продавец осматривает товар на наличие ярлыка, заломов, пятен или иных возможных повреждений.</p>
            <p>Все обнаруженные недостатки товара Продавец фиксирует с помощью фото и видео съемки, а также отражает их в Акте возврата товара надлежащего качества.</p>
            <p>Все обнаруженные недостатки товара Продавец фиксирует с помощью фот.</p>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="contacts">
        <div class="right">
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "inc",
              "EDIT_TEMPLATE" => "",
              "PATH" => "../include/contacts/img1.php"
            )
          ); ?>
        </div>
        <div class="left">
          <div class="title">
            Москва
          </div> 

          <div class="desc">
            <div class="item">

              <div class="subtitle">
              <svg>
                  <use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#point">
                </svg>
                <span>Адрес:</span>
              </div>
              <div class="text">
                ул. Пр. Победы 138а (ост. Сахарова)
                Вход через «Магнит» 2 эт., направо 
                и прямо до упора.
              </div>

            </div>

            <div class="item">

              <div class="subtitle">
                <svg>
                  <use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#clock">
                </svg>
                <span>Режим работы:</span>
              </div>
              <div class="text">
                <p>Пн-Пт: 9.00 — 21.00</p>
                <p>Сб-Вс: 11.00 — 20.00</p>
              </div>
              
            </div>

            <div class="item">

              <div class="subtitle">
                <svg>
                  <use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#phone">
                </svg>
                <span>Номер телефона:</span>
              </div>
              <div class="text">
                <a href="tel:+7(939)-333-39-33">+7(939)-333-39-33</a>
              </div>
              
            </div>
          </div>
        </div>
      </div>
      <div class="map">
        <div class="right">
          <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Aeb67a6b2bdf097067ad4c9c923e9134af659add9016593445ee5eee7afc29a2f&amp;source=constructor" width="320" height="372" frameborder="0"></iframe>
        </div>
        <div class="left">
          <div class="title">Как добраться</div>
          <div class="text">
            <p>При возврате товара надлежащего качества, Продавец осматривает товар на наличие ярлыка, заломов, пятен или иных возможных повреждений.</p>
            <p>Все обнаруженные недостатки товара Продавец фиксирует с помощью фото и видео съемки, а также отражает их в Акте возврата товара надлежащего качества.</p>
            <p>Все обнаруженные недостатки товара Продавец фиксирует с помощью фот.</p>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="contacts">
        <div class="right">
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "inc",
              "EDIT_TEMPLATE" => "",
              "PATH" => "../include/contacts/img1.php"
            )
          ); ?>
        </div>
        <div class="left">
          <div class="title">
            Санкт-Петербург
          </div> 

          <div class="desc">
            <div class="item">

              <div class="subtitle">
              <svg>
                  <use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#point">
                </svg>
                <span>Адрес:</span>
              </div>
              <div class="text">
                ул. Пр. Победы 138а (ост. Сахарова)
                Вход через «Магнит» 2 эт., направо 
                и прямо до упора.
              </div>

            </div>

            <div class="item">

              <div class="subtitle">
                <svg>
                  <use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#clock">
                </svg>
                <span>Режим работы:</span>
              </div>
              <div class="text">
                <p>Пн-Пт: 9.00 — 21.00</p>
                <p>Сб-Вс: 11.00 — 20.00</p>
              </div>
              
            </div>

            <div class="item">

              <div class="subtitle">
                <svg>
                  <use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#phone">
                </svg>
                <span>Номер телефона:</span>
              </div>
              <div class="text">
                <a href="tel:+7(939)-333-39-33">+7(939)-333-39-33</a>
              </div>
              
            </div>
          </div>
        </div>
      </div>
      <div class="map">
        <div class="right">
          <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Aeb67a6b2bdf097067ad4c9c923e9134af659add9016593445ee5eee7afc29a2f&amp;source=constructor" width="320" height="372" frameborder="0"></iframe>
        </div>
        <div class="left">
          <div class="title">Как добраться</div>
          <div class="text">
            <p>При возврате товара надлежащего качества, Продавец осматривает товар на наличие ярлыка, заломов, пятен или иных возможных повреждений.</p>
            <p>Все обнаруженные недостатки товара Продавец фиксирует с помощью фото и видео съемки, а также отражает их в Акте возврата товара надлежащего качества.</p>
            <p>Все обнаруженные недостатки товара Продавец фиксирует с помощью фот.</p>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>