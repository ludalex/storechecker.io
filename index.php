<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
	$type=$_GET['type'];
	$country=$_GET['country'];
	if(!$type) { $type = "n4_16gb"; }

	$descr = array(
    		"n4_16gb" => "Nexus 4 16gb",
    		"n4_8gb" => "Nexus 4 8gb",
			"n4_black_bumper" => "Nexus 4 Black Bumper",
    		"n7_32gb_3g" => "Nexus 7 32gb HSPA+",
    		"n7_32gb" => "Nexus 7 32gb",
    		"n7_16gb" => "Nexus 7 16gb",
    		"n10_32gb" => "Nexus 10 32gb",
    		"n10_16gb" => "Nexus 10 16gb",
		);

	$country_text = array(
    		"usa" => "American",
    		"uk" => "English",
    		"spain" => "Spanish",
    		"germany" => "German",
    		"france" => "French",
    		"japan" => "Japanese",
    		"australia" => "Australian",
    		"canada" => "Canadian",
		);
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Google Nexus Devices World Availability Checker</title>
<meta name="description" content="A website to check the  worldwide availability of the Google Nexus devices." />

<meta property="og:image" content="http://ludalex.soupwhale.com/n4checker/images/google-play-logo-BIG.png" />
<meta property="og:url" content="c" />
<meta property="og:title" content="Google Nexus Devices World Availability Checker" />
<meta property="og:description" content="A website to check the worldwide availability of the Google Nexus devices." />
<meta property="og:type" content="website" /> 

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<style type="text/css">
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
</style>
<script type="text/javascript">
	$(document).ready(function() {
	
	function loadStatus(type){  

	var loader_gfx = '<span style="margin-left: 10px; display:inline;"><img src="images/ajax-loader.gif" alt="Fetching status.."></span>';
	$("#usa, #uk, #spain, #germany, #france, #japan, #australia, #canada").html(loader_gfx);


	$.get("loaderTest.php?nation=usa&timeout=0&type=" + type, function(data) {
	  $('#usa').html(data);
	});
	$.get("loaderTest.php?nation=uk&timeout=30&type=" + type, function(data) {
	  $('#uk').html(data);
	});
	$.get("loaderTest.php?nation=spain&timeout=30&type=" + type, function(data) {
	  $('#spain').html(data);
	});	
	$.get("loaderTest.php?nation=germany&timeout=30&type=" + type, function(data) {
	  $('#germany').html(data);
	});
	$.get("loaderTest.php?nation=france&timeout=30type=" + type, function(data) {
	  $('#france').html(data);
	});	
	$.get("loaderTest.php?nation=japan&timeout=30&type=" + type, function(data) {
	  $('#japan').html(data);
	});	
	$.get("loaderTest.php?nation=australia&timeout=30&type=" + type, function(data) {
	  $('#australia').html(data);
	});	
	$.get("loaderTest.php?nation=canada&timeout=30&type=" + type, function(data) {
	  $('#canada').html(data);
	});	
	
}	

	function loadStatusByCountry(country){  

	var loader_gfx = '<span style="margin-left: 10px; display:inline;"><img src="images/ajax-loader.gif" alt="Fetching status.."></span>';
	$("#n4_16gb, #n4_8gb, #n4_black_bumper, #n7_32gb_3g, #n7_32gb, #n7_16gb, #n10_32gb, #n10_16gb").html(loader_gfx);


	$.get("loaderTest.php?nation="+country+"&timeout=0&type=n4_16gb", function(data) {
	  $('#n4_16gb').html(data);
	});
	$.get("loaderTest.php?nation="+country+"&timeout=30&type=n4_8gb", function(data) {
	  $('#n4_8gb').html(data);
	});
	$.get("loaderTest.php?nation="+country+"&timeout=30&type=n4_black_bumper", function(data) {
	  $('#n4_black_bumper').html(data);
	});
	$.get("loaderTest.php?nation="+country+"&timeout=30&type=n7_32gb_3g", function(data) {
	  $('#n7_32gb_3g').html(data);
	});
	$.get("loaderTest.php?nation="+country+"&timeout=30&type=n7_32gb", function(data) {
	  $('#n7_32gb').html(data);
	});
	$.get("loaderTest.php?nation="+country+"&timeout=30&type=n7_16gb", function(data) {
	  $('#n7_16gb').html(data);
	});
	$.get("loaderTest.php?nation="+country+"&timeout=30&type=n10_32gb", function(data) {
	  $('#n10_32gb').html(data);
	});
	$.get("loaderTest.php?nation="+country+"&timeout=30&type=n10_16gb", function(data) {
	  $('#n10_16gb').html(data);
	});
	
}	

	$("select").change(function () {
         	 var str = "";
          	$("select option:selected").each(function () {
              	  str += $(this).val() + " ";
              	});
		 window.history.pushState("", "Google Nexus Devices World Availability Checker", "/n4checker/?type="+str);	
         	 loadStatus(str);
       	 })

 	$("#refresh, #dorefresh").live('click', function() {
         	 var str = "";
          	$("select option:selected").each(function () {
              	  str += $(this).val() + " ";
              	});
              // window.history.pushState("", "Google Nexus Devices World Availability Checker", "/n4checker/?type="+str);	
		loadStatus(str);			
          	}); 

 	$("#refreshct, #dorefreshcountry").live('click', function() {
		loadStatusByCountry("<? echo $country; ?>");	
          	}); 

<?php if($country) { ?>
	loadStatusByCountry("<? echo $country; ?>");
<?php } else { ?>
	loadStatus("<? echo $type; ?>");
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
<body style="background: #c1c1c1; font-family: arial,sans-serif; font-size: small;">
<div style="background: #e1e1e1; padding: 10px; width: 730px; margin-left: auto; margin-right: auto; text-align: center; margin-top: 15px;">
<div style="background: #c1c1c1; padding: 5px; height: 40px;">

<?php if($country) { 
	echo '<img src="images/' . $country . '.png" border="0" style="margin-top:7px;" /> <strong>' . $country_text[$country] . '</strong>';

} else { ?>
    <select id="Make" name="Make">
	<? foreach ($descr as $value => $name) {
		$selected = " ";
		if($value == $type) { $selected = " selected "; } 
		echo '<option' . $selected . 'value="' . $value . '">' . $name . '</option>';	
		
	}
	?>
    </select>
</form>
<?php } ?>

<a href="http://ludalex.soupwhale.com/n4checker/"><img style="float:left; margin: 1px 0 0 5px; " src="images/google-play-logo.png" border="0" ></a>
<strong>Play Store Availability Checker</strong><br>
<span style="font-size: 12px;">Wait for a status to finish loading before checking another. Hit F5 if you get errors.</span>
<a style="background: none; height: 60px;" href="#"><div style="float:right;" id="<? if($country) echo "refreshct"; else echo "refresh"; ?>"><img src="images/refresh.png" border="0" ></div></a>

</div>
<br>
<div style="text-align: left; padding:5px;">

<?php if($country) { ?>

Nexus 4 16GB: <span id="n4_16gb">		</span><br>
Nexus 4 8GB: <span id="n4_8gb">		</span><br>
Nexus 4 Black Bumper: <span id="n4_black_bumper">		</span><br><br>

Nexus 7 32GB HSPA+: <span id="n7_32gb_3g">		</span><br>
Nexus 7 32GB: <span id="n7_32gb">		</span><br>
Nexus 7 16GB: <span id="n7_16gb">		</span><br><br>

Nexus 10 32GB: <span id="n10_32gb">		</span><br>
Nexus 10 16GB: <span id="n10_16gb">		</span><br>

<?php } else {?>

<img src="images/usa.png"> USA: <span id="usa">		</span><br>
<img src="images/uk.png"> UK: <span id="uk">		</span><br>
<img src="images/spain.png"> Spain: <span id="spain">		</span><br>
<img src="images/germany.png"> Germany: <span id="germany">		</span><br>
<img src="images/france.png"> France: <span id="france">		</span><br> 
<img src="images/japan.png"> Japan: <span id="japan">		</span><br> 
<img src="images/australia.png"> Australia: <span id="australia">		</span><br> 
<img src="images/canada.png"> Canada: <span id="canada">		</span><br> 

<?php } ?>

</div>
<br>

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
<div style="background: #c1c1c1; padding: 10px; height: 10px; margin-top: 7px;">
<span style="float:left; position:relative; font-size:11px;" >Sort by country &mdash; </span>
<div style="position:absolute; text-align: center; margin-left: 200px;">
<?php 
	foreach($country_text as $c_id => $c_alt) {
		echo '<a href="?country=' . $c_id . '"><img style="margin-right:20px; " src="images/' . $c_id . '.png" alt="'. $c_alt . '"border="0" /></a>';
	}
?>
</div>
</div>

<div style="background: #c1c1c1; padding: 10px; height: 30px; margin-top: 7px;">

<div style=" display:inline; padding: 5px; float: left; ">

<!-- G+ -->
<div class="g-plusone" data-size="medium" data-href="http://ludalex.soupwhale.com/n4checker/"></div>
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

<!-- tweet it  -->
<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://ludalex.soupwhale.com/n4checker/" data-via="ldx00" data-related="ldx00">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<!-- FB Like -->
<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fludalex.soupwhale.com%2Fn4checker%2F&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=arial&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe>
</div>

<div style=" padding: 5px; float: right;">

<!-- follow ldx00 -->
<a href="https://twitter.com/ldx00" class="twitter-follow-button" data-show-count="false">Follow @ldx00</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

</div>

</div>

</div>
</body>