<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->


<?php 
error_reporting(E_ERROR);
ini_set("log_errors", 0);

$descr = array(

		"n5_32gb_black" => "Nexus 5 32gb Black",
		"n5_16gb_black" => "Nexus 5 16gb Black",
		"n5_32gb_white" => "Nexus 5 32gb White",
		"n5_16gb_white" => "Nexus 5 16gb White",
		'n5_16gb_red' => "Nexus 5 16gb Red",
		'n5_32gb_red' => "Nexus 5 32gb Red",

		'n6_32gb_blue' => "Nexus 6 32gb Blue",
		'n6_32gb_white' => "Nexus 6 32gb White",
		'n6_64gb_blue' => "Nexus 6 64gb Blue",
		'n6_64gb_white' => "Nexus 6 64gb White",

		'n9_black_32gb_lte' => "Nexus 9 Black 32gb LTE",
		'n9_black_32gb_wifi' => "Nexus 9 Black 32gb Wi-Fi",
		'n9_white_32gb_wifi' => "Nexus 9 White 32gb Wi-Fi",
		'n9_black_16gb_wifi' => "Nexus 9 Black 16gb Wi-Fi",
		'n9_white_16gb_wifi' => "Nexus 9 White 16gb Wi-Fi",
 
		'n_player' => "Nexus Player"

	);

$country_text = array(
		"USA" => "USA",
		"UK" => "United Kingdom",
		"Spain" => "Spain",
		"Germany" => "Germany",
		"France" => "France",
		"Italy" => "Italy",
		"Japan" => "Japan",
		"Australia" => "Australia",
		"Canada" => "Canada",
		"Netherlands" => "Netherlands",
		"India" => "India"
	);

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

$AVAILABLE_TYPES = array_fill_keys(array_keys($descr), 1);
$AVAILABLE_COUNTRIES = array_fill_keys(array_keys($country_text), 1);

$type = $_GET['type'];
$country = $_GET['country'];
if(!$type) { $type = "n6_32gb_blue"; }

if (!$AVAILABLE_TYPES[$type] && $type) {
	header("HTTP/1.0 404 Not Found");
	die('Go back you weirdo.');
}

if (!$AVAILABLE_COUNTRIES[$country] && $country) {
	header("HTTP/1.0 404 Not Found");
	die('Go back you weirdo.');
}

?>
<head>
<meta charset="utf-8" />
<title>Store Checker — Worldwide Google Play Store devices availability</title>
<meta name="description" content="A website to check the worldwide availability of the Google Play Store devices and accessories." />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link REL="SHORTCUT ICON" HREF="favicon.ico">

<meta property="og:image" content="http://storechecker.io/images/google-play-logo-BIG.png" />
<meta property="og:url" content="http://storechecker.io/" />
<meta property="og:title" content="Store Checker" />
<meta property="og:description" content="A website to check the worldwide availability of the Google Play Store devices and accessories." />
<meta property="og:type" content="website" /> 

<meta name="google-site-verification" content="QSZ7q2HQJm_vnAWw6w6f6sPovux1JNk8avTcpuLYTQc" />

<script>
	var Checker = Checker || {};

	Checker.types = new Array();
	<?php foreach($descr as $type_code => $type_name) { ?>
		var s = '<?= $type_code ?>'.toString()
		Checker.types.push(s);
	<?php }  ?>


	Checker.countries = new Array();
	<?php foreach($country_text as $country_code => $country_name) { ?>
		var s = '<?= $country_code ?>'.toString()
		Checker.countries.push(s);
	<?php }  ?>

	Checker.mode;
	<?php if($country) { ?>
		Checker.mode = 'oneCountryAllDevices';
		Checker.currentCountry = '<?= $country ?>';

	<?php } else { ?>
		Checker.mode = 'allCountriesOneDevice';
		Checker.currentType = '<?= $type ?>';
	<? } ?>

	Checker.autoRefresh = true;

</script>

<link rel="stylesheet" type="text/css" href="css/foundation.min.css">
<link rel="stylesheet" type="text/css" href="css/normalize.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">

<link href='http://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

<script src="/js/moment.min.js"></script>
<script src="/js/vendor/modernizr.js"></script>
<script src="/js/vendor/jquery.js"></script>
<script src="/js/vendor/fastclick.js"></script>
<script src="/js/foundation.min.js"></script>

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="js/foundation.min.js"></script> -->

<style type="text/css">
	body {
		font-family: Roboto, "Helvetica Neue", Helvetica, Arial, sans-serif;
		-webkit-font-smoothing: antialiased;
		font-weight: 300;
		background: #F9F9F9;
	}

	/* Cirlce Styles */
	.circlenumber {
	  background-color: #fff;
	  border-radius: 50%;
	  border: 1px solid rgba(11, 79, 105, 0.2);
	  color: #0b4f69;
	  position: relative;
	  height: 35px;
	  width: 35px;
	  text-align: center;
	  padding-top: 8px;
	}
	.circlenumber h3 {
	  line-height: 1px;
	  color: #0b4f69;
	  position: relative;
	  text-align: center;
	  font-weight: normal;
	}

	/* Circle Style One Mobile */   
	@media only screen and (min-width: 0) and (max-width: 40em) {
	  .step-by-step-style-one .circlenumber {
	    width: 80px;
	    height: 80px;
	    left: -12px;
	    margin: 30px auto 15px auto;
	  }
	  .step-by-step-style-one .circlenumber h3 {
	    padding-top: 35px;
	    font-size: 20px;
	  }
	}

	/* Circle Style One Medium and Large */   

	@media only screen and (min-width: 40em) {
	  .step-by-step-style-one .path-item {
	    padding-left: 55px;
	    position: relative;
	  }
	  .step-by-step-style-one .path-item .circlenumber {
	    width: 40px;
	    height: 40px;
	    position: absolute;
	    margin-top: 6px;
	    left: 0;
	  }
	  .step-by-step-style-one .path-item .circlenumber h3 {
	    padding-top: 15px;
	    font-size: 16px;
	  }
	}

	/* Circle Style Two Mobile */   

	@media only screen and (min-width: 40em) {
	  .step-by-step-style-two .circlenumber {
	    width: 80px;
	    height: 80px;
	    left: -12px;
	    margin: 30px auto 15px auto;
	  }
	  .step-by-step-style-two .circlenumber h3 {
	    padding-top: 35px;
	    font-size: 20px;
	  }
	}

	/* Circle Style Two Medium and Large */   

	@media only screen and (min-width: 0) and (max-width: 40em) {
	  .step-by-step-style-two .path-item {
	    padding-left: 55px;
	    position: relative;
	  }
	  .step-by-step-style-two .path-item .circlenumber {
	    width: 40px;
	    height: 40px;
	    position: absolute;
	    margin-top: 6px;
	    left: 0;
	  }
	  .step-by-step-style-two .path-item .circlenumber h3 {
	    padding-top: 15px;
	    font-size: 16px;
	  }



	}

	.status-line {
		line-height: 3.3;
	}

	.statuses {
		-ie-box-shadow: 0px 1px 4px 0px rgba(0,0,0,0.2);
		-moz-box-shadow: 0px 1px 4px 0px rgba(0,0,0,0.2);
		-webkit-box-shadow: 0px 1px 4px 0px rgba(0,0,0,0.2);
		box-shadow: 0px 1px 4px 0px rgba(0,0,0,0.2);
	}

	.status-row {
		padding: 10px;
		line-height: 33px;

		margin-top: 7px;
				background-color: #fff;

	}
	.status-row:not(:first-child) {
		border-top: 1px solid #eee;
	}

	.full-width {
	   	width: 100%;
	   	margin-left: auto;
	   	margin-right: auto;
	   	max-width: initial;
	}

	.banner {
		background-image: url('images/material.jpg');
		background-position-y: -539.3px;
		height: 100px;
		background-size: cover;
		background-repeat: no-repeat;
		background-color: #5fb0e4;
		background-repeat: no-repeat;
		background-position: center center;
		background-size: cover;
		text-align: center;
		padding-top: 18px;

	}	

	.material {
		-ie-box-shadow: 0px 1px 4px 0px rgba(0,0,0,0.2);
		-moz-box-shadow: 0px 1px 4px 0px rgba(0,0,0,0.2);
		-webkit-box-shadow: 0px 1px 4px 0px rgba(0,0,0,0.2);
		box-shadow: 0px 1px 4px 0px rgba(0,0,0,0.2);
	}

	.selector {
		padding: 15px;
		background-color: #fff;
		//text-align: center;
		-ie-box-shadow: 0px 1px 4px 0px rgba(0,0,0,0.2);
		-moz-box-shadow: 0px 1px 4px 0px rgba(0,0,0,0.2);
		-webkit-box-shadow: 0px 1px 4px 0px rgba(0,0,0,0.2);
		box-shadow: 0px 1px 4px 0px rgba(0,0,0,0.2);
		margin-top: 10px;
		margin-bottom: 10px;
		font-weight: 400;
		font-size: 14px;

	}

	.selector .button {
		margin-bottom: 0px;
		border-bottom: 1px solid #eee;
		font-size: 14px;
		font-family: Roboto, 'Helvetica Neue', Helvetica, Arial, sans-serif;
		padding-left: 21px;
		background-color: transparent;
	}

	.disqus {
		background-color: #fff;
		-ie-box-shadow: 0px 1px 4px 0px rgba(0,0,0,0.2);
		-moz-box-shadow: 0px 1px 4px 0px rgba(0,0,0,0.2);
		-webkit-box-shadow: 0px 1px 4px 0px rgba(0,0,0,0.2);
		box-shadow: 0px 1px 4px 0px rgba(0,0,0,0.2);
	}

	.contain-to-grid {
		background: #fff;
	}
	.top-bar {
		background: #fff !important;
		color: #eee !important;
		-webkit-box-shadow: 0px 7px 5px -5px rgba(0,0,0,0.26);
		-moz-box-shadow: 0px 7px 5px -5px rgba(0,0,0,0.26);
		box-shadow: 0px 7px 5px -5px rgba(0,0,0,0.26);
	}
	.top-bar-section .has-form {
		background: #fff;
	}
	.top-bar .name h1 a {
		color: #333;
	}

	.top-bar-section ul li:not(.has-form) > a {
		background: #fff !important;
		color: #333 !important;
	}
	.top-bar-section ul li:hover:not(.has-form)>a{
		background: #333 !important;
		color: #fff !important;
	}	
	.top-bar .toggle-topbar.menu-icon a {
		background: #fff !important;
		color: #333 !important;
	}
	.top-bar .toggle-topbar.menu-icon a span::after {
		-webkit-box-shadow: 0 0px 0 1px #000,0 7px 0 1px #000,0 14px 0 1px #0A0A0A;
		box-shadow: 0 0px 0 1px #000,0 7px 0 1px #000,0 14px 0 1px #0A0A0A;
	}
	.top-bar.expanded .title-area {
		background: #fff !important;
		color: #eee !important;
	}
	.top-bar-section>ul>.divider, .top-bar-section>ul>[role="separator"] {
		border-right: solid 1px #eee;
	}
	.footer {
		position: fixed;
		bottom: 0;
		background-color: #fff;
		height: 30px;
		font-size: 14px; 
		//padding: 1px; 
		padding-top: 3px;
		border-top: 1px solid #eee;
	}

	.est {
		max-width: 300px;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
		top: 6px;
	}

	.label.nostatus {
		background-color: #FFF;
		border: 1px solid #E7E4E4;
		color: #5F5F5F;
	}

	@media only screen and (max-width: 40em) { 
		.est {
			display: none !important;
		}

		.selector {
			font-size: 11px;
			padding-left: 0px;
			text-align: center;
		}
		.selector .button {
			font-size: 11px;
		}

		.banner {
			padding-top: 35px;
		}

		#checking-text {
			display: none !important;
		}

	} /* max-width 640px, mobile-only styles, use when QAing mobile issues */
	.tooltip {
		max-width: 900px;
	}
	.has-tip {
		border-bottom: none;
	}
	.has-tip:hover {
		border-bottom: none;
	}
</style>

</head>

<body>

<div class="contain-to-grid">
	<nav class="top-bar" data-topbar role="navigation">
	  <ul class="title-area">
	    <li class="name">
	      <h1> <a href="http://storechecker.io/"> <img src="images/google-play-logo.png" border="0" style="margin-top: -4px; margin-right: 8px; height: 26px;"> Store Checker</a></h1>
	    </li>
	     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
	    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
	  </ul>

	  <section class="top-bar-section">
	    <!-- Right Nav Section -->
	    <ul class="right">
   	    	<li><a href="#disqus_thread" data-disqus-identifier="maintalk">Discussion</a></li>
   	    	<li class="divider"></li>
			<li class="has-form">
			  <a href="#" class="button disabled"><i class="fa fa-android"></i> &nbsp; Get the app (soon!)</a>
			</li>
	    </ul>

	    <!-- Left Nav Section -->
	    <ul class="left">
	    </ul>
	  </section>
	</nav>
</div>


<div class="row full-width banner" style="line-height: 22px;">
	<h3 style="color: #FFFFFF; font-weight: 300;  margin: 0; " ><b>All new</b> Play Store checker.</h3>

	<h6 style="color: #FFFFFF; font-weight: 300;  margin: 0; " class="show-for-medium-up">Be the first to know when a device is available for purchase in your country. Formerly <i>n4checker.com</i></h6>
</div>



<section class="main" style="margin: 0px 0;">
  


	<div class="row selector">

		<div class="medium-9 small-12 columns">


		<span id="checking-text" style="display: inline;">Checking</span> 


			<button href="#" data-dropdown="drop1" aria-controls="drop1" aria-expanded="false" class="button small secondary dropdown"><?= ((!$country) ? $descr[$type] : "all devices") ?></button>
			<ul id="drop1" data-dropdown-content class="f-dropdown" aria-hidden="true" tabindex="-1">
			<? foreach($descr as $type_code => $type_name) { ?>
				<li><a href="?type=<?= $type_code ?>"><?= $type_name ?></a></li>
			<? } ?>
			</ul>



		in        
			
			<button href="#" data-dropdown="drop2" aria-controls="drop2" aria-expanded="false" class="button small secondary dropdown"><?= (($country_text[$country]) ? $country_text[$country] : "all countries") ?></button><br>
			<ul id="drop2" data-dropdown-content class="f-dropdown" aria-hidden="true" tabindex="-1">
			<? foreach($country_text as $country_code => $country_name) { ?>
				<li><a href="?country=<?= $country_code ?>"><?= $country_name ?></a></li>
			<? } ?>
			</ul>


		</div>

		<div class="small-3 columns hide-for-small-only" style="padding-top: 14px;">

			<div class="row">

				<div class="medium-8 columns text-right">
					<span><i>auto refresh</i></span>
				</div>

				<div class="medium-4 columns">
					<div class="switch tiny">
					  <input id="auto-refresh-switch" type="checkbox" checked>
					  <label for="auto-refresh-switch"></label>
					</div>
				</div>

			</div>

		</div>


  	</div>

  	<div class="row statuses">

		    <div class="large-12 columns">


				<?php if($country) { ?>


					<?php 
						foreach($descr as $type_code => $type_name) {
					?>

						    <div class="row status-row" data-device="<?= $type_code ?>" data-url="<?= $url[$type_code] ?>">

								  <div class="small-1 columns show-for-medium-up text-center" style="padding-left: 0px;">
								  		<i id="status-icon" class=""></i>
								  </div>
								  <div class="medium-4 small-6 columns" onClick="window.open('<?= $url[$type_code] ?>','_blank')" style="cursor: pointer;">
						       	  		<?= $type_name ?>
								  </div>

								  <div class="medium-7 small-6 columns text-center small-only-text-left">
						       	  		<span id="status-label"></span>
										<span id="est-label" class="secondary radius label est" style="display: none;"></span>
										<div style="display: inline; position: relative; top: 2px; float: right;">
											<i id="<?= $type_code ?>-tip" style="color: #eee;" class="fa fa-info-circle fa-inverse has-tip tip-top" data-tooltip aria-haspopup="true" title=""></i>
								  		</div>
								  </div>
							</div>


					<?php
						}
					?>

				<?php } else { ?>


					<?php 
						foreach($country_text as $country_code => $country_name) {
					?>

							<div class="row status-row" data-country="<?= $country_code ?>" data-url="<?= $url[$type] ?>">

								  <div class="small-1 columns show-for-medium-up text-center" style="padding-left: 0px;">
								  	<i id="status-icon" class="circlenumber" ></i>
								  </div>
								  <div class="medium-4 small-6 columns" onClick="window.open('<?= $url[$type] ?>','_blank')" style="cursor: pointer;">
						       	  		<?= $country_name ?>
								  </div>

								  <div class="medium-7 small-6 columns text-center small-only-text-left">
						       	  		<span id="status-label"></span>
										<span id="est-label" class="secondary radius label est" style="display: none;"></span>
										<div style="display: inline; position: relative; top: 2px; float: right;">
											<i id="<?= $country_code ?>-tip" style="color: #eee;" class="fa fa-info-circle fa-inverse has-tip tip-top" data-tooltip aria-haspopup="true" title=""></i>
								  		</div>
								  </div>
							</div>    

					<?php
						}
					?>

				<?php } ?>

			</div>

	</div>

</section>

<div class="row material" style="padding: 10px; margin-top: 15px; background-color: #fff;">
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- store checker responsive -->
	<ins class="adsbygoogle"
	     style="display:block"
	     data-ad-client="ca-pub-2725480770465067"
	     data-ad-slot="2420389423"
	     data-ad-format="auto"></ins>
	<script>
	(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
</div>

<hr>



<div class="row">

	<div class="large-12 columns disqus">

		<div class="row" style="border-bottom: 1px solid #eee; padding: 3px 15px;">

		  <h3 style="font-weight: 300;">Discussion</h3>

		</div>

	 	<div class="row">

			<div id="disqus_thread" style="padding: 15px;"></div>

		</div>

	</div>

</div>



<section class="footer row full-width" style="">
	<div class="small-6 columns">
	by <a href="http://twitter.com/ldx00">ldx <span style="padding-top: 2px;"> <i class="fa fa-twitter"></i></a> <a href="#" id="at"><i class="fa fa-at"></i></a </span>
	</div>
 
<div class="small-6 columns" style="padding-top: 2px; text-align: right;">
	<div class="addthis_sharing_toolbox" data-url="http://storechecker.io"></div>	
	</div>

</footer>


</body>

<script type="text/javascript">
function mailto (s)	
{
	document.location.href =  "mailto:" + unCryptMail(s);
}

function unCryptMail (r)  
{
	r = unescape (r);
	var l = r.length;
	var o = "";
	for (i = 0; i < l; i++)
	{
		o += String.fromCharCode (r.charCodeAt (i) - 1);
	}
	return o; 
}

function cryptMail (r) 
{
	var l = r.length;
	var o = "";
	for (i = 0; i < l; i++)
	{
		o += String.fromCharCode (r.charCodeAt (i) + 1);
	}
	return escape (o);
}

Checker.load = function( firstLoad ) {

	if ( Checker.mode == 'allCountriesOneDevice' ) {

		var XHRs = [];

		Checker.countries.forEach( function( country ) {

			XHRs.push( Checker.loadStatus('byCountry', Checker.currentType, country, firstLoad ) );

		})

		$.when.apply($, XHRs ).done( function() { console.log('complete') })
	}

	if ( Checker.mode == 'oneCountryAllDevices' ) {

		Checker.types.forEach( function( type ) {

				Checker.loadStatus(	'byType', type, Checker.currentCountry, firstLoad );
		})
	}

}

Checker.lastStatus = {}
Checker.alertMeOn = {}

mock = (window.location.pathname.indexOf('indexx.php') ? "mock-" : "")

Checker.loadStatus = function loadStatus(loadMode, type, country, firstLoad) {

	var defer = $.Deferred();

	var $icon = ( loadMode == "byType" ? $('[data-device="'+type+'"] #status-icon') : $('[data-country="'+country+'"] #status-icon') )
	var $label = ( loadMode == "byType" ? $('[data-device="'+type+'"] #status-label') : $('[data-country="'+country+'"] #status-label') )
	var $est = ( loadMode == "byType" ? $('[data-device="'+type+'"] #est-label') : $('[data-country="'+country+'"] #est-label') )
	var $url = ( loadMode == "byType" ? $('[data-device="'+type+'"]').attr('data-url') : $('[data-country="'+country+'"]').attr('data-url') )

	var tip_id = ( loadMode == "byType" ? type+'-tip' : country+'-tip' )

	$icon.removeClass().addClass('circlenumber fa fa-circle-o-notch fa-spin');

	if ( $icon ) {

		$.get("cached/"+mock+"nation="+country+"&type="+type+".temp")
		.done(function(data, status, xhr){

			switch(data) {
				
				case 'AVAILABLE':

					$icon.removeClass().addClass("circlenumber fa fa-check");
					$label.removeClass().addClass("success radius label").html('Available')
					$.get("cached/est/nation="+country+"&type="+type+".temp", function(data) {
						$est.show().html(data)
					})

					Foundation.libs.tooltip.getTip( $("#" + tip_id ) ).remove()
					$("#" + tip_id ).attr("title", 'Fetched ' + moment( xhr.getResponseHeader('Last-Modified') ).fromNow() )
					Foundation.libs.tooltip.create( $("#" + tip_id ) )

					if( !firstLoad ) {
						if( Checker.lastStatus[ type+'-'+country ] !== "AVAILABLE" ) {
							window.open( $url, '_blank' )
							console.log("ALERT ALERT ALERT!!!")
							timer=window.setInterval(function() {
								document.title = document.title == "!!! OMG !!!" ? "!! OMG !!" : "!!! OMG !!!";
							}, 1000);
						}
					}

				break;


				case 'COMING_SOON':
					$icon.removeClass().addClass("circlenumber fa fa-clock-o");
					$label.removeClass().addClass("warning radius label").html('Coming soon')
					$est.hide();

					Foundation.libs.tooltip.getTip( $("#" + tip_id ) ).remove()
					$("#" + tip_id ).attr("title", 'Fetched ' + moment( xhr.getResponseHeader('Last-Modified') ).fromNow() )
					Foundation.libs.tooltip.create( $("#" + tip_id ) )

				break;


				case 'TEMPORARILY_OUT_OF_STOCK':

					$icon.removeClass().addClass("circlenumber fa fa-remove");
					$label.removeClass().addClass("alert radius label").html('Out of stock');
					$est.hide();
					

					Foundation.libs.tooltip.getTip( $("#" + tip_id ) ).remove()
					$("#" + tip_id ).attr("title", 'Fetched ' + moment( xhr.getResponseHeader('Last-Modified') ).fromNow() )
					Foundation.libs.tooltip.create( $("#" + tip_id ) )

				break;


				case 'UNAVAILABLE_COUNTRY':

					$icon.removeClass().addClass("circlenumber fa fa-remove");
					$label.removeClass().addClass("alert radius label").html('Not available for this country')
					$est.hide();

					Foundation.libs.tooltip.getTip( $("#" + tip_id ) ).remove()
					$("#" + tip_id ).attr("title", 'Fetched ' + moment( xhr.getResponseHeader('Last-Modified') ).fromNow() )
					Foundation.libs.tooltip.create( $("#" + tip_id ) )

				break;


				default:

					if ( data.indexOf('ERROR') || data.indexOf('Error') ) {
						$icon.removeClass().addClass("circlenumber fa fa-warning");
						$label.removeClass().addClass("nostatus radius label").html('Proxy down')
						$est.hide();
					
						$("span[data-selector="+ tip_id +"]").html( 'Temporarily unable to retrieve device status.' );


					} else {
						$icon.removeClass().addClass("circlenumber fa fa-question");
						$label.removeClass().addClass("nostatus radius label").html('Uknown Message')
						$est.hide();

					}

				break;

			}

			Checker.lastStatus[ type+'-'+country ] = data;

			defer.resolve();

		})
		.fail(function() {

			$icon.removeClass().addClass("circlenumber fa fa-warning");
			$label.removeClass().addClass("nostatus radius label").html('Proxy down');
			$("span[data-selector="+ tip_id +"]").html( 'Temporarily unable to retrieve device status.' );

			defer.resolve();

		});
	};

	return defer.promise();
}
	

$(document).on('ready', function() {


	Checker.load(true);

	$(this).foundation();

	setInterval( function() {
		if( Checker.autoRefresh )
			Checker.load(false);
	}, 6000);

	$("#auto-refresh-switch").on('click', function() {		
		Checker.autoRefresh = (Checker.autoRefresh ? false : true);
	});

	$("#at").on('click', function() {
		console.log('aaa')
		window.location.href =  "mailto:" + unCryptMail('mvebmfyAhnbjm/dpn');	
	})
});
	

</script>

<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-1840667-4']); 
	_gaq.push(['_trackPageview']);
	(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
</script>


<script type="text/javascript">
    var disqus_shortname = 'n4checker';
    var disqus_identifier = 'maintalk';
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
    (function () {
		var s = document.createElement('script'); s.async = true;
		s.type = 'text/javascript';
		s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
		(document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
	}());
</script>

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-54608fa308c7090d" async="async"></script>
