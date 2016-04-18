<?php

ini_set('display_errors','off');
header("Content-type: text/html; charset=UTF-8");

if(empty($_GET['id'])){
	exit('Insira o ID da marca');
}

$twitterID = $_GET['id'];

require_once('vendor/autoload.php');

use Abraham\TwitterOAuth\TwitterOAuth;

$twitter = new TwitterOAuth('Io32hs3Xvr2Tra1gYi2EwbzhM','4GjQ4ZgJrE1WpVS2l3AwWcn6CUQi4lMM74L7cdCpPc3O04fhy6');

$user = $twitter->get("users/lookup", ['screen_name' => $twitterID]);
$user = get_object_vars($user[0]);

$tweets = $twitter->get("statuses/user_timeline", ['screen_name' => $twitterID, 'count' => '100']);

$postsDates = array();
$numberOfPosts = count($tweets);
$totalFavorites = 0;
$totalRetweets = 0;

foreach($tweets as $key => $post){
	
	$post = get_object_vars($post);
	
	$formatedDate = new DateTime($post['created_at']);
	$formatedDate = date_format($formatedDate, 'Y-m-d');
	
	array_push($postsDates, $formatedDate);
	
	$totalFavorites += $post['favorite_count'];
	$totalRetweets += $post['retweet_count'];
}
//Frequência de posts
$today = new DateTime();
$firstPostDate = new DateTime($postsDates[$numberOfPosts-1]);
$dateRange = date_diff($today, $firstPostDate);
$dateRange = $dateRange->days;

$postFrequency = round($numberOfPosts/$dateRange, 2);

//Engajamento médio por tweet (retweets + favoritos)
$postEngagement = round(($totalRetweets + $totalFavorites) / $numberOfPosts, 2);




print_r("<img src=".$user['profile_image_url']." />");
echo "<br />";
print_r("Nome: ".$user['name']);
echo "<br />";
print_r("Número de seguidores: ".$user['followers_count']);
echo "<br />";
print_r("Média de ".$postFrequency." tweets por dia");
echo "<br />";
print_r("Média de ".$postEngagement." interações por post (retweets + favoritos)");

?>