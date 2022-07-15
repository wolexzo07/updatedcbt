<?php
	$fum = x_count("multiple_choice","user ='$login' LIMIT 1");
	if($fum == 0){
	$ran = array('id' ,'f_option' ,'s_option' ,'t_option' ,'ft_option' ,'question' ,'answer' ,'token' ,'date_time');
	
	$randico = array('desc' , 'asc');
	
	$randomic = array_rand($randico);
	
	$randomico = $randico[$randomic];
	
	$random = array_rand($ran);
	
	$ty = $ran[$random];
	$tyd = $ran[$random];
	if($ty == "id"){
	$ty = "A";
	}
	elseif($ty == "f_option"){
	$ty = "B";
	}
	elseif($ty == "s_option"){
	$ty = "C";
	}
	elseif($ty == "t_option"){
	$ty = "D";
	}
	elseif($ty == "ft_option"){
	$ty = "E";
	}
	elseif($ty == "question"){
	$ty = "F";
	}
	elseif($ty == "answer"){
	$ty = "G";
	}
	elseif($ty == "token"){
	$ty = "H";
	}
	else{
	$ty = "I";
	}
	$tou = sha1(rand(time().uniqid().wolexzo07dacracker));
		
	x_insert("user ,qchoice , arrangement ,status ,login_time , token","multiple_choice","'$login' ,'$ty' , '$randomico' ,'$tyd' ,now() ,'$tou'","<script type='text/javascript'>window.location = 'login-page';alert('Failed to set paper type.')</script>","<script type='text/javascript'>alert('Failed to set paper type.')</script>");
	//exit();
}
		?>