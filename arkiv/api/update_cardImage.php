<?php

require_once "../inc/db_credentials.php";
require_once "add_photo.php";
//Arrays
//$errors = array();
//$data = array();

if(!empty($_FILES['cardImage']['name'])){

  $article_id = $_REQUEST['article_id'];
  $fileId = UploadSingleFile("cardImage", $database);

  $database->update("article_images", [
    "image_id" => $fileId
  ],[
  	"AND" =>[
  	"article_id" => $article_id,
    "section" => -1,
    "isCardImage" => 1
  	]
  ]);
  //var_dump($database->last_query());
}

echo '<script type="text/javascript">window.location = "../update_article.php?article_id=' . $article_id . '"</script>';

 ?>
