<?php
$url='https://bitpay.com/api/rates';
$json=json_decode( file_get_contents( $url ) );
$dollar=$btc=0;

foreach( $json as $obj ){
    if( $obj->code=='USD' )$btc=$obj->rate;
    if( $obj->code=='ETH' )$eth=$obj->rate;
}

$res = ($usd/$eth)*$btc; // work on this code

echo "1 bitcoin=\$" . $btc . "USD<br />";
$dollar=1 / $btc;
echo "10 dollars = " . round( $dollar * 10,8 )."BTC";
echo $res;
?>