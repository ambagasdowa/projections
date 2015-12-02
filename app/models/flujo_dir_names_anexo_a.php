<?php
// This comes from local mysql database
class FlujoDirNamesAnexoA extends AppModel{
    var $name = "FlujoDirNamesAnexoA";
    var $useTable = "dir_names_anexo_a";
    var $useDbConfig = 'flujo';
    var $primaryKey = "id_dir_names_anexo_a";

    var $hasMany = array(
        'FlujoDirConceptAnexoA' => array(
            'className'     => 'FlujoDirConceptAnexoA',// Edit
            'foreignKey'    => 'id_dir_names_anexo_a',
            'fields'		=> array('FlujoDirConceptAnexoA.id_dir_names_anexo_a', //Edit
									 'FlujoDirConceptAnexoA.id_dir_concept_anexo_a',
									 'FlujoDirConceptAnexoA.concepto',
									 'FlujoDirConceptAnexoA.status'
							   ),
			'conditions'    => array('FlujoDirConceptAnexoA.status' => 'Active'), //Edit
			'order'   		=> 'FlujoDirConceptAnexoA.concepto ASC',
//          'limit'        => '50',
            'dependent'=> true
        )
    );
    /**
     * @Callback function for retrieve areas and re-arange with his associated fleets
     * @package => Build-in
     * @return array
     */
    function getConceptAnexoA(){
	 /**
	  * @Config-Section
	  * @Edit->dependent_of your needs
	  */
	  $fields = array('1'=>'FlujoDirNamesAnexoA.id_dir_names_anexo_a', // Edit
					  '2'=>'FlujoDirNamesAnexoA.nombre',
					  '3'=>'FlujoDirNamesAnexoA.status'
				);
	  $Nfields = array('1'=>'FlujoDirNamesAnexoA.id_dir_names_anexo_a', // Edit
					   '2'=>'FlujoDirNamesAnexoA.nombre',
					   '3'=>'FlujoDirNamesAnexoA.status'
				);
	  $pointer = array('1'=>'FlujoDirConceptAnexoA', // Edit
					   '2'=>'id_dir_concept_anexo_a' // field info to add in the index of array
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
 
