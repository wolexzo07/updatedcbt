<?php
if($_SERVER["REQUEST_SCHEME"] == 'http'){
$host = $_SERVER["HTTP_HOST"];
$uri = $_SERVER["REQUEST_URI"];
$link = "https://".$host.$uri;
//header("location:$link");
finish("$link","0");
exit();
}
?>
