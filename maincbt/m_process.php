<?php
if(isset($_POST['token']) && !empty($_POST['token']) && isset($_POST['qtoken']) && !empty($_POST['qtoken'])){
	
	include_once("finishit.php");
//session_start();
xstart("0");
if(!isset($_SESSION['SESS_D_USER_EXAM'])){

header("location:logout.php");

exit;
}
require_once("config.php");
$pager= $_POST["cnum"];

$loc = $_GET["loc"];

$db_acct = "SELECT portal_status FROM portal WHERE id='1' LIMIT 1";
$qu_acct = mysqli_query($con,$db_acct);
$num_acct = mysqli_num_rows($qu_acct);
$fet_acct = mysqli_fetch_array($qu_acct);

$p_acct = $fet_acct['portal_status'];
if($p_acct == "closed"){
$msg="Examination portal closed!";
finish("$loc","$msg");
exit;
}



$db = "SELECT status FROM cross_platform_mode WHERE id='1' LIMIT 1";
$qu = mysqli_query($con,$db);
$num = mysqli_num_rows($qu);
$fet = mysqli_fetch_array($qu);
if($num != 0){
$p = $fet['status'];
if($p == "enable"){
	

if(isset($_SESSION['EXAM_RESULT_STOPPED'])){
$msg="You cannot continue this exam because your result is already published!!";
finish("$loc","$msg");
exit;

}

}

}

$user_acct = $_SESSION['SESS_D_USER_EXAM'];
$email_acct = $_SESSION['SESS_D_EMAIL_EXAM'];
//$db_acct = "SELECT access FROM register WHERE username='$user_acct' AND email='$email_acct' LIMIT 1";
$db_acct = "SELECT access FROM register WHERE username='$user_acct' LIMIT 1";
$qu_acct = mysqli_query($con,$db_acct);
$num_acct = mysqli_num_rows($qu_acct);
$fet_acct = mysqli_fetch_array($qu_acct);

$p_acct = $fet_acct['access'];
if($p_acct == "revoked"){
$msg="Please you cannot continue this exam";
$pager= $_POST["cnum"];

finish("$loc","$msg");

}
else{



$owner = $_SESSION['SESS_D_USER_EXAM'];
$full = $_SESSION['SESS_D_NAME_EXAM'];
$email = $_SESSION['SESS_D_EMAIL_EXAM'];


$ip = xip();
$os =   xos();
$browser  =  xbr();

$token = xp("token");
$qtoken = xp("qtoken");
$id = xp("id");
$etype = xp("type");
$cat = xp("cat");
$pager= xp("cnum");

foreach($_POST['ans'] as $units){
$post[] = $units;


if($units == null){
	finish("$loc","0");
	exit();
	
	}


}

$arr = x_clean(strtolower(implode($post ,"-")));




$tab = "
CREATE TABLE IF NOT EXISTS exams_scores(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
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
token TEXT NOT NULL 
)

";
$que = mysqli_query($con,$tab);
if(!$que){
$msg="Failed to Create table in the database! Pls try again";
finish("$loc","$msg");
exit;
}


$select = "SELECT id FROM exams_scores WHERE attempted_num='$id' AND ques_token='$qtoken' AND script_owner='$owner' LIMIT 1";
$query = mysqli_query($con,$select);

if(!$query){
$msg = "Failed to select!";
header("location:exams?pn=$pager&msg=$msg");
exit;
}
$count = mysqli_num_rows($query);



$selector = "SELECT answer FROM questions WHERE approval_status='approved' AND id='$id' LIMIT 1";
$queryer = mysqli_query($con,$selector);
if(!$queryer){
$msg = "Failed to select!";
finish("$loc","$msg");
exit;
}
else{

$row = mysqli_fetch_array($queryer);
$correct_ans = clean(strtolower($row["answer"]));
$m_ans = explode(",",clean(strtolower($row["answer"])));

if($count == 1){

$db_acct = "SELECT * FROM option_update WHERE id='1' LIMIT 1";
$qu_acct = mysqli_query($con,$db_acct);
$num_acct = mysqli_num_rows($qu_acct);
$fet_acct = mysqli_fetch_array($qu_acct);

$p_acct = $fet_acct['status'];
if($p_acct == "Disallow"){
$msg="Please you cannot update your answer";
finish("$loc","$msg");
exit;
}


if(in_array($arr ,$m_ans)){
$update = "UPDATE exams_scores SET final_comment='correct' ,score_point='1' , answer='$arr'  WHERE attempted_num='$id' AND ques_token='$qtoken' AND script_owner='$owner' LIMIT 1";
$q = mysqli_query($con,$update);

if(!$q){
$msg = "Failed to insert correct data!";
finish("$loc","$msg");
}
else{

finish("$loc","0");

}

}
elseif(!in_array($arr ,$m_ans)){
$update = "UPDATE exams_scores SET final_comment='wrong' ,score_point='0' , answer='$arr'  WHERE attempted_num='$id' AND ques_token='$qtoken' AND script_owner='$owner' LIMIT 1";
$q = mysqli_query($con,$update);

if(!$q){
$msg = "Failed to insert correct data!";
finish("$loc","$msg");
}
else{

finish("$loc","0");

}
}
else{
$msg = "No answer!";
finish("$loc","$msg");
}

}

else{
if(in_array($arr ,$m_ans)){
$insert = "INSERT INTO exams_scores(fullname , script_owner , owner_email , exam_type , subject , answer , correct_ans , attempted_num , ques_token , final_comment ,score_point , score_approval , ip_address , OS , browser , date_time , token) VALUES('$full' ,'$owner' , '$email' ,'$etype' ,'$cat' , '$arr' , '$correct_ans' , '$id' ,'$qtoken' , 'correct' , '1' ,'pending' ,'$ip' ,'$os' ,'$browser' ,now() ,'$token')";
$q = mysqli_query($con,$insert);
if(!$q){
$msg = "Failed to insert correct data!";
finish("$loc","$msg");
}
else{
finish("$loc","0");

}

}
elseif(!in_array($arr ,$m_ans)){
$insert = "INSERT INTO exams_scores(fullname , script_owner , owner_email , exam_type , subject , answer , correct_ans , attempted_num , ques_token , final_comment ,score_point , score_approval , ip_address , OS , browser , date_time , token) VALUES('$full' ,'$owner' , '$email' ,'$etype' ,'$cat' , '$arr' , '$correct_ans' , '$id' ,'$qtoken' , 'wrong' , '0' ,'pending' ,'$ip' ,'$os' ,'$browser' ,now() ,'$token')";
$q = mysqli_query($con,$insert);
if(!$q){
$msg = "Failed to insert correct data!";
finish("$loc","$msg");
}
else{
finish("$loc","0");

}
}
else{
$msg = "No answer!";
finish("$loc","$msg");
}

}

}



}

}
else{
$msg = "Parameter Missing!";
finish("$loc","$msg");
}
?>
