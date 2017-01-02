<?php

  //DB login
require_once "../inc/check_admin.php";

if(checkAdmin() != "nothing" && $_REQUEST['XSRF-TOKEN'] == $_COOKIE['XSRF-TOKEN']){

  require_once "../inc/db_credentials.php";
  //Arrays
  $errors = array();
  $data = array();
  $category_name = $_REQUEST["category"];

  $category_id = $database->get("categories", "id", [
    "name" => $category_name
  ]);

  if($category_id == NULL){
    $category_id = $database->insert("categories", [
      "name" => $category_name
    ]);
  }else{
    $data['exists'] = "That category already exists";
  }

  //Set return statement
  if (!empty($errors)) {
    $data['success'] = false;
    //$data['errors']  = $errors;
  } else {
    $data['success'] = true;
    //$data['result'] = $tags;
  }
  //Return data
  echo json_encode($data);

}
?>
