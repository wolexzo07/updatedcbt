<form method="POST" name="datareader" id="datareader" autocomplete="off">

<div><h3 style="font-weight:normal;letter-spacing:3px;font-size:11pt;">
<?php
if(isset($_GET['pn']) && !empty($_GET['pn']) && is_numeric($_GET['pn'])){

echo $_GET['pn'] .". " . $quest ;
}
else{
echo "1. " . $quest ;

}

?>
</h3></div>

<input type="hidden" name="id" value="<?php echo $id;?>"/>
<input type="hidden" name="cat" value="<?php echo $cat;?>"/>
<input type="hidden" name="type" value="<?php echo $type;?>"/>
<input type="hidden" name="cnum" value="<?php 

if(isset($_GET['pn']) && !empty($_GET['pn']) && is_numeric($_GET['pn'])){
$way = $_GET['pn'];
echo $_GET['pn'];
}
else{
	$way = 1;
echo "1";

}
?>"/>

<input type="hidden" name="qtoken" value="<?php echo $token;?>"/>
<input type="hidden" name="quest_type" value="<?php echo $qtype;?>" id="quest_type"/>
<input type="hidden" name="token" value="<?php echo sha1(md5(rand(123 ,902973829).time().uniqid()));?>"/>
<br/>


<p style='letter-spacing:3pt;color:green;margin-left:2%;margin-top:2%;'>
<?php include("button_sus.php");?>
</p>
</form>
<p style='letter-spacing:3pt;color:green;margin-left:2%;'><?php
if(isset($_GET["msg"]) && !empty($_GET["msg"]))
{
echo $_GET["msg"] ;
}
else{
$owner = $_SESSION['SESS_D_USER_EXAM'];
$full = $_SESSION['SESS_D_NAME_EXAM'];
$email = $_SESSION['SESS_D_EMAIL_EXAM'];
$msg_sele = "SELECT answer,final_comment FROM exams_scores WHERE attempted_num='$id' AND script_owner='$owner' LIMIT 1";
if(!$mq=mysqli_query($con,$msg_sele)){
echo "ERROR :unable to query db";
}
else{
$mq=mysqli_query($con,$msg_sele);
$qnum = mysqli_num_rows($mq);
if($qnum == 0){

}
else{
$rot = mysqli_fetch_array($mq);
$ans = $rot["answer"];
$fc = $rot["final_comment"];

$db_acct = "SELECT status FROM allow_status WHERE id='1' LIMIT 1";
$qu_acct = mysqli_query($con,$db_acct);
$num_acct = mysqli_num_rows($qu_acct);
$fet_acct = mysqli_fetch_array($qu_acct);

$p_acct = $fet_acct['status'];
if($p_acct == "Disallow"){
echo "Your answer = ". $ans . "";
}
else{
echo "Your answer = ". $ans . " <b>($fc)</b> ";
}


}

}
}
?>

</p>