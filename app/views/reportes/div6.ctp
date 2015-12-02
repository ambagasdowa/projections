<?php
  if(isset($estimate['totals'][$RealmsClass['6']['RealmsClass']['realms_class']])){
	e('$'.number_format(money_format('%i',$estimate['totals'][$RealmsClass['6']['RealmsClass']['realms_class']]), 2, '.', ','));
  }else{
	e('$'.number_format(money_format('%i',0), 2, '.', ','));
  }
?>
