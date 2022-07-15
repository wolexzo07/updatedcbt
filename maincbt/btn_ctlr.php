<?php
//require_once('config.php');
include("validatingPage.php");
if(x_count("result_button","id='1' AND status='enable'") > 0){
		?>
		<a href="result_p?key=<?php echo sha1(rand(234,8937)).sha1(rand(4,89099887));?>" target="_blank"><img src="img/cr.png" class="proimger" onmouseover="tooltip.pop(this, '#demo2_tip')"/></a>
<?php
	
}?>