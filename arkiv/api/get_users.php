<?php
  //DB login
require_once "../inc/check_admin.php";

if(checkAdmin() == "admin"){
  require_once "../inc/db_credentials.php";
  //Arrays
  $errors = array();
  $data = array();

  $users = $database->select("users", [
    "id",
    "email"
  ]);

  //Set return statement
  if (!empty($errors)) {
    $data['success'] = false;
    $data['errors']  = $errors;
  } else {
    $data['success'] = true;
    //$data['category'] = $category;
    $data['users'] = $users;
  }
  //Return data
  echo json_encode($data);

}
?>