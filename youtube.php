<?php
header("Content-Type: application/json; charset=UTF-8");
require_once('class/youtube.php');

$youtube = new MktApi\YoutubeController;

$return = $youtube->setChannel() ? $youtube->getAllChannelData() : array('error' => 'Invalid Channel');

print_r(json_encode($return));
?>
