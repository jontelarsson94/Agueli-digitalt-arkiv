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
      $query = "SELECT tag_id from article_tags where article_id IN (" . $query . ") AND tag_id= " . $value;
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

  $categoryOne_tag_ids = $database->select("category_tags", "tag_id", [
    "category_id" => $categoryOne_id
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
    foreach($article_ids as $article_id){
      $articlesExists = $database->select("article_tags", "tag_id", [
        "AND" => [
          "tag_id" => $categoryOne_tag_id["tag_id"],
          "article_id" => $article_id["article_id"]
        ]
      ]);
      if($articlesExists != NULL){
        $articlesExists = 1;
        break 1;
      }
    }
    foreach($tags as $tag){
      if($tag['id'] == $categoryOne_tag_id){
        $tagExists = 1;
      }
    }

    array_push($categoryOne_tags, ["id" => $categoryOne_tag["id"], "name" => $categoryOne_tag["name"], "articleExists" => $articlesExists, "tagExists" => $tagExists]);
    $articleExists = 0;
    $tagExists = 0;
  }

  $data['success'] = true;
  $data['categoryOne_tags'] = $categoryOne_tags;
  echo json_encode($data);
}
 ?>
