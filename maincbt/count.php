<?php
session_start();
if(!isset($_SESSION['timeer'])){
		echo "<p style='font-size:10pt;'>Timed out!</p>";
		
	}
	else{
require_once('timtalk.php');
$current = $_SESSION['timeer'] - time();
if(($current > 180) && ($current <= 200) ){
?>
<p style='font-size:10pt;'>less than 4 minutes</p>
<?php
	
	}
	
	if($current < 180){
		
		?>
			<style type="text/css">

		.timeclass{
			color:red;
			font-weight:bold;
			
			}
	</style>
		
		<?php
		
		}
		
if($current <= 0){
	unset($_SESSION['timeer']);
    
     	    unset($_SESSION['SESS_D_MEMBER_ID_EXAM']);
			unset($_SESSION['SESS_D_NAME_EXAM']);
			unset($_SESSION['SESS_D_USER_EXAM']);
			unset($_SESSION['SESS_D_LEVEL_EXAM']);
			unset($_SESSION['SESS_D_DEPT_EXAM']);
			unset($_SESSION['SESS_D_TITLE_EXAM']) ;
			unset($_SESSION['SESS_D_EMAIL_EXAM']);
			unset($_SESSION['SESS_D_MOBILE_EXAM']);
			unset($_SESSION['SESS_D_GENDER_EXAM']);
			unset($_SESSION['SESS_D_MAT_NO_EXAM']) ;
			unset($_SESSION['SESS_D_EXAM_BUTTON_MA']);
			unset($_SESSION['SESS_D_EXAM__RAND_TOKEN']);
	        unset($_SESSION['course_session']);
			
			if(isset($_SESSION['EXAM_RESULT_STOPPED'])){
				unset($_SESSION['EXAM_RESULT_STOPPED']);
				}
	}else{
echo secondsToTime($current);}}
?>
