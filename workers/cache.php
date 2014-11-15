<?php

chdir(dirname(__FILE__));
error_reporting(E_ALL);
ini_set("log_errors", 0);
set_time_limit(360);

$types = array(

	"n5_32gb_black",
	"n5_16gb_black",
	"n5_32gb_white",
	"n5_16gb_white",
	'n5_16gb_red',
	'n5_32gb_red',

	'n6_32gb_blue',
	'n6_32gb_white',
	'n6_64gb_blue',
	'n6_64gb_white',

	'n9_black_32gb_lte',
	'n9_black_32gb_wifi',
	'n9_white_32gb_wifi',
	'n9_black_16gb_wifi',
	'n9_white_16gb_wifi',

	'n_player'

);

$country_to_fullCode = array(
	"USA" => ["en-US_us"], 
	"UK" => ["en-GB_uk"],
	"Spain" => ["es_es"],
	"Germany" => ["de_de"],
	"France" => ["fr_fr", "fr-FR_fr"],
	"Japan" => ["ja_jp"],
	"Australia" => ["en-GB_au"],
	"Canada" => ["en-GB_ca"],
	"Italy" => ["it_it"],
	"Netherlands" => ["nl-NL_nl"],
	"India" => ["en-GB_in"],
	"Austria" => [],
	"Denmark" => [],
	"Sweden" => [],
	"China" => []
);	

		 
if ($argv[1])  { $country_argv = array($argv[1]); }
//parse_str(implode('&', array_slice($argv, 1)), $_GET);

$country =  trim($country_argv[0]);
print_r($country_to_fullCode[$country]);

	

// DB init
$db = new SQLite3('../db/storechecker.db');
if (!$db) { 
	echo ($error);
}


$statement = $db->prepare('SELECT * FROM proxies WHERE country LIKE :country AND type != "socks4/5" ORDER BY speed DESC;');
$statement->bindValue(':country', $country);
$result = $statement->execute(); 
$proxies = array(); 
$i = 0; 

while($res = $result->fetchArray(SQLITE3_ASSOC)){ 

	if(!isset($res['ip'])) continue; 

	$proxies[$i]['ip'] = $res['ip']; 
	$proxies[$i]['port'] = $res['port']; 
	$proxies[$i]['country'] = $res['country']; 
	$proxies[$i]['type'] = $res['type']; 

	$i++; 

} 

// print_r($proxies); 


function get_string_between($string, $start, $end) {

    $string = " ".$string;
    $ini = strpos($string,$start);
    if ($ini == 0) return "";
    $ini += strlen($start);
    $len = strpos($string,$end,$ini) - $ini;
    return substr($string,$ini,$len);

}

function delete_est_status_file($country, $type) {

	$page_id = 'nation='. $country . '&type=' . $type . '.temp';
	$path = "../cached/est/".$page_id;
	
	if(file_exists($path))  unlink($path); 

}

function cacheStatus($type, $country, $proxy, $url, $referer, $agent, $header, $country_to_fullCode) {

	echo "Trying " . $proxy['ip'] . ":" . $proxy['port'] . " - " . $proxy['type'] . " - " . $proxy['country'] . "\n";

	$full_proxy = $proxy['ip'] . ":" . $proxy['port'];

    //if(!$type) { $type = "n6_64gb_blue"; }
	
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	if($proxy != NULL) {

    	curl_setopt($ch, CURLOPT_PROXY, $full_proxy);
		
		if( strstr($proxy['type'], "socks") ) {
			curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS4); 
		} 
		else {
    		curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
		}

	}

    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); // Connection
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Curl function
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

		// print_r($country_to_fullCode[$country]);
		// echo "\n";
		echo "Recieved country: " . $real_country . "\n";

	
		if( !in_array( $real_country,  $country_to_fullCode[$country]) ) {

			return "ERROR (countrycoderecognition)";
			
		} else {

			$availability = get_string_between($html, 'data-availability="', '"');

			if (!$availability) return "ERROR (parsing)";

			switch($availability) {

				case 'AVAILABLE':

					$est = get_string_between($html, '<div class="shipping-note contains-text-link">', '<a class');
					$page_id = 'nation='. $country . '&type=' . $type . '.temp';
					$path = "../cached/est/".$page_id;
					$fp = fopen($path, "w");
					fwrite($fp, $est, strlen($est));
					fclose($fp);

					return $availability;

				break;

				case 'COMING_SOON':
				case 'TEMPORARILY_OUT_OF_STOCK':
				case 'UNAVAILABLE_COUNTRY':

					delete_est_status_file($country, $type);
					return $availability;

				break;

				case 'UNAVAILABLE':

					delete_est_status_file($country, $type);
					return $availability;

				break;

				default:

					delete_est_status_file($country, $type);
					return $availability;
					
				break;
			}
		}
		
	} else {

		echo $result['ERR'] . "\n";

		return "ERROR (curl)";

	} 

}	
	
		


// DEVICE URLs
$url['n5_16gb_black'] = "https://play.google.com/store/devices/details?id=nexus_5_black_16gb";
$url['n5_32gb_black'] = "https://play.google.com/store/devices/details?id=nexus_5_black_32gb";
$url['n5_16gb_white'] = "https://play.google.com/store/devices/details?id=nexus_5_white_16gb";
$url['n5_32gb_white'] = "https://play.google.com/store/devices/details?id=nexus_5_white_32gb";
$url['n5_16gb_red'] = "https://play.google.com/store/devices/details?id=nexus_5_red_16gb";
$url['n5_32gb_red'] = "https://play.google.com/store/devices/details?id=nexus_5_red_32gb";

$url['n6_32gb_blue'] = "https://play.google.com/store/devices/details?id=nexus_6_blue_32gb";
$url['n6_32gb_white'] = "https://play.google.com/store/devices/details?id=nexus_6_white_32gb";
$url['n6_64gb_blue'] = "https://play.google.com/store/devices/details?id=nexus_6_blue_64gb";
$url['n6_64gb_white'] = "https://play.google.com/store/devices/details?id=nexus_6_white_64gb";

$url['n9_black_32gb_lte'] = "https://play.google.com/store/devices/details?id=nexus_9_black_32gb_lte";
$url['n9_black_32gb_wifi'] = "https://play.google.com/store/devices/details?id=nexus_9_black_32gb_wifi";
$url['n9_white_32gb_wifi'] = "https://play.google.com/store/devices/details?id=nexus_9_white_32gb_wifi";
$url['n9_black_16gb_wifi'] = "https://play.google.com/store/devices/details?id=nexus_9_black_16gb_wifi";
$url['n9_white_16gb_wifi'] = "https://play.google.com/store/devices/details?id=nexus_9_white_16gb_wifi";

$url['n_player'] = "https://play.google.com/store/devices/details?id=nexus_player";



$referer = "http://www.google.com/";
$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8";



// CACHING
foreach($types as $type) {

	$page_id = 'nation='. $country . '&type=' . $type . '.temp';
	$path = "../cached/".$page_id;

	$status = "ERROR";
	$proxiesIndex = 0;

	// Until status is not error
	while ( strstr($status, "ERROR") ) {

		if($country == "Netherlands")
			$status = cacheStatus( $type, $country, null, $url[$type], $referer, $agent, 1, $country_to_fullCode );
		else
			$status = cacheStatus( $type, $country, $proxies[$proxiesIndex], $url[$type], $referer, $agent, 1, $country_to_fullCode );

		if( strstr($status, "ERROR") ) {

			echo "ERROR with $type in $country. ($status) \n\n";

		} else {

			echo "Success with $type in $country. ($status) \n\n";
		
			$fp = fopen($path, "w");
			fwrite($fp, $status, strlen($status));
			fclose($fp); 
		}

		// Try next proxy
		$proxiesIndex++;

		// Out of proxies? Breeak.
		if( ($proxiesIndex >= count($proxies)) ) break;

	}
	
}


// mail("ludalex@gmail.com", "yup", "cron working for loader.", "From:$aemail\r\nContent-Type: text/html; charset=iso-8859-1"); 

?>
