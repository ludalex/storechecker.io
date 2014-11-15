<?php

error_reporting(0);
ini_set("log_errors", 0);

function get_string_between($string, $start, $end){
    $string = " ".$string;
    $ini = strpos($string,$start);
    if ($ini == 0) return "";
    $ini += strlen($start);
    $len = strpos($string,$end,$ini) - $ini;
    return substr($string,$ini,$len);
}

function getStatus($type, $nation, $proxy, $url, $referer, $agent, $header, $timeout, $display, $soldout_phrase) {

$country_codes = array(
"usa" => "en-US_us", 
"uk" => "en-GB_uk",
"spain" => "es_es",
"germany" => "de_de",
"france" => "fr_fr",
"japan" => "ja_jp",
"australia" => "en-GB_au",
"canada" => "en-GB_ca",
);

    if(!$type) { $type = "n4_16gb"; }
	
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	if($nation != "france" || $proxy != NULL) {
    		curl_setopt($ch, CURLOPT_PROXY, $proxy);
		if($nation == "australiaa") {
			curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS4); 
		} else if ($nation == "canadaa") {
			curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5); 
		} else {
    		curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
		}
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
		
		//check if proper country
		if($nation != "usa")
			$real_country = get_string_between($html, "https://play.google.com/intl/", "/about/play-terms.html");
		else
			$real_country = get_string_between($html, "https://play.google.com/intl/", "/about/giftcards");
				
		if($real_country != $country_codes[$nation]) {

			return "Error (P): reload >";
			
		} else {
	
			$outof = strpos($html, "hardware-price-description");

			if ($outof) { 
				return "<b>Out of stock.</b>"; } 
			else {
				$unavailable = strpos($html, "hardware-unavailable");

				if($unavailable) {
					return "<b>Not available for sale yet.</b>"; 
				} else {
					$instock = strpos($html, "hardware-price");
					if ($instock) {
						return "<b>IN STOCK!</b>"; 
					} else {
						return "Error (C): reload >";
					}
				}
			}
		}
	} else {
	
			return "Error: reload >";
		 
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

$soldout_phrase = "hardware-sold-out";

// CACHING

$page_id = 'nation='. $nation . '&type=' . $type . '.temp';
//$timeout = 300;
$path = "cached/".$page_id;

// if(!file_exists("cache/"))
// mkdir("cache/");

// if(file_exists($path) and filemtime($path) + $timeout > time()) {
	// $result = readfile($path);
	// echo ".";
	// if($result)
		// exit();
// }

set_time_limit(0);
ob_start();

// EXECUTION

$status = getStatus($type,$nation,$proxylist[$nation],$url[$type],$referer,$agent,1,30,0,$soldout_phrase);

echo $status;

$output = ob_get_flush();

if($status == "<b>IN STOCK!</b>" || $status ==  "<b>Out of stock.</b>" ) { 

	$fp = fopen($path, "w");
	fwrite($fp, $output, strlen($output));
	fclose($fp);

	}
?>
