<?php
  class Cuentas extends AppModel{
	
	var $name = 'Cuentas';
	var $useDbConfig = 'flujo';
	var $primaryKey = 'id_cuenta';
	
    var $hasMany = array(
        'Conceptos' => array(
            'className'     => 'Conceptos',// Edit
            'foreignKey'    => 'id_cuenta',
            'fields'		=> array('Conceptos.id_concepto', //Edit
// 									 'Conceptos.id_concepto',
									 'Conceptos.concepto',
									 'Conceptos.status'
							   ),
			'conditions'    => array('Conceptos.status' => 'Active'), //Edit
			'order'   		=> 'Conceptos.concepto ASC',
//          'limit'        => '50',
            'dependent'=> true
        )
    );
    /**
     * @Callback function for retrieve areas and re-arange with his associated fleets
     * @package => Build-in
     * @return array
     */
    function getConceptAccount(){
	 /**
	  * @Config-Section
	  * @Edit->dependent_of your needs
	  */
	  $fields = array('1'=>'Cuentas.id_cuenta', // Edit
					  '2'=>'Cuentas.cuenta',
					  '3'=>'Cuentas.status'
				);
	  $Nfields = array('1'=>'Cuentas.id_cuenta', // Edit
					   '2'=>'Cuentas.cuenta',
					   '3'=>'Cuentas.status'
				);
	  $pointer = array('1'=>'Conceptos', // Edit
					   '2'=>'id_concepto' // field info to add in the index of array
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
    
  }

?> 
