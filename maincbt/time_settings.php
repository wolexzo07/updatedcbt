<?php
require_once('finishit.php');
if(x_count("exam_timer","id='1' LIMIT 1") > 0){
foreach(x_select("status","exam_timer","id='1'","1","id") as $key){
	$status = $key["status"];
}	
if($status == 'on'){
include("timer_seconds.php");
if(!isset($_COOKIE["$exam_token"])){
$msg="<b style='color:red'>Your time has expired</b>";
echo $msg;
exit;
}}
elseif($status == 'off'){
echo "";
}
else{
echo "invalid time status" ;
}

}else{
	//No time was set
}

?>
