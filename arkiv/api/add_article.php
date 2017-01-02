<?php
require_once "../inc/check_admin.php";

if(checkAdmin() != "nothing"){

require_once "../inc/db_credentials.php";
require_once "add_photo.php";
//Arrays
$errors = array();
$data = array();
//Check conditions/Validation
if (empty($_POST['title']))
  $errors['title'] = 'Title is required.';

$favorite = 0;
if(!empty($_POST['favorite'])){
  $favorite = $_POST['favorite'];
}

$articleId = $database->insert("articles", [
  "title" => $_POST['title'],
  "summary" => $_POST['summary'],
  "type" => "article",
  "star" => $favorite
]);

if(!empty($_POST['tags']))
{
  $tags = explode(", ", $_POST['tags']);
  foreach ($tags as $tag) {
    $tagId = $database->get('tags', [
      'id',
      'count'
    ],[
      'name' => $tag
    ]);
    $tag_id = $tagId['id'];

    if($tag_id == NULL){
       $tag_id = $database->insert("tags", [
        'name' => $tag
      ]);
    }else{
      $database->update("tags", [
        'count' => $tagId['count']+1
      ], [
        'id' => $tag_id
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

if(isset($_FILES['image']['name'][0])){
$index = 0;
foreach ($_FILES['image']['name'] as $imp) {
  if(!empty($_FILES['image']['name'][$index])){
  $fileId = UploadFile('image', $database, $index);

  $database->insert("article_images", [
    "image_id" => $fileId,
    "article_id" => $articleId,
    "section" => $index+1
  ]);
}else{
  $fileId = $database->insert("images", [
    "url" => NULL
  ]);

  $database->insert("article_images", [
    "image_id" => $fileId,
    "article_id" => $articleId,
    "section" => $index+1
  ]);
}

  $index = $index+1;
}
$data['num_images'] = $index;
}

if(!empty($_FILES['fileToUpload']['name'][0])){
$index = 0;
foreach ($_FILES['fileToUpload']['name'] as $imp) {
  $fileId = UploadFile('fileToUpload', $database, $index);

  $database->insert("article_images", [
    "image_id" => $fileId,
    "article_id" => $articleId,
    "section" => 0,
    "galleryNumber" => $index+1
  ]);

  $index = $index+1;
}
}

if(isset($_POST['body'][0])){
  $index = 1;
  foreach($_POST['body'] as $body){
    $database->insert("article_texts", [
      "body" => $body,
      "article_id" => $articleId,
      "section" => $index
    ]);
    $index = $index+1;
  }
}

//testa att lägga till tom om $_POST[body][0] är tom eller vad som händer med isset

//Set return statement
/*if (!empty($errors)) {
  $data['success'] = false;
  $data['errors']  = $errors;
} else {
  $data['success'] = true;
  $data['message'] = 'Article added successfully!';
  $data['result'] = $result;
}
//Return data
//here we should show the article
echo json_encode($data);*/

echo '<script type="text/javascript">window.location = "../update_article.php?article_id=' . $articleId . '"</script>';

}
 ?>
