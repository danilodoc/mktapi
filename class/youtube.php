<?php
namespace MktApi;

require_once('./vendor/autoload.php');

use Madcoda\Youtube;

class YoutubeController
{
  const YOUTUBECONF = array('key' => 'AIzaSyBggRRQLT1e43UhEGFw00n2c4ARM5hqOiM');
  private $youtube;
  private $channel;
  private $id;

  function __construct(){
    $this->youtube = new Youtube(self::YOUTUBECONF);
    $this->id = isset($_GET['id']) ? $_GET['id'] : (isset($_POST['id']) ? $_POST['id'] : null);
  }

  public function setChannel(){
    if(empty($this->id) || !isset($this->youtube)){
      return false;
    }

    $channel = $this->youtube->getChannelByName($this->id);

    if(empty($channel)){
      return false;
    }

    $this->channel = $channel;

    return true;

  }

  public function getChannel(){
    if(empty($this->id) || !isset($this->youtube) || !isset($this->channel)){
      return false;
    }

    return $this->channel;

  }

  public function getAllChannelData(){

    if(empty($this->id) || !isset($this->youtube) || !isset($this->channel)){
      return false;
    }

    //$videos = $this->youtube->getPlaylistsByChannelId($this->channel->id);

    $pageScore = ($this->channel->statistics->viewCount+$this->channel->statistics->commentCount) / $this->channel->statistics->videoCount;
    $pageScore = round($pageScore*100/$this->channel->statistics->subscriberCount, 2);

    $returnData['profilePicture'] = $this->channel->snippet->thumbnails->default->url;
    $returnData['fullName'] = $this->channel->snippet->title;
    $returnData['subscribers'] = $this->channel->statistics->subscriberCount;
    $returnData['videos'] = $this->channel->statistics->videoCount;
    $returnData['views'] = $this->channel->statistics->viewCount;
    $returnData['comments'] = $this->channel->statistics->commentCount;
    $returnData['pageScore'] = $pageScore;

    return $returnData;

  }

}
?>
