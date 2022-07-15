<?php
include_once("finishit.php");
if(isset($_POST["page"]) && !empty($_POST["page"]) && isset($_POST["cp"]) && !empty($_POST["cp"])){
$pag = xp("page");
$cp = xp("cp");	

if(!is_numeric($pag)){
	finish("exams?pn=$cp","Enter a valid page number!");
}else{
	finish("exams?pn=$pag","0");
}
	
}else{
finish("exams?pn=1","Parameter missing!");	
	
}
	
	?>