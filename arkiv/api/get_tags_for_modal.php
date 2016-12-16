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

  $medium = $database->avg("tags", "count");
  $small = $medium*0.5;
  $large = $medium*1.5;

  $tags = $database->select("category_tags", "tag_id", [
    "category_id" => $categories[0]['id']
    ]);

  $categoryOne_tags = array();
  
  foreach($tags as $tag){
    $categoryOne_tag = $database->get("tags", [
      "id",
      "name",
      "count"
      ], [
      "id" => $tag
      ]);

    $size = 0;
    if($categoryOne_tag['count'] < $small){
      $size = 1;
    }
    elseif ($categoryOne_tag['count'] >= $small && $categoryOne_tag['count'] < $medium) {
      $size = 2;
    }
    elseif ($categoryOne_tag['count'] >= $medium && $categoryOne_tag['count'] < $large) {
      $size = 3;
    }
    else {
      $size = 4;
    }

    array_push($categoryOne_tags, ["id" => $categoryOne_tag["id"], "name" => $categoryOne_tag["name"], "articlesExists" => 1, "tagExists" => 0, "size" => $size]);
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

    $size = 0;
    if($categoryTwo_tag['count'] < $small){
      $size = 1;
    }
    elseif ($categoryTwo_tag['count'] >= $small && $categoryTwo_tag['count'] < $medium) {
      $size = 2;
    }
    elseif ($categoryTwo_tag['count'] >= $medium && $categoryTwo_tag['count'] < $large) {
      $size = 3;
    }
    else {
      $size = 4;
    }

    array_push($categoryTwo_tags, ["id" => $categoryTwo_tag["id"], "name" => $categoryTwo_tag["name"], "articlesExists" => 1, "tagExists" => 0, "size" => $size]);
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

    $size = 0;
    if($categoryThree_tag['count'] < $small){
      $size = 1;
    }
    elseif ($categoryThree_tag['count'] >= $small && $categoryThree_tag['count'] < $medium) {
      $size = 2;
    }
    elseif ($categoryThree_tag['count'] >= $medium && $categoryThree_tag['count'] < $large) {
      $size = 3;
    }
    else {
      $size = 4;
    }

    array_push($categoryThree_tags, ["id" => $categoryThree_tag["id"], "name" => $categoryThree_tag["name"], "articlesExists" => 1, "tagExists" => 0, "size" => $size]);
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