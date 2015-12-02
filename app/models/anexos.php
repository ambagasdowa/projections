<?php
// This comes from local mysql database

class Anexos extends AppModel{
    var $name = "Anexos";
//     var $useTable = "anexo";
    var $useDbConfig = 'flujo';
    var $primaryKey = "id_anexo";
	
    var $belongsTo = array(	'Cuentas'=>array('className'=>'Cuentas',
											 'foreignKey'=>'id_cuenta'
									   ),
							'Conceptos'=>array('className'=>'Conceptos',
											   'foreignKey'=>'id_concepto'
									   ),
							'DirAnexos'=>array('className'=>'DirAnexos',
											   'foreignKey'=>'id_dir_anexo'
									   )
	             );
	
	function getAnexo($week=null,$anexo=null){
	 /**
	  * @Config-Section
	  * @Edit->dependent_of your needs
	  */
	 if(isset($week)){
	  $fields = array('1'=>'Anexos.id_anexo', // Edit
					  '2'=>'Anexos.status'
				);
	  $Conditions['Anexos.status'] = 'Active'; // Filter the active records
	  $Conditions['Anexos.week'] = $week;
	  if(isset($anexo)){
		$Conditions['Anexos.id_dir_anexo'] = $anexo;
	  }
	  
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
 
