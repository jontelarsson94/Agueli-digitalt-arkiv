<?php

require_once "../inc/check_admin.php";

  if(checkAdmin() != "nothing"){

  //DB login
  require_once "../inc/db_credentials.php";
  //Arrays
  $errors = array();
  $data = array();
  $category_id = $_REQUEST["category_id"];
  $tag_id = $_REQUEST["tag_id"];

  $success = $database->delete("category_tags", [
    "AND" => [
      "category_id" => $category_id,
      "tag_id" => $tag_id
    ]
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
