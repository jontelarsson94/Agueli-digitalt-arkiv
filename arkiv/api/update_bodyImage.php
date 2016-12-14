<?php

require_once "../inc/db_credentials.php";
require_once "add_photo.php";
//Arrays
$errors = array();
$data = array();
$article_id = $_REQUEST['article_id'];
$index = $_REQUEST['index'];

if(!empty($_FILES['image']['name'][$index])){

  $fileId = UploadFile('image', $database, $index);

  $database->update("article_images", [
    "image_id" => $fileId
  ],[
  	"AND" =>[
  	"article_id" => $article_id,
    "section" => $index+1
  	]
  ]);
}
else{

  $imageId = $database->get("article_images", "image_id", [
    "AND" =>[
      "article_id" => $article_id,
      "section" => $index+1
    ]
  ]);

  $database->update("images", [
    "url" => NULL
  ],[
    "id" => $imageId
  ]);
}

echo '<script type="text/javascript">window.location = "../update_article.php?article_id=' . $article_id . '"</script>';

 ?>
