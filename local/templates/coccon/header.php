<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? \Bitrix\Main\Context::getCurrent()->getResponse()->writeHeaders(); ?>
<?

use Bitrix\Main\Page\Asset;

if ($_SESSION['REMEMBER'] == "Y")
    $USER->Authorize($USER->GetID(), true);

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

<?

if (!$USER->IsAuthorized()) {
    $favourites = (array) json_decode($_COOKIE['favourites']);
    $count = count($favourites);
} else {
    $connection = Bitrix\Main\Application::getConnection();
    $sqlHelper = $connection->getSqlHelper();

    $sql = 'SELECT count(*) AS c FROM favourites WHERE user_id=' . $sqlHelper->forSql($USER->GetID());
    $recordset = $connection->query($sql);
    $count = $recordset->fetch()['c'];
}



?>

<body>

    <div id="panel">
        <? $APPLICATION->ShowPanel(); ?>
    </div>
    <?
    global $DATA;
    CModule::IncludeModule("iblock");
    $arFilter = array("IBLOCK_ID" => 5, "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(array(), $arFilter, false, array(), array());
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetProperties();
        $DATA[] = $arFields;
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
                <li><a href="#">??????????????</a></li>
                <li><a href="#">?? ??????</a></li>
                <li><a href="#">Lookbook</a></li>
                <li><a href="#">???? ??????????</a></li>
            </ul> -->

                <!-- Phone -->
                <div class="header__phone">
                    <div class="phone_icon">
                        <svg>
                            <use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#phone"></use>
                        </svg>
                    </div>
                    <a href="tel:<?= $DATA[0]['DATA_PHONE']['VALUE']; ?>" class="phone hover"><?= $DATA[0]['DATA_PHONE']['VALUE']; ?></a>
                </div>

                <div class="header__icons">
                    <!-- Search -->
                    <div class="header__icon search">
                        <form action="/search/index.php" class="search-field">
                            <input name="q" type="text" class="search__input" placeholder="?????????????? ????????????...">

                            <button type="submit" class="search-submit">
                                <svg>
                                    <use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#search"> </use>
                                </svg>
                            </button>

                            <svg class="search__close">
                                <use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#close"> </use>
                            </svg>
                        </form>

                        <a class="search__icon">
                            <svg>
                                <use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#search"> </use>
                            </svg>
                        </a>

                    </div>
                    <!-- End Search -->

                    <a class="header__icon user" <?= $USER->IsAuthorized() ? 'href="/personal/"' : "" ?>>
                        <svg>
                            <use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#woman"> </use>
                        </svg>
                    </a>
                    <a href="/favourites" class="header__icon heart">
                        <svg>
                            <use xlink:href="<?= TEMPLATE_PATH ?>/assets/img/sprite.svg#heart"> </use>
                        </svg>
                        <div class="header-count<?= !$count ? " hide-block" : '' ?>">
                            <span><?= $count ?></span>
                        </div>
                    </a>
                    <? $APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line", 
	"cart", 
	array(
		"HIDE_ON_BASKET_PAGES" => "Y",
		"PATH_TO_AUTHORIZE" => "",
		"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
		"PATH_TO_ORDER" => SITE_DIR."personal/orders/make/",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",
		"PATH_TO_PROFILE" => SITE_DIR."personal/",
		"PATH_TO_REGISTER" => SITE_DIR."login/",
		"POSITION_FIXED" => "N",
		"SHOW_AUTHOR" => "N",
		"SHOW_EMPTY_VALUES" => "Y",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_PERSONAL_LINK" => "Y",
		"SHOW_PRODUCTS" => "Y",
		"SHOW_REGISTRATION" => "Y",
		"SHOW_TOTAL_PRICE" => "Y",
		"COMPONENT_TEMPLATE" => "cart",
		"SHOW_DELAY" => "N",
		"SHOW_NOTAVAIL" => "N",
		"SHOW_IMAGE" => "Y",
		"SHOW_PRICE" => "Y",
		"SHOW_SUMMARY" => "Y",
		"MAX_IMAGE_SIZE" => "70"
	),
	false
); ?>

                    <div class="menu-btn" id="menu-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>

            </div>

        </header>
        <!-- End Header -->
        <div class="modal-wrapp" style="display: none;">
            <div class="signup scrollbar" id="signup">
                <div class="modal-close">
                    <span></span>
                    <span></span>
                </div>
                <h2 class="title">??????????????????????</h2>

                <form action="/ajax/signup.php" method="post" class="signup__form" id="signup-form">
                    <div class="item">
                        <label for="">E-mail *</label>
                        <input type="email" name="email">
                    </div>
                    <div class="item">
                        <label for="">???????????? *</label>
                        <input type="password" name="password">
                    </div>
                    <div class="item">
                        <label for="">?????????????????? ???????????? *</label>
                        <input type="password" name="repeat_password">
                    </div>
                    <input class="submit-btn" type="submit" value="????????????????????????????????????">
                    <span class="btn">
                        ??????????
                    </span>
                </form>

            </div>
        </div>

        <div class="modal-wrapp" style="display: none;">
            <div class="login scrollbar" id="login">
                <div class="modal-close">
                    <span></span>
                    <span></span>
                </div>
                <h2 class="title">??????????????????????</h2>

                <form action="/ajax/login.php" method="post" class="login__form" id="login-form">
                    <div class="item">
                        <label for="">E-mail *</label>
                        <input type="email" name="email">
                    </div>
                    <div class="item">
                        <label for="">???????????? *</label>
                        <input type="password" name="password">
                    </div>

                    <div class="remember smartfilter">
                        <div class="checkbox">
                            <label for="remember" class="bx-filter-param-label">?????????????????? ????????</label>
                            <input type="checkbox" name="remember" id="remember" class="hide-block">
                        </div>

                        <span class="forgot hover">???????????? ?????????????</span>
                    </div>

                    <input class="submit-btn" type="submit" value="??????????">
                    <span class="btn">
                        ????????????????????????????????????
                    </span>
                </form>

            </div>
        </div>

        <div class="md-wrapper" style="display: none;" id="modal-promocode">
            <div class="modal-promocode">
	            <div class="modal-close">
		            <span></span>
		            <span></span>
	            </div>
                <div class="content">
                    <div class="title">
                        ???????????? 10% ???? ??????????????????
                    </div>
                    <span class="code">COCCON10</span>
                    <span class="btn">????????????????????</span>
                </div>
            </div>
        </div>