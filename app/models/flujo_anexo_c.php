<?php
// This comes from local mysql database

class FlujoAnexoC extends AppModel{
    var $name = "FlujoAnexoC";
    var $useTable = "anexo_c";
    var $useDbConfig = 'flujo';
    var $primaryKey = "id_anexo_c";
	
	
	function getAnexoC($week=null){
	 /**
	  * @Config-Section
	  * @Edit->dependent_of your needs
	  */
	 if(isset($week)){
	  $fields = array('1'=>'FlujoAnexoC.id_anexo_c', // Edit
					  '2'=>'FlujoAnexoC.status'
				);
	  $Conditions['FlujoAnexoC.status'] = 'Active'; // Filter the active records
	  $Conditions['FlujoAnexoC.week'] = $week;
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
 
