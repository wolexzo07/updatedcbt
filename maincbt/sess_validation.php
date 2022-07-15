<?php
session_start();
if(x_validatesession("SESS_D_USER_EXAM") || x_validatesession("SESS_D_MEMBER_ID_EXAM")){
finish("index","0");
exit;
}
?>