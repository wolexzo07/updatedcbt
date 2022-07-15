<?php
include_once("finishit.php");
xstart("0");
xinc("main.php");
if(!isset($_SESSION['SESS_D_NAME_EXAM']) || !isset($_SESSION['SESS_D_USER_EXAM']) || !isset($_SESSION['SESS_D_MEMBER_ID_EXAM'])  || !isset($_SESSION['SESS_D_GENDER_EXAM']) ){
$msg="Login before access!!";
$token = sha1(md5("wolexzo07isabigboystudentthatisgoingtoovertakeeverywherethispresentyear2015"));
finish("login-page.php?msg=$msg&token_generated=$token","0");
exit();
}
xinc("time_logout.php");
?>
