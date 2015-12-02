<?php //die(); ?>
<?php
	echo $html->charset("UTF-8");
	$opt = array(
		"update" => "data_div",
		"url"    => "/remote_timer/disp",
		"frequency" => 1,
	       );
	echo $ajax->remoteTimer($opt);
?>

<?php
// 	$mkdiv = $this->requestAction('RemoteTimer/mkdiv');
	
// 	for($i=1;$i<=$mkdiv;$i++){
// 
// 	      echo $html->charset("UTF-8");
// 	      $opt = array(
// 		      "update" => "data_div$i",
// 		      "url"    => "/remote_timer/disp",
// 		      "frequency" => 1,
// 		     );
// 	      echo $ajax->remoteTimer($opt);
// 
// 	      e("\n<div id=\"data_div$i\" style=\"\"></div>\n");
// 	}
	

?>
<div id="data_div"></div>
