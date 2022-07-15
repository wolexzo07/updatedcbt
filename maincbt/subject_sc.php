<?php
include_once("finishit.php");
$scor_p = x_sum("score_point","exams_scores","subject='$cat_p' AND script_owner='$user_p' AND Score_approval = 'approved'");
$total_p =x_sum("score_point","exams_scores","script_owner='$user_p' AND Score_approval = 'approved'");


?>
