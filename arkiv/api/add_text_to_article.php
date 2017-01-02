<?php 


require_once "../inc/check_admin.php";

if(checkAdmin() != "nothing" && $_REQUEST['XSRF-TOKEN'] == $_COOKIE['XSRF-TOKEN']){

require_once "../inc/db_credentials.php";

$data = array();

$article_id = $_REQUEST['article_id'];
$index = $_REQUEST['index'];
$emptystring = "";

  $database->insert("article_texts", [
    "body" => '',
    "section" => $index,
    "article_id" => $article_id
  ]);

$data['success'] = true;

echo json_encode($data);

//echo '<script type="text/javascript">window.location = "../update_article.php?article_id=' . $article_id . '"</script>';
}
 ?>