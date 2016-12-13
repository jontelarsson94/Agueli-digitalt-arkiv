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
    "summary"
  ], [
  	"id" => $article_id
  ]);

  $num_of_tags = $database->count('article_tags');
  $num_of_tags2 = $database->count('tags');
  $medium = $num_of_tags/$num_of_tags2;
//need to do unique
  $small = $medium*0.5;
  $large = $medium*1.5;

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
    $num_current = $database->count('article_tags', [
      "tag_id" => $tag_id
    ]);
    if($num_current < $small){
      array_push($tags, ["size" => 1, "tag" => $tag]);
    }
    elseif ($num_current >= $small && $num_current < $medium) {
      array_push($tags, ["size" => 2, "tag" => $tag]);
    }
    elseif ($num_current >= $medium && $num_current < $large) {
      array_push($tags, ["size" => 3, "tag" => $tag]);
    }
    else {
      array_push($tags, ["size" => 4, "tag" => $tag]);
    }
  }

  $bodies = $database->select("article_texts", [
      "body",
      "section"
    ], [
      "article_id" => $article_id
    ], [
    // Single condition
    "ORDER" => "section"
    ]);

  /*foreach($tags as $tag)
  {
    if($article['body1'] != NULL){
      $article['body1'] = str_replace($tag['tag']['name'], '<span class="fake-link" data-ng-click="addTagToSearchFromText(' . $tag['tag']['id'] . '); getFilteredArticles()" data-dismiss="modal">' . $tag['tag']['name'] . '</span>', $article['body1']);
    }
    if($article['body2'] != NULL){
      $article['body2'] = str_replace($tag['tag']['name'], '<span class="fake-link" data-ng-click="addTagToSearchFromText(' . $tag['tag']['id'] . '); getFilteredArticles()" data-dismiss="modal">' . $tag['tag']['name'] . '</span>', $article['body2']);
    }
    if($article['body3'] != NULL){
      $article['body3'] = str_replace($tag['tag']['name'], '<span class="fake-link" data-ng-click="addTagToSearchFromText(' . $tag['tag']['id'] . '); getFilteredArticles()" data-dismiss="modal">' . $tag['tag']['name'] . '</span>', $article['body3']);
    }
  }*/

  $card_image_id = $database->get("article_images", "image_id", [
    "article_id" => $article_id
  ]);

  $card_image = $database->get("images", [
        "url"
      ], [
        "id" => $card_image_id
      ]);

  $image_ids = $database->select("article_images", "*", [
    "AND" => [
            "article_id" => $article_id,
            "section" =>  0,
    ]
  ]);

  $images = array();
  foreach ($image_ids as $image_id) {
    $image = $database->get("images", [
        "url"
      ], [
        "id" => $image_id['image_id']
      ]);
      array_push($images, $image);
  }

  $image_ids = $database->select("article_images", "*", [
    "AND" => [
            "article_id" => $article_id,
            "section[>=]" =>  1,
    ],[
    "ORDER" => "section"
    ]
  ]);

  $body_images = array();
  $index = 1;
  foreach ($image_ids as $image_id) {
    $image = $database->get("images", [
        "url"
      ], [
        "id" => $image_id['image_id']
      ]);
      $image['section'] = $image_id['section'];
      array_push($body_images, $image);
  }
  //Set return statement
  if (!empty($errors)) {
    $data['success'] = false;
    $data['errors']  = $errors;
  } else {
    $data['success'] = true;
    $data['message'] = 'Article retrieved!';
    $data['card_image'] = $card_image;
    $data['article'] = $article;
    $data['bodies'] = $bodies;
    $data['tags'] = $tags;
    $data['images'] = $images;
    $data['body_images'] = $body_images;
  }
  //Return data
  echo json_encode($data);
?>
