<?php
include("config.php");
$query = "SHOW COLUMNS FROM questions ";
$qu = mysqli_query($con,$query);
while($row = mysqli_fetch_array($qu)){
$tab = $row[0];
echo $tab ."<br/>";
}
$ran = array('id' ,'f_option' ,'s_option' ,'t_option' ,'ft_option' ,'question' ,'answer');
$random = array_rand($ran);
$ty = $ran[$random];
echo $ty;
?>