<?php

require_once "../inc/check_admin.php";

if(checkAdmin() != "nothing"){

require_once "../inc/db_credentials.php";
//Arrays
//$errors = array();
//$data = array();
$article_id = $_REQUEST['article_id'];
$index = $_REQUEST['index'];

//Check conditions/Validation
$body = $_REQUEST['body'][$index];

  $database->update("article_texts", [
    "body" => $body
  ], [
   "section" => $index+1
  ]);

echo '<script type="text/javascript">window.location = "../update_article.php?article_id=' . $article_id . '"</script>';

}

 ?>