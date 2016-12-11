<?php
  //DB login
  require_once "../inc/db_credentials.php";
  //Arrays
  $errors = array();
  $data = array();
  $tag_id = $_REQUEST["tag_id"];
  $article_id = $_REQUEST["article_id"];

  $exists = $database->get("article_tags", "tag_id", [
  "AND" => [
    "tag_id" => $tag_id,
    "article_id" => $article_id
  ]
]);
  if($exists == false){
    $database->insert("article_tags", [
      "tag_id" => $tag_id,
      "article_id" => $article_id
    ]);
  }


  //Set return statement
  if (!empty($errors)) {
    $data['success'] = false;
    //$data['errors']  = $errors;
  } else {
    $data['exists'] = $exists;
    $data['success'] = true;
    //$data['result'] = $tags;
  }
  //Return data
  echo json_encode($data);
?>
