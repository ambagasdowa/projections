<?php
// This comes from local mysql database

class FlujoAnexoB extends AppModel{
    var $name = "FlujoAnexoB";
    var $useTable = "anexo_b";
    var $useDbConfig = 'flujo';
    var $primaryKey = "id_anexo_b";
	
	
	function getAnexoB($week=null){
	 /**
	  * @Config-Section
	  * @Edit->dependent_of your needs
	  */
	 if(isset($week)){
	  $fields = array('1'=>'FlujoAnexoB.id_anexo_b', // Edit
					  '2'=>'FlujoAnexoB.status'
				);
	  $Conditions['FlujoAnexoB.status'] = 'Active'; // Filter the active records
	  $Conditions['FlujoAnexoB.week'] = $week;
      $Model = $this->find('all',array('conditions'=>$Conditions));
	  foreach($Model as $upKey => $Data){
		  $Model = Set::combine($Model, '{n}.'.$fields['1'], '{n}');
	  }
	 }else{
	   $Model = null;
	}
	  return $Model;
	} // end function
	
} // End Class 
?>
 
