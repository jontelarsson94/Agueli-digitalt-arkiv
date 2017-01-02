<?php

require_once "../inc/db_credentials.php";

$result = $database->select('articles', [
  'title',
  'body'
],[
  'id' => 70
]);

if($result == NULL)
{
  echo "fett null";
}
 ?>
