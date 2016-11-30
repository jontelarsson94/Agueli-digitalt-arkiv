<?php
require_once "../inc/db_credentials.php";
//Arrays
$errors = array();
$data = array();

$cookie_name = "lastReadId";
$cookie_value = $_REQUEST['lastRead'];
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
}else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name];
}

$data['success'] = true;

echo json_encode($data);

?>
