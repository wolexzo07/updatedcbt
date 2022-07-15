<?php
require_once("config.php");
$owner = $_SESSION['SESS_D_USER_EXAM'];
$sqlCommand = "SELECT id FROM exams_scores WHERE script_owner='$owner' AND attempted_num='$id' AND answer='a' LIMIT 1";
$que = mysqli_query($con,$sqlCommand );
$num = mysqli_num_rows($que);

if($num == 1){
echo "checked='checked'";
}

else{


}
?>