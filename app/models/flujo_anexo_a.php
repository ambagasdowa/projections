<?php
// This comes from local mysql database

class FlujoAnexoA extends AppModel{
    var $name = "FlujoAnexoA";
    var $useTable = "anexo_a";
    var $useDbConfig = 'flujo';
    var $primaryKey = "id_anexo_a";
	
	
	function getAnexoA($week=null){
	 /**
	  * @Config-Section
	  * @Edit->dependent_of your needs
	  */
	 if(isset($week)){
	  $fields = array('1'=>'FlujoAnexoA.id_anexo_a', // Edit
					  '2'=>'FlujoAnexoA.status'
				);
	  $Conditions['FlujoAnexoA.status'] = 'Active'; // Filter the active records
	  $Conditions['FlujoAnexoA.week'] = $week;
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
 
