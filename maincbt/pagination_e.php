<p style="padding:10px;text-align:center;color:green;letter-spacing:2px;">
<?php require("upload_ans.php");?></p>
<p style="padding:10px;text-align:center;color:green;letter-spacing:2px;">
<?php require("delete_file.php");?></p>
<div class='que'>

<?php

include "db_connect.php";
try{
	$sql = "select * from questions WHERE approval_status='approved' AND paper_type='essay' ";
	$stm = $pdo->prepare($sql);
	$stm->execute();
	$results = $stm->fetchAll();
}
catch(PDOException $e){
	echo "Error fetching questions: ".$e->getMessage();
	exit();
}
if(count($results) <= 0){
	echo "<p style='padding:10px;letter-spacing:5px;color:green;'>No question uploaded yet</p>";
}
else{
?>


<?php
foreach($results as $result){
echo "<p style='letter-spacing:2px;font-weight:bold;margin-bottom:14px;font-size:17pt;color:green;'>"."SUBJECT &raquo;&raquo; ".$result['categories']."</p>";
	echo "".$result['question']."";
}
?>



<?php
}

?></div>
<?php
if(count($results) != 0){
?>

<img src="img/uploas.png" class="erud" style="width:170px"/>

<div class="uploader">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
<fieldset class="found"><legend></legend>
<div class="upl">
<input type="hidden" value="<?php echo $_SESSION['SESS_D_NAME_EXAM'];?>" name="name"/>
<input type="hidden" value="<?php echo $_SESSION['SESS_D_USER_EXAM'];?>" name="user"/>
<input type="hidden" name="lecturer" value="<?php echo $result['lecturer'];?>"/>
<input type="hidden" name="subje" value="<?php echo $result['categories'];?>"/>
<input type="hidden" name="papertype" value="<?php echo $result['paper_type'];?>"/>
<input type="file" name="answer" id="answer" /><br />
</div>
<input type="image" src="img/upbtn.png" class="btnn"/>
</fieldset>
</form>

<?php
try{
$user = $_SESSION['SESS_D_USER_EXAM'];
	$sq = "select id, question_path from essay_submission WHERE username='$user'";
	$st = $pdo->prepare($sq);
	$st->execute();
	$results = $st->fetchAll();
}
catch(PDOException $e){
	echo "<br />error fetching data ".$e->getMessage();
	exit();
}
if(count($results) <= 0){
	echo "<p style='padding:10px;letter-spacing:5px;color:green;'>No file uploaded yet</p>";
}
foreach($results as $result){
	$text = "<div class='' style='font-weight:bold'>(Uploaded File)&nbsp;&nbsp;".end(explode('/', $result['question_path']))."<form method='POST' action='".$_SERVER['PHP_SELF']."' style='display:inline;'><input type='hidden' value='".$result['id']."' name='to_del'/><input type='hidden' value='".$result['question_path']."' name='to_del_path'/>
	<input type='hidden' value='$user' name='username'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&laquo;------ &raquo;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='image' src='img/delet.png' class='del_button' style='width:25px'/></form></div>";
	echo $text;
}
$pdo = null;
?>

</div>

<?php


}?>

<style type="text/css">
.que{
height:300px;
overflow:auto;
padding:20px;
margin:2%

}
.upl{
border:1px dashed black;
padding:14px;
margin:5px;
width:400px;

}
.btnn{
width:80px;
margin-left:5px;
}
.found{
width:auto;
border:0px ;
}

.uploader{
display:none;

}

</style>