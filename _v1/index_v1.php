<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php 
error_reporting(E_ERROR);
ini_set("log_errors", 0);

	$descr = array(

			"n5_32gb_black" => "Nexus 5 32gb Black",
			"n5_16gb_black" => "Nexus 5 16gb Black",

			"n5_32gb_white" => "Nexus 5 32gb White",
			"n5_16gb_white" => "Nexus 5 16gb White",

    		"n4_16gb" => "Nexus 4 16gb",
    		"n4_8gb" => "Nexus 4 8gb",
			"n4_black_bumper" => "Nexus 4 Black Bumper",
			"orb" => "Nexus 4 Wireless Charger",

			"n7_32gb_lte_2013" => "Nexus 7 2013 32gb LTE",
			"n7_32gb_2013" => "Nexus 7 2013 32gb", 
			"n7_16gb_2013" => "Nexus 7 2013 16gb",

    		"n7_32gb_3g" => "Nexus 7 32gb HSPA+",
    		"n7_32gb" => "Nexus 7 32gb", 
    		"n7_16gb" => "Nexus 7 16gb",
    		"n10_32gb" => "Nexus 10 32gb",
    		"n10_16gb" => "Nexus 10 16gb"
		);

	$country_text = array(
    		"usa" => "American",
    		"uk" => "British",
    		"spain" => "Spanish",
    		"germany" => "German",
    		"france" => "French",
    		"it" => "Italian",
    		"japan" => "Japanese",
    		//"australia" => "Australian",
    		"canada" => "Canadian"
		);

	$AVAILABLE_TYPES = array_fill_keys(array_keys($descr), 1);
	$AVAILABLE_COUNTRIES = array_fill_keys(array_keys($country_text), 1);
	
	$type=$_GET['type'];
	$country=$_GET['country'];
	if(!$type) { $type = "n5_32gb_black"; }
	
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
<meta http-equiv="refresh" content="600" >
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Google Nexus Devices World Availability Checker</title>
<meta name="description" content="A website to check the  worldwide availability of the Google Nexus devices." />
<link REL="SHORTCUT ICON" HREF="favicon.ico">

<meta property="og:image" content="http://www.n4checker.com/images/google-play-logo-BIG.png" />
<meta property="og:url" content="http://www.n4checker.com/" />
<meta property="og:title" content="Google Nexus Devices World Availability Checker" />
<meta property="og:description" content="A website to check the worldwide availability of the Google Nexus devices." />
<meta property="og:type" content="website" /> 

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<style type="text/css">
body {
background-color: #535353;
}
#gplayinstall {
background: url('/images/gplayinstall.png') no-repeat;
height: 24px; 
width: 173px;
}

#gplayinstall:hover  {
background: url('/images/gplayinstallhover.png') no-repeat;
}

#mainbox 
{
  position: relative;
  width: 735px;;
  background: #e1e1e1;
  -moz-border-radius: 4px;
  border-radius: 4px;
  padding: 2em 1.5em;
  color: rgba(0,0,0, .8);
  text-shadow: 0 1px 0 #d6d6d6;
  line-height: 1.5;
  margin: 60px auto;
}


/*#mainbox:before, #mainbox:after 
{
  z-index: -1; 
  position: absolute; 
  content: "";
  bottom: 15px;
  left: 10px;
  width: 50%; 
  top: 80%;
  max-width:300px;
  background: rgba(0, 0, 0, 0.7); 
  -webkit-box-shadow: 0 15px 10px rgba(0,0,0, 0.7);   
  -moz-box-shadow: 0 15px 10px rgba(0, 0, 0, 0.7);
  box-shadow: 0 15px 10px rgba(0, 0, 0, 0.7);
  -webkit-transform: rotate(-3deg);    
  -moz-transform: rotate(-3deg);   
  -o-transform: rotate(-3deg);
  -ms-transform: rotate(-3deg);
  transform: rotate(-3deg);
}

#mainbox:after 
{
  -webkit-transform: rotate(3deg);
  -moz-transform: rotate(3deg);
  -o-transform: rotate(3deg);
  -ms-transform: rotate(3deg);
  transform: rotate(3deg);
  right: 10px;
  left: auto;
}	*/

#mailbox {
 color: #333333;
 cursor: pointer;
 text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
 font: 11px/18px 'Helvetica Neue',Arial,sans-serif;
 height: 20px;
 width: 170px;
 background-image: url('images/mailme.png');
 background-repeat: no-repeat;
 float: left;
 padding-top: 1px;
 padding-left: 27px;
 text-align: left;
}
#mailbox img:hover{
   -moz-box-shadow:    inset 0 0 10px #000000;
   -webkit-box-shadow: inset 0 0 10px #000000;
   box-shadow:         inset 0 0 10px #000000;
}

a.maillink:link,a.maillink:visited, a.maillink:active, a.maillink:hover {
text-decoration: none;
color: #333333; 
font-weight: bold;
}

#refresh,#refreshct img{
	width: 36px;
	height: 28px; 
	display: inline;
	float: right;
	margin: -17px 10px;
}
#refresh img:hover{
-webkit-animation: spin 0.7s infinite linear;
-moz-animation: spin 0.7s infinite linear;
-o-animation: spin 0.7s infinite linear;
-ms-animation: spin 0.7s infinite linear;
}
@-webkit-keyframes spin {
0% { -webkit-transform: rotate(0deg);}
100% { -webkit-transform: rotate(-360deg);}
}
@-moz-keyframes spin {
0% { -moz-transform: rotate(0deg);}
100% { -moz-transform: rotate(-360deg);}
}
@-o-keyframes spin {
0% { -o-transform: rotate(0deg);}
100% { -o-transform: rotate(-360deg);}
}
@-ms-keyframes spin {
0% { -ms-transform: rotate(0deg);}
100% { -ms-transform: rotate(-360deg);}
}

#refreshct img:hover{
-webkit-animation: spin 0.7s infinite linear;
-moz-animation: spin 0.7s infinite linear;
-o-animation: spin 0.7s infinite linear;
-ms-animation: spin 0.7s infinite linear;
}
@-webkit-keyframes spin {
0% { -webkit-transform: rotate(0deg);}
100% { -webkit-transform: rotate(-360deg);}
}
@-moz-keyframes spin {
0% { -moz-transform: rotate(0deg);}
100% { -moz-transform: rotate(-360deg);}
}
@-o-keyframes spin {
0% { -o-transform: rotate(0deg);}
100% { -o-transform: rotate(-360deg);}
}
@-ms-keyframes spin {
0% { -ms-transform: rotate(0deg);}
100% { -ms-transform: rotate(-360deg);}
}
#asd {
margin-top: -7px; 
height:250px;
}
</style>
<script type="text/javascript">
/**
*	CryptMail
*
*	Simple Javascript Email-Address crypter / uncrypter.
*	(C) 2005 KLITSCHE.DE // DIRK ALBAN ADLER
*	http://cryptmail.klitsche.org
*	
*	CryptMail is published under the CC-GNU LGPL
*	http://creativecommons.org/licenses/LGPL/2.1/
*
*	It is provided as is. No warrenties. No support.	
*/
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
	
	
	function reLoad(type,country,flag){  
	
			var loader_gfx = '<span style="margin-left: 10px; display:inline;"><img src="images/ajax-loader.gif" alt="Fetching status.."></span> ';
			if(flag) {
				$("#"+country).html(loader_gfx);
			} else {
				$("#"+type).html(loader_gfx);
			}
			if(country == "france" || country == "spain" || country == "australia") {
				$.get("cached/nation=" + country + "&type=" + type + ".temp", function(data) { 
					if(flag) {
						$("#"+country).html(data);
					} else {
						$("#"+type).html(data);

					}
				});
			} else {
				$.get("cached/nation=" + country + "&type=" + type + ".temp", function(data) {
					if(flag) {
						$("#"+country).html(data);
					} else {
						$("#"+type).html(data);

					}
				});
			}
	
	}
	$(document).ready(function() {
	
	
		
	function loadStatus(type){  

	var loader_gfx = '<span style="margin-left: 10px; display:inline;"><img src="images/ajax-loader.gif" alt="Fetching status.."></span>';
	$("#usa, #uk, #spain, #germany, #france, #japan, #australia, #canada").html(loader_gfx);


		$.get("cached/nation=usa&type=" + type + ".temp", function(data) {
		  $('#usa').html(data);
		});
		$.get("cached/est/nation=usa&type=" + type + ".temp", function(data) {
		  $('#usa_est').html(data);
		});
		
		$.get("cached/nation=uk&type=" + type + ".temp", function(data) {
		  $('#uk').html(data);
		});
		$.get("cached/est/nation=uk&type=" + type + ".temp", function(data) {
		  $('#uk_est').html(data);
		});
		
		$.get("cached/nation=spain&type=" + type + ".temp", function(data) {
		  $('#spain').html(data);
		});	
		$.get("cached/est/nation=spain&type=" + type + ".temp", function(data) {
		  $('#spain_est').html(data);
		});	
		
		$.get("cached/nation=germany&type=" + type + ".temp", function(data) {
		  $('#germany').html(data);
		});
		$.get("cached/est/nation=germany&type=" + type + ".temp", function(data) {
		  $('#germany_est').html(data);
		});
		
		$.get("cached/nation=france&type=" + type + ".temp", function(data) {
		  $('#france').html(data);
		});	
		$.get("cached/est/nation=france&type=" + type + ".temp", function(data) {
		  $('#france_est').html(data);
		});	
		
		
		$.get("cached/nation=it&type=" + type + ".temp", function(data) {
		  $('#it').html(data);
		});	
		$.get("cached/est/nation=it&type=" + type + ".temp", function(data) {
		  $('#it_est').html(data);
		});	
		
		
		
		$.get("cached/nation=japan&type=" + type + ".temp", function(data) {
		  $('#japan').html(data);
		});
		$.get("cached/est/nation=japan&type=" + type + ".temp", function(data) {
		  $('#japan_est').html(data);
		});			
		
		$.get("cached/nation=australia&type=" + type + ".temp", function(data) {
		  $('#australia').html(data);
		});	
		$.get("cached/est/nation=australia&type=" + type + ".temp", function(data) {
		  $('#australia_est').html(data);
		});	
		
		$.get("cached/nation=canada&type=" + type + ".temp", function(data) {
		  $('#canada').html(data);
		});	
		$.get("cached/est/nation=canada&type=" + type + ".temp", function(data) {
		  $('#canada_est').html(data);
		});	
		
	
	}	

	function loadStatusByCountry(country){  

		var loader_gfx = '<span style="margin-left: 10px; display:inline;"><img src="images/ajax-loader.gif" alt="Fetching status.."></span>';
		$("#n4_16gb, #n4_8gb, #n4_black_bumper, #n7_32gb_3g, #n7_32gb, #n7_16gb, #n10_32gb, #n10_16gb, #orb, #n5_32gb_black, #n5_16gb_black").html(loader_gfx);


		$.get("cached/nation="+country+"&type=n5_32gb_black.temp", function(data) {
		  $('#n5_32gb_black').html(data);
		  // if(data == "Error: reload >" || data == "Error parsing data: do a refresh >")  { $("span#reload_n4_16gb").html('[ <a href="javascript:reLoad(\"n4_16gb\", \"' + country + '\");"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ]'); }
		});
		$.get("cached/est/nation="+country+"&type=n5_32gb_black.temp", function(data) {
		  $('#n5_32gb_black').html(data);
		  // if(data == "Error: reload >" || data == "Error parsing data: do a refresh >")  { $("span#reload_n4_16gb").html('[ <a href="javascript:reLoad(\"n4_16gb\", \"' + country + '\");"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ]'); }
		});

		$.get("cached/nation="+country+"&type=n5_16gb_black.temp", function(data) {
		  $('#n5_16gb_black').html(data);
		  // if(data == "Error: reload >" || data == "Error parsing data: do a refresh >")  { $("span#reload_n4_16gb").html('[ <a href="javascript:reLoad(\"n4_16gb\", \"' + country + '\");"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ]'); }
		});
		$.get("cached/est/nation="+country+"&type=n5_16gb_black.temp", function(data) {
		  $('#n5_16gb_black').html(data);
		  // if(data == "Error: reload >" || data == "Error parsing data: do a refresh >")  { $("span#reload_n4_16gb").html('[ <a href="javascript:reLoad(\"n4_16gb\", \"' + country + '\");"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ]'); }
		});



		$.get("cached/nation="+country+"&type=n5_32gb_white.temp", function(data) {
		  $('#n5_32gb_white').html(data);
		  // if(data == "Error: reload >" || data == "Error parsing data: do a refresh >")  { $("span#reload_n4_16gb").html('[ <a href="javascript:reLoad(\"n4_16gb\", \"' + country + '\");"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ]'); }
		});
		$.get("cached/est/nation="+country+"&type=n5_32gb_white.temp", function(data) {
		  $('#n5_32gb_white').html(data);
		  // if(data == "Error: reload >" || data == "Error parsing data: do a refresh >")  { $("span#reload_n4_16gb").html('[ <a href="javascript:reLoad(\"n4_16gb\", \"' + country + '\");"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ]'); }
		});

		$.get("cached/nation="+country+"&type=n5_16gb_white.temp", function(data) {
		  $('#n5_16gb_white').html(data);
		  // if(data == "Error: reload >" || data == "Error parsing data: do a refresh >")  { $("span#reload_n4_16gb").html('[ <a href="javascript:reLoad(\"n4_16gb\", \"' + country + '\");"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ]'); }
		});
		$.get("cached/est/nation="+country+"&type=n5_16gb_white.temp", function(data) {
		  $('#n5_16gb_white').html(data);
		  // if(data == "Error: reload >" || data == "Error parsing data: do a refresh >")  { $("span#reload_n4_16gb").html('[ <a href="javascript:reLoad(\"n4_16gb\", \"' + country + '\");"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ]'); }
		});




		$.get("cached/nation="+country+"&type=n4_16gb.temp", function(data) {
		  $('#n4_16gb').html(data);
		  // if(data == "Error: reload >" || data == "Error parsing data: do a refresh >")  { $("span#reload_n4_16gb").html('[ <a href="javascript:reLoad(\"n4_16gb\", \"' + country + '\");"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ]'); }
		});
		$.get("cached/est/nation="+country+"&type=n4_16gb.temp", function(data) {
		  $('#n4_16gb_est').html(data);
		  // if(data == "Error: reload >" || data == "Error parsing data: do a refresh >")  { $("span#reload_n4_16gb").html('[ <a href="javascript:reLoad(\"n4_16gb\", \"' + country + '\");"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ]'); }
		});
		
		$.get("cached/nation="+country+"&type=n4_8gb.temp", function(data) {
		  $('#n4_8gb').html(data);
		   //if(data == "Error: reload >")  { $("span#reload_n4_8gb").html('[ <a href="javascript:reLoad( \'n4_8gb \', \' ' + country + ' \');"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ]'); }
		});
		$.get("cached/est/nation="+country+"&type=n4_8gb.temp", function(data) {
		  $('#n4_8gb_est').html(data);
		  // if(data == "Error: reload >" || data == "Error parsing data: do a refresh >")  { $("span#reload_n4_16gb").html('[ <a href="javascript:reLoad(\"n4_16gb\", \"' + country + '\");"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ]'); }
		});		
		
		$.get("cached/nation="+country+"&type=n4_black_bumper.temp", function(data) {
		  $('#n4_black_bumper').html(data);
		});
		$.get("cached/est/nation="+country+"&type=n4_black_bumper.temp", function(data) {
		  $('#n4_black_bumper_est').html(data);
		  // if(data == "Error: reload >" || data == "Error parsing data: do a refresh >")  { $("span#reload_n4_16gb").html('[ <a href="javascript:reLoad(\"n4_16gb\", \"' + country + '\");"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ]'); }
		});



		$.get("cached/nation="+country+"&type=n7_32gb_lte_2013.temp", function(data) {
		  $('#n7_32gb_lte_2013').html(data);
		});
		$.get("cached/est/nation="+country+"&type=n7_32gb_lte_2013.temp", function(data) {
		  $('#n7_32gb_lte_2013_est').html(data);
		});

		
		$.get("cached/nation="+country+"&type=n7_32gb_2013.temp", function(data) {
		  $('#n7_32gb_2013').html(data);
		});
		$.get("cached/est/nation="+country+"&type=n7_32gb_2013.temp", function(data) {
		  $('#n7_32gb_2013_est').html(data);
		});
		
		$.get("cached/nation="+country+"&type=n7_16gb_2013.temp", function(data) {
		  $('#n7_16gb_2013').html(data);
		});
		$.get("cached/est/nation="+country+"&type=n7_16gb_2013.temp", function(data) {
		  $('#n7_16gb_2013_est').html(data);
		});

		
		$.get("cached/nation="+country+"&type=n7_32gb_3g.temp", function(data) {
		  $('#n7_32gb_3g').html(data);
		});
		$.get("cached/est/nation="+country+"&type=n7_32gb_3g.temp", function(data) {
		  $('#n7_32gb_3g_est').html(data);
		});

		
		$.get("cached/nation="+country+"&type=n7_32gb.temp", function(data) {
		  $('#n7_32gb').html(data);
		});
		$.get("cached/est/nation="+country+"&type=n7_32gb.temp", function(data) {
		  $('#n7_32gb_est').html(data);
		});
		
		$.get("cached/nation="+country+"&type=n7_16gb.temp", function(data) {
		  $('#n7_16gb').html(data);
		});
		$.get("cached/est/nation="+country+"&type=n7_16gb.temp", function(data) {
		  $('#n7_16gb_est').html(data);
		});
		
		$.get("cached/nation="+country+"&type=n10_32gb.temp", function(data) {
		  $('#n10_32gb').html(data);
		});
		$.get("cached/est/nation="+country+"&type=n10_32gb.temp", function(data) {
		  $('#n10_32gb_est').html(data);
		});
		
		$.get("cached/nation="+country+"&type=n10_16gb.temp", function(data) {
		  $('#n10_16gb').html(data);
		});
		$.get("cached/est/nation="+country+"&type=n10_16gb.temp", function(data) {
		  $('#n10_16gb_est').html(data);
		});
		
		$.get("cached/nation="+country+"&type=orb.temp", function(data) {
		  $('#orb').html(data);
		});
		$.get("cached/est/nation="+country+"&type=orb.temp", function(data) {
		$('#orb_est').html(data);
		});
	
	}	

	$("select").change(function () {
         	 var str = "";
          	$("select option:selected").each(function () {
              	  str += $(this).val();
              	});
			 window.history.pushState("", "Google Nexus Devices World Availability Checker", "?type="+str);	
         	 loadStatus(str);
       	 })

 	$("#refresh, #dorefresh").live('click', function() {
         	 var str = "";
          	$("select option:selected").each(function () {
              	  str += $(this).val();
              	});
              // window.history.pushState("", "Google Nexus Devices World Availability Checker", "/n4checker/?type="+str);	
		loadStatus(str);			
          	}); 

 	$("#refreshct, #dorefreshcountry").live('click', function() {
		loadStatusByCountry("<?= $country; ?>");	
          	}); 


// -->		
	
<?php if($country) { ?>
	loadStatusByCountry("<?= $country; ?>");
<?php } else { ?>
	loadStatus("<?= $type; ?>");
<?php } ?>


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
</head>
<body style="font-family: arial,sans-serif; font-size: small;">
<div id="mainbox" style="padding: 10px; margin-left: auto; margin-right: auto; text-align: center; margin-top: 15px;">
<div style="background: #c1c1c1; padding: 5px; height: 40px; width: 98%;">

<?php if($country) { 
	echo '<img src="images/' . $country . '.png" border="0" style="margin-top:7px;" /> <strong>' . $country_text[$country] . '</strong>';

} else { ?>
    <select id="Make" name="Make">
	<?php foreach ($descr as $value => $name) {
		$selected = " ";
		if($value == $type) { $selected = " selected "; } 
		echo '<option' . $selected . 'value="' . $value . '">' . $name . '</option>';	
		
	}
	?>
    </select>
</form>
<?php } ?>

<a href="http://www.n4checker.com/"><img style="float:left; margin: 1px 0 0 5px; " src="images/google-play-logo.png" border="0" ></a>
<strong>Play Store Availability Checker</strong><br>
<span style="font-size: 12px;">Reliable source of out of / in stock updates. The status for <b>Nexus 5</b> is error until it's launched on the Play Store.  <!--<img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /> for better accuracy--></span>
<a style="background: none; height: 60px;" href="#"><div style="float:right;" id="<?php if($country) echo "refreshct"; else echo "refresh"; ?>"><img src="images/refresh.png" border="0" ></div></a>

</div>
<br>
<div id="mainshit" style="height: position:fixed;">


	<?php if($country) { ?>

	<div id="shitshit" style="float: left; text-align: left; padding:5px; height:250px; width: 400px;">


	Nexus <b>5</b> <font style="color: black">Black</font> 32GB: <span id="n5_32gb_black">		</span> [ <a href="javascript:reLoad('n5_32gb_black','<?php echo $country; ?>');"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ] <span id="n5_32gb_black"></span><br>
	Nexus <b>5</b> <font style="color: black">Black</font> 16GB: <span id="n5_16gb_black">		</span> [ <a href="javascript:reLoad('n5_16gb_black','<?php echo $country; ?>');"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ] <span id="n5_16gb_black"></span><br><br>

	Nexus <b>5</b> <font style="color: White">White</font> 32GB: <span id="n5_32gb_white">		</span> [ <a href="javascript:reLoad('n5_32gb_white','<?php echo $country; ?>');"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ] <span id="n5_32gb_white"></span><br>
	Nexus <b>5</b> <font style="color: White">White</font> 16GB: <span id="n5_16gb_black">		</span> [ <a href="javascript:reLoad('n5_16gb_white','<?php echo $country; ?>');"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ] <span id="n5_16gb_white"></span><br><br><br>


	Nexus 4 16GB: <span id="n4_16gb">		</span> [ <a href="javascript:reLoad('n4_16gb','<?php echo $country; ?>');"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ] <span id="n4_16gb_est"></span><br>
	Nexus 4 8GB: <span id="n4_8gb">		</span> [ <a href="javascript:reLoad('n4_8gb','<?php echo $country; ?>');"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ] <span id="n4_8gb_est"></span><br>
	Nexus 4 Black Bumper: <span id="n4_black_bumper">		</span> [ <a href="javascript:reLoad('n4_black_bumper','<?php echo $country; ?>');"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ] <span id="n4_black_bumper_est"></span><br><br>
	Nexus 4 Wireless Charger: <span id="orb">		</span> [ <a href="javascript:reLoad('orb','<?php echo $country; ?>');"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ] <span id="orb_est"></span><br><br>

	Nexus 7 <b>2013</b> 32GB LTE: <span id="n7_32gb_lte_2013">		</span> [ <a href="javascript:reLoad('n7_32gb_lte_2013','<?php echo $country; ?>');"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ] <span id="n7_32gb_lte_2013_est"></span><br>
	Nexus 7 <b>2013</b> 32GB: <span id="n7_32gb_2013">		</span> [ <a href="javascript:reLoad('n7_32gb_2013','<?php echo $country; ?>');"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ] <span id="n7_32gb_2013_est"></span><br>
	Nexus 7 <b>2013</b> 16GB: <span id="n7_16gb_2013">		</span> [ <a href="javascript:reLoad('n7_16gb_2013','<?php echo $country; ?>');"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ] <span id="n7_16gb_2013_est"></span><br><br>


	Nexus 7 32GB HSPA+: <span id="n7_32gb_3g">		</span> [ <a href="javascript:reLoad('n7_32gb_3g','<?php echo $country; ?>');"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ] <span id="n7_32gb_3g_est"></span><br>
	Nexus 7 32GB: <span id="n7_32gb">		</span> [ <a href="javascript:reLoad('n7_32gb','<?php echo $country; ?>');"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ] <span id="n7_32gb_est"></span><br>
	Nexus 7 16GB: <span id="n7_16gb">		</span> [ <a href="javascript:reLoad('n7_16gb','<?php echo $country; ?>');"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ] <span id="n7_16gb_est"></span><br><br>

	Nexus 10 32GB: <span id="n10_32gb">		</span> [ <a href="javascript:reLoad('n10_32gb','<?php echo $country; ?>');"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ] <span id="n10_32gb_est"></span><br>
	Nexus 10 16GB: <span id="n10_16gb">		</span> [ <a href="javascript:reLoad('n10_16gb','<?php echo $country; ?>');"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ] <span id="n10_16gb_est"></span><br>

	</div>
	<div id="asd">
	<script type="text/javascript"><!--
	google_ad_client = "ca-pub-2725480770465067";
	/* n4checker_largeright */
	google_ad_slot = "8289226803";
	google_ad_width = 300;
	google_ad_height = 250;
	//-->
	</script>
	<script type="text/javascript"
	src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
	</script>
	</div>

	<?php } else {?>

	<div id="shitshit" style="text-align: left; padding:5px;">


	<img src="images/usa.png"> USA: <span id="usa">		</span> [ <a href="javascript:reLoad('<?php echo $type; ?>','usa',1);"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ] <span id="usa_est"></span><br>
	<img src="images/uk.png"> UK: <span id="uk">		</span> [ <a href="javascript:reLoad('<?php echo $type; ?>','uk',1);"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ] <span id="uk_est"></span><br>
	<img src="images/spain.png"> Spain: <span id="spain">		</span> [ <a href="javascript:reLoad('<?php echo $type; ?>','spain',1);"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ] <span id="spain_est"></span><br>
	<img src="images/germany.png"> Germany: <span id="germany">		</span> [ <a href="javascript:reLoad('<?php echo $type; ?>','germany',1);"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ] <span id="germany_est"></span><br>
	<img src="images/france.png"> France: <span id="france">		</span> [ <a href="javascript:reLoad('<?php echo $type; ?>','france',1);"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ] <span id="france_est"></span><br>
	<img src="images/it.png"> Italy: <span id="it">		</span> [ <a href="javascript:reLoad('<?php echo $type; ?>','it',1);"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ] <span id="it_est"></span><br>
	<img src="images/japan.png"> Japan: <span id="japan">		</span> [ <a href="javascript:reLoad('<?php echo $type; ?>','japan',1);"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ] <span id="japan_est"></span><br>
	<img src="images/canada.png"> Canada: <span id="canada">		</span> [ <a href="javascript:reLoad('<?php  echo $type; ?>','canada',1);"><img style="margin-bottom: -1.4px;" src="images/smallrefresh.png" alt="Refresh" border="0" /></a> ] <span id="canada_est"></span><br> 

	</div>
	<div style="float: right; margin-top: -140px; margin-left: -20px; margin-right: 30px;">
		<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- n4checherk_right_smallrectangle -->
		<ins class="adsbygoogle"
		     style="display:inline-block;width:180px;height:150px"
		     data-ad-client="ca-pub-2725480770465067"
		     data-ad-slot="6824905421"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div>
	<?php } ?>

</div>

<div style="border: #f4f4d9 1px solid; background: #c1c1c1; padding: 10px; height: 40px; margin-top: 10px; text-align: left;">
<span style="height: 40px; margin-left: 56px;">
Download our new <b>Nexus Checker</b> app on your Android device.<br>
Keep track of Nexus devices availability in <b>every</b> Play Store, for free. 
<span>
<img style="float:left; margin-top: -25px; padding-right: 10px;" src="images/n4small.png" width="47px" height="49px" border="0" >

<a href="https://play.google.com/store/apps/details?id=it.lorthirk.NexusChecker"><div id="gplayinstall" style="float: right; padding: 20px; margin-top: -10px; margin-right: -20px;" /></div></a>
</div>
<script type="text/javascript"><!--
google_ad_client = "ca-pub-2725480770465067";
/* n4checker */
google_ad_slot = "8873540560";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

<div style="background: #c1c1c1; padding: 10px; padding-bottom: -5px; height: 10px; margin-top: 7px; margin-bottom: 5px;">
<span style="float:left; position:relative; font-size:11px; margin-top: -3px;" >Sort by country  &mdash;</span>
<div style="position:absolute; text-align: center; margin-left: 220px;">
<?php 
	foreach($country_text as $c_id => $c_alt) {
			echo '<a href="?country=' . $c_id . '"><img style="margin-right:20px; " src="images/' . $c_id . '.png" alt="'. $c_alt . '"border="0" /></a>';
		
	}
	
?>
</div>
</div>
<div style="float: right; margin-top: -30px;">
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="QT7N972B8GKWU">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/it_IT/i/scr/pixel.gif" width="1" height="1">
</form>
</div>

<div style="background: #c1c1c1; padding: 10px; height: 30px; margin-top: 7px; ">

<div style=" display:inline; padding: 5px; float: left; ">

<!-- G+ -->
<div class="g-plusone" data-size="medium" data-href="http://www.n4checker.com/"></div>
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

<!-- tweet it  -->
<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.n4checker.com/" data-via="ldx00" data-related="ldx00">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<!-- FB Like -->
<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.n4checker.com&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=arial&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe>
</div>

<div style=" padding: 5px; float: right; display: inline;">
<!-- mail ludalex -->
<div id="mailbox" style="margin-right: -15px;"><a class="maillink" href="javascript:mailto('mvebmfyAhnbjm/dpn')">Mail <script language="javascript">document.writeln (unCryptMail ('mvebmfyAhnbjm/dpn'));</script></a></div>
<!-- follow ldx00 -->
<a href="https://twitter.com/ldx00" class="twitter-follow-button" data-show-count="false">Follow @ldx00</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

</div>

</div>
<br>
<div id="disqus_thread"></div>

<script type="text/javascript">
            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
            var disqus_shortname = 'n4checker'; // required: replace example with your forum shortname
            var disqus_identifier = 'maintalk';
            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function() {
                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
        <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
       


</div>

</body> 

<script>
// Ugly hack
setTimeout(function() {
      $("#mainshit").css("height", $("#shitshit")[0].scrollHeight);
}, 1000);	
</script>