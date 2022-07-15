<?php
require_once('config.php');
$dbd = "SELECT status FROM option_update WHERE id='1' LIMIT 1";
$quq = mysqli_query($con,$dbd);
$numeri = mysqli_num_rows($quq);
$fetr = mysqli_fetch_array($quq);
if($numeri != 0){
$pp = $fetr['status'];
if($pp == 'Allow'){

include("option_update.php");


}
elseif($pp == 'Disallow'){

$msg="<img src='image/sor.png' style='width:250px;'/>";
echo "<p style='color:green'>" .$msg . "</p>" ;
}
else{
echo "";

}

}
else{

echo "" ;

}
?>