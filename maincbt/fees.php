<?php
	// Handling student school fee payments started
	
	$p = x_getsingle("SELECT status FROM fee_data WHERE id='1' LIMIT 1","fee_data WHERE id='1' LIMIT 1","status");
	// validating if school fees payment checker for each student is activated
	if($p == "enabled"){
		
	if(x_count("fee_status","user ='$login' LIMIT 1") > 0){
		foreach(x_select("amount_paid,amount_to_pay","fee_status","user ='$login'","1","id") as $feesf){
			$amount_paid = $feth["amount_paid"];
			$amt_t_p = $feth["amount_to_pay"];
			$calc = $amt_t_p/2 ; // payment of half school fees
			
			if(($amount_paid < $calc)){
			$msg="<script type='text/javascript'>alert('Access Denied! Please complete your school fees payment.')</script>";
			finish("login-page?msg=$msg","0");
			exit();
			}
		}
		
		
	}else{
		$msg="<script type='text/javascript'>alert('Access Denied! School fees payment record not found.')</script>";
		finish("login-page?msg=$msg","0");
		exit();
	}
	}
		// Handling student school fee payments ended
	
	?>