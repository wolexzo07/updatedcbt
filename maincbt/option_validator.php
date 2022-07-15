<?php
require_once('config.php');
$dbs = "SELECT status FROM allow_status WHERE id='1' LIMIT 1";
$qus = mysqli_query($con,$dbs);
$nums = mysqli_num_rows($qus);
$fets = mysqli_fetch_array($qus);
if($nums != 0){
$ps = $fets['status'];
if($ps == 'Allow'){
echo " <b style='color:maroon'>Selected Option = " . $row["answer"]." ;</b>";
echo "&nbsp;&nbsp;";
echo " <b style='color:maroon'>"."correct"."</b>&nbsp; <img src='image/correct.png' style='height:20px;width:20px'/>";
}
elseif($ps == 'Disallow'){
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