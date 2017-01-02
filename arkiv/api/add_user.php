<?php
require_once "../inc/db_credentials.php";
//Arrays
$errors = array();
$data = array();

if(isset($_POST['email']) && isset($_POST['password1']) && isset($_POST['password2'])){

  $email = $_POST['email'];
  $password1 = $_POST['password1'];
  $password2 = $_POST['password2'];
  $role = $_POST['admin'];
  if($role == "Admin"){
    $role = 1;
  }else{
    $role = 0;
  }
  if($password1 == $password2){
    $iterations = 131000;
    $hex = "";
    //Create salt
    for ($i = -1; $i <= 6; $i++) {
      $bytes = openssl_random_pseudo_bytes($i, $cstrong);
      $hex   = bin2hex($bytes);
    }

    $hash = hash_pbkdf2("sha256", $password1, $hex, $iterations, 64);

    $id = $database->insert("users", [
      "email" => $email,
      "password" => $hash,
      "salt" => $hex,
      "admin" => $role
      ]);
  }

      echo '<script type="text/javascript">window.location = "../articles.php"</script>';
}

 ?>