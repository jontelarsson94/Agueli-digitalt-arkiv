<?php
require_once '../inc/db_credentials.php';

$datas = $database->select("tags", [
  'name',
  'id'
]);

$text = "Hej jag gillar att resa. Speciellt till Tyskland och Frankrike.";

foreach($datas as $data)
{
  $text = str_replace($data['name'], '<a href="tags/' . $data['id'] . '">' . $data['name'] . '</a>', $text);
}

echo $text;
 ?>
