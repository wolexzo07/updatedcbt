<?php
include("validatingPage.php");
if(x_count("exam_timer","id='1' LIMIT 1") > 0){
	$status = x_getsingle("SELECT status FROM exam_timer WHERE id='1' LIMIT 1","exam_timer WHERE id='1' LIMIT 1","status");
	
	$statuslist = array("on","off");
	if(in_array($status,$statuslist)){
		
		if($status == "on"){
			
			$seconds = $term;

			$_SESSION['SESS_D_EXAM_BUTTON_MA'] = "ok";
			$_SESSION['SESS_D_EXAM_RAND_TOKEN'] = sha1(md5(time().uniqid().rand(1,54598)));
			$cthh = $_SESSION['SESS_D_EXAM_RAND_TOKEN'];
			$exam_token = $cthh;
			$timet = time() + $seconds;
			$_SESSION['timeer'] = $timet;
			
			setcookie("$exam_token" ,"$exam_token" , $timet);
			
			$create = x_dbtab("attendance_multiple","
			username TEXT NOT NULL,
			subject TEXT NOT NULL,
			date_time TIMESTAMP NOT NULL
			","InnoDB");
			
			if(!$create){
				echo "Failed to create table";
				exit();
			}
			$use = $_SESSION['SESS_D_USER_EXAM'];
			$su = $_SESSION['course_session'];
			
					// Mode bypass started
				if(x_count("mode_bypass","id='1'") > 0){
					$getstatus = x_getsingle("SELECT status FROM mode_bypass WHERE id='1' LIMIT 1","mode_bypass WHERE id='1' LIMIT 1","status");  // Getting the bypass mode status
				}
				
				if(isset($getstatus)){
					
					$flist = array("enable","disable");
					
					if(in_array($getstatus ,$flist)){
						
							if($getstatus == "disable"){
								
							 if(x_count("attendance_multiple","username='$use' AND subject='$su' LIMIT 1") > 0){
								echo "<p style='color:red;letter-spacing:2px;margin-top:2%;margin-bottom:2%'>You can't re-login to take this course (<b>$su</b>) again</p>";
								}else{
								$failed = "<p style='color:red;letter-spacing:2px;margin-top:2%;margin-bottom:2%'>Failed to insert into attendance table</p>";
								$success = "<script>window.location='exams?etoken=$cthh';</script>";
								x_insert("username,subject,date_time","attendance_multiple","'$use' , '$su' , now()","$success","$failed");		
								}
								
							}else{
								finish("exams?etoken=$cthh","0");
							}
						
						}else{
							echo "<p>Bypass retriction mode inactive!</p>";
						}
					}
			// Mode bypass Ended
			
		}else{
			// off started here
			$_SESSION['SESS_D_EXAM_RAND_TOKEN'] = sha1(md5(time().uniqid().rand(1,567443)));
			$cthh = $_SESSION['SESS_D_EXAM_RAND_TOKEN'];
			finish("exams?etoken=$cthh","0");
		}
		
	}else{
		echo "invalid timing status" ;
	}
}else{
	echo "timing database failed" ;
}
	
?>
