<?php
if(x_count("cross_platform_mode","id='1'") > 0){
	
	$p = x_getsingle("SELECT status FROM cross_platform_mode WHERE id='1'","cross_platform_mode WHERE id='1'","status");
	
	if($p == "enable"){
		
		require("multiple_exam.php");
		
	}
	elseif($p == "disable"){

		if(isset($_SESSION['SESS_D_EXAM_BUTTON_MA'])){
			finish("exams","0");
			}
			else{
				?>
					<img src="img/view_ex1.png" class="vewe1" onclick="parent.location='time_logon_go'"/>
		
				<?php
				
				
				}
	}
	else{
	$msg="<b></b>";
	echo $msg;
	}

}else{
$msg="<b>No status</b>";
echo $msg;
}

?>
