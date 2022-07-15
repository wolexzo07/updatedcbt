<img src='image/exam_ins.png' class='exam_ins' style='width:98%;margin:2%'/>
<img src="image/per.png" class="per_user" style="width:98%;margin:2%"/>
<?php
include('instruction.php');
?>
<div id="perso_pro">
<img class="pro_per" style="padding:17px;width:17px;height:20px;float:right" src="image/cancel.png"/>
<p style="text-align:center;letter-spacing:2px;font-weight:bold">PERSONAL PROFILE DETAILS</p>
<img id="preimg" src="imageselector.php?id=<?php echo $_SESSION['SESS_D_MEMBER_ID_EXAM'];?>" style="width:120px;height:140px;margin:4px;border-radius:50% 50%;-moz-border-radius:50% 50%;-webkit-border-radius:50% 50%;-o-border-radius:50% 50%;-ms-border-radius:50% 50%;box-shadow:3px 1px 3px black;-webkit-box-shadow:3px 1px 3px black;-moz-box-shadow:3px 1px 3px black;"/>
<table width="100%" border="0" cellpadding="5px" cellspacing="5px">

<tr>
<td>
<b>Name</b>
</td>
<td>

<?php
echo $_SESSION['SESS_D_TITLE_EXAM'] .". ".$_SESSION['SESS_D_NAME_EXAM'];
?>
</td>
</tr>

<tr>
<td>
<b>Username</b>
</td>
<td>

<?php
echo $_SESSION['SESS_D_USER_EXAM'];
?>
</td>
</tr>

<tr>
<td>
<b>Gender</b>
</td>
<td>

<?php
echo $_SESSION['SESS_D_GENDER_EXAM'];
?>
</td>
</tr>


<tr>
<td>
<b>Email</b>
</td>
<td>

<?php
echo $_SESSION['SESS_D_EMAIL_EXAM'];
?>
</td>
</tr>

<tr>
<td>
<b>Mobile</b>
</td>
<td>

<?php
echo $_SESSION['SESS_D_MOBILE_EXAM'];
?>
</td>
</tr>


<tr>
<td>
<b>Level</b>
</td>
<td>

<?php
echo $_SESSION['SESS_D_LEVEL_EXAM'] ;
?>
</td>
</tr>
<tr>
<td>
<b>
Dept</b>
</td>
<td>

<?php
echo $_SESSION['SESS_D_DEPT_EXAM'] ;
?>
</td>
</tr>
</table>
</div>