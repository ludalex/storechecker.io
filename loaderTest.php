<?php

function getStatus($type, $nation, $proxy, $url, $referer, $agent, $header, $timeout, $display, $soldout_phrase) {

    if(!$type) { $type = "n4_16gb"; }
	
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	if($nation != "usa" || $proxy != NULL) {
    		curl_setopt($ch, CURLOPT_PROXY, $proxy);
    		curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
	}

    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_REFERER, $referer);
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
 
    $result['EXE'] = curl_exec($ch);
    $result['INF'] = curl_getinfo($ch);
    $result['ERR'] = curl_error($ch);
 
    curl_close($ch);

    // if($nation == "japan" && ($type== "n4_8gb" || $type == "n4_16gb")) { 
    //	return "Not yet available for sale."; 
    // }

    if (empty($result['ERR'])) {
		
		$html = $result['EXE']; 
		$outof = strpos($html, $soldout_phrase);

		if ($outof) { 
			return "<b>Out of stock.</b>"; } 
		else {
			$unavailable = strpos($html, "hardware-unavailable");

			if($unavailable) {
				return "<b>Not available for sale yet.</b>"; 
			} else {
				return "<b>IN STOCK!</b>"; }
		}
	} else {
			return "Error: try reloading.";
		 
	}
}

// VARIABLES DEFINITION

$type = $_GET['type'];
$nation = $_GET['nation'];
$display = $_GET['display'];
$timeout = $_GET['timeout'];

if(!$type) { $type = "n4_16gb"; }

$url['n4_16gb'] = "https://play.google.com/store/devices/details?id=nexus_4_16gb";
$url['n4_8gb'] = "https://play.google.com/store/devices/details?id=nexus_4_8gb";
$url['n4_black_bumper'] = "https://play.google.com/store/devices/details?id=nexus_4_bumper_black";


if($nation == "usa") {
	$url['n7_32gb_3g'] = "https://play.google.com/store/devices/details?id=nexus_7_32gb_hspa_att";
} else {
	$url['n7_32gb_3g'] = "https://play.google.com/store/devices/details?id=nexus_7_32gb_hspa";
	}

$url['n7_32gb'] = "https://play.google.com/store/devices/details?id=nexus_7_32gb";
$url['n7_16gb'] = "https://play.google.com/store/devices/details?id=nexus_7_16gb";

$url['n10_32gb'] = "https://play.google.com/store/devices/details?id=nexus_10_32gb";
$url['n10_16gb'] = "https://play.google.com/store/devices/details?id=nexus_10_16gb";


$referer = "http://www.google.com/";
$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8";

include("proxyList.php");

$soldout_phrase['usa'] = "Sold out";
$soldout_phrase['uk'] = "Sold out";
$soldout_phrase['spain'] = "hardware-sold-out";
$soldout_phrase['germany'] = "Ausverkauft";
$soldout_phrase['france'] = "hardware-sold-out";
$soldout_phrase['japan'] = "hardware-sold-out";
$soldout_phrase['australia'] = "hardware-sold-out";
$soldout_phrase['canada'] = "hardware-sold-out";

// CACHING

$page_id = 'nation='. $nation . '&timeout=' . $timeout . '&type=' . $type . '.temp';
$timeout = 120;
$path = "cache/".$page_id;

if(!file_exists("cache/"))
mkdir("cache/");

if(file_exists($path) and filemtime($path) + $timeout > time()) {
	$result = readfile($path);
	if($result)
		exit();
}

set_time_limit(0);
ob_start();

// EXECUTION

echo $status = getStatus($type,$nation,$proxylist[$nation],$url[$type],$referer,$agent,1,$timeout,$display,$soldout_phrase[$nation]);

$output = ob_get_flush();

if($status != "Error: try reloading.") { 

	$fp = fopen($path, "w");
	fwrite($fp, $output, strlen($output));
	fclose($fp);

	}
?>
