<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
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

foreach ($order->getBasket() as $item) {
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

?><?
  require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
  $APPLICATION->SetTitle("Test");

  // php translit

  function translit($value)
  {
    $converter = array(
      'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
      'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
      'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
      'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
      'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
      'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
      'э' => 'e',    'ю' => 'yu',   'я' => 'ya',

      ' ' => '-',
      '_' => '-',

      'А' => 'a',    'Б' => 'b',    'В' => 'v',    'Г' => 'g',    'Д' => 'd',
      'Е' => 'e',    'Ё' => 'e',    'Ж' => 'zh',   'З' => 'z',    'И' => 'i',
      'Й' => 'y',    'К' => 'k',    'Л' => 'l',    'М' => 'm',    'Н' => 'n',
      'О' => 'o',    'П' => 'p',    'Р' => 'r',    'С' => 's',    'Т' => 't',
      'У' => 'u',    'Ф' => 'f',    'Х' => 'h',    'Ц' => 'c',    'Ч' => 'ch',
      'Ш' => 'sh',   'Щ' => 'sch',  'Ь' => '',     'Ы' => 'y',    'Ъ' => '',
      'Э' => 'e',    'Ю' => 'yu',   'Я' => 'ya',
    );

    $value = strtr($value, $converter);
    return $value;
  }

  // RetailCRM .json parse

  $file = fopen("./dump.json", "r");

  $res = json_decode(fread($file, filesize("./dump.json")));
  fclose($file);

  $products = [];
  $prevKey = 0;
  foreach ($res->products as $key => $product) {
    if ($key == 0)
      continue;

    $newProduct = [];
    $newOffer = [
      'name' => $product->offer_name,
      'article' => $product->offer_article,
      'image' => $product->image,
      'price' => $product->price_typebase,
    ];
    // var_dump($product);
    if ($prevKey == 0 || $product->name != $res->products[$prevKey]->name) {
      $newProduct = [
        'name' => $product->name,
        'article' => $product->article,
        'offers' => [],
      ];

      $newProduct['offers'][] = $newOffer;

      $products[] = $newProduct;
    } else {
      $parProductKey = count($products) - 1;
      $products[$parProductKey]['offers'][] = $newOffer;
    }

    $prevKey = $key;
  }

  foreach ($products as $key => $value) {
    $products[$key]['images'] = [];
    foreach ($value['offers'] as $offer) {
      if (!in_array($offer['image'], $products[$key]['images']))
        $products[$key]['images'][] = $offer['image'];
    }
  }

  // debuger($products);

  // foreach ($products as $key => $product) {
  //   if ($key > 10) {
  //     continue;
  //   }
  //   $images = [];
  //   foreach ($product['images'] as $image) {
  //     $images[] = createNewPhoto($image);
  //   }

  //   $productId = createProduct($product['name'], 99, $images, $product['article']);
  //   debuger($productId);

  //   foreach ($product['offers'] as $offer) {
  //     addOffer($productId, $offer['name'], 'green', createNewPhoto($offer['image']), $offer['price'], $offer['article']);
  //   }
  // }



  // Get all products
  /*******************/
  // $res = CIBlockElement::GetList(
  // 	array(),
  // 	array(
  // 		"IBLOCK_ID" => 2,
  // 	),
  // 	false,
  // 	false
  // );

  // // $mailing = [];
  // while ($obj = $res->GetNextElement()) {
  // 	$mailing = $obj->GetProperties();
  //   debuger($mailing);
  // 	// $mailing['NAME'] = $obj->GetFields()["NAME"];
  // 	// $mailing['PREVIEW_TEXT'] = $obj->GetFields()["PREVIEW_TEXT"];
  // 	// $mailing['DETAIL_TEXT'] = $obj->GetFields()["DETAIL_TEXT"];
  // 	// $mailing['IMG'] = CFile::GetPath($obj->GetFields()["PREVIEW_PICTURE"]);
  // 	// break;
  // }
  /*******************/

  //Create new Product
  /*******************/

  function createNewPhoto($url)
  {
    if (strlen($url) <= 0)
      return false;

    $arUrl = explode('/', $url);
    $filePath = $_SERVER["DOCUMENT_ROOT"] . '/upload/productsrcrm/' . $arUrl[count($arUrl) - 1];

    if (!copy($url, $filePath))
      return false;

    $arFile = CFile::MakeFileArray($filePath);
    $arFile["MODULE_ID"] = "main";
    $fid = CFile::SaveFile($arFile, "main");
    return $fid;
  }

  function createProduct($name, $section_id, $images, $article)
  {
    CModule::IncludeModule('iblock');
    CModule::IncludeModule('sale');

    $ciBlockElement = new CIBlockElement;

    $arParams = array(
      'IBLOCK_ID' => 2, // IBLOCK товаров
      'NAME' => $name,
      'CODE' => translit($name),
      'IBLOCK_SECTION_ID' => $section_id,
      "ACTIVE" => "Y",
      'PREVIEW_PICTURE' => CFile::MakeFileArray(CFile::GetPath($images[0])),
      'DETAIL_PICTURE' => CFile::MakeFileArray(CFile::GetPath($images[0])),
      'PROPERTY_VALUES' => [
        'ARTNUMBER' => $article,
        'MORE_PHOTO' => $images,
        'BACKGROUND_IMAGE' => $images[0],

      ],
      // Прочие параметры товара
    );

    // Добавляем товар-родитель, у которго будут торг. предложения
    $product_id = $ciBlockElement->Add($arParams);

    // проверка на ошибки
    if (!empty($ciBlockElement->LAST_ERROR)) {
      echo "Ошибка добавления товара: " . $ciBlockElement->LAST_ERROR;
      return false;
    }

    return $product_id;
  }

  function addOffer($product_id, $name, $color, $color_photo, $price, $article)
  {

    $ciBlockElement = new CIBlockElement;

    // добавляем нужное кол-во торговых предложений
    $arLoadProductArray = array(
      "IBLOCK_ID"      => 3, // IBLOCK торговых предложений
      "NAME"           => $name,
      "ACTIVE"         => "Y",
      'PROPERTY_VALUES' => array(
        'CML2_LINK' => $product_id, // Свойство типа "Привязка к товарам (SKU)", связываем торг. предложение с товаром
        'COLOR_REF' => $color,
        'COLOR_IMG' => $color_photo,
        'ARTNUMBER'      => $article,
      )
      // Прочие параметры товара 
    );

    $product_offer_id = $ciBlockElement->Add($arLoadProductArray);

    // проверка на ошибки
    if (!empty($ciBlockElement->LAST_ERROR)) {
      echo "Ошибка добавления торгового предложения: " . $ciBlockElement->LAST_ERROR;
      return false;
    }

    // Добавляем параметры к торг. предложению
    CCatalogProduct::Add(
      array(
        "ID" => $product_offer_id,
        "QUANTITY" => 0
      )
    );

    // Добавляем цены к торг. предложению
    CPrice::Add(
      array(
        "CURRENCY" => "RUB",
        "PRICE" => $price,
        "CATALOG_GROUP_ID" => 1,
        "PRODUCT_ID" => $product_offer_id,
      )
    );

    return $product_offer_id;
  }
  /*******************/

  ?>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>