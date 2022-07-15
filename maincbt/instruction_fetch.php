<?php
include("validatingPage.php");
if(x_count("instruction","categories='examination' LIMIT 1") > 0){
	foreach(x_select("title,instruction,date_time","instruction","categories='examination'","1","id") as $row){
		
		$title = $row["title"];
		$ins = $row["instruction"];
		$date_time = $row["date_time"];

		echo "<div style='margin:0pt;padding:5pt;'>";
		echo "<h3 style='letter-spacing:6pt;margin:0pt;text-decoration:underline;text-transform:uppercase'>$title</h3>";
		echo "<div style='letter-spacing:3pt;font-style:italic;padding:5pt'>".$ins ."</div>";

		echo "</div>";
	}
}else{
	echo"<h3 style='text-align:center'>Failed to fetch data from the database!!</h3>";
}
?>
