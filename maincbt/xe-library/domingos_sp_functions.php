<?php

	
	function get_allowed_content($table_name,$media_type,$table_column){
			if(x_justvalidate($media_type) && x_justvalidate($table_name) && x_justvalidate($table_column)){
			$getcount = x_count($table_name,"status='1' AND file_type='$media_type' LIMIT 1");
				  if($getcount > 0){
					  foreach(x_select("$table_column","$table_name","status='1' AND file_type='$media_type'","1","id") as $key){
						  $result = $key[$table_column];
					  }
					  $getresponse = $result;
				  }else{
					  $getresponse = "";
				  }
				  return $getresponse;
			}
			
		}
		
		
		function x_getsingle($sqlquery,$countquery,$columntoget){
			
			if(x_justvalidate($sqlquery) && x_justvalidate($columntoget) && x_justvalidate($countquery)){
				
				  $getcount = x_querycount($countquery);
			
				  if($getcount > 0){
					  foreach(x_fetchQuery($sqlquery) as $key){
						  $result = $key[$columntoget];
					  }
					  $getresponse = $result;
				  }else{
					  $getresponse = "";
				  }
				  return $getresponse;
				  
				  
			}
			
		}
		// Remove all url found in a string
		function x_stripurl($input) {
		  $search = array(
			'/https?\:\/\/[^\" \n]+/i',	'/^(https|http):\/\/(?:www\.)?(?:youtube.com|youtu.be)\/(?:watch\?(?=.*v=([\w\-]+))(?:\S+)?|([\w\-]+))$/',
			'/^(https|http):\/\/(?:www\.)?(?:vimeo.com)\/([0-9a-zA-Z]+)$/',
			'/^https?:\/\/(?:w\.|www\.|)?(m\.)?(soundcloud\.com|snd\.sc)\/(.*)$/'
			);

    $output = preg_replace($search, "", $input);
    return $output;
  }
		
		function x_checkmedia_count($val){
		if($val == ""){
		return "0";
		}else{
		return count(explode(" ",$val));
		}
		}
		
		function x_zeroless($val){
		if($val == 0){
		return "";
		}else{
		return $val;
		}
		}
		
		function valid_URL($url){
				return preg_match('%^(?:(?:https?|ftp)://)(?:\S+(?::\S*)?@|\d{1,3}(?:\.\d{1,3}){3}|(?:(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)(?:\.(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)*(?:\.[a-z\x{00a1}-\x{ffff}]{2,6}))(?::\d+)?(?:[^\s]*)?$%iu', $url);
		}
		
		function geturlimage($url){
			
				if(valid_URL($url)){
					//call Google PageSpeed Insights API
					$googlePagespeedData = file_get_contents("https://www.googleapis.com/pagespeedonline/v2/runPagespeed?url=$url&screenshot=true");
					$googlePagespeedData = json_decode($googlePagespeedData, true);
					$screenshot = $googlePagespeedData['screenshot']['data'];
					$screenshot = str_replace(array('_','-'),array('/','+'),$screenshot); 
					if($screenshot != ""){
					return "<img style='width:100%;' src=\"data:image/jpeg;base64,".$screenshot."\" />";
					}else{
						return "";
					}
				}else{
					return "";
				}
		}

?>