<?php
if(isset($_POST['to_del']) && isset($_POST['to_del_path'])){
if(!isset($_POST['to_del']) || $_POST['to_del'] == ''){

	echo "Error getting information about the file to delete";
	exit();
	
}
if(!isset($_POST['to_del_path']) || $_POST['to_del_path'] == ''){
	echo "Error getting information about the file to delete";
	exit();
}
require_once("config.php");

$user = clean($_POST['username']);
$path_deli = $_POST['to_del_path'];



	$sql = "DELETE FROM essay_submission where username = '$user'";
	$typer = mysqli_query($con,$sql);
	if(!$typer){
	echo "Failed to delete file!";
	exit();
	}
	else{
	
	$del_file = unlink($path_deli);
	if(!$del_file){
	echo "Error deleting file from folder";
	exit();
	}

	echo "File successfully deleted!";

	
	}
}
?>