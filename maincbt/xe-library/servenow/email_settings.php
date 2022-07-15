<?php

// without connection to database

// Send mail with gmail less secure application
/***$hostserver= "smtp.gmail.com";  // required for alternate routing of email
$username = "hitmeads@gmail.com"; // required for alternate routing of email
$password = "Affinity1990?";  // required for alternate routing of email
$setfrom = "hitmeads@gmail.com";
$replyto = "hitmeads@gmail.com";
$title ="Metavbreed :: Exploring the world of NFT at your own pace";
$port = 465;  // required for alternate routing of email
$protocol = "ssl";
$smtp_auth = true;
***/

// Connecting database to pull out data
include("../xe-library74.php");
$sitename = x_getsingle("SELECT site_name FROM siteinfo WHERE id='1' LIMIT 1","siteinfo WHERE id='1'","site_name");
$sitetitle = x_getsingle("SELECT site_title FROM siteinfo WHERE id='1' LIMIT 1","siteinfo WHERE id='1'","site_title");
// Send mail with gmail less secure application
$hostserver = "smtp.gmail.com";  // required for alternate routing of email
$username = "hitmeads@gmail.com"; // required for alternate routing of email
$password = "Affinity1990?";  // required for alternate routing of email
$setfrom = "hitmeads@gmail.com";
$replyto = "hitmeads@gmail.com";
$title ="$sitename :: $sitetitle";
$port = 465;  // required for alternate routing of email
$protocol = "ssl";
$smtp_auth = true;

?>