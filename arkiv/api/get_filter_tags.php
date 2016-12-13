<?php
  //print_r($_GET);
  require_once "../inc/db_credentials.php";
  $data = array();

  $categoryOne_id = $_REQUEST['categoryOne_id'];
  $categoryTwo_id = $_REQUEST['categoryTwo_id'];
  $categoryThree_id = $_REQUEST['categoryThree_id'];

  if (!empty($_REQUEST['tags'])) {
    $pieces = explode(",", $_REQUEST['tags']);

  $tags = array();
  foreach($pieces as $key => $value){
    if($key == 1){
      $query = "SELECT article_id FROM article_tags WHERE tag_id = " . $value;
    }
    if($key > 1){
      $query = "SELECT article_id from article_tags where article_id IN (" . $query . ") AND tag_id= " . $value;
    }
    if($key > 0){
      $tag = $database->get("tags", [
        "id",
        "name"
      ], [
        "id" => $value
      ]);
      array_push($tags, ["id" => $tag["id"], "name" => $tag["name"]]);
    }
  }


  $article_ids = $database->query($query)->fetchAll();
  $data['article_ids'] = $article_ids;
  foreach($article_ids as $article_id){
    $article = $database->get("articles", [
        "id",
        "title"
    ], [
        "id" => $article_id["article_id"]
      ]);
    array_push($articles, ["id" => $article['id'], "title" => $article['title']]);
    //echo $article['title'];
  }
}

  $categoryOne_tag_ids = $database->select("category_tags", "tag_id", [
    "category_id" => $categoryOne_id
  ]);

  $categoryTwo_tag_ids = $database->select("category_tags", "tag_id", [
    "category_id" => $categoryTwo_id
  ]);

  $categoryThree_tag_ids = $database->select("category_tags", "tag_id", [
    "category_id" => $categoryThree_id
  ]);

  $categoryOne_tags = array();
  foreach ($categoryOne_tag_ids as $categoryOne_tag_id) {
    $articlesExists = 0;
    $tagExists = 0;
    $categoryOne_tag = $database->get("tags", [
      "id",
      "name"
      ], [
      "id" => $categoryOne_tag_id
      ]);
    if (!empty($_REQUEST['tags'])){
    foreach($article_ids as $article_id){
      $exists = $database->select("article_tags", "tag_id", [
        "AND" => [
          "tag_id" => $categoryOne_tag["id"],
          "article_id" => $article_id["article_id"]
        ]
      ]);
      if($exists != NULL){
        $articlesExists = 1;
      }
    }
    foreach($tags as $tag){
      if($tag['id'] == $categoryOne_tag_id){
        $tagExists = 1;
      }
    }

    array_push($categoryOne_tags, ["id" => $categoryOne_tag["id"], "name" => $categoryOne_tag["name"], "articlesExists" => $articlesExists, "tagExists" => $tagExists]);
    $articleExists = 0;
    $tagExists = 0;
  }
  else{
    array_push($categoryOne_tags, ["id" => $categoryOne_tag["id"], "name" => $categoryOne_tag["name"], "articlesExists" => 1, "tagExists" => 0]);
  }
}

  $categoryTwo_tags = array();
  foreach ($categoryTwo_tag_ids as $categoryTwo_tag_id) {
    $articlesExists = 0;
    $tagExists = 0;
    $categoryTwo_tag = $database->get("tags", [
      "id",
      "name"
      ], [
      "id" => $categoryTwo_tag_id
      ]);
    if (!empty($_REQUEST['tags'])){
    foreach($article_ids as $article_id){
      $exists = $database->select("article_tags", "tag_id", [
        "AND" => [
          "tag_id" => $categoryTwo_tag["id"],
          "article_id" => $article_id["article_id"]
        ]
      ]);
      if($exists != NULL){
        $articlesExists = 1;
      }
    }
    foreach($tags as $tag){
      if($tag['id'] == $categoryTwo_tag_id){
        $tagExists = 1;
      }
    }

    array_push($categoryTwo_tags, ["id" => $categoryTwo_tag["id"], "name" => $categoryTwo_tag["name"], "articlesExists" => $articlesExists, "tagExists" => $tagExists]);
    $articleExists = 0;
    $tagExists = 0;
  }else{
    array_push($categoryTwo_tags, ["id" => $categoryTwo_tag["id"], "name" => $categoryTwo_tag["name"], "articlesExists" => 1, "tagExists" => 0]);
  }
  }

  $categoryThree_tags = array();
  foreach ($categoryThree_tag_ids as $categoryThree_tag_id) {
    $articlesExists = 0;
    $tagExists = 0;
    $categoryThree_tag = $database->get("tags", [
      "id",
      "name"
      ], [
      "id" => $categoryThree_tag_id
      ]);
    if (!empty($_REQUEST['tags'])){
    foreach($article_ids as $article_id){
      $exists = $database->select("article_tags", "tag_id", [
        "AND" => [
          "tag_id" => $categoryThree_tag["id"],
          "article_id" => $article_id["article_id"]
        ]
      ]);
      if($exists != NULL){
        $articlesExists = 1;
      }
    }
    foreach($tags as $tag){
      if($tag['id'] == $categoryThree_tag_id){
        $tagExists = 1;
      }
    }

    array_push($categoryThree_tags, ["id" => $categoryThree_tag["id"], "name" => $categoryThree_tag["name"], "articlesExists" => $articlesExists, "tagExists" => $tagExists]);
    $articleExists = 0;
    $tagExists = 0;
  }else{
    array_push($categoryThree_tags, ["id" => $categoryThree_tag["id"], "name" => $categoryThree_tag["name"], "articlesExists" => 1, "tagExists" => 0]);
  }
  }

  $data['success'] = true;
  if (!empty($_REQUEST['tags'])){
    $data['tags'] = $tags; 
  }else{
    $data['tags'] = [];
  }
  $data['categoryOne_tags'] = $categoryOne_tags;
  $data['categoryTwo_tags'] = $categoryTwo_tags;
  $data['categoryThree_tags'] = $categoryThree_tags;
  echo json_encode($data);


 ?>


