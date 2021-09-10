<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?

use Bitrix\Main\Page\Asset;
?>
<!DOCTYPE html>
<html lang="ru">

<head itemscope itemtype="http://schema.org/WPHeader">
    <?php $APPLICATION->ShowHead() ?>
    <meta charset="UTF-8">
    <title itemprop="name"><?php $APPLICATION->ShowTitle() ?></title>
    <meta itemprop="description" content="<?= $APPLICATION->ShowProperty("description"); ?>">
    <meta itemprop="keywords" content="<?= $APPLICATION->ShowProperty("keywords") ?>">
    <link rel="shortcut icon" href="<? echo SITE_DIR; ?>favicon.ico" type="image/x-icon">
    <?
    Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1.0">');
    Asset::getInstance()->addString('<meta http-equiv="X-UA-Compatible" content="ie=edge">');
    Asset::getInstance()->addCss(TEMPLATE_PATH . "/assets/fonts/Forum/stylesheet.css");
    Asset::getInstance()->addCss(TEMPLATE_PATH . "/assets/fonts/Circe/stylesheet.css");
    Asset::getInstance()->addCss(TEMPLATE_PATH . '/assets/css/libs.min.css');
    Asset::getInstance()->addCss(TEMPLATE_PATH . "/assets/css/main.min.css");
    ?>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="<?= TEMPLATE_PATH ?>/assets/js/libs.min.js"></script>
</head>



<body>
    <div id="panel">
        <? $APPLICATION->ShowPanel(); ?>
    </div>
    <?
    global $DATE;
    CModule::IncludeModule("iblock");
    $arFilter = array("IBLOCK_ID" => 5, "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(array(), $arFilter, false, array(), array());
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetProperties();
        $DATE[] = $arFields;
    }

    ?>
    <div id="wrapper">

        <!-- Header -->
        <header class="header">
            <div>

                <!-- Logo -->
                <div class="logo">
                    <a href="/">
                        <img class="logo__img" src="<?= TEMPLATE_PATH ?>/assets/img/logo.png" alt="">
                    </a>
                </div>

                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "main_menu",
                    array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "left",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => array(),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "top",
                        "USE_EXT" => "N",
                        "COMPONENT_TEMPLATE" => "main_menu"
                    ),
                    false
                ); ?>

                <!-- Menu -->
                <!-- <ul class="menu">
                <li><a href="#">Каталог</a></li>
                <li><a href="#">О нас</a></li>
                <li><a href="#">Lookbook</a></li>
                <li><a href="#">Об уходе</a></li>
            </ul> -->

                <!-- Phone -->
                <div class="header__phone">
                    <div class="phone_icon">
                        <svg>
                            <use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#phone"></use>
                        </svg>
                    </div>
                    <a href="#" class="phone hover"><?= $DATE[0]['DATA_PHONE']['VALUE']; ?></a>
                </div>

                <div class="header__icons">
                    <!-- Search -->
                    <div class="header__icon search">
                        <div class="search-field">
                            <input type="text" class="search__input" placeholder="Введите запрос...">
                            <svg class="search__close">
                                <use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#close"> </use>
                            </svg>
                        </div>

                        <a href="#" class="search__icon">
                            <svg>
                                <use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#search"> </use>
                            </svg>
                        </a>

                    </div>
                    <!-- End Search -->

                    <a href="#" class="header__icon">
                        <svg>
                            <use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#woman"> </use>
                        </svg>
                    </a>
                    <a href="#" class="header__icon">
                        <svg>
                            <use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#heart"> </use>
                        </svg>
                    </a>
                    <a href="#" class="header__icon cart">
                        <svg>
                            <use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#shopping-bags"> </use>
                        </svg>

                        <div class="cart-count" id="cart-count">
                            <span>2</span>
                        </div>
                    </a>

                    <div class="menu-btn" id="menu-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>

            </div>
        </header>
        <!-- End Header -->