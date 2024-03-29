<?php

  //DB login
require_once "../inc/check_admin.php";

if(checkAdmin() != "nothing" && $_SERVER['HTTP_X_XSRF_TOKEN'] == $_COOKIE['XSRF-TOKEN']){

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
    $count = $database->get("tags", "count", [
    "id" => $tag_id
    ]);

  $database->update("tags", [
        'count' => $count+1
      ], [
        'id' => $tag_id
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
}
?>
