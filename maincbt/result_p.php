<?php
include("auth.php");
?>


<?php
/**
if(!isset($_GET["key"])){
	
	finish("exams","Parameter Modified");
	
}**/
error_reporting(0);
require_once('config.php');

$selet = "SELECT * FROM result_button WHERE status='disable' LIMIT 1";
$tu = mysqli_query($con,$selet);
if(!$tu){
$msg = "failed to fetch from db";
echo $msg;
	
	}else{
		$num = mysqli_num_rows($tu);
		
		if($num == 1){
       require("no_res.php");
			exit;
			}
		
		
		}


$db = "SELECT instant_status FROM instant_pub WHERE id='1' LIMIT 1";
$qu = mysqli_query($con,$db);
$num = mysqli_num_rows($qu);
$fet = mysqli_fetch_array($qu);
if($num != 0){
$p = $fet['instant_status'];
if($p == "enabled"){

$owner = $_SESSION['SESS_D_USER_EXAM'];
$namm = $_SESSION['SESS_D_NAME_EXAM'];

require("exam_st.php");
require("cross_status.php");



$update_all = "UPDATE exams_scores SET Score_approval='approved' WHERE script_owner='$owner' AND Score_approval='pending' ";
if(!mysqli_query($con,$update_all)){
$msg = "Failed to update score approval!!";
echo $msg;
exit;
}




$sqlCommand = "SELECT * FROM exams_scores WHERE script_owner='$owner' AND final_comment='correct' AND Score_approval='approved'";
$sqlCmd = "SELECT * FROM exams_scores WHERE script_owner='$owner' AND final_comment='wrong' AND Score_approval='approved'";

$all = "SELECT * FROM exams_scores WHERE script_owner='$owner' AND Score_approval='approved'";
$all_query = mysqli_query($con,$all);
$all_count = mysqli_num_rows($all_query);

$pend = "SELECT * FROM exams_scores WHERE script_owner='$owner' AND Score_approval='pended'";
$pend_all_query = mysqli_query($con,$pend);
$pend_count = mysqli_num_rows($pend_all_query);
if($pend_count != 0){
$msg = "<p style='padding:10px'><b>Result Pended!!</b></p>"  ;
include("stat_p.php");
exit;
}

$cease = "SELECT * FROM exams_scores WHERE script_owner='$owner' AND Score_approval='ceased'";
$cease_all_query = mysqli_query($con,$cease);
$cease_count = mysqli_num_rows($cease_all_query);
if($cease_count != 0){
$msg = "<p style='padding:10px'><b>Result Ceased!!</b></p>"  ;
include("stat_c.php");
exit;
}

$quest = "SELECT * FROM questions WHERE approval_Status='approved'";
$quest_query = mysqli_query($con,$quest);
$qu_num = mysqli_num_rows($quest_query); 

$wr = mysqli_query($con,$sqlCmd);
$wr_count = mysqli_num_rows($wr);

$que = mysqli_query($con,$sqlCommand );
$num = mysqli_num_rows($que);
$row = mysqli_fetch_array($que);

$percent = ($num/$qu_num)*100;
$m_percent = round($percent ,2);

if($all_count != 0){

if($m_percent < 50){

$msg = "Failed! Try Again";
$status = "Not Admitted Yet";
include('res_ext.php');

}
elseif($m_percent >= 50 && $m_percent < 90)
{
$msg = "Passed! Congrat"  ;
$status = "Admitted";
include('res_ext.php');

}
elseif($m_percent > 90)
{
$msg = "Superb! Congrat"  ;
$status = "Admitted";
include('res_ext.php');

}
else{
$msg = "Missing script!	Please contact ICT Department"  ;
echo $msg;

}

}

else{
$msg = "<p style='padding:10px'>Please check back for your result</p>"  ;
include("stat.php");
}
}
elseif($p == "disabled"){
$owner = $_SESSION['SESS_D_USER_EXAM'];
$namm = $_SESSION['SESS_D_NAME_EXAM'];
$sqlCommand = "SELECT * FROM exams_scores WHERE script_owner='$owner' AND final_comment='correct' AND Score_approval='approved'";
$sqlCmd = "SELECT * FROM exams_scores WHERE script_owner='$owner' AND final_comment='wrong' AND Score_approval='approved'";
$all = "SELECT * FROM exams_scores WHERE script_owner='$owner' AND Score_approval='approved'";
$all_query = mysqli_query($con,$all);
$all_count = mysqli_num_rows($all_query);

$pend = "SELECT * FROM exams_scores WHERE script_owner='$owner' AND Score_approval='pended'";
$pend_all_query = mysqli_query($con,$pend);
$pend_count = mysqli_num_rows($pend_all_query);
if($pend_count != 0){
$msg = "<p style='padding:10px'><b>Result Pended!!</b></p>"  ;
include("stat_p.php");
exit;
}

$cease = "SELECT * FROM exams_scores WHERE script_owner='$owner' AND Score_approval='ceased'";
$cease_all_query = mysqli_query($con,$cease);
$cease_count = mysqli_num_rows($cease_all_query);
if($cease_count != 0){
$msg = "<p style='padding:10px'><b>Result Ceased!!</b></p>"  ;
include("stat_c.php");
exit;
}

$quest = "SELECT * FROM questions WHERE approval_Status='approved'";
$quest_query = mysqli_query($con,$quest);
$qu_num = mysqli_num_rows($quest_query); 

$wr = mysqli_query($con,$sqlCmd);
$wr_count = mysqli_num_rows($wr);

$que = mysqli_query($con,$sqlCommand );
$num = mysqli_num_rows($que);
$row = mysqli_fetch_array($que);

$percent = ($num/$qu_num)*100;
$m_percent = round($percent ,2);

if($all_count != 0){

if($m_percent < 50){

$msg = "Failed! Try Again";
$status = "Not Admitted Yet";
include('res_ext.php');

}
elseif($m_percent >= 50 && $m_percent < 90)
{
$msg = "Passed! Congrat"  ;
$status = "Admitted";
include('res_ext.php');

}
elseif($m_percent > 90)
{
$msg = "Superb! Congrat"  ;
$status = "Admitted";
include('res_ext.php');

}
else{
$msg = "Missing script!	Please contact ICT Department"  ;
echo $msg;

}

}

else{
$msg = "<p style='padding:10px'>Please check back for your result</p>"  ;
include("stat.php");

}


}
else{
$msg="<b></b>";
echo $msg;


}
}
else{
$msg="<b>No status</b>";
echo $msg;

}

?>
