<?php
error_reporting(E_ALL);

// FUNCTIONS
function get_string_between($string, $start, $end){
    $string = " ".$string;
    $ini = strpos($string,$start);
    if ($ini == 0) return "";
    $ini += strlen($start);
    $len = strpos($string,$end,$ini) - $ini;
    return substr($string,$ini,$len);
}
// VARIABLES DEFINITION

 
$url = "https://play.google.com/store/devices/details?id=nexus_4_16gb";
//$url = "https://play.google.com/store/devices/details?id=nexus_4_bumper_black";

$seven = $_GET['seven']; 
if ($seven == "1") {
	$url = "https://play.google.com/store/devices/details?id=nexus_7_32gb_hspa";
}

$referer = "http://www.google.com/";
$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8";
 
include("proxyList.php");

$timeout = 10;
$nation = $_GET['nation'];

/* $proxylist['canada'] = "70.38.90.211:1080";
$proxylist['germany'] = "217.79.189.229:8080"; */
//$proxylist['spain'] = "149.62.176.182:8080"; 
$proxylist['usa'] = "168.63.152.29:8888";   

			//$header = "'Content-Type: text/html; charset=shift-jis";


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //echo "<script>alert('no proxy')</script>";
        curl_setopt($ch, CURLOPT_PROXY, $proxylist[$nation]);

        if($nation == "australiaa") {
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS4); 
        } else if ($nation == "canadaa") {
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5); 
        } else {
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
//header('Accept-Language: en-US;');
                    if($_GET['html'])
                    {   
                        echo "showing html";
                        echo $html;
                    }

                    //check if proper country
                //  if($nation != "usa" || $nation != "uk")
                   echo "<br><br>real: "  .   $real_country = get_string_between($html, '\42https://play.google.com/intl/', '/about/play-terms.html\42') . " .";
                //  else
                //      $real_country = get_string_between($html, "https://play.google.com/intl/", "/about/giftcards");
                   echo "<br><br>no error ok!";

                  echo $available = strpos($html, "banner-content");

	} else {
				echo "Error: ". $result['ERR'];
		 
	}



?>
