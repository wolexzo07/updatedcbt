<?php
/**
Timing script by timothy
 */
function secondsToTime($seconds)
{
	// extract hours
	$hours = floor($seconds / (60 * 60));

	// extract minutes
	$divisor_for_minutes = $seconds % (60 * 60);
	$minutes = floor($divisor_for_minutes / 60);

	// extract the remaining seconds
	$divisor_for_seconds = $divisor_for_minutes % 60;
	$seconds = ceil($divisor_for_seconds);
	
	if((((int)$hours) < 10) && (((int)$minutes) < 10) && (((int)$seconds) < 10)){
	$obj = "0".(int)$hours .":"."0".(int)$minutes.":"."0".(int)$seconds;
	
	}elseif((((int)$hours) > 10) && (((int)$minutes) < 10) && (((int)$seconds) < 10)){
		$obj = "".(int)$hours .":"."0".(int)$minutes.":"."0".(int)$seconds;
		}
	
	elseif((((int)$hours) < 10) && (((int)$minutes) > 10) && (((int)$seconds) < 10)){
	
			$obj = "0".(int)$hours .":"."".(int)$minutes.":"."0".(int)$seconds;
	
	}
	elseif((((int)$hours) < 10) && (((int)$minutes) < 10) && (((int)$seconds) > 10)){
				$obj = "0".(int)$hours .":"."0".(int)$minutes.":"."".(int)$seconds;
	
	
	}
	elseif((((int)$hours) > 10) && (((int)$minutes) > 10) && (((int)$seconds) < 10)){
					$obj = "".(int)$hours .":"."".(int)$minutes.":"."0".(int)$seconds;
	
	
	}
	elseif((((int)$hours) > 10) && (((int)$minutes) < 10) && (((int)$seconds) > 10)){
	
						$obj = "".(int)$hours .":"."0".(int)$minutes.":"."".(int)$seconds;
	
	}
	elseif((((int)$hours) < 10) && (((int)$minutes) > 10) && (((int)$seconds) > 10)){
	
		$obj = "0".(int)$hours .":"."".(int)$minutes.":"."".(int)$seconds;
	
	}
	

	else{
		$obj = (int)$hours .":".(int)$minutes.":".(int)$seconds;
	
	
	}



	return $obj;
}
