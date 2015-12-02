<?php
// This comes from local mysql database
class FlujoSaldo extends AppModel{
    var $name = "FlujoSaldo";
    var $useTable = "saldo";
    var $useDbConfig = 'flujo';
    var $primaryKey = "id_saldo";

	

  /**
     * @Callback function for retrieve areas and re-arange with his associated id's
     * @package => Build-in
     * @return array
     */
	function getSaldo($week=null,$year=null,$status=null,$month=null){
	 /**
	  * @Config-Section
	  * @Edit->dependent_of your needs
	  */
	  $fields = array('1'=>'FlujoSaldo.id_saldo', // Edit
					  '2'=>'FlujoSaldo.week',
					  '3'=>'FlujoSaldo.year',
					  '4'=>'FlujoSaldo.status',
					  '5'=>'FlujoSaldo.id_kingdoms',
					  '6'=>'FlujoSaldo.month'
				);

      $conditions['FlujoSaldo.status'] = $status;
	  $conditions['FlujoSaldo.week'] = $week;
	  $conditions['FlujoSaldo.year'] = $year;
	  $conditions['FlujoSaldo.id_kingdoms'] = $_SESSION['Auth']['User']['id_empresa'];
	  
	  if(isset($month)){
		$conditions['FlujoSaldo.month'] = $month;
		$Model = $this->find('first',array('conditions'=>$conditions));
	  }else{
		$Model = $this->find('all',array('conditions'=>$conditions));
		foreach($Model as $upKey => $Data){ // Setting up the month as identifier
		  $Model = Set::combine($Model, '{n}.'.$fields['6'], '{n}');
		}
	  } // End if isset month
	  return $Model;
	} // end function

	
} // End Class 
?>
 
