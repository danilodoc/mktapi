<?
header("Content-Type: application/json; charset=UTF-8");
require_once('class/instagram.php');

$instagram = new MktApi\InstagramController;

$return = $instagram->setPage() ? $instagram->getPageFullData() : array('error' => 'Page not found');

print_r(json_encode($return));
?>
