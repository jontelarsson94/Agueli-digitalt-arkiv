<?php
  //DB login
  require_once "../inc/db_credentials.php";
  //Arrays
  $errors = array();
  $data = array();

  $categories = $database->query("SELECT id, name FROM categories ORDER BY RAND() LIMIT 3")->fetchAll();

  $data['categoryOne'] = $categories[0];
  $data['categoryTwo'] = $categories[1];
  $data['categoryThree'] = $categories[2];

  $tags = $database->select("category_tags", "tag_id", [
    "category_id" => $categories[0]['id']
    ]);

  $categoryOne_tags = array();
  
  foreach($tags as $tag){
    $categoryOne_tag = $database->get("tags", [
      "id",
      "name"
      ], [
      "id" => $tag
      ]);
    array_push($categoryOne_tags, $categoryOne_tag);
  }

  $tags = $database->select("category_tags", "tag_id", [
    "category_id" => $categories[1]['id']
    ]);

  $categoryTwo_tags = array();
  
  foreach($tags as $tag){
    $categoryTwo_tag = $database->get("tags", [
      "id",
      "name"
      ], [
      "id" => $tag
      ]);
    array_push($categoryTwo_tags, $categoryTwo_tag);
  }

  $tags = $database->select("category_tags", "tag_id", [
    "category_id" => $categories[2]['id']
    ]);

  $categoryThree_tags = array();
  
  foreach($tags as $tag){
    $categoryThree_tag = $database->get("tags", [
      "id",
      "name"
      ], [
      "id" => $tag
      ]);
    array_push($categoryThree_tags, $categoryThree_tag);
  }

  //Set return statement
  if (!empty($errors)) {
    $data['success'] = false;
    $data['errors']  = $errors;
  } else {
    $data['success'] = true;
    $data['category'] = $category;
    $data['categoryOne_tags'] = $categoryOne_tags;
    $data['categoryTwo_tags'] = $categoryTwo_tags;
    $data['categoryThree_tags'] = $categoryThree_tags;
  }
  //Return data
  echo json_encode($data);
?>