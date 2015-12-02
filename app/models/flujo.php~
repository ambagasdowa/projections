<?php

  class Flujo extends AppModel{

	var $name = 'Flujo';
	var $useTable = 'flujo';
	var $useDbConfig = 'flujo';
	var $primaryKey = 'id_flujo';

	var $belongsTo = array(
// 							'Realms'=>array(
// 											  'className'=>'Realms',
// 											  'foreignKey'=>'id_realms'
// 							  ),
// 							'RealmsClass'=>array(
// 											  'className'=>'RealmsClass',
// 											  'foreignKey'=>'id_realms_class'
// 							  ),
							'Accounts'=>array(
											  'className'=>'Accounts',
											  'foreignKey'=>'id_accounts'
// 											  'order'=>'account ASC'
							  )
	  );

  /**
     * @Callback function for retrieve areas and re-arange with his associated id's
     * @package => Build-in
     * @return array
     */
	function getFlujo($week=null,$year=null,$status=null,$month=null){
	 /**
	  * @Config-Section
	  * @Edit->dependent_of your needs
	  */
	  $fields = array('1'=>'Flujo.id_flujo','2'=>'Flujo.id_accounts','3'=>'Flujo.presupuesto');
      $conditions['Flujo.status'] = $status;
	  $conditions['Flujo.week'] = $week;
	  $conditions['Flujo.year'] = $year;
	  $conditions['Flujo.id_kingdoms'] = $_SESSION['Auth']['User']['id_empresa'];
	  
	  if($month == true){
		$conditions['Flujo.month'] = $month;
	  }
	  
      $Model = $this->find('all',array('conditions'=>$conditions,'order'=>'month'));
	  foreach($Model as $upKey => $Data){
		  $Model = Set::combine($Model, '{n}.'.$fields['2'], '{n}');
	  }
	  return $Model;
	} // end function

  }
?>