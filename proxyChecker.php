<?php
error_reporting(E_ALL);
// VARIABLES DEFINITION

$url = "https://play.google.com/store/devices/details?id=nexus_4_16gb";

$seven = $_GET['seven'];
if ($seven == "1") {
	$url = "https://play.google.com/store/devices/details?id=nexus_7_16gb";
}

$referer = "http://www.google.com/";
$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8";

include("proxylist.php");

$soldout_phrase['usa'] = "Sold out";
$soldout_phrase['uk'] = "Sold out";
$soldout_phrase['spain'] = "Agotado";
$soldout_phrase['germany'] = "Ausverkauft";

$timeout = 20;
$nation = $_GET['nation'];


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	if($nation != "usa" || $proxy != NULL) {
    		curl_setopt($ch, CURLOPT_PROXY, $proxylist[$nation]);
    		curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
	}

    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_REFERER, $referer);
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
 
    $result['EXE'] = curl_exec($ch);
    $result['INF'] = curl_getinfo($ch);
    $result['ERR'] = curl_error($ch);
 
    curl_close($ch);

    if (empty($result['ERR'])) {
		
				$html = $result['EXE']; 

				echo $html; 

	} else {
				echo "Error: ". $result['ERR'];
		 
	}



?>