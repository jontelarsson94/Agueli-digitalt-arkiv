<?php
require_once '../lib/php/medoo.php';

  // Initialize
$database = new medoo([
    'database_type' => 'mysql',
    'database_name' => 'agueli_arkiv',
    'server' => 'localhost',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8'
]);
?>