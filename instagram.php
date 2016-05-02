<?php
header("Content-Type: application/json; charset=UTF-8");
require_once('vendor/autoload.php');

if(empty($_GET['id'])){
	$returnData = array("error" => "Missing ID");
    print_r(json_encode($returnData));
    exit;
}

$username = $_GET['id'];
$access_token = '822011.5b9e1e6.1172c49ca13c432c87a069bcf68b8b49';

function Request($url) {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
    curl_setopt($ch, CURLOPT_HEADER, 0);  

    $result = curl_exec($ch);

    curl_close($ch);

    return $result;

}

$url = "https://api.instagram.com/v1/users/search?q=" . $username . "&access_token=" . $access_token;

$userID = json_decode(Request($url), true);
$userID = $userID['data'][0]['id'];

$url = "https://api.instagram.com/v1/users/" . $userID . "/?access_token=" . $access_token;
$userData = json_decode(Request($url), true);

$url = "https://api.instagram.com/v1/users/" . $userID . "/media/recent/?access_token=" . $access_token;
$userRecentFeed = json_decode(Request($url), true);

$postsDates = array();
$numberOfPosts = count($userRecentFeed['data']);
$totalLikes = 0;
$totalComments = 0;

foreach($userRecentFeed['data'] as $key => $post){
	$formatedDate = date('Y-m-d', $post['created_time']);
	array_push($postsDates, $formatedDate);
	
	$totalLikes += $post['likes']['count'];
	$totalComments += $post['comments']['count'];
}

//Frequência de posts
$today = new DateTime();
$firstPostDate = new DateTime($postsDates[$numberOfPosts-1]);
$dateRange = date_diff($today, $firstPostDate);
$dateRange = $dateRange->days;
$postFrequency = $dateRange > 0 ? round($numberOfPosts/$dateRange, 2) : "10+";

//Engajamento médio por post (likes + comentários)
$postEngagement = round(($totalLikes + $totalComments*2) / $numberOfPosts, 2);

$pageScore = ($totalLikes + $totalComments) / $numberOfPosts;
$pageScore = round($pageScore*100/$userData['data']['counts']['followed_by'], 2);

$returnData['profilePicture'] = $userData['data']['profile_picture'];
$returnData['fullName'] = $userData['data']['full_name'];
$returnData['followedBy'] = $userData['data']['counts']['followed_by'];
$returnData['postFrequency'] = $postFrequency;
$returnData['postEngagement'] = $postEngagement;
$returnData['pageScore'] = $pageScore;

print_r(json_encode($returnData)); 
exit;
?>