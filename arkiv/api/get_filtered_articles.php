<?php

  //print_r($_GET);
  require_once "../inc/db_credentials.php";
  $data = array();

  if (!empty($_REQUEST['tags'])) {
    $pieces = explode(",", $_REQUEST['tags']);

  $query = "";
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

  $main_images = array();
  $articles = array();

  $article_ids = $database->query($query)->fetchAll();

  shuffle($article_ids);

  foreach($article_ids as $article_id){
    $article = $database->get("articles", [
	      "id",
	      "title",
        "summary",
        "star"
    ], [
	      "id" => $article_id["article_id"]
      ]);
    array_push($articles, ["id" => $article['id'], "title" => $article['title'], "summary" => $article["summary"], "starred" => $article['star'], "read" => 0]);
    //echo $article['title'];
    $main_image_id = $database->get("article_images", [
      "image_id"
    ], array('AND' => array('article_id' => $article['id'], "isCardImage" => 1))
    );
    $main_image_url = $database->get("images", [
      "url"
    ], [
      "id" => $main_image_id
    ]);
    array_push($main_images, $main_image_url);
  }
  //$data['query'] = "SELECT title FROM article_tags" . $query;
  $data['success'] = true;
  $data['message'] = 'Articles retrieved!';
  $data['main_images'] = $main_images;
  $data['result'] = $articles;
  $data['result_starred'] = "";
  $data['result_lastRead'] = "";
  $data['tags'] = $tags;
  $data['page'] = 12;
  echo json_encode($data);
}
else{
  require_once "get_articles.php";
}
 ?>
