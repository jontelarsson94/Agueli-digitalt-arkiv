<?php
require_once '../inc/db_credentials.php';

$database->query("CREATE TABLE IF NOT EXISTS articles(
    id int AUTO_INCREMENT PRIMARY KEY,
    title varchar(64) NOT NULL UNIQUE,
    summary text,
    body1 text,
    body2 text,
    body3 text,
    type varchar(32) NOT NULL
  );");

$database->query("CREATE TABLE IF NOT EXISTS tags(
    id int AUTO_INCREMENT PRIMARY KEY,
    name varchar(32) NOT NULL UNIQUE,
    clicks INT(64) UNSIGNED NOT NULL DEFAULT 0,
    count INT(64) NOT NULL DEFAULT 0
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
    section int,
    isCardImage TINYINT(1) NOT NULL DEFAULT 0,
    FOREIGN KEY (article_id) REFERENCES articles(id),
    FOREIGN KEY (image_id) REFERENCES images(id)
  );");


 ?>
