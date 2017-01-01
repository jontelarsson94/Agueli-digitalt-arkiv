<?php
  //DB login
  require_once "../inc/db_credentials.php";
  //Arrays
  $errors = array();
  $data = array();

  $name = $_REQUEST['name'];

  $tag = $database->select("tags", [
    "id"
    ], [
    "name" => $name
    ]);

  //Set return statement
  if (!empty($errors)) {
    $data['success'] = false;
    $data['errors']  = $errors;
  } else {
    $data['success'] = true;
    //$data['category'] = $category;
    $data['result'] = $tag;
  }
  //Return data
  echo json_encode($data);
?>