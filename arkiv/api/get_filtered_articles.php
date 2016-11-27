<?php
  //print_r($_GET);
  require_once "../inc/db_credentials.php";
  $data = array();

  if (!empty($_REQUEST['tags'])) {
    $pieces = explode(",", $_REQUEST['tags']);
  }
  $query = " WHERE ";
  foreach($pieces as $key => $tag){
    if($key > 1){
      $query .= " AND ";
    }
    if($key > 0){
      $query .= "tag_id=" . $tag;
    }
  }

  $articles = $database->query("SELECT * FROM article_tags" . $query)->fetchAll();
  foreach($articles as $article){
    echo $article['article_id'];
  }
  $data['echoing'] = $articles;
  $data['query'] = "SELECT * FROM article_tags" . $query;
  $data['success'] = true;
  echo json_encode($data);
 ?>
