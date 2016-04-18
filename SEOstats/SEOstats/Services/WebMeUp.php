<?php
namespace SEOstats\Services;

/**
 *  SEOstats extension for WebMeuP data.
 */

use SEOstats\SEOstats as SEOstats;
use SEOstats\Helper as Helper;

class WebMeUp extends SEOstats
{
	private static $WebMeUpUrl = "http://webmeup.com/backlink/backlinks";
	
	public static function getWebMeUpBacklinksCount($url = false) {
		
		$params = array("url" => $url, "mode" => "2", "count" => "true", "perPage" => "50", "sort" => "lastCheck", "sortAsc" => "false");
		
		$backlinks = Helper\HttpRequest::sendRequest(Self::$WebMeUpUrl, $params);
		
		$returnData = json_decode($backlinks);
		
		if(!empty($returnData->backlink->total)){
			
			return $returnData->backlink->total;
			
		}else{
			
			return "n.a";
			
		}
		
	}
}