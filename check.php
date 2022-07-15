<?php

include_once("iuocbt/finishit.php");
if(x_dcount("subject","exams_scores","01") > 0){
	foreach(x_distinct("subject","exams_scores","0","0","id desc") as $key){
	$subject = $key["subject"];
	echo $subject."<br/>";
}
}else{
	
}


#include_once("iuocbt/finishit.php");
#echo x_dcount("subject","exams_scores","0");

?>