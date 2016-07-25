<?
header("Content-Type: application/json; charset=UTF-8");
require_once('class/facebook.php');

$facebook = new MktApi\FacebookController;

$return = $facebook->setPage() ? $facebook->getPageFullData() : array('error' => 'Page not found');

print_r(json_encode($return));
?>
