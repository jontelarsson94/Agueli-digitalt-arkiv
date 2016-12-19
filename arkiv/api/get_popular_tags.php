<?php
  //DB login
  require_once "../inc/db_credentials.php";
  //Arrays
  $errors = array();
  $data = array();

  //$num_of_tags = $database->count('article_tags');
  //$num_of_tags2 = $database->count('tags');
  //$medium = $num_of_tags/$num_of_tags2;
//need to do unique
  //$small = $medium*0.5;
  //$large = $medium*1.5;
  $counter = 0;
  $tag_ids = $database->query("SELECT id, name, count FROM tags WHERE count > 0 ORDER BY count DESC LIMIT 15")->fetchAll();
  $tags = array();
  foreach($tag_ids as $tag_id){
    $counter = $counter + $tag_id['count'];
  }
  $medium = $counter/15;
  $small = $medium*0.5;
  $large = $medium*1.5;
  foreach($tag_ids as $tag_id){
    $num_current = $tag_id['count'];
    if($num_current < $small){
      array_push($tags, ["size" => 1, "tag" => $tag_id]);
    }
    elseif ($num_current >= $small && $num_current < $medium) {
      array_push($tags, ["size" => 2, "tag" => $tag_id]);
    }
    elseif ($num_current >= $medium && $num_current < $large) {
      array_push($tags, ["size" => 3, "tag" => $tag_id]);
    }
    else {
      array_push($tags, ["size" => 4, "tag" => $tag_id]);
    }
  }


  //Set return statement
  if (!empty($errors)) {
    $data['success'] = false;
    $data['errors']  = $errors;
  } else {
    $data['success'] = true;
    $data['message'] = 'Tags retrieved!';
    $data['tags'] = $tags;
  }
  //Return data
  echo json_encode($data);
?>
