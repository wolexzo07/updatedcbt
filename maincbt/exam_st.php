<?php
require_once('config.php');
$db = "SELECT * FROM cross_platform_mode WHERE id='1' LIMIT 1";
$qu = mysqli_query($con,$db);
$num = mysqli_num_rows($qu);
$fet = mysqli_fetch_array($qu);
if($num != 0){
$p = $fet['status'];
if($p == "enable"){
	
$_SESSION['EXAM_RESULT_STOPPED'] = 'ok';

}

}

?>

