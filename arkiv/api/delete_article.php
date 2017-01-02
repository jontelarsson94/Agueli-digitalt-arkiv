<?php 
require_once "../inc/check_admin.php";

if(checkAdmin() != "nothing"){

require_once "../inc/db_credentials.php";

$data = array();

$article_id = $_REQUEST['article_id'];

  $database->delete("article_tags", [
		"article_id" => $article_id
	]);

  $database->delete("article_images", [
		"article_id" => $article_id
	]);

  $database->delete("article_texts", [
		"article_id" => $article_id
	]);

  $database->delete("articles", [
		"id" => $article_id
	]);

echo '<script type="text/javascript">window.location = "../articles.php"</script>';

}

 ?>