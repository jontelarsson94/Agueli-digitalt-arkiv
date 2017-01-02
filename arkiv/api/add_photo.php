<?php

require_once "../inc/check_admin.php";

if(checkAdmin() != "nothing"){

function UploadFile($fileToUpload, $database, $index){

$target_dir = "../img/";
$target_basename = time() . "_" . rand(0,1000).".".pathinfo($_FILES[$fileToUpload]["name"][$index],PATHINFO_EXTENSION);
$target_file = $target_dir . $target_basename;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
$check = getimagesize($_FILES[$fileToUpload]["tmp_name"][$index]);
if($check !== false) {
  echo "File is an image - " . $check["mime"] . ".";
  $uploadOk = 1;
} else {
  echo "File is not an image.";
  $uploadOk = 0;
}
}
// Check if file already exists
if (file_exists($target_file)) {
echo "Sorry, file already exists.";
$uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
$uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
if (move_uploaded_file($_FILES[$fileToUpload]["tmp_name"][$index], $target_file)) {
  echo "The file ". basename( $_FILES[$fileToUpload]["name"][$index]). " has been uploaded.";
  $result = $database->insert("images", [
  "url" => $target_basename,
  ]);
  return $result;
} else {
  echo "Sorry, there was an error uploading your file.";
}
}
}

function UploadSingleFile($fileToUpload, $database){
  $target_dir = "../img/";
  $target_basename = time() . "_" . rand(0,1000).".".pathinfo($_FILES[$fileToUpload]["name"], PATHINFO_EXTENSION);
  $target_file = $target_dir . $target_basename;
  echo $target_file . "\n";
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES[$fileToUpload]["tmp_name"]);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          echo "File is not an image.";
          $uploadOk = 0;
      }
  }
  // Check if file already exists
  if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES[$fileToUpload]["tmp_name"], $target_file)) {
          echo "The file ". basename( $_FILES[$fileToUpload]["name"]). " has been uploaded.";
          $result = $database->insert("images", [
          "url" => $target_basename,
          ]);
          return $result;
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
  }
}
}
?>
