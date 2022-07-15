<?php
session_start();
include("config.php");
$user = $_SESSION['SESS_D_USER_EXAM'];
#modification started here
$sele = "SELECT COUNT(*) AS reh FROM exams_scores WHERE script_owner='$user'";
if(!$qu = mysqli_query($con,$sele)){
echo "Failed to query database!";	
}
$ru = mysqli_fetch_assoc($qu);
$cnum = $ru["reh"];
#modification ended here

$sele = "SELECT * FROM exams_scores WHERE script_owner='$user' LIMIT $cnum";
$u = mysqli_query($con,$sele);
$nuim = mysqli_num_rows($u);
if($nuim == 0){
echo "No data found";
}
{
while($fer=mysqli_fetch_array($u)){
$attemp[] = $fer["attempted_num"];
}
}
