<form>
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

<table cellpadding="3px" cellspacing="3px">
<tr>
<td valign="top">a&nbsp;<input type="radio" onclick="result(this.value)" <?php include("checked.php");?> name="opt" class="a" value="a"/></td>
<td valign="top" style="letter-spacing:2px;font-size:10pt;">
<?php echo $first;?>
</td>
</tr>

<tr>
<td valign="top">b&nbsp;<input type="radio" onclick="result(this.value)" <?php include("checked_b.php");?> name="opt" class="b" value="b"/></td>
<td valign="top" style="letter-spacing:2px;font-size:10pt;">
<?php echo $second;?>
</td>
</tr>

<tr>
<td valign="top">c&nbsp;<input type="radio" onclick="result(this.value)" <?php include("checked_c.php");?> name="opt" class="c" value="c"/></td>
<td valign="top" style="letter-spacing:2px;font-size:10pt;">
<?php echo $third;?>
</td>
</tr>

<tr>
<td valign="top">d&nbsp;<input type="radio" onclick="result(this.value)" <?php include("checked_d.php");?> name="opt" class="d" value="d"/></td>
<td valign="top" style="letter-spacing:2px;font-size:10pt;">
<?php echo $fourth;?>
</td>
</tr>


</table>

<input type="hidden" name="id" id="id" value="<?php echo $id ;?>"/>
<input type="hidden" name="toke" id="tok" value="<?php echo $token ;?>"/>
<input type="hidden" name="subject" id="subjec" value="<?php echo $cat ;?>"/>
<input type="hidden" name="typed" id="typet" value="<?php echo $type ;?>"/>
<input type="hidden" name="quest_type" value="<?php echo $qtype;?>" id="quest_type"/>
<input type="hidden" name="emailed" id="emailed" value="<?php echo $_SESSION['SESS_D_EMAIL_EXAM'] ;?>"/>

<div id="search" style="margin-top:10pt;" ><?php include("validateajax.php"); ?></div>
<script type="text/javascript" src="ajax.js"></script>

</form>
