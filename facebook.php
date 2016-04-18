<?
ini_set('display_errors','off');
header("Content-type: text/html; charset=UTF-8");

if(empty($_GET['id'])){
	exit('Insira o ID da marca');
}

require_once('vendor/autoload.php');

$fbConfig = array('app_id' => '1556006301360028',
  'app_secret' => '08e59b847b5a5e32394dc0fd37096cb5',
  'default_graph_version' => 'v2.6',
  'default_access_token' => 'CAAWHLfLcX5wBACRUmuLwbObQSWGoNxDiANSnNbDBMw7DN0G6XcrkQSqMfe8ZAbZBmfdCx9jcX3UXmpSKNNMxC85sUPH6ly2llEZC1gYOBFWjBdZCs1kVy1NXKDYXZAdk1ZAgY6RXUYHmIeaaq3KGK2fkQkqDGE68fvMBCGIoMYOv0i2YDUmIb1');

	$fb = new Facebook\Facebook($fbConfig);

// Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
//   $helper = $fb->getRedirectLoginHelper();
//   $helper = $fb->getJavaScriptHelper();
//   $helper = $fb->getCanvasHelper();
//   $helper = $fb->getPageTabHelper();

/*try {
  // Get the Facebook\GraphNodes\GraphUser object for the current user.
  // If you provided a 'default_access_token', the '{access-token}' is optional.
  $response = $fb->get('/me');
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$me = $response->getGraphUser();
echo 'Logged in as ' . $me->getName();*/

$fbID = $_GET['id'];

$fbPage = $fb->get('/'.$fbID.'/?fields=name,fan_count,picture');
$fbPage = $fbPage->getDecodedBody();

$fbPosts = $fb->get('/'.$fbID.'/feed?limit=10&fields=name,id,type,message,created_time,likes.summary(true),comments.summary(true),shares');
$fbPosts = $fbPosts->getDecodedBody();

$postsDates = array();
$numberOfPosts = count($fbPosts['data']);
$totalLikes = 0;
$totalComments = 0;
$totalShares = 0;

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
$postEngagement = round(($totalLikes + $totalComments + $totalShares) / $numberOfPosts, 2);

print_r("<img src=".$fbPage['picture']['data']['url']." />");
echo "<br />";
print_r("Nome: ".$fbPage['name']);
echo "<br />";
print_r("Número de fãs: ".$fbPage['fan_count']);
echo "<br />";
print_r("Média de ".$postFrequency." posts por dia");
echo "<br />";
print_r("Média de ".$postEngagement." interações por post (likes + comentários + compartilhamentos)");
echo "<br />";

?>