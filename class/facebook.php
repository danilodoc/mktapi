<?php
namespace MktApi;

require_once('./vendor/autoload.php');

class FacebookController
{

  private $fbobj;
  private $page;
  private $id;
  const FBCONFIG = array('app_id' => '1556006301360028',
    'app_secret' => '08e59b847b5a5e32394dc0fd37096cb5',
    'default_graph_version' => 'v2.6',
    'default_access_token' => 'CAAWHLfLcX5wBACRUmuLwbObQSWGoNxDiANSnNbDBMw7DN0G6XcrkQSqMfe8ZAbZBmfdCx9jcX3UXmpSKNNMxC85sUPH6ly2llEZC1gYOBFWjBdZCs1kVy1NXKDYXZAdk1ZAgY6RXUYHmIeaaq3KGK2fkQkqDGE68fvMBCGIoMYOv0i2YDUmIb1');

  function __construct(){
    $this->fbobj = new \Facebook\Facebook(self::FBCONFIG);
    $this->id = isset($_GET['id']) ? $_GET['id'] : (isset($_POST['id']) ? $_POST['id'] : null);
  }

  public function setPage(){
    if(empty($this->id) || !is_string($this->id)){
      return false;
    }
	
	$urlId = $this->requestUrl('https://graph.facebook.com/https://www.facebook.com/'.$this->id.'/?access_token='.self::FBCONFIG['default_access_token']);
	
	$urlId = json_decode($urlId);
	
	$this->id = $urlId->id;
	
    try{
      $this->page = $this->fbobj->get('/'.$this->id.'/?fields=name,fan_count,picture');
    }catch (\Facebook\Exceptions\FacebookResponseException $e)  {
      return false;
    }catch (\Facebook\Exceptions\FacebookSDKException $e) {
      return false;
    }

    return true;
  }

  public function getPage(){
    if(!$this->page){
      return false;
    }

    return $this->page;
  }

  public function getPageFullData(){
    if(!$this->page){
      return false;
    }

    $returnData = array();

    $pageData = $this->page->getDecodedBody();

    $returnData['pageAvatar'] = $pageData['picture']['data']['url'];
    $returnData['pageName'] = $pageData['name'];
    $returnData['pageFans'] = $pageData['fan_count'];

    //

    $pageStatus = $this->getPageStatus($pageData['fan_count']);

    $returnData['pagePostFrequency'] = $pageStatus['pagePostFrequency'] ? $pageStatus['pagePostFrequency'] : 0;
    $returnData['pagePostEngagement'] = $pageStatus['pagePostEngagement'] ? $pageStatus['pagePostEngagement'] : 0;
    $returnData['pageScore'] = $pageStatus['pageScore'] ? $pageStatus['pageScore'] : 0;

    return $returnData;

  }

  private function getPageStatus($fanCount = null){
    try{
      $fbPosts = $this->fbobj->get('/'.$this->id.'/posts?limit=10&fields=name,id,type,message,created_time,likes.summary(true),comments.summary(true),shares');
    }catch (\Facebook\Exceptions\FacebookResponseException $e)  {
      return false;
    }catch (\Facebook\Exceptions\FacebookSDKException $e) {
      return false;
    }

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
    $today = new \DateTime();
    $firstPostDate = new \DateTime($postsDates[$numberOfPosts-1]);
    $dateRange = date_diff($today, $firstPostDate);
    $dateRange = $dateRange->days;
    $postFrequency = $dateRange > 0 ? round($numberOfPosts/$dateRange, 2) : "10+";

    //Engajamento médio por post (likes + comentários)
    $postEngagement = round(($totalLikes + $totalComments*2 + $totalShares*3) / $numberOfPosts);

    //Score
    $pageScore = ($totalLikes + $totalComments + $totalShares) / $numberOfPosts;
    $pageScore = round($pageScore*100/$fanCount, 2);

    return array('pagePostFrequency' => $postFrequency, 'pagePostEngagement' => $postEngagement, 'pageScore' => $pageScore);
  }
  
  private function requestUrl($url) {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    $result = curl_exec($ch);

    curl_close($ch);

    return $result;

  }

}

?>
