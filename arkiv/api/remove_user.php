<?php

require_once "../inc/check_admin.php";

  if(checkAdmin() == "admin" && $_SERVER['HTTP_X_XSRF_TOKEN'] == $_COOKIE['XSRF-TOKEN']){

  //DB login
  require_once "../inc/db_credentials.php";
  //Arrays
  $errors = array();
  $data = array();
  $id = $_REQUEST["id"];

  $success = $database->delete("users", [
    "id" => $id
  ]);

  //echo $database->last_query();
  /*if($success == 0){
    errors["error"] = "No tags found in this category";
  }*/
  //Set return statement
  $data['success'] = true;
  //Return data
  echo json_encode($data);
}
?>