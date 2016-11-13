<?
  //DB login
  require_once "../inc/db_credentials.php";
  //Arrays
  $errors = array();
  $data = array();
  //Arguments
  if (empty($_GET['article_id'])){
    $errors['article_id'] = "article_id required!";
  }

  $article_id = $_GET['article_id'];
  //Get data from DB
  $article = $database->get("articles", [
  	"title",
  	"body"
  ], [
  	"id" => $article_id
  ]);

  $tag_ids = $database->select("article_tags", [
    "tag_id"
  ], [
    "article_id" => $article_id
  ]);

  $tags = array();
  foreach($tag_ids as $tag_id){
    $tag = $database->get("tags", [
      "id",
      "name"
    ], [
      "id" => $tag_id
    ]);
    array_push($tags, $tag);
  }

  $image_ids = $database->select("article_images", [
    "image_id"
  ], [
    "article_id" => $article_id
  ]);

  $images = array();
  foreach ($image_ids as $image_id) {
    $image = $database->get("images", [
      "url"
    ], [
      "id" => $image_id
    ]);
    array_push($images, $image);
  }


  //Set return statement
  if (!empty($errors)) {
    $data['success'] = false;
    $data['errors']  = $errors;
  } else {
    $data['success'] = true;
    $data['message'] = 'Article retrieved!';
    $data['article'] = $article;
    $data['tags'] = $tags;
    $data['images'] = $images;
  }
  //Return data
  echo json_encode($data);
?>
