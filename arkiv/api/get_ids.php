<?php

//DB login
require_once "../inc/db_credentials.php";
//Arrays
$errors = array();
$data = array();

$articleId = $database->get("tags", [
    "id"
], [
    "name" => "Tidningsartikel"
]);

$malningId = $database->get("tags", [
    "id"
], [
    "name" => "Målning"
]);

$brevId = $database->get("tags", [
    "id"
], [
    "name" => "Brev"
]);

//Set return statement
if (!empty($errors)) {
    $data['success'] = false;
    $data['errors']  = $errors;
} else {
    $data['success'] = true;
    //$data['category'] = $category;
    $data['articleId'] = $articleId;
    $data['malningId'] = $malningId;
    $data['brevId'] = $brevId;
}
//Return data
echo json_encode($data);
?>