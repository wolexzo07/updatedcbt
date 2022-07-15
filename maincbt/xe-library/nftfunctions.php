<?php

	// Sending emails 
	
	function sendmails($title,$content,$user_email){
			include("../siteinfo.php");
			$date = Date("Y");
			$titl = strip_tags($title);
			$subject = "$sitename : $titl";
			$message = "
			<html>
			<head>
			<title>$sitename : $fund was credited to your wallet</title>
			</head>
			<body>

			<table cellpadding='20px' cellspacing='0px' border='0px' style='border:1px solid lightgray;' width='100%'>
			<thead>
			<tr style='background:black'>
			<th><center><img src='https://$siteurl/$sitelogo' style='width:250px;'/></center></th>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td>
			$content
			</td>
			</tr>
			</tbody>
			<tfoot>
			<tr>
			<td>
			Thank you for choosing $sitename<br/>
			From <b>$sitename Team</b>
			</td>
			</tr>
			<tr style='background:black;color:white;'>
			<td>
			<h4>CONTACT US THROUGH:</h4>
			<p>Email :  <a style='text-decoration:none;color:white;'>$siteemail</a></p>
			<p style='text-align:center;border-top:1px solid lightgray;padding-top:10px;'>Powered by <b><a style='text-decoration:none;color:white;'>$siteurl</a> &copy; $date</b></p>
			</td>
			</tr>
			</tfoot>

			</table>

			</body>
			</html>
			";
			
			if(x_count("mailcontroller","status='1'") > 0){
				
					if(sendmail($user_email,$subject,$message) == 0){
						$msg="<script type='text/javascript'>alert('Mailing Failed!')</script>";
										echo $msg;
						}	
				}
					
	}
	
	// Getting Ethereum in USD
	
	function eth2usd($ethvalue){
		
		$url = "https://min-api.cryptocompare.com/data/price?fsym=ETH&tsyms=USD,BTC,EUR";
		$ch = curl_init();  
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		$response = curl_exec($ch);
		curl_close($ch);
		$tranx = json_decode($response, true);
		if(x_count("siteinfo","site_mode='sandbox'") > 0){
			return $ethvalue;  // disabled conversion due to internet
		}else{
			return $tranx["USD"] * $ethvalue;
		}
		
		//echo $tranx["BTC"];
		//echo $tranx["EUR"];
	}
	
	// Manage notification
	function notifier($type,$title,$message,$userid,$category){
		$filter = array("p","all","admin");
		$filter_cat = array("credit","debit","bid","create","other");
		if(in_array($type,$filter) && in_array($category,$filter_cat)){
			$success = "&nbsp;";
			$failed = "<p>Failed to notify #$userid</p>";
			$stime = x_curtime(0,0);
			$rtime = x_curtime(0,1);
			
			if(x_count("notifications_controller","status='1'") > 0){
			
			if(($type == "admin") && ($userid == "")){
				x_insert("category,type,title,message,userid,status,stime,rtime","notifyme","'$category','$type','$title','$message','0','0','$stime','$rtime'","$success","$failed");
			}else{
				x_insert("category,type,title,message,userid,status,stime,rtime","notifyme","'$category','$type','$title','$message','$userid','0','$stime','$rtime'","$success","$failed");
			}
			
			
			}
			
		}else{
			echo "missing notifier parameter";
		}
	}
	// Manage mailing
	
	function manage_mailer($filename){
		if(x_count("mailcontroller","status='1'") > 0){
			include($filename);
		}
	}
	
	// Getting Alert message
	function alert_error($msg , $colorshortcode ,$fa_icon){
		print "<div class='alert alert-$colorshortcode text-center'><i class='fa fa-$fa_icon' style='font-size:60pt;'></i><br/><br/> $msg</div>";
	}
	
	// Getting on toggle on current link
	
	function current_toggle($filename){
		if(get_filepathname("no-query") == $filename){
			echo "class='active'";
		}
	}
	
	//Getting current file name from url
	
	function get_filepathname($toggle){
		$cmd = array("with-query","no-query");
			if(!in_array($toggle,$cmd)){
				print "Error: invalid cmd";
			}else{
				$getpage = $_SERVER["REQUEST_URI"];
				$sep = explode("/",$getpage);
				$withParameter = $sep[count($sep)-1];
				// handling without parameter query string ?
				$final = explode("?",$withParameter);
				
				if($toggle == "no-query"){
					return $final[0];
				}else{
					return $withParameter;
				}
			}
		
	}
	
	//Getting the full url
	 function getfull_url(){
		 $uri = $_SERVER['REQUEST_URI'];
		$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$query = $_SERVER['QUERY_STRING'];
		return $url.$query; 
	 }
	
	//session validator
	
	function validate_session($session_identifier){
		if(x_justvalidate($session_identifier)){
			if(isset($_SESSION[$session_identifier])){
				return true;
			}
		}
	}
	
	// remove session 
	
	function remove_session($session_identifier){
		if(x_justvalidate($session_identifier)){
			if(isset($_SESSION[$session_identifier])){
				unset($_SESSION[$session_identifier]);
			}
		}
	}
	
	// Getting single content from any table by id
	
	function get_content_byid($columnname,$tablename,$tableid){
		if(x_justvalidate($tableid) && x_justvalidate($tablename) && x_justvalidate($columnname)){
			if(is_numeric($tableid)){
				$result = x_getsingle("SELECT $columnname FROM $tablename WHERE id='$tableid' LIMIT 1","$tablename WHERE id='$tableid'","$columnname");
				return $result; 
			}else{
				return "Error: invalid table id";
			}	
		}	
	}
	
	// Getting wallet Balance
	
	function nft_wallet_balance($userid,$toggle){
		if(x_justvalidate($toggle) && x_justvalidate($userid)){
			$cmd = array("show","hide");
			if(!in_array($toggle,$cmd)){
				echo "Error: invalid cmd";
			}else{
				if($toggle == "show"){
					$bal = x_getsingle("SELECT wallet_balance FROM manage_accounts WHERE id='$userid' LIMIT 1","manage_accounts WHERE id='$userid'","wallet_balance");
					echo $bal;
				}else{
					echo "******";
				}
			}
		}	
	}

?>