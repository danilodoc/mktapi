<?php
namespace MktApi;

require_once('./vendor/autoload.php');

use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterController
{
  const TWITTERCONF = array(
    'consumerKey' => 'Io32hs3Xvr2Tra1gYi2EwbzhM',
    'consumerSecret' => '4GjQ4ZgJrE1WpVS2l3AwWcn6CUQi4lMM74L7cdCpPc3O04fhy6'
  );
  private $twitter;
  private $id;
  private $user;

  function __construct(){
    $this->twitter = new TwitterOAuth(self::TWITTERCONF['consumerKey'],self::TWITTERCONF['consumerSecret']);
    $this->id = isset($_GET['id']) ? $_GET['id'] : (isset($_POST['id']) ? $_POST['id'] : null);
  }

  public function setUser(){
    if(empty($this->id) || !is_string($this->id)){
      return false;
    }

    $this->user = $this->twitter->get("users/lookup", ['screen_name' => $this->id]);

    if(is_object($this->user) && isset($this->user->{'errors'})){
      $this->user = null;
      return false;
    }

    $this->user = get_object_vars($this->user[0]);
    return true;
  }

  public function getUser(){
    if(!empty($this->user) && is_array($this->user)){
      return $this->user;
    }

    return false;
  }

  public function getTwitterFullData(){
    if(empty($this->user) || !is_array($this->user)){
      return false;
    }
    $returnData = array();
    $returnData['pageAvatar'] = $this->user['profile_image_url'];
    $returnData['pageName'] = $this->user['name'];
    $returnData['followers'] = $this->user['followers_count'];

    $twitterStatus = $this->getTwitterStatus();

    $returnData['pagePostFrequency'] = $twitterStatus['postFrequency'] ? $twitterStatus['postFrequency'] : 0;
    $returnData['pagePostEngagement'] = $twitterStatus['postEngagement'] ? $twitterStatus['postEngagement'] : 0;
    $returnData['pageScore'] = $twitterStatus['pageScore'] ? $twitterStatus['pageScore'] : 0;

    return $returnData;
  }

  private function getTwitterStatus(){

    if(empty($this->user) || !is_array($this->user)){
      return false;
    }

    $tweets = $this->twitter->get("statuses/user_timeline", ['screen_name' => $this->id, 'count' => '100']);

    if(empty($tweets) || !is_array($tweets)){
      return false;
    }

    $returnData = array();
    $postsDates = array();
    $numberOfPosts = count($tweets);
    $totalFavorites = 0;
    $totalRetweets = 0;

    foreach($tweets as $key => $post){

    	$post = get_object_vars($post);

    	$formatedDate = new \DateTime($post['created_at']);
    	$formatedDate = date_format($formatedDate, 'Y-m-d');

    	array_push($postsDates, $formatedDate);

    	$totalFavorites += $post['favorite_count'];
    	$totalRetweets += $post['retweet_count'];
    }
    //Frequência de posts
    $today = new \DateTime();
    $firstPostDate = new \DateTime($postsDates[$numberOfPosts-1]);
    $dateRange = date_diff($today, $firstPostDate);
    $dateRange = $dateRange->days;

    $returnData['postFrequency'] = $dateRange > 0 ? round($numberOfPosts/$dateRange, 2) : "100+";

    //Engajamento médio por tweet (retweets + favoritos)
    $returnData['postEngagement'] = round(($totalRetweets*2 + $totalFavorites) / $numberOfPosts, 2);

    //Score
    $pageScore = ($totalRetweets + $totalFavorites) / $numberOfPosts;
    $returnData['pageScore'] = round($pageScore*100/$this->user['followers_count'], 2);

    return $returnData;
  }

}
?>
