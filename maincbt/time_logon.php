<?php
//require_once('config.php');

if(x_count("exam_timer","id='1' LIMIT 1") > 0){
	
	$status = x_getsingle("SELECT status FROM exam_timer WHERE id='1'","exam_timer WHERE id='1'","status");
	if($status == 'on'){
	include("timer_seconds.php");

				$timet = time() + $seconds;
				
				setcookie("$exam_token" ,"$exam_token" , $timet);
	}elseif($status == 'off'){
	echo "";
	}
	else{
	echo "invalid time status" ;
	}


}else{
	x_print("Timing system failed");
}
?>
