<?php 

error_reporting(E_ALL);
chdir(dirname(__FILE__));

function sendMail($nation) {
	
	$list = file('emails.txt'); 
	
	//$email = "ludalex@gmail.com";
	$subject = "Nexus 4 16gb Play Store IN STOCK - !";
	$body = "Looks like in $nation they have Nexus 4 16gb in stock. Double check here: <a href=\"ludalex.soupwhale.com/n4checker/\">ludalex.soupwhale.com/n4checker/</a><br><br>For contacting/bug reporting write to <a href=\"mailto:ludalex@gmail.com\">ludalex@gmail.com</a>";
	
	foreach($list as $email) 
	{ 
		mail($email, $subject, $body, "From:$aemail\r\nContent-Type: text/html; charset=iso-8859-1"); 
	} 

}

function getStatusForMail($nation, $proxy, $url, $referer, $agent, $header, $timeout, $display, $soldout_phrase) {

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

    if (empty($result['ERR'])) {
		
		$html = $result['EXE']; 
		$outof = strpos($html, $soldout_phrase);

		if ($outof) { 
			echo "No mail to be sent for $nation.<br>"; } 
		else {

			$my_file = $nation . '.sent';
			if (file_exists($my_file)) {

				echo "Mail already sent for $nation. \n";

			}
			else { 
				$sent = sendMail($nation);
				echo "Mail sent for $nation. \n";
				//$my_file = '/www/n4checker/' . $nation . '.txt';
				$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);


			}

		}

	} else {
			echo "Error: ". $result['ERR'] . "<br>";
		 
	}
}

// VARIABLES DEFINITION

$url = "https://play.google.com/store/devices/details?id=nexus_4_16gb";

$referer = "http://www.google.com/";
$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8";

include("proxyList.php");

$soldout_phrase['usa'] = "Sold out";
$soldout_phrase['uk'] = "Sold out";
$soldout_phrase['spain'] = "Agotado";
$soldout_phrase['germany'] = "Ausverkauft";
$soldout_phrase['france'] = "hardware-sold-out";

// EXECUTION

getStatusForMail("usa",$proxylist['usa'],$url,$referer,$agent,1,30,0,$soldout_phrase['usa']);
getStatusForMail("uk",$proxylist['uk'],$url,$referer,$agent,1,30,0,$soldout_phrase['uk']);
getStatusForMail("spain",$proxylist['spain'],$url,$referer,$agent,1,30,0,$soldout_phrase['spain']);
getStatusForMail("germany",$proxylist['germany'],$url,$referer,$agent,1,30,0,$soldout_phrase['germany']);
getStatusForMail("france",$proxylist['france'],$url,$referer,$agent,1,30,0,$soldout_phrase['france']);

//mail("ludalex@gmail.com", "yup", "cron working.", "From:$aemail\r\nContent-Type: text/html; charset=iso-8859-1"); 


?>