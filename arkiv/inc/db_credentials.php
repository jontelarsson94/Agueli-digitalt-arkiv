<?php
require_once '../lib/php/medoo.php';

/*$testConnection = mysql_connect('10.209.1.170', '105649_lz33499', 'phujebachi');
if (!$testConnection) {
die('Error: ' . mysql_error());
}
echo 'Database connection working!';
mysql_close($testConnection);
*/

/*$database = new medoo([
    'database_type' => 'mysql',
    'database_name' => '141364-dva313',
    'server' => 'mysql18.citynetwork.se',
    'username' => '141364-wj79764',
    'password' => 'SolarCalculator',
    'charset' => 'utf8',
    'port' => 3306
]);*/
/*echo "hej";
  // Initialize

  $database = new medoo([
      'database_type' => 'mysql',
      'database_name' => 'vt16_1130ME_sh15hp2475',
      'server' => '192.168.2.17',
      'username' => 'sh15hp2475',
      'password' => 'x7Auvjqm',
      'charset' => 'utf8',
      'port' => 3306
  ]);
*/
$database = new medoo([
    'database_type' => 'mysql',
    'database_name' => 'agueli_arkiv',
    'server' => 'localhost',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8'
]);
?>
