<?php

  if(rand(0, 1) == 0){
    require_once 'get_popular_tags.php';
  }else{
    require_once 'get_clicked_tags.php';
  }
?>
