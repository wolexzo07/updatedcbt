<?php
require_once('config.php');
require_once('timtalk.php');

$db = "SELECT timer FROM exam_timer WHERE id='1' AND status='on' LIMIT 1";
$qu = mysqli_query($con,$db);
$num = mysqli_num_rows($qu);
if($num != 0){
$data = mysqli_fetch_array($qu);
$tim = $data['timer'];
$tim = $tim/1000;


echo "<p style='font-size:12pt;display:block;letter-spacing:2px;color:green;border:0px solid black;margin-bottom:3%;background-color:transparent;padding:10px;'>TIME ALLOWED [HOURS:MINUTES:SECONDS]  &raquo;&raquo;&raquo;&raquo; <b style='font-size:20pt'>".secondsToTime($tim)."</b></p>";


}
else{
echo "";
}
	?>