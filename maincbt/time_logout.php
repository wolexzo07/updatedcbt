<?php
include_once('finishit.php');
if(x_count("exam_timer","id='1' LIMIT 1") > 0){
foreach(x_select("status","exam_timer","id='1'","1","id") as $key){
	$status = $key["status"];}
if($status == 'on'){
include("timer_seconds.php");
if(!isset($_COOKIE["$exam_token"])){
finish("logout.php","No cookie is active");
exit();
}

}
elseif($status == 'off'){
//echo "";
}
else{
//echo "" ;
}

}else{
finish("logout.php","Timing database failed");
exit();
}
?>
