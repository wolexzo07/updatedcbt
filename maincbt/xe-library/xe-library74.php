<?php
//error_reporting(0);
//@ob_start();
//ini_set('error_reporting',E_ALL&~E_NOTICE&~E_WARNING&~E_DEPRECATED);

require "phpqrcode/qrlib.php";
//require "phpqrcode/barcode/barcode.php";

require "mailer/PHPMaile6x/src/Exception.php";
require "mailer/PHPMaile6x/src/PHPMailer.php";
require "mailer/PHPMaile6x/src/SMTP.php";

// Agent Library started
require "ExternalLibr/crawler-detect/src/Fixtures/loader.php";
require "ExternalLibr/crawler-detect/src/CrawlerDetect.php";
require "ExternalLibr/mobiledetectlib/Mobile_Detect.php";
require "ExternalLibr/agent/src/Agent.php";

// Agent Library ended

function x_print($val){
	//if(isset($val) && ($val != "")){
	if(isset($val) && ($val != "")){
		echo $val;
	}else{
		echo "Missing result!";
	}
}

function x_cstring(){
include("servenow/baseconnect.php");
$con = mysqli_connect($host , $user , $pass , $db) or die("Error connecting: ".mysqli_error());
return $con;
}
//Send mail locally from the system
function sendmail($to,$subject,$message){
	include("servenow/email_settings.php");
  $mail 			= new PHPMailer\PHPMailer\PHPMailer();
  $body 			= $message;
  $mail->IsSMTP();
  $mail->SMTPAuth   = $smtp_auth;
  $mail->Host       = $hostserver;
  $mail->Port       = $port;
  $mail->Username   = $username;
  $mail->Password   = $password;
  $mail->SMTPSecure = $protocol;
  $mail->SetFrom($setfrom,$title);
  $mail->AddReplyTo($replyto,$title);
  $mail->Subject    = $subject;
  $mail->AltBody    = "";
  $mail->MsgHTML($body);
  $address 			= $to;
  #$mail->AddAddress($address, $name);
  $mail->AddAddress($address, "");
  if(!$mail->Send()) {
	  return 0;
  } else {
		return 1;
 }
    }

//sending email with default server settings

function sendmail_local($to,$subject,$message){
include("servenow/email_settings.php");
$body = $message;
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->isSendmail();
$mail->setFrom($setfrom,$title);
$mail->addReplyTo($replyto,$title);
$mail->addAddress($to, '');
$mail->Subject = $subject;
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
$mail->MsgHTML($body);
$mail->AltBody = '';
//$mail->addAttachment('');
if (!$mail->send()){
   return 0;
}else{
    return 1;
}
    }
	

function x_mailer($type,$to,$subject,$message){

if($type == "0"){
	return sendmail_local($to,$subject,$message);
}elseif($type == "1"){
	return sendmail($to,$subject,$message);
}else{
	$msg = "Invalid options";
	return $msg;
}

}
	
function x_short($str){
$str = @trim($str);
$arr = explode(" ",$str);
foreach($arr as $key){
	
	echo substr(strtoupper($key),0,1);
	
}
}

function x_random($length=32)
{
    $final_rand='';
    for($i=0;$i< $length;$i++)
    {
        $final_rand .= rand(0,9);
 
    }
 
    return $final_rand;
}

function x_cape($chk){
	return mysqli_real_escape_string(x_cstring(),$chk);
}

function xclean($chk){
	$chk = @trim($chk);
	if(!isset($chk) || empty($chk)){
		x_print("Missing compulsory fields!");
		exit();
	}else{
x_cstring();
$chk = @trim($chk);
$chk = htmlspecialchars($chk);

/***if(get_magic_quotes_gpc()){
$chk = stripslashes($chk);
}****/
return x_cape($chk);
	}

}
function xsanit($chk){
x_cstring();
$chk = @trim($chk);
$chk = htmlspecialchars($chk);
/***if(get_magic_quotes_gpc()){
$chk = stripslashes($chk);
}***/
return x_cape($chk);	
}

function x_post($chk){
	return @trim($_POST[$chk]);
}
function x_get($chk){
	return @trim($_GET[$chk]);
}

function xpp($chk){
	return xsanit($_POST[$chk]);
}
function xp($chk){
	return xclean($_POST[$chk]);
}

function xg($chk){
	return xclean($_GET[$chk]);
}

function xgg($chk){
	return xsanit($_GET[$chk]);
}

function xpmail($chk){
$par = "/^[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z_+])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9}$/";
$email = $_POST[$chk];
$r = preg_match($par,$email);
if(!$r){
	x_print("Invalid email supplied");
	exit();
	}
return xclean($email);
}

function xgmail($chk){
$par = "/^[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z_+])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9}$/";
$email = $_GET[$chk];
$r = preg_match($par,$email);
if(!$r){
	x_print("Invalid email supplied");
	exit();
	}
return xclean($email);
}

function x_clean($chk){
		x_cstring();
		$chk = @trim($chk);
		/***if(get_magic_quotes_gpc()){
		$chk = stripslashes($chk);
		}***/
		return x_cape($chk);
	}
				
function x_connect($chk){
$read = mysqli_query(x_cstring(),$chk);				
return $read;
}


function x_counted($chk){
	$count = mysqli_num_rows(x_connect($chk));
	return $count;
}

function x_count($table,$where){
	
	if($where == "0"){
		$sele ="SELECT COUNT(*) as obey FROM $table";
	}elseif($where == "01"){
		$sele ="SELECT COUNT(*) as obey FROM $table LIMIT 1";
		}else{
		$sele ="SELECT COUNT(*) as obey FROM $table WHERE $where";
	}

if(!$read = x_connect($sele)){
$msg = "Failed to query db";
return $msg;
}else{
$assoc = mysqli_fetch_assoc($read);
$num = $assoc["obey"];
return $num;
}
}

function x_dcount($what,$table,$where){
	
	if($where == "0"){
		$sele ="SELECT COUNT(DISTINCT $what) as obey FROM $table";
	}elseif($where == "01"){
		$sele ="SELECT COUNT(DISTINCT $what) as obey FROM $table LIMIT 1";
		}else{
		$sele ="SELECT COUNT(DISTINCT $what) as obey FROM $table WHERE $where";
	}

if(!$read = x_connect($sele)){
$msg = "Failed to query db";
return $msg;
}else{
$assoc = mysqli_fetch_assoc($read);
$num = $assoc["obey"];
return $num;
}
}

function x_sum($what,$table,$where){
	
	$limit = x_count($table,$where);
	
	if($limit > 0){
		
			if(($where == "0")){
				$sele ="SELECT SUM($what) as obey FROM $table LIMIT $limit";
			}else{
				$sele ="SELECT SUM($what) as obey FROM $table WHERE $where LIMIT $limit";
			}

			if(!$read = x_connect($sele)){
			$msg = "Failed to query db";
			return $msg;
			}else{
			$assoc = mysqli_fetch_assoc($read);
			$num = $assoc["obey"];
			return $num;
			}
	}else{
		return 0;
	}
}

include("new_db_functions.php");


function x_query($what,$table,$where,$limit_opt,$order){
$limit = x_count($table,$where);
	if($order == "0"){
	if(($what == "0") && ($where == "0")){
		$sele ="SELECT * FROM $table LIMIT $limit";
	}elseif(($what !== "0") && ($where == "")){
		$sele ="SELECT $what FROM $table LIMIT $limit";
	}elseif(($what == "0") && ($where !== "0") && ($limit_opt == "0")){
		$sele ="SELECT * FROM $table WHERE $where LIMIT $limit";
	}else{
		$sele ="SELECT $what FROM $table WHERE $where LIMIT $limit";
	}
	}else{
	if(($what == "0") && ($where == "0")){
		$sele ="SELECT * FROM $table ORDER BY $order LIMIT $limit";
	}elseif(($what !== "0") && ($where == "")){
		$sele ="SELECT $what FROM $table ORDER BY $order LIMIT $limit";
	}elseif(($what == "0") && ($where !== "0") && ($limit_opt == "0")){
		$sele ="SELECT * FROM $table  WHERE $where ORDER BY $order LIMIT $limit";
	}else{
		$sele ="SELECT $what FROM $table WHERE $where ORDER BY $order LIMIT $limit";
	}
	}
	return $sele;
	}


function x_select($what,$table,$where,$limit_opt,$order){
	if($limit_opt == "0"){
		$limit = x_count($table,$where);
	}else{
		$limit = $limit_opt;
	}
	
	if($order == "0"){
		
	if(($what == "0") && ($where == "0")){
		$sele ="SELECT * FROM $table LIMIT $limit";
	}elseif(($what !== "0") && ($where == "")){
		$sele ="SELECT $what FROM $table LIMIT $limit";
	}elseif(($what == "0") && ($where !== "0") && ($limit_opt == "0")){
		$sele ="SELECT * FROM $table WHERE $where LIMIT $limit";
	}elseif(($where == "0") && ($limit_opt == "0")){
		$sele ="SELECT * FROM $table LIMIT $limit";
	}elseif(($where == "0") && ($limit_opt != "0")){
		$sele ="SELECT * FROM $table LIMIT $limit";
	}elseif(($what == "0")){
		$sele ="SELECT * FROM $table WHERE $where LIMIT $limit";
		}else{
		$sele ="SELECT $what FROM $table WHERE $where LIMIT $limit";
	}
	
	}else{
		
	if(($what == "0") && ($where == "0")){
		$sele ="SELECT * FROM $table ORDER BY $order LIMIT $limit";
	}elseif(($what !== "0") && ($where == "")){
		$sele ="SELECT $what FROM $table ORDER BY $order LIMIT $limit";
	}elseif(($what == "0") && ($where !== "0") && ($limit_opt == "0")){
		$sele ="SELECT * FROM $table  WHERE $where ORDER BY $order LIMIT $limit";
	}elseif(($where == "0") && ($limit_opt == "0")){
		$sele ="SELECT * FROM $table ORDER BY $order LIMIT $limit";
	}elseif(($where == "0") && ($limit_opt != "0")){
		$sele ="SELECT * FROM $table ORDER BY $order LIMIT $limit";
	}elseif(($what == "0")){
		$sele ="SELECT * FROM $table WHERE $where ORDER BY $order LIMIT $limit";
		}else{
		$sele ="SELECT $what FROM $table WHERE $where ORDER BY $order LIMIT $limit";
	}
	
	}

	
	if(!$read = x_connect($sele)){
	$msg = "Failed to select data!";
	x_print($msg);
	}else{
	while($assoc = mysqli_fetch_array($read)){
		
		$acc[] = $assoc;
	}
	return $acc;
	}
}


function x_distinct($what,$table,$where,$limit_opt,$order){
	if($limit_opt == "0"){
		$limit = x_dcount($what,$table,$where);
	}else{
		$limit = $limit_opt;
	}
	
	if($order == "0"){
		
	if(($what == "0") && ($where == "0")){
		$sele ="SELECT DISTINCT $what FROM $table LIMIT $limit";
	}elseif(($what !== "0") && ($where == "")){
		$sele ="SELECT DISTINCT $what FROM $table LIMIT $limit";
	}elseif(($what == "0") && ($where !== "0") && ($limit_opt == "0")){
		$sele ="SELECT DISTINCT $what FROM $table WHERE $where LIMIT $limit";
	}elseif(($where == "0") && ($limit_opt == "0")){
		$sele ="SELECT DISTINCT $what FROM $table LIMIT $limit";
	}elseif(($where == "0") && ($limit_opt != "0")){
		$sele ="SELECT DISTINCT $what FROM $table LIMIT $limit";
	}elseif(($what == "0")){
		$sele ="SELECT DISTINCT $what FROM $table WHERE $where LIMIT $limit";
		}else{
		$sele ="SELECT DISTINCT $what FROM $table WHERE $where LIMIT $limit";
	}
	
	}else{
		
	if(($what == "0") && ($where == "0")){
		$sele ="SELECT DISTINCT $what FROM $table ORDER BY $order LIMIT $limit";
	}elseif(($what !== "0") && ($where == "")){
		$sele ="SELECT DISTINCT $what FROM $table ORDER BY $order LIMIT $limit";
	}elseif(($what == "0") && ($where !== "0") && ($limit_opt == "0")){
		$sele ="SELECT DISTINCT $what FROM $table  WHERE $where ORDER BY $order LIMIT $limit";
	}elseif(($where == "0") && ($limit_opt == "0")){
		$sele ="SELECT DISTINCT $what FROM $table ORDER BY $order LIMIT $limit";
	}elseif(($where == "0") && ($limit_opt != "0")){
		$sele ="SELECT DISTINCT $what FROM $table ORDER BY $order LIMIT $limit";
	}elseif(($what == "0")){
		$sele ="SELECT DISTINCT $what FROM $table WHERE $where ORDER BY $order LIMIT $limit";
		}else{
		$sele ="SELECT DISTINCT $what FROM $table WHERE $where ORDER BY $order LIMIT $limit";
	}
	
	}

	
	if(!$read = x_connect($sele)){
	$msg = "Failed to select data!";
	x_print($msg);
	}else{
	while($assoc = mysqli_fetch_array($read)){
		
		$acc[] = $assoc;
	}
	return $acc;
	}
}



function x_insert($field,$table,$values,$success,$error){
	$insert = "INSERT INTO $table ($field) VALUES($values)";
	if($read = x_connect($insert)){
			if($success == "0"){
			#$msg = "<script>alert('Data submitted successfully!')</script>";
			$msg = "";
			}else{
			$msg = $success;
			}
			x_print($msg);
	}else{
			if($error == "0"){
			$msg = "<script>alert('Data Failed to be inserted into the database!')</script>";
			}else{
			$msg = $error;
			}
			x_print($msg);
	}
}

function x_updated($table,$where,$fieldval,$success,$error){
	$limit = x_count($table,$where);
	if($where == "0"){
	$update = "UPDATE $table SET $fieldval LIMIT $limit";
	}else{
	$update = "UPDATE $table SET $fieldval WHERE $where LIMIT $limit";
	}
	if($read = x_connect($update)){
			if($success == "0"){
			$msg = "<p class='hubmsg'>Data updated successfully!</p>";
			}else{
			$msg = "<p class='hubmsg'>$success</p>";
			}
			echo $msg;
	}else{
			if($error == "0"){
      $msg = "<p class='hubmsg'>Failed to update!</p>";
			}else{
			$msg = "<p class='hubmsg'>$error</p>";
			}
			echo $msg;
	}
}

function x_update($table,$where,$fieldval,$success,$error){
	$limit = x_count($table,$where);
	if($where == "0"){
	$update = "UPDATE $table SET $fieldval LIMIT $limit";
	}else{
	$update = "UPDATE $table SET $fieldval WHERE $where LIMIT $limit";
	}
	if($read = x_connect($update)){
			if($success == "0"){
			$msg = "<script type='text/javascript'>alert('Data updated successfully!')</script>";
			}else{
			$msg = "<script type='text/javascript'>alert('$success')</script>";
			}
			#echo $msg;
	}else{
			if($error == "0"){
			$msg = "<script type='text/javascript'>alert('Data failed to update!')</script>";
			}else{
			$msg = "<script type='text/javascript'>alert('$error')</script>";
			}
			#echo $msg;
	}
}
function x_open($colsarr,$w,$cs,$cp,$cb,$align){
#echo "<table class='table table-striped table-hover' cellspacing='$cs' width='$w' cellpadding='$cp' border='$cb'><tr>";
echo "<table id='tableID' class='table table-hover' cellspacing='$cs' width='$w' cellpadding='$cp' style='font-size:10pt;'><tr>";
$arr = explode(",",$colsarr);
	$ct =count($arr);
	foreach($arr as $key){
		$see = $key;
		if($align == "0"){
			x_print("<th>$see</th>");
		}else{
			x_print("<th align='$align'>$see</th>");	
		}

	}
	x_print("</tr>");
	}
function x_content($colsarr){
		x_print("<tr>");
$arr = explode(",",$colsarr);
	$ct =count($arr);
	foreach($arr as $key){
		$see = $key;
	x_print("<td>$see</td>");
	}
	x_print("</tr>");
}

function x_cont($colsarr){
		x_print("<tr>");
$arr = explode("~",$colsarr);
	$ct =count($arr);
	foreach($arr as $key){
		$see = $key;
	x_print("<td>$see</td>");
	}
	x_print("</tr>");
}

function x_close(){
	x_print("</table>");
}

function x_del($table,$where,$success,$error){
	$limit = x_count($table,$where);
	if($where == "0"){
	$update = "DELETE FROM $table LIMIT $limit";
	}else{
	$update = "DELETE FROM $table WHERE $where LIMIT $limit ";
	}
	if($read = x_connect($update)){
			if($success == "0"){
			$msg = "Data deleted successfully!";
			}else{
			$msg = $success;
			}
			x_print($msg);
	}else{
			if($error == "0"){
			$msg = "Data failed to delete!";
			}else{
			$msg = $error;
			}
			x_print($msg);
	}
}

#creating table
function x_create($table,$content){
	$create = "CREATE TABLE IF NOT EXISTS $table(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	$content
	)ENGINE=innodb";
	$read = x_connect($create);
	return $read;
}
#creating table with engine
function x_dbtab($table,$content,$engine){
	$create = "CREATE TABLE IF NOT EXISTS $table(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	$content
	)ENGINE=$engine";
	$read = x_connect($create);
	return $read;
}
#create database x_db($dbname)
function x_db($db){
	$create = "CREATE DATABASE IF NOT EXISTS $db";
	$read = x_connect($create);
	return $read;
}

#drop database
function x_dropdb($db){
	$create = "DROP DATABASE IF EXISTS $db";
	$read = x_connect($create);
	return $read;
}

function x_droptab($db){
	$create = "DROP TABLE IF EXISTS $db";
	$read = x_connect($create);
	return $read;
}


function x_curtime($zone,$format){
	if($format == "0"){
if($zone == "0"){
$datetime = new DateTime('now',new DateTimeZone("Africa/Lagos"));
#$dat = $datetime->format("Y-m-d H:i:s"); 
$dat = DATE("Y-m-d H:i:s"); 
return $dat;
	}else{
$datetime = new DateTime('now',new DateTimeZone("$zone"));
#$dat = $datetime->format("Y-m-d H:i:s"); 
$dat = DATE("Y-m-d H:i:s"); 
return $dat;
	}
	}else{
		if($zone == "0"){
		$datetime = new DateTime('now',new DateTimeZone("Africa/Lagos"));
$dat = $datetime->format("Y-m-d h:i:s a"); 
return $dat;
	}else{
		$datetime = new DateTime('now',new DateTimeZone("$zone"));
$dat = $datetime->format("Y-m-d h:i:s a"); 
return $dat;
	}
	}

}
function x_money($vals,$dec){
	if($dec == ""){
			$nn = number_format($vals,2);
			return $nn;
	}else{
			$nn = number_format($vals,$dec);
			return $nn;
	}

}

function finish($loc,$message){
	if($message == "0"){
		?>
		<script type="text/javascript">
		window.location="<?php x_print($loc);?>";
		</script>
	<?php
	exit();
	}elseif($loc == "0"){
				?>
		<script type="text/javascript">
		alert("<?php x_print($message);?>");
		</script>
	<?php
	}else{
		?>
		<script type="text/javascript">
		alert("<?php x_print($message);?>");
		window.location="<?php x_print($loc);?>";
		</script>
	<?php
	exit();
	}
	
}
#file upload handling functions

function x_getsize($size){
		
		$calc_kb = $size/(1024); // convert to kb
		$calc_mb = $size/(1024*1024); // convert to mb
		$calc_gb = $size/(1024*1024*1024); // convert to gb
		$calc_tr = $size/(1024*1024*1024*1024); // convert to tera
		
		if($calc_kb >= 1024){
			return number_format($calc_mb,2)."mb";
		}elseif($calc_mb >= 1024){
			return number_format($calc_gb,2)."gb";
		}elseif($calc_gb >= 1024){
			return number_format($calc_tr,2)."tb";
		}elseif($size >= 1024){
			return number_format($calc_kb,2)."kb";
		}else{
			return number_format($size,2)."b";
		}
		
		}

#get filesize
function x_size($val){
	if($val == ""){
		x_print("File variable missing!");
		exit();
	}else{
		$size = $_FILES[$val]['size']; // converting bytes
		#x_getsize($size);
	
		$calc_kb = $size/(1024); // convert to kb
		$calc_mb = $size/(1024*1024); // convert to mb
		$calc_gb = $size/(1024*1024*1024); // convert to gb
		$calc_tr = $size/(1024*1024*1024*1024); // convert to tera
		
		if($calc_kb >= 1024){
			return number_format($calc_mb,2)."mb";
		}elseif($calc_mb >= 1024){
			return number_format($calc_gb,2)."gb";
		}elseif($calc_gb >= 1024){
			return number_format($calc_tr,2)."tb";
		}elseif($size >= 1024){
			return number_format($calc_kb,2)."kb";
		}else{
			return number_format($size,2)."b";
		}
		
		
	}
}

#get extension alone
function x_file($variable){
	if(($variable == "")){
		x_print("Variable not available!");
		exit();
	}else{
		$vr = explode(".",$_FILES[$variable]['name']);
			$ext = end($vr);
		return $ext;	
	}

}


# xtex($allowed_ext,$variable) will check file extension
function xtex($allowed_ext,$variable){
	if(($allowed_ext == "") || ($variable == "")){
		x_print("File extension missing or variable not available!");
		exit();
	}else{
	#$pray = array($allowed_ext);
	$pray = explode(",",$allowed_ext);
	$vao = explode(".",$_FILES[$variable]['name']);
	$ext = strtolower(end($vao));
if(!in_array($ext,$pray)){
$msg = "format not supported($allowed_ext) ";
	x_print($msg);
	exit();
}else{
	
}
	}
	
}

//checking for uploaded file

function x_ischeckupload($val){
	if($val != ""){
		return is_uploaded_file($_FILES[$val]['tmp_name']);
	}else{
		return "missing file variable";
		exit();
	}
	
}


# xcload($val) will check file upload status
function xcload($val){
	if($val == ""){
		x_print("File variable not available!");
		exit();
	}else{
	if(!is_uploaded_file($_FILES[$val]['tmp_name'])){
		x_print("No file is uploaded for <b>$val</b>!");
		exit();
	}else{
		}}
}
#xexit($val,$loc) will check for file existence at specified location
function xexit($val,$loc){
	if(($val == "") || (($loc == ""))){
		x_print("File target location or variable cannot be empty!");
		exit();
	}else{
		$locc = $loc.$_FILES[$val]['name'];
		if(file_exists($locc)){
		x_print("File already exist at the targeted location!");
		exit();
		}else{
				
			}
	}
	
}
#xmload($val,$loc,$file_exists) will move uploaded file to specified location
function xmload($val,$loc,$file_exists){
	if(($val == "") || (($loc == ""))){
		x_print("File target location or variable cannot be empty!");
		exit();
	}else{
		$vb = $_FILES[$val]['tmp_name'];
		$locc = $loc.$_FILES[$val]['name'];
		if($file_exists == "1"){
		if(file_exists($locc)){
		x_print("File already exist at the targeted location!");
		exit();
		}else{
				
			}
		}else{
		return move_uploaded_file($vb,$loc);
		}
	}
}

//hash path in part
function xpath($val,$loc){
	return $loc.$_FILES[$val]['name'];
}
//hash full path
function x_path($val,$loc){
	return $loc.sha1($_FILES[$val]['name']).".".x_file("$val");
}


#xcsize($val,$maxsize) will check file size
function xcsize($val,$maxsize){
	if(($val == "") || ($maxsize == "")){
		x_print("Specify file variable or max upload size");
		exit();
	}elseif(!is_numeric($maxsize)){
		x_print("Max upload size must be numeric!");
		exit();
	}else{
		$calc = $maxsize;  //converting to byte
		$size = $_FILES[$val]['size'];
		if($size > $calc){
			$er = x_getsize($calc);
		x_print("File upload can not exceed the <b>$er</b> specified for $val");
			exit();
		}else{		
		}
	}	
}

#xrand($len) to generate random figure like;
function x_rand_tim($min,$max){
$range = $max - $min;
if($range < 1)
return $min;
$log = ceil(log($range,2));
$bytes = (int)($log/8)+1;
$bits = (int)$log + 1;
$filter = (int)(1 << $bits) - 1;
do{
$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
$rnd = $rnd & $filter;
}while ($rnd > $range);
return $min + $rnd;
}
function xrands($len){
$token = "";
$cac = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$ca = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$ca .= strtolower($cac);
$ca .= "0123456789";
$max = strlen($ca);
for($i=0;$i<$len;$i++){
$token .= $ca[x_rand_tim(0,$max-1)];
}
return $token;
}

#for php 7 support only
function xtoken($len){
$token = "";
$cac = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$ca = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$ca .= strtolower($cac);
$ca .= "0123456789";
$max = strlen($ca);
for($i=0;$i<$len;$i++){
$token .= $ca[random_int(0,$max-1)];
}
return $token;
}

##capture device information

function xip()
{
if (!empty($_SERVER['HTTP_CLIENT_IP']))

{
$ipadd=$_SERVER['HTTP_CLIENT_IP'];
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))

{
$ipadd=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
else
{
$ipadd=$_SERVER['REMOTE_ADDR'];
}


if($ipadd == "::1"){
	$ip = "127.0.0.1";
	return $ip;
}else{
return $ipadd;
}

}


function xbr() {

    global $user_agent;

    $browser        =   "Unknown Browser";

    $browser_array  =   array(
            '/msie/i'       =>  'Internet Explorer',
            '/firefox/i'    =>  'Firefox',
            '/safari/i'     =>  'Safari',
            '/chrome/i'     =>  'Chrome',
            '/opera/i'      =>  'Opera',
            '/netscape/i'   =>  'Netscape',
            '/maxthon/i'    =>  'Maxthon',
            '/konqueror/i'  =>  'Konqueror',
            '/mobile/i'     =>  'Handheld Browser'
                        );

    foreach ($browser_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }

    }

    return $browser;

}



$user_agent     =   $_SERVER['HTTP_USER_AGENT'];
function xos() { 
	
    global $user_agent;

    $os_platform    =   "Unknown OS Platform";

    $os_array       =   array(
            '/windows nt 10.0/i'     =>  'Windows 10',
			'/windows nt 8.1/i'     =>  'Windows 8.1',
			'/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
                        );

    foreach ($os_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }

    }   

    return $os_platform;

}

#session definations
#xstart($pick) with option 1 or 0 to start or close session
function xstart($pick){
	if($pick == 1){
			return session_write_close();
		}elseif($pick == 0){
			if(session_status() != PHP_SESSION_ACTIVE){
				//session_status() == PHP_SESSION_NONE
				//session_id() == ""
				//isset($_SESSION)
				return session_start();
				}else{
					
					}
			
			}
	}
	

	#include and require
	function xreq($val){
		if(empty($val)){
			x_print("File name cannot be empty!");
		exit();
			}else{
				return require_once($val);
			}
	
		}
		
		function xinc($val){
		if(empty($val)){
			x_print("File name cannot be empty!");
		exit();
			}else{
				return include_once($val);
			}
	
		}
		
		function xtitle($val){
			if(empty($val)){
			x_print("Page Title not specified!");
			exit();
			}else{
				x_print("<title>$val</title>");
			}
			}
			
function x_trunc($str,$start,$stop){
$len = strlen($str);
if(!is_numeric($start) || !is_numeric($stop)){
return "Error:inproper usage of x_trunc(str,start,stop)";
}else{

if($len > $start){
return substr($str,$start,$stop)."...";
}elseif($len < $start){
return substr($str,$start,$stop);
}else{
return $start;
}
}
}

function x_vert($str,$wrap){
	if($wrap == ""){
		return ucwords(strtolower($str));
	}else{
return "<$wrap>".ucwords(strtolower($str))."</$wrap>";		
		}
}
function xlow($str,$wrap){
		if($wrap == ""){
		return strtolower($str);
	}else{
return "<$wrap>".strtolower($str)."</$wrap>";		
		}
	
}
function xup($str,$wrap){
	if($wrap == ""){
		return strtoupper($str);
	}else{
return "<$wrap>".strtoupper($str)."</$wrap>";		
		}
}

//curl functions usage
/**
		$params = array(
			   "api_key" => $api,
			   "recipient" => $result,
			   "message" => $msg,
				"sender" => $sender,
				 "route" => $route
				);
**/
function xget($url)
{
    $ch = curl_init();  
 
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $output=curl_exec($ch);
 
    curl_close($ch);
    return $output;
}

function xpost($url,$params)
{
  $postData = '';
   //create name value pairs seperated by &
   foreach($params as $k => $v) 
   { 
      $postData .= $k . '='.$v.'&'; 
   }
   $postData = rtrim($postData, '&');
 
    $ch = curl_init();  
 
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_HEADER, false); 
    curl_setopt($ch, CURLOPT_POST, count($params));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    
 
    $output=curl_exec($ch);
 
    curl_close($ch);
    return $output;
 
}

//curl in json response
function x_google($url,$params)
{
	
  $postData = '';
   //create name value pairs seperated by &
   foreach($params as $k => $v) 
   { 
      $postData .= $k . '='.$v.'&'; 
      
   }
   $postData = rtrim($postData, '&');
 
    $ch = curl_init();  
 
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_HEADER, false); 
    curl_setopt($ch, CURLOPT_POST, count($params));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    
 
    $output=curl_exec($ch);
 
    curl_close($ch);
    
    return json_decode($output,true);
 
}

function x_datediff($date1,$date2){
	if(($date1 == "") || ($date2 == "")){
	
		x_print("Empty date variable");
		
		}else{
			
			$data1 = new DateTime($date1);
			$data2 = new DateTime($date2);
			
			$diff = $data1->diff($data2);
			return $diff->y.'years ,'.$diff->m.'months ,'.$diff->d.'days ,';
			
			}
	
	}
	
function x_multiple_upload($file_name,$folder_name,$success,$failed){
if(isset($file_name) && !empty($file_name) && isset($folder_name) && !empty($folder_name)  && isset($success) && !empty($success) && isset($failed) && !empty($failed)){
	
	if(isset($_FILES[$file_name])){
    $name_array = $_FILES[$file_name]['name'];
    $tmp_name_array = $_FILES[$file_name]['tmp_name'];
    $type_array = $_FILES[$file_name]['type'];
    $size_array = $_FILES[$file_name]['size'];
    $error_array = $_FILES[$file_name]['error'];
    for($i = 0; $i < count($tmp_name_array); $i++){
		$ipbase = ($i+13) + rand(452,9000000);
		$hash = sha1($ipbase)."_".sha1(crypt($ipbase));
  if(move_uploaded_file($tmp_name_array[$i], $folder_name.$hash.$name_array[$i])){
				  
				  if($success == "y"){
					  
				  x_print("<b>".$name_array[$i]."</b>"." upload is complete<br>");
				  
				  }else{
				  
				  }
            
        } else {
			 if($failed == "y"){
				x_print("Upload failed for ".$name_array[$i]."<br>");
					}else{
				  
				  }
			
        }
    }
}else{
	x_print("Major Parameter Missing!");
}
	
}else{
	x_print("Upload Parameter Missing!");
}


}

// Replace string data

function x_wordfilter($data,$originals,$replacements){
	
	if(empty($originals) || empty($replacements)){
		x_print("Array parameters is empty");
	}elseif(!is_array($originals) || !is_array($replacements)){
		x_print("Parameters must be an array");
	}else{
    $data = str_ireplace($originals,$replacements,$data);
    return $data;
	}
 
}

function x_input($input) {

  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
  );

    $output = preg_replace($search, '', $input);
    return $output;
  }

  // most effective way to sanitize values
  
function x_sanitize($input){
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = sanitize($val);
        }
    }
    else {
        /****if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }***/
        $input  = x_input($input);
        $output = x_cape($input);
    }
    return $output;
}

//Calculate distance between two points
function x_distance($latitude1, $longitude1, $latitude2, $longitude2) {
    $theta = $longitude1 - $longitude2;
    $miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
    $miles = acos($miles);
    $miles = rad2deg($miles);
    $miles = $miles * 60 * 1.1515;
    $feet = $miles * 5280;
    $yards = $feet / 3;
    $kilometers = $miles * 1.609344;
    $meters = $kilometers * 1000;
    return compact('miles','feet','yards','kilometers','meters'); 
}

//scramble words can repeat itself when included more than once
function x_scramble($word)
{
    if (strlen($word) < 4) {
        return $word;
    }
    //END IF
    $punctuation = array(',', '.', '!', '?', ')', '(', ':', ';');
    $start_punc = '';
    $end_punc = '';
    $first_letter = substr($word, 0, 1);
    $last_letter = substr($word, -1);
    if (in_array($first_letter, $punctuation)) {
        $start_punc = $first_letter;
        $word = substr($word, 1);
        $first_letter = substr($word, 0, 1);
    }
    //END IF
    if (in_array($last_letter, $punctuation)) {
        $end_punc = $last_letter;
        $word = substr($word, 0, strlen($word) - 1);
        $last_letter = substr($word, -1);
    }
    //END IF
    $array = str_split(substr($word, 1, strlen($word) - 2));
    shuffle($array);
    return $start_punc . $first_letter . implode('', $array) . $last_letter . $end_punc;
}

//reshuffle letters
function x_shuffle($word) {
    $wordArray = str_split($word);
    shuffle($wordArray);
    return implode('',$wordArray);
}

function x_qrcode($content,$path,$path_validation){
	$count_args = func_get_args();
	
	if(count($count_args) != 3){
		x_print("incomplete arguments! 3 args required.");
		//print_r($count_args);
		exit;
	}
	
	if(isset($content) && isset($path) && isset($path_validation) && ($content != "") && ($path != "") && ($path_validation != "")){
		
			if($path_validation == "0"){
				return QRcode::png($content, $path, "H", 4, 2);
			}elseif($path_validation == "1"){
				
				if(file_exists($path)){
					x_print("Qrcode path already exist");
				}else{
					return QRcode::png($content, $path, "H", 4, 2);
				}
				
			}else{
				x_print("invalid validation option");
			}
		
	}else{
		x_print("qrcode parameter missing!");
	}
	
}

// Getting mac address of a linux os
function x_maclinux() {
  exec('netstat -ie', $result);
   if(is_array($result)) {
    $iface = array();
    foreach($result as $key => $line) {
      if($key > 0) {
        $tmp = str_replace(" ", "", substr($line, 0, 10));
        if($tmp <> "") {
          $macpos = strpos($line, "HWaddr");
          if($macpos !== false) {
            $iface[] = array('iface' => $tmp, 'mac' => strtolower(substr($line, $macpos+7, 17)));
          }
        }
      }
    }
    return $iface[0]['mac'];
  } else {
    return "notfound";
  }
}

// Getting mac address of a linux @ client
function x_maclinuxclient(){
	$mac = shell_exec("arp -a ".escapeshellarg($_SERVER['REMOTE_ADDR'])." | grep -o -E '(:xdigit:{1,2}:){5}:xdigit:{1,2}'");
	return $mac;
}

// Getting mac address of a window os
function x_macwin(){
	   ob_start();  
       //Get the ipconfig details using system commond  
       system('ipconfig /all');  
       // Capture the output into a variable  
       $mycomsys=ob_get_contents();  
       // Clean (erase) the output buffer  
       ob_clean();  
       $find_mac = "Physical"; //find the "Physical" & Find the position of Physical text  
       $pmac = strpos($mycomsys, $find_mac);  
       // Get Physical Address  
       $macaddress=substr($mycomsys,($pmac+36),17);  
       //Display Mac Address  
       return $macaddress;  	
}


// Function to validate Nigeria number

function x_checkmobile($mobile){
$mobile = trim($mobile); 
$mobile_part = substr($mobile,0,3);
$arr_mobile_format = array("081","080","090","070");
if($mobile == ""){
	$msg = "Empty phone number passed";
	return $msg;
}else{
	if(is_numeric($mobile)){
	if(strlen($mobile) != 11){
		$msg = "Invalid mobile number length";
		return $msg;
	}else{	
		if(in_array($mobile_part,$arr_mobile_format)){
			$msg = $mobile;
			return $msg;
		}else{
			$msg = "invalid mobile number format";
			return $msg;
		}
	}
}else{
	$msg = "Invalid mobile number";
	return $msg;
}}}

function x_backdate($timestamp,$daytobackdate,$front_back){
	if((isset($timestamp) && !empty($timestamp)) && (isset($daytobackdate) && !empty($daytobackdate)) && (isset($front_back) && $front_back !="")){
		
		$date = $timestamp;
		
		$arr = array(0,1);
		
		if(in_array($front_back,$arr)){
			if($front_back == 0){
				$new_date = date("Y-m-d", strtotime($date."- $daytobackdate days"));
			}else{
				$new_date = date("Y-m-d", strtotime($date." $daytobackdate days"));
			}
		}else{
			$new_date = date("Y-m-d");
		}
	
	//return "$daytobackdate days back = ".$new_date;
	return $new_date;
	
	}else{
		$msg = "Parameter missing: usage x_backdate(timestamp,daytobackdate,front_back)";
		return $msg;
		
	}
}


function x_justvalidate($value){
	$value = @trim($value);
	if($value == ""){
		return "Invalid variable parameter!";
		exit();
	}else{
		return isset($value) && !empty($value);
	}
}

function x_validatepost($value){
	$value = @trim($value);
	if($value == ""){
		return "Invalid post parameter!";
		exit();
	}else{
		return isset($_POST[$value]) && !empty($_POST[$value]);
	}
}

function x_validateget($value){
	$value = @trim($value);
	if($value == ""){
		return "Invalid post parameter!";
		exit();
	}else{
		return isset($_GET[$value]) && !empty($_GET[$value]);
	}
}

function x_validatesession($value){
	$value = @trim($value);
	if($value == ""){
		return "Invalid session parameter!";
		exit();
	}else{
		return isset($_SESSION[$value]) && !empty($_SESSION[$value]);
	}
}

function x_session($value){
	$value = @trim($value);
	if($value == ""){
		return "Invalid session!";
		exit();
	}else{
		return $_SESSION[$value];
	}
}

// newly added on 02/01/2021 started

function x_validatemethod($value){
	$method = array("GET","POST","PUT","HEAD");
	$value = @trim($value);
	if(($value != "") && in_array($value,$method)){
		if($_SERVER["REQUEST_METHOD"] == $value){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
}

// newly added on 02/01/2021 ended


function x_extract_media_urls($string,$switch) {
	/*** Acronyms 
	y = youtube v = vimeo s = soundcloud yv = youtube and vimeo
	yvs = youtube,vimeo and souncloud all = get all links 
	eyvs = Exclude youtube,vimeo and soundcloud
	****/
	$checker = array("y","v","s","yv","yvs","eyvs","all");
	if(!in_array($switch,$checker)){
		return "Invalid switcher";
	}else{
	 $reg4allurl = "/https?\:\/\/[^\" \n]+/i";
	 //$reg4allurl = "%^(?:(?:https?|ftp)://)(?:\S+(?::\S*)?@|\d{1,3}(?:\.\d{1,3}){3}|(?:(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)(?:\.(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)*(?:\.[a-z\x{00a1}-\x{ffff}]{2,6}))(?::\d+)?(?:[^\s]*)?$%iu";
	 $regex_youtube = "/^(https|http):\/\/(?:www\.)?(?:youtube.com|youtu.be)\/(?:watch\?(?=.*v=([\w\-]+))(?:\S+)?|([\w\-]+))$/";
	 $regex_vimeo = "/^(https|http):\/\/(?:www\.)?(?:vimeo.com)\/([0-9a-zA-Z]+)$/";
	 
	 
	 
	 $soundcloud_regex = "/^https?:\/\/(?:w\.|www\.|)?(m\.)?(soundcloud\.com|snd\.sc)\/(.*)$/";
	 
		if(preg_match_all($reg4allurl, $string, $matches)){
		foreach ($matches[0] as $url) {
		$s1 = substr($url, 0, strlen($url));
		if($switch == "y"){
			if(preg_match($regex_youtube, $s1, $matches)){
				$s2[] = $s1;
			}else{
				//$s2[] = "";
			}
		}elseif($switch == "yv"){
			if(preg_match($regex_vimeo, $s1, $matches) || preg_match($regex_youtube, $s1, $matches)){
				$s2[] = $s1;
			}else{
				//$s2[] = "";
			}
		}elseif($switch == "v"){
			if(preg_match($regex_vimeo, $s1, $matches)){
				$s2[] = $s1;
			}else{
				//$s2[] = "";
			}
		}elseif($switch == "s"){
			if(preg_match($soundcloud_regex, $s1, $matches)){
				$s2[] = $s1;
			}else{
				//$s2[] = "";
			}
		}elseif($switch == "yvs"){
			if(preg_match($soundcloud_regex, $s1, $matches) || preg_match($regex_vimeo, $s1, $matches) || preg_match($regex_youtube, $s1, $matches)){
				$s2[] = $s1;
			}else{
				//$s2[] = "";
			}
		}elseif($switch == "all"){
		
				$s2[] = $s1;
			
		}elseif($switch == "eyvs"){
			if(preg_match($soundcloud_regex, $s1, $matches) || preg_match($regex_vimeo, $s1, $matches) || preg_match($regex_youtube, $s1, $matches)){
				
			}else{
				$s2[] = $s1;
			}
		}else{
			//$s2[] = "Invalid cmd";
		}
			
	
		}
		if(isset($s2)){
			return join(" ",$s2);
		}
		
}else{
	//return "Invalid urls";
	return "";
}
		
	}
}


function x_getvimeoid($video){
return preg_replace("/[^\/]+[^0-9]|(\/)/", "", rtrim($video, "/")); 
}
function x_getyoutubeid($url) {
    $parts = parse_url($url);
    if(isset($parts['query'])){
        parse_str($parts['query'], $qs);
        if(isset($qs['v'])){
            return $qs['v'];
        }else if(isset($qs['vi'])){
            return $qs['vi'];
        }
    }
    if(isset($parts['path'])){
        $path = explode('/', trim($parts['path'], '/'));
        return $path[count($path)-1];
    }
    return false;
}

// Handling Database custom queries

function x_querycmd($sql_queries){
	if(x_justvalidate($sql_queries)){
		$cmd = $sql_queries;
	}
	if(x_justvalidate($cmd)){
		return x_connect($cmd);
	}
	
}

function x_querycount($sqlcmd){
	
	$sele ="SELECT COUNT(*) as obey FROM $sqlcmd ";

	if(!$read = x_connect($sele)){
	$msg = "Failed to query db";
	return $msg;
	
	}else{
	$assoc = mysqli_fetch_assoc($read);
	$num = $assoc["obey"];
	return $num;
	}
}

function x_fetchQuery($sql_queries){
	
	if(x_justvalidate($sql_queries)){
		$sele = $sql_queries;
	}
	if(x_justvalidate($sele)){
		if(!$read = x_querycmd($sql_queries)){
			$msg = "Failed to select data!";
			x_print($msg);
			}else{
			while($assoc = mysqli_fetch_array($read)){
				
				$acc[] = $assoc;
			}
			return $acc;
			}
	}
	
	
}

function x_convert_figure($value){
	if(is_numeric($value)){
		$size = $value;
		$calc_kb = $size/(1000); // convert to kb
		$calc_mb = $size/(1000*1000); // convert to mb
		$calc_gb = $size/(1000*1000*1000); // convert to gb
		$calc_tr = $size/(1024*1024*1024*1024); // convert to tera
		
		if(($calc_kb >= 1) && ($calc_kb < 1000)){
			if($calc_kb >= 10){
				return number_format($calc_kb,1)." K";
			}else{
				return number_format($size,0);
			}
			
		}elseif(($calc_mb >= 1) && ($calc_mb < 1000)){
			return number_format($calc_mb,1)." M";
		}elseif(($calc_gb >= 1) && ($calc_gb < 1000)){
			return number_format($calc_gb,1)." B";
		}else{
			return number_format($size,0);
		}
	}else{
		return "NaN";
	}
	
}

// UPDATE AS AT JULY 7 , 2022

function x_curlPost($url, $data=NULL, $headers = NULL) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    if(!empty($data)){
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }

    if (!empty($headers)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }

    $response = curl_exec($ch);

    if (curl_error($ch)) {
        trigger_error('Curl Error:' . curl_error($ch));
    }

    curl_close($ch);
    return $response;
}

/***
curlPost('google.com', [
    'username' => 'admin',
    'password' => '12345',
]);***/

// personal telegram bot details
	//$id = 1087418627;
	//$token = "5581262856:AAH-g_y7R01kfXjokBmCxZ0wkhmlBoy4WpE";
	//$alert_status = 1;
function x_send_telegram($id , $token ,$mess ,$alert_status){
    if(x_justvalidate($id) && x_justvalidate($token)){		
       	$msg = urlencode($mess);
		$url = "https://api.telegram.org/bot$token/sendmessage?chat_id=$id&text=".$msg;
		$result = x_curlPost($url, $data=NULL, $headers = NULL);
		$decode = json_decode($result,true);
		$finalize = $decode["ok"];
		$opt = array(0,1);
		
		if($finalize == "true"){
			if(in_array($alert_status,$opt)){
				if($alert_status == "1"){
					return "Telegram message sent!";
				}
				return true;
			}else{
				return "Invalid option";
			}
		}
		
	}
}

// send data as json

function x_send_json($postData, $url, $token) {
        // for sending data as json type
        $fields = json_encode($postData);

        $ch = curl_init($url);
        curl_setopt(
            $ch, 
            CURLOPT_HTTPHEADER, 
            array(
                'Content-Type: application/json', // if the content type is json
                'bearer: '.$token // if you need token in header
            )
        );
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
	
	// Getting ip address fulldetails
	
	function x_getipdetails($ip_address){
		$url = "https://api.iplocation.net/?ip=".$ip_address;
		if(x_justvalidate($ip_address)){
			$result = x_curlPost($url, $data=NULL, $headers = NULL);
			$decode = json_decode($result,true);
			//var_dump($result);
			if($decode["response_message"] == "OK"){
				return $decode["ip"]."-".$decode["country_name"]."-".$decode["isp"]."-".$decode["country_code2"];
			}else{
				return "no data";
			}
			
		}
	}

// Paystack payment functions
include("payment_functions.php");
// Include other library
include("domingos_sp_functions.php");
// Include the iuosite functions
include("iuofunction.php");
include("mobilefunction.php");

?>
