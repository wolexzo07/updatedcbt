<?php
require_once('config.php');
$dbg = "SELECT status FROM allow_status WHERE id='1' LIMIT 1";
$qur = mysqli_query($con,$dbg);
$numr = mysqli_num_rows($qur);
$fety = mysqli_fetch_array($qur);
if($numr != 0){
$po = $fety['status'];
if($po == 'Allow'){
echo " <b style='color:maroon'>Selected Option = " . $row["answer"]." ;</b>";
echo "&nbsp;&nbsp;";
echo " <b style='color:maroon'>"."wrong"."</b>&nbsp;<img src='image/wrong.png' style='height:20px;width:20px'/>";

}
elseif($po == 'Disallow'){
echo " <b style='color:maroon'>Selected Option = " . $row["answer"]." ;</b>";
echo "&nbsp;&nbsp;";

}
else{
echo "";

}

}
else{

echo "" ;

}
?>