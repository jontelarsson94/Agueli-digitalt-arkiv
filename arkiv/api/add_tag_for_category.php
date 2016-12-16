<?php
  //DB login
  require_once "../inc/db_credentials.php";
  //Arrays
  $errors = array();
  $data = array();
  $tag_name = $_REQUEST["tag"];
  $category_id = $_REQUEST["category"];
  $data['tag'] = $tag_name;
  $data['category'] = $category_id;

  $tag_id = $database->get("tags", "id", [
    "name" => $tag_name
  ]);

  if($tag_id == NULL){
    $tag_id = $database->insert("tags", [
      "name" => $tag_name
    ]);
    $data['message'] = "";
  }else{
    $exists = $database->get("category_tags", "tag_id", [
      "AND" =>[
        "category_id" => $category_id,
        "tag_id" => $tag_id
      ]
      ]);
    if($exists == false){
      $data['message'] = "";
    }
    else{
      $data['message'] = "That tag already exists in this category";
    }
  }


  $database->insert("category_tags", [
    "tag_id" => $tag_id,
    "category_id" => $category_id
  ]);

  //Set return statement
  if (!empty($errors)) {
    $data['success'] = false;
    //$data['errors']  = $errors;
  } else {
    $data['success'] = true;
    //$data['result'] = $tags;
  }
  //Return data
  echo json_encode($data);
?>
