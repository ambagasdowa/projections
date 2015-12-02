<?php
  class RealmsClass extends AppModel{
	var $name = 'RealmsClass';
	var $useTable = 'realms_class';
	var $useDbConfig = 'flujo';
	var $primaryKey = 'id_realms_class';
	
	var $virtualFields = array(
								'div'=>'CONCAT(RealmsClass.prefix,RealmsClass.id_realms_class)'
						);
	var $displayField = 'div';
	
	var $belongsTo = array(
							'Realms'=>array(
											  'className'=>'Realms',
											  'foreignKey'=>'id_realms'
							  )
	  );
	  
    var $hasMany = array(
        'Accounts' => array(
            'className'     => 'Accounts',// Edit
            'foreignKey'    => 'id_realms_class',
            'fields'		=> array('Accounts.id_accounts', //Edit
									 'Accounts.account',
									 'Accounts.description',
									 'Accounts.year',
									 'Accounts.status'
							   ),
// 			'conditions'    => array('Accounts.status' => 'Active'), //Edit
			'order'   		=> 'Accounts.account ASC',
//          'limit'        => '50',
            'dependent'=> true
        ),
        'AccountsViews' => array(
            'className'     => 'Accounts',// Edit
            'foreignKey'    => 'id_realms_class',
            'fields'		=> array('AccountsViews.id_accounts', //Edit
									 'AccountsViews.account',
									 'AccountsViews.description',
									 'AccountsViews.year',
									 'AccountsViews.status'
							   ),
			'conditions'    => array('AccountsViews.status' => 'Active'), //Edit
			'order'   		=> 'AccountsViews.account ASC',
//          'limit'        => '50',
            'dependent'=> true
        )
    );

    /**
     * @Callback function for retrieve areas and re-arange with his associated fleets
     * @package => Build-in
     * @return array
     */
    function getAccount($setStatus=null){
	 /**
	  * @Config-Section
	  * @Edit->dependent_of your needs
	  */
	 $realms = $this->Realms->find('list',array('fields'=>array('id_realms','realm'),'conditions'=>array('status'=>'Active')));

	  $fields = array('1'=>'RealmsClass.id_realms_class', // Edit
					  '2'=>'RealmsClass.realms_class',
					  '3'=>'RealmsClass.id_realms',
					  '4'=>'RealmsClass.status',
					  '5'=>'RealmsClass.div',
				);
	  $Nfields = array('1'=>'RealmsClass.id_realms_class', // Edit
					   '2'=>'RealmsClass.realms_class',
					   '3'=>'RealmsClass.status'
				);
	  $pointer = array('1'=>'Accounts', // Edit
					   '2'=>'id_accounts', // field info to add in the index of array
					   '3'=>'RealmsClass',
					   '4'=>'id_realms',
					   '5'=>'realms',
					   '6'=>'AccountsViewsTbk',
					   '7'=>'RealmsClassViews',
					   '8'=>'AccountsViewsAtm',
					   '9'=>'AccountsViewsTei',
					   '10'=>'AccountsViews'
				);

	  if(!isset($setStatus)){
	  $Conditions['RealmsClass.status'] = 'Active'; // Filter the active records
	  }else{
		$Conditions = null;
	  }
	  
      $Model = $this->find('all',array('fields'=>array($fields['1'],$fields['2'],$fields['3'],$fields['4'],$fields['5']),'conditions'=>$Conditions));
	  foreach($Model as $upKey => $Data){
		  $Model = Set::combine($Model, '{n}.'.$fields['1'], '{n}');
		  // Build the index realms
		  if(!isset($Model[$upKey][$pointer['3']][$pointer['5']])){
			$Model[$upKey][$pointer['3']][$pointer['5']] = null;
		  }
	  }
	  foreach($Model as $upKey => $Data){
		// index fix for this particular view ;
		$Model[$upKey][$pointer['3']][$pointer['5']] = $realms[$Model[$upKey][$pointer['3']][$pointer['4']]];
		foreach($Data[$pointer['1']] as $UpKey => $values){
		  $Model[$upKey][$pointer['1']] = Set::combine($Data[$pointer['1']], '{n}.'.$pointer['2'], '{n}');
		  $Model[$upKey][$pointer['10']] = Set::combine($Data[$pointer['10']], '{n}.'.$pointer['2'], '{n}');
// 		  $Model[$upKey][$pointer['6']] = Set::combine($Data[$pointer['6']], '{n}.'.$pointer['2'], '{n}');
// 		  $Model[$upKey][$pointer['8']] = Set::combine($Data[$pointer['8']], '{n}.'.$pointer['2'], '{n}');
// 		  $Model[$upKey][$pointer['9']] = Set::combine($Data[$pointer['9']], '{n}.'.$pointer['2'], '{n}');
		}
	  }
		return $Model;
    } // End function Model
  }
?>

