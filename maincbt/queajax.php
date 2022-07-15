<div id="q">
<font style="color:gray;font-size:11pt;letter-spacing:2px;"><?php echo "Category &raquo; ". "<i>".$cat."</i>";?>
<?php echo " &nbsp;&nbsp;Question Type &raquo; ". "<i>".$qtype."</i>";?>
</font>

<?php
if($qtype == 'objective'){
include("objectives.php");
}
elseif($qtype == 'subjective'){
include("m_ext.php");
}
else{
echo "No paper type!";
}
?>
</div>
