<?php
	echo $html->charset("UTF-8");
// 	$javascript->link("prototype",false);
// 	$javascript->link("scriptaculous",false);

	echo $form->create("Sample");
	$opt = array("apple","pear","grape");
	echo $form->input("title",array("id"=>"SampleTest","type"=>"select","options"=>$opt));
	$opt = array(
		"update" => array("data_div","data2_div","data3_div"),
		"url" => "/observe_update_divs/disp",
		"frequency" => "1"
	);

	echo $ajax->observeField("SampleTest",$opt);
	echo $form->end();
?>

<div>first div:</div>
<div id="data_div" style=""></div>
<div>second div:</div>
<div id="data2_div" style=""></div>
<div>third div:</div>
<div id="data3_div" style=""></div>
