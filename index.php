<?php 
	$type=$_GET['type'];
	if(!$type) { $type = "n4_16gb"; }
	$descr = array(
    		"n4_16gb" => "Nexus 4 16gb",
    		"n4_8gb" => "Nexus 4 8gb",
    		"n7_32gb_3g" => "Nexus 7 32gb HSPA+",
    		"n7_32gb" => "Nexus 7 32gb",
    		"n7_16gb" => "Nexus 7 16gb",
    		"n10_32gb" => "Nexus 10 32gb",
    		"n10_16gb" => "Nexus 10 16gb",
		);
?>
<head>
<title>Google Nexus Devices World Availability Checker (Test)</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
	
	function loadStatus(type){  
	var loader_gfx = '<span style="margin-left: 10px; display:inline;"><img src="images/ajax-loader.gif" alt="Caricamento.."></span>';
	$("#usa, #uk, #spain, #germany, #france").html(loader_gfx);


	$.get("loader.php?nation=usa&timeout=0&type=" + type, function(data) {
	  $('#usa').html(data);
	});


	$.get("loader.php?nation=uk&timeout=25&type=" + type, function(data) {
	  $('#uk').html(data);
	});

	$.get("loader.php?nation=spain&timeout=25&type=" + type, function(data) {
	  $('#spain').html(data);
	});	

	$.get("loader.php?nation=germany&timeout=25&type=" + type, function(data) {
	  $('#germany').html(data);
	});

	$.get("loader.php?nation=france&timeout=0&type=" + type, function(data) {
	  $('#france').html(data);
	});	

}
		
/* 		$("#refresh, #dorefresh").live('click', function() {
		
	$("#usa").load("loader.php?nation=usa&timeout=0&type=" + type);

	$("#uk").load("loader.php?nation=uk&timeout=25&type=" + type);

	$("#spain").load("loader.php?nation=spain&timeout=25&type=" + type);

	$("#germany").load("loader.php?nation=germany&timeout=25&type=" + type);

	$("#france").load("loader.php?nation=france&timeout=25&type=" + type);
			
		}); */

	loadStatus("<? echo $type; ?>");
	
	$("select").change(function () {
         	 var str = "";
          	$("select option:selected").each(function () {
              	  str += $(this).val() + " ";
              	});
         	 loadStatus(str);
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
</head>
<body style="background: #c1c1c1; font-family: arial,sans-serif; font-size: small;">
<div style="background: #e1e1e1; padding: 10px; width: 700px; margin-left: auto; margin-right: auto; text-align: center; margin-top: 15px;">
<div style="background: #c1c1c1; padding: 5px;">
    <select id="Make" name="Make">
	<? foreach ($descr as $value => $name) {
		echo '<option value="' . $value . '">' . $name . '</option>';	
	}
	?>
    </select>
</form>
<strong>Play Store Availability Checker</strong><br>
<i>Hit refresh (F5) if you get error on the status  or wait for a fix.</i>
</div>
<br>
<div style="text-align: left;">
USA: <span id="usa">		</span><br>
UK: <span id="uk">		</span><br>
SPAIN: <span id="spain">		</span><br>
GERMANY: <span id="germany">		</span><br>
FRANCE: <span id="france">		</span><br> 
</div>
<br>

<div style="background: #eaeaea; padding: 5px; float: right;">
<a href="https://twitter.com/ldx00" style="decoration: none;">@ldx00</a>
</div>
</div>
</body>