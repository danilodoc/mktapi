<?php
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . DIRECTORY_SEPARATOR . 'SEOstats' . DIRECTORY_SEPARATOR . 'SEOstats' . DIRECTORY_SEPARATOR . 'bootstrap.php';

$returnData = array();

if(empty($_GET['url'])){
	$returnData = array("error" => "Missing URL");
    print_r(json_encode($returnData));
    exit;
}

use \SEOstats\Services as SEOstats;

$url = $_GET['url'];
$url = substr($url, 0, 7) != "http://" ? "http://".$url : $url;

$seostats = new \SEOstats\SEOstats;

if(!$seostats->setUrl($url)) {
    $returnData = array("error" => "No data returned");
    print_r(json_encode($returnData));
    exit;
}

//WebMeUp Backlinks
$returnData['backLinks'] = SEOstats\WebMeUp::getWebMeUpBacklinksCount($url);

//Google Page Rank
//$returnData['pageRnak'] = SEOstats\Google::getPageRank();
    
//Mozscape Domain Authority
$returnData['domainAuthority'] = round(SEOstats\Mozscape::getDomainAuthority());
    
//Mozscape Page Authority
$returnData['pageAuthority'] = round(SEOstats\Mozscape::getPageAuthority());
    

//Google Key Words
$organicKey = SEOstats\SemRush::getOrganicKeywords($url, 'br');
$keyWords = "";

if(is_array($organicKey) && !empty($organicKey['data'])){
	foreach($organicKey['data'] as $key => $keyData){
        if($key == 5){
            break;
        }
		$keyWords .= $keyData['Ph']. ", ";
	}
	$keyWords = substr($keyWords, 0, -2);
}
$returnData['keyWords'] = $keyWords;

//Google Tag Title
$objPage = SEOstats\Google::getPagespeedAnalysis();
$returnData['pageTitle'] = $objPage->title;

//Score
$returnData['pageScore'] = $returnData['backLinks'];

print_r(json_encode($returnData));
exit;
?>