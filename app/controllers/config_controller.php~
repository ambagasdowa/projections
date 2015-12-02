<?php
  class ConfigController extends AppController{
	  var $name = 'Config';
      var $components = array('RequestHandler','Session');
      var $helpers = array('Html','Form','Ajax','Javascript','Js','GoogleMap','Pdf');
      var $uses = array(
// 						'Anexos',
						'Accounts',
						'Realms',
						'RealmsClass',
						'Flujo',
						'FlujoSaldo'
				  );

	  function ModelTest(){
		$accounts = $this->RealmsClass->getAccount(); // for the view
		pr($this->RealmsClass->find('list',array('fields'=>array('RealmsClass.id_realms_class','RealmsClass.realms_class'))));
// 		pr($this->RealmsClass->find('all'));
// 		return $accounts;
		exit();
	  }
	  

	  function getView(){
		
		$accounts = $this->RealmsClass->getAccount($setStatus=true); // for the view
		$view = null;
		$view['accounts'] = $accounts ;
		return $view;
	  }
	  
	  function addRow($id_realms_class=null){
// // 		$this->set('view',$this->getView());
		$this->set('id_realms_class',$id_realms_class);
	  }
	  
	  function ConfigRealmsClass(){
		if(!isset($this->data)){
		  $this->read($this->data);
		}else{
		  
		if(isset($this->data['Row'])){
		  $create = null;
			foreach($this->data['Row'] as $id_row => $dataRow){
			  if(isset($dataRow['account'])){
				$create[] = $dataRow;
			  }
			}
		  if(!empty($create)){
			$this->Accounts->set($create);
			$this->Accounts->saveAll($create);
			  $this->redirect('config/viewConfig');
		  }
		
		}

		  if(isset($this->data['RealmsClass'])){
				$RealmsClass = $this->RealmsClass->find('list',array('fields'=>array('id_realms_class','status')));
				$RealmsClassDb = $this->RealmsClass->find('all');
				foreach($RealmsClass as $id_realms_class => $status){
				  if(!isset($this->data['RealmsClass'][$id_realms_class])){
					$RealmsClass[$id_realms_class] = 'Inactive';
				  }else{
					$RealmsClass[$id_realms_class] = 'Active';
				  }
				}
				foreach($RealmsClassDb as $key => $realms_class){
				  $RealmsClassDb[$key]['RealmsClass']['status'] = $RealmsClass[$realms_class['RealmsClass']['id_realms_class']];
				  
				  $RealmsClassDb[$key]['RealmsClass']['realms_class'] = $this->data['RealmsClases'][$realms_class['RealmsClass']['id_realms_class']]['realms_class'];
				}
				$this->RealmsClass->set($RealmsClassDb);
				$this->RealmsClass->saveAll($RealmsClassDb);
		  }
		  if(isset($this->data['Accounts'])){

				$Accounts = $this->Accounts->find('list',array('fields'=>array('id_accounts','status')));
				$AccountsDb = $this->Accounts->find('all');
				foreach($Accounts as $id_accounts => $status){
				  if(!isset($this->data['Accounts'][$id_accounts])){
					$Accounts[$id_accounts] = 'Inactive';
				  }else{
					$Accounts[$id_accounts] = 'Active';
				  }
				}
				foreach($AccountsDb as $key => $accounts){
				  $AccountsDb[$key]['Accounts']['status'] = $Accounts[$accounts['Accounts']['id_accounts']];
				  $AccountsDb[$key]['Accounts']['account'] = $this->data['Account'][$accounts['Accounts']['id_accounts']]['account'];
				  $AccountsDb[$key]['Accounts']['description'] = $this->data['Account'][$accounts['Accounts']['id_accounts']]['description'];
				}
				$this->Accounts->set($AccountsDb);
				$this->Accounts->saveAll($AccountsDb);
		  }
		}

		$this->set('view',$this->getView());
		$this->redirect('config/viewConfig');
		
	  } // End's function

	  function viewConfig(){
		$this->set('view',$this->getView());
	  }
	  
	  function index(){

	  }

  }
?>