<?php
header("Content-Type: application/json; charset=UTF-8");
require_once('vendor/autoload.php');

if(empty($_GET['id'])){
	$returnData = array("error" => "Missing ID");
    print_r(json_encode($returnData));
    exit;
}

$twitterID = $_GET['id'];

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

$postFrequency = $dateRange > 0 ? round($numberOfPosts/$dateRange, 2) : "100+";

//Engajamento médio por tweet (retweets + favoritos)
$postEngagement = round(($totalRetweets*2 + $totalFavorites) / $numberOfPosts, 2);

//Score
$pageScore = ($totalRetweets + $totalFavorites) / $numberOfPosts;
$pageScore = round($pageScore*100/$user['followers_count'], 2);


$returnData['pageAvatar'] = $user['profile_image_url'];
$returnData['pageName'] = $user['name'];
$returnData['followers'] = $user['followers_count'];
$returnData['pagePostFrequency'] = $postFrequency;
$returnData['pagePostEngagement'] = $postEngagement;
$returnData['pageScore'] = $pageScore;

print_r(json_encode($returnData)); 
exit;
?>