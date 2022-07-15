<?php
/*
session_start();
require("config.php");
$ip = $_SESSION['HTTP_IUOCBT'];
$os_type = $_SESSION['OPERATING_SYSTEM_IUOCBT'];
$sel = "SELECT * FROM logoff WHERE status='granted'"; 
if($lead = mysql_query($sel)){
$num = mysql_num_rows($lead);
$m = mysql_fetch_array($lead);
$mode = $m["mode"];
if($num > 0){
if($mode == "shutdown"){

if($os_type == "Linux"){
$rt = system("init 0");
echo $rt;
}else{
$rt = system("shutdown -m \\$ip");
echo $rt;
}

}elseif($mode == "reboot"){
if($os_type == "Linux"){
$rt = system("reboot");
echo $rt;
}else{
$rt = system("shutdown -m \\$ip");
echo $rt;
}
}else{
echo "";
}


}else{
echo "";
}

}else{


}
*/
?>
