<?php
require_once '../lib/php/medoo.php';

  // Initialize
//Lindas
/*$database = new medoo([
    'database_type' => 'mysql',
    'database_name' => 'vt16_1130ME_sh15hp2475',
    'server' => '192.168.2.17',
    'username' => 'sh15hp2475',
    'password' => 'x7Auvjqm',
    'charset' => 'utf8'
]);*/

//Localhost
/*$database = new medoo([
    'database_type' => 'mysql',
    'database_name' => 'agueli_arkiv',
    'server' => 'localhost',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8'
]);*/


//Agueli
$database = new medoo([
    'database_type' => 'mysql',
    'database_name' => '105649-aaterh909341',
    'server' => 'aaterh909341-105649.mysql.binero.se',
    'username' => '105649_kv89994',
    'password' => 'FB6VmfTD',
    'charset' => 'utf8'
]);
?>
