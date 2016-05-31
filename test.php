<?php

require_once('vendor/autoload.php');

$database = new medoo([
    'database_type' => 'mysql',
    'database_name' => 'mktapi',
    'server' => 'localhost',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8'
]);

$database->insert('account', [
    'name' => 'foo'
]);

?>
