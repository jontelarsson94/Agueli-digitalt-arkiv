<?php

require_once "../inc/check_admin.php";

if(checkAdmin() != "nothing"){

require_once "../inc/db_credentials.php";
require_once "add_photo.php";
//Arrays
/*$errors = array();
$data = array();*/
$article_id = $_REQUEST['article_id'];
$index = $_REQUEST['index'];

if(!empty($_FILES['fileToUpload']['name'][$index])){

  $fileId = UploadFile('fileToUpload', $database, $index);

  $database->update("article_images", [
    "image_id" => $fileId
  ],[
    "AND" =>[
    "article_id" => $article_id,
    "section" => 0,
    "galleryNumber" => $index+1
    ]
  ]);
}
else{

  $imageId = $database->insert("images", [
    "url" => NULL
    ]);

  $database->update("article_images", [
    "image_id" => $imageId
  ],[
    "AND" =>[
    "article_id" => $article_id,
    "section" => 0,
    "galleryNumber" => $index+1
    ]
  ]);
}

echo '<script type="text/javascript">window.location = "../update_article.php?article_id=' . $article_id . '"</script>';

}

 ?>
