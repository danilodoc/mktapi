<?php
ini_set('display_errors','off');
header("Content-type: text/html; charset=UTF-8");

if(empty($_GET['url'])){
	exit('Insira a URL da marca');
}

require_once __DIR__ . DIRECTORY_SEPARATOR . 'SEOstats' . DIRECTORY_SEPARATOR . 'SEOstats' . DIRECTORY_SEPARATOR . 'bootstrap.php';

use \SEOstats\Services as SEOstats;

$url = $_GET['url'];

$seostats = new \SEOstats\SEOstats;

if ($seostats->setUrl($url)) {

echo '<b>WebMeUp Backlinks: </b>'.SEOstats\WebMeUp::getWebMeUpBacklinksCount($url);
echo '<br />';

echo '<b>Google Page Rank: </b>'.SEOstats\Google::getPageRank();
echo '<br />';

$domainAuthority = round(SEOstats\Mozscape::getDomainAuthority());
echo '<b>Mozscape Domain Authority: </b>'.$domainAuthority;
echo '<br />';

$pageAuthority = round(SEOstats\Mozscape::getPageAuthority());
echo '<b>Mozscape Page Authority: </b>'.$pageAuthority;
echo '<br />';

$organicKey = SEOstats\SemRush::getOrganicKeywords($url, 'br');
$keyWords = "";

if(is_array($organicKey) && !empty($organicKey['data'])){
	foreach($organicKey['data'] as $keyData){
		$keyWords .= $keyData['Ph']. ", ";
	}
	$keyWords = substr($keyWords, 0, -2);
}
echo '<b>Google Keywords Principais: </b>'.$keyWords;
echo '<br />';

$objPage = SEOstats\Google::getPagespeedAnalysis();
echo '<b>Google Tag Title: </b>'.$objPage->title;
echo '<br />';
}
?>