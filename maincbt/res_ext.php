<!DOCTYPE html>
<html>
<head>
<title>
Result Slip For <?php echo $namm ;?>
</title>
<meta name="description" content="Result Slip For <?php echo $namm ;?>"/>
</head>
<body style="background-image:url(img/fadep.jpg);background-repeat:repeat;background-position:50% 70%;">
<img style="padding:17px;width:17px;height:20px;float:right" onclick="window.print()" title="Click this icon to print your result" src="image/print.png"/>
<center> <img src="img/cbtpl.png" style="width:60%"/></center>



<div style="margin:7pt">
<?php
include("tabl.php");
?>

<!---<div style="border-bottom:2px solid black;border-left:2px solid black;border-right:2px solid black">-->
<!---<h3 style="border-top:2px solid black;background-color:lightblue;background-image:url(img/bnner.png);margin-bottom:3pt;padding:10px;font-style:italic;text-transform:uppercase;letter-spacing:2px;font-size:10pt;font-family:Arial Narrow;">Each Subject Score</h3>--->

<?php include('profile_score.php')?>
<!--</div>--->



<?php
require_once('config.php');
$db = "SELECT status FROM full_result_mode WHERE id='1' LIMIT 1";
$qu = mysqli_query($con,$db);
$num = mysqli_num_rows($qu);
$fet = mysqli_fetch_array($qu);
if($num != 0){
$p = $fet['status'];
if($p == "enable"){

?>


<div style="border-bottom:2px solid black;border-left:2px solid black;border-right:2px solid black">
<h3 style="border-top:2px solid black;background-color:lightblue;background-image:url(img/bnner.png);margin-bottom:3pt;padding:10px;font-style:italic;text-transform:uppercase;letter-spacing:2px;font-size:10pt;font-family:Arial Narrow;">Full Result Details</h3>

<table width="100%" border="1px" cellpadding="5px" cellspacing="5px">
<tr>
<td align='left' width='60%'><b>Total Questions</b></td>
<td align='left' width='40%'><?php echo $qu_num." ";?></td>

</tr>



<tr>
<td><b>Attempted</b></td>
<td><?php echo "". $all_count."";?></td>


</tr>


<tr>
<td><b>Failed</b></td>
<td><?php $fa = $qu_num- $num; echo $fa." ";?></td>

</tr>


<tr>
<td><b>Passed</b></td>
<td><?php echo $num;?></td>

</tr>

<tr>
<td><b>Total Score</b></td>
<td><?php echo $num;?></td>

</tr>

<tr>
<td><b>Percentage</b></td>
<td><?php echo "". $m_percent."%";?></td>


</tr>



</table>
</div>


<?php



}

else{
	?>
	
	
	<?php


}
}
else{
$msg="<b>No status</b>";
echo $msg;

}
?>



</div>
</body>
</html>
