<?php
session_start();
include("finishit.php");
if(x_validatepost("mat") && x_validatepost("pass")){

	$create = x_dbtab("usertimer","
	user VARCHAR(255) NOT NULL,
	token TEXT NOT NULL,
	start_time VARCHAR(255) NOT NULL,
	stop_time VARCHAR(255) NOT NULL, 
	currentime VARCHAR(255) NOT NULL 
	","MyISAM");
	
	if(!$create){
		finish("./","Failed to create table!");
		exit();
	}
	

	$login = x_clean(x_post('mat'));
	
	$salt = "wolexzo07dacrackertheBlAcKerhathacker199019921962";
	$password = X_clean(md5(sha1(x_post('pass').$salt)));
	
	// Revoking access of user account
	
	if(x_count("register","username ='$login' AND Password = '$password' AND access = 'revoked' LIMIT 1") > 0){
		finish("login-page","Account temporarily suspended! Try again later or contact ICT Department");
		exit();
	}
	
	// Validating login access
	
	if(x_count("register","username ='$login' AND Password = '$password' AND access = 'granted' LIMIT 1") > 0){

			
			
			include("fees.php"); // fees authentication begins b4 taking exams
				
			// Fetching the current user data
			
			foreach(x_select("0","register","username ='$login' AND Password = '$password' AND access = 'granted'","1","id") as $member){
				
				$_SESSION['SESS_D_MEMBER_ID_EXAM'] = $member['id'];
				$_SESSION['SESS_D_NAME_EXAM'] = $member['Name'];
				$_SESSION['SESS_D_USER_EXAM'] = $member['username'];
				$_SESSION['SESS_D_LEVEL_EXAM'] = $member['Level'];
				$_SESSION['SESS_D_DEPT_EXAM'] = $member['Department'];
				$_SESSION['SESS_D_TITLE_EXAM'] = $member['title'];
				$_SESSION['SESS_D_EMAIL_EXAM'] = $member['email'];
				$_SESSION['SESS_D_MOBILE_EXAM'] = $member['mobile'];
				$_SESSION['SESS_D_GENDER_EXAM'] = $member['Gender'];
				$_SESSION['SESS_D_MAT_NO_EXAM'] = $member['Admission_No'];
				$_SESSION['SESS_BLIV'] = sha1(uniqid()).sha1(rand(4 , 3000));
				$_SESSION['HTTP_IUOCBT'] = xip(); 
				$_SESSION['OPERATING_SYSTEM_IUOCBT'] = xos();
			
			}
			include("choice.php");
			session_write_close();
			
			
			
			include("time_logon.php");
			
			//$msg="<script type='text/javascript'>alert('')</script>";
			
			finish("./","0");
		}
		else {
		
		finish("login-page","Username or password incorrect!!");
		}
}
else{
		finish("login-page","Parameter");
}

?>
