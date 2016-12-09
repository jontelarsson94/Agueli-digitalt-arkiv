<?php
  //DB login
  require_once "../inc/db_credentials.php";
  //Arrays
  $errors = array();
  $data = array();
  $category_id = $_REQUEST["category_id"];

  $tag = $database->select("categories", [
    "id",
    "name"
  ]);

  $tags = $database->select("tags", [
    "id",
    "name"
    ], [
    "id" => $database->select("category_tags", "tag_id", ["category_id" => $category_id])
  ]);

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
