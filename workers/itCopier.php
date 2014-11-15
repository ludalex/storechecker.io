<?php

chdir(dirname(__FILE__));

	$descr = array(
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
	
	foreach ($descr as $type) {
		
		   $file = 'http://ldx.zapto.org/storechecker-node/cached/nation=Italy&type=' . $type .'.temp';
		   $newfile = '../cached/nation=Italy&type=' . $type .'.temp';
		   
		       if ( copy($file, $newfile) ) {
					echo "Copy success!";
				}else{
					echo "Copy failed.";
				}
	}
	
	foreach ($descr as $type) {
		
		   $file = 'http://ldx.zapto.org/storechecker-node/cached/est/nation=Italy&type=' . $type .'.temp';
		   $newfile = '../cached/est/nation=Italy&type=' . $type .'.temp';

		   // Check existance
		   $ch = curl_init($file);
		   curl_setopt($ch, CURLOPT_NOBODY, true);
		   curl_exec($ch);
		   $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		   // $retcode > 400 -> not found, $retcode = 200, found.
		   curl_close($ch);

		   if($retcode = 200)
		   {

		       if ( copy($file, $newfile) ) {
					echo "Copy success!";
				}else{
					echo "Copy failed.";
				}
			}
	}
				
?>