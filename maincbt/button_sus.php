<?php
require_once('config.php');
$user_acct = $_SESSION['SESS_D_USER_EXAM'];
$email_acct = $_SESSION['SESS_D_EMAIL_EXAM'];
//$db_acct = "SELECT access FROM register WHERE username='$user_acct' AND email='$email_acct'";
$db_acct = "SELECT access FROM register WHERE username='$user_acct' LIMIT 1";
$qu_acct = mysqli_query($con,$db_acct);
$num_acct = mysqli_num_rows($qu_acct);
$fet_acct = mysqli_fetch_array($qu_acct);

$p_acct = $fet_acct['access'];
if($p_acct == "revoked"){
$msg="<b>Please your result is already published</b>";
echo $msg;

}
else{
	
?>
<input type='image' name='submit'  value='JesusIsLord' src='image/submit.png' style='width:150px;margin-left:80%;margin-top:2%;display:none' />

<?php
}

?>
