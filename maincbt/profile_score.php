<?php
require_once("finishit.php");
if(!isset($_SESSION['SESS_D_USER_EXAM'])){
echo "No result";
exit();
}
$user_p = x_clean($_SESSION['SESS_D_USER_EXAM']);

$sub_p = "SELECT DISTINCT subject AS categories FROM exams_scores WHERE Score_approval = 'approved' AND script_owner='$user_p' ORDER BY id desc LIMIT 20";
$query_p = mysqli_query($con,$sub_p);
$num_p = mysqli_num_rows($query_p);
if($num_p != 0){
echo "<table cellpadding='10px' width='100%' cellspacing='0px' border='1px' style='font-size:11pt;'>";
echo "<tr style='background-color:purple;color:white'><th align='left'>SUBJECTS </th><th align='left'>SCORES </th></tr>";
while($subject = mysqli_fetch_array($query_p)){

$cat_p = xup($subject['categories'],"");
/**
$err = "SELECT * FROM questions WHERE approval_status='approved' AND categories='$cat_p'";
$eee = mysqli_query($con,$err);
if(!$eee){
	echo "Failed to select the questions approved";
	exit;
	}**/

	//$rut_numb = mysqli_num_rows($eee);
$rut_numb = x_count("questions","approval_status='approved' AND categories='$cat_p'");

require("subject_sc.php");

if($scor_p ==  ""){
echo "<tr><td>$cat_p</td><td><b>0&nbsp; out of &nbsp;$rut_numb</b></td></tr>";
}
else{
echo "<tr style='background-color:white;color:purple'><td>$cat_p</td><td><b>$scor_p &nbsp;out of &nbsp;$rut_numb</b></td></tr>";
}

}
echo "<tr style='background-color:purple;color:white'><td><b>AGGREGATE</b></td><td><b>$total_p</b></td></tr>";
echo "</table>";

} 
else{
echo "No subject found in the database";

}

?>
