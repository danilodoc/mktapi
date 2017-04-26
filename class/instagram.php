<?php
namespace MktApi;

require_once('./vendor/autoload.php');

class InstagramController
{
	
	private $id;
	private $url;
	public $userData;
	
	function __construct(){
		
		$this->id = isset($_GET['id']) ? $_GET['id'] : (isset($_POST['id']) ? $_POST['id'] : null);
	}
	
	public function setPage(){
		
		if(empty($this->id) || !is_string($this->id)){
			return false;
		}

		$this->url = "https://www.instagram.com/" . $this->id . "/";

		$this->userData = $this->requestUrl($this->url);

		preg_match('/<script type=\"text\/javascript\">window._sharedData =(.*?);<\/script>/', $this->userData, $match);

		$this->userData = json_decode($match[1], true);

		if(empty($this->userData['entry_data'])){
			return false;
		}
		
		$this->userData = $this->userData['entry_data']['ProfilePage'][0]['user'];
		
		return true;
	}
	
	public function getPageFullData(){
		
		$postsDates = array();
		$numberOfPosts = count($this->userData['media']['nodes']);
		$totalLikes = 0;
		$totalComments = 0;

		foreach($this->userData['media']['nodes'] as $key => $post){
			$formatedDate = date('Y-m-d', $post['date']);
			array_push($postsDates, $formatedDate);

			$totalLikes += $post['likes']['count'];
			$totalComments += $post['comments']['count'];
		}

		//Frequência de posts
		$today = new \DateTime();
		$firstPostDate = new \DateTime($postsDates[$numberOfPosts-1]);
		$dateRange = date_diff($today, $firstPostDate);
		$dateRange = $dateRange->days;
		$postFrequency = $dateRange > 0 ? round($numberOfPosts/$dateRange, 2) : "10+";

		//Engajamento médio por post (likes + comentários)
		$postEngagement = round(($totalLikes + $totalComments*2) / $numberOfPosts, 2);

		$pageScore = ($totalLikes + $totalComments) / $numberOfPosts;
		$pageScore = round($pageScore*100/$this->userData['followed_by']['count'], 2);

		$returnData['profilePicture'] = $this->userData['profile_pic_url'];
		$returnData['fullName'] = $this->userData['full_name'];
		$returnData['followedBy'] = $this->userData['followed_by']['count'];
		$returnData['postFrequency'] = $postFrequency;
		$returnData['postEngagement'] = $postEngagement;
		$returnData['pageScore'] = $pageScore;
		
		return $returnData;
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
