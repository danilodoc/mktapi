<?php
//ini_set('display_errors','off');
header("Content-type: text/html; charset=UTF-8");

if(empty($_GET['id'])){
	exit('Insira o ID da marca');
}

$ytID = $_GET['id'];

require_once('vendor/autoload.php');

use Madcoda\Youtube;

$youtube = new Youtube(array('key' => 'AIzaSyBggRRQLT1e43UhEGFw00n2c4ARM5hqOiM'));

$channel = $youtube->getChannelByName($ytID);

$videos = $youtube->getPlaylistsByChannelId($channel->id);

print_r("<img src=".$channel->snippet->thumbnails->default->url." />");
echo "<br />";
print_r("Nome: ".$channel->snippet->title);
echo "<br />";
print_r("Número de inscritos: ".$channel->statistics->subscriberCount);
echo "<br />";
print_r("Número de vídeos: ".$channel->statistics->videoCount);
echo "<br />";
print_r("Total de visualizações: ".$channel->statistics->viewCount);
echo "<br />";
print_r("Total de comentários: ".$channel->statistics->commentCount);
echo "<br />";

?>