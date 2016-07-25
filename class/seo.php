<?php
namespace MktApi;
require_once '.'. DIRECTORY_SEPARATOR . 'SEOstats' . DIRECTORY_SEPARATOR . 'SEOstats' . DIRECTORY_SEPARATOR . 'bootstrap.php';

use \SEOstats\Services as SEOstats;

class SeoController{

  private $seo;
  private $url;

  function __construct(){
    $this->seo = new \SEOstats\SEOstats;
    $this->url = isset($_GET['url']) ? $_GET['url'] : (isset($_POST['url']) ? $_POST['url'] : null);
  }

  public function setURL(){

    if(!$this->validateURL()){
      $this->url = null;
      return false;
    }

    if(!$this->seo->setUrl($this->url)){
      $this->url = null;
      return false;
    }

    return true;
  }

  public function getURL(){
    if(!$this->url){
      return false;
    }

    return $this->url;
  }

  public function getURLFullInfo(){

    if(!$this->url){
      return false;
    }

    $returnData = array();

    //WebMeUp Backlinks
    $returnData['backLinks'] = $this->getURLBackLinks();

    //Google Page Rank
    //$returnData['pageRnak'] = $this->getPageRank();

    //Mozscape Domain Authority
    $returnData['domainAuthority'] = $this->getDomainAuthority();

    //Mozscape Page Authority
    $returnData['pageAuthority'] = $this->getPageAuthority();

    //Google Key Words
    $returnData['keyWords'] = $this->getKeyWords();

    //Google Tag Title
    $returnData['pageTitle'] = $this->getPageTitle();

    //Score
    $returnData['pageScore'] = $returnData['backLinks'];

    return $returnData;

  }

  public function validateURL(){
    if(empty($this->url) || !is_string($this->url)){
      return false;
    }

    if(!filter_var($this->url, FILTER_VALIDATE_URL)){
      return false;
    }

    return true;
  }

  public function getURLBackLinks(){
    if(!$this->url){
      return false;
    }

    return SEOstats\WebMeUp::getWebMeUpBacklinksCount($this->url);
  }

  public function getDomainAuthority(){
    if(!$this->url){
      return false;
    }

    return round(SEOstats\Mozscape::getDomainAuthority());

  }

  public function getPageAuthority(){
    if(!$this->url){
      return false;
    }

    return round(SEOstats\Mozscape::getPageAuthority());
  }

  public function getKeyWords($limit = 5){
    if(!$this->url){
      return false;
    }

    $organicKey = SEOstats\SemRush::getOrganicKeywords($this->url, 'br');
    $keyWords = "";

    if(is_array($organicKey) && !empty($organicKey['data'])){
    	foreach($organicKey['data'] as $key => $keyData){
            if($key == $limit){
                break;
            }
    		$keyWords .= $keyData['Ph']. ", ";
    	}
    	$keyWords = substr($keyWords, 0, -2);
    }

    return $keyWords;
  }

  public function getPageTitle(){
    if(!$this->url){
      return false;
    }

    $objPage = SEOstats\Google::getPagespeedAnalysis();

    return $objPage->title;
  }

  public function getPageRank(){
    if(!$this->url){
      return false;
    }

    return SEOstats\Google::getPageRank();
  }
}

?>
