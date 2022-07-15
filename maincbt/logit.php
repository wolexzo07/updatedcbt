<?php
session_start();
if(isset($_SESSION['SESS_D_USER_EXAM'])){
	
	
$user = $_SESSION['SESS_D_USER_EXAM'];
require("config.php");
$sel = "SELECT * FROM logoff_users WHERE username='$user' AND status='granted'"; 
$l = mysqli_query($con,$sel);
if(!$l){
$msg = "Failed to connect to db!";
echo $msg;
}
else{
$ru = mysqli_num_rows($l);
if($ru > 0){
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

}
else{}
}

	
	}
	
?>
