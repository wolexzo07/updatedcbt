<?php
session_start();
include('config.php');

$login = $_SESSION['SESS_D_USER_EXAM'];
$fmc="SELECT status FROM multiple_choice WHERE user ='$login' LIMIT 1";
	$fms = mysqli_query($con,$fmc);
	$gy = mysqli_fetch_array($fms);
	$ch = $gy["status"];
	echo $ch;
	?>