<?php
include_once("finishit.php");
xstart("0");
if(!isset($_SESSION['SESS_D_USER_EXAM'])){

$msg="<b style='color:red'>Your time has expired</b>";
echo $msg;
exit;
}
if(isset($_GET["opt"]) && !empty($_GET["opt"])){
include_once("config.php");
$id = xg("id");$opt = xg("opt");$typic = xg("typing");$to = xg("tokken");
$subj = xg("subject");$eml = xg("emailer");
$owner = x_clean($_SESSION['SESS_D_USER_EXAM']);
$full = x_clean($_SESSION['SESS_D_NAME_EXAM']);
$ip = xip();$os = xos();$browser = xbr();$token = sha1(md5(rand(0 ,728935109182)));
$tab = x_dbtab("exams_scores","
fullname TEXT NOT NULL , 
script_owner TEXT NOT NULL ,
owner_email TEXT NOT NULL,
exam_type TEXT NOT NULL ,
subject TEXT NOT NULL ,
answer TEXT NOT NULL ,
correct_ans TEXT NOT NULL,
attempted_num TEXT NOT NULL , 
ques_token TEXT NOT NULL,
final_comment TEXT NOT NULL,
score_point INT NOT NULL ,
Score_approval TEXT NOT NULL,
ip_address TEXT NOT NULL ,
OS TEXT NOT NULL ,
browser TEXT NOT NULL ,
date_time DATETIME NOT NULL ,
token TEXT NOT NULL","MYISAM");

if(!$tab){
	echo "Failed to create scoring system!";
	exit();
}
include("stopit.php"); include('time_out.php');include('portal_auth.php');
include('acct_suspender.php');
$sqlCommand = "SELECT * FROM exams_scores WHERE script_owner='$owner' AND attempted_num='$id' LIMIT 1";
$que = mysqli_query($con,$sqlCommand );$num = mysqli_num_rows($que);
if($num != 1){
$sqlcommand = "INSERT INTO exams_scores(fullname , script_owner ,owner_email, exam_type , subject ,answer ,attempted_num ,ques_token, score_approval , ip_address , OS , browser , date_time , token ) VALUES( '$full' ,'$owner' ,'$eml' , '$typic' ,'$subj', '$opt' ,'$id' ,'$to' , 'pending' ,'$ip' ,'$os' ,'$browser' , now() ,'$token')";
$sqlexe = mysqli_query($con,$sqlcommand);
if($sqlexe){
include("valid.php");
}
else{
echo "failed to upload data ";
}
}
else{
include_once("option_update_validator.php");
}
}
?>
