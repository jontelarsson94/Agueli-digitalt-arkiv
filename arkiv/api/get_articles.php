<?php
  //DB login
  require_once "../inc/db_credentials.php";
  //Arrays
  $errors = array();
  $data = array();
  //Get data from DB
  $articles = $database->select("articles", [
    "id",
	   "title"
  ]);
  $main_images = array();

  foreach($articles as $article)
  {
    $main_image_id = $database->get("article_images", [
      "image_id"
    ], [
      "article_id" => $article['id']
    ]);
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
  }
  //Return data
  echo json_encode($data);
?>
