<?php
require_once("config.php");
$owner = $_SESSION['SESS_D_USER_EXAM'];
$sqlCo = "SELECT answer FROM questions WHERE id='$id' LIMIT 1";
$quee = mysqli_query($con,$sqlCo);
$roww = mysqli_fetch_array($quee);
$sqlCommand = "SELECT answer FROM exams_scores WHERE script_owner='$owner' AND attempted_num='$id' LIMIT 1";
$que = mysqli_query($con,$sqlCommand);
$num = mysqli_num_rows($que);
$row = mysqli_fetch_array($que);
if($num != 1){

}
else{

if(strtolower($row["answer"]) == strtolower($roww["answer"])){
include("option_validator.php");
$updateCommand = "UPDATE exams_scores SET final_comment='correct' , score_point='1' WHERE script_owner='$owner' AND attempted_num='$id' LIMIT 1";
$updateQuery = mysqli_query($con,$updateCommand);
if(!$updateQuery){
$msg="<script type='text/javascript'>alert('Failed to Upload Scores')</script>";
echo $msg;
exit;
}
}
else{
include("option_validator_se.php");
$updateCommand = "UPDATE exams_scores SET final_comment='wrong' , score_point='0' WHERE script_owner='$owner' AND attempted_num='$id' LIMIT 1";
$updateQuery = mysqli_query($con,$updateCommand);
if(!$updateQuery){
$msg="<script type='text/javascript'>alert('Failed to Upload Scores')</script>";
echo $msg;
}
}
}?>
