<?php
header("Content-Type: application/json; charset=UTF-8");
require_once('class/twitter.php');

$twitter = new MktApi\TwitterController;

$return = $twitter->setUser() ? $twitter->getTwitterFullData() : array('error' => 'Twitter not found');

print_r(json_encode($return));
?>
