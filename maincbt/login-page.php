<?php
include("finishit.php");
include("siteinfo.php");
include("main.php");
include('sess_validation.php');
if(!isset($_SESSION['HTTP_IUOCBT'])){
$_SESSION['HTTP_IUOCBT'] = xip(); 
$_SESSION['OPERATING_SYSTEM_IUOCBT'] = xos();
}

?>
<html>
<head>
<?php
include("head_b.php");
?>
<title><?php echo strtoupper($sitename);?> - LOGIN PAGE</title>
</head>
<body>
<div class="header">
<center>
<?php include("logobase.php");?>
</center>
</div>







<div id="cnt" align="center">


<?php

if((isset($_GET["msg"]) && !empty($_GET["msg"]) && !isset($_GET["token_generated"]))){

echo $_GET["msg"];

}else{

}?>




<div id="fgh">


<div class="sc">


<img src="img/log.png" style="height:;width:200px;margin-left:7pt;margin-top:5pt"/>

<form method="POST" action="process_log" onsubmit="return(confir())">

<table cellpadding="5px" cellspacing="5px" style="" border="0">						

<tr>
<td valign="top">
<p class="pp">Username</p>
<input type="text" name="mat" autocomplete="off" required="" placeholder="Enter your matric number" id="fmp" class="mp"/></td>
<td valign="top" style="letter-spacing:2px"></td>
</tr>

<tr>
<td>
<p class="pp">Password</p>
<input type="password" name="pass" autocomplete="off" required="" placeholder="Enter password" id="smp" class="mp"/></td>
<td style="letter-spacing:2px"></td>
</tr>
<tr>

<td><center><input type="image" src="image/l.png" class="lbt" style="width:305px;"/></center>
<p>
<?php
$token = sha1(md5("wolexzo07isabigboystudentthatisgoingtoovertakeeverywherethispresentyear2015"));
if((isset($_GET["msg"]) && !empty($_GET["msg"])) && (isset($_GET["token_generated"]) && !empty($_GET["token_generated"]) && ($_GET["token_generated"]==$token)) ){

echo "<p style='letter-spacing:2px;color:green;margin-top:10pt;'>".$_GET['msg']."</p>";

}else{?>

<?php
if(x_count("reg_portal","portal_status='opened' LIMIT 1") > 0){
	?>
	<p style="display:block;padding-top:15px;">
<a href="register" target="_blank" style="letter-spacing:2px;text-decoration:none;color:black">Register an account</a>
</p>
	<?php
}
?>


<?php
}
?>
</p>
</td>
<td></td>
</tr>
</table>
</form>
</div>

</div>







</div>

<script type="text/javascript" language="javascript">
function confir(){
var tab = document.getElementById("fmp").value;
var cat = document.getElementById("smp").value;
if(tab == ""){
alert("Please enter your username or email address or  mobile number!");
document.getElementById("tab").focus();
return false;
}
else if(cat == ""){
alert("Please enter your password!");
document.getElementById("cat").focus();
return false;

}

else{
return true;


}
}
</script>

     	<script src="shutdown.js" type="text/javascript"></script>
     	<div id="logi"></div>


<div id="footer">
<?php
include("footer.php");
?>
</div>


</body>
</html>
