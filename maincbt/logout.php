<?php
session_start();
include("finishit.php");
include("main.php");
if(isset($_SESSION['SESS_D_MEMBER_ID_EXAM']) && isset($_SESSION['SESS_D_USER_EXAM'])){

include("toggle_relogger.php");
}
else{
$tok = sha1(md5(uniqid()));
header("location:login-page?token=$tok");
}

?>
