<?php

require_once "../inc/db_credentials.php";
require_once "add_photo.php";
//Arrays
$errors = array();
$data = array();
//Check conditions/Validation
if (empty($_POST['title']))
  $errors['title'] = 'Title is required.';


$articleId = $database->insert("articles", [
  "title" => $_POST['title'],
  "summary" => $_POST['summary'],
  "body1" => $_POST['body1'],
  "body2" => $_POST['body2'],
  "body3" => $_POST['body3'],
  "type" => "article"
]);

if(!empty($_POST['tags']))
{
  $tags = explode(", ", $_POST['tags']);
  foreach ($tags as $tag) {
    $tagId = $database->get('tags', [
      'id'
    ],[
      'name' => $tag
    ]);
    $tag_id = $tagId['id'];

    if($tag_id == NULL){
       $tag_id = $database->insert("tags", [
        'name' => $tag
      ]);
    }
    //echo $tag_id;
    $database->insert("article_tags", [
	     'article_id' => $articleId,
	      'tag_id' => $tag_id
       ]);

  }
}

if(!empty($_FILES['cardImage']['name'])){
  $fileId = UploadSingleFile("cardImage", $database);

  $database->insert("article_images", [
    "image_id" => $fileId,
    "article_id" => $articleId,
    "section" => -1,
    "isCardImage" => 1
  ]);
}

if(!empty($_FILES['image1']['name'])){
  $fileId = UploadSingleFile("image1", $database);

  $database->insert("article_images", [
    "image_id" => $fileId,
    "article_id" => $articleId,
    "section" => 1
  ]);
}

if(!empty($_FILES['image2']['name'])){
  $fileId = UploadSingleFile('image2', $database);

  $database->insert("article_images", [
    "image_id" => $fileId,
    "article_id" => $articleId,
    "section" => 2
  ]);
}

if(!empty($_FILES['image3']['name'])){
  $fileId = UploadSingleFile('image3', $database);

  $database->insert("article_images", [
    "image_id" => $fileId,
    "article_id" => $articleId,
    "section" => 3
  ]);
}

if(!empty($_FILES['fileToUpload']['name'][0])){
$index = 0;
foreach ($_FILES['fileToUpload']['name'] as $imp) {
  $fileId = UploadFile('fileToUpload', $database, $index);

  $database->insert("article_images", [
    "image_id" => $fileId,
    "article_id" => $articleId,
    "section" => 0
  ]);

  $index = $index+1;
}
}

//Set return statement
if (!empty($errors)) {
  $data['success'] = false;
  $data['errors']  = $errors;
} else {
  $data['success'] = true;
  $data['message'] = 'Article added successfully!';
  $data['result'] = $result;
}
//Return data
//here we should show the article
echo json_encode($data);
 ?>
