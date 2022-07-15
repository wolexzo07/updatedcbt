<?php
require "crawler-detect/src/Fixtures/AbstractProvider.php";
require "crawler-detect/src/Fixtures/Exclusions.php";
require "crawler-detect/src/Fixtures/Crawlers.php";
require "crawler-detect/src/Fixtures/Headers.php";
require "crawler-detect/src/CrawlerDetect.php";
require "mobiledetectlib/Mobile_Detect.php";
require "agent/src/Agent.php";



use Jenssegers\Agent\Agent;
//use Jaybizzle\CrawlerDetect\Fixtures;
$agent = new Agent();
$desktop = $agent->isDesktop();
$phone = $agent->isPhone();
$robot = $agent->isRobot();

$browser = $agent->browser();
$version_b = $agent->version($browser);

$platform = $agent->platform();
$version_p = $agent->version($platform);

$device = $agent->device(); // works on mobile
$languages = $agent->languages();

$tablet = $agent->isTablet();
$mobile = $agent->isMobile();

$agent->isAndroidOS();
$agent->isNexus();
$agent->isSafari();

$agent->is('Windows');
$agent->is('Firefox');
$agent->is('iPhone');
$agent->is('OS X');

if($desktop){
	echo "Is a Desktop";
}else{
	echo "is not a destop";
}
echo "<br/>";
print_r($languages)."<br/>";
echo "Device Name : $device <br/>";
echo "Browser version : $browser version ".$version_b."<br/>";
echo "Platform version : $platform version ".$version_p."<br/>";
?>