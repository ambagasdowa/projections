<?php
	echo $ajax->div("data_div");
	echo "<font size='30'>Hi! ".date("Y-m-d H:i:s")."</font>";
	echo $ajax->divEnd("data_div");
	
	echo $ajax->div("data2_div");
	echo "<font size='50'>Yes! ".rand(1,100)."</font>";
	echo $ajax->divEnd("data2_div");
	
	echo $ajax->div("data3_div");
	echo "<font size='20'>No! ".rand(89,100)."</font>";
	echo $ajax->divEnd("data3_div");	
?>