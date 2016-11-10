<?php
require_once '../inc/db_credentials.php';

$database->query("CREATE TABLE IF NOT EXISTS articles(
    id int AUTO_INCREMENT PRIMARY KEY,
    title varchar(64) NOT NULL UNIQUE,
    body text NOT NULL
  );");

$database->query("CREATE TABLE IF NOT EXISTS tags(
    id int AUTO_INCREMENT PRIMARY KEY,
    name varchar(32) NOT NULL UNIQUE
  );");

$database->query("CREATE TABLE IF NOT EXISTS images(
    id int AUTO_INCREMENT PRIMARY KEY,
    url varchar(64) NOT NULL UNIQUE
  );");

$database->query("CREATE TABLE IF NOT EXISTS article_tags(
    article_id int,
    tag_id int,
    FOREIGN KEY (tag_id) REFERENCES tags(id),
    FOREIGN KEY (article_id) REFERENCES articles(id)
  );");

$database->query("CREATE TABLE IF NOT EXISTS article_images(
    image_id int,
    article_id int,
    FOREIGN KEY (article_id) REFERENCES articles(id),
    FOREIGN KEY (image_id) REFERENCES images(id)
  );");


 ?>
