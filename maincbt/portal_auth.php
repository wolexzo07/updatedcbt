<?php
require_once('config.php');
$db = "SELECT portal_status FROM portal WHERE id='1' LIMIT 1";
$qu = mysqli_query($con,$db);
$num = mysqli_num_rows($qu);
$fet = mysqli_fetch_array($qu);

$p = $fet['portal_status'];
if($p == "closed"){
$msg="<b>Examination Portal is Closed</b>";
echo $msg;
exit;
}
?>