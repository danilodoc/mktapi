<?php
header("Content-Type: application/json; charset=UTF-8");
require_once('vendor/autoload.php');

if(empty($_GET['id'])){
	$returnData = array("error" => "Missing ID");
    print_r(json_encode($returnData));
    exit;
}

$ytID = $_GET['id'];

use Madcoda\Youtube;

$youtube = new Youtube(array('key' => 'AIzaSyBggRRQLT1e43UhEGFw00n2c4ARM5hqOiM'));

$channel = $youtube->getChannelByName($ytID);

$videos = $youtube->getPlaylistsByChannelId($channel->id);

$returnData['profilePicture'] = $channel->snippet->thumbnails->default->url;
$returnData['fullName'] = $channel->snippet->title;
$returnData['subscribers'] = $channel->statistics->subscriberCount;
$returnData['videos'] = $channel->statistics->videoCount;
$returnData['views'] = $channel->statistics->viewCount;
$returnData['comments'] = $channel->statistics->commentCount;

print_r(json_encode($returnData)); 
exit;
?>