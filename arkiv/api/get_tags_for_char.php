
<?php
  //print_r($_GET);
  require_once "../inc/db_credentials.php";
  $data = array();

  $categoryOne_id = $_REQUEST['categoryOne_id'];
  $categoryTwo_id = $_REQUEST['categoryTwo_id'];
  $categoryThree_id = $_REQUEST['categoryThree_id'];
  $char = $_REQUEST['char'];
  $char_tag_ids = $database->select("tags", [
    "id",
    "name",
    "count"
    ], [
    "name[~]" => [$char . "%", strtolower($char) . "%"]
  ]);

  $medium = $database->avg("tags", "count");
  $small = $medium*0.5;
  $large = $medium*1.5;



  if (!empty($_REQUEST['tags'])) {
    $pieces = explode(",", $_REQUEST['tags']);

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

  $article_ids = $database->query($query)->fetchAll();
  $data['article_ids'] = $article_ids;
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
}

  $char_tags = array();
  foreach ($char_tag_ids as $char_tag_id) {
    $articlesExists = 0;
    $tagExists = 0;
    $size = 0;
    $char_tag = $database->get("tags", [
      "id",
      "name",
      "count"
      ], [
      "id" => $char_tag_id['id']
      ]);

    if($char_tag['count'] < $small){
      $size = 1;
    }
    elseif ($char_tag['count'] >= $small && $char_tag['count'] < $medium) {
      $size = 2;
    }
    elseif ($char_tag['count'] >= $medium && $char_tag['count'] < $large) {
      $size = 3;
    }
    else {
      $size = 4;
    }

    if (!empty($_REQUEST['tags'])){
    foreach($article_ids as $article_id){
      $exists = $database->select("article_tags", "tag_id", [
        "AND" => [
          "tag_id" => $char_tag["id"],
          "article_id" => $article_id["article_id"]
        ]
      ]);
      if($exists != NULL){
        $articlesExists = 1;
      }
    }
    foreach($tags as $tag){
      if($tag['id'] == $char_tag_id['id']){
        $tagExists = 1;
      }
    }
    array_push($char_tags, ["id" => $char_tag["id"], "name" => $char_tag["name"], "articlesExists" => $articlesExists, "tagExists" => $tagExists, "size" => $size]);
    $articleExists = 0;
    $tagExists = 0;
  }
  else{
    array_push($char_tags, ["id" => $char_tag["id"], "name" => $char_tag["name"], "articlesExists" => 1, "tagExists" => 0, "size" => $size]);
  }
}

  $data['success'] = true;
  if (!empty($_REQUEST['tags'])){
    $data['tags'] = $tags; 
    $data['char_tags'] = $char_tags;
  }else{
    $char_tags = array();
    foreach ($char_tag_ids as $char_tag_id) {
      $size = 0;
      if($char_tag_id['count'] < $small){
        $size = 1;
      }
      elseif ($char_tag_id['count'] >= $small && $char_tag_id['count'] < $medium) {
        $size = 2;
      }
      elseif ($char_tag_id['count'] >= $medium && $char_tag_id['count'] < $large) {
        $size = 3;
      }
      else {
        $size = 4;
      }
      array_push($char_tags, ["id" => $char_tag_id["id"], "name" => $char_tag_id["name"], "articlesExists" => 1, "tagExists" => 0, "size" => $size]);
    }
    $data['char_tags'] = $char_tags;
    $data['tags'] = [];
  }
  echo json_encode($data);


 ?>

