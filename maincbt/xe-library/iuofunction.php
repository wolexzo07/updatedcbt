<?php

function x_shortTitle($text){
	$text = @trim($text);
	if(isset($text) && !empty($text)){
		if(strlen($text) <= 60){
			return $text;
		}else{
			return substr($text,0,60)."...";
		}
	}else{
		return "No text";
	}
}

function pagelinker($slug){
	$slug = @trim($slug);
	if(isset($slug) && !empty($slug)){
		$slug = x_clean($slug);
		if(x_count("pagelinker","page_slug='$slug' LIMIT 1") > 0){
			foreach(x_select("0","pagelinker","page_slug='$slug'","1","id") as $key){
				$id = $key["id"];
				$pagename = $key["page_name"];
				$pageslug = $key["page_slug"];
				$link = $key["link"];
				
				/**if(filter_var($link, FILTER_VALIDATE_URL) === FALSE) {
					$link = "#";
				}else{
					$link = $key["link"];
				}***/
				if(x_urlchecker($link)){
					$linked = $key["link"];
					$link = "<script type='text/javascript'>window.location='$linked';</script>";
				}else{
					$link = "<script>alert('Not found');</script>";
				}
			}
			
			$message = $link ; // Return a valid url
		}else{
			$message = "<script>alert('Not found');</script>"; // Return # for invalid links
		}
	}else{
		$message = "<script>alert('Not found');</script>"; // Return # for invalid links
	}
	return $message;
}

function x_urlchecker($uri){
    if(preg_match( '/^(http|https):\\/\\/[a-z0-9_]+([\\-\\.]{1}[a-z_0-9]+)*\\.[_a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i' ,$uri)){
      //return $uri;
	  return true;
    }
    else{
        return false;
    }
}



// You can use this function, but its will return false if website offline.

  function isValidUrl($url) {
    $url = parse_url($url);
    if (!isset($url["host"])) return false;
    return !(gethostbyname($url["host"]) == $url["host"]);
}



?>