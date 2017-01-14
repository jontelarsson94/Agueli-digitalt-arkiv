<?php

  //DB login
  require_once "../inc/db_credentials.php";
  //Arrays
  $errors = array();
  $data = array();
  $lastReadId = -1;

  if(isset($_COOKIE['lastReadId'])) {
      $lastReadId = json_decode($_COOKIE['lastReadId'], true);
  }

  $articles_lastRead = $database->select("articles", [
      "id",
      "title",
      "summary",
  ], [
    "id" => $lastReadId
  ]);

  shuffle($articles_lastRead);

  $articles = array();
  //Get data from DB
  $articles_normal = $database->select("articles", [
      "id",
      "title",
      "summary"
  ], array('AND' => array('star' => 0, "id[!]" => $lastReadId)));

  shuffle($articles_normal);

  $articles_starred = $database->select("articles", [
      "id",
      "title",
      "summary"
  ], array('AND' => array('star' => 1, "id[!]" => $lastReadId)));

  shuffle($articles_starred);

  $main_images = array();
  $main_images_starred = array();
  $main_images_lastRead = array();

  if(count($articles_normal) >= count($articles_starred) && count($articles_normal) >= count($articles_lastRead)){
    $index = 0;
    foreach ($articles_normal as $article_normal) {
      array_push($articles, ["id" => $article_normal["id"], "title" => $article_normal["title"], "summary" => $article_normal["summary"], "starred" => 0, "read" => 0]);
      if($articles_starred[$index] != NULL){
        array_push($articles, ["id" => $articles_starred[$index]["id"], "title" => $articles_starred[$index]["title"], "summary" => $articles_starred[$index]["summary"], "starred" => 1, "read" => 0]);
      }
      if($articles_lastRead[$index] != NULL){
        array_push($articles, ["id" => $articles_lastRead[$index]["id"], "title" => $articles_lastRead[$index]["title"], "summary" => $articles_lastRead[$index]["summary"], "starred" => 0, "read" => 1]);
      }
      $index = $index+1;
    }
  }
  elseif(count($articles_starred) >= count($articles_normal) && count($articles_starred) >= count($articles_lastRead)){
    $index = 0;
    foreach ($articles_starred as $article_starred) {
      array_push($articles, ["id" => $article_starred["id"], "title" => $article_starred["title"], "summary" => $article_starred["summary"], "starred" => 1, "read" => 0]);
      if($articles_normal[$index] != NULL){
        array_push($articles, ["id" => $articles_normal[$index]["id"], "title" => $articles_normal[$index]["title"], "summary" => $articles_normal[$index]["summary"], "starred" => 0, "read" => 0]);
      }
      if($articles_lastRead[$index] != NULL){
        array_push($articles, ["id" => $articles_lastRead[$index]["id"], "title" => $articles_lastRead[$index]["title"], "summary" => $articles_lastRead[$index]["summary"], "starred" => 0, "read" => 1]);
      }
      $index = $index+1;
    }
  }else{
    $index = 0;
    foreach ($articles_lastRead as $article_lastRead) {
      array_push($articles, ["id" => $article_lastRead["id"], "title" => $article_lastRead["title"], "summary" => $article_lastRead["summary"], "starred" => 0, "read" => 1]);
      if($articles_normal[$index] != NULL){
        array_push($articles, ["id" => $articles_normal[$index]["id"], "title" => $articles_normal[$index]["title"], "summary" => $articles_normal[$index]["summary"], "starred" => 0, "read" => 0]);
      }
      if($articles_starred[$index] != NULL){
        array_push($articles, ["id" => $articles_starred[$index]["id"], "title" => $articles_starred[$index]["title"], "summary" => $articles_starred[$index]["summary"], "starred" => 1, "read" => 0]);
      }
      $index = $index+1;
    }
  }

  foreach($articles as $article)
  {
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

  //Set return statement
  if (!empty($errors)) {
    $data['success'] = false;
    $data['errors']  = $errors;
  } else {
    $data['success'] = true;
    $data['message'] = 'Articles retrieved!';
    $data['main_images'] = $main_images;
    $data['result'] = $articles;
    $data['page'] = 9;
  }
  //Return data
  echo json_encode($data);
?>
