<?php
// This comes from local mysql database
class FlujoDirNamesAnexoB extends AppModel{
    var $name = "FlujoDirNamesAnexoB";
    var $useTable = "dir_names_anexo_b";
    var $useDbConfig = 'flujo';
    var $primaryKey = "id_dir_names_anexo_b";

    var $hasMany = array(
        'FlujoDirConceptAnexoB' => array(
            'className'     => 'FlujoDirConceptAnexoB',// Edit
            'foreignKey'    => 'id_dir_names_anexo_b',
            'fields'		=> array('FlujoDirConceptAnexoB.id_dir_names_anexo_b', //Edit
									 'FlujoDirConceptAnexoB.id_dir_concept_anexo_b',
									 'FlujoDirConceptAnexoB.concepto',
									 'FlujoDirConceptAnexoB.status'
							   ),
			'conditions'    => array('FlujoDirConceptAnexoB.status' => 'Active'), //Edit
			'order'   		=> 'FlujoDirConceptAnexoB.concepto ASC',
//          'limit'        => '50',
            'dependent'=> true
        )
    );
    /**
     * @Callback function for retrieve areas and re-arange with his associated fleets
     * @package => Build-in
     * @return array
     */
    function getConceptAnexoB(){
	 /**
	  * @Config-Section
	  * @Edit->dependent_of your needs
	  */
	  $fields = array('1'=>'FlujoDirNamesAnexoB.id_dir_names_anexo_b', // Edit
					  '2'=>'FlujoDirNamesAnexoB.nombre',
					  '3'=>'FlujoDirNamesAnexoB.status'
				);
	  $Nfields = array('1'=>'FlujoDirNamesAnexoB.id_dir_names_anexo_b', // Edit
					  '2'=>'FlujoDirNamesAnexoB.nombre',
					  '3'=>'FlujoDirNamesAnexoB.status'
				);
	  $pointer = array('1'=>'FlujoDirConceptAnexoB', // Edit
					   '2'=>'id_dir_concept_anexo_b',
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
 
