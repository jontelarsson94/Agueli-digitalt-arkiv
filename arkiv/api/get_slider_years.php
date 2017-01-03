<?php

  //DB login
  require_once "../inc/db_credentials.php";
  //Arrays
  $errors = array();
  $data = array();

  $tags = $database->select("tags", [
    "id",
    "name"
  ], [
    "name[>]" => 0
  ]);

  $min = intval($tags[0]['name']);
  $max = intval($tags[0]['name']);

  foreach ($tags as $tag) {
    if(intval($tag['name']) < $min){
      $min = intval($tag['name']);
    }
    if(intval($tag['name']) > $max){
      $max = intval($tag['name']);
    }
  }

  $years = array();
  array_push($years, ['min' => $min, 'max' => $max]);

  //Set return statement
  if (!empty($errors)) {
    $data['success'] = false;
    $data['errors']  = $errors;
  } else {
    $data['success'] = true;
    //$data['category'] = $category;
    $data['years'] = $years;
  }
  //Return data
  echo json_encode($data);
?>
