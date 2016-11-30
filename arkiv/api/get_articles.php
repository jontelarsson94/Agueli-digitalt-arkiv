<?php
  //DB login
  require_once "../inc/db_credentials.php";
  //Arrays
  $errors = array();
  $data = array();
  $lastReadId = -1;

  if(isset($_COOKIE['lastReadId'])) {
      $lastReadId = $_COOKIE['lastReadId'];
  }

  $articles_lastRead = $database->select("articles", [
    "id",
	   "title"
  ], [
    "id" => $lastReadId
  ]);

  //Get data from DB
  $articles = $database->select("articles", [
    "id",
	   "title"
  ], array('AND' => array('star' => 0, "id[!]" => $lastReadId)));

  $articles_starred = $database->select("articles", [
    "id",
	   "title"
  ], array('AND' => array('star' => 1, "id[!]" => $lastReadId)));

  $main_images = array();
  $main_images_starred = array();
  $main_images_lastRead = array();

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

  foreach($articles_starred as $article_starred)
  {
    $main_image_starred_id = $database->get("article_images", [
      "image_id"
    ], array('AND' => array('article_id' => $article_starred['id'], "isCardImage" => 1))
    );
    $main_image_starred_url = $database->get("images", [
      "url"
    ], [
      "id" => $main_image_starred_id
    ]);
    array_push($main_images_starred, $main_image_starred_url);
  }

  foreach($articles_lastRead as $article_lastRead)
  {
    $main_image_lastRead_id = $database->get("article_images", [
      "image_id"
    ], array('AND' => array('article_id' => $article_lastRead['id'], "isCardImage" => 1))
    );
    $main_image_lastRead_url = $database->get("images", [
      "url"
    ], [
      "id" => $main_image_lastRead_id
    ]);
    array_push($main_images_lastRead, $main_image_lastRead_url);
  }

  //Set return statement
  if (!empty($errors)) {
    $data['success'] = false;
    $data['errors']  = $errors;
  } else {
    $data['success'] = true;
    $data['message'] = 'Articles retrieved!';
    $data['main_images'] = $main_images;
    $data['main_images_starred'] = $main_images_starred;
    $data['main_images_lastRead'] = $main_images_lastRead;
    $data['result'] = $articles;
    $data['result_starred'] = $articles_starred;
    $data['result_lastRead'] = $articles_lastRead;
    $data['page'] = 4;
  }
  //Return data
  echo json_encode($data);
?>
