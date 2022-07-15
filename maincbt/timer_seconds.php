<?php
require_once('finishit.php');
if(x_count("exam_timer","id='1' LIMIT 1") > 0){

foreach(x_select("timer,token","exam_timer","id='1'","1","id") as $key){
	$p_seconds = $key["timer"];
	$exam_token = $key["token"];
}
$seconds = $p_seconds / 1000;



}else{
	//echo "No time detected";
}

?>
