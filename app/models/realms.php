<?php
  class Realms extends AppModel{
	
	var $name = 'Realms';
	var $useDbConfig = 'flujo';
	var $primaryKey = 'id_realms';
	
	
	function getRealms($week=null,$anexo=null){
	 /**
	  * @Config-Section
	  * @Edit->dependent_of your needs
	  */
	 $fields = array('id_realms','realm');
      $Model = $this->find('list',array('fields'=>$fields));
// 	  foreach($Model as $upKey => $Data){
// 		  $Model = Set::combine($Model, '{n}.'.$fields['1'], '{n}');
// 	  }
	  return $Model;
	} // end function

  }
?> 