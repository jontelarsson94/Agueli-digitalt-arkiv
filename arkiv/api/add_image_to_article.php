<?php 

require_once "../inc/check_admin.php";

if(checkAdmin() != "nothing" && $_SERVER['HTTP_X_XSRF_TOKEN'] == $_COOKIE['XSRF-TOKEN']){

require_once "../inc/db_credentials.php";

$article_id = $_REQUEST['article_id'];
$index = $_REQUEST['index'];
$emptystring = "";

  $imageId = $database->insert("images", [
    "url" => NULL
  ]);

  $database->insert("article_images", [
    "image_id" => $imageId,
    "article_id" => $article_id,
    "section" => $index
  ]);

$data['success'] = true;

echo json_encode($data);
}

//echo '<script type="text/javascript">window.location = "../update_article.php?article_id=' . $article_id . '"</script>';

?>