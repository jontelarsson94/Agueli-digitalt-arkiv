<?php
echo "hej";
require_once "../inc/db_credentials.php";
//Arrays
$errors = array();
$data = array();

$id = $_REQUEST['tag_id_click'];
echo $id;

$tag = $database->get("tags", [
  "clicks"
], [
  "id" => $id
]);


$clicks = $tag['clicks'] + 1;
echo $clicks;

$database->update("tags", [
  "clicks" => $clicks
], [
  "id" => $id
]);

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
