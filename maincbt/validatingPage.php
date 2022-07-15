<?php
if(!function_exists('x_count')){
	echo "
	<html>
	<head>
	<title>PAGE FORBIDDEN</title>
	</head>
	<body style='background:red;'>
	<center>
	<img src='image/new/stop.jpg' style='width:300px;margin-top:60px;border-radius:100%;'/>
	</center>
	<h1 style='text-align:center;color:white;text-transform:uppercase;'>Forbidden Page! You are not authorized.</h1>
	<h3 style='text-align:center;color:yellow'>You will be redirected in a moment.</h3>
	</body>
	</html>
	";
	exit();
}
?>