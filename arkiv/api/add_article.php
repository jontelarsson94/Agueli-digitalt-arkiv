<?php

require_once "../inc/db_credentials.php";
require_once "add_photo.php";
//Arrays
$errors = array();
$data = array();
//Check conditions/Validation
if (empty($_POST['title']))
  $errors['title'] = 'Title is required.';

if (empty($_POST['body']))
  $errors['body'] = 'Body is required.';
//Write to db

$articleId = $database->insert("articles", [
  "title" => $_POST['title'],
  "body" => $_POST['body']
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

$index = 0;
foreach ($_FILES['fileToUpload']['name'] as $imp) {
  $fileId = UploadFile('fileToUpload', $database, $index);

  $database->insert("article_images", [
    "image_id" => $fileId,
    "article_id" => $articleId
  ]);

  $index = $index+1;
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
