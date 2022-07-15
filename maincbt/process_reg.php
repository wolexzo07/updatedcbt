<?php
if(isset($_POST['mat']) && !empty($_POST['mat']) && isset($_POST['pass']) && !empty($_POST['pass'])){
require_once("config.php");

function getRealIpAddress()
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
return $ipadd;
}

$user_agent     =   $_SERVER['HTTP_USER_AGENT'];

function getOS() { 

    global $user_agent;

    $os_platform    =   "Unknown OS Platform";

    $os_array       =   array(
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

function getBrowser() {

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
$db = "SELECT portal_status FROM reg_portal WHERE id='1' LIMIT 1";
$qu = mysqli_query($con,$db);
$num = mysqli_num_rows($qu);
$fet = mysqli_fetch_array($qu);

$p = $fet['portal_status'];
if($p == "closed"){
$msg="<script type='text/javascript'>alert('Examination Registration Portal is closed!')</script>";
header("location:register.php?msg=$msg");
exit;
}



if (!is_uploaded_file($_FILES['upload']['tmp_name'])){
$msg="<script type='text/javascript'>alert('No file to Upload!')</script>";
header("location:register.php?msg=$msg");
exit();
}
if ($_FILES['upload']['size'] > 200000){

$msg="<script type='text/javascript'>alert('File Upload Exceed 200kb!')</script>";
header("location:register.php?msg=$msg");
exit();

}
	
	
if ($_FILES['upload']['type'] == 'image/jpeg' || $_FILES['upload']['type'] == 'image/png' || $_FILES['upload']['type'] == 'image/gif' || $_FILES['upload']['type'] == 'image/pjpeg')
{

$uploadfile = clean($_FILES['upload']['tmp_name']);
$uploadname = clean($_FILES['upload']['name']);
$uploadsize = clean($_FILES['upload']['size']);
$uploadtype = clean($_FILES['upload']['type']);
$uploaddata = clean(file_get_contents($uploadfile)); 

$mobile = clean($_POST['mobile']);
$email = clean($_POST['email']) ;
$name = clean($_POST['name']);
$mat = clean($_POST['mat']) ;
$salt = "wolexzo07dacrackertheBlAcKerhathacker199019921962";
$pass = clean(md5(sha1($_POST['pass'].$salt)));

$ip = getRealIpAddress();
$os =   getOS();
$browser  =   getBrowser();
$token = sha1(md5(rand(0 ,2897893902991748763)));

$level = "" ;
if(isset($_POST['level'])){
foreach($_POST['level'] as $key){
$level =  $key ;
}
}

$hob = "" ;
if(isset($_POST['hob'])){
foreach($_POST['hob'] as $key){
$hob =  $key ;

}
}

$gen = clean($_POST['gen']);
$dob = clean($_POST['date']);
$abt = clean($_POST['abt']);

$dept = "" ;
if(isset($_POST['dept'])){
foreach($_POST['dept'] as $key){
$dept =  $key ;
}}

$title = "" ;
if(isset($_POST['title'])){
foreach($_POST['title'] as $keyy){
$title =  $keyy ;
}
}

$dat = Date("F jS , Y , H:i") ;

if($_POST['pass'] != $_POST['pass1']){
$msg="<script type='text/javascript'>alert('Password Does not match!')</script>";
header("location:register.php?msg=$msg");
exit;

}

$tab = "
CREATE TABLE IF NOT EXISTS register(
id INT AUTO_INCREMENT NOT NULL PRIMARY KEY ,
mobile TEXT NOT NULL ,
email TEXT NOT NULL,
title TEXT NOT NULL ,
photo LONGBLOB DEFAULT NULL,
picsize varchar(100) DEFAULT NULL,
picname varchar(100) DEFAULT NULL,
pictype varchar(100) DEFAULT NULL,
Name TEXT NOT NULL ,
username TEXT NOT NULL ,
Password TEXT NOT NULL ,
Level TEXT NOT NULL ,
Gender TEXT NOT NULL ,
Department TEXT NOT NULL ,
dob TEXT NOT NULL,
about TEXT NOT NULL,
hobby TEXT NOT NULL,
Time_Stamp TEXT NOT NULL,
access TEXT NOT NULL,

ip_address TEXT NOT NULL,
OS TEXT NOT NULL ,
browser TEXT NOT NULL ,
token TEXT NOT NULL 

)


";

$insert = "INSERT INTO register(mobile, email,title,photo, picsize, picname, pictype,Name , username ,Password , Level  , Gender , Department ,dob ,about ,hobby , Time_Stamp,access, ip_address , OS , browser , token ) VALUES('$mobile','$email','$title','$uploaddata', '$uploadsize', '$uploadname', '$uploadtype','$name' ,'$mat','$pass' ,'$level' ,'$gen' ,'$dept' ,'$dob' ,'$abt' ,'$hob',now(),'granted','$ip' ,'$os' ,'$browser'  ,'$token')";
$select = "SELECT username FROM register WHERE username = '$mat' LIMIT 1";
$em = "SELECT email FROM register WHERE email = '$email' LIMIT 1";
$mob = "SELECT mobile FROM register WHERE mobile = '$mobile' LIMIT 1";
$moob = mysqli_query($con,$mob);
$mob_num = mysqli_num_rows($moob);
$lm = mysqli_query($con,$em);
$e_num = mysqli_num_rows($lm);
$query = mysqli_query($con,$tab);
$let = mysqli_query($con,$select);
$num = mysqli_num_rows($let);
if(!$query){
$msg="<script type='text/javascript'>alert('Unable to dump table')</script>";
header("location:register.php?msg=$msg");
exit;
}

if($e_num == 1){
$msg="<script type='text/javascript'>alert('Email already Exist')</script>";
header("location:register.php?msg=$msg");
exit;
}

if($mob_num == 1){
$msg="<script type='text/javascript'>alert('Mobile Phone Number already Exist')</script>";
header("location:register.php?msg=$msg");
exit;
}


if($num != 1){
$result = mysqli_query($con,$insert);
if(!$result){

$msg="<script type='text/javascript'>alert('Unable to insert data into database')</script>";
header("location:register.php?msg=$msg");
exit;
}
else{
$msg="<script type='text/javascript'>alert('Registration was Successful')</script>";
header("location:register.php?msg=$msg");
exit;
}

}
else{
$msg="<script type='text/javascript'>alert('Username already exist in our database')</script>";
header("location:register.php?msg=$msg");
exit;

}

}
else{

$msg="<script type='text/javascript'>alert('invalid image format')</script>";
header("location:register.php?msg=$msg");
exit;


}
}

else{

$msg="<script type='text/javascript'>alert('Parameter missing!!')</script>";
header("location:register.php?msg=$msg");
exit;

}
?>