<?php
// This comes from local mysql database
class FlujoDirNamesAnexoC extends AppModel{
    var $name = "FlujoDirNamesAnexoC";
    var $useTable = "dir_names_anexo_c";
    var $useDbConfig = 'flujo';
    var $primaryKey = "id_dir_names_anexo_c";

    var $hasMany = array(
        'FlujoDirConceptAnexoC' => array(
            'className'     => 'FlujoDirConceptAnexoC',// Edit
            'foreignKey'    => 'id_dir_names_anexo_c',
            'fields'		=> array('FlujoDirConceptAnexoC.id_dir_names_anexo_c', //Edit
									 'FlujoDirConceptAnexoC.id_dir_concept_anexo_c',
									 'FlujoDirConceptAnexoC.concepto',
									 'FlujoDirConceptAnexoC.status'
							   ),
			'conditions'    => array('FlujoDirConceptAnexoC.status' => 'Active'), //Edit
			'order'   		=> 'FlujoDirConceptAnexoC.concepto ASC',
//          'limit'        => '50',
            'dependent'=> true
        )
    );
    /**
     * @Callback function for retrieve areas and re-arange with his associated fleets
     * @package => Build-in
     * @return array
     */
    function getConceptAnexoC(){
	 /**
	  * @Config-Section
	  * @Edit->dependent_of your needs
	  */
	  $fields = array('1'=>'FlujoDirNamesAnexoC.id_dir_names_anexo_c', // Edit
					  '2'=>'FlujoDirNamesAnexoC.nombre',
					  '3'=>'FlujoDirNamesAnexoC.status'
				);
	  $Nfields = array('1'=>'FlujoDirNamesAnexoC.id_dir_names_anexo_c', // Edit
					  '2'=>'FlujoDirNamesAnexoC.nombre',
					  '3'=>'FlujoDirNamesAnexoC.status'
				);
	  $pointer = array('1'=>'FlujoDirConceptAnexoC', // Edit
					   '2'=>'id_dir_concept_anexo_c',
					   '3'=>'concepto' // field info to add in the index of array
				);

	  $Conditions['status'] = 'Active'; // Filter the active records
      $Model = $this->find('all',array('fields'=>array($fields['1'],$fields['2']),'conditions'=>$Conditions));
	  foreach($Model as $upKey => $Data){
		  $Model = Set::combine($Model, '{n}.'.$fields['1'], '{n}');
	  }
	  foreach($Model as $upKey => $Data){
		foreach($Data[$pointer['1']] as $UpKey => $values){
		  $Model[$upKey][$pointer['1']] = Set::combine($Data[$pointer['1']], '{n}.'.$pointer['2'], '{n}');
		}
	  }
		return $Model;
    } // End function Model
} // End Class 
?>
 
