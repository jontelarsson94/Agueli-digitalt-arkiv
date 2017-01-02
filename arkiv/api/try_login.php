<?php

require_once "../inc/db_credentials.php";
session_start();
//Arrays
$errors = array();
$data = array();

if(isset($_POST['email']) && isset($_POST['password'])){
  $email = $_POST['email'];
  $password = $_POST['password'];
  $salt = $database->get("users", [
    "salt"
    ], [
    "email" => $email
    ]);
  if($salt != false){
    $iterations = 131000;


    $hash = hash_pbkdf2("sha256", $password, $salt['salt'], $iterations, 64);
    $db_password = $database->get("users", [
      "password"
      ], [
      "email" => $email
      ]);
  
    if($hash == $db_password['password']){
      $_SESSION['logged_in'] = true;
      $_SESSION['admin'] = false;
      $cookie_name = "XSRF-TOKEN";
      $token = base64_encode( openssl_random_pseudo_bytes(32));
      $cookie_value = $token;

      setcookie($cookie_name, $cookie_value, time() + (86400 * 1), "/");
      $admin = $database->get("users", [
        "admin"
        ], [
        "email" => $email
        ]);

      if($admin['admin'] == 1){
        $_SESSION['admin'] = true;
      }

      echo '<script type="text/javascript">window.location = "../articles.php"</script>';
    }
  }
}

 ?>