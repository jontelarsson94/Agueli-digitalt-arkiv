<?php

require_once "../inc/check_admin.php";

if(checkAdmin() != "nothing"){

require_once "../inc/db_credentials.php";
require_once "add_photo.php";
if(empty($_FILES['fileToUpload']['name'])){
  echo "file is empty";
}
$fileId = UploadSingleFile("fileToUpload", $database);

$result = $database->insert("article_images", [
  "image_id" => $fileId,
  "article_id" => 1,
  "section" => 1
]);

echo $result;
//require_once "../inc/db_credentials.php";
//require_once "add_photo.php";
/*
if(!empty($_POST['fileToUpload'])){
  $fileId = UploadSingleFile('fileToUpload', $database);

  $database->insert("article_images", [
    "image_id" => $fileId,
    "article_id" => 3,
    "section" => 1
  ]);
}*/
}
 ?>
