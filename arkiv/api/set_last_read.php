<?php
require_once "../inc/db_credentials.php";
//Arrays
$errors = array();
$current = array();
$cookie_name = "lastReadId";
$cookie_value = $_REQUEST['lastRead'];
$cookie_value = intval($cookie_value);

if(isset($_COOKIE[$cookie_name])){
	$current = json_decode($_COOKIE[$cookie_name], true);
	//var_dump($current);
	if(!in_array($cookie_value, $current)){
		array_push($current, $cookie_value);
	}
}else{
	array_push($current, $cookie_value);
}
setcookie($cookie_name, json_encode($current), time() + (86400 * 30), "/");
if (get_magic_quotes_gpc() == true) {
 foreach($_COOKIE as $key => $value) {
   $_COOKIE[$key] = stripslashes($value);
  }
}

if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
}else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name];
}

$data['success'] = true;

echo json_encode($data);

?>
