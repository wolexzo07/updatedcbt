<?php
session_start();
if(isset($_GET["token"]) && !empty($_GET["token"]) && isset($_SESSION['SESS_D_EXAM_BUTTON_MA'])){
unset($_SESSION['SESS_D_EXAM_BUTTON_MA']);
$tok = sha1(uniqid(rand(278,29990033849402278)));
$agent = $_SERVER["HTTP_USER_AGENT"];
$ip = $_SERVER["REMOTE_ADDR"];
$user = $_SESSION['SESS_D_USER_EXAM'];
$sess = "true";

?>
<script type="text/javascript" language="javascript">
window.location='selection_page.php?active_session=true&generated_token=<?php echo $tok;?>&user_agent=<?php echo $agent;?>&current_user=<?php echo  $user;?>&current_ipAddr=<?php echo $ip;?>';
</script>
<?php

}
else{
	
	?>
	
<script type="text/javascript" language="javascript">
window.location='exams.php';
</script>
	
	<?php
	}

?>
