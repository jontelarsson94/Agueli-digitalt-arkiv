<?php

require_once "../inc/db_credentials.php";
//Arrays
$errors = array();
$data = array();
//Check conditions/Validation
if(!empty($_REQUEST['title'])){
  $article_id = $_REQUEST['article_id'];
  $title = $_REQUEST['title'];


  $database->update("articles", [
    "title" => $title
  ], [
   "id" => $article_id
  ]);
}

echo '<script type="text/javascript">window.location = "../update_article.php?article_id=' . $article_id . '"</script>';

 ?>
