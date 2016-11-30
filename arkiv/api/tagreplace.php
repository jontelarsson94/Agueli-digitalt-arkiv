<?php
require_once '../inc/db_credentials.php';

$datas = $database->select("tags", [
  'name',
  'id'
]);

$text = "Hej jag gillar att resa. Speciellt till Tyskland och Frankrike.";

foreach($datas as $data)
{
  $text = str_replace($data['name'], '<a href="" ng-click="addTagToSearchFromText(' . $data['id'] . '); getFilteredArticles();" data-dismiss="modal"> ' . $data['name'] . '</a>', $text);
}

echo $text;
 ?>
