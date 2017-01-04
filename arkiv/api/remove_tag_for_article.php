<?php

require_once "../inc/check_admin.php";

if(checkAdmin() != "nothing" && $_SERVER['HTTP_X_XSRF_TOKEN'] == $_COOKIE['XSRF-TOKEN']){

  //DB login
  require_once "../inc/db_credentials.php";
  //Arrays
  $errors = array();
  $data = array();
  $article_id = $_REQUEST["article_id"];
  $tag_id = $_REQUEST["tag_id"];

  $success = $database->delete("article_tags", [
    "AND" => [
      "article_id" => $article_id,
      "tag_id" => $tag_id
    ]
  ]);

  //echo $database->last_query();
  /*if($success == 0){
    errors["error"] = "No tags found in this category";
  }*/
  //Set return statement
  $data['success'] = true;
  //Return data
  echo json_encode($data);
}
?>
