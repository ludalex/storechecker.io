<?php

chdir(dirname(__FILE__));
error_reporting(E_ALL);
ini_set("log_errors", 0);

function get_string_between($string, $start, $end) {

    $string = " ".$string;
    $ini = strpos($string,$start);
    if ($ini == 0) return "";
    $ini += strlen($start);
    $len = strpos($string,$end,$ini) - $ini;
    return substr($string,$ini,$len);

}

function delete_est_status_file($nation, $type) {

	$page_id = 'nation='. $nation . '&type=' . $type . '.temp';
	$path = "cached/est/".$page_id;
	
	if(file_exists($path))  unlink($path); 

}

function cacheStatus($type, $nation, $proxy, $url, $referer, $agent, $header, $soldout_phrase) {

	$country_codes = array(
		"usa" => "en-US_us", 
		"uk" => "en-GB_uk",
		"spain" => "es_es",
		"germany" => "de_de",
		"france" => "fr_fr",
		"japan" => "ja_jp",
		"australia" => "en-GB_au",
		"canada" => "en-GB_ca",
		"it" => "it_it",
		"netherlands" => "nl-NL_nl"
	);

    if(!$type) { $type = "n6_64gb_blue"; }
	
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	if($proxy != NULL) {

    		curl_setopt($ch, CURLOPT_PROXY, $proxy);
		if($nation == "australiaa") {
			curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS4); 
		} else if ($nation == "canadaa") {
			curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5); 
		} else {
    		curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
		}

	}

    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
    curl_setopt($ch, CURLOPT_REFERER, $referer);
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
 
    $result['EXE'] = curl_exec($ch);
    $result['INF'] = curl_getinfo($ch);
    $result['ERR'] = curl_error($ch);
 
    curl_close($ch);
	
	if( $country == "japan" ) header('Content-type: text/html; charset=utf-8');

    if (empty($result['ERR'])) {
		
		$html = $result['EXE']; 
		

		$real_country = get_string_between($html, '\42https://play.google.com/intl/', '/about/play-terms.html\42');

		
		if($real_country != $country_codes[$nation]) {

			return "ERROR (countrycoderecognition)";
			
		} else {

			$availability = get_string_between($html, 'data-availability="', '"');

			if (!$availability) return "ERROR (parsing)";

			switch($availability) {

				case 'AVAILABLE':
				case 'COMING_SOON':
				case 'TEMPORARILY_OUT_OF_STOCK':

					$est = get_string_between($html, '<div class="shipping-note contains-text-link">', '<a class');
					$page_id = 'nation='. $nation . '&type=' . $type . '.temp';
					$path = "cached/est/".$page_id;
					$fp = fopen($path, "w");
					fwrite($fp, $est, strlen($est));
					fclose($fp);

					return $availability;

				break;

				case 'UNAVAILABLE_COUNTRY':
					delete_est_status_file($nation, $type);
					return $availability;
				break;

				case 'UNAVAILABLE':
					delete_est_status_file($nation, $type);
					return $availability;
				break;

				default:
					delete_est_status_file($nation, $type);
					return $availability;
				break;
			}
		}
		
	} else {

		return "ERROR (curl)";

	} 

}	
	
		// 	$available = strpos($html, "wishlist-text");


		// 	if (!$available) { 

		// 		return "<b>Not available for sale.</b>";
				
		// 	} else {

		// 		$outof = strpos($html, "not-available"); // out of stock

		// 		if($outof) {

		// 			$page_id = 'nation='. $nation . '&type=' . $type . '.temp';
		// 			$path = "cached/est/".$page_id;
					
		// 			if(file_exists($path))  unlink($path); 
					
		// 			return "<b>Out of stock.</b>"; 

		// 		} else {
		// 			$instock = strpos($html, "price buy");

		// 			if ($instock) {
					
		// 				$est = get_string_between($html, '<div class="shipping-note contains-text-link">', '<a class');
		// 				$est = "[ " . $est . " ]";
						
		// 				$page_id = 'nation='. $nation . '&type=' . $type . '.temp';
		// 				$path = "cached/est/".$page_id;
						
		// 				$fp = fopen($path, "w");
		// 				fwrite($fp, $est, strlen($est));
		// 				fclose($fp);
						
		// 				return "<b>IN STOCK!</b>"; 
						
		// 			} else {

		// 				return "Error (C): reload >";

		// 			}
		// 		}
		// 	}
		// }
		// } else {
		
		// 		return "Error: reload >";
			 
		// }


// VARIABLES DEFINITION


if(!$type) { $type = "n4_16gb"; }

$url['n5_16gb_black'] = "https://play.google.com/store/devices/details?id=nexus_5_black_16gb";
$url['n5_32gb_black'] = "https://play.google.com/store/devices/details?id=nexus_5_black_32gb";

$url['n5_16gb_white'] = "https://play.google.com/store/devices/details?id=nexus_5_white_16gb";
$url['n5_32gb_white'] = "https://play.google.com/store/devices/details?id=nexus_5_white_32gb";

$url['n6_32gb_blue'] = "https://play.google.com/store/devices/details?id=nexus_6_blue_32gb";
$url['n6_32gb_white'] = "https://play.google.com/store/devices/details?id=nexus_6_white_32gb";
$url['n6_64gb_blue'] = "https://play.google.com/store/devices/details?id=nexus_6_blue_64gb";
$url['n6_64gb_white'] = "https://play.google.com/store/devices/details?id=nexus_6_white_64gb";


// $url['n4_16gb'] = "https://play.google.com/store/devices/details?id=nexus_4_16gb";
// $url['n4_8gb'] = "https://play.google.com/store/devices/details?id=nexus_4_8gb";
// $url['n4_black_bumper'] = "https://play.google.com/store/devices/details?id=nexus_4_bumper_black";
// $url['orb'] = "https://play.google.com/store/devices/details/Nexus_4_Wireless_Charger?id=nexus_4_wireless_charger&feature=accessories";


// $url['n7_32gb'] = "https://play.google.com/store/devices/details?id=nexus_7_32gb";
// $url['n7_16gb'] = "https://play.google.com/store/devices/details?id=nexus_7_16gb";

// $url['n7_32gb_lte_2013'] = "https://play.google.com/store/devices/details?id=nexus_7_32gb_2013_lte";
// $url['n7_32gb_2013'] = "https://play.google.com/store/devices/details?id=nexus_7_32gb_2013";
// $url['n7_16gb_2013'] = "https://play.google.com/store/devices/details?id=nexus_7_16gb_2013";

// $url['n10_32gb'] = "https://play.google.com/store/devices/details?id=nexus_10_32gb";
// $url['n10_16gb'] = "https://play.google.com/store/devices/details?id=nexus_10_16gb";


$referer = "http://www.google.com/";
$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8";


$soldout_phrase = "hardware-sold-out";

include("proxyList.php");


	$country_text = array(

    		"usa", 
    		"uk",
    		"spain",
    		"germany",
			"france",
    		"japan",
   // 		"australia",
			"canada",
	//		"it",
			"netherlands"

		);
			 
	if ($argv[1])  { $country_text = array($argv[1]); }
	//parse_str(implode('&', array_slice($argv, 1)), $_GET);

		
	$descr = array(

		"n5_32gb_black",
		"n5_16gb_black",
		"n5_32gb_white",
		"n5_16gb_white",

		'n6_32gb_blue',
		'n6_32gb_white',
		'n6_64gb_blue',
		'n6_64gb_white'

	);

// CACHING

foreach($country_text as $country) {
	
	foreach($descr as $type) {

		if($country == "usa") {
			$url['n7_32gb_3g'] = "https://play.google.com/store/devices/details?id=nexus_7_32gb_hspa_att";
		} else {
			$url['n7_32gb_3g'] = "https://play.google.com/store/devices/details?id=nexus_7_32gb_hspa";
		}
		
		$status = cacheStatus($type,$country,$proxylist[$country],$url[$type],$referer,$agent,1,$soldout_phrase);
		
		$page_id = 'nation='. $country . '&type=' . $type . '.temp';
		$path = "cached/".$page_id;
		
		if( strstr($status, "curl") ) { 
		
			echo " > Connection error with $type in $country. Retrying.\n";
			$status = cacheStatus($type,$country,$proxylist[$country],$url[$type],$referer,$agent,1,$soldout_phrase);
			
			if( strstr($status, "ERROR") ) 
				echo "ERROR with $type in $country. ($status) \n";
			else
				echo "Success with $type in $country. ($status) \n";
			
				$fp = fopen($path, "w");
				fwrite($fp, $status, strlen($status));
				fclose($fp); 

		} else {
		
			echo "Success with $type in $country. ($status) \n";
			
			$fp = fopen($path, "w");
			fwrite($fp, $status, strlen($status));
			fclose($fp);
			
		}
		
	}
}	 

		// mail("ludalex@gmail.com", "yup", "cron working for loader.", "From:$aemail\r\nContent-Type: text/html; charset=iso-8859-1"); 

?>
