<?php

require_once('vendor/autoload.php');

/*$database = new medoo([
    'database_type' => 'mysql',
    'database_name' => 'mktapi',
    'server' => 'localhost',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8'
]);

$database->insert('account', [
    'name' => 'foo'
]);*/

use MetzWeb\Instagram\Instagram;

$instagram = new Instagram('6cf81043cea045d78e91d6ca70973864');

$user = $instagram->searchUser('danilodoc');

print_r($user); exit;

?>
