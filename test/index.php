<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Test");

if (!empty($_FILES)) {
    $filePath = $_SERVER['DOCUMENT_ROOT'] . '/upload/tmp/filename.ico';
    $fileId = CFile::SaveFile(
        array(
          "name" => "filename.ico",           // имя файла, как оно будет в письме
          // "size" => filesize($filePath),   // работает и без указания размера
          "tmp_name" => $filePath,            // собственно файл
          // "type" => "",                    // тип, не ясно зачем
          "old_file" => "0",                  // ID "старого" файла
          "del" => "N",                       // удалять прошлый?
          "MODULE_ID" => "",                  // имя модуля, работает и так
          "description" => "",                // описание
          "content" => file_get_contents($_FILES["profile"]["tmp_name"]),  // если указать, то вместо файла будет указанный текст
        ),
        'mails',  // относительный путь от upload, где будут храниться файлы
        false,    // ForceMD5
        false     // SkipExt
      );
}

?>

<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="profile">
    <input type="submit" value="asdasdasd">
</form>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>