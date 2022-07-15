<?php
/*
Database connection script developed by Biobaku Oluwole Timothy under the distribution licence of xelow global concept
*/
$con = mysqli_connect("localhost" ,"root" ,"","cbtsoftware") or die("Error connecting...".mysqli_connect_error());

function clean($chk){
 $host="localhost";$user = "root";$pass = "";$db ="cbtsoftware";
$con = mysqli_connect($host , $user , $pass , $db) or die("Error connecting: ".mysqli_error());
$chk = @trim($chk);
$chk = stripslashes($chk);
return mysqli_real_escape_string($con,$chk);
}
?>