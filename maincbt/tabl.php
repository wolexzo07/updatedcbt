
<table style='background-color:;color:purple' width="100%" border="0px" cellpadding="5px" cellspacing="1px">
<tr>
<td align='left' valign="top" width='70%'>
<table cellpadding="10px" border="0px" cellspacing="0px" style="letter-spacing:3px;font-size:10pt;">
<tr>
<td><b>NAME</b> </td>
<td><?php
echo $_SESSION['SESS_D_NAME_EXAM'];
?></td>

</tr>


<tr>
<td><b>MAT. NO.</b></td>
<td><?php
echo $_SESSION['SESS_D_USER_EXAM'];
?></td>

</tr>

<tr>
<td><b>GENDER</b></td>
<td><?php
echo $_SESSION['SESS_D_GENDER_EXAM'];
?></td>

</tr>

<tr>
<td><b>LEVEL</b></td>
<td><?php
echo $_SESSION['SESS_D_LEVEL_EXAM'];
?></td>

</tr>


<tr>
<td><b>DEPART.</b></td>
<td><?php
echo $_SESSION['SESS_D_DEPT_EXAM'];
?></td>

</tr>


</table>
</td>

<td align='left' valign="top" width='30%'>
<img src="<?php echo "studentphoto/S".$_SESSION['SESS_D_MAT_NO_EXAM'].".jpg";?>" style="width:120px;float:right;margin-right:20px;border-radius:50% 50%;-moz-border-radius:50% 50%;-webkit-border-radius:50% 50%;-o-border-radius:50% 50%;-ms-border-radius:50% 50%;box-shadow:3px 1px 3px black;-webkit-box-shadow:3px 1px 3px black;-moz-box-shadow:3px 1px 3px black;"/>

</td>
<!--<td align='left' valign="top" width='20%'>

<center> <img src="img/logo.jpg" style="width:120px;"/></center>
</td>-->

</tr>
</table>
