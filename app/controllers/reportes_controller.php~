<?php

  class ReportesController extends AppController{

      var $name = 'Reportes';
      var $components = array('RequestHandler','Session');
      var $helpers = array('Html','Form','Ajax','Javascript','Js','GoogleMap','Pdf');
      var $uses = array(
// 						'FlujoIngresos',
// 						'FlujoPrepIngresos',
// 						'FlujoEgresos',
// 						'FlujoImpuestos',
						'AccountsViews',// the view for the accounts
						'Accounts', // this fix the static data
						'Realms',
						'RealmsClass',
						'RealmsClassViews', // the view for RealmsClass
						'Flujo', // end of the models for fix the staticnes
// 						'FlujoAnexo',
// 						'Anexos',
// 						'Cuentas',
// 						'Conceptos',
// 						'DirAnexos',
						'FlujoSaldo'
				  );
// totales
	  function GetSaldo(){ // fix for get data from database
		if(!isset($_SESSION['week']['week']) and !isset($_SESSION['week']['year'])){
			$Curweek = date('W');
			$CurYear = date('Y');
			$CurMonth = date('m');
		}else{
			$Curweek = $_SESSION['week']['week'];
			$CurYear = $_SESSION['week']['year'];
			$CurMonth = $_SESSION['week']['month'];
		}
// 		$Saldo = $this->GetCurrentWeek()['Saldo'];
		$Saldo = $this->FlujoSaldo->getSaldo($Curweek,$CurYear,$status='Active',$CurMonth);

		if(!empty($Saldo)){ // Remenber the Retrieve data is from current Week
		  $getSaldoFunc = $Saldo['FlujoSaldo'];
		  $saldo['real'] = $getSaldoFunc['real'];
		  $saldo['presupuesto'] = $getSaldoFunc['presupuesto'];
		  $saldo['id_kingdoms'] = $_SESSION['Auth']['User']['id_empresa'];
		  $saldo['month'] = $getSaldoFunc['month'];
		}else{
		  $saldo['real'] = null;
		  $saldo['presupuesto'] = null;
		  $saldo['id_kingdoms'] = null;
		  $saldo['month'] = null;
		}
		$_SESSION['Getdata']['Saldo'] = $saldo;
		return $saldo;
	  } // End GetSaldo

		function ViewConfig(){
		  /** @Build the @config vars **/
		  $_SESSION['viewConfig'] = null;

		  $_SESSION['viewConfig']['width'] = '320';
		  $_SESSION['viewConfig']['height'] = '80';
		  $_SESSION['viewConfig']['fontSize'] = '160';
		  $_SESSION['viewConfig']['fontSizeTitle'] = '110';
		  
		  if(!isset($_SESSION['Getdata']['Saldo'])){
			$saldo = $this->GetSaldo();
		  }else{
			$saldo = $_SESSION['Getdata']['Saldo'];
		  }
		  $this->set('saldo',$saldo);
// 		  $this->set('saldo',$this->GetSaldo());
		  $this->set('RealmsClass',$this->RealmsClass->getAccount(/*$setStatus=true*/));
		}

		
		function ModelTest(){
		  pr($_SESSION['Auth']['User']);
// 		  $_SESSION['Auth']['User']['id_empresa'] = '1';
// 		  $_SESSION['Auth']['User']['empresa'] = 'Bonampak';
// 		  $_SESSION['Auth']['User']['id_empresa'] = '2';
// 		  $_SESSION['Auth']['User']['empresa'] = 'ATM';
// 		  pr($_SESSION['Auth']['User']);
		  exit();
// 		  pr('current month is :'. $_SESSION['week']['month']);
// 		  pr($this->Flujo->getFlujo($week='31',$year='2014',$status='Active',$month='08'));
// 		  pr($this->FlujoSaldo->getSaldo($week='31',$year='2014',$status='Active',$month='7'));
		  pr($this->GetSaldo());
		  
		  exit();
		  App::Import('Shell', 'Shell');
		  App::Import('Vendor',array('shells/calendar'));
			$myCalendar = new CalendarShell(new Object());
			$myCalendar->initialize();

			$calendar = $myCalendar->main($year=date('Y'),false);
			$ical = $myCalendar->DaysInMonth($year); //Get the days in CurrentMonth from specific method in CalendarShell
// 			pr($calendar);pr($ical);
		  exit();

		} // End model ModelTest
		
		function week($week=null,$year=null){
			pr($this->data);

			App::Import('Shell', 'Shell');
			App::Import('Vendor',array('shells/calendar'));
			$myCalendar = new CalendarShell(new Object());
			$myCalendar->initialize();

			$calendar = $myCalendar->main($year,false);
// 			pr($calendar);
			foreach($calendar['days'] as $month => $dia){
// 				pr($month);
				foreach($dia as $num_dia => $dia_detail){
					$week[$month][$dia_detail['week']][$num_dia] = $dia_detail['sp_short'];
// 		    		pr($dia_detail);
				}
// 				pr($dia);
			}
	    
			pr($week);
	    	exit();
		} // End
		

	  function upToDate(){
// 		pr($this->data);
		  if(empty($this->data)){
			$this->read($this->data);
		  }else{
			if(($this->data['Flujo']['week'])){
// 			  $extract_w = explode('-',$this->data['Flujo']['week']);
// 			  $year = $extract_w['0'];
// 			  $week = str_replace('W','',$extract_w['1']);

			  $fecha = $this->data['Flujo']['week'];
			  $getWeek = explode('-',$fecha);

			  $year = $getWeek['0'];
			  $month = $getWeek['1'];
			  $day = $getWeek['2'];
			  $week = date('W',mktime(0,0,0,$month,$day,$year));

			  $lastDate['year'] = $year;
			  $lastDate['month'] = $month;
			  $lastDate['day'] = $day;
			  $lastDate['week'] = $week;
			  $_SESSION['lastDate'] = $lastDate;

			  $_SESSION['week']['year'] = $year;
			  $_SESSION['week']['week'] = $week;
			  $_SESSION['week']['month'] = $month;
			}
		  }
		  
		  if(!isset($_SESSION['Getdata']['Saldo'])){
			$saldo = $This->GetCurrentWeek()['Saldo'];
		  }else{
			$saldo = $_SESSION['Getdata']['Saldo'];
		  }
		  
		  $this->set('saldo',$saldo);
		  $this->set('RealmsClass',$this->RealmsClass->getAccount(/*$setStatus=true*/));
		  $this->set('estimate',$this->GetCurrentWeek());
	  }
	  
	  function GetCurrentWeek($index=null){

		if(!isset($_SESSION['week']['week']) and !isset($_SESSION['week']['year'])){
			$Curweek = date('W');
			$CurYear = date('Y');
			$CurMonth = date('m');
		}else{
			$Curweek = $_SESSION['week']['week'];
			$CurYear = $_SESSION['week']['year'];
			$CurMonth = $_SESSION['week']['month'];
		}
		  $Conditions['week'] = $Curweek;
		  $Conditions['status'] = 'Active';
		  $flujo = $Getdata['flujo'] = $this->Flujo->getFlujo($week=$Curweek,$year=$CurYear,$status='Active',$CurMonth);
		  $Getdata['RealmsClass'] = $this->RealmsClass->find('all');

// 		  $Getdata['Ingresos'] = $this->FlujoIngresos->find('first',array('conditions'=>$Conditions));
// 		  $Getdata['Impuestos'] = $this->FlujoImpuestos->find('first',array('conditions'=>$Conditions));
// 		  $Getdata['Egresos'] = $this->FlujoEgresos->find('first',array('conditions'=>$Conditions));

		  
// 		  $Getdata['Saldo'] = $this->FlujoSaldo->find('first',array('conditions'=>$Conditions));
		  $Getdata['Saldo'] = $this->FlujoSaldo->getSaldo($Curweek,$CurYear,$status='Active',$CurMonth);
// 		  $flujo = $this->Flujo->getFlujo($week=$Curweek,$year,$status='Active');
		  
		  foreach($Getdata['RealmsClass'] as $key => $realmsClass){
			foreach($realmsClass['Accounts'] as $idx => $accounts){
			  if(isset($flujo[$accounts['id_accounts']])){
				if(!isset($total[$realmsClass['RealmsClass']['realms_class']])){
				  $total[$realmsClass['RealmsClass']['realms_class']] = null;
				}
				$total[$realmsClass['RealmsClass']['realms_class']] += $flujo[$accounts['id_accounts']]['Flujo']['presupuesto'];
				if(!isset($totalByRealm[$realmsClass['Realms']['realm']])){
				  $totalByRealm[$realmsClass['Realms']['realm']] = null;
				}
				$totalByRealm[$realmsClass['Realms']['realm']] += $flujo[$accounts['id_accounts']]['Flujo']['presupuesto'];
			  }
			}
		  }
		  
		  
		  if(isset($total)){
			$Getdata['totals'] = $total;
		  }else{
			$Getdata['totals'] = null;
		  }
		  if(isset($totalByRealm)){
			$Getdata['totales'] = $totalByRealm;
		  }else{
			$Getdata['totales'] = null;
		  }
		  
// // 		  pr($totalByRealm);
		  
// 		  $ingresos=array('concreto','cemento','otros','traspaso');
// 		  $Getdata['Ingresos']['FlujoIngresos']['total_ingresos'] = null;
// 		  foreach( $ingresos as $key => $description){
// 			if(!isset($Getdata['Ingresos']['FlujoIngresos'][$description])){
// 			  $Getdata['Ingresos']['FlujoIngresos'][$description] = null;
// 			}
// 			$Getdata['Ingresos']['FlujoIngresos']['total_ingresos'] += $Getdata['Ingresos']['FlujoIngresos'][$description];
// 		  }
// 		  $GstNormOp=array(	'catorcenal',
// 							'confidencial',
// 							'administrativa',
// 							'telmex',
// 							'cfe',
// 							'pemex',
// 							'peajes',
// 							'enlonadas',
// 							'seguros',
// 							'manufactura',
// 							'manpower',
// 							'reembolso'
// 					);
// 		  $Getdata['Egresos']['FlujoEgresos']['total_egresos'] = null;
// 		  foreach( $GstNormOp as $key => $description){
// 			if(!isset($Getdata['Egresos']['FlujoEgresos'][$description])){
// 			  $Getdata['Egresos']['FlujoEgresos'][$description] = null;
// 			}
// 			$Getdata['Egresos']['FlujoEgresos']['total_egresos'] += $Getdata['Egresos']['FlujoEgresos'][$description];
// 		  }
// 		  $impuestos=array(	'imss',
// 							'iss',
// 							'estatal',
// 							'istp',
// 							'ietu',
// 							'otros',
// 							'iva',
// 							'provisiones'
// 					);
// 		  $Getdata['Impuestos']['FlujoImpuestos']['total_impuestos'] = null;
// 		  foreach( $impuestos as $key => $description){
// 			if(!isset($Getdata['Impuestos']['FlujoImpuestos'][$description])){
// 			  $Getdata['Impuestos']['FlujoImpuestos'][$description] = null;
// 			}
// 			$Getdata['Impuestos']['FlujoImpuestos']['total_impuestos'] += $Getdata['Impuestos']['FlujoImpuestos'][$description];
// 		  }
/**	
 *	@note => Build the optionList...
 */
// 		  Retrieve the data from db
		/** @Rebuild of @Anexos
		 **/
// 		$this->set('GetAccounts',$this->AnxModel(null,'1')['accounts']);
// 		if(isset($index)){
// 		  $Getdata['GetAnexo'] = $this->Anexos->getAnexo($Curweek,'1'); // as firts entry set to anexo A
// 		}else{
// 		  if(isset($_SESSION['anexo'])){
// 		  $Getdata['GetAnexo'] = $this->Anexos->getAnexo($Curweek,$_SESSION['anexo']);
// 		  $conditionsAnx['Anexos.week'] = $Curweek;
// 		  $conditionsAnx['Anexos.id_dir_anexo'] = $_SESSION['anexo'];
// 		  $conditionsAnx['Anexos.status'] = 'Active';
// 		  $Getdata['GetAnexoInput'] = $this->Anexos->find('all',array('conditions'=>$conditionsAnx));
// 		  }
// 		}
// 		
// 		$dir_anexo = $this->DirAnexos->find('list',array('fields'=>array('id_dir_anexo','nombre'),'conditions'=>array('status'=>'Active')));
// 		foreach($dir_anexo as $id_dir => $anexo){
// 		
// 		  $anxconditions['Anexos.id_dir_anexo'] = $id_dir;
// 		  $anxconditions['Anexos.week'] = $Curweek;
// 		  $anxconditions['Anexos.status'] = 'Active';
// 		  $getAnx[$id_dir] = $this->Anexos->find('all',array('conditions'=>$anxconditions));	  
// 		}
// 		foreach($dir_anexo as $idx_dir => $name_anexo){
// 			if(!isset($DirAnexos[$name_anexo])){
// 			  $DirAnexos[$name_anexo] = null;
// 			}
// 		  foreach($getAnx[$idx_dir] as $idx => $dataAnx){
// 			if(!isset($DirAnexos[$name_anexo]['total_importe'])){
// 			  $DirAnexos[$name_anexo]['total_importe'] = null;
// 			}if(!isset($DirAnexos[$name_anexo]['total_importe_prep'])){
// 			  $DirAnexos[$name_anexo]['total_importe_prep'] = null;
// 			}
// 			$DirAnexos[$name_anexo]['total_importe'] += $dataAnx['Anexos']['importe'];
// 			$DirAnexos[$name_anexo]['total_importe_prep'] += $dataAnx['Anexos']['importe_prep'];
// 		  }
// 		}
// 		  $Getdata['DirAnexos'] = $DirAnexos;
// 		  
// 		  $Getdata['totalEgresos'] = $Getdata['Egresos']['FlujoEgresos']['total_egresos'] + $Getdata['Egresos']['FlujoEgresos']['reembolso'] + $Getdata['Impuestos']['FlujoImpuestos']['total_impuestos'] + $Getdata['DirAnexos']['Anexo A']['total_importe_prep'] + $Getdata['DirAnexos']['Anexo B']['total_importe_prep'] + $Getdata['DirAnexos']['Anexo C']['total_importe_prep'];
		  $_SESSION['Getdata'] = $Getdata;
		return $Getdata; // Set the data in the view
	  }
	  
	  function SaldoSave(){ // fix for save the data to database

		  $_SESSION['data'] = $this->data;// Save the data into Session and display in function index

	  if(empty($this->data)){
		$this->read($this->data);
	  }else{

		if(($this->data['Flujo']['week'])){

		  $fecha = $this->data['Flujo']['week'];
		  $getWeek = explode('-',$fecha);

		  $year = $getWeek['0'];
		  $month = $getWeek['1'];
		  $day = $getWeek['2'];
		  $week = date('W',mktime(0,0,0,$month,$day,$year));

		  $lastDate['year'] = $year;
		  $lastDate['month'] = $month;
		  $lastDate['day'] = $day;
		  $lastDate['week'] = $week;
		  $_SESSION['lastDate'] = $lastDate;

		  $flujo = $this->Flujo->getFlujo($week,$year,$status='Active',$month);
		  if(!empty($this->data['Accounts'])){
			foreach($this->data['Accounts'] as $idx => $accounts){
			  
				$this->data['Accounts'][$idx]['week'] = $week;
				$this->data['Accounts'][$idx]['year'] = $year;
				$this->data['Accounts'][$idx]['month'] = $month;
				$this->data['Accounts'][$idx]['id_kingdoms'] = $_SESSION['Auth']['User']['id_empresa'];
			  if(empty($this->data['Accounts'][$idx]['presupuesto'])){
				unset($this->data['Accounts'][$idx]);
			  }
			}
			$this->Flujo->set($this->data['Accounts']);
			$this->Flujo->saveAll($this->data['Accounts']);
		  }
		  
// 		$_SESSION['data']['Accounts'] = $this->data['Accounts'];


// 		$index = array('1'=>'Ingresos','2'=>'Egresos','3'=>'Impuestos');
// // 		pr($this->data['Anexos']);
// 		if( !empty($this->data['Anexo']['id_cuenta']) and !empty($this->data['Anexo']['id_concepto']) ){
// 		  if(!isset($_SESSION['anexo'])){
// 			$this->data['Anexo']['id_dir_anexo'] = '1';
// 		  }else{
// 			$this->data['Anexo']['id_dir_anexo'] = $_SESSION['anexo'];
// 		  }
// 		  $this->data['Anexo']['week'] = $week;
// 		  $this->FlujoAnexo->save($this->data['Anexo']);
// 
// 		}else{
// 		  if( !empty($this->data['Anexos']) ){
// 				
// // 				$this->model->set($SaveData);
// // 				$this->model->saveAll($SaveDatas);
// 			unset($this->data['Anexos']['id_dir_anexo']);
// 			
// 			foreach($this->data['Anexos'] as $index => $Anexos){
// 			  $this->data['Anexos'][$index]['total_importe'] += $Anexos['importe'];
// 			  $this->data['Anexos'][$index]['total_importe_prep'] += $Anexos['importe_prep'];
// 			}
// // 			pr($this->data['Anexos']);
// 			$this->Anexos->saveAll($this->data['Anexos']);
// 		  }
// 		}
		$GetCurrentWeek = $this->GetCurrentWeek(); // Stands for compability
		$getSaldo = $GetCurrentWeek['Saldo'];
		
		if(/*!empty($this->data['Saldo']['real']) OR */!empty($this->data['Saldo']['presupuesto'])){
// 			$saldo['real'] = $this->data['Saldo']['real'];
			$saldo['presupuesto'] = $this->data['Saldo']['presupuesto'];
			$saldo['year'] = $year;
			$saldo['month'] = $month;
			$saldo['id_kingdoms'] = $_SESSION['Auth']['User']['id_empresa'];
			if(empty($getSaldo)){
			  $saldo['week'] = $week ;
			  $saldo['month'] = $month ;
			  $this->FlujoSaldo->save($saldo);
			}else{ // if week of saldo already exists then update 
				$this->FlujoSaldo->id = $getSaldo['FlujoSaldo']['id_saldo'];
				$this->FlujoSaldo->save($saldo);
			}
			$_SESSION['saldo'] = $saldo; // launch a callback function for update remote timer the index
			$flujo['saldo'] = $saldo;
		}

		$date = date('Y-m-d');
		$Getdata = $GetCurrentWeek; // get the data from db's
		  // pr($Getdata);exit();
/** @Build the filter to check empty fields coming and retrieve the data from database;
 *  @fix => get the data from database first and you don't need the filter well only for check the input
 **/	
// 		foreach($index as $idx => $index_name){
// 		  if( !empty($this->data[$index_name]) ){
// // 		  make the model selection
// 			$model = 'Flujo'.$index_name;
// 			$flujo[$index_name] = $this->data[$index_name];
// 			$flujo[$index_name]['week'] = $week;
// 			$flujo[$index_name]['fecha'] = $date;
// 			
// 		  		if(isset($Getdata[$index_name]['Flujo'.$index_name]['id_'.strtolower($index_name)])){
// 					$this->$model->id = $Getdata[$index_name]['Flujo'.$index_name]['id_'.strtolower($index_name)] ;
// 					$this->$model->save($flujo[$index_name]);
// 				}else{
// 				  $this->$model->save($flujo[$index_name]);
// 				}
// 		  }else{
// 			$flujo[$index_name] = null;
// 		  } // End else
// 		}
		
// 		$this->render('anexos','ajax');
		
		return $flujo;
		// week check
		}else{ // if no week is captured 
// 		  $this->Session->setFlash('Check your Week Input', 'flash_failure');
		} // End if week check
	  } // end this->data check

	  /** 
	   * @package => start insert anexos
	   */
	 }// End SaldoSave


/** @function update()
 * 	  @arg <debug = 'false'=>'true' , id = int , $val = false>
   ** @param var_returned => <set the frecuency of update >
   *  @package scriptaculous
   *  @function => yes,remote_timer in view
   ** @use => App::Import = false
   ** @set => the update frecuency of "saldo real" and "presupuesto" form in view index.ctp 
   *  @div => time
   **/
	function Ingresos(){
	  if(!isset($_SESSION['Getdata']['totales']['Ingresos'])){
		$getCurrentWeek = $this->GetCurrentWeek();
		if(!isset($getCurrentWeek['totales']['Ingresos'])){
		  $estimate['totales']['Ingresos'] = null;
		}else{
		  $estimate = $getCurrentWeek;
		}
	  }else{
		$estimate = $_SESSION['Getdata'];
	  }
	  
	  $this->set('estimate',$estimate);
	}
	
	function Egresos(){
	  if(!isset($_SESSION['Getdata']['totales']['Egresos'])){
		$getCurrentWeek = $this->GetCurrentWeek();
		if(!isset($getCurrentWeek['totales']['Egresos'])){
		  $estimate['totales']['Egresos'] = null;
		}else{
		  $estimate = $getCurrentWeek;
		}
	  }else{
		$estimate = $_SESSION['Getdata'];
	  }
	  
	  $this->set('estimate',$estimate);
	}
// 	function gastosNormalesOperacion(){
// 		$this->set('estimate',$this->GetCurrentWeek());
// 	}


	function div1(){
		$this->ViewConfig();
		$this->set('estimate',$_SESSION['Getdata']);
	}
	function div2(){
		$this->ViewConfig();
	    $this->set('estimate',$_SESSION['Getdata']);
	}

	function div3(){
		$this->ViewConfig();
		$this->set('estimate',$_SESSION['Getdata']);
	}
	
	function div4(){
		$this->ViewConfig();
		$this->set('estimate',$_SESSION['Getdata']);
	}
	
	function div5(){
		$this->ViewConfig();
		$this->set('estimate',$_SESSION['Getdata']);
	}
	function div6(){
		$this->ViewConfig();
		$this->set('estimate',$_SESSION['Getdata']);
	}
	function div7(){
		$this->ViewConfig();
		$this->set('estimate',$_SESSION['Getdata']);
	}
	function div8(){
		$this->ViewConfig();
		$this->set('estimate',$_SESSION['Getdata']);
	}


	function reembolsoDeFondoFijoDeCaja(){
		$this->set('estimate',$_SESSION['Getdata']);
	}
	function UpTotalImpuestosTd(){
		$this->set('estimate',$_SESSION['Getdata']);
	}
	function UpTotalEgresosId(){
		$this->set('estimate',$_SESSION['Getdata']);
	}
	function UpTotalEgresos(){
		$this->set('estimate',$_SESSION['Getdata']);
	}
	function UpEfectivoDisponibleId(){
		$this->set('estimate',$_SESSION['Getdata']);
		$this->set('saldo',$this->GetSaldo());
	}
	function UpSaldoDisponibleId(){
		$this->set('estimate',$_SESSION['Getdata']);
		$this->set('saldo',$this->GetSaldo());
	}
// 	function UpViewTotals(){
// 		$this->set('estimate',$this->GetCurrentWeek());
// 		$this->set('saldo',$this->GetSaldo());
// 	}
	
	
	function concept(){
// 	  pr($this->data['Anexo']['nombre']);
	  if(!isset($this->data)){
		$this->read($this->data);
	  }else{
		$conditions['Conceptos.id_cuenta'] = $this->data['Anexo']['id_cuenta'];
		$getConceptAnexo = $this->Conceptos->find('list',array('fields'=>array('id_concepto','concepto'),'conditions'=>$conditions));
	  }
	  $this->set('concepts',$getConceptAnexo);

	} // end function concept

	
	
	  function update($id=null,$val=null){ 
		$this->set('saldo',$this->GetSaldo());
		$this->layout = "ajax";
	  }
	  
	  function mes(){
		$this->set('Date',$this->index(true));
	  }
	  
/** @function Saldo()
 * 	  @arg <null>
   ** @param var_returned => <act as a bridge >
   *  @package scriptaculous
   *  @function => no,bridge for pass vars
   ** @use => App::Import = false
   ** @set => as tunnel
   *  @div => null
   **/
	  function Saldo(){ // only set the view for saldo edition
	  }
	  
/** @function index()
 * 	  @arg <null>
   ** @param var_returned => <print the firts page >
   *  @package scriptaculous
   *  @function => no,bridge for pass vars
   ** @use => App::Import = false
   ** @set => retrieve old data and get new data for export and update the db
   *  @div => null
   **/
      function index($get=null){ // print data and retrieve data for update the db
		
// 		pr($_SESSION);
// 		exit();
// 		if(isset($_SESSION['data'])){
// 		  pr($_SESSION['data']);
// // 		  exit();
// 		}
		// 		set permissions
		// >> Add month Specifications

		// >> Add month Specifications
		
		$this->set('st_egresos',true);
		if($_SESSION['Auth']['User']['level'] == '0'){
		  $this->set('status',false);
		}else{
		  $this->set('status',true);
		}
		$this->ViewConfig();
// 		unset($_SESSION['anexo']);
		if(!isset($_SESSION['lastDate'])){
		  $Date['year'] = date('Y');
		  $Date['month'] = date('m');
		  $Date['day'] = date('d');
		  $Date['week'] = date('W');
// 		  $this->set('Date',$Date);
		}else{
// 		  $this->set('Date',.'-'..'-'.);
		  $Date['year'] = $_SESSION['lastDate']['year'];
		  $Date['month'] = $_SESSION['lastDate']['month'];
		  $Date['day'] = $_SESSION['lastDate']['day'];
		  $Date['week'] = $_SESSION['lastDate']['week'];
// 		  $this->set('Date',$Date);
		}
		
		  App::Import('Shell', 'Shell');
		  App::Import('Vendor',array('shells/calendar'));
			$myCalendar = new CalendarShell(new Object());
			$myCalendar->initialize();
			$calendar = $myCalendar->main($year=date('Y'),false);
// 		  $this->set('month',$calendar['months'][$Date['month']]['spanish']); // set the monthName to the view
		  $Date['mes'] = $calendar['months'][(int)$Date['month']]['spanish'];
// 
		if(isset($get)){
		  return $Date;
		}else{
			$this->set('Date',$Date);
// 			$this->set('AnX',$this->getAnexos());
			$this->set('saldo',$this->GetSaldo());
			if(!isset($_SESSION['Getdata']['flujo'])){
			  $this->set('estimate',$this->GetCurrentWeek());
			}else{
			  $this->set('estimate',$_SESSION['Getdata']);
			}
		}
      } // end  index()

/** @function Estimado()
 * 	  @arg <vars to define>
   ** @param var_returned => <retrieve update data and set new one >
   *  @package scriptaculous
   *  @function => no
   ** @use => App::Import = false
   ** @set => retrieve old data and get new data for export and update the db
   *  @div => divEstimado
   **/
	  function Estimado(){ //set the view and handle the variables and save the data collected 
// 			if(!isset($_SESSION['Getdata'])){
// 			  $this->set('estimate',$this->GetCurrentWeek());
// 			}else{
// 			  $this->set('estimate',$_SESSION['Getdata']);
// 			}
		return $this->GetCurrentWeek();
	  }

// 	  function Anexo(){
// // 		pr($this->data);
// 		if($this->data['Flujo']['anexo'] == null){
// 		  $this->render('get_anexo','ajax');
// 		}else{
// 		  $anxid = $this->data['Flujo']['anexo'];
// 		  $_SESSION['anexo'] = $anxid;
// 		
// 	/** TODO @build from a db
// 	 *  maybe a function to know how many anexos have
// 	 *  and sustitute this code for a foreach struc 
// 	 *  @this->package its also interesting a module for db.table creation
// 	 **/
// // 		$AnX['0'] = 'data';
// 		$AnX = $this->getAnexos();
// 		$this->set('titleAnexo',$this->getAnexos()[$anxid]);
// 		
// 		/** TODO @build from a db **/
// 		
// 		$data = $this->AnxModel(null,$anxid);
// 		$this->set('accounts',$data['accounts']);
// 		$this->set('estimate',$_SESSION['Getdata']);
// 		$this->set('saldo',$this->GetSaldo());
// 		}
// 	  }

// 	  function AnxModel($dbAnexos=null,$anxid=null){
// 
// 		$conditions = null;
// 		$accounts = $this->Cuentas->find('list',array('fields'=>array('id_cuenta','cuenta'),'conditions'=>$conditions));
// 		$Options['accounts']['0'] = ' • Seleccionar Cuenta';
// 		$Options['accounts'] = $accounts;
// 		
// 		return $Options;
// 	  }
// 	  


  } //End Controller

?>