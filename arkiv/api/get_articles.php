<?php
  //DB login
  require_once "../inc/db_credentials.php";
  //Arrays
  $errors = array();
  $data = array();
  //Get data from DB
  $result = $database->select("articles", [
    "id",
	   "title"
  ]);
  //Set return statement
  if (!empty($errors)) {
    $data['success'] = false;
    $data['errors']  = $errors;
  } else {
    $data['success'] = true;
    $data['message'] = 'Articles retrieved!';
    $data['result'] = $result;
  }
  //Return data
  echo json_encode($data);
?>
