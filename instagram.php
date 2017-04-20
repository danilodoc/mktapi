<?php
header("Content-Type: application/json; charset=UTF-8");
require_once('vendor/autoload.php');

if(empty($_GET['id'])){
	$returnData = array("error" => "Missing ID");
    print_r(json_encode($returnData));
    exit;
}

$username = $_GET['id'];

function Request($url) {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    $result = curl_exec($ch);

    curl_close($ch);

    return $result;

}

$url = "https://www.instagram.com/" . $username . "/";

$userData = Request($url);

preg_match('/<script type=\"text\/javascript\">window._sharedData =(.*?);<\/script>/', $userData, $match);

$userData = json_decode($match[1], true);

if(empty($userData['entry_data'])){
	$returnData = array("error" => "User not found");
    print_r(json_encode($returnData));
    exit;
}

$userData = $userData['entry_data']['ProfilePage'][0]['user'];

$postsDates = array();
$numberOfPosts = count($userData['media']['nodes']);
$totalLikes = 0;
$totalComments = 0;

foreach($userData['media']['nodes'] as $key => $post){
	$formatedDate = date('Y-m-d', $post['date']);
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
$pageScore = round($pageScore*100/$userData['followed_by']['count'], 2);

$returnData['profilePicture'] = $userData['profile_pic_url'];
$returnData['fullName'] = $userData['full_name'];
$returnData['followedBy'] = $userData['followed_by']['count'];
$returnData['postFrequency'] = $postFrequency;
$returnData['postEngagement'] = $postEngagement;
$returnData['pageScore'] = $pageScore;

print_r(json_encode($returnData));
exit;
?>
