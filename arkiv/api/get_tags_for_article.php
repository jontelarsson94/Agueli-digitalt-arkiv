<?php
  //DB login
  require_once "../inc/db_credentials.php";
  //Arrays
  $errors = array();
  $data = array();
  $article_id = $_REQUEST["article_id"];

  $tag_ids = $database->select("article_tags", [
    "tag_id"
    ], [
    "article_id" => $article_id
  ]);

  $tags = array();

  foreach ($tag_ids as $tag_id) {
    $tag = $database->get("tags", [
      "id",
      "name"
      ],[
      "id" => $tag_id
      ]);
    array_push($tags, $tag);
  }

  //Set return statement
  if (!empty($errors)) {
    $data['success'] = false;
    $data['errors']  = $errors;
  } else {
    $data['success'] = true;
    $data['result'] = $tags;
  }
  //Return data
  echo json_encode($data);
?>
