<?php
require_once('config.php');
$db = "SELECT status FROM cross_platform_mode WHERE id='1' LIMIT 1";
$qu = mysqli_query($con,$db);
$num = mysqli_num_rows($qu);
$fet = mysqli_fetch_array($qu);
if($num != 0){
$p = $fet['status'];
if($p == "disable"){


$update_all = "UPDATE register SET access='revoked' WHERE username='$owner' LIMIT 1";
if(!mysqli_query($con,$update_all)){
$msg = "Failed to update account access!!";
echo $msg;
exit;
}
}

else{



}
}


?>

