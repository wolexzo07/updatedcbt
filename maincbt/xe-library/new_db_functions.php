<?php
function x_max($what,$table,$where){
	
	$limit = x_count($table,$where);
	
	if($limit > 0){
		
			if(($where == "0")){
				$sele ="SELECT MAX($what) as highest FROM $table LIMIT $limit";
			}else{
				$sele ="SELECT MAX($what) as highest FROM $table WHERE $where LIMIT $limit";
			}

			if(!$read = x_connect($sele)){
			$msg = "Failed to query db";
			return $msg;
			}else{
			$assoc = mysqli_fetch_assoc($read);
			$num = $assoc["highest"];
			return $num;
			}
	}else{
		return 0;
	}
}
?>