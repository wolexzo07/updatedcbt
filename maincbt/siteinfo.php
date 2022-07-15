<?php
if(x_count("siteinfom","id='1'") > 0){
	foreach(x_select("0","siteinfom","id='1'","1","id") as $site){
		$siteid = $site["id"];
		
		$siteaddress = $site["company_address"];
		
		$sitename = $site["site_name"];
		$sitetitle = $site["site_title"];
		
		$metaname = $site["site_metaname"];
		$metades = $site["site_metades"];
		
		$siteurl = $site["site_url"];
		$siteemail = $site["site_email"];
		
		$sitelogo = $site["site_logo"];
		$sitelogo2 = $site["site_logo2"];
		$favico = $site["site_favico"];
		
		
		$chat = $site["site_chatbot"];
		$sitemode = $site["site_mode"];
		
		$front_header = $site["front_header"];
		$front_des = $site["front_des"];
		
		$footer_note = $site["footer_note"];
		
		$site_front_image = $site["site_front_image"];
		$site_front_image2 = $site["site_front_image2"];
		$site_front_image3 = $site["site_front_image3"];
		$site_front_bg = $site["site_front_bg"];
		
	}
}else{
		$siteaddress = "";
		$sitename = "";
		$sitetitle = "";
		
		$metaname = "";
		$metades = "";
		
		$siteurl = "";
		$siteemail = "";
		
		$sitelogo = "";
		$sitelogo2 = "";
		$favico = "";
		
		
		$chat = "";
		$sitemode = "";
		
		$front_header = "";
		$front_des = "";
		
		$footer_note = "";
		
		$site_front_image = "";
		$site_front_bg = "";
		
		finish("0","Database Server Misconfiguration ! Your application will not function properly. Kindly contact the software developer");
}
?>