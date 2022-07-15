<?php
try{
	$pdo = new PDO("mysql:host=localhost;dbname=iuodata", "dacracker", "follower1990");
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec("set names 'utf8'");
}
catch(PDOException $e){
	echo "Unable to connect to th database ".$e->getMessage();
	exit();
}
?>