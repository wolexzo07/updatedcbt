<?php
if (isset($_GET['id']) && !empty($_GET['id'])){
require_once('config.php');
$id = clean($_GET['id']) ;
$selet = "SELECT * FROM register WHERE id = '$id' LIMIT 1";
$result = mysqli_query($con,$selet) or die(mysqli_error());

if(mysqli_num_rows($result) != 0) {

$row = mysqli_fetch_array($result);
$type = $row['pictype'];
$size = $row['picsize'];
$image = $row['photo'];

header("content-type: ".$type);


echo $image;
}

else {

echo 'image is not in our database' ;
exit;
}


}
else 
{
die('parameter missing');

}


?>