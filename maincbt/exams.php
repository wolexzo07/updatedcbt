<?php
include("auth.php");
include("siteinfo.php");
?>
<html>
<head>
<?php
include("head_b.php");
?>
<title><?php echo strtoupper($sitename);?> - <?php echo strtoupper($_SESSION['SESS_D_NAME_EXAM']);?> EXAMINATION PAGE</title>
</head>
<body>
<script type="text/javascript" src="js/controls.js"></script>

<div id="">
<div class="header">
<center>
<?php //include("logobase.php");?>
</center>
</div>
<?php
// manage profile photo
if(x_count("control_profile","status='1' LIMIT 1") > 0){
?>
<img id="preimg" src="<?php 
$userid = x_clean($_SESSION['SESS_D_MEMBER_ID_EXAM']);
$img = x_getsingle("SELECT photo FROM register WHERE id='$userid' LIMIT 1","register WHERE id='$userid' LIMIT 1","photo");
if($img == ""){
	echo "image/avatar.png";
}else{
	echo $img;
}
?>" class="proimger"/>
<?php
}
	?>

<?php require("btn_ctlr.php");?>
<div id="erf" >
	Welcome <b> <?php if($_SESSION['SESS_D_USER_EXAM'] != ""){ echo $_SESSION['SESS_D_USER_EXAM']. "&nbsp;&nbsp;(".$_SESSION['SESS_D_NAME_EXAM'].")";}else{echo $_SESSION['SESS_D_MAT_NO_EXAM'];} ?> </b> 
&nbsp;| &nbsp;<img src='image/logout.png' onmouseover="tooltip.pop(this, '#demo3_tip')" class='logout' style='width:20px' onclick="return(shu())"/>&nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;


<fieldset class="fdii">
<legend><img src="img/ep.png" class="selL1"/></legend>
<table width="100%" cellpadding="10px" cellspacing="10px" border="0px">
<tr>
<td width="86%" valign="top">

<?php 
if(x_count("mode","id='1' LIMIT 1") > 0){
foreach(x_select("status","mode","id='1'","1","id") as $key){
$stat = $key["status"];
}
if($stat == "essay_mode"){
include("pagination_e.php");
}
else{
include("pagination.php");
}
}else{
echo "No mode found";
}
?>
</td>
<td width="" valign="top">
<form style="margin-bottom:10pt;" action="pageit" method="POST">
<p>
PAGE: <input type="number" name="page" required="" style="width:50px;" max="" min="1" value="1"/>
<input type="hidden" name="cp" required="" value="<?php
if(isset($_GET["pn"]) && !empty($_GET["pn"])){
	echo xg("pn");
}else{echo "1";}
?>"/>
<input type="submit" value="Go"/>
</p>
</form>
     	<script src="shutdown.js" type="text/javascript"></script>
	<script src="logit.js" type="text/javascript"></script>
	<script type="text/javascript" language="javascript" src="adax.js"></script>
<div class="timeclass" id="timeclasse"></div>
<div id="log"></div>
<div id="logi"></div>

<img src="img/chg.png" onclick="parent.location='changer?token=<?php echo sha1(rand(6000 , 1000000));?>'" style="width:170px"/>

<img src="img/e2850cce504f13b86304e7126a9b006e16734a98.png" style="width:120px;display:none;"/>

<script type="text/javascript" src="js/calc.js"></script>

<img class="pot" src="../download.png" style="width:30px;display:block;"/>

</td>
</tr>
</table>

</fieldset>

<div id="calc_loader">
<?php require_once("../calc2/extra.html");?>
</div>

</div>
<div style="display:none;">
<?php
	if(x_count("tooltips","id='1'") > 0){
		foreach(x_select("tooltip","tooltips","id='1'","1","id") as $key){
			$info = $key["tooltip"];
			echo " ".$info;
		}
	}else{
		
	}
?>
			 
             </div>
<div id="footer">

</div>
</div>
</body>

</html>
