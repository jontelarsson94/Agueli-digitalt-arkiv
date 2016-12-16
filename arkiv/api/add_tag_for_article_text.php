<?php
  //DB login
  require_once "../inc/db_credentials.php";
  //Arrays
  $errors = array();
  $data = array();
  $tag_name = $_REQUEST["tag"];
  $article_id = $_REQUEST["article_id"];
  $data['tag_name'] = $tag_name;
  $data['article_id'] = $article_id;
  //$data['tag'] = $tag_name;
  //$data['category'] = $category_id;

  $tag_id = $database->get("tags", "id", [
    "name" => $tag_name
  ]);

  if($tag_id == NULL){
    $tag_id = $database->insert("tags", [
      "name" => $tag_name
    ]);
  }

  $database->insert("article_tags", [
    "tag_id" => $tag_id,
    "article_id" => $article_id
  ]);

  //Set return statement
  $data['success'] = true;
  //$data['result'] = $tags;
  //Return data
  echo json_encode($data);
?>
