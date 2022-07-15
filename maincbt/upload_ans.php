<?php
if(isset($_POST["name"]) && isset($_POST["user"]) ){
require_once("config.php");
$user = clean($_POST["user"]);
$nam = clean($_POST["name"]); 
$lecturer = clean($_POST["lecturer"]); 
$subet = clean($_POST["subje"]);
$pap = clean($_POST["papertype"]);

if(!isset($_FILES['answer']) || $_FILES['answer']['size'] <= 0){
	echo "<br />Please make sure you pick a valid file";
	exit();
}
if($_FILES['answer']['size'] > 3145728){
	echo "<br />File size more than expected size";
	exit();
}
$allowed_ext = array('docx', 'doc', 'png', 'pdf');
$allowed_mime_types = array('application/msword', 'text/pdf', 'image/png', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
$ext = end(explode(".", $_FILES['answer']['name']));
if(!in_array($ext, $allowed_ext) || !in_array($_FILES['answer']['type'], $allowed_mime_types)){
	echo "<br />Make sure you select a ms-word, pdf or png file";
	exit();
}
if(!is_uploaded_file($_FILES['answer']['tmp_name'])){
	echo "<br />Make sure you choose a valid file!!!";
	exit();
}


$tab = "CREATE TABLE IF NOT EXISTS essay_submission(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name TEXT NOT NULL,
username TEXT NOT NULL,
question_path TEXT NOT NULL,
file_size TEXT NOT NULL,
token TEXT NOT NULL,
paper_type TEXT NOT NULL,
subject TEXT NOT NULL,
score_approval TEXT NOT NULL,
score TEXT NOT NULL,
lecturer_name TEXT NOT NULL,
date_time TEXT NOT NULL

)";
$yi = mysqli_query($con,$tab);
if(!$yi){

	echo "<br />Failed to create table";
	exit();
}

$token_path = sha1(uniqid().rand(1,345819102));
$file_path = "answers_que/".$user."_".$token_path.".".$ext;

$sel = "SELECT * FROM essay_submission WHERE username='$user'";
$qer = mysqli_query($con,$sel);
if(!$qer){
	echo "Failed to query essay database";
	exit();
}
$count = mysqli_num_rows($qer);
if($count == 0){

 
$move = move_uploaded_file($_FILES['answer']['tmp_name'], $file_path);
if(!$move){
	echo "<br />Oops! Error occurred while uploading the file, please try again";
	exit();
}

$file_size = clean($_FILES['answer']['size']);
$token = sha1(time().uniqid().rand(1 ,542617829363));
	$sql = "INSERT INTO essay_submission (name, username, question_path, file_size, token, paper_type, subject, score, lecturer_name, date_time) VALUES 
			('$nam' , '$user', '$file_path', '$file_size', '$token', '$pap', '$subet', '', '$lecturer', now())";
	$qery = mysqli_query($con,$sql);
	if(!$qery){
	echo "Failed to insert data!";

	}
	else{
	echo "Answer Uploaded succesfully!";
	
	}

}
else{

$sel = "SELECT * FROM essay_submission WHERE username='$user'";
$qer = mysqli_query($con,$sel);
if(!$qer){
	echo "Failed to query essay database";
	exit();
}
$row = mysqli_fetch_array($qer);
$path_db = $row["question_path"];
	unlink($path_db);
	$file_size = clean($_FILES['answer']['size']);
	$sql = "UPDATE essay_submission SET question_path = '$file_path' ,date_time = now() ,file_size= '$file_size' , lecturer_name='$lecturer' WHERE username='$user'";
	$db_re = mysqli_query($con,$sql);
	if(!$db_re){
	echo "<br />failed to upload answer update!";
	exit();
	}
	else{
	
		$move = move_uploaded_file($_FILES['answer']['tmp_name'], $file_path);
       if(!$move){
	  echo "<br />Oops! Error occurred while uploading the file, please try again";
	  exit();
}
else{
	echo "<br />Answer updated successfully";
}
	}
}
}
?>