<?php

require_once "../inc/db_credentials.php";
//Arrays
$errors = array();
$data = array();
//Check conditions/Validation
if(!empty($_REQUEST['summary'])){
  $article_id = $_REQUEST['article_id'];
  $summary = $_REQUEST['summary'];


  $database->update("articles", [
    "summary" => $summary
  ], [
   "id" => $article_id
  ]);
}

echo '<script type="text/javascript">window.location = "../update_article.php?article_id=' . $article_id . '"</script>';

 ?>
