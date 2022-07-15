<?php
include("validatingPage.php");
if(x_count("relogging","id='1'") > 0){

$status = x_getsingle("SELECT relogging_status FROM relogging WHERE id='1'","relogging WHERE id='1'","relogging_status");

if($status == 'off'){
	
$user = $_SESSION['SESS_D_USER_EXAM'];

x_update("register","username='$user'","access='revoked'","&nbsp;","Failed to update access!");
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
			unset($_SESSION['SESS_D_EXAM_RAND_TOKEN']);
			unset($_SESSION['HTTP_IUOCBT']);
			
			unset($_SESSION['OPERATING_SYSTEM_IUOCBT']);
			
			if(isset($_SESSION['EXAM_RESULT_STOPPED'])){
				unset($_SESSION['EXAM_RESULT_STOPPED']);
				}
			
			finish("login-page","You have been logged out successfully");
}
elseif($status == 'on'){

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
			unset($_SESSION['SESS_D_EXAM_RAND_TOKEN']);
			unset($_SESSION['HTTP_IUOCBT']);
			unset($_SESSION['OPERATING_SYSTEM_IUOCBT']);
			if(isset($_SESSION['EXAM_RESULT_STOPPED'])){
				unset($_SESSION['EXAM_RESULT_STOPPED']);
				}
			
			finish("login-page","You have been logged out successfully");
}
else{
echo "invalid relogging status" ;
}


}
?>
