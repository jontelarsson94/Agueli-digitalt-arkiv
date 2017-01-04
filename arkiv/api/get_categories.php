<?php


  //DB login
  require_once "../inc/db_credentials.php";
  //Arrays
  $errors = array();
  $data = array();

  $categories = $database->select("categories", [
    "id",
    "name"
  ]);


  //Set return statement
  if (!empty($errors)) {
    $data['success'] = false;
    $data['errors']  = $errors;
  } else {
    $data['success'] = true;
    $data['result'] = $categories;
  }
  //Return data
  echo json_encode($data);
?>
