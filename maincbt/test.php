<?php
$user = $_SESSION['SESS_D_USER_EXAM'];
if(x_dcount("categories","questions","approval_status='approved'") > 0){
	
	// Mode bypass
	if(x_count("mode_bypass","id='1'") > 0){
		$getstatus = x_getsingle("SELECT status FROM mode_bypass WHERE id='1' LIMIT 1","mode_bypass WHERE id='1' LIMIT 1","status");  // Getting the bypass mode status
	}
	
	echo "<select name='selector[]' id='selectt'>";
	foreach(x_select("DISTINCT categories","questions","approval_status='approved'","50","id desc") as $row){
		$cat = $row["categories"];
		$getnum = x_dcount("subject","exams_scores","script_owner='$user' AND subject='$cat' LIMIT 1");
		
		// validating mode bypass
		
		if(isset($getstatus)){
			
			$flist = array("enable","disable");
			
			if(in_array($getstatus ,$flist)){
				
				if($getstatus == "disable"){
					
					if($getnum > 0){
						$options = "<option value=''>$cat&nbsp;&nbsp;&nbsp;(Course Taken)</option>";
					}else{
						$options = "<option value='$cat'>$cat</option>";
					}
					echo $options;
					
				}else{
					$options = "<option value='$cat'>$cat</option>";
					echo $options;
				}
				
			}else{
				echo "<p>Bypass retriction mode inactive!</p>";
			}

		}
		
		
	}
	echo "</select>";
}else{
	echo "No subject approved!";
}

?>