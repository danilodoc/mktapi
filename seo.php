<?php
header("Content-Type: application/json; charset=UTF-8");
require_once('class/seo.php');

$seo = new MktApi\SEOController;

$return = $seo->setURL() ? $seo->getURLFullInfo() : array('error' => 'Invalid URL');

print_r(json_encode($return));
?>
