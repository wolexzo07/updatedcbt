<?php

// Validating Bitcoin address
	function x_validatebtc($value){
		$regex = "/^[13][a-km-zA-HJ-NP-Z1-9]{25,34}$/";
		$regex1 = "/^\b((bc|tb)(0([ac-hj-np-z02-9]{39}|[ac-hj-np-z02-9]{59})|1[ac-hj-np-z02-9]{8,87})|([13]|[mn2])[a-km-zA-HJ-NP-Z1-9]{25,39})\b$/"; // Bech32 | legacy | Testnet
		if(preg_match($regex,$value) || preg_match($regex1,$value)){
			return true;
		}
			return false;
	}

// Getting single Content from a table using userid

 function x_getcontent($table,$column,$userid){
	 return x_getsingle("SELECT $column FROM $table WHERE id='$userid' LIMIT 1","$table WHERE id='$userid' LIMIT 1",$column);
 }

// Just Balance alone

 function x_getbalance($column,$userid){
	 return x_getsingle("SELECT $column FROM createusers WHERE id='$userid' LIMIT 1","createusers WHERE id='$userid' LIMIT 1",$column);
 }
 
 // Get Current Rates
 
  function x_getrates($column){
	 return x_getsingle("SELECT $column FROM rates WHERE id='1'","rates WHERE id='1'",$column);
 }
 
 // Converting usd to btc 
 function x_usd2btc($usd){
	$json =  xget("https://blockchain.info/tobtc?currency=USD&value=$usd");
	$decode = json_decode($json);
	return $decode;
 }
 
 //Converting BTC to USD with formatting
 function x_btc2usd($btc){
	 $btc = @trim($btc);
	 $json =  xget("https://blockchain.info/ticker");
	 $decode = json_decode($json,true);
	 $onebtc = $decode["USD"]["last"];
	 $btc = $onebtc * $btc;
	 return number_format($btc,2);
	 
 }
 
  //Converting BTC to USD no formatting
 function x_btc2usdnf($btc){
	 $btc = @trim($btc);
	 $json =  xget("https://blockchain.info/ticker");
	 $decode = json_decode($json,true);
	 $onebtc = $decode["USD"]["last"];
	 $btc = $onebtc * $btc;
	 return round($btc,2);
	 
 }
 
 // Getting current Btc price in usd
 
 function x_btcprice($currency,$format){
	$json =  xget("https://blockchain.info/ticker");
	$decode = json_decode($json,true);
	if($format == 1){
		return strtoupper($currency)." ". number_format($decode[$currency]["last"],2);
	}
		return number_format($decode[$currency]["last"],2);
 }

?>