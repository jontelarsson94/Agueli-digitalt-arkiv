<?php
require_once '../inc/db_credentials.php';

//Arrays
$errors = array();
$data = array();
//Check conditions/Validation
if (empty($_POST['title']))
  $errors['title'] = 'Title is required.';

if (empty($_POST['body']))
  $errors['body'] = 'Body is required.';
//Write to db

$result = $database->insert("articles", [
  "title" => $_POST['title'],
	"body" => $_POST['body']
]);

//Set return statement
if (!empty($errors)) {
  $data['success'] = false;
  $data['errors']  = $errors;
} else {
  $data['success'] = true;
  $data['message'] = 'Article added successfully!';
  $data['result'] = $result;
}
//Return data
//here we should show the article
echo json_encode($data);
 ?>
