<?php
require_once '../lib/php/medoo.php';

  // Initialize
/*$database = new medoo([
    'database_type' => 'mysql',
    'database_name' => 'vt16_1130ME_sh15hp2475',
    'server' => '192.168.2.17',
    'username' => 'sh15hp2475',
    'password' => 'x7Auvjqm',
    'charset' => 'utf8'
]);*/

$database = new medoo([
    'database_type' => 'mysql',
    'database_name' => 'agueli_arkiv',
    'server' => 'localhost',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8'
]);
?>
