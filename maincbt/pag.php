<?php
include("randomizer.php");
foreach($attemp as $key){
}

$sql = mysqli_query($con,"SELECT * FROM questions WHERE id != '$key' AND approval_status='approved' ORDER BY Categories ");
$w = mysqli_fetch_array($sql);
$q = $w['question'];
echo "<p>".$q."</p>";
//////////////////////////////////// wolexzo07's Pagination Logic ////////////////////////////////////////////////////////////////////////
$nr = mysqli_num_rows($sql); // Get total of Num rows from the database query

echo $nr;