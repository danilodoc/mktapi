<?
header("Content-Type: application/json; charset=UTF-8");
require_once('vendor/autoload.php');

if(empty($_GET['id'])){
	$returnData = array("error" => "Missing ID");
    print_r(json_encode($returnData));
    exit;
}

$fbConfig = array('app_id' => '1556006301360028',
'app_secret' => '08e59b847b5a5e32394dc0fd37096cb5',
'default_graph_version' => 'v2.6',
'default_access_token' => 'CAAWHLfLcX5wBACRUmuLwbObQSWGoNxDiANSnNbDBMw7DN0G6XcrkQSqMfe8ZAbZBmfdCx9jcX3UXmpSKNNMxC85sUPH6ly2llEZC1gYOBFWjBdZCs1kVy1NXKDYXZAdk1ZAgY6RXUYHmIeaaq3KGK2fkQkqDGE68fvMBCGIoMYOv0i2YDUmIb1');

$fb = new Facebook\Facebook($fbConfig);

$fbID = $_GET['id'];

$fbPage = $fb->get('/'.$fbID.'/?fields=name,fan_count,picture');
$fbPage = $fbPage->getDecodedBody();

if(empty($fbPage)){
	$returnData = array("error" => "Page not found");
    print_r(json_encode($returnData));
    exit;
}

$fbPosts = $fb->get('/'.$fbID.'/posts?limit=10&fields=name,id,type,message,created_time,likes.summary(true),comments.summary(true),shares');
$fbPosts = $fbPosts->getDecodedBody();

$postsDates = array();
$numberOfPosts = count($fbPosts['data']);
$totalLikes = 0;
$totalComments = 0;
$totalShares = 0;

/*echo "<pre>";
print_r($fbPosts['data']);
exit;*/

foreach($fbPosts['data'] as $key => $post){
	$formatedDate = substr($post['created_time'], 0, 10);
	array_push($postsDates, $formatedDate);
	$totalLikes += $post['likes']['summary']['total_count'];
	$totalComments += $post['comments']['summary']['total_count'];
	$totalShares += (!empty($post['shares']) ? $post['shares']['count'] : 0);
}

//Frequência de posts
$today = new DateTime();
$firstPostDate = new DateTime($postsDates[$numberOfPosts-1]);
$dateRange = date_diff($today, $firstPostDate);
$dateRange = $dateRange->days;
$postFrequency = round($numberOfPosts/$dateRange, 2);

//Engajamento médio por post (likes + comentários)
$postEngagement = round(($totalLikes + $totalComments*2 + $totalShares*3) / $numberOfPosts);

//Score
$pageScore = ($totalLikes + $totalComments + $totalShares) / $numberOfPosts;
$pageScore = round($pageScore*100/$fbPage['fan_count'], 2);
    

$returnData['pageAvatar'] = $fbPage['picture']['data']['url'];
$returnData['pageName'] = $fbPage['name'];
$returnData['pageFans'] = $fbPage['fan_count'];
$returnData['pagePostFrequency'] = $postFrequency;
$returnData['pagePostEngagement'] = $postEngagement;
$returnData['pageScore'] = $pageScore;

print_r(json_encode($returnData)); 
exit;
?>