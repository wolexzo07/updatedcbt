<?php
include("validatingPage.php");
if(x_count("cross_platform_mode","id='1'") > 0){
	
	$p = x_getsingle("SELECT status FROM cross_platform_mode WHERE id='1'","cross_platform_mode WHERE id='1'","status");
	if($p == "enable"){

	}
	else{
	require("tt_show.php");
	}

}else{
$msg="<b>No status</b>";
echo $msg;

}

?>
