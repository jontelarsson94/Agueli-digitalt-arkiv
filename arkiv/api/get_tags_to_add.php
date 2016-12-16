<?php
  //DB login
  require_once "../inc/db_credentials.php";
  //Arrays
  $errors = array();
  $data = array();
  $tags = array();

  $article_id = $_REQUEST['article_id'];

  $tag_ids = $database->select("tags", [
    "id",
    "name"
  ]);

  foreach($tag_ids as $tag){
    $inArticle = $database->get("article_tags", "tag_id", [
      "AND" =>[
        "article_id" => $article_id,
        "tag_id" => $tag['id']
      ]
    ]);
    if($inArticle == false){
      array_push($tags, ["id" => $tag['id'], "name" => $tag['name']]);
    }
  }
  
    $data['success'] = true;
    //$data['category'] = $category;
    $data['result'] = $tags;
  
  //Return data
  echo json_encode($data);
?>