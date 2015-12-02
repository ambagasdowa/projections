<?php
  class ProjectionsController extends AppController{

      var $name = 'Projections';
      var $components = array('RequestHandler','Session');
      var $helpers = array('Html','Form','Ajax','Javascript','Js','GoogleMap','Pdf','GChart');
      var $uses = array('Empresas','Operacion','OperacionMensual','Fleets','FleetsAtm','FleetsTei','Presupuesto',
			'MssqlAreasTbk','MssqlFlotasTbk','MssqlDespStatusTbk','MssqlUnidadesAsignadasTbk','MssqlPersonalPersonalTbk',
			'MssqlAreasAtm','MssqlFlotasAtm','MssqlDespStatusAtm','MssqlUnidadesAsignadasAtm','MssqlPersonalPersonalAtm',
			'MssqlAreasTei','MssqlFlotasTei','MssqlDespStatusTei','MssqlUnidadesAsignadasTei','MssqlPersonalPersonalTei',
			'MssqlTipoOperacionTbk',
			'MssqlFraccionTbk',
			'MssqlViajesRtTbk',
			'Areas',
			'AreasAtm',
			'AreasTei',
			'Flotas',
			'FlotasAtm',
			'FlotasTei',
			'TipoOperacion',
			'TipoOperacionAtm',
			'TipoOperacionTei',
			'Fraccion',
			'TonelajeCurrent',
			'TonelajeCurrentAtm',
			'TonelajeCurrentTei',
			'KmsCurrent',
			'KmsCurrentAtm',
			'KmsCurrentTei',
			'IngresosCurrent',
			'IngresosCurrentAtm',
			'IngresosCurrentTei',
			'User'
			);
 /** @variant: in var $uses drop the models => TraficoGuia and TraficoRenglonGuia
  */


  function viewConsole(){
		App::Import('Shell', 'Shell');
		App::Import('Vendor',array('shells/sniffer_data'));
		$myShell = new SnifferDataShell(new Object());
		$myShell->initialize();
	// 	Select the method to call
		$Shell = $myShell->main($view=true,$debug=false,$year='2015');
// 		$Shell = $myShell->detail();
		pr($Shell['kms']['count']['count_day_merge']['1']);exit();
// 		exit();
  }
  
  function dropTabs(){
	pr(userConfig());
  }
  
  function viewConsoleCounter(){
		App::Import('Shell', 'Shell');
		App::Import('Vendor',array('shells/sniffer_data'));
		$myShell = new SnifferDataShell(new Object());
		$myShell->initialize();
	// 	Select the method to call
		$Shell = $myShell->main($view=true,$debug=false);
// 		$Shell = $myShell->detail();
		pr($Shell['kms']['count']['count_day']);exit();
  }
  
  function Empresas(){
	$EmpConditions['Empresas.active'] = '1'; // Check if the area is alive
	$empresas = $this->Empresas->find('list',array('fields'=>array('id_empresa','empresa'),array('conditions'=>$EmpConditions)));
	$corp = null;
	
	foreach($empresas as $key => $value){
	    if($key == $_SESSION['Auth']['User']['id_empresa']){
		  if($_SESSION['Auth']['User']['id_empresa']== '1'){ // only for Bonmapak
			  $_append = null;
		  }else{
			  $_append  = substr(ucwords(strtolower($value)),0,3);
		  }
	    }
	} // End foreach of empresas
	return $_append;
  }

  /** @function areas()
   ** @get empresas an get the areas as flotas indeed so this is root
   ** @param <set true to return data as variable> <set true to set the variables in view> 
   ** @var for both modes the returned var are in set mode :: $areas = array()
   **/    
   function areas(){
	  $_append = $this->Empresas();
// 	  $extract = array();
	  $model['area'] = 'Areas'.$_append;
	    $FindAreas = $this->$model['area']->find('list',array('fields'=>array('id_area','nombre')));
	// Check if sre Bonampak selected and do the maths
	    if($_SESSION['Auth']['User']['id_empresa']== '1'){ // This is for Bonampak and always will be 
		  foreach($FindAreas as $key => $data){
			  $extract[$key] = explode('BONAMPAK',$data);
		  }
	    }else{
		  foreach($FindAreas as $key => $data){
		  $extract[$key] = explode(' ',$data);
			if(isset($extract)){ // is $extract created?
				if(in_array('MACUSPANA' ,$extract[$key])){
			  $extract = 'MACUSPANA';
			  break;
				}if(in_array('ESPECIALIZADA' ,$extract[$key])){
			  $extract = 'TEISA';
			  break;
				}
			} // End $extract comprobation
		  }
	    }
	// Set the areas var
	$areas['0'] = 'Todas las Areas';
	  if(is_array($extract)){
	    foreach($extract as $key => $data){
	      foreach($data as $k => $v){
			if($v !== ' '){
			  $areas[] = trim(ucwords(strtolower($v)));
			}
	      }
	    }
	  }else{ // End array comprobation
	    $areas['1'] = trim(ucwords(strtolower($extract)));
	  }

// 	  filterUser($email=null,$dropAreas=null,$areas=null);

	  return $areas;
   }
  
  /** @function fleets()
   ** @param <set true to return data as variable> <set true to set the variables in view> 
   ** @var for both modes the returned var are in set mode :: $fleets = array($fleet,$flota)
   **/    
   function fleets($return=null,$set=null){
	$_append = $this->Empresas();
	  $model['flotas'] = 'Flotas'.$_append;
	    $SearchFleets = $this->$model['flotas']->find('all');
	    $TipoOperacion = 'TipoOperacion'.$_append;
	    $Flotas = 'Flotas'.$_append;
	$area = $this->areas();
	$flota['0'] = null;
	for($i=1;$i<=count($area);$i++){
	  $flota[$i] = null;
	}

	foreach($SearchFleets as $key => $value){
	  if(!empty($SearchFleets[$key][$TipoOperacion])){
	  
	    $fleet[$SearchFleets[$key][$Flotas]['id_area']][$SearchFleets[$key][$Flotas]['id_flota']] = $SearchFleets[$key][$Flotas]['nombre'];
	    foreach($SearchFleets[$key][$TipoOperacion] as $k => $v){
	    
	      $fleet[$SearchFleets[$key][$Flotas]['id_area']][$SearchFleets[$key][$Flotas]['id_flota']] .= ','.$SearchFleets[$key][$TipoOperacion][$k]['id_tipo_operacion'];
	      
	      $flota[$SearchFleets[$key][$Flotas]['id_area']] .= ','.$SearchFleets[$key][$TipoOperacion][$k]['id_tipo_operacion'];
	    }
	  }
	}
	
	$fleets['fleet'] = $fleet; 
	$fleets['flota'] = $flota;
	$_SESSION['projections']['fleets'] = $fleets;

      if($return == false && $set == true){
	  $this->set('fleets',$fleets);
      }elseif($return == true && $set == false){
	  return $fleets;
      }
   } // End's function fleets()   
  /** @function month()
   ** @param <var returned> <vars set in view> <the year> 
   ** TODO use this as global research about controller::method import use AppController
   ** for now will generate an array
   **/    
   function months($return=null,$set=null,$year=null){
      
      // firts make the month and classified according to given year
      // this is going to define section
      $translate = array(
		'1'=>'Enero',
		'2'=>'Febrero',
		'3'=>'Marzo',
		'4'=>'Abril',
		'5'=>'Mayo',
		'6'=>'Junio',
		'7'=>'Julio',
		'8'=>'Agosto',
		'9'=>'Septiembre',
		'10'=>'Octubre',
		'11'=>'Noviembre',
		'12'=>'Diciembre'
      );
      for($i=1;$i<=12;$i++){
     	$months[$i]['spanish'] = $translate[$i];
		$months[$i]['large'] = date('F',mktime('0','0','0',$i,'01',$year));
		$months[$i]['short'] = date('M',mktime('0','0','0',$i,'01',$year));
		$months[$i]['numeric'] = date('m',mktime('0','0','0',$i,'01',$year));
		$months[$i]['num'] = date('n',mktime('0','0','0',$i,'01',$year));
		$months[$i]['days'] = date('t',mktime('0','0','0',$i,'01',$year));
		$months[$i]['leap'] = date('L',mktime('0','0','0',$i,'01',$year));
      }
      // Now select if set the vars to the view or return the vars to the controller
      if($return == false && $set == true){
	  $this->set('months',$months);
      }elseif($return == true && $set == false){
	  return $months;
      }
   } // End's function months()

	function getFraction($status=null){
		$conditions = null; // lets create the conditions vessel
	   if(!empty($status)){
		$conditions['Fraccion.status'] = $status;
	   }
		$fraction = $this->Fraccion->find('list',array('fields'=>array('id','fraccion'),'conditions'=>$conditions));
		return $fraction;
	}

/** TODO : Make a function to call this process
  * @define  : the same thing , the function to call it $this->MyFunc($year,$month,$other){...}
  *	          make this to be Dynamic
  * 	       default behavior could be current year and month
  * @var Define the table area for now will define an array() to do the same job
  */
  function UpdateArea($id=null){
// 		pr($_GET);//this is for send data via url
// 		pr($_POST); // and this send data via headers
// 		pr($_ENV);
// 		pr($_REQUEST);
// 		 header('HTTP/1.1 420 Enhance Your Calm');
// 		 pr(header);

// http_redirect("relpath", array("name" => "value"), true, HTTP_REDIRECT_PERM);

// HTTP/1.1 301 Moved Permanently
// X-Powered-By: PHP/5.2.2
// Content-Type: text/html
// Location: http://www.example.com/curdir/relpath?name=value&PHPSESSID=abc
// 
// Redirecting to <a href="http://www.example.com/curdir/relpath?name=value&PHPSESSID=abc">http://www.example.com/curdir/relpath?name=value&PHPSESSID=abc</a>.

		if($this->data['Projections']['area'] === '0'){
			$this->redirect($this->webroot.'projections');
		}
		if(!isset($_SESSION['projections']['months'])){
		  $_SESSION['projections']['months'] = $this->months($return=true,$set=false,$year=date('Y'));
		}
		$months = $_SESSION['projections']['months'];
		  $AreaCorp['months'] = $months;
		  $AreaCorp['id_area'] = $this->data['Projections']['area'];
		  $area = $this->areas();
		  if(!isset($_SESSION['projections']['operacion'])){
				$this->operations();
		  }
		  $Oper = $_SESSION['projections']['operacion'];
// 		  pr($Oper);
// 		  if(!isset($area[$this->data['Projections']['area']])){
// 			$area[$this->data['Projections']['area']] = 'Todas las Areas';
// 		  }
			$AnualOperationArea = $Oper['totalToneladasYearlyByArea'][$_SESSION['Auth']['User']['id_empresa']][$area[$this->data['Projections']['area']]];
		  
// 		  pr($this->data['Projections']['area']);
	  // TODO: this is done from hir
			if(!empty($this->data['Projections']['area'])){
			  $AreaCorp['fraccion'] = '1';
			  $AreaCorp['Area'] = $area[$this->data['Projections']['area']]; 
			  $AreaCorp['TotalMes'] = $AnualOperationArea;
			}else{

				$AreaCorp['fraccion'] = null;
				$AreaCorp['Area'] = null;
				$AreaCorp['TotalMes'] = null;
// 				$this->redirect('/projections/index');
// 				pr($this->webroot.'projections/');

// 				$this->Session->setFlash('Your post has been saved.');
				$this->redirect($this->webroot.'projections');
// 				echo $this->Html->link('Delete',
// 										array('action' => 'delete', $post['Post']['id']),
// 										null,
// 										'Are you sure?'
// 				);
// 				$this->redirect(array("controller" => "projections", 
// 									"action" => "index",
// 									"param1" => "val1",
// 									"param2" => "val2",
// 									$data_can_be_passed_here),
// 								$status,
// 								$exit);
// 				$this->render('index');
// 				$this->layout('index');
// 				pr('<div id="warning"><span>Seleccione un Area</span></div>');
// 				break;
// 				exit();
			}// End empty this->data
// ALERT : To hir .
		$this->set('AreaCorp',$AreaCorp);
// ALERT Begin the flotas section
		  if(!isset($_SESSION['projections']['fleets'])){
			$_SESSION['projections']['fleets'] = $this->fleets(true,false);
			$this->set('fleets',$_SESSION['projections']['fleets']);
		  }else{
			$this->set('fleets',$_SESSION['projections']['fleets']);
		  }
      } // End UpdateArea() as Tonelaje

      function Kms(){
		$AreaCorp['id_area'] = $this->data['Projections']['area'];
		$AreaCorp['fraccion'] = '0';
		if(!isset($_SESSION['projections']['months'])){
		  $_SESSION['projections']['months'] = $this->months($return=true,$set=false,$year=date('Y'));
		}
		$months = $_SESSION['projections']['months'];
		$AreaCorp['months'] = $months;
	// 	$area = array('0'=>'Todas las Areas','1'=>'Orizaba','2'=>'Guadalajara','3'=>'Ramos Arizpe','4'=>'Tijuana');
		$area = $this->areas();
		  if(!isset($_SESSION['projections']['operacion'])){
				$this->operations();
		  }
		  $Oper = $_SESSION['projections']['operacion'];
		$AnualOperationArea = $Oper['totalKilometrosYearlyByArea'][$_SESSION['Auth']['User']['id_empresa']][$area[$this->data['Projections']['area']]];
		
// 		foreach($area as $key => $data){
// 			$kms_all[$area[$key]] = null;
// 			$full[$area[$key]] = null;
// 		}
// 		$CurrentYear = date('Y');
// 		$CurrentMonth = date('m');
// 	// 	$CurrentMonth = '01';
// 		foreach($area as $key => $value){
// 		  $KmsConditions['KmsCurrent'.$_append.'.fecha_guia LIKE'] = "%".$CurrentYear."-".$CurrentMonth."%";
// 		  $KmsConditions['KmsCurrent'.$_append.'.id_area'] = $key;
// 	// 	  $KmsConditions['KmsCurrent.id_fraccion'] = '1';
// 		  $SearchKms = $this->$model['kms']->find('all',array('conditions'=>$KmsConditions));
// 		  $KmsConditions = $kms = null ;
// 		  foreach($SearchKms as $kh => $value){
// 			  if($value[$model['kms']]['id_configuracionviaje'] == '3'){
// 			$kms_full[$area[$key]][$value[$model['kms']]['no_viaje']][] = $value[$model['kms']]['kms_viaje'];
// 			  }elseif(($value[$model['kms']]['id_configuracionviaje'] == '2') OR ($value[$model['kms']]['id_configuracionviaje'] == '1')){
// 			$kms_all[$area[$key]] += $value[$model['kms']]['kms_viaje'];
// 			  }
// 		  }// End foreach SearchKms
// 		} // End foreach area
// 		  if(isset($kms_full)){
// 			foreach($kms_full as $k => $data){
// 			  foreach($data as $kr => $vr){
// 				$full[$k] += $vr['0'];
// 			  }
// 			} // End foreach $kms_full
// 		  }
// 		  foreach($area as $key => $data){
// 			  $kms[$data] = ($kms_all[$area[$key]] + $full[$area[$key]])*2;
// 		  }

		  /** ALERT Save the result for Display in the view
		  */
		  
		  if(!empty($this->data['Projections']['area'])){
// 			foreach($area as $key => $data){
// 			  if($this->data['Projections']['area'] == $key){
			$AreaCorp['Area'] = $area[$this->data['Projections']['area']];
			$AreaCorp['TotalMes'] = $AnualOperationArea;
// 			  } //End the area filter
// 			}// foreach $area filter
		  }else{
			  $AreaCorp['Area'] = null;
			  $AreaCorp['TotalMes'] = null;
			  pr('<div id="warning"><span>Seleccione un Area</span></div>');
			  exit();
		  }// End empty this->data
	// ALERT : To hir .
			$this->set('AreaCorp',$AreaCorp);
	// ALERT Begin the flotas section
			  if(!isset($_SESSION['projections']['fleets'])){
				$_SESSION['projections']['fleets'] = $this->fleets(true,false);
				$this->set('fleets',$_SESSION['projections']['fleets']);
			  }else{
				$this->set('fleets',$_SESSION['projections']['fleets']);
			  }

      } // End kms function


      function KmsDetail($year=null,$area=null,$fraccion=null,$flota=null,$name=null){

// 		Configure::write('debug', 2);
// 		debug($this->getDataOp($filter,'2'));

		  $filter['year'] = $year;
		  $filter['area'] = $area;
		  $filter['areaName'] =$this->areas()[$area];
		  $filter['fraccion'] = $fraccion;
		  $filter['flota'] = $flota;
		  $filter['fleet_name'] = ucwords(strtolower($name));
		  $filter['id_empresa'] = $_SESSION['Auth']['User']['id_empresa'];
// 		  debug($filter);
// 		  debug($this->getDataOp($filter,'2'));
		  // ALERT this can change having the table.db
		  $TpoOp = explode(',',$filter['flota']);
		if(!isset($_SESSION['projections']['months'])){
		$_SESSION['projections']['months'] = $this->months($return=true,$set=false,$year=date('Y'));
		}
		$months = $_SESSION['projections']['months'];

	  // 	$area = $this->areas();
// 		  $_append = $this->Empresas();
// 		  $model['kms'] = 'KmsCurrent'.$_append;

/** 	ALERT:Use this for the real table trafico_producto
*/
// 		describe fraccion
// 		select * from fraccion
// 		update fraccion set `status` = 'Inactive' where `id` in ('3','4','5','7');
// 		alter table `projections.fraccion` add column `status` enum('Active','Inactive') NOT NULL default 'Active',
		  
// 		$conditions['Fraccion.status'] = 'Active';
// 		pr($conditions);
		$fraction = $this->getFraction(null);
// 		pr($fraction);
// 		$fraction = $this->Fraccion->find('list',array('fields'=>array('id','fraccion'),
// 														'conditions'=>array('Fraccion.status'=>'Active')
// 													   )
// 										  );
// 		pr($fraction);
// 		  for($i=1;$i<=date('n');$i++){
// 			$kms[date('M',mktime('0','0','0',$i,'01',$year))] = null ;
// 			foreach($fraction as $h => $d ){
// 				$kms[date('M',mktime('0','0','0',$i,'01',$year))][$d] = null;
// 				$TotalByFraction[$d] = null;
// 			}
// 		  }
/** Variables to define
  * @param we need parameter for this !
  */
/** TODO in this section will check and deploy the total tonels by month and check in where 
 ** month we are and same thing for fraction and clean an reset your variables
 */ 
// 	foreach($months as $ky =>$dat){
// 	  foreach($fraction as $llave => $dato){
// 	    if($dat['num'] <= date('n')){
// 		$conditions[$dat['short']][$dato]['KmsCurrent'.$_append.'.fecha_guia LIKE'] = "%".$year."-".$dat['numeric']."%";
// 		
// 	      if($filter['area'] == true){
// 	    // Only check the area , will assume that 0 are all areas 
// 		$conditions[$dat['short']][$dato]['KmsCurrent'.$_append.'.id_area'] = $filter['area'];
// 	      }
// 		
// 	      if($filter['flota'] == true){
// 		foreach($TpoOp as $k => $val){
// 		    $conditions[$dat['short']][$dato]['OR'][$k]['KmsCurrent'.$_append.'.id_tipo_operacion'] = $val;
// 		}
// 	      }
// 	    $conditions[$dat['short']][$dato]['KmsCurrent'.$_append.'.id_fraccion'] = $llave ;
// 	    } // End if to current month dat[num]
// 	  } // End foreach fraction
// 	} //end foreach of months
// 	foreach($conditions as $key => $data){
// 	    foreach($fraction as $kv => $dta){
// 		$SearchKms[$key][$dta] = $this->$model['kms']->find('all',array('conditions'=>$conditions[$key][$dta]));
// 	    }
// 	}
// 
// 	$full = $kms_all = $kms_sum = $kms;
// 	foreach($SearchKms as $k => $datos){
// 	  foreach($fraction as $kh => $datamax){
// 	    foreach($SearchKms[$k][$datamax] as $key => $data){
// 	    /** ALERT:Will ask if configuracionviaje is full or sencillo
// 	    */
// // 	    $kms_full[$k][$datamax][$data[$model['kms']]['no_viaje']][] = $data[$model['kms']]['kms_viaje'];
// 	    
// 		if( ($data[$model['kms']]['id_configuracionviaje'] == '3')/* OR ($data[$model['kms']]['id_configuracionviaje'] == '2') OR ($data[$model['kms']]['id_configuracionviaje'] == '1')*/ ){
// 		    $kms_full[$k][$datamax][$data[$model['kms']]['no_viaje']][] = $data[$model['kms']]['kms_viaje'];
// 		}
// 		if(($data[$model['kms']]['id_configuracionviaje'] == '2') OR ($data[$model['kms']]['id_configuracionviaje'] == '1')){
// 		  $kms_all[$k][$datamax][$data[$model['kms']]['no_viaje']][] = $data[$model['kms']]['kms_viaje'];
// 		}
// 		 /*elseif(($data[$model['kms']]['id_configuracionviaje'] == '2') OR ($data[$model['kms']]['id_configuracionviaje'] == '1')){
//  		$kms_all[$k][$datamax] += $data[$model['kms']]['kms_viaje'];
//  	      }*/ // End if KmsCurrent[status_guia]
// 
// 	    } // End foreach $SearchKms[$k][$datamax]
// 	   } // End foreach $fraction
// 	 } // End foreach $SearchKms 1st level
// // 	 pr($kms_full);
// // 	 pr($kms_all);
// // 	 exit();
// 	 foreach($kms_sum as $key => $data){
// 	    if(isset($kms_full)){
// 	      if(isset($kms_full[$key])){
// 	      foreach($kms_full[$key] as $k => $value){
// 		foreach($value as $kf => $vf){
// 		  $full[$key][$k] += $vf['0'];
// 		} // End of Really!!
// 	      } // End foreach => $kms_full[$key]
// 	     } // End isset by month 
// 	    } // End isset=> $kms_full
// 	 } // End kms_sum
// // 	 $data = null;
// 	 foreach($kms_sum as $key => $data){
// 	    if(isset($kms_all)){
// 	      if(isset($kms_all[$key])){
// 	      foreach($kms_all[$key] as $k => $value){
// 		if(!is_null($value)){
// 		  foreach($value as $kf => $vf){
// 		    if(!isset($all[$key][$k])){
// 		      $all[$key][$k] = null;
// 		    }
// 		    $all[$key][$k] += $vf['0'];
// 		  } // End of Really!!
// 		} //is null checkpoint
// 	      } // End foreach => $kms_full[$key]
// 	     } // End isset by month 
// 	    } // End isset=> $kms_full
// 	 } // End kms_sum
// 	 pr($full);pr($all);exit();
// 	 pr($all);
// 		foreach($kms_sum as $month => $fraction_kms){
// 			  foreach($fraction_kms as $fraction_name => $kms_value){
// 				if(!isset($kms[$month][$fraction_name])){
// 				$kms[$month][$fraction_name] =  null;
// 				}
// 				if(empty($full[$month][$fraction_name])){
// 				$full[$month][$fraction_name] = 0;
// 				}
// 				if(empty($all[$month][$fraction_name])){
// 				$all[$month][$fraction_name] = 0;
// 				}
// 				$kms[$month][$fraction_name] = ($full[$month][$fraction_name] + $all[$month][$fraction_name]) * 2;
// 			  }
// 		}
// 	pr($kms);
// 	exit();
// 	$fraction_name = null ;
// 	foreach($kms as $month => $fraction_kms){
// 	  $total_kms_monthly[$month] = array_sum($fraction_kms);
// 	  foreach($fraction_kms as $fraccion_name => $kms_value){
// 	    $total_kms[$month][$fraction_name] += $kms[$month][$fraction_name];
// 	  }
// 	}
// 	pr($kms);
// 	pr($total_kms);
// 	pr(array_sum($total_kms_monthly));
// 	pr($total_kms);
// 	exit();
// // // check this for totales
// 		  foreach($months as $key => $data){
// 			foreach($fraction as $k => $d){
// 			  if(isset($kms[$data['short']])){
// 				$TotalByFraction[$d] += $kms[$data['short']][$d];
// 			  }
// 			}
// 		  }
// 		  foreach($kms as $key => $data){
// 			  $TotalByMonth[$key] = array_sum($data);
// 		  }
		  if(!isset($_SESSION['projections']['operacion'])){
				$this->operations();
		  }
		  if(isset($filter['area']) and $filter['area'] > 0 ){
			$Area = $this->areas()[$area];
			$kms = $_SESSION['projections']['operacion']['kilometrosMensuales'][$_SESSION['Auth']['User']['id_empresa']][$Area];
			$TotalByFraction = $_SESSION['projections']['operacion']['totalKilometrosByFractionAnual'][$_SESSION['Auth']['User']['id_empresa']][$Area];
			$TotalByMonth = $_SESSION['projections']['operacion']['totalKilometrosMensuales'][$_SESSION['Auth']['User']['id_empresa']][$Area];
		  }if($filter['area'] == 0){
			$kms = $_SESSION['projections']['operacion']['TotalKilometrosMensualesByFraction'][$_SESSION['Auth']['User']['id_empresa']];
			$TotalByFraction = $_SESSION['projections']['operacion']['totalKilometrosAreaAnual'][$_SESSION['Auth']['User']['id_empresa']];
			$TotalByMonth = $_SESSION['projections']['operacion']['totalKilometrosOperacionMensual'][$_SESSION['Auth']['User']['id_empresa']];
		  }
		  
		  
// 			Configure::write('debug', 2);
// 			debug();
// 		  this happend only if flota from Guadalajara exists
		  if($filter['flota'] > 1 and $filter['area'] === '2') {
// 			pr($this->getDataOp($filter,null,$fraction));
			$Totales = $this->getDataOp($filter,'2');
			$TotalByYear = $Totales['TotalByYear'];
			$_SESSION['projections']['index']['KmsIndex'] = $KmsIndex = $TotalByYear ;
			$kms = $Totales['kms'];
		  } else {

			$TotalByYear = array_sum($TotalByMonth);
			$_SESSION['projections']['index']['KmsIndex'] = $KmsIndex = $TotalByYear ;
			$Totales['TotalByYear'] = $TotalByYear;
			$Totales['TotalByMonth'] = $TotalByMonth;
			$Totales['TotalByFraction'] = $TotalByFraction;
		  }
		  
		  
// 		  $TotalByYear = array_sum($TotalByMonth);
// 		  $_SESSION['projections']['index']['KmsIndex'] = $KmsIndex = $TotalByYear ;
// 		  $Totales['TotalByYear'] = $TotalByYear;
// 		  $Totales['TotalByMonth'] = $TotalByMonth;
// 		  $Totales['TotalByFraction'] = $TotalByFraction;

		  $this->set('KmsIndex',$KmsIndex);
		  $this->set('Totales',$Totales);
		  $this->set('kms',$kms);
		  $this->set('months',$months);
		  $this->set('fraccion',$fraction);
		  $this->set('filter',$filter);
      }// End Function KmsDetail
      
      function Ingresos(){

		  $AreaCorp['months'] = $this->months(true,false,date('Y'));
		  $area = $this->areas();
		  if(!isset($_SESSION['projections']['operacion'])){
				$this->operations();
		  }
		  $Oper = $_SESSION['projections']['operacion'];
		  $AnualOperationArea = $Oper['totalIngresosYearlyByArea'][$_SESSION['Auth']['User']['id_empresa']][$area[$this->data['Projections']['area']]];

		if(!isset($_SESSION['projections']['months'])){
		  $_SESSION['projections']['months'] = $this->months($return=true,$set=false,$year=date('Y'));
		}
		$months = $_SESSION['projections']['months'];
		
		  $AreaCorp['ingresos_all'] = $AnualOperationArea;
		  $AreaCorp['Area'] = $area[$this->data['Projections']['area']];
		  $AreaCorp['id_area'] = $this->data['Projections']['area'];
		  $AreaCorp['fraccion'] = '0';
				if(!isset($_SESSION['projections']['fleets'])){
				  $_SESSION['projections']['fleets'] = $this->fleets(true,false);
				  $this->set('fleets',$_SESSION['projections']['fleets']);
				}else{
				  $this->set('fleets',$_SESSION['projections']['fleets']);
				}
		  $this->set('AreaCorp',$AreaCorp);
	  }//End ingresos()
			
	  function IngresosDetail($year=null,$area=null,$fraccion=null,$flota=null,$name=null){
		  
// 		Configure::write('debug', 2);

		  $filter['year'] = $year;
		  $filter['area'] = $area;
		  $filter['areaName'] =$this->areas()[$area];
		  $filter['fraccion'] = $fraccion;
		  $filter['flota'] = $flota;
		  $filter['fleet_name'] = ucwords(strtolower($name)); // dd this in the other
		  $filter['id_empresa'] = $_SESSION['Auth']['User']['id_empresa'];
		  
// 		  debug($this->getDataOp($filter,'3'));
	  // 	pr($filter);
		  // ALERT this can change having the table.db
		  $TpoOp = explode(',',$filter['flota']);
		if(!isset($_SESSION['projections']['months'])){
		  $_SESSION['projections']['months'] = $this->months($return=true,$set=false,$year=date('Y'));
		}
		$months = $_SESSION['projections']['months'];

	  // 	$area = $this->areas();
// 		  $_append = $this->Empresas();
// 		  $model['ingresos'] = 'IngresosCurrent'.$_append;
		  
	  /** 	ALERT:Use this for the real table trafico_producto
	  */
// 		  $fraction = $this->Fraccion->find('list',array('fields'=>array('id','fraccion')));
		  $fraction = $this->getFraction(null);
// 		  for($i=1;$i<=date('n');$i++){
// 			$SumIngress[date('M',mktime('0','0','0',$i,'01',$year))] = null ;
// 			foreach($fraction as $h => $d ){
// 				$SumIngress[date('M',mktime('0','0','0',$i,'01',$year))][$d] = null;
// 			// make the array for TotalByFraction consider this for addition
// 				$TotalByFraction[$d] = null;
// 			}
// 		  }
	  /** Variables to define
		* @param we need parameter for this !
		*/
	  /** TODO in this section will check and deploy the total tonels by month and check in where 
	  ** month we are and same thing for fraction and clean an reset your variables
	  */
	  
// 		  foreach($months as $ky =>$dat){
// 			foreach($fraction as $llave => $dato){
// 			  if($dat['num'] <= date('n')){
// 			  $conditions[$dat['short']][$dato]['IngresosCurrent'.$_append.'.fecha_guia LIKE'] = "%".$year."-".$dat['numeric']."%";
// 			  
// 				if($filter['area'] == true){
// 			  // Only check the area , will assume that 0 are all areas 
// 			  $conditions[$dat['short']][$dato]['IngresosCurrent'.$_append.'.id_area'] = $filter['area'];
// 				}
// 			  
// 				if($filter['flota'] == true){
// 			  foreach($TpoOp as $k => $val){
// 				  $conditions[$dat['short']][$dato]['OR'][$k]['IngresosCurrent'.$_append.'.id_tipo_operacion'] = $val;    
// 			  }
// 				}
// 			  $conditions[$dat['short']][$dato]['IngresosCurrent'.$_append.'.id_fraccion'] = $llave ;
// 			  } // End if to current month dat[num]
// 			} // End foreach fraction
// 		  } //end foreach of months
		  
// 		  foreach($conditions as $key => $data){
// 			  foreach($fraction as $kv => $dta){
// 			  $SearchIngresos[$key][$dta] = $this->$model['ingresos']->find('all',array('conditions'=>$conditions[$key][$dta]));
// 			  }
// 		  }
// 		  $SearchIngress = null;
// 		  foreach($SearchIngresos as $k => $datos){
// 			foreach($fraction as $kh => $datamax){
// 			  foreach($SearchIngresos[$k][$datamax] as $key => $data){
// 			  /** ALERT:Make the maths only sum the subtotal
// 			  */
// 			  $SumIngress[$k][$datamax] += $data[$model['ingresos']]['subtotal'];
// 			  } // End foreach $SearchIngresos[$k][$datamax]
// 			} // End foreach $fraction
// 		  } // End foreach $SearchIngresos 1st level
// 		  foreach($SumIngress as $key => $data){
// 			  $TotalByMonth[$key] = array_sum($data);
// 		  }
// 		  foreach($SumIngress as $key => $value){
// 			  foreach($value as $k => $v){
// 			  $TotalByFraction[$k] += $v;
// 			  }
// 		  }
		  if(!isset($_SESSION['projections']['operacion'])){
				$this->operations();
		  }

		  if(isset($filter['area']) and $filter['area'] > 0 ){
			$Area = $this->areas()[$area];
			$SumIngress = $_SESSION['projections']['operacion']['ingresosMensuales'][$_SESSION['Auth']['User']['id_empresa']][$Area];
			$TotalByFraction = $_SESSION['projections']['operacion']['totalIngresosByFractionAnual'][$_SESSION['Auth']['User']['id_empresa']][$Area];
			$TotalByMonth = $_SESSION['projections']['operacion']['totalIngresosMensuales'][$_SESSION['Auth']['User']['id_empresa']][$Area];
		  }if($filter['area'] == 0){
			$SumIngress = $_SESSION['projections']['operacion']['TotalIngresosMensualesByFraction'][$_SESSION['Auth']['User']['id_empresa']];
			$TotalByFraction = $_SESSION['projections']['operacion']['totalIngresosAreaAnual'][$_SESSION['Auth']['User']['id_empresa']];
			$TotalByMonth = $_SESSION['projections']['operacion']['totalIngresosOperacionMensual'][$_SESSION['Auth']['User']['id_empresa']];
		  }

		  
// 		  this happend only if flota from Guadalajara exists
		  if($filter['flota'] > 1 and $filter['area'] === '2') {
// 			pr($this->getDataOp($filter,null,$fraction));
			$Totales = $this->getDataOp($filter,'3');
			$TotalByYear = $Totales['TotalByYear'];
			$_SESSION['projections']['index']['IngresosIndex'] = $IngresosIndex = $TotalByYear;
			$SumIngress = $Totales['ingresos'];
		  } else {

			$TotalByYear = array_sum($TotalByMonth);
			$_SESSION['projections']['index']['IngresosIndex'] = $IngresosIndex = $TotalByYear;
			$Totales['TotalByYear'] = $TotalByYear;
			$Totales['TotalByMonth'] = $TotalByMonth;
			$Totales['TotalByFraction'] = $TotalByFraction;
		  }
		  
		  
		  
// 		  $TotalByYear = array_sum($TotalByMonth);
// 		  
// 		  $_SESSION['projections']['index']['IngresosIndex'] = $IngresosIndex = $TotalByYear;
// 		  
// 		  $Totales['TotalByYear'] = $TotalByYear;
// 		  $Totales['TotalByMonth'] = $TotalByMonth;
// 		  $Totales['TotalByFraction'] = $TotalByFraction;

		  $this->set('IngresosIndex',$IngresosIndex);
		  $this->set('Totales',$Totales);
		  $this->set('SumIngress',$SumIngress);
		  $this->set('months',$months);
		  $this->set('fraccion',$fraction);
		  $this->set('filter',$filter);
      } // End IngresosDetail

      function Viajes(){
		$AreaCorp['id_area'] = $this->data['Projections']['area'];
		$AreaCorp['fraccion'] = '0';
		if(!isset($_SESSION['projections']['months'])){
		  $_SESSION['projections']['months'] = $this->months($return=true,$set=false,$year=date('Y'));
		}
		$months = $_SESSION['projections']['months'];
		$AreaCorp['months'] = $months;
	// 	$area = array('0'=>'Todas las Areas','1'=>'Orizaba','2'=>'Guadalajara','3'=>'Ramos Arizpe','4'=>'Tijuana');
		$area = $this->areas();
		  if(!isset($_SESSION['projections']['operacion'])){
				$this->operations();
		  }
		  $Oper = $_SESSION['projections']['operacion'];
// 		  pr($_SESSION['projections']['operacion']);
		$AnualOperationArea = $Oper['totalViajesYearlyByArea'][$_SESSION['Auth']['User']['id_empresa']][$area[$this->data['Projections']['area']]];
		

		  /** ALERT Save the result for Display in the view
		  */
		  
		  if(!empty($this->data['Projections']['area'])){
// 			foreach($area as $key => $data){
// 			  if($this->data['Projections']['area'] == $key){
			$AreaCorp['Area'] = $area[$this->data['Projections']['area']];
			$AreaCorp['TotalMes'] = $AnualOperationArea;
// 			  } //End the area filter
// 			}// foreach $area filter
		  }else{
			  $AreaCorp['Area'] = null;
			  $AreaCorp['TotalMes'] = null;
			  pr('<div id="warning"><span>Seleccione un Area</span></div>');
			  exit();
		  }// End empty this->data
	// ALERT : To hir .
			$this->set('AreaCorp',$AreaCorp);
	// ALERT Begin the flotas section
			  if(!isset($_SESSION['projections']['fleets'])){
				$_SESSION['projections']['fleets'] = $this->fleets(true,false);
				$this->set('fleets',$_SESSION['projections']['fleets']);
			  }else{
				$this->set('fleets',$_SESSION['projections']['fleets']);
			  }

      } // End kms function

      
	  function getDataTrip($filter=null,$operacion=null,$fractionMenu=null) {
// 		var_dump('block');
		
		$filter['id_empresa'] = $this->Auth->user('id_empresa');
		pr($filter);
		$fractionMenu = $this->getFraction();
// 		  pr($this->MssqlFlotasTbk->find('all'));
// 		  pr($this->fleets(true,false));
		  if($filter['fraccion'] === '1') {
// 			var_dump('for some reason fraccion means operation well in the spirit of the confusion this is for tons');
// // 			  this work for diferencing from toneladas and kms or trips
		  }else if ($filter['fraccion'] === '2') {
// 			var_dump('for some reason fraccion means operation well in the spirit of the confusion this is for kms');
		  }
		  
		  if(trim((string)$filter['fleet_name']) == 'Tijuana') {
			  $filter['fleet_name'] = 'Mexicali';
		  }
		  
	  		$replace = array(".");
			$filter['fleet_name'] = str_replace($replace,'', trim((string)$filter['fleet_name']));
// 		  pr(implode(',',$fraccion));
// 		  foreach($fraccion as $id_fraccio_idx) {
// 			  pr($id_fraccio_idx);

// 		  }

			$fleets = $this->MssqlFlotasTbk->getFlotas();
			
			pr($fleets);
			
			pr($this->MssqlAreasTbk->getAreas());
			pr($this->MssqlTipoOperacionTbk->getTipoOperacion());
			pr($this->MssqlFraccionTbk->getFraccion());
	  		
				pr($filter['fleet_name']);
				pr(case_flotas_tbk());
	  		
	  		$key = array_search(trim(strtolower((string)$filter['fleet_name'])),array_map('trim',array_map('strtolower',$fleets)));
	  		
	  		var_dump($key);
	  		
	  		
	  		$model['1'] = 'kmsCurrent';
			$model['2'] = 'TonelajeCurrentAtm';
			$model['3'] = 'TonelajeCurrentTei';
			$table['1'] = 'kms_current';
			$table['2'] = 'tonelaje_current_atm';
			$table['3'] = 'tonelaje_current_tei';

		if($filter['area'] === '2' and $filter['id_empresa'] === '1') {
			if($key === 6 /*means flota Guadalajara.Culiacan*/) {
				$wreAdd = ' and id_tipo_operacion = 14 and id_flota in (5,6,7) ';
			} else if ($key === 7 /*means flota Guadalajara.LaPaz*/) {
				$wreAdd = ' and id_tipo_operacion = 12 and id_flota in (5,6,7) ';
			} else if ($key === 5 /*means flota Guadalajara.Guadalajara*/) {
				$wreAdd = ' and id_tipo_operacion not in ("14","12") and id_flota in (5,6,7) ';
			} else {
				$wreAdd = ' and id_flota = '.$key;
			}
		}
		

		debug($wreAdd);
		
// 		var_dump(	"select a.no_viaje,d.tipo_doc,a.status_viaje,d.status_guia,d.prestamo,a.id_area,
// 						a.id_unidad,e.id_flota,a.id_origen,c.peso,c.peso_estimado,d.num_guia,d.id_fraccion,
// 						a.id_configuracionviaje
// 					from trafico_viaje as a 
// 						inner join trafico_renglon_viaje as b on a.no_viaje = b.no_viaje and a.id_area=b.id_area
// 						inner join trafico_renglon_guia as c on b.no_guia = c.no_guia and a.id_area = c.id_area 
// 						inner join trafico_guia as d on a.id_area=d.id_area and a.no_viaje=d.no_viaje 
// 						inner join mtlect a.no_viaje,d.tipo_doc,a.status_viaje,d.status_guia,d.prestamo,a.id_area,a.id_unidad,e.id_flota,a.id_origen,c.peso,c.peso_estimado,d.num_guia,d.id_fraccion,a.id_configuracionviaje from trafico_viaje as a inner join trafico_renglon_viaje as b on a.no_viaje = b.no_viaje and a.id_area=b.id_area inner join trafico_renglon_guia as c on b.no_guia = c.no_guia and a.id_area = c.id_area inner join trafico_guia as d on a.id_area=d.id_area and a.no_viaje=d.no_viaje inner join mtto_unidades as e on a.id_area=e.id_area and a.id_unidad to_unidades as e on a.id_area=e.id_area and a.id_unidad = e.id_unidad and a.id_area=e.id_area 
// 					where YEAR(a.f_despachado) = '2015' 
// 						and MONTH(a.f_despachado) ='01' 
// 						and day(a.f_despachado)='20' 
// 						and d.status_guia <> 'B' 
// 						and d.tipo_origen <> 1 
// 						and d.prestamo='N' 
// 						and a.id_area='2'");
		$query = "select a.no_viaje,d.tipo_doc,a.status_viaje,d.status_guia,d.prestamo,a.id_area,a.id_unidad,e.id_flota,a.id_origen,c.peso,c.peso_estimado,d.num_guia,d.id_fraccion,a.id_configuracionviaje from trafico_viaje as a inner join trafico_renglon_viaje as b on a.no_viaje = b.no_viaje and a.id_area=b.id_area inner join trafico_renglon_guia as c on b.no_guia = c.no_guia and a.id_area = c.id_area inner join trafico_guia as d on a.id_area=d.id_area and a.no_viaje=d.no_viaje inner join mtto_unidades as e on a.id_area=e.id_area and a.id_unidad = e.id_unidad and a.id_area=e.id_area where YEAR(a.f_despachado) = '2015' and MONTH(a.f_despachado) ='01' and day(a.f_despachado)='20' and d.status_guia <> 'B' and d.tipo_origen <> 1 and d.prestamo='N' and a.id_area='2'";
		
		
		
		
		
// 		pr(($this->MssqlViajesRtTbk->getMssqlTraficoViaje()['viajes']));
// 		$dataOperation = $this->$model[$filter['id_empresa']]->query($query);
// 		pr($dataOperation);
// 		exit();
		
// 		$query = 'select id_area as area,id_flota as flota,id_fraccion as fraccion,year(fecha_guia) as year,month(fecha_guia) as month ,sum(peso) as peso from '.$table[$filter['id_empresa']].' where year(fecha_guia) = "'.$filter['year'].'" and id_area = '.$filter['area']. $wreAdd .' group by id_area,id_fraccion,id_flota,month(fecha_guia),year(fecha_guia)
// 		order by year(fecha_guia),month(fecha_guia),id_area,id_flota';
		


		e('<kbd>Query: Test Culiacan</kbd>');
		pr($fractionMenu);
		pr($query);
		
		debug($model[$filter['id_empresa']]);
		
		$dataOperation = $this->$model[$filter['id_empresa']]->query($query);


		foreach($dataOperation as $idxLvOne => $operation_and_idx) {
			foreach($operation_and_idx as $opIdx => $data ) {
				foreach($data as $key => $value) {
					$operationCurrent[$table[$filter['id_empresa']]][$idxLvOne][$key] = $value;
				}
			}
		}
		
		if(isset($operationCurrent)) {
			foreach($operationCurrent as $opTitle => $dataOpereation) {
				foreach($dataOpereation as $opIdx => $dataOp) {
					$month = date('M',mktime('0','0','0',$dataOp['month'],'01',$filter['year']));
					if(!isset($totalbymonth[$month])) {
						$totalbymonth[$month] = null;
					}
					
					foreach($fractionMenu as $idxFractionMenu => $labelFractionmenu) {
						if(!isset($totalbyfraccion[$month][$labelFractionmenu])) {
							$totalbyfraccion[$month][$labelFractionmenu] = null;
						}
					}

					$totalbymonth[$month] += $dataOp['peso'];
					$totalbyfraccion[$month][$fractionMenu[$dataOp['fraccion']]] += $dataOp['peso'];
				}
			}
		}

		foreach($totalbyfraccion as $monthFraccion => $containerValueFraction) {
			foreach($containerValueFraction as $fractionLabel => $dataOpValuw) {
				if(!isset($byfraccion[$fractionLabel])) {
					$byfraccion[$fractionLabel] = null;
				}
				$byfraccion[$fractionLabel] += $dataOpValuw;
			}
		}
// 		pr($totalbymonth);
// 		pr($totalbyfraccion);//toneladas
// 		pr(array_sum($totalbyfraccion));
// 		pr($fractionMenu);
		$newTotalByFleet['TotalByMonth'] = $totalbymonth;
		$newTotalByFleet['TotalByYear'] = array_sum($totalbymonth);
		$newTotalByFleet['TotalByFraction'] = $byfraccion;
		$newTotalByFleet['toneladas'] = $totalbyfraccion;
		return $newTotalByFleet;
	  }
      
      function ViajesDetail($year=null,$area=null,$fraccion=null,$flota=null,$name=null){

// 		set the debug level for this method
		/*Configure::write('debug', 2);*/
		
		  $filter['year'] = $year;
		  $filter['area'] = $area;
		  $filter['areaName'] =$this->areas()[$area];
		  $filter['fraccion'] = $fraccion;
		  $filter['flota'] = $flota;
		  $filter['fleet_name'] = ucwords(strtolower($name));
		  $filter['id_empresa'] = $_SESSION['Auth']['User']['id_empresa'];


// 			debug($this->getDataOp($filter,'4'));
// 			exit();
			
			
		  // ALERT this can change having the table.db
		  $TpoOp = explode(',',$filter['flota']);
		if(!isset($_SESSION['projections']['months'])){
		  $_SESSION['projections']['months'] = $this->months($return=true,$set=false,$year=date('Y'));
		}
		$months = $_SESSION['projections']['months'];

/** 	ALERT:Use this for the real table trafico_producto
*/
// 		  $fraction = $this->Fraccion->find('list',array('fields'=>array('id','fraccion')));
		  $fraction = $this->getFraction(null);

/** Variables to define
  * @param we need parameter for this !
  */
/** TODO in this section will check and deploy the total tonels by month and check in where 
 ** month we are and same thing for fraction and clean an reset your variables
 */ 

		  if(!isset($_SESSION['projections']['operacion'])){
				$this->operations();
		  }
		  if(isset($filter['area']) and $filter['area'] > 0 ){
			$Area = $this->areas()[$area];
			$viajes = $_SESSION['projections']['operacion']['viajesMensuales'][$_SESSION['Auth']['User']['id_empresa']][$Area];
			$TotalByFraction = $_SESSION['projections']['operacion']['totalViajesByFractionAnual'][$_SESSION['Auth']['User']['id_empresa']][$Area];
			$TotalByMonth = $_SESSION['projections']['operacion']['totalViajesMensuales'][$_SESSION['Auth']['User']['id_empresa']][$Area];
		  }if($filter['area'] == 0){
			$viajes = $_SESSION['projections']['operacion']['TotalViajesMensualesByFraction'][$_SESSION['Auth']['User']['id_empresa']];
			$TotalByFraction = $_SESSION['projections']['operacion']['totalViajesAreaAnual'][$_SESSION['Auth']['User']['id_empresa']];
			$TotalByMonth = $_SESSION['projections']['operacion']['totalViajesOperacionMensual'][$_SESSION['Auth']['User']['id_empresa']];
		  }
		  
		  
// 		  this happend only if flota from Guadalajara exists
		  if($filter['flota'] > 1 and $filter['area'] === '2') {
// 			pr($this->getDataOp($filter,null,$fraction));
			$Totales = $this->getDataOp($filter,'4');
			$TotalByYear = $Totales['TotalByYear'];
			$_SESSION['projections']['index']['ViajesIndex'] = $ViajesIndex = $TotalByYear ;
			$viajes = $Totales['viajes'];
		  } else {

			$TotalByYear = array_sum($TotalByMonth);
			$_SESSION['projections']['index']['ViajesIndex'] = $ViajesIndex = $TotalByYear ;
			$Totales['TotalByYear'] = $TotalByYear;
			$Totales['TotalByMonth'] = $TotalByMonth;
			$Totales['TotalByFraction'] = $TotalByFraction;
		  }
		  
// 		  $TotalByYear = array_sum($TotalByMonth);
// 		  $_SESSION['projections']['index']['ViajesIndex'] = $ViajesIndex = $TotalByYear ;
// 		  $Totales['TotalByYear'] = $TotalByYear;
// 		  $Totales['TotalByMonth'] = $TotalByMonth;
// 		  $Totales['TotalByFraction'] = $TotalByFraction;

		  $this->set('ViajesIndex',$ViajesIndex);
		  $this->set('Totales',$Totales);
		  $this->set('viajes',$viajes);
		  $this->set('months',$months);
		  $this->set('fraccion',$fraction);
		  $this->set('filter',$filter);
      }// End Function ViajesDetail
      
      function Programs(){
// 	pr($this->data);
	
		  $conditions['Empresas.active'] = '1';
		  $empresas = $this->Empresas->find('list',array('fields'=>array('id_empresa','empresa'),array('conditions'=>$conditions)));
		  
		  foreach($empresas as $key => $value){
			  if($key == $_SESSION['Auth']['User']['id_empresa']){
	  // 		pr($value);
			  if($_SESSION['Auth']['User']['id_empresa']== '1'){
				  $_append = null;
			  }else{
				  $_append  = substr(ucwords(strtolower($value)),0,3);
			  }
			  }
		  
		  }
	
// 	pr('TonelajeCurrent'.$_append);
// 	pr($_SESSION['Auth']['User']);
	
      }
      
      function SacoDetail(){

      }
      
      function UpAll(){
      }

      function shiftCorp($level=null){

		  if(!isset($this->data['Projections']['id_empresa'])){
			/** @we_don't have a defined corporation so get the first active corporation */
			$conditions['Empresas.active'] = '1';
			$empresa = $this->Empresas->find('first',array('fields'=>array('id_empresa','empresa'),'conditions'=>$conditions));
			$_SESSION['Auth']['User']['id_empresa'] = $empresa['Empresas']['id_empresa'];
			$_SESSION['Auth']['User']['empresa'] = $empresa['Empresas']['empresa'];
		  }else{
			$id_empresa = $this->data['Projections']['id_empresa'];
			if($_SESSION['Auth']['User']['id_empresa'] !== $this->data['Projections']['id_empresa']){
			/** ALERT @Catch_and_Update a PostVar with link method or $this->data*/
			$empresas = array_map('strtolower',$this->Empresas->getEmpresas());
			/** WARNING XD-> getout from hir どうもありがとうミスターロボット nah! */
			foreach($_SESSION as $container => $arrayContainer){
			  if($container !== 'Auth' AND $container !== 'Config' AND $container !== 'Message' AND $container !== 'theme'){//Belong to normal Session
			  unset($_SESSION[$container]); // Sanitize the Global var $_SESSION
			  }
			}
			unset($operations);
			
			  foreach($empresas as $idx_empresa => $empresaName){
				if($idx_empresa == $id_empresa){
					$_SESSION['Auth']['User']['id_empresa'] = $id_empresa;
					$_SESSION['Auth']['User']['empresa'] = $empresaName;
				}
			  }
			}//if $_SESSION
		  }//else-end
			
	  }//End shiftCorp

	  function blackWars(){
		if(!isset($this->data)){
		  $this->read($this->data);
		}else{
		  $_SESSION['Auth']['User']['year'] = $this->tachionTravel(deep)[$this->data['Projections']['year']];

			$id_empresa = $this->data['Projections']['id_empresa'];
			/** ALERT @Catch_and_Update a PostVar with link method or $this->data*/
			$empresas = array_map('strtolower',$this->Empresas->getEmpresas());
			/** WARNING XD-> getout from hir どうもありがとうミスターロボット nah! */
			foreach($_SESSION as $container => $arrayContainer){
			  if($container !== 'Auth' AND $container !== 'Config' AND $container !== 'Message' AND $container !== 'theme' ){//Belong to normal Session
			  unset($_SESSION[$container]); // Sanitize the Global var $_SESSION
			  }
			}
			unset($operations);
			  foreach($empresas as $idx_empresa => $empresaName){
				if($idx_empresa == $id_empresa){
					$_SESSION['Auth']['User']['id_empresa'] = $id_empresa;
					$_SESSION['Auth']['User']['empresa'] = $empresaName;
				}
			  }
		}
// 		$this->shiftCorp(null,$year);
	  }
	  
	  function blackTheme($telma=null,$id_user=null,$library=null) {
// 		pr($this->data);
// 		var_dump($telma);
// 		var_dump($id_user);
// 		var_dump($library);
// 		$this->Users->id=$id_user;
		$tema = array_fill_keys(array_keys($_SESSION['theme']),false); //set the array elements to zero
		$_SESSION['theme'] = $tema;
		if( array_key_exists($library,$tema) === true ) {
			$_SESSION['theme'][$library] = true;
		}
		$user = $this->User->findById($id_user);
// 		pr($user);
		$user['User']['id_theme'] = $telma;
// 		pr($user);
// 		$fields = array_keys($this->data['User']);
// 		pr($_SESSION['theme']);
		$this->User->set($user);
// 		$this->User->saveField('id_theme', $telma);
		$this->User->save($user, false);
// 		$this->User->update($user);
// 		if($this->User->save($user)) {
            //Set a session flash message and redirect.
//             $this->Session->setFlash("user preferences Saved!");
//             $this->redirect('/recipes');
// 		}
// 		$this->redirect('../');

// 		exit();
	  }

	  function tachionTravel($deep=null){
		$currentYear=date('Y');
		if(empty($deep)){//in case you want acces this function manualy
		  $deep= '2' ;
		}
		for($i=0;$i<=$deep;$i++){
		  $tau[$i] = (int)$currentYear-(int)$i;
		}
		return $tau;
	  }//End tachionTravel
	  
	  function projections(){
		  
	  }
	  
      function index(){
		/** WARNING time section */
		$this->set('tau',$this->tachionTravel(deep));
		
		if(!isset($_SESSION['Auth']['User']['year'])){
		  $year = date('Y');
		  $_SESSION['Auth']['User']['year'] = $year;
		}else{
		  $year = $_SESSION['Auth']['User']['year'];
		}
		/** when @GST */
		if(isset($_SESSION['Auth']['User']['id_empresa_back']) and ( ($_SESSION['Auth']['User']['id_empresa_back']) == ($_SESSION['Auth']['User']['id_empresa'])) ){
			$this->shiftCorp($level=$_SESSION['Auth']['User']['level']);
		}
		$id_empresa=$_SESSION['Auth']['User']['id_empresa'];

		if(!isset($_SESSION['projections']['fraction'])){
		  $_SESSION['projections']['fraction'] = $this->Fraccion->find('list',array('fields'=>array('id','fraccion')));
		}$fraction = $_SESSION['projections']['fraction'];
		 
		if(!isset($_SESSION['projections']['fleets'])){
			$_SESSION['projections']['fleets'] = $this->fleets(true,false);
			unset($_SESSION['projections']['fleets']['fleet']['2']['17']); //unset GDL TERCEROS
		}
		
		if(!isset($_SESSION['projections']['currentProjectionsWorkingDays'])){
		  $_SESSION['projections']['currentProjectionsWorkingDays'] = $this->workingDays(null,$year,false,true);
		}
		
		if(!isset($_SESSION['projections']['months'])){
		  $_SESSION['projections']['months'] = $this->months($return=true,$set=false,$year);
		}
		$months = $_SESSION['projections']['months'];
// 		pr($months);
		 if(!isset($_SESSION['projections']['operacion'])){
			$this->operations($id_empresa,$year);
		 }
		  
		 if(!isset($_SESSION['projections']['acumulado'])){
		   $this->acumulado($id_empresa,$year);
// 		   $id_empresa=null,$year=null,$month=null
		}
		$operations = $_SESSION['projections']['operacion'];
// 		$id_empresa = $_SESSION['Auth']['User']['id_empresa'];


		if(!isset($_SESSION['projections']['projeccion'])){
		  $this->projection($id_empresa);
		}
		
		
		if(!isset($_SESSION['projections']['fleets'])){
		  $_SESSION['projections']['fleets'] = $this->fleets(true,false);
		  $this->set('fleets',$_SESSION['projections']['fleets']);
		}else{
		  $this->set('fleets',$_SESSION['projections']['fleets']);
		}
		$this->set('TonsIndex',array_sum($operations['totalToneladasYearlyByArea'][$id_empresa]));
		$this->set('KmsIndex',array_sum($operations['totalKilometrosYearlyByArea'][$id_empresa]));
		$this->set('IngresosIndex',array_sum($operations['totalIngresosYearlyByArea'][$id_empresa]));
		$this->set('ViajesIndex',array_sum($operations['totalViajesYearlyByArea'][$id_empresa]));

		
		if(empty(filterUser($_SESSION['Auth']['User']['email'],$this->areas()))){
		  $AllAreas = $this->areas();
		}else{
		  $setFilter = filterUser($_SESSION['Auth']['User']['email'],$this->areas());

		  $AllAreas = $setFilter['flotas'];
// 		  $redirect = $setFilter['redirect'];
		}
		
// 		if(isset($redirect)){
// // 		  pr('redirect');
// 		}
// 		var_dump($setFilter);
// 		var_dump($AllAreas);
// 		pr($this->areas());
		
		$AreaCorp['Area'] = $AllAreas['0'];
		$this->set('areas',$AllAreas);
		$this->set('AreaCorp',$AreaCorp);
		$this->set('unidadDeNegocio',array_map('strtolower',$this->Empresas->getEmpresas()));
		
// 		pr($_SESSION['projections']['workingDays']);
// 		pr($_SESSION['projections']['currentProjectionsWorkingDays']);
// 		if($debug){
// 		  //script code
// 		  $time2 = microtime(true);
// 		  echo "script execution time: ".($time2-$time1); //value in seconds
// 		}
      }

      function savePresupuesto(){
// 		pr($this->data);
		if(!isset($this->data)){
		  $this->read($this->data);
		}else{
			  $year = $this->data['Date']['year'];
			  $month = $this->data['Date']['month'];
			  $Presupuesto = $this->data['Presupuesto'];
			  $conditions['Presupuesto.year'] = $year;
			  $conditions['Presupuesto.month'] = $month;
			  $conditions['Presupuesto.id_empresa'] = $_SESSION['Auth']['User']['id_empresa'];
			  $getPresupuesto = $this->Presupuesto->find('all',array('conditions'=>$conditions));

				$idx = 0;
				foreach($Presupuesto as $tbName => $presupuestoData){
// 				  pr($presupuestoData);
					if(!empty($presupuestoData['presupuesto'])){
						$savePresupuesto[$idx]['Presupuesto'] = $presupuestoData;
						$savePresupuesto[$idx]['Presupuesto']['year'] = $year;
						$savePresupuesto[$idx]['Presupuesto']['month'] = $month;
// 						$savePresupuesto['Presupuesto'][$id_presupuesto]['week'] = $;
						$savePresupuesto[$idx]['Presupuesto']['status'] = 'Active';
						$savePresupuesto[$idx]['Presupuesto']['fdatetime'] = date('Y-m-d H:m:s');
						$idx++;
					}
				}

				  $this->Presupuesto->saveAll($savePresupuesto);

		}// End Else $this->data
		$this->set('flotas',$this->presupuesto(true,$year,$month));
		$this->render('ShowPresupuesto','ajax');
	  }//End savePresupuesto
	  
	  function ShowPresupuesto(){

		if(!isset($this->data)){
		  $this->read($this->data);
		}else{
			if(isset($this->data['Date']['month'])){
			  $extractMonth = explode('-',$this->data['Date']['month']);
			  $year = $extractMonth['0'];
			  $month = $extractMonth['1'];
			}else{
			  $year = date('Y');
			  $month = date('m');
			}
		}
		$dateMonth['year'] = $year;
		$dateMonth['month'] = $month;
		$flotas = $this->presupuesto($return=true,$year,$month);

		$this->set('flotas',$flotas);
		$this->set('dateMonth',$dateMonth);
		$this->render('show_presupuesto','ajax');
	  }
	  
	  
      function presupuesto($return = null,$year=null,$month=null){

// 			pr($this->data);exit();
			$getFlotas['1'] = $this->Fleets->getFlotas();
			$getFlotas['2'] = $this->FleetsAtm->getFlotasAtm();
			$getFlotas['3'] = $this->FleetsTei->getFlotasTei();
			$listFlotas['1'] = $this->Flotas->find('list',array('fields'=>array('id_flota','nombre')));
			$listFlotas['2'] = $this->FlotasAtm->find('list',array('fields'=>array('id_flota','nombre')));
			$listFlotas['3'] = $this->FlotasTei->find('list',array('fields'=>array('id_flota','nombre')));
			$getAreas = $this->areas();
			$id_empresa = $_SESSION['Auth']['User']['id_empresa'];
			$flotas = $getFlotas[$id_empresa];
// 			pr($this->Empresas());exit();
// 			pr($flotas);exit();
// 			$fleets = $_SESSION['projections']['fraction'];
			
			if(!isset($year)){
			  $year = date('Y');
			}
			if(!isset($month)){
			  $month = date('n');
			}

			$conditions['Presupuesto.year'] = $year;
			$conditions['Presupuesto.month'] = $month;
			$conditions['Presupuesto.id_empresa'] = $_SESSION['Auth']['User']['id_empresa'];
			$getPresupuesto = $this->Presupuesto->find('all',array('conditions'=>$conditions));

			foreach($flotas as $id_fleets => $fleetsData){
			  foreach($fleetsData['Flotas'.$this->Empresas()] as $fleetsContent){
				$flotasDesc[$id_fleets][$getAreas[$fleetsData['Fleets'.$this->Empresas()]['id_area']]][$fleetsContent['id_flota']] = trim(ucwords(strtolower($fleetsContent['nombre'])));
			  }
			}
// 			$eachPresupuesto = $flotasDesc;
			if(!empty($getPresupuesto)){
			  foreach($getPresupuesto as $id_presupuesto => $tbPresupuesto){
				foreach($flotasDesc as $id_flota => $flota){
				  foreach($flota as $flotaName => $idwflota){
					foreach($idwflota as $id => $unidadNegocio){
					  $presupuesto[$tbPresupuesto['Presupuesto']['id_area']][$tbPresupuesto['Presupuesto']['area']][$tbPresupuesto['Presupuesto']['id_flota']][$tbPresupuesto['Presupuesto']['unidadNegocio']]['presupuesto'] = $tbPresupuesto['Presupuesto']['presupuesto'];
					  $presupuesto[$tbPresupuesto['Presupuesto']['id_area']][$tbPresupuesto['Presupuesto']['area']][$tbPresupuesto['Presupuesto']['id_flota']][$tbPresupuesto['Presupuesto']['unidadNegocio']]['id_presupuesto'] = $tbPresupuesto['Presupuesto']['id_presupuesto'];
					}
				  }
				}
			  }
			}else{
			  $presupuesto = null;
			}
// 			pr($flotasDesc);
// 			pr($presupuesto);
// 			exit();
			$flotas['description'] = $flotasDesc;
			$flotas['presupuesto'] = $presupuesto;
// 			pr($flotas);
// 			exit();
			if(isset($return)){
			  return $flotas;
			}else{
			  $this->set('flotas',$flotas);
			}

	  }//End Presupuesto

	  /** ALERT How this thing works ? mmmm 
	   *  essentialy you need put two identical arrays and the the function make the maths for both arrays
	   *  @param=> round=rounded numbers><$money do the number_format as money>if both are active applies both formats
	   *  TODO compare the two arrays if they are identical and the values are numeric perhaps with array_map
	   *  TODO build more operands ex * + - etc ...
	   *  @working operations =>
	   */
	  function arrayMap($array1 = null,$array2 = null,$operation = null,$round=null,$money=null){
// 		$operation = '/';
		if($operation === '/'){
		  $result = null;
		  if(isset($array1)){
			foreach($array1 as $id_array => $dataArray){
			  if(!isset($result[$id_array])){
				$result[$id_array] = null;
			  }
			  if(!empty($round) and empty($money)){
				$result[$id_array] = round($dataArray/$array2[$id_array]);
			  }elseif(empty($round) and !empty($money)){
				$result[$id_array] = number_format($dataArray/$array2[$id_array], 2, '.', ',');
			  }elseif(!empty($round) and !empty($money)){
				$result[$id_array] = number_format(round($dataArray/$array2[$id_array]));
			  }else{
				$result[$id_array] = ($dataArray/$array2[$id_array]);
			  }
			}
		  }//End operation /
		}

	  /** WARNING add more operations*/
		 return $result;
	  }/** @End of @arrayMap */
	  
	  function ind_ingresos(){
		$ingress = $_SESSION['projections']['operacion']['ingresosDaily'][$_SESSION['Auth']['User']['id_empresa']];
		$trips = $_SESSION['projections']['operacion']['viajesDaily'][$_SESSION['Auth']['User']['id_empresa']];
		foreach($ingress as $area => $months){
		  foreach($months as $month => $fractions){
			foreach($fractions as $fractionsName => $days){
			  if(!isset($result[$area][$month][$fractionsName])){
				$result[$area][$month][$fractionsName] = null;
			  }
			  $result[$area][$month][$fractionsName] = $this->arrayMap($days,$trips[$area][$month][$fractionsName],'/',true,true);
			}
		  }
		}
		$ingresosViaje = $result ;

	    $ind_ingresos['ingresosViajes'] = $ingresosViaje;
		$ind_ingresos['ingresos'] = $ingress;
		$ind_ingresos['viajes'] = $trips;

// 		pr($ind_ingresos);
		if(isset($this->params['requested'])){
			return $ind_ingresos;
        } else {
            $this->set('ind_ingresos',$ind_ingresos);
        }
	  }//ind_ingresos

	  function ind_costos(){
		pr('costos');
	  }

	  function model(){

		$id_empresa = $_SESSION['Auth']['User']['id_empresa'];
		$id_area='1';
		pr($this->ind_disponibilidad(false,true,$id_empresa,$id_area,null,true));
// ind_disponibilidad($set=null,$return=null,$id_empresa=null,$id_area=null,$id_flota=null,$console=null)
		exit();
		
		pr($this->arrayFlotas()[$id_area]);
		$id_flota = $this->arrayFlotas()[$id_area]['cemento'];
		pr($this->getCountsUnits($id_empresa,$id_area,$id_flota,$status=null,$view=null,date('Y-m-d')));
		exit();
		$conditions['YEAR(MssqlViajesRtTbk.f_despachado)'] = '2015';
		$conditions['MONTH(MssqlViajesRtTbk.f_despachado)'] = '01';
		$conditions['DAY(MssqlViajesRtTbk.f_despachado)'] = '20';
// 		pr($this->MssqlViajesRtTbk->find('all',array('conditions'=>$conditions)));
		
// 		pr($this->MssqlViajesRtTbk->getMssqlTraficoViaje($id_area=null,$no_viaje=null,$fecha=null,$id_empresa=null)['viajes']);
		pr(count($this->MssqlViajesRtTbk->getMssqlTraficoViaje()['viajes']));
		pr("<p>select a.no_viaje,d.tipo_doc,a.status_viaje,d.status_guia,d.prestamo,a.id_area,a.id_unidad,e.id_flota,a.id_origen,c.peso,c.peso_estimado,d.num_guia,d.id_fraccion,a.id_configuracionviaje from trafico_viaje as a inner join trafico_renglon_viaje as b on a.no_viaje = b.no_viaje and a.id_area=b.id_area inner join trafico_renglon_guia as c on b.no_guia = c.no_guia and a.id_area = c.id_area inner join trafico_guia as d on a.id_area=d.id_area and a.no_viaje=d.no_viaje inner join mtto_unidades as e on a.id_area=e.id_area and a.id_unidad = e.id_unidad and a.id_area=e.id_area where YEAR(a.f_despachado) = '2015' and MONTH(a.f_despachado) ='01' and day(a.f_despachado)='20' and d.status_guia <> 'B' and d.tipo_origen <> 1 and d.prestamo='N' and a.id_area='2'</p>");
		exit();
		$id_empresa = '3';
		
		$getFlotasArray = $this->arrayFlotas();
// 		pr($getFlotasArray);

		  foreach($getFlotasArray as $idn_area => $flotasConfig){
			$id_area[] = $idn_area;
			foreach($flotasConfig as $clasification => $fleetArrays){
			  foreach($fleetArrays as $idx_fleet => $fleetName){
				$id_fleet[$clasification][]=$fleetName;
			  }
			}
		  }
		pr($id_fleet);
// 		$id_flota = array('16','17');
// 		$id_flota = array('1','2','3','4','5','6','7');
// 		$id_area = array('1','2','3','4','5');
		pr($id_area);
		$id_flota = $id_fleet['cemento'];
// 		$id_flota = $id_fleet['terceros'];
// 		$id_area = null;
		pr($this->MssqlUnidadesAsignadasTei->getUnidades($id_area,$id_flota,$status=null,$id_empresa));
		exit();
		foreach(fleetsConfig() as $ind => $fleetConfig){
// 		  $id_flota = $id_fleet[$fleetConfig];
// 		  pr($id_flota);
		  
		  $resultFleets[$fleetConfig] = $this->MssqlUnidadesAsignadasTbk->getUnidades($id_area,$id_flota,$status=null,$id_empresa);
		}
		pr($resultFleets);
// 		$id_flota = $getFlotasArray[$id_empresa]['terceros'];
// 		$id_flota = null;
// 		$id_area = null;
// 		pr($id_flota);
// 			pr($this->MssqlPersonalPersonalTbk->getPersonal($id_area,$id_empresa));
// 			pr($this->MssqlPersonalPersonalTbk->getPersonal(null,$id_empresa));
// 			pr($this->MssqlUnidadesAsignadasTbk->getUnidadesALL('1','16','2','1'));
			
// 			pr($this->MssqlUnidadesAsignadasAtm->getUnidades($id_area='1',$id_flota='1',$status='1',$id_empresa='2'));
// 			pr($this->MssqlUnidadesAsignadasTei->getUnidades($id_area='1',$id_flota='1',$status='1',$id_empresa='3'));
		exit();
	  }
	  function whereEmpresa(){
		if($this->Empresas() == null){
		  $_append = 'Tbk';
		}else{
		  $_append = $this->Empresas();
		}
		return $_append;
	  }
	  
	  function arrayFlotas(){

		$_append = $this->whereEmpresa();
// 		pr($_append);
		if($_append == 'Tbk'){
		  $offsetFlotas = 'Flotas';
		}else{
		  $offsetFlotas = 'Flotas'.$_append;
		}
		$modelFleets = 'Fleets'.$_append;
		$modelFlotas = 'MssqlFlotas'.$_append;
		$modelAreas = 'MssqlAreas'.$_append;
		if($_append == 'Tbk'){
		  $fleets = $this->Fleets->getFlotas();
		}elseif($_append == 'Atm'){
		  $fleets = $this->$modelFleets->getFlotasAtm();
		}elseif($_append == 'Tei'){
		  $fleets = $this->$modelFleets->getFlotasTei();
		}

		$getFlotas = $this->$modelFlotas->getFlotas();
		$getAreas = $this->$modelAreas->getAreas();
// 		pr($getAreas);
// // 		pr($getFlotas);
// 		pr($fleets);
		
// 		exit();

		foreach($fleets as $id_area => $areasContent){
		  foreach($areasContent[$offsetFlotas] as $id_flotas => $flotasContent){
			$areasBuild[$id_area][$id_flotas] = $getFlotas[$id_flotas];
		  }
		}
		foreach($areasBuild as $idxAreas => $areasContent){
		  foreach($areasContent as $idFlota => $flotasName){
			preg_match("/Terceros/",$flotasName,$SearchEngineSmall);
			if(empty($SearchEngineSmall)){
			  $getFlotasArray[$idxAreas]['cemento'][] = $idFlota;
			}else{
			  $getFlotasArray[$idxAreas]['terceros'][] = $idFlota;
			}
		  }
		}
// 		pr($getFlotasArray);
// 		exit();
		return $getFlotasArray;
	  }
	  
	  function getCountsUnits($id_empresa=null,$id_area=null,$id_flota=null,$status=null,$view=null,$fecha=null){
		/** NOTE @Config-Section */
		$debug = false;

// 		$id_empresa = $_SESSION['Auth']['User']['id_empresa'];
// 		$id_area = '1'; //for Orizaba
// 		$id_flota = '1'; //for Holcim
// 		$id_flota = '16'; //for terceros
// 		$status = null;
// 		if status is set then only get the given status
		/** NOTE @Config-Section */
		/** DEFINE the status */
		if(empty($id_empresa)){
		  $id_empresa = $_SESSION['Auth']['User']['id_empresa'];
		}
		$_append = $this->whereEmpresa();
		$modelStatus = 'MssqlDespStatus'.$_append;
		$modelFlotas = 'MssqlFlotas'.$_append;
		$modelUnidades = 'MssqlUnidadesAsignadas'.$_append;
		
		$getFlotasArray = $this->arrayFlotas();

		if(empty($view)){
		  $status = $this->$modelStatus->getStatus();
// 		  $flotas = $this->$modelFlotas->getFlotas();
		  foreach(fleetsConfig() as $ind => $fleetConfig){
			
			if(isset($getFlotasArray[$id_area][$fleetConfig])){
			  $id_flota = $getFlotasArray[$id_area][$fleetConfig];
			  $getUnidadesTotales  = $this->$modelUnidades->getUnidades($id_area,$id_flota,null,$id_empresa);
			  $getUnidadesDisponibles = $this->$modelUnidades->getUnidades($id_area,$id_flota,$status='1',$id_empresa);
			  $getUnidadesTransito = $this->$modelUnidades->getUnidades($id_area,$id_flota,$status='2',$id_empresa);
			  $getUnidadesMantenimiento = $this->$modelUnidades->getUnidades($id_area,$id_flota,$status='3',$id_empresa);
			  $getUnidadesAccidentados = $this->$modelUnidades->getUnidades($id_area,$id_flota,$status='4',$id_empresa);
			  $getUnidadesCargado = $this->$modelUnidades->getUnidades($id_area,$id_flota,$status='5',$id_empresa);
			  $getUnidadesDescargado = $this->$modelUnidades->getUnidades($id_area,$id_flota,$status='6',$id_empresa);
			  $getUnidadesFueraDeServicio = $this->$modelUnidades->getUnidades($id_area,$id_flota,$status='7',$id_empresa);

			  $disponibilidad['disponibilidad'][$fleetConfig]['unidades']['totalDetail'] = $getUnidadesTotales;
			  
			  $disponibilidad['disponibilidad'][$fleetConfig]['unidades']['totales'] = $getUnidadesTotales['allUnits'];
			  $disponibilidad['disponibilidad'][$fleetConfig]['personal']['asignado'] = $getUnidadesTotales['personalCount'];
// 			  pr($getUnidadesTotales);
			  $disponibilidad['disponibilidad'][$fleetConfig]['unidades']['detalle'] = $getUnidadesTotales['unidades'];
			  
			  $disponibilidad['disponibilidad'][$fleetConfig]['unidades']['disponibles'] = count($getUnidadesDisponibles['unidades']);
			  $disponibilidad['disponibilidad'][$fleetConfig]['unidades']['transito'] = count($getUnidadesTransito['unidades']);
			  $disponibilidad['disponibilidad'][$fleetConfig]['unidades']['mantenimiento'] = count($getUnidadesMantenimiento['unidades']);
			  $disponibilidad['disponibilidad'][$fleetConfig]['unidades']['accidentados'] = count($getUnidadesAccidentados['unidades']);
			  $disponibilidad['disponibilidad'][$fleetConfig]['unidades']['cargado'] = count($getUnidadesCargado['unidades']);
			  $disponibilidad['disponibilidad'][$fleetConfig]['unidades']['descargado'] = count($getUnidadesDescargado['unidades']);
			  $disponibilidad['disponibilidad'][$fleetConfig]['unidades']['fuera_de_servicio'] = count($getUnidadesFueraDeServicio['unidades']);
			}
		  }
// 		  pr($disponibilidad);
		}elseif(!empty($view)){
		  //NOTE get fleets of all id_empresa
		$disponibilidad = null;
		$id_area = null;
		$id_flota = null;
		
		  $status = $this->$modelStatus->getStatus();
		  foreach($getFlotasArray as $idn_area => $flotasConfig){
			$id_area[] = $idn_area;
			foreach($flotasConfig as $clasification => $fleetArrays){
			  foreach($fleetArrays as $idx_fleet => $fleetName){
				$id_fleet[$clasification][]=$fleetName;
			  }
			}
		  }
// 		  pr($id_fleet);
// 		  pr($id_area);

		  foreach(fleetsConfig() as $ind => $fleetConfig){
		  $id_flota = $id_fleet[$fleetConfig];

			$getUnidadesTotales  = $this->$modelUnidades->getUnidades($id_area,$id_flota,null,$id_empresa);
  // 		  $disponibilidad['disponibilidad']['view']['flotas'] = disponibleFlotasConfig($flotas,$id_empresa,false);
			$disponibilidad['disponibilidad'][$fleetConfig]['unidades']['totales'] = $getUnidadesTotales['allUnits'];
			$disponibilidad['disponibilidad'][$fleetConfig]['personal']['asignado'] = $getUnidadesTotales['personalCount'];
			$disponibilidad['disponibilidad'][$fleetConfig]['unidades']['detalle'] = $getUnidadesTotales['unidades'];
			
			$getUnidadesDisponibles = $this->$modelUnidades->getUnidades($id_area,$id_flota,$status='1',$id_empresa);
			$getUnidadesTransito = $this->$modelUnidades->getUnidades($id_area,$id_flota,$status='2',$id_empresa);
			$getUnidadesMantenimiento = $this->$modelUnidades->getUnidades($id_area,$id_flota,$status='3',$id_empresa);
			$getUnidadesAccidentados = $this->$modelUnidades->getUnidades($id_area,$id_flota,$status='4',$id_empresa);
			$getUnidadesCargado = $this->$modelUnidades->getUnidades($id_area,$id_flota,$status='5',$id_empresa);
			$getUnidadesDescargado = $this->$modelUnidades->getUnidades($id_area,$id_flota,$status='6',$id_empresa);
			$getUnidadesFueraDeServicio = $this->$modelUnidades->getUnidades($id_area,$id_flota,$status='7',$id_empresa);

			$disponibilidad['disponibilidad'][$fleetConfig]['unidades']['disponibles'] = count($getUnidadesDisponibles['unidades']);
			$disponibilidad['disponibilidad'][$fleetConfig]['unidades']['transito'] = count($getUnidadesTransito['unidades']);
			$disponibilidad['disponibilidad'][$fleetConfig]['unidades']['mantenimiento'] = count($getUnidadesMantenimiento['unidades']);
			$disponibilidad['disponibilidad'][$fleetConfig]['unidades']['accidentados'] = count($getUnidadesAccidentados['unidades']);
			$disponibilidad['disponibilidad'][$fleetConfig]['unidades']['cargado'] = count($getUnidadesCargado['unidades']);
			$disponibilidad['disponibilidad'][$fleetConfig]['unidades']['descargado'] = count($getUnidadesDescargado['unidades']);
			$disponibilidad['disponibilidad'][$fleetConfig]['unidades']['fuera_de_servicio'] = count($getUnidadesFueraDeServicio['unidades']);
		  }
		}
// 		pr($disponibilidad);
		return $disponibilidad;
	  }
	  
	  function ind_disponibilidad($set=null,$return=null,$id_empresa=null,$id_area=null,$id_flota=null,$console=null){
// 		pr('disponibilidad');
		/** TODO make a db with tipos de Unidad catalog an set the marked units */
		/** NOTE if this->data is set then go to dbBackup if date == today then go to mssql */
		/** as first go to the "realtime" source mssql */
		/** NOTE @sql select a.no_viaje,a.f_despachado,a.id_area,a.id_unidad,a.id_origen,c.peso,c.peso_estimado,b.no_guia,c.no_guia from trafico_viaje as a inner join trafico_renglon_viaje as b on a.no_viaje = b.no_viaje and a.id_area=b.id_area inner join trafico_renglon_guia as c on b.no_guia = c.no_guia and a.id_area = c.id_area where YEAR(a.f_despachado) = '2014' and month(a.f_despachado) ='01' and day(a.f_despachado)='20' and a.id_area = '2' ; */
		
		/*
			select a.no_viaje,d.tipo_doc,a.status_viaje,d.status_guia,d.prestamo,a.id_area,a.id_unidad,a.id_origen,c.peso,c.peso_estimado,d.num_guia,d.id_fraccion,a.id_configuracionviaje from trafico_viaje as a inner join trafico_renglon_viaje as b on a.no_viaje = b.no_viaje and a.id_area=b.id_area inner join trafico_renglon_guia as c on b.no_guia = c.no_guia and a.id_area = c.id_area inner join trafico_guia as d on a.id_area=d.id_area and a.no_viaje=d.no_viaje where YEAR(a.f_despachado) = '2015' and MONTH(a.f_despachado) ='01' and day(a.f_despachado)='20' and d.status_guia <> 'B' and d.tipo_origen <> 1 and d.prestamo='N' and a.id_area='2' ;
		 */
// 		var_dump($id_empresa);var_dump($id_area);var_dump($id_flota);
// 		echo "console => ".var_dump($console);
// 		echo "this->data => ".var_dump($this->data);

		if(empty($id_empresa)){
		  $id_empresa = $_SESSION['Auth']['User']['id_empresa'];
		}
		$modelAreas = 'MssqlAreas'.$this->whereEmpresa();
		if(!isset($this->data) AND empty($console)){
			$year = date('Y');
			$month = date('m');
// 			$day= date('d');
// 			$fecha = $year.'-'.$month.'-'.$day;
			$id_area = null;
			$areaName = 'Todas las Areas';
			$disponibilidad = $this->getCountsUnits($id_empresa,null,null,null,true);
			
		}elseif(isset($this->data) AND empty($console)){
		  //NOTE first set the date
		  if(isset($this->data['Projections']['disponibilidad'])){
			$extractMonth = explode('-',$this->data['Projections']['disponibilidad']);
			$year = $extractMonth['0'];
			$month = $extractMonth['1'];
		  }else{
			$year = date('Y');
			$month = date('m');
// 			$day= date('d');
// 			$fecha = $year.'-'.$month.'-'.$day;
		  }
		  //NOTE now if we have a defined area set and set the fleet
		  if(isset($this->data['Projections']['area'])){
			$id_area = $this->data['Projections']['area'];
			$areaName = $this->$modelAreas->getAreas()[$id_area];
			//NOTE set if area the tellme how many fleets have, go for all
		  }
		
		$disponibilidad = $this->getCountsUnits($id_empresa,$id_area,$id_flota,$status=null);
		}elseif(!empty($console)){ //End if set disponibilidad
// 		pr($year);
// 		pr($month);
		$year = date('Y');
		$month = date('m');
// 		pr($id_empresa);
// 		pr($id_area);
		$areaName = $this->$modelAreas->getAreas()[$id_area];
		$disponibilidad = $this->getCountsUnits($id_empresa,$id_area,$id_flota,$status=null);
		}
		//NOTE check if get the history or the real data
		if((int)$month === (int)date('m') AND ($year === date('Y'))){
		  $day = date('d');
		}else{
		//the Current day must be the last day of the given month
		  $day = date('t',mktime('0','0','0',$month,'01',$year));
		}
		$mes = $_SESSION['projections']['months'][(int)$month]['spanish'];
		
		$fecha = $year.'-'.$month.'-'.$day;
		
		$workDays = $this->workingDays(false,$year,$month,$session=true);
		
		$disponibilidad['disponibilidad']['date']['currentWorkingday'] = $workDays['currentWorkDays'];
		$disponibilidad['disponibilidad']['date']['totalCurrentWorkingdays'] = $workDays['totalCurrentWorkingDays'];
		$disponibilidad['disponibilidad']['date']['year'] = $year;
		$disponibilidad['disponibilidad']['date']['month'] = $month;
		$disponibilidad['disponibilidad']['date']['day'] = $day;
		$disponibilidad['disponibilidad']['date']['mes'] = $mes;
		$disponibilidad['disponibilidad']['title']['area'] = $areaName;
		
		pr($fecha);//last check if fecha < today then unset dsiponibilidad and get the data from db
		
// 		pr($this->MssqlViajesRtTbk->getMssqlTraficoViaje($id_area,null,$fecha,null)['viajes']);

		if(isset($this->params['requested']) OR ($return === true AND $set === false )){
			return $disponibilidad;
        }else{
            $this->set('disponibilidad',$disponibilidad);
        }
	  }//end ind_disponibilidad

	  function ModalProjections($year=null,$month=null){
		$id_empresa = $_SESSION['Auth']['User']['id_empresa'];

// 		pr($this->data);

// 		exit();
		
		if(isset($this->data['Projections']['id_mes'])){
// 		  $extractMonth = explode('-',$this->data['Projections']['id_mes']);
// 		  $year = $extractMonth['0'];
// 		  $month = $extractMonth['1'];
		  if(strpos($this->data['Projections']['id_mes'],'/')){
			$extractMonth = explode('/',$this->data['Projections']['id_mes']);
			$year = $extractMonth['2'];
			$month = $extractMonth['0'];
			$day = $extractMonth['1'];
		  }elseif(strpos($this->data['Projections']['id_mes'],'-')){
			$extractMonth = explode('-',$this->data['Projections']['id_mes']);
		  	$year = $extractMonth['0'];
			$month = $extractMonth['1'];
			if(isset($extractMonth['2'])){ // if GoogleDatePicker is configured only for moths and year
				$day = $extractMonth['2'];
			}
// 			$dateMonth = $year.'-'.$month;
		  }
		}else{
		  $year = date('Y');
		  $month = date('m');
		}

// 		  e('year => ');var_dump($year);
// 		  e('month => ');var_dump($month);
// 		  if(isset($day)){ // same case of GoogleDatePicker
// 			e('day => ');var_dump($day);
// 		  }
		
		$projeccion = $this->projection($id_empresa,$set=false,$return=true,$year,$area=false,$fraccion=false,$flota=false,$month,$debug=false);

	    if(isset($this->params['requested'])){
			return $projeccion;
        } else {
            $this->set('projeccion',$projeccion);
        }

	  }//End projections

	  
	  function projectionsFormula($labDays=null,$allLabDays=null,$year=null,$mes=null,$area=null,$fraccion=null){
			
		  /** ALERT this part is come to be usefull for year exchangue */
			$days = 'P1M';
			$past = new DateTime(date('Y-m-d'));
			$past->sub(new DateInterval($days));
			
			$future = new DateTime(date('Y-m-d'));
			$future->add(new DateInterval($days));
			
// 			var_dump($past->format('Y-m-d'));
// 			var_dump($future->format('Y-m-d'));
			
// 			$mes = search_array();
			/** NOTE @definitions*/
			$newArea = array(
								'Cuautitlan'=>'Teisa'
			);
// 			if we are in teisa
			if($_SESSION['Auth']['User']['id_empresa'] === '3') {
				if(array_key_exists($area,$newArea)){
					$area = $newArea[$area];
				}
			}
			
// 			pr($area);
			$id_empresa = $_SESSION['Auth']['User']['id_empresa'];
			$tons = $_SESSION['projections']['operacion']['toneladasDaily'];
			$fraccion = 'Granel';
// 			pr($tons);
			/** NOTE @fisrts->Emulate->the->parameters */

			$computedDays = null;
// 			//ask for this data
// 			$year = '2015';
// 			$area = 'Orizaba';
// 			$mes = 'Mar'; // the month
// 			$fraccion = 'Granel'; // this can be a constant
// // 			$labDays = '01'; // this is the already current laboral days -1
// 			$labDays = '1'; // this is the already current laboral days -1
// 			$allLabDays = '25';
			
			// calculating how many days you need
			
			$neededDays = $allLabDays - $labDays;
// 			var_dump($neededDays);
// 			e("positive ".$neededDays); // first have how many days wee need

			// now calculating how many days have the after month if totalLabDays of backwards MONTH is insufficient 
			// go for other month backwards
// 			pr($mes); // parameter of month
			
			$month = date('m', strtotime($mes));//convert to numeric month as string type
			$compDays = null ; // at first time this is set to zero
			$offset = 1;
			
// 			which day is today?
// 			$todayYear = date('Y');
// 			$todayMonth = date('m');
// 			$todayDay = date('d');
// 			
// 			var_dump($compDays);
// 			var_dump($mes);
// 			var_dump($month);
// 			var_dump($neededDays);
// 			var_dump($year);
// // 			var_dump($labDays);
// // 			var_dump($allLabDays);
// 			var_dump($area);
// 			
			
			
			if( date('Y-m',mktime('0','0','0',$month,'01',$year)) < date('Y-m')) {
// 				pr('timetravel in the past');
// 				pr(date('Y-m',mktime('0','0','0',$month,'01',$year)));
// 				$computedDays[$mes] = $this->tachion(/*$debug=*/false,(int)$year,/*$session=*/false)[$mes];
// 				$muons = $this->tachion(/*$debug=*/false,(int)$year,/*$session=*/false);
// 				$neededDays = 0; // this is because if i go to the past i dont need complete the calculation
// 				pr($computedDays);
				return 0;
// 				exit();
			}elseif(date('Y-m',mktime('0','0','0',$month,'01',$year)) > date('Y-m')) {
// 				pr('timetravel you are in tomorrow');
// 				pr(date('Y-m',mktime('0','0','0',$month,'01',$year)));
				return 0;
// 				exit();
			}else{
// 				pr('now');
// 				pr(date('Y-m',mktime('0','0','0',$month,'01',$year)));
				while( (int)$compDays < (int)$neededDays ){
	// 				pr($offset);
	// 				pr($compDays);
					$restDays = $neededDays - $compDays ; // check how many more days need 
				// fisrts conver the string given month to numeric representation
				// the case of January is more than complex
					$getMonthYr = date('M-Y',mktime('0','0','0',$month-$offset,'01',$year)); // need to be fixed
					$monthLabel = explode('-',$getMonthYr)['0'];
					$pastYr = explode('-',$getMonthYr)['1'];
					// calculate the month and the year
	// 				pr('month => '.$monthLabel);
	// 				pr('year => '.$pastYr);
					// the past month is already in the given year?
					if((int)$year > (int)$pastYr){
	// 					e('let\'s Go to the past Mr Timetravel'); // must of situations be December
						$muons = $this->tachion(/*$debug=*/false,(int)$pastYr,/*$session=*/false);
					}elseif((int)$year === (int)$pastYr){
	// 					e('your time is now');
						$muons = $this->tachion(/*$debug=*/false,(int)$year,/*$session=*/false);
						$compDays = $this->workingDays(null,$year,$month-$offset,$session=false)['totalCurrentWorkingDays'];

	// 					$restDays = $neededDays - $compDays ; // check how many more days need 
					/** BUG WARNING this is buggy if the neededDays is minor to full lab days of the month */
						if($offset > 1){
							$computedDays[$monthLabel] = $restDays;
						}else{
							$computedDays[$monthLabel] = $compDays;
						}

					}else{ //are you the timetravel John Titor ?
						e('muons , tachions , tau particles , everywherrrrr.......e');
					}
					
					$offset = $offset + 1;
// 					pr($compDays);
				}
			}
// 			pr($muons);
// 			pr($mes);
// 			var_dump($allLabDays);
// 			pr($offset);
// 			var_dump($computedDays);
// 			pr($tons[$id_empresa][$area]);
// 			pr(count($computedDays));
// 			pr($fraccion);
// 			exit();
// 			pr($tons[$id_empresa][$area]['Apr']);
// exit();
			/** ALERT @CHECK_THIS_PROCEDURE */
			// Do the magic calculations
// 			pr(max($computedDays));
			$array = $computedDays;
			
// 			$array = $tons[$id_empresa][$area]['Feb'][$fraccion];
			if(!empty($debug)) {
				$START = $END = null;
				$START = microtime_float();
			}
			
				arsort($array);
				reset($array);
				$pastMonth = key($array);
			
			if(!empty($debug)) {
				$END = microtime_float() - $START;
				echo "arsort took $END seconds\n";
			}
			
			$computedDays = null;
			$computedDays[ $pastMonth ] = $muons[$pastMonth];
// 			pr($pastMonth);
			$AllLabDays = $muons[$pastMonth];
// 			pr($computedDays);
// 			pr($tons);
// 			Case GDL + CULIACAN
			$filter['UnitBussiness'] = array('Guadalajara','Culiacan');

			if(count($computedDays) > 1) { // means that we area in the neigborhood month and  his neigbor
				foreach($computedDays as $monthDays => $counter){
// 					$reversed[$monthDays] = array_reverse($tons[$id_empresa][$area][(string)$monthDays][$fraccion],true);
// 					$tonsReversed[$monthDays] = array_slice($reversed[$monthDays], 0, $counter,true);
// 					$sumtons[$monthDays] = array_sum($tonsReversed[$monthDays]);
					if(isset($tons[$id_empresa][$area][(string)$monthDays][$fraccion])){
						$reversed[$monthDays] = array_reverse($tons[$id_empresa][$area][(string)$monthDays][$fraccion],true);
						$sumtons[$monthDays] = array_sum($reversed[$monthDays]);
					}
					if($_SESSION['Auth']['User']['id_empresa'] === '1' and ($area === 'Guadalajara' OR $area === 'La Paz')) {
						$filter['area']='2';
						$filter['year']=$year;
						$filter['id_empresa']=$id_empresa;
						$filter['fleet_name']=$area;
						$filter['fraccion']='1'; // this meand the operation because will using operations tables
						if($area === 'Guadalajara') {
							foreach($filter['UnitBussiness'] as $UnitBussiness) {
								if(!isset($totalGdl)) {
									$totalGdl = null;
								}
								$filter['fleet_name'] = $UnitBussiness;
// 								pr($filter);
// 								pr($this->getDataOp($filter)['toneladas'][$monthDays]['Granel']);
								$totalGdl += $this->getDataOp($filter)['toneladas'][$monthDays]['Granel'];
// 								pr($totalGdl);
							}
							$sumtons[$monthDays] = $totalGdl;
							
						} else {
								$sumtons[$monthDays] = $this->getDataOp($filter)['toneladas'][$monthDays]['Granel'];
						}
						
					}
				}
			}elseif(count($computedDays) === 1){ // meand that just use the firts neigborhood
				foreach($computedDays as $monthDays => $counter){
// 					pr($monthDays);
// 					pr($fraccion);
// 					pr($tons[$id_empresa][$area][(string)$monthDays][$fraccion]);
					if(isset($tons[$id_empresa][$area][(string)$monthDays][$fraccion])){
						$reversed[$monthDays] = array_reverse($tons[$id_empresa][$area][(string)$monthDays][$fraccion],true);
	// 					pr($reversed);
	// 					$tonsReversed[$monthDays] = array_slice($reversed[$monthDays], 0, $neededDays,true);
	// 					$sumtons[$monthDays] = array_sum($tonsReversed[$monthDays]);
						$sumtons[$monthDays] = array_sum($reversed[$monthDays]);
	// 					pr($sumtons);
					}
					if($_SESSION['Auth']['User']['id_empresa'] === '1' and ($area === 'Guadalajara' OR $area === 'La Paz')) {
						$filter['area']='2';
						$filter['year']=$year;
						$filter['id_empresa']=$id_empresa;
						$filter['fleet_name']=$area;
						$filter['fraccion']='1'; // this meand the operation because will using operations tables
						if($area === 'Guadalajara') {
							foreach($filter['UnitBussiness'] as $UnitBussiness) {
								if(!isset($totalGdl)) {
									$totalGdl = null;
								}
								$filter['fleet_name'] = $UnitBussiness;
// 								pr($filter);
// 								pr($this->getDataOp($filter)['toneladas'][$monthDays]['Granel']);
								$totalGdl += $this->getDataOp($filter)['toneladas'][$monthDays]['Granel'];
// 								pr($totalGdl);
							}
							$sumtons[$monthDays] = $totalGdl;
							
						} else {
								$sumtons[$monthDays] = $this->getDataOp($filter)['toneladas'][$monthDays]['Granel'];
						}
						
					}
				}
			}
// 			pr('neededDays => '.$neededDays);
// 			
// 			if(isset($sumtons)) {
// 				var_dump('flota => '.$area);
// 				pr($sumtons);
// 				pr('suma mes => '.array_sum($sumtons));
// 				pr('Promedio => '.((array_sum($sumtons)/$AllLabDays)*$neededDays));
// 			}
// 			exit();
				if(isset($sumtons) and is_array($sumtons)){
// 					return (array_sum($sumtons)/$allLabDays)*$neededDays;
					return (array_sum($sumtons)/$AllLabDays)*$neededDays;
				}else{
					return 0;
				}
	}// End function projectionsFormula

      function projection($id_empresa=null,$set=null,$return=null,$year=null,$area=null,$fraccion=null,$flota=null,$month=null,$debug=null){
		/**
		 * ALERT => @change this to dinamic selection menu
		 */
// 		$year='2015';
// 		$month='05';
// 		$debug = true;
// 		Configure::write('debug', 2);
// 		pr($this->MssqlFlotasTei->getFlotas());
		
		/** ABOUT NOTE @if <we already are in a starting month , then search the first laboralDay so before that show one month backwards after that show the current Month > */
		
		
		if(!isset($year)){
			$year = date('Y');
		}if(!isset($month)){
			$month = date('n');
		}if(empty($id_empresa)){
		  $id_empresa = $_SESSION['Auth']['User']['id_empresa'];
		}
// 		set for year too
		if((int)$month === (int)date('m')){
		  $currentDay = date('d');
		}else{
		//the Current day must be the last day of the given month
			$currentDay = date('t',mktime('0','0','0',$month,'01',$year));
		}

// 		var_dump($year);
// 		var_dump($month);
// 		var_dump($currentDay);

		/** ALERT @today <setting variables> */
// 		$todayYear = date('Y');
// 		$todayMonth = date('m');
// 		$todayDay = date('d');
// 		$currentDay = '01';
// 		$month= '01';
// 		$year = '2014';
		
		$newMonth = $month;
		$newYear = $year;
		$today = $year.'-'.$month.'-'.$currentDay;
// 		var_dump($today);
		$labouralDays = $this->daysToWork($year,$month,$saturday=true);
		$getLabourDays = $labouralDays['list'];
		
		$fisrtLabDay = key($labouralDays['laboral']); // fetch the fisrts laboral day
		
// 		pr($labouralDays['list']);
// 		pr($labouralDays['laboral']);
		
/*		
		pr(key($labouralDays['laboral'])); // for fetch the first key of an array;
		pr(reset($labouralDays['laboral'])); // for fetch the first value of an array;*/
		
// 		$countLabDays = 0;
		
		foreach($getLabourDays as $dateLabDay => $setKey) {
// 			if($setKey === true) {
// 				$mapLabDays[$dateLabDay] = ++$countLabDays;
// 			}
			// will ask in which ?? date we are
// 			pr($mapLabDays);
			if($dateLabDay < $today ) {
// 				pr('less than today => '.$dateLabDay);
			}else if($dateLabDay > $today) {
// 				pr('a tachion is without our control => '.$dateLabDay);
			}else {
// 				var_dump('today is your day => '.$dateLabDay);
				$backtoday = $today; // backup $today;
				$yesterday = date('Y-m-d',strtotime($backtoday.' -1 day'));
				$tomorrow  = date('Y-m-d',strtotime($backtoday.' +1 day'));
// 				var_dump('Yesterday was => '.$yesterday);
// 				var_dump('Tomorrow will be => '.$tomorrow);
				if($today < $fisrtLabDay) {
// 					var_dump('fisrts laboral day not reach yet! => '.$dateLabDay);
					$newDate = date('Y-m',strtotime($backtoday.' -1 month'));
					$newdate = explode('-',$newDate);
					$year = $newdate[0];
					$month = $newdate[1];
// 					$currentDay = date('t',mktime('0','0','0',$month,'01',$year));
// 					var_dump('the date to use is => ');var_dump($newdate);
				}else if($today === $fisrtLabDay) {
// 					var_dump('fisrts laboral day is reached ! => '.$dateLabDay);
					$newDate = date('Y-m',strtotime($backtoday.' -1 month'));
					$newdate = explode('-',$newDate);
					$year = $newdate[0];
					$month = $newdate[1];
// 					$currentDay = date('t',mktime('0','0','0',$month,'01',$year));
// 					var_dump('the date to use is => ');var_dump($newdate);
				}else {
// 					var_dump('Go as normal! => '.$dateLabDay);
// 					var_dump('the date to use is => ');pr($dateLabDay);
					
				}
			}
		}
// 		var_dump($year.'-'.$month);

		$monthLabel = date('M',mktime('0','0','0',$month,'01',$year));
		

// 		if(!isset($_SESSION['projections']['projeccion'])){
// 		if(!isset($return)){
			
			
			$getFlotas['1'] = $this->Fleets->getFlotas();
			$getFlotas['2'] = $this->FleetsAtm->getFlotasAtm();
			$getFlotas['3'] = $this->FleetsTei->getFlotasTei();
			$listFlotas['1'] = $this->Flotas->find('list',array('fields'=>array('id_flota','nombre')));
			$listFlotas['2'] = $this->FlotasAtm->find('list',array('fields'=>array('id_flota','nombre')));
			$listFlotas['3'] = $this->FlotasTei->find('list',array('fields'=>array('id_flota','nombre')));
			$TipoOperacion['1'] = $this->TipoOperacion->find('list',array('fields'=>array('id_tipo_operacion','tipo_operacion')));
			$getAreas = $this->areas();
			$TipoOperacion['2'] = $this->TipoOperacionAtm->find('list',array('fields'=>array('id_tipo_operacion','tipo_operacion')));
			$TipoOperacion['3'] = $this->TipoOperacionTei->find('list',array('fields'=>array('id_tipo_operacion','tipo_operacion')));

// 			pr($listFlotas[$id_empresa]);
			$flotas = $getFlotas[$id_empresa];
// 			pr($flotas);
			foreach($flotas as $id_fleets => $fleetsData){
			  foreach($fleetsData['Flotas'.$this->Empresas()] as $fleetsContent){
				$flotasDesc[$getAreas[$fleetsData['Fleets'.$this->Empresas()]['id_area']]][$fleetsContent['id_flota']] = trim(ucwords(strtolower($fleetsContent['nombre'])));
			  }
			}
			if($debug){
			  pr($flotasDesc);
			}
			$tipoOperacion[$id_empresa] = array_map('trim',$TipoOperacion[$id_empresa]);
// 			setlocale(LC_ALL, 'es_MX');
			if($debug){
			  pr($tipoOperacion[$id_empresa]);
// 				exit();
			}
// 			this must come from a db
			foreach($tipoOperacion[$id_empresa] as $id_tipo_operacion => $tipo_operacion){
			  $tipoOperacion[$id_empresa][$id_tipo_operacion] = ucwords(strtolower(trim(str_replace("CD","",str_replace("PLANTA","",ltrim(rtrim(str_replace("CD.","",str_replace("POTOSI","",$tipo_operacion)))))))));
			}
			if($debug){
			  pr($tipoOperacion);
			}
			$model['1'] = 'TonelajeCurrent';
			$model['2'] = 'TonelajeCurrentAtm';
			$model['3'] = 'TonelajeCurrentTei';
			$table['1'] = 'tonelaje_current';
			$table['2'] = 'tonelaje_current_atm';
			$table['3'] = 'tonelaje_current_tei';
			$_SESSION['projections']['viewConfig'] = null;
			$_SESSION['projections']['viewConfig']['width'] = '320';
			$_SESSION['projections']['viewConfig']['height'] = '80';
			$_SESSION['projections']['viewConfig']['fontSize'] = '200';
			$_SESSION['projections']['viewConfig']['fontSizeTitle'] = '110';
			
			$_SESSION['projections']['viewConfig']['monthLabel'] = $monthLabel;
			$_SESSION['projections']['viewConfig']['year'] = $year;
			$_SESSION['projections']['viewConfig']['currentDay'] = $currentDay;
			$_SESSION['projections']['viewConfig']['mes'] = $_SESSION['projections']['months'][(int)$month]['spanish'];
			
			$projeccion['viewConfig']['monthLabel'] = $monthLabel;
			$projeccion['viewConfig']['year'] = $newYear;
			$projeccion['viewConfig']['currentDay'] = $currentDay;
			$projeccion['viewConfig']['mes'] = $_SESSION['projections']['months'][(int)$newMonth]['spanish'];
			$projeccion['viewConfig']['mesLabel'] = $_SESSION['projections']['months'][(int)$month]['spanish'];
			
			$getAreas = $this->areas();
			$fleets = $_SESSION['projections']['fraction'];
// 			$month = '09';
			$fecha = $year.'-'.str_pad((int)$month,'2',"0",STR_PAD_LEFT).'-';

// 			$CurrentOperation = $this->$model[$id_empresa]->query('select * from '.$table[$id_empresa].' where fecha_guia like "'.$fecha.'%"');

			$projeccion['workingDays'] = $this->workingDays(null,$year,$month,/*$session=*/true);
			/**
			 * ALERT=>@requeriments from gst firts was => why I don't can access to projections of other months ?
			 *  and now the requeriments is => I do not want access to projections of other months XDXDXD!
			 *  i'm pretty sure that in
			 *  December-January the requeriments will be => why I don't can access to projections of other months ? LOL!
			 */
// 			$projeccion['workingDays']['currentWorkDays'] = 1;
			if((int)$month === (int)date('m')){
			  if($projeccion['workingDays']['currentWorkDays'] > 1){
				$projeccion['workingDays']['currentWorkDaysDelay'] = ($projeccion['workingDays']['currentWorkDays'] - 1);
				$projeccion['workingDays']['currentWorkDays'] = $projeccion['workingDays']['currentWorkDays'] - 1;
			  }elseif($projeccion['workingDays']['currentWorkDays'] === 1){
				/** NOTE maybe this must be zero ?? */
				$projeccion['workingDays']['currentWorkDaysDelay'] = $projeccion['workingDays']['currentWorkDays'];
				$projeccion['workingDays']['currentWorkDays'] = $projeccion['workingDays']['currentWorkDays'] - 1; 
			  }else{
				$this->redirect('index');
			  }
			}else{
			  $projeccion['workingDays']['currentWorkDaysDelay'] = $projeccion['workingDays']['currentWorkDays'];
			}//end currentmonth
// 			var_dump($projeccion['workingDays']['currentWorkDaysDelay']);
			/**
			 * ALERT=>@requeriments from gst 
			 */
			
			$projeccion['id_empresa'] = $_SESSION['Auth']['User']['id_empresa'];
			$projeccion['flotasDesc'] = $flotasDesc;
			
// 			//fetch the presupuesto for selected month
			$conditions['Presupuesto.year'] = $year;
// 			$day = str_pad((int) $day,'2',"0",STR_PAD_LEFT);
			$conditions['Presupuesto.month'] = str_pad((int)$month,'2',"0",STR_PAD_LEFT);//Emulate date('m');
			$conditions['Presupuesto.id_empresa'] = $_SESSION['Auth']['User']['id_empresa'];
			$conditions['Presupuesto.status'] = 'Active';

			$presupuestoQry = $this->Presupuesto->find('all',array('conditions'=>$conditions));
// 			pr($projeccion['workingDays']);
			
			foreach($presupuestoQry as $idPresupuesto => $presupuestoContainer){
			  foreach($presupuestoContainer as $presupuestoIndex => $presupuestoContent){
// 				pr($presupuestoContent);
				$presupuesto[$id_empresa][$year][$monthLabel][$presupuestoContent['unidadNegocio']] = $presupuestoContent['presupuesto'];
			  }
			}
			if(!isset($presupuesto)){
			  $presupuesto = null;
			}
// 			this even exists any way!XD must add in DB
			if($id_empresa == '1'){
			  $presupuesto[$id_empresa][$year][$monthLabel]['Chihuahua'] = null;
			  $presupuesto[$id_empresa][$year][$monthLabel]['Ciudad Juarez'] = null;
			}
			$projeccion['Presupuesto'] = $presupuesto;
			if($debug){
			  pr($presupuesto);
			}
			if($debug){
			  if(isset($CurrentOperation)){
// 				var_dump($CurrentOperation);
			  }
// 			  exit();
			}

// 			pr($_SESSION['projections']['operacion']['totalToneladasAreaAnual'][$id_empresa]['Granel']);
// 			$return = true;
		/** ALERT NOTE this is a temporal patch ALERT */
// 			if(empty($return) OR $return === false){
// 				$countDays = $projeccion['workingDays']['totalCurrentWorkingDays'] - ($projeccion['workingDays']['currentWorkDaysDelay']-1);
// 				$days = "P".$countDays."D";
// 				$fecha = date('Y-m-d').' 00:00:00';
// 				$past = new DateTime(date('Y-m-d'));
// 				$past->sub(new DateInterval($days));
// 				$newDate = $past->format('Y-m-d').' 00:00:00';
// 				$CurrentOperation = $this->$model[$id_empresa]->query('select * from '.$table[$id_empresa].' where fecha_guia > "'.$newDate .' and id_area in (1,2,3,4,5)"');
// 			}else{
				$CurrentOperation = $this->$model[$id_empresa]->query('select * from '.$table[$id_empresa].' where fecha_guia like "'.$fecha.'%"');
// 			}
// 			pr($CurrentOperation);
// 			var_dump($return);
		/** ALERT NOTE this is a temporal patch ALERT */
		
		// NOTE how to fix with fleets?
		$CurrentOperationData = unidadesNegocio()[$_SESSION['Auth']['User']['id_empresa']];
		$CurrentOperationDetailData = null;
// 			if(!empty($CurrentOperation)){
			
			  foreach($CurrentOperation as $id_operation => $operationCurrentData){
				foreach($operationCurrentData as $descriptionOperacion){
// 				  pr($id_empresa);
				  if(isset($listFlotas[$id_empresa][$descriptionOperacion['id_flota']])){
					 $id_flota = trim(ucwords(strtolower($listFlotas[$id_empresa][$descriptionOperacion['id_flota']])));
				  }
				  if(empty($id_flota)){
					$id_flota = 'N/A';
				  }
				  if(isset($fleets[$descriptionOperacion['id_fraccion']])){
					$id_fraccion = $fleets[$descriptionOperacion['id_fraccion']];
				  }
				  $id_area = $getAreas[$descriptionOperacion['id_area']];
// 				  pr($id_area);
				  if(isset($tipoOperacion[$id_empresa][$descriptionOperacion['id_tipo_operacion']])){
					$tpoOperation = $tipoOperacion[$id_empresa][$descriptionOperacion['id_tipo_operacion']];
				  }
				  if(!isset($CurrentOperationData[$id_area][$id_fraccion][$id_flota][$tpoOperation])){
					$CurrentOperationData[$id_area][$id_fraccion][$id_flota][$tpoOperation] = null;
				  }
// 				  pr($CurrentOperationData);
  //TODO=> this done
				  $CurrentOperationData[$id_area][$id_fraccion][$id_flota][$tpoOperation] += $descriptionOperacion['peso'];
				  if(!isset($CurrentOperationDetailData[$id_area][$id_fraccion][$tpoOperation])){
					$CurrentOperationDetailData[$id_area][$id_fraccion][$tpoOperation] = null;
				  }
				  $CurrentOperationDetailData[$id_area][$id_fraccion][$tpoOperation] += $descriptionOperacion['peso'];
				}//End operationCurrentData
			  }//End CurrentOperation
//   			pr($CurrentOperationDetailData);
//   			pr($CurrentOperationData);
//   			exit();
			  $projeccion['CurrentDetailOperation'] = $CurrentOperationDetailData;
// 			  pr($presupuesto);
			  foreach($CurrentOperationData as $areaName => $fractionDesc ){//Search the current operation
				foreach($fractionDesc as $fraccionName => $flotasSubtotal){
				  foreach($flotasSubtotal as $flotasOperationName => $flotasOperationData){

					foreach($flotasOperationData as $tipoOperacionName => $tipoOperacionData){

					  if($fraccionName === 'Granel'){ // filter by fraction
				  // ALERT => Inconsistence in bonampakdb Unidad Negocio => Tijuana area => Tijuana , 
				  //  and tipo_operacion => Mexicali so patch ??
				  // TODO && WARNING  adjust this for work with terceros because this already goes to crapWorld!
						if($id_empresa == '1'){ // This works when session is active of course
							/***/
// 							if($tipoOperacionName === 'Mexicali'){
// 							  $searchTipoOperacionName = 'Tijuana';
// 							}else{
							  $searchTipoOperacionName = $tipoOperacionName;
// 							}
							if(array_key_exists($searchTipoOperacionName,$presupuesto[$id_empresa][$year][$monthLabel])){

							  if(!isset($operationCurrent[$areaName][$searchTipoOperacionName])){
								$operationCurrent[$areaName][$searchTipoOperacionName] = null;
							  }
							  if($debug){
								e('<pre>Area => '.$areaName.' flota =>'.$flotasOperationName.' tipoOperacion=>'.$tipoOperacionName.' Data=>'.$tipoOperacionData.'</pre>');
							  }
							  
// 							  ALERT BUG of operation Capture dissmiss NOTE -> Temporal issue -> this must be delete // this is a temporal requeriment Or not ??? XDXDXD!
								if ($areaName === 'Hermosillo' and $searchTipoOperacionName === 'Orizaba') {
// 									debug($operationCurrent);
// 									pr($tipoOperacionData);
									$operationCurrent['Hermosillo']['Hermosillo'] += $tipoOperacionData;
									unset($operationCurrent['Hermosillo']['Orizaba']);
								} else { //This is the only and correct and original process
									$operationCurrent[$areaName][$searchTipoOperacionName] += $tipoOperacionData;
								}
// 							  ALERT NOTE -> Temporal issue -> this must be delete

//								 NOTE originalCode 
// 									$operationCurrent[$areaName][$searchTipoOperacionName] += $tipoOperacionData;
//								 NOTE originalCode 
							}else{
							  if($debug){
								e('<pre style="color:red;">Area => '.$areaName.' flota =>'.$flotasOperationName.' tipoOperacion=>'.$tipoOperacionName.' Data=>'.$tipoOperacionData.'</pre>');
							  }
							  if(array_key_exists($areaName,$presupuesto[$id_empresa][$year][$monthLabel])){
								if(!isset($operationCurrent[$areaName][$areaName])){
								  $operationCurrent[$areaName][$areaName] = null;
								}
								$operationCurrent[$areaName][$areaName] += $tipoOperacionData;
							  }
							}
						/** @end pacth for Bonampak and fresh start for next companies HA HA HA */
						} elseif ($id_empresa == '3'){
							
							if(!isset($operationCurrent[$areaName][$flotasOperationName])){
								$operationCurrent[$areaName][$flotasOperationName] = null;
							}
	// 							pr($flotasOperationName);

// 							$operationCurrent[$areaName][$flotasOperationName] += $tipoOperacionData;
							$operationCurrent[$areaName]['Cuautitlan'] += $tipoOperacionData;
						/** @end patch for teisa */
						} else {
					// if assuming that the flotas is unchanged this is ok but ...
							if(!isset($operationCurrent[$areaName][$flotasOperationName])){
								$operationCurrent[$areaName][$flotasOperationName] = null;
							}
							$operationCurrent[$areaName][$areaName] += $tipoOperacionData;
						}/** @end Atm */

					  } // end 1st level
					} // end granel
				  }
				}
			  }
			  if($debug){
				pr($operationCurrent);//get Total by area and Total-Global
			  }
// 			  pr($operationCurrent);
// 			  exit();
			  if(isset($operationCurrent)){
				$projeccion['CurrentOperation'] = $operationCurrent;
	// 			$projeccion['workingDays']['currentWorkDays'] = 22;
	// 			pr($projeccion['workingDays']['totalCurrentWorkingDays']);
	// 			pr($getAreas);
				//Set the detail with a fix
				foreach($operationCurrent as $area_name => $tipo_operacion_data){
				  foreach($tipo_operacion_data as $tpoOperationName => $tipoOperationData){
				/** @set=> calculate the total and global values */
					/** @operation_total_by_areaName **/
					if(!isset($projection['totalOperationData'][$area_name])){
					  $projection['totalOperationData'][$area_name] = null;
					}
					$projection['totalOperationData'][$area_name] += $tipoOperationData;
					
					/** @projectionOperation_total_by_areaName **/
					
					if(!isset($projection['totalProjectionOperationData'][$area_name])){
					  $projection['totalProjectionOperationData'][$area_name] = null;
					}
					if(array_search($tpoOperationName,$flotasDesc[$area_name])){
// 					pr($year);
// 					pr($tipoOperationData);
// 					pr($projeccion['workingDays']['currentWorkDaysDelay']);
// 					pr($monthLabel);
// 					pr($area_name);
// 					pr($fraccionName);
// 					call the function muajamuajaja();
					if(!isset($projectionData[$id_empresa][$year][$monthLabel][$area_name])){
						$projectionData[$id_empresa][$year][$monthLabel][$area_name] = null;
					}
					
					/** ALERT NOTE this is a temporal patch ALERT */

// 					if($_SESSION['Auth']['User']['id_empresa'] === '1' OR $_SESSION['Auth']['User']['id_empresa'] === '3') {
						$projectionData[$id_empresa][$year][$monthLabel][$area_name] = $this->projectionsFormula($labDays=$projeccion['workingDays']['currentWorkDaysDelay'],$allLabDays=$projeccion['workingDays']['totalCurrentWorkingDays'],$year,$monthLabel,$tpoOperationName,$fraccionName);
// 					} else if($_SESSION['Auth']['User']['id_empresa'] === '2'){
// 						$projectionData[$id_empresa][$year][$monthLabel][$area_name] = $this->projectionsFormula($labDays=$projeccion['workingDays']['currentWorkDaysDelay'],$allLabDays=$projeccion['workingDays']['totalCurrentWorkingDays'],$year,$monthLabel,$area_name,$fraccionName);
// 					}
// 					pr($projectionData[$id_empresa][$year][$monthLabel][$area_name].' => '.$area_name.' => '.$tpoOperationName);
// 					var_dump($areaName);
// 					var_dump($tpoOperationName);
					//ALERT this is gona to edit by the new formula and maybe wee need a function hir
					// NOTE ok then the thing is as follows get the data for full totalLabDays of a current month
					// sum the toneladas of current days  + offsetdays 
					// then divide againts currentLabDays and sum the x-n  total lab days  of the CurrentMonth
					/** BUG @original <this is the original calculation> */
// 					  $projection['totalProjectionOperationData'][$area_name] += ($tipoOperationData/$projeccion['workingDays']['currentWorkDaysDelay'])*($projeccion['workingDays']['totalCurrentWorkingDays']);
					/** BUG @original*/
					  $projection['totalProjectionOperationData'][$area_name] += ($tipoOperationData+$projectionData[$id_empresa][$year][$monthLabel][$area_name]);
// 					  pr($tipoOperationData);
// 					  pr($tipoOperationData+$projectionData[$id_empresa][$year][$monthLabel][$area_name]);
					  
					/** ALERT NOTE this is a temporal ?? patch ALERT */
					}
					
					/** @varPresupuesto_total_by_areaName **/
					if(!isset($projection['totalVarPresupuesto'][$area_name])){
					  $projection['totalVarPresupuesto'][$area_name] = null;
					}
					
					/** BUG OR @NOT??
					 * @problem if the company is not bonampak and the record for granel is a unit for terceros 
					 *  then have a undefined index ; if save a record in presupuesto with 0.0 then appear a dividsion
					 *  by zero so ...
					 */
					//debugging
					// can this innocent fix get consecuenses? the answer is a unlimited unknow XD!
					// but the thruth is a 100% of probably yes it can!
					if(!isset($presupuesto[$id_empresa][$year][$monthLabel][$tpoOperationName])){
						$presupuesto[$id_empresa][$year][$monthLabel][$tpoOperationName] = null;
					}
					/** NOTE ok end of the bug issue  comment it if cause troubles */
					
					if(array_search($tpoOperationName,$flotasDesc[$area_name])){

					  $projection['totalVarPresupuesto'][$area_name] += (($tipoOperationData+$projectionData[$id_empresa][$year][$monthLabel][$area_name])) - $presupuesto[$id_empresa][$year][$monthLabel][$tpoOperationName];
					}
// 					$projection['totalVarPresupuesto'][$area_name] += (($tipoOperationData/$projeccion['workingDays']['currentWorkDaysDelay'])*($projeccion['workingDays']['totalCurrentWorkingDays'])) - $presupuesto[$id_empresa][$year][$monthLabel][$tpoOperationName];
					
					/** @presupuestoTotal_by_areaName **/
					if(!isset($projection['totalCurrentPresupuesto'][$area_name])){
					  $projection['totalCurrentPresupuesto'][$area_name] = null;
					}

					if(array_search($tpoOperationName,$flotasDesc[$area_name])){
					  $projection['totalCurrentPresupuesto'][$area_name] += $presupuesto[$id_empresa][$year][$monthLabel][$tpoOperationName];
					}

					/** @dailyOperation **/
				/** @set=> calculate the daily values filtering the inconsistence */
					if(in_array($tpoOperationName,$getAreas)){
					  if($tpoOperationName !== $area_name){
	// 					we can save this before
						$tipo_operacion_data[$tpoOperationName] = null;
					  }
					}
// 					pr($tipo_operacion_data);
// 					if(!empty($tipo_operacion_data[$tpoOperationName])){ //ALERT => old condition
					if(isset($tipo_operacion_data[$tpoOperationName])){
						/** ALERT NOTE this is a temporal patch ALERT */
					/** WARNING this is tricky using the past month */
					
					/** @ProjeccionDiariaByArea */
					/** BUG @original*/
// 						$projection['proyectadoTipoOperacion'][$area_name][$tpoOperationName] = ($tipoOperationData/$projeccion['workingDays']['currentWorkDaysDelay'])*($projeccion['workingDays']['totalCurrentWorkingDays']);
					/** BUG @original*/
					$projection['proyectadoTipoOperacion'][$area_name][$tpoOperationName] = ($tipoOperationData+$projectionData[$id_empresa][$year][$monthLabel][$area_name]);
					/** @ProjeccionDiariaByArea */

						
					/** ALERT NOTE this is a temporal patch ALERT */
					
// 					($tipoOperationData+$projectionData[$id_empresa][$year][$monthLabel][$area_name])
					
					/** BUG @original*/
// 						$projection['proyectadoVarPresupuesto'][$area_name][$tpoOperationName] = (($tipoOperationData/$projeccion['workingDays']['currentWorkDaysDelay'])*($projeccion['workingDays']['totalCurrentWorkingDays'])) - $presupuesto[$id_empresa][$year][$monthLabel][$tpoOperationName];
					/** BUG @original*/
					
						$projection['proyectadoVarPresupuesto'][$area_name][$tpoOperationName] = (($tipoOperationData+$projectionData[$id_empresa][$year][$monthLabel][$area_name])) - $presupuesto[$id_empresa][$year][$monthLabel][$tpoOperationName];
						
						if(!empty($presupuesto[$id_empresa][$year][$monthLabel][$tpoOperationName])){
						/** BUG @originalPromedioDiario*/
// 						  $projection['proyectadoVarPromedioDiario'][$area_name][$tpoOperationName] = (((($tipoOperationData/$projeccion['workingDays']['currentWorkDaysDelay'])*($projeccion['workingDays']['totalCurrentWorkingDays']))/$presupuesto[$id_empresa][$year][$monthLabel][$tpoOperationName]) - 1)*100;
						/** BUG @originalPromedioDiario*/
						  $projection['proyectadoVarPromedioDiario'][$area_name][$tpoOperationName] = (((($tipoOperationData+$projectionData[$id_empresa][$year][$monthLabel][$area_name]))/$presupuesto[$id_empresa][$year][$monthLabel][$tpoOperationName]) - 1)*100;
						}
					}
				  }
					/** @varPromedioDiario_total_by_areaName **/
					if(!isset($projection['totalVarPromedioDiario'][$area_name])){
					  $projection['totalVarPromedioDiario'][$area_name] = null;
					}
	// 				if(!empty($presupuesto[$id_empresa][$year][$monthLabel][$tpoOperationName])){
	// 				  pr($projection['totalVarPresupuesto'][$area_name]);
	// 				  pr($projection['totalCurrentPresupuesto'][$area_name]);
					  if(!empty($projection['totalCurrentPresupuesto'][$area_name])){
						$projection['totalVarPromedioDiario'][$area_name] = ($projection['totalVarPresupuesto'][$area_name]/$projection['totalCurrentPresupuesto'][$area_name])*100;
					  }
	// 				}

				}
					/** @operationGlobal_total **/

				if(!empty($projection['totalOperationData'])){
				  $projection['totalGlobalOperationData'] = array_sum($projection['totalOperationData']);
				}
				if(!empty($projection['totalProjectionOperationData'])){
				  $projection['totalGlobalProjectionOperationData'] = array_sum($projection['totalProjectionOperationData']);

				}
				if(!empty($projection['totalVarPresupuesto'])){
				  $projection['totalGlobalVarPresupuesto'] = array_sum($projection['totalVarPresupuesto']);
				}
				if(!empty($projection['totalCurrentPresupuesto'])){
				  if(isset($presupuesto[$id_empresa][$year][$monthLabel])){
					$projection['totalGlobalCurrentPresupuesto'] = array_sum($presupuesto[$id_empresa][$year][$monthLabel]);
				  }
				}
				if(!empty($projection['totalVarPromedioDiario'])){
				  if(array_sum($projection['totalCurrentPresupuesto']) > 0){
					$projection['totalGlobalVarPromedioDiario'] = ((array_sum($projection['totalVarPresupuesto']))/(array_sum($projection['totalCurrentPresupuesto'])))*100;
				  }
				}
			  }else{//ALERT->End of isset operationCurrent
// 				pr("Alert");
				  $projection['CurrentOperation'] = null;
				  $projection['totalGlobalOperationData'] = null;
				  $projection['totalGlobalProjectionOperationData'] = null;
				  $projection['totalGlobalCurrentPresupuesto'] = null;
				  $projection['totalGlobalVarPresupuesto'] = null;
				  $projection['totalGlobalVarPromedioDiario'] = null;
			  }
			  if($debug){
				pr($projection);
			  }
			  //make a selection with and unset the alt 
// 			}else{// end if not empty CurrentOperation;
// // 			  $projection = null;
// 			  $projection['CurrentOperation'] = null;
// 			  $projection['totalGlobalOperationData'] = null;
// 			  $projection['totalGlobalProjectionOperationData'] = null;
// 			  $projection['totalGlobalCurrentPresupuesto'] = null;
// 			  $projection['totalGlobalVarPresupuesto'] = null;
// 			  $projection['totalGlobalVarPromedioDiario'] = null;
// 			}

				/** @this->data Comes from flotas aproach and this must be the only approach **/
  // 					$currentProjection = ($flotasOperationData/$projeccion['workingDays']['currentWorkDays'])*($projeccion['workingDays']['totalCurrentWorkingDays']);
  // 					$currentPresupuesto = $presupuesto[$id_empresa][$year][$monthLabel][$flotasOperationName];
  // 
  // 					if(!isset($projectado['totalOperationData'][$areaName])){
  // 					  $projectado['totalOperationData'][$areaName] = null;
  // 					}
  // 					$projectado['totalOperationData'][$areaName] += $flotasOperationData;
  // 					if(!isset($projectado['totalGlobalOperationData'])){
  // 					  $projectado['totalGlobalOperationData'] = null;
  // 					}
  // 					$projectado['totalGlobalOperationData'] += $flotasOperationData;
  // 					if(!isset($projectado['totalcurrentPresupuesto'][$areaName])){
  // 					  $projectado['totalcurrentPresupuesto'][$areaName] = null;
  // 					}
  // 					$projectado['totalcurrentPresupuesto'][$areaName] += $presupuesto[$id_empresa][$year][$monthLabel][$flotasOperationName];
  // 					if(!isset($projectado['totalGlobalcurrentPresupuesto'])){
  // 					  $projectado['totalGlobalcurrentPresupuesto'] = null;
  // 					}
  // 					$projectado['totalGlobalcurrentPresupuesto'] += $presupuesto[$id_empresa][$year][$monthLabel][$flotasOperationName];
  // 					
  // 					$projectado['projectado'][$areaName][$fraccionName][$flotasOperationName] = $currentProjection;
  // 					
  // 					if(!isset($projectado['totalProjectado'][$areaName])){
  // 					  $projectado['totalProjectado'][$areaName] = null;
  // 					}
  // 					  $projectado['totalProjectado'][$areaName] += $currentProjection;
  // 					  
  // 					$projectado['varPresupuesto'][$areaName][$fraccionName][$flotasOperationName] = $currentProjection-$currentPresupuesto;
  // 					
  // 					if(!isset($projectado['totalvarPresupuesto'][$areaName])){
  // 					  $projectado['totalvarPresupuesto'][$areaName] = null;
  // 					}
  // 					$projectado['totalvarPresupuesto'][$areaName] += $currentProjection-$currentPresupuesto;
  // 					
  // 					$projectado['varPromDiario'][$areaName][$fraccionName][$flotasOperationName] =($currentProjection/$currentPresupuesto)-1;
  // 					
  // 					if(!isset($projectado['totalvarPromDiario'][$areaName])){
  // 					  $projectado['totalvarPromDiario'][$areaName] = null;
  // 					}
  // 					$projectado['totalvarPromDiario'][$areaName] += ($currentProjection/$currentPresupuesto)-1;
  // 					
  // 					//Set Global areaTotal
  // 					if(!isset($projectado['totalGlobalProjectado'])){
  // 					  $projectado['totalGlobalProjectado'] = null;
  // 					}
  // 					$projectado['totalGlobalProjectado'] += $currentProjection;
  // 					if(!isset($projectado['totalGlobalvarPresupuesto'])){
  // 					  $projectado['totalGlobalvarPresupuesto'] = null;
  // 					}
  // 					$projectado['totalGlobalvarPresupuesto'] += $currentProjection-$currentPresupuesto;
  // 					if(!isset($projectado['totalGlobalvarPromDiario'])){
  // 					  $projectado['totalGlobalvarPromDiario'] = null;
  // 					}
  // 					$projectado['totalGlobalvarPromDiario'] += ($currentProjection/$currentPresupuesto)-1;
			if($debug){
				exit();
			}
			$projeccion['projectado'] = $projection;
// 			pr($projection);

		if(!isset($_SESSION['projections']['projeccion']) and !isset($return)){
			  $_SESSION['projections']['projeccion']=$projeccion;
		}else{
		  if( !isset($return) ){
		  	return $_SESSION['projections']['projeccion'];
		  }else{
			return $projeccion;
		  }
		}

      } // End projection

      function acumulado($id_empresa=null,$year=null,$month=null){
			
// 			$debug = true;
// 			$debug = false;
// 			$projeccion['productoDays'] = $projeccion['workingDays']['currentWorkDays']*$projeccion['workingDays']['totalCurrentWorkingDays'];
			if(empty($year)){
			  $year = date('Y');
			  $month = date('n');
			  $day = date('j');
			}else{
// 			  var_dump($year);
			  if($year < date('Y')){
				$month = '12';
				$day = date('t',mktime('0','0','0',$month,'01',$year));
			  }elseif($year == date('Y')){
				$month = date('n');
				$day = date('j');
			  }
			}

			if(empty($id_empresa)){
			  $id_empresa = $_SESSION['Auth']['User']['id_empresa'];
			}
			$monthLabel = date('M',mktime('0','0','0',$month,'01',$year));
// 			$workingDays = $this->workingDays(/*$debug=*/null,$year,/*$month=*/null,/*$session=*/true);
// 			$workingDays = $this->workingDays($debug=null,$year,$month=null,$session=false);
			$workingDays = $this->workingDays($debug=null,$year,null,true);


			// WARNING WARNING NOTE ALERT uncomment this if needed
// 			if((int)$month === (int)date('m')){
// 			  if($projeccion['workingDays']['currentWorkDays'] > 1){
// 				$projeccion['workingDays']['currentWorkDaysDelay'] = ($projeccion['workingDays']['currentWorkDays'] - 1);
// 			  }elseif($projeccion['workingDays']['currentWorkDays'] === 1){
// 				/** NOTE maybe this must be zero ?? */
// 				$projeccion['workingDays']['currentWorkDaysDelay'] = $projeccion['workingDays']['currentWorkDays'];
// 			  }else{
// 				$this->redirect('index');
// 			  }
// 			}else{
// 			  $projeccion['workingDays']['currentWorkDaysDelay'] = $projeccion['workingDays']['currentWorkDays'];
// 			}//end currentmonth
			// WARNING WARNING NOTE ALERT
			
			
			$getFlotas['1'] = $this->Fleets->getFlotas();
			$getFlotas['2'] = $this->FleetsAtm->getFlotasAtm();
			$getFlotas['3'] = $this->FleetsTei->getFlotasTei();
			$listFlotas['1'] = $this->Flotas->find('list',array('fields'=>array('id_flota','nombre')));
			$listFlotas['2'] = $this->FlotasAtm->find('list',array('fields'=>array('id_flota','nombre')));
			$listFlotas['3'] = $this->FlotasTei->find('list',array('fields'=>array('id_flota','nombre')));
			$TipoOperacion['1'] = $this->TipoOperacion->find('list',array('fields'=>array('id_tipo_operacion','tipo_operacion')));
			$getAreas = $this->areas();
			$TipoOperacion['2'] = $this->TipoOperacionAtm->find('list',array('fields'=>array('id_tipo_operacion','tipo_operacion')));
			$TipoOperacion['3'] = $this->TipoOperacionTei->find('list',array('fields'=>array('id_tipo_operacion','tipo_operacion')));

			$flotas = $getFlotas[$id_empresa];
			foreach($flotas as $id_fleets => $fleetsData){
			  foreach($fleetsData['Flotas'.$this->Empresas()] as $fleetsContent){
				$flotasDesc[$getAreas[$fleetsData['Fleets'.$this->Empresas()]['id_area']]][$fleetsContent['id_flota']] = str_replace('Cd. Juarez','Ciudad Juarez',trim(ucwords(strtolower($fleetsContent['nombre']))));
			  }
			}
// 			if($debug){
// 			  pr($flotasDesc);
// 			}
// 			exit();
			$conditions['Presupuesto.year'] = $year;
// 			$conditions['Presupuesto.month'] = date('m');
			$conditions['Presupuesto.id_empresa'] = $id_empresa;
			$conditions['Presupuesto.status'] = 'Active';

			$presupuestoQry = $this->Presupuesto->find('all',array('conditions'=>$conditions));
// 			if($debug){
// 			  pr($presupuestoQry);
// 			  exit();
// 			}

			foreach($presupuestoQry as $idPresupuesto => $presupuestoContainer){
			  foreach($presupuestoContainer as $presupuestoIndex => $presupuestoContent){

// 				pr($presupuestoContent);
				$presupuesto[$id_empresa][$year][date('M',mktime('0','0','0',$presupuestoContent['month'],'01',$year))][$presupuestoContent['unidadNegocio']] = $presupuestoContent['presupuesto'];
				/** NOTE this is not existent in the prep but must appear in the calcs*/
				if($id_empresa == '1'){
				  $presupuesto[$id_empresa][$year][date('M',mktime('0','0','0',$presupuestoContent['month'],'01',$year))]['Chihuahua'] = null;
				  $presupuesto[$id_empresa][$year][date('M',mktime('0','0','0',$presupuestoContent['month'],'01',$year))]['Ciudad Juarez'] = null;
				}
				if(!isset($totalPresupuestoFlota[$id_empresa][$year][$presupuestoContent['unidadNegocio']])){
				  $totalPresupuestoFlota[$id_empresa][$year][$presupuestoContent['unidadNegocio']] = null;
				}
				$totalPresupuestoFlota[$id_empresa][$year][$presupuestoContent['unidadNegocio']] += $presupuestoContent['presupuesto'];
				
				if(!isset($totalPresupuesto[$id_empresa][$year][date('M',mktime('0','0','0',$presupuestoContent['month'],'01',$year))])){
				  $totalPresupuesto[$id_empresa][$year][date('M',mktime('0','0','0',$presupuestoContent['month'],'01',$year))] = null;
				}
				
				$totalPresupuesto[$id_empresa][$year][date('M',mktime('0','0','0',$presupuestoContent['month'],'01',$year))] += $presupuestoContent['presupuesto'];
// 				pr($presupuestoContent['month']);
			  }
			}
			
				if($id_empresa == '1'){
				  $totalPresupuestoFlota[$id_empresa][$year]['Chihuahua'] = null;
				  $totalPresupuestoFlota[$id_empresa][$year]['Ciudad Juarez'] = null;
				  $totalPresupuesto[$id_empresa][$year]['Chihuahua'] = null;
				  $totalPresupuesto[$id_empresa][$year]['Ciudad Juarez'] = null;
				}
// 			ksort($presupuesto[$id_empresa][$year]);
			
			if(!isset($presupuesto)){
			  $presupuesto = null;
			}

// 			if($debug){
// 			  pr($presupuesto);
// 			  exit();
// 			}

			$months = $_SESSION['projections']['months'];
// var_dump($month);
			foreach($months as $id_month => $data){
			  if(isset($this->projection($id_empresa,$set=false,$return=true,$year,$area=false,$fraccion=false,$flota=false,$id_month,$debug=false)['CurrentOperation'])){
				if($id_month <= $month){
				  $storeProjection = $this->projection($id_empresa,$set=false,$return=true,$year,$area=false,$fraccion=false,$flota=false,$id_month,$debug=false)['CurrentOperation'];
				  $getOperation[$data['short']] = $storeProjection;

				  foreach($flotasDesc as $areaName => $areaContent){
					foreach($areaContent as $id_area => $flotaName){
	// 				  $acumuladoBuilding[$id_empresa][$year][$areaName][$flotaName][$data['short']] = null;
					  if(isset($getOperation[$data['short']][$areaName][$flotaName])){
						$acumuladoBuilding[$id_empresa][$year][$areaName][$flotaName][$data['short']]['operation'] = $getOperation[$data['short']][$areaName][$flotaName];
					  }
					  if(isset($presupuesto[$id_empresa][$year][$data['short']][$flotaName])){
						$acumuladoBuilding[$id_empresa][$year][$areaName][$flotaName][$data['short']]['presupuesto'] = $presupuesto[$id_empresa][$year][$data['short']][$flotaName];
					  }
					  
					  if(!empty($presupuesto[$id_empresa][$year][$data['short']][$flotaName]) OR $flotaName == 'Chihuahua' OR $flotaName == 'Ciudad Juarez'){
						
						if(!isset($acumuladoBuildingWork[$id_empresa][$year][$flotaName])){
						  $acumuladoBuildingWork[$id_empresa][$year][$flotaName] = null;
						}
						if(isset($getOperation[$data['short']][$areaName][$flotaName])){
						$acumuladoBuildingWork[$id_empresa][$year][$flotaName] += $getOperation[$data['short']][$areaName][$flotaName];
						}
						if(!isset($acumuladoBuildingPrep[$id_empresa][$year][$flotaName])){
						  $acumuladoBuildingPrep[$id_empresa][$year][$flotaName] = null;
						}
						/** @Presupuesto->se calcula el presupuesto acumulado al dia actual  */
						if($data['short'] == $monthLabel ){
						  $acumuladoBuildingPrep[$id_empresa][$year][$flotaName] += (($presupuesto[$id_empresa][$year][$data['short']][$flotaName])/$workingDays['totalCurrentWorkingDays'])*$workingDays['currentWorkDays'];
						}else{
						  $acumuladoBuildingPrep[$id_empresa][$year][$flotaName] += $presupuesto[$id_empresa][$year][$data['short']][$flotaName];
						}
					  }
					}
				  }
				}
			 }
			}//End foreach months
// var_dump($acumuladoBuilding);
// pr($acumuladoBuildingPrep);
// pr($acumuladoBuildingPrepTest);
// exit();

			if(isset($acumuladoBuildingWork)){
			  foreach($acumuladoBuildingWork[$id_empresa][$year] as $area_nombre => $totalOperacionAcumulado){
  // 			  pr($area_nombre);
				if(isset($acumuladoBuildingPrep[$id_empresa][$year][$area_nombre])){
				  $prep = $acumuladoBuildingPrep[$id_empresa][$year][$area_nombre];
				  $acumuladoPresupuesto[$area_nombre]['varToneladas'] = $totalOperacionAcumulado - $prep;
				  //ALERT
				  /**.@case->of Chihuahua and Juarez city they don't have presupuesto*/
				  if(!empty($prep)){
					$acumuladoPresupuesto[$area_nombre]['variation'] = ($totalOperacionAcumulado/$prep)-1;
				  }else{
					$acumuladoPresupuesto[$area_nombre]['variation'] = null;//ALERT->the must show zero value
				  }
				}

			  }
			}
			
// 			pr($acumuladoBuildingWork);
// 			pr($acumuladoBuildingPrep);
// 			pr($acumuladoPresupuesto);
			if(!isset($acumuladoBuildingWork)){
			  $acumuladoBuildingWork = null;
			}if(!isset($acumuladoBuildingPrep)){
			  $acumuladoBuildingPrep = null;
			}if(!isset($acumuladoPresupuesto)){
			  $acumuladoPresupuesto = null;
			}
			
			$acumulado['acumuladoBuildingWork'] = $acumuladoBuildingWork;
			$acumulado['acumuladoBuildingPrep'] = $acumuladoBuildingPrep;
			$acumulado['acumuladoPresupuesto'] = $acumuladoPresupuesto;
			if(isset($acumuladoBuildingWork) OR isset($acumuladoBuildingPrep)){
			  $acumulado['totalGlobalAcumuladoVarToneladas'] = (array_sum($acumuladoBuildingWork[$id_empresa][$year])- array_sum($acumuladoBuildingPrep[$id_empresa][$year]));
			}
			if(!empty($acumuladoBuildingPrep[$id_empresa][$year]) OR isset($acumuladoBuildingPrep[$id_empresa][$year])){
			//NOTE the array exits but if is sum is zero?
				if((array_sum($acumuladoBuildingPrep[$id_empresa][$year]) > 0)){ // means is positive or negative
					$acumulado['totalGlobalAcumuladoVariation'] = (((array_sum($acumuladoBuildingWork[$id_empresa][$year])/array_sum($acumuladoBuildingPrep[$id_empresa][$year]))-1)*100);
				}
			}
			
			$acumulado['operacionTotalCurrent'] = $_SESSION['projections']['operacion']['totalToneladasAreaAnual'][$id_empresa]['Granel'];
			$acumulado['acumuladoDate']['year']=$year;
			$acumulado['acumuladoDate']['id_mes']=$month;
			$acumulado['acumuladoDate']['day']=$day;
			
			if(!isset($_SESSION['projections']['acumulado'])){
			  $_SESSION['projections']['acumulado'] = $acumulado;
			}else{
			  return $_SESSION['projections']['acumulado'];
			}
			
	  }
      
	  function getDataOp($filter=null,$operacion=null,$fractionMenu=null) {
		
		  Configure::write('debug',2);
// 		  var_dump('block');
			/** NOTE <temporal fix so check what happend hir >*/
		  if( empty($operacion) ){
			  $operacion = '1';
		  }
/*
		  var_dump($filter);
		  
		  
		  var_dump($operacion);*/
		  
// 		  select the operations 

		  $op_selector = array('1'=>'tonelaje','2'=>'kms','3'=>'ingresos','4'=>'kms');
			
		  $out_array = array('1'=>'toneladas','2'=>'kms','3'=>'ingresos','4'=>'viajes');
		  
		  $out_type_fraccion = array('1'=>'peso','2'=>'kms','3'=>'ingresos','4'=>'viajes');
			
// 		  debug($op_selector[$operacion]);
// 		  debug(ucfirst($op_selector[$operacion]));

		  $fractionMenu = $this->getFraction();
// 		  var_dump($fractionMenu);
// 		  pr($this->MssqlFlotasTbk->find('all'));
// 		  pr($this->fleets(true,false));
		  if($filter['fraccion'] === '1') {
// 			var_dump('for some reason fraccion means operation well in the spirit of the confusion this is for tons');
// // 			  this work for diferencing from toneladas and kms or trips
		  }else if ($filter['fraccion'] === '2') {
// 			var_dump('for some reason fraccion means operation well in the spirit of the confusion this is for kms');
		  }
		  
		  if(trim((string)$filter['fleet_name']) == 'Tijuana') {
			  $filter['fleet_name'] = 'Mexicali';
		  }
		  
	  		$replace = array(".");
			$filter['fleet_name'] = str_replace($replace,'', trim((string)$filter['fleet_name']));
// 		  pr(implode(',',$fraccion));
// 		  foreach($fraccion as $id_fraccio_idx) {
// 			  pr($id_fraccio_idx);

// 		  }

			$fleets = $this->MssqlFlotasTbk->getFlotas();
			
// 			pr($fleets);
// 			pr($this->MssqlAreasTbk->getAreas());
// 			pr($this->MssqlTipoOperacionTbk->getTipoOperacion());
// 			pr($this->MssqlFraccionTbk->getFraccion());
	  		
				
// 				pr($filter['fleet_name']);
// 				pr(case_flotas_tbk());
	  		
	  		$key = array_search(trim(strtolower((string)$filter['fleet_name'])),array_map('trim',array_map('strtolower',$fleets)));
	  		
// 	  		var_dump($key);
// 	  		$operacion = '2';
	  		
	  		/** NOTE  this is a very lazy arrangement tmp-eternal fix */
	  		$model['1'] = ucfirst($op_selector[$operacion]).'Current';
			$model['2'] = ucfirst($op_selector[$operacion]).'CurrentAtm';
			$model['3'] = ucfirst($op_selector[$operacion]).'CurrentTei';

			$table['1'] = $op_selector[$operacion].'_current';
			$table['2'] = $op_selector[$operacion].'_current_atm';
			$table['3'] = $op_selector[$operacion].'_current_tei';
			
		
		if($filter['area'] === '2' and $filter['id_empresa'] === '1') {
			if($key === 6 /*means flota Guadalajara.Culiacan*/) {
				$wreAdd = ' and id_tipo_operacion = 14 and id_flota in (5,6,7) ';
			} else if ($key === 7 /*means flota Guadalajara.LaPaz*/) {
				$wreAdd = ' and id_tipo_operacion = 12 and id_flota in (5,6,7) ';
			} else if ($key === 5 /*means flota Guadalajara.Guadalajara*/) {
				$wreAdd = ' and id_tipo_operacion not in (14,12) and id_flota in (5,6,7) ';
			} else {
				$wreAdd = ' and id_flota = '.$key;
			}
		}
		
// 		debug($table[$filter['id_empresa']]);
// 		debug($model[$filter['id_empresa']]);
// 		debug($wreAdd);

		/*

		select distinct  `no_viaje`,`id_area` as 'area', `id_flota` as 'floata', `id_fraccion` as 'fraccion', YEAR( `fecha_guia` ) as 'year' , MONTH( `fecha_guia` ) as 'month', `kms_viaje` *2 as 'kms', `kms_real`
		FROM `kms_current`
		WHERE YEAR( `fecha_guia` ) = '2015' 
				AND `id_area` = '2'
				AND `id_fraccion` IN ( '1', '2', '3')
		--		AND `id_flota` IN ( '5', '6', '7' )
				and id_tipo_operacion not in  ('14','12')
				group by id_area,id_fraccion,id_flota,month(fecha_guia),year(fecha_guia)
				order by year(fecha_guia),month(fecha_guia),id_area,id_flota;
				
select id_area as area,id_flota as flota,id_fraccion as fraccion,year(fecha_guia) as year,month(fecha_guia) as month,sum(subtotal) as subtotal from
				ingresos_current
				WHERE YEAR( `fecha_guia` ) = '2015' 
				AND `id_area` = '2'
				AND `id_fraccion` IN ( '1', '2', '3')
		--		AND `id_flota` IN ( '5', '6', '7' )
				and id_tipo_operacion not in  ('14','12')
				group by id_area,id_fraccion,id_flota,month(fecha_guia),year(fecha_guia)
				order by year(fecha_guia),month(fecha_guia),id_area,id_flota;
				
		
		*/
	$query_data = array(
					'1' => 'select id_area as area,id_flota as flota,id_fraccion as fraccion,year(fecha_guia) as year,month(fecha_guia) as month ,sum(peso) as peso from '.
							$table[$filter['id_empresa']].' where year(fecha_guia) = "'.$filter['year'].'" and id_area = '.$filter['area']. $wreAdd .
							' group by id_area,id_fraccion,id_flota,month(fecha_guia),year(fecha_guia) '.
							'order by year(fecha_guia),month(fecha_guia),id_area,id_flota',
							
					'2' => 'select distinct no_viaje,id_area as area, id_flota as flota, id_fraccion as fraccion, YEAR( fecha_guia ) as year , MONTH( fecha_guia ) as month ,
							(kms_viaje * 2) as kms , kms_real from '.$table[$filter['id_empresa']].' as '.$model[$filter['id_empresa']].' where year(fecha_guia) = '.
							$filter['year'].' and id_area = '.$filter['area']. $wreAdd,
					
					'3' => 'select id_area as area,id_flota as flota,id_fraccion as fraccion,year(fecha_guia) as year,month(fecha_guia) as month,sum(subtotal) as ingresos from '.
							$table[$filter['id_empresa']].' where year(fecha_guia) = "'.$filter['year'].'" and id_area = '.$filter['area']. $wreAdd .
							' group by id_area,id_fraccion,id_flota,month(fecha_guia),year(fecha_guia) '.
							'order by year(fecha_guia),month(fecha_guia),id_area,id_flota',
					
					'4' => 'select distinct no_viaje,id_area as area, id_flota as flota, id_fraccion as fraccion, YEAR( fecha_guia ) as year , MONTH( fecha_guia ) as month ,
							(kms_viaje * 2) as viajes , kms_real from '.$table[$filter['id_empresa']].' as '.$model[$filter['id_empresa']].' where year(fecha_guia) = '.
							$filter['year'].' and id_area = '.$filter['area']. $wreAdd
	);


// 		$query = 'select distinct no_viaje,id_area as area, id_flota as flota, id_fraccion as fraccion, YEAR( fecha_guia ) as year , MONTH( fecha_guia ) as month , (kms_viaje * 2) as kms , kms_real from '.$table[$filter['id_empresa']].' as '.$model[$filter['id_empresa']].' where year(fecha_guia) = '.$filter['year'].' and id_area = '.$filter['area']. $wreAdd ;
		
		$query = $query_data[$operacion];
		
		
// 		debug($query);
		
		$dataOperation = $this->$model[$filter['id_empresa']]->query($query);
// 		debug($dataOperation);
		
		foreach($dataOperation as $idxLvOne => $operation_and_idx) {
			foreach($operation_and_idx as $opIdx => $data ) {
				foreach($data as $key => $value) {
					$operationCurrent[$table[$filter['id_empresa']]][$idxLvOne][$key] = $value;
				}
			}
		}

// 		debug($operationCurrent);

		if(isset($operationCurrent)) {
			foreach($operationCurrent as $opTitle => $dataOpereation) {
				foreach($dataOpereation as $opIdx => $dataOp) {
					$month = date('M',mktime('0','0','0',$dataOp['month'],'01',$filter['year']));
					if(!isset($totalbymonth[$month])) {
						$totalbymonth[$month] = null;
					}
					
					foreach($fractionMenu as $idxFractionMenu => $labelFractionmenu) {
						if(!isset($totalbyfraccion[$month][$labelFractionmenu])) {
							$totalbyfraccion[$month][$labelFractionmenu] = null;
						}
					}

					
					if($operacion === '1'){
						if($dataOp['fraccion'] !== '5' and $dataOp['fraccion'] !== '4'){
							if($operacion === '4') {
								$totalbymonth[$month] += count($dataOp[$out_type_fraccion[$operacion]]);
							} else {
								$totalbymonth[$month] += $dataOp[$out_type_fraccion[$operacion]];
							}
						}
					} else {
					
						if($operacion === '4') {
							$totalbymonth[$month] += count($dataOp[$out_type_fraccion[$operacion]]);
						} else {
							$totalbymonth[$month] += $dataOp[$out_type_fraccion[$operacion]];
						}
					}
					
					if($operacion === '4') {
						$totalbyfraccion[$month][$fractionMenu[$dataOp['fraccion']]] += count($dataOp[$out_type_fraccion[$operacion]]);
					} else {
						$totalbyfraccion[$month][$fractionMenu[$dataOp['fraccion']]] += $dataOp[$out_type_fraccion[$operacion]];
					}
				}
			}
		}

// 		debug($totalbymonth);
// 		debug($totalbyfraccion);
		
		foreach($totalbyfraccion as $monthFraccion => $containerValueFraction) {
			foreach($containerValueFraction as $fractionLabel => $dataOpValuw) {
				if(!isset($byfraccion[$fractionLabel])) {
					$byfraccion[$fractionLabel] = null;
				}
					$byfraccion[$fractionLabel] += $dataOpValuw;
			}
		}
		
		
		$newTotalByFleet['TotalByMonth'] = $totalbymonth;
		$newTotalByFleet['TotalByYear'] = array_sum($totalbymonth);
		$newTotalByFleet['TotalByFraction'] = $byfraccion;
		$newTotalByFleet[$out_array[$operacion]] = $totalbyfraccion;
		
// 		debug($newTotalByFleet);
		
		return $newTotalByFleet;
		
// 		exit();
/*
		$query = 'select id_area as area,id_flota as flota,id_fraccion as fraccion,year(fecha_guia) as year,month(fecha_guia) as month ,sum(peso) as peso from '.$table[$filter['id_empresa']].' where year(fecha_guia) = "'.$filter['year'].'" and id_area = '.$filter['area']. $wreAdd .' group by id_area,id_fraccion,id_flota,month(fecha_guia),year(fecha_guia)
		order by year(fecha_guia),month(fecha_guia),id_area,id_flota';

// 		e('<kbd>Query: Test Culiacan</kbd>');
// 		pr($fractionMenu);
// 		pr($query);exit();
		
		
		
		$dataOperation = $this->$model[$filter['id_empresa']]->query($query);

		foreach($dataOperation as $idxLvOne => $operation_and_idx) {
			foreach($operation_and_idx as $opIdx => $data ) {
				foreach($data as $key => $value) {
					$operationCurrent[$table[$filter['id_empresa']]][$idxLvOne][$key] = $value;
				}
			}
		}

// 		debug($operationCurrent);
		
		if(isset($operationCurrent)) {
			foreach($operationCurrent as $opTitle => $dataOpereation) {
				foreach($dataOpereation as $opIdx => $dataOp) {
					$month = date('M',mktime('0','0','0',$dataOp['month'],'01',$filter['year']));
					if(!isset($totalbymonth[$month])) {
						$totalbymonth[$month] = null;
					}
					
					foreach($fractionMenu as $idxFractionMenu => $labelFractionmenu) {
						if(!isset($totalbyfraccion[$month][$labelFractionmenu])) {
							$totalbyfraccion[$month][$labelFractionmenu] = null;
						}
					}

					if($dataOp['fraccion'] !== '5' and $dataOp['fraccion'] !== '4'){
						$totalbymonth[$month] += $dataOp['peso'];
					}
					$totalbyfraccion[$month][$fractionMenu[$dataOp['fraccion']]] += $dataOp['peso'];
				}
			}
		}

// 		debug($totalbymonth);
// 		debug($totalbyfraccion);
		
		foreach($totalbyfraccion as $monthFraccion => $containerValueFraction) {
			foreach($containerValueFraction as $fractionLabel => $dataOpValuw) {
				if(!isset($byfraccion[$fractionLabel])) {
					$byfraccion[$fractionLabel] = null;
				}
				$byfraccion[$fractionLabel] += $dataOpValuw;
			}
		}
		
		
		
		
// 		pr($totalbymonth);
// 		pr($totalbyfraccion);//toneladas
// 		pr(array_sum($totalbyfraccion));
// 		pr($fractionMenu);
		$newTotalByFleet['TotalByMonth'] = $totalbymonth;
		$newTotalByFleet['TotalByYear'] = array_sum($totalbymonth);
		$newTotalByFleet['TotalByFraction'] = $byfraccion;
		$newTotalByFleet['toneladas'] = $totalbyfraccion;
		return $newTotalByFleet;
		
*/
		/*
		select id_area,id_flota,id_fraccion,year(fecha_guia),month(fecha_guia),sum(peso) 
		from projections.tonelaje_current
		where year(fecha_guia) = '2015'
				and id_area = '2' and id_fraccion in ('1','2','3') 
				and id_flota in ('5','6','7') 
				and id_tipo_operacion = '14'
		group by id_area,id_fraccion,id_flota,month(fecha_guia),year(fecha_guia)
		order by year(fecha_guia),month(fecha_guia),id_area,id_flota;
		
		select 
			dbo.trafico_producto.desc_producto,*
		from 
			dbo.trafico_producto
		where 
			dbo.trafico_producto.id_producto = 0
		-- and
			-- dbo.trafico_producto.id_fraccion = @id_fraccion

		*/
	  }

      function detail($year=null,$area=null,$fraccion=null,$flota=null,$name=null){

// 		  pr($this->data);
		  $_append = $this->Empresas();
		  $filter['year'] = $year;
		  $filter['area'] = $area;
		  $filter['areaName'] =$this->areas()[$area];
		  $filter['fraccion'] = $fraccion;
		  $filter['flota'] = $flota;
		  $filter['fleet_name'] = ucwords(strtolower($name));
		  $filter['id_empresa'] = $_SESSION['Auth']['User']['id_empresa'];
// 		  $model['tonelaje'] = 'TonelajeCurrent'.$_append;

		if(!isset($_SESSION['projections']['months'])){
		  $_SESSION['projections']['months'] = $this->months($return=true,$set=false,$year=date('Y'));
		}
		$months = $_SESSION['projections']['months'];
// 	  	exit();
		  // ALERT this can change having the table.db
		  $TpoOp = explode(',',$filter['flota']);
		  $FractionConditions['Fraccion.id'] = $filter['fraccion'];
	  /** 	ALERT:Use this for the real table trafico_producto
	  */
	  // 	pr(date('n'));
// 		if(!isset($_SESSION['projections']['fraction'])){
// 		  $_SESSION['projections']['fraction'] = $this->Fraccion->find('list',array('fields'=>array('id','fraccion')));
// 		}$fraction = $_SESSION['projections']['fraction'];
		$fraction = $this->getFraction($status = 'Active');
// 		$fraction = $this->getFraction(null);
// 		  for($i=1;$i<=date('n');$i++){
// 			$toneladas[date('M',mktime('0','0','0',$i,'01',$year))] = null ;
// 			foreach($fraction as $h => $d ){
// 				$toneladas[date('M',mktime('0','0','0',$i,'01',$year))][$d] = null;
// 				$TotalByFraction[$d] = null;
// 			}
// 		  }
// 	pr($TotalByFraction);
	  // 	pr($toneladas);
	  /** Variables to define
		* @param we need parameter for this !
		*/
	  /** TODO in this section will check and deploy the total tonels by month and check in where 
	  ** ALERT TODO make the changes for the other corp MACUSPANA and TEISA and maybe others
	  ** month we are and same thing for fraction and clean an reset your variables
	  */
	  
/*		  
		  foreach($months as $ky =>$dat){
			foreach($fraction as $llave => $dato){
			  if($dat['num'] <= date('n')){
			  $conditions[$dat['short']][$dato]['TonelajeCurrent'.$_append.'.fecha_guia LIKE'] = "%".$year."-".$dat['numeric']."%";
			  
				if($filter['area'] == true){
			  // Only check the area , will assume that 0 are all areas 
			  $conditions[$dat['short']][$dato]['TonelajeCurrent'.$_append.'.id_area'] = $filter['area'];
				}
			  
				if($filter['flota'] == true){
			  foreach($TpoOp as $k => $val){
				  $conditions[$dat['short']][$dato]['OR'][$k]['TonelajeCurrent'.$_append.'.id_tipo_operacion'] = $val;
			  }
				}
			  $conditions[$dat['short']][$dato]['TonelajeCurrent'.$_append.'.id_fraccion'] = $llave ;
			  } // End if to current month dat[num]
			} // End foreach fraction
		  } //end foreach of months
		  foreach($conditions as $key => $data){
			  foreach($fraction as $kv => $dta){
// 			  $tonelaje[$key][$dta] = $this->$model['tonelaje']->find('all',array('conditions'=>$conditions[$key][$dta]));
			  }
		  }*/

		
		 if(!isset($_SESSION['projections']['operacion'])){
			$this->operations();
		 }
// 		 pr($_SESSION['projections']['operacion']);
		  
		  if(isset($filter['area']) and $filter['area'] > 0 ){
			$Area = $this->areas()[$area];
			$toneladas = $_SESSION['projections']['operacion']['toneladasMensuales'][$_SESSION['Auth']['User']['id_empresa']][$Area];
			$TotalByFraction = $_SESSION['projections']['operacion']['totalToneladasByFractionAnual'][$_SESSION['Auth']['User']['id_empresa']][$Area];
			$TotalByMonth = $_SESSION['projections']['operacion']['totalToneladasMensuales'][$_SESSION['Auth']['User']['id_empresa']][$Area];

		  }
		  if($filter['area'] == 0){
			$toneladas = $_SESSION['projections']['operacion']['TotalToneladasMensualesByFraction'][$_SESSION['Auth']['User']['id_empresa']];
			$TotalByFraction = $_SESSION['projections']['operacion']['totalToneladasAreaAnual'][$_SESSION['Auth']['User']['id_empresa']];
			$TotalByMonth = $_SESSION['projections']['operacion']['totalToneladasOperacionMensual'][$_SESSION['Auth']['User']['id_empresa']];
// 			pr($_SESSION['projections']['operacion']['totalToneladasOperacionMensual'][$_SESSION['Auth']['User']['id_empresa']]);
		  }
// 		  var_dump('fractoin');
// 		  pr($TotalByMonth);
// 		  pr($toneladas);
// 		  var_dump('fraction');

// 		  this happend only if flota from Guadalajara exists
		  if($filter['flota'] > 1 and $filter['area'] === '2') {
// 			pr($this->getDataOp($filter,null,$fraction));
			$Totales = $this->getDataOp($filter,'1');
			$TotalByYear = $Totales['TotalByYear'];
			$toneladas = $Totales['toneladas'];
		  } else {

			$TotalByYear = array_sum($TotalByMonth);
			$Totales['TotalByYear'] = $TotalByYear;
			$Totales['TotalByMonth'] = $TotalByMonth;
			$Totales['TotalByFraction'] = $TotalByFraction;
			
			
		  }
		  
// 		  debug($TotalByMonth);
// 		  debug($TotalByYear);
// 		  debug($Totales);
		  
		  
		  
		  
		  $this->set('Totales',$Totales);
		  $this->set('toneladas',$toneladas);
		  $this->set('months',$months);
		  $this->set('fraccion',$fraction);
		  $this->set('filter',$filter);
// 		  $_SESSION['']
      } // End of Detail
      
      function modelTest(){
$time1 = microtime(true);
		App::Import('Shell', 'Shell');
		App::Import('Vendor',array('shells/sniffer_data'));
		$myShell = new SnifferDataShell(new Object());
		$myShell->initialize();
	// 	Select the method to call
// 		$Shell = $myShell->main($view=true,$debug=false);
		$Shell = $myShell->detail();
// 		['Toneladas']['Warnings']['report_day_check_toneladas']
// 		pr($vars['Toneladas']['Warnings']['report_day_check_toneladas']);
// 		exit();
	// 	pr($Shell);exit();
		$id_empresa = $_SESSION['Auth']['User']['id_empresa'];
			$getFlotas['1'] = $this->Fleets->getFlotas();
			$getFlotas['2'] = $this->FleetsAtm->getFlotasAtm();
			$getFlotas['3'] = $this->FleetsTei->getFlotasTei();
			$listFlotas['1'] = $this->Flotas->find('list',array('fields'=>array('id_flota','nombre')));
			$listFlotas['2'] = $this->FlotasAtm->find('list',array('fields'=>array('id_flota','nombre')));
			$listFlotas['3'] = $this->FlotasTei->find('list',array('fields'=>array('id_flota','nombre')));
			$TipoOperacion['1'] = $this->TipoOperacion->find('list',array('fields'=>array('id_tipo_operacion','tipo_operacion')));
			$getAreas = $this->areas();
			$TipoOperacion['2'] = $this->TipoOperacionAtm->find('list',array('fields'=>array('id_tipo_operacion','tipo_operacion')));
			$TipoOperacion['3'] = $this->TipoOperacionTei->find('list',array('fields'=>array('id_tipo_operacion','tipo_operacion')));

			$flotas = $getFlotas[$id_empresa];
			foreach($flotas as $id_fleets => $fleetsData){
			  foreach($fleetsData['Flotas'.$this->Empresas()] as $fleetsContent){
				$flotasDesc[$getAreas[$fleetsData['Fleets'.$this->Empresas()]['id_area']]][$fleetsContent['id_flota']] = str_replace('Cd. Juarez','Ciudad Juarez',trim(ucwords(strtolower($fleetsContent['nombre']))));
			  }
			}
		
				
		$getShell = $Shell['Toneladas']['Warnings']['report_day_check_toneladas']; // Fix for compability
// 		$getShell = $Shell['kms']['count']['count_day_merge']; // Fix for compability
// 		  pr($Shell['ingresos']);
// // 		pr($Shell['kms']['report_day_full']);
		$this->set('warning',$getShell);
		$this->set('tipoOperacion',$TipoOperacion);
		$this->set('flotas',$flotasDesc);
$time2 = microtime(true);
echo "script execution time: ".($time2-$time1); //value in seconds
// 		exit();
// 		$_SESSION['projections']['toneladas'] = $getShell['DailyReport']['report_day'];
// 		if(!isset($_SESSION['projections']['toneladas'])){
// 			App::Import('Shell', 'Shell');
// 			App::Import('Vendor',array('shells/sniffer_data'));
// 			$myShell = new SnifferDataShell(new Object());
// 			$myShell->initialize();
// 		// 	Select the method to call
// 			$Shell = $myShell->main($view=true,$debug=false);
// 			$_SESSION['projections']['toneladas'] = $Shell['Toneladas']['DailyReport']['report_day'];
// 		}
// 		pr($_SESSION['projections']['toneladas']);
// 		pr($getShell['DailyReport']['report_day']);exit();
// 			
// 			App::Import('Shell', 'Shell');
// 			App::Import('Vendor',array('shells/operaciones'));
// 			$myShell = new OperacionesShell(new Object());
// 			$myShell->initialize();
// 			$toneladas = $myShell->main();
// 			pr($toneladas);
	  }
	  
      function debugViajes(){
	  $time1 = microtime(true);
		App::Import('Shell', 'Shell');
		App::Import('Vendor',array('shells/sniffer_data'));
		$myShell = new SnifferDataShell(new Object());
		$myShell->initialize();

		$Shell = $myShell->detail($debug=null,$_SESSION['Auth']['User']['year']);
		$id_empresa = $_SESSION['Auth']['User']['id_empresa'];
			$getFlotas['1'] = $this->Fleets->getFlotas();
			$getFlotas['2'] = $this->FleetsAtm->getFlotasAtm();
			$getFlotas['3'] = $this->FleetsTei->getFlotasTei();
			$listFlotas['1'] = $this->Flotas->find('list',array('fields'=>array('id_flota','nombre')));
			$listFlotas['2'] = $this->FlotasAtm->find('list',array('fields'=>array('id_flota','nombre')));
			$listFlotas['3'] = $this->FlotasTei->find('list',array('fields'=>array('id_flota','nombre')));
			$TipoOperacion['1'] = $this->TipoOperacion->find('list',array('fields'=>array('id_tipo_operacion','tipo_operacion')));
			$getAreas = $this->areas();
			$TipoOperacion['2'] = $this->TipoOperacionAtm->find('list',array('fields'=>array('id_tipo_operacion','tipo_operacion')));
			$TipoOperacion['3'] = $this->TipoOperacionTei->find('list',array('fields'=>array('id_tipo_operacion','tipo_operacion')));

			$flotas = $getFlotas[$id_empresa];
			foreach($flotas as $id_fleets => $fleetsData){
			  foreach($fleetsData['Flotas'.$this->Empresas()] as $fleetsContent){
				$flotasDesc[$getAreas[$fleetsData['Fleets'.$this->Empresas()]['id_area']]][$fleetsContent['id_flota']] = str_replace('Cd. Juarez','Ciudad Juarez',trim(ucwords(strtolower($fleetsContent['nombre']))));
			  }
			}
		
// 		$getShell = $Shell['Toneladas']['Warnings']['report_day_check_toneladas']; // Fix for compability
		$getShell = $Shell['kms']['count']['count_day_merge']; // Fix for compability
// 		  pr($getShell);
// 		  exit();
// // 		pr($Shell['kms']['report_day_full']);
		$this->set('warning',$getShell);
		$this->set('tipoOperacion',$TipoOperacion);
		$this->set('flotas',$flotasDesc);
	  $time2 = microtime(true);
	  echo "script execution time: ".($time2-$time1); //value in seconds
	  }

	  function daysToWork($year=null,$month=null,$saturday=null){

// 		  $year=date('Y');
// 		  $year='2016';
// 		  configure::write('debug',2);
		  
// 		  $debug = true;
		  isset($debug) ? $dataDebug=true : $dataDebug = false;

		  if(isset($debug)) {
			e('<table><tr><td><H4><pre>The Year and month used for calculations => </pre></H4></td><td><H3 style="color:#4C8A9F;">'.$year.'</H3></td><td><h3>=></h3></td><td><H3 style="color:#4C8A9F;">'.$month.'</H3></td></tr></table>');
		  }

		  $lastDay = date('t',mktime('0','0','0',$month,'01',$year));

		  if(isset($debug)) {
			var_dump($lastDay);
		  }

		  $startDate = date('Y-m-d',mktime('0','0','0',$month,'01',$year)); // for CurrentMonth
		  $endDate = date('Y-m-d',mktime('0','0','0',$month,$lastDay,$year)); // for CurrentMonth

		  $muons = $this->tachion(/*$debug=*/false,$year,/*$session=*/false);

		  if(isset($debug)) {
			var_dump($muons);
			var_dump($startDate);
			var_dump($endDate);
		  }
		  App::import('Controller', 'Holiday');
		  $Holiday = new HolidayController;
		  $Holiday->constructClasses();

		  $view = $Holiday->RetrieveHolidays($startDate,$endDate,$dataDebug,$year);
		  
		  if(isset($debug)) {
			pr($view);
		  }
		  $MexicanoHolidays = $Holiday->GetNationalMexicanHolidays($year);
// 			pr($MexicanoHolidays);
		  $workingDays = $Holiday->GetWorkingDays($startDate,$endDate,$MexicanoHolidays,$dataDebug,$return=true,$saturday);
		  if(isset($debug)) {
			pr($workingDays);
			exit();
		  }
		  return $workingDays;
	  }

      function Test($startDate = null,$endDate = null ,$debug = false,$year = null){
		$time1 = microtime(true);
	// 	  Another aproach
// 		  $debug=true;
// 		  pr($_SESSION['projections']['workingDays']);
		  App::import('Controller', 'Holiday');
		  $Holiday = new HolidayController;
		  $Holiday->constructClasses();

		  $year['1']=(date('Y')-1);
		  $year['2']=date('Y');
		  $year['3']=(date('Y')+1);
		  
		  if(is_array($year)){
			  foreach($year as $key => $data){
				$muons = $this->tachion(/*$debug=*/false,(int)$data,/*$session=*/false);
				e('<h2 style="color:#4C8A9F;">'.$data.'</h2>');
				pr($muons);
				$GoWork = $Holiday->RetrieveHolidays($startDate=$data.'-01-01',$endDate=$data.'-12-31',$debug=true,$year=$data);
				pr($GoWork);
			  }
		  }else{
			  $startDate = $year.'-01-01';
			  $endDate = date('Y-m-d');
		// 	  get year from post and build the date
		// 	  pehaps one foreach year and build the array passtough other functions
			  $view = $Holiday->RetrieveHolidays($startDate,$endDate,$debug=false,$year);
			  pr($view);
	// 	  pr($Holiday->RetrieveHolidays($startDate,$endDate,$debug=false,$year););
		  }

		  $startDate = date('Y-m-d',mktime('0','0','0',date('n'),'01',date('Y'))); // for CurrentMonth
		  $endDate = date('Y-m-d',mktime('0','0','0',date('n'),date('t'),date('Y'))); // for CurrentMonth
		  $GoToWork = $Holiday->RetrieveHolidays($startDate/*='2014-01-01'*/,$endDate/*='2014-12-31'*/,$debug=false,$year=date('Y'));

		  pr($GoToWork);
// 		  pr($this->operations());
		$time2 = microtime(true);
		echo "script execution time: ".($time2-$time1); //value in seconds
	  exit();
      } // End test


	  function buildVars(){
// $time1 = microtime(true);
		  App::Import('Shell', 'Shell');
		  App::Import('Vendor',array('shells/sniffer_data'));
		  $myShell = new SnifferDataShell(new Object());
		  $myShell->initialize();
		  // 	Select the method to call
		  $_append = $myShell->Empresas();
		  $areas = $myShell->areas();
// $time2 = microtime(true);
// echo "script execution time: ".($time2-$time1); //value in seconds
// 		  exit();
	  //  ALERT this can change having the table.db
	  /** ALERT  => TODO rebuild the structure according to the new approach
		  @param => This is going inside of _append loop to buid fraction for each Empresa
	  **/
		  $TpoOp = explode(',',$filter['flota']=null); // this select which is calculating ALERT @param => Expecting
		  if(!isset($year)){
			$year = date('Y');
		  }
// 		  $months = $myShell->months($return=true,$set=false,$year=date('Y'));
		if(!isset($_SESSION['projections']['months'])){
		  $_SESSION['projections']['months'] = $this->months($return=true,$set=false,$year=date('Y'));
		}
		$months = $_SESSION['projections']['months'];
// 		  $fraction = $myShell->Fraccion->find('list',array('fields'=>array('id','fraccion')));
// 		  if(!isset($_SESSION['projections']['fraction'])){
// 			$_SESSION['projections']['fraction'] = $this->Fraccion->find('list',array('fields'=>array('id','fraccion')));
// 		  }$fraction = $_SESSION['projections']['fraction'];
		  
		  $fraction = $this->getFraction(null);
		  
		  foreach($areas as $key => $data){
			  for($i=1;$i<=date('n');$i++){
				foreach($data as $idx => $content){
// 				  $toneladas[$key][trim($content)][date('M',mktime('0','0','0',$i,'01',$year))] = null ;
// 				  $kms[$key][trim($content)][date('M',mktime('0','0','0',$i,'01',$year))] = null ;
// 				  $ingresos[$key][trim($content)][date('M',mktime('0','0','0',$i,'01',$year))] = null ;
				  $structure[$key][trim($content)][date('M',mktime('0','0','0',$i,'01',$year))] = null ;
				  foreach($fraction as $h => $d ){
// 					$toneladas[$key][trim($content)][date('M',mktime('0','0','0',$i,'01',$year))][$d] = null;
// 					$kms[$key][trim($content)][date('M',mktime('0','0','0',$i,'01',$year))][$d] = null;
// 					$ingresos[$key][trim($content)][date('M',mktime('0','0','0',$i,'01',$year))][$d] = null;
					$structure[$key][trim($content)][date('M',mktime('0','0','0',$i,'01',$year))][$d] = null;
					$TotalByFraction[$key][trim($content)][$d] = null; // pending ...
				  }
				}
			  }
		  } // End of each area
		  return $structure;
	  }//End buildVars

	  function tachion($debug=null,$year=null,$session=null){
// 		$debug = true;
		if($debug){
			$time1 = microtime(true);
		}
		if(empty($year)){
		$year = date('Y');
		}
		/** TODO make the calculation if no $_SESSION['Projections']['workingDays']
			This means tha you starting the program
		*/
		App::import('Controller', 'Holiday');
		$Holiday = new HolidayController;
		$Holiday->constructClasses();
		$_SESSION['projections']['months'] = $this->months($return=true,$set=false,$year);
		$months = $_SESSION['projections']['months'];

			foreach($months as $numMonth => $monthValue){
				$startDate = date('Y-m-d',mktime('0','0','0',$months[$numMonth]['numeric'],'01',$year));
				$endDate = date('Y-m-d',mktime('0','0','0',$months[$numMonth]['numeric'],$months[$numMonth]['days'],$year));
				$workingDays[$months[$numMonth]['short']] = $Holiday->RetrieveHolidays($startDate,$endDate,$debug,$year);
			}
			
		if($debug){
			pr($workingDays);
			$time2 = microtime(true);
			echo "script execution time: ".($time2-$time1); //value in seconds
		}

		if($session === true){
			if(!isset($_SESSION['Projections']['workingDays'])){
				$_SESSION['projections']['workingDays'] = $workingDays;
			}elseif(isset($_SESSION['Projections']['workingDays'])){
				$workingDays = $_SESSION['projections']['workingDays'];
			}
			return $workingDays;
		}else{
			return $workingDays;
		}

	  }//End tachion();

	  function workingDays($debug=null,$year=null,$month=null,$session=null){
// 		  $debug = true;
// 		  $month='02';
		  if(empty($year)) {
			$year = date('Y');
		  } if(empty($month)) {
			$month = date('m');
		  }
		  if((int)$month === (int)date('m')) {
			$currentDay = date('d');
		  } else {
			//the Current day must be the last day of the given month
			$currentDay = date('t',mktime('0','0','0',$month,'01',$year));
		  }
		  $monthIdx = date('M',mktime('0','0','0',$month,'01',$year));
		  App::import('Controller', 'Holiday');
		  $Holiday = new HolidayController;
		  $Holiday->constructClasses();

// 		  $workingDays['currentWorkDays'] = $Holiday->RetrieveHolidays($startDate=date('Y-m-d',mktime('0','0','0',date('m'),'01',date('Y'))),$endDate=date('Y-m-d'),$debug,date('Y'));
// 		  $workingDays['totalCurrentWorkingDays'] = $_SESSION['projections']['workingDays'][date('M')];

		  $workingDays['currentWorkDays'] = $Holiday->RetrieveHolidays($startDate=date('Y-m-d',mktime('0','0','0',$month,'01',$year)),$endDate=date('Y-m-d',mktime('0','0','0',$month,$currentDay,$year)),$debug,$year);
		  /** TODO this must come from tachion */ /** NOTE  add fix with tachion */
		  if(!empty($session)) {
			$workingDays['totalCurrentWorkingDays'] = $this->tachion(false,$year,true)[$monthIdx];
		  } else {
			$workingDays['totalCurrentWorkingDays'] = $_SESSION['projections']['workingDays'][$monthIdx];
		  }
		
			  if($debug){
				echo '<pre>Start Current Working Days</pre>';
				  pr($workingDays);
				echo '<pre>End Current Working Days</pre>';
				echo '<pre>Start Current Total Working Days</pre>';
				  pr($_SESSION['projections']['workingDays'][date('M')]);
				echo '<pre>End Current Total Working Days</pre>';
			  }
			$_SESSION['projections']['currentProjectionsWorkingDays'] = $workingDays;
// 			$this->presupuesto();
		  return $workingDays;
// 		  exit();
	  }

      function getOperationsData($id_empresa=null,$startDate = null,$endDate = null ,$debug = null,$year = null){

		// 	  Another aproach
// 		if($debug){
// 			$time1 = microtime(true);
// 		}
		if(empty($year)){
		  $year=date('Y');
		}
// 		pr($id_empresa);
		if(empty($id_empresa)){
		  $id_empresa=$_SESSION['Auth']['User']['id_empresa'];
		}
		$structure = $this->buildVars();
// 		pr($structure);
// 		  App::import('Controller', 'Holiday');
// 		  $Holiday = new HolidayController;
// 		  $Holiday->constructClasses();
		  if(!isset($_SESSION['projections']['workingDays'])){
			$workingDays = $this->tachion();
		  }else{
			$workingDays = $_SESSION['projections']['workingDays'];
		  }
// 		  App::Import('Shell', 'Shell');
// 		  App::Import('Vendor',array('shells/operaciones'));
// 		  $myShell = new OperacionesShell(new Object());
// 		  $myShell->initialize();
// 		  $tipoOperacion = $myShell->dbOp();
		  $tipoOperacion = array('1'=>'Toneladas','2'=>'kms','3'=>'ingresos','4'=>'Viajes');
// 		  $tipoOperacionDesc = array_map('strtolower',$tipoOperacion));
		  $tipoOperacionDesc = array('1'=>'toneladas','2'=>'kilometros','3'=>'ingresos','4'=>'viajes');
			$months = $this->months($return=true,$set=false,$year);
// 		  if(!isset($_SESSION['projections']['months'])){
// 			$_SESSION['projections']['months'] = $this->months($return=true,$set=false,$year=date('Y'));
// 		  }
// 		  $months = $_SESSION['projections']['months'];
// 		  $fraction = $myShell->Fraccion->find('list',array('fields'=>array('id','fraccion')));
// 		  if(!isset($_SESSION['projections']['fraction'])){
// 			$_SESSION['projections']['fraction'] = $this->Fraccion->find('list',array('fields'=>array('id','fraccion')));
// 		  }
// 		  $fraction = $_SESSION['projections']['fraction'];

// 			foreach($months as $numMonth => $monthValue){
// 				$startDate = date('Y-m-d',mktime('0','0','0',$months[$numMonth]['numeric'],'01',$year));
// 				$endDate = date('Y-m-d',mktime('0','0','0',$months[$numMonth]['numeric'],$months[$numMonth]['days'],$year));
// 				$workingDays[$months[$numMonth]['short']] = $Holiday->RetrieveHolidays($startDate,$endDate,$debug=false,$year);
// 			}
// 			$_SESSION['projections']['workingDays'] = $workingDays;
// 			$fraction = $this->Fraccion->find('list',array('fields'=>array('id','fraccion')));
		  $fraction = $this->getFraction(null);
		  
			$areas = $this->areas();
			unset($areas[0]);
			$operationDetail = null;
			$OperacionMensual = null;
			$OperacionesMensuales = $operacionesDiarias = $structure;
			if($debug){
			  pr($operacionesDiarias);
			}
			foreach($tipoOperacion as $id_operacion => $operacionName){
				$conditions['Operacion.id_empresa'] = $id_empresa;
				$conditions['Operacion.year'] = $year;
				$conditions['Operacion.tipoOperacion'] = $id_operacion; // toneladas ,kilometros,ingresos,Viajes
				foreach($months as $numMonth => $monthValue){
					foreach($areas as $id_area => $areaName){
						/** WARNING => NOTE for better performance must change this to take from db config */
						if($id_operacion === 1){
							$fraction = $this->getFraction('Active'); // when Toneladas
						}else{
							$fraction = $this->getFraction(null); // anything else
						}
						/** WARNING => NOTE for better performance must change this to take from db config */
					  foreach($fraction as $id_fraccion => $fraccionName){
						$conditions['Operacion.area'] = $areaName;
						$conditions['Operacion.numMes'] = $monthValue['numeric'];
						$conditions['Operacion.id_fraction'] = $id_fraccion;
						$operacion = $this->Operacion->find('all',array('conditions'=>$conditions));
						if(isset($operacion)){
						  foreach($operacion as $idx_operacion => $Operaciones){
							foreach($Operaciones as $OperacionData){
							  foreach($OperacionData as $DescOperacionData => $dataOperacionData){
								$operacionesDiarias[$OperacionData['id_empresa']][$OperacionData['area']][$OperacionData['month']][$OperacionData['fraccion']][$OperacionData['day']] = $OperacionData['operacion'];
							  }
							}
						  }
						}
					  }
					}
				} // End foreach month()
				if(in_array($tipoOperacionDesc[$id_operacion],$tipoOperacionDesc) == true){
				  $op = strtolower($tipoOperacionDesc[$id_operacion]); //Just to be sure 
				  $operationDetail[$op.'Daily'] = $operacionesDiarias;
				}
				$conditionsMensual['OperacionMensual.id_empresa'] = $id_empresa;
				$conditionsMensual['OperacionMensual.year'] = $year;
				$conditionsMensual['OperacionMensual.tipoOperacion'] = $id_operacion;
				//Reset all var defore use it
				$TotalByFractionAnualOp = $TotalFractionAnnOp = $totalOpMensuales = $totalOperacionMensual = null;
				$TotalOpAreaAnnual = $OperacionMensual = $totalYearlyByArea = null;
				foreach($months as $numMonth => $monthValue){
					foreach($areas as $id_area => $areaName){
					  foreach($fraction as $id_fraccion => $fraccionName){
						$conditionsMensual['OperacionMensual.area'] = $areaName;
						$conditionsMensual['OperacionMensual.id_fraction'] = $id_fraccion;
						$operacionMensual = $this->OperacionMensual->find('all',array('conditions'=>$conditionsMensual));
						if(isset($operacionMensual)){
						  foreach($operacionMensual as $idx_operacionMensual => $OperacionMensual){
							foreach($OperacionMensual as $OperacionDataMensual){
							  foreach($OperacionDataMensual as $DescOperacionDataMensual => $dataOperacionDataMensual){
								$OperacionesMensuales[$OperacionDataMensual['id_empresa']][$OperacionDataMensual['area']][$OperacionDataMensual['month']][$OperacionDataMensual['fraccion']] = $OperacionDataMensual['operacion'];
							  }
							}
						  }
						}
					  }
					}
				}
				if(in_array($tipoOperacionDesc[$id_operacion],$tipoOperacionDesc) == true){
				  $opMensual = strtolower($tipoOperacionDesc[$id_operacion]); //Just to be sure 
				  $operationDetail[$opMensual.'Mensuales'] = $OperacionesMensuales;
				  foreach($operationDetail[$opMensual.'Mensuales'] as $id_op_empresa => $operationsMensualesArea){
					foreach($operationsMensualesArea as $areaOpName => $monthOp){
					  foreach($monthOp as $monthOpName => $fractionsOp){
						if(!isset($totalOpMensuales[$id_op_empresa][$areaOpName][$monthOpName])){
						  $totalOpMensuales[$id_op_empresa][$areaOpName][$monthOpName] = null;
						}
						$totalOpMensuales[$id_op_empresa][$areaOpName][$monthOpName] = array_sum($fractionsOp);
						if(!isset($totalOperacionMensual[$id_op_empresa][$monthOpName])){
						  $totalOperacionMensual[$id_op_empresa][$monthOpName] = null;
						}
						$totalOperacionMensual[$id_op_empresa][$monthOpName] += array_sum($fractionsOp);
						foreach($fractionsOp as $fraccion_name_op => $totalByFractionOp){
						  if(!isset($TotalByFractionAnualOp[$id_op_empresa][$areaOpName][$fraccion_name_op])){
							$TotalByFractionAnualOp[$id_op_empresa][$areaOpName][$fraccion_name_op] = null;
						  }
						  $TotalByFractionAnualOp[$id_op_empresa][$areaOpName][$fraccion_name_op] += $fractionsOp[$fraccion_name_op];
						  if(!isset($TotalFractionAnnOp[$id_op_empresa][$monthOpName][$fraccion_name_op])){
							$TotalFractionAnnOp[$id_op_empresa][$monthOpName][$fraccion_name_op] = null;
						  }
						  $TotalFractionAnnOp[$id_op_empresa][$monthOpName][$fraccion_name_op] += $fractionsOp[$fraccion_name_op];
						  if(!isset($TotalOpAreaAnnual[$id_op_empresa][$fraccion_name_op])){
							$TotalOpAreaAnnual[$id_op_empresa][$fraccion_name_op] = null;
						  }
						  $TotalOpAreaAnnual[$id_op_empresa][$fraccion_name_op] += $fractionsOp[$fraccion_name_op];
						}
					  }
					}
				  }
				  $operationDetail['total'.ucfirst($opMensual).'ByFractionAnual'] = $TotalByFractionAnualOp;
				  $operationDetail['Total'.ucfirst($opMensual).'MensualesByFraction'] = $TotalFractionAnnOp;
				  $operationDetail['total'.ucfirst($opMensual).'Mensuales'] = $totalOpMensuales;//
				  $operationDetail['total'.ucfirst($opMensual).'OperacionMensual'] = $totalOperacionMensual;
				  $operationDetail['total'.ucfirst($opMensual).'AreaAnual'] = $TotalOpAreaAnnual;
				}
				  foreach($totalOpMensuales as $idX_empresa => $areaTotals){
					foreach($areaTotals as $areaOpName => $monthOp){
					  foreach($monthOp as $dataOps){
						if(!isset($totalYearlyByArea[$idX_empresa][$areaOpName])){
						  $totalYearlyByArea[$idX_empresa][$areaOpName] = null;
						}
						$totalYearlyByArea[$idX_empresa][$areaOpName] += $dataOps;
					  }
					}
				  }
				  $operationDetail['total'.ucfirst($opMensual).'YearlyByArea'] = $totalYearlyByArea ;
			} // end foreach TipoOperacion
			$_SESSION['projections']['operacion'] = $operationDetail;
			return $operationDetail;
// 		if($debug){
// 		  //script code
// 		  $time2 = microtime(true);
// 		  echo "script execution time: ".($time2-$time1); //value in seconds
// 		}
      } // End getOperationsData()

//       function getoperations(){
// 		  $time1 = microtime(true);
// 			  if(!isset($_SESSION['projections']['operacion'])){
// 				$this->operations();
// 			  }
// 				$operations = $_SESSION['projections']['operacion'];
// // 				pr($operations);exit();
// // 			  $operations = $this->getOperationsData(false,false,true);
// // // 			pr($operations);
// 			pr($this->getOperationsData(false,false,true)['totalToneladasYearlyByArea'][$_SESSION['Auth']['User']['id_empresa']]);
// 			
// 		  $time2 = microtime(true);
// 		  echo "script execution time: ".($time2-$time1); //value in seconds
// 		  exit();
// 	  }
	  
      function operations($id_empresa=null,$year=null){
// 		  $time1 = microtime(true);
		  if(empty($year)){
			$year=date('Y');
		  }
			  if(!isset($_SESSION['projections']['operacion'])){
				$this->getOperationsData($id_empresa,null,null,null,$year);
			  }
			$operations = $_SESSION['projections']['operacion'];
// 			pr($operations);exit();
			return $operations;
// 		  $time2 = microtime(true);
// 		  echo "script execution time: ".($time2-$time1); //value in seconds
// 		  exit();
	  }
      
      function DailyReport($concepto=null,$area=null,$mes=null,$flota=null,$fraccion=null,$year=null){

// 	for switch between method in the shell only change the object->method call example $myShell->months();
// 	grab the vars
		$filter['get_area'] = $area;
		$filter['get_mes'] = $mes;
		$filter['concepto']=$concepto;
		if(!isset($_SESSION['projections']['months'])){
		  $_SESSION['projections']['months'] = $this->months($return=true,$set=false,$year=date('Y'));
		}
		$months = $_SESSION['projections']['months'];
// 		  $fraction = $myShell->Fraccion->find('list',array('fields'=>array('id','fraccion')));
		  if(!isset($_SESSION['projections']['fraction'])){
			$_SESSION['projections']['fraction'] = $this->Fraccion->find('list',array('fields'=>array('id','fraccion')));
		  }$fraction = $_SESSION['projections']['fraction'];
// 		  pr($fraction);
			$id_empresa = $_SESSION['Auth']['User']['id_empresa'];
// 			$months = $this->months(true,false,$year);
	// 	import the shell that calculates->toneladas and main method
// 		App::Import('Shell', 'Shell');
// 		App::Import('Vendor',array('shells/sniffer_data'));
// 		$myShell = new SnifferDataShell(new Object());
// 		$myShell->initialize();
// 	// 	Select the method to call
// 		$Shell = $myShell->main($view=true,$debug=false);
// 	// 	pr($Shell);exit();
// 		$getShell = $Shell['Toneladas']; // Fix for compability
// 	// 	pr($getShell);exit();
// 		$kms = $Shell['kms'];
// 	// 	pr($kms);exit();
// 		$ingresos = $Shell['ingresos'];
// 	// 	pr($ingresos);exit();
		$ingresos = null;
// 		pr($concepto);
		
		App::Import('Shell', 'Shell');
		App::Import('Vendor',array('shells/calendar'));
		$myCalendar = new CalendarShell(new Object());
		$myCalendar->initialize();

		$calendar = $myCalendar->main($year=date('Y'),false);
		$ical = $myCalendar->DaysInMonth($year); //Get the days in CurrentMonth from specific method in CalendarShell

		if(!isset($_SESSION['projections']['operacion'])){
		  $this->operations();
		}
		
	if(isset($area)){ // comes from detail.ctp view for toneladas
	    if($area == '0'){ // for all areas

	      $Calendar = $calendar['days'][$mes];
	      $cal_viajes = $cal_ingresos = $cal_kms = $cal_tons = $Calendar;
// 		$DailyReport = $getShell['DailyReport']['report_day'][$id_empresa];// Set All areas for Toneladas
		$DailyReport = $_SESSION['projections']['operacion']['toneladasDaily'][$id_empresa];
		foreach($DailyReport as $area_name => $month){
		  foreach($month as $month_name => $fraccion_){
		   if(!empty($fraccion_)){
		    foreach($fraccion_ as $fraccion_name => $day){
		      if(!empty($day)){
		      foreach($day as $day_num => $DailyTons){
		      	if(!isset($days_all_tons[$month_name][$fraccion_name][$day_num])){
			  $days_all_tons[$month_name][$fraccion_name][$day_num] = null;
			}
			  $days_all_tons[$month_name][$fraccion_name][$day_num] += $DailyTons;
		      }
		     }
		    }
		  }
		}
	      } // Then build the calendar

		    foreach($Calendar as $day => $details){
			foreach($fraction as $id_fraction => $fraction_desc){
			    if(isset($days_all_tons[$mes][$fraction_desc])){
			      foreach($days_all_tons[$mes][$fraction_desc] as $day => $tonsValue){
				if(isset($days_all_tons[$mes][$fraction_desc][$day])){
				    $cal_tons[$day][$fraction_desc] = $tonsValue;
				    $_fraccion['toneladas'][$id_fraction] = $fraction_desc;
				}
			      }
			    }
			}
		    }
		$cal = $cal_tons;

		// Set All areas for Kilometros
// 		$DailyReportKms = $kms['report_daily'][$id_empresa];
		$DailyReportKms = $_SESSION['projections']['operacion']['kilometrosDaily'][$id_empresa];
		foreach($DailyReportKms as $area_name => $month){
		  foreach($month as $month_name => $fraccion_){
		   if(!empty($fraccion_)){
		    foreach($fraccion_ as $fraccion_name => $day){
		      if(!empty($day)){
		      foreach($day as $day_num => $DailyKms){
// 			if($days_all_kms[$month_name][$fraccion_name][$day_num] == 0){
// 			  unset($days_all_kms[$month_name][$fraccion_name][$day_num]);
// 			}
		      	if(!isset($days_all_kms[$month_name][$fraccion_name][$day_num])){
			  $days_all_kms[$month_name][$fraccion_name][$day_num] = null;
			}
			  $days_all_kms[$month_name][$fraccion_name][$day_num] += $DailyKms;
		      }
		     }
		    }
		  }
		}
	      } // Then build the calendar
	      
		    foreach($Calendar as $day => $details){
			foreach($fraction as $id_fraction => $fraction_desc){
			    if(isset($days_all_kms[$mes][$fraction_desc])){
			      foreach($days_all_kms[$mes][$fraction_desc] as $day => $kmsValue){
				if(isset($days_all_kms[$mes][$fraction_desc][$day])){
				    $cal_kms[$day][$fraction_desc] = $kmsValue;
				    $_fraccion['kilometros'][$id_fraction] = $fraction_desc;
				}
			      }
			    }
			}
		    }
		    $kms_days = $cal_kms;
		
// 		$DailyReportIngresos = $ingresos['report_daily'][$id_empresa];
		$DailyReportIngresos = $_SESSION['projections']['operacion']['ingresosDaily'][$id_empresa];
		foreach($DailyReportIngresos as $area_name => $month){
		  foreach($month as $month_name => $fraccion_){
		   if(!empty($fraccion_)){
		    foreach($fraccion_ as $fraccion_name => $day){
		      if(!empty($day)){
		      foreach($day as $day_num => $DailyIngresos){
		      	if(!isset($days_all_ingresos[$month_name][$fraccion_name][$day_num])){
			  $days_all_ingresos[$month_name][$fraccion_name][$day_num] = null;
			}
			  $days_all_ingresos[$month_name][$fraccion_name][$day_num] += $DailyIngresos;
		      }
		     }
		    }
		  }
		}
	      } // Then build the calendar
	      
		    foreach($Calendar as $day => $details){
			foreach($fraction as $id_fraction => $fraction_desc){
			    if(isset($days_all_ingresos[$mes][$fraction_desc])){
			      foreach($days_all_ingresos[$mes][$fraction_desc] as $day => $ingresosValue){
				if(isset($days_all_ingresos[$mes][$fraction_desc][$day])){
				    $cal_ingresos[$day][$fraction_desc] = $ingresosValue;
				    $_fraccion['ingresos'][$id_fraction] = $fraction_desc;
				}
			      }
			    }
			}
		    }
		    
		    $ingresos_days = $cal_ingresos;
// // // // // // // // // // // // // // // // // // // // // // // // // // // // // 
		// Set All areas for Kilometros
// 		$DailyReportKms = $kms['report_daily'][$id_empresa];
		$DailyReportViajes = $_SESSION['projections']['operacion']['viajesDaily'][$id_empresa];
		foreach($DailyReportViajes as $area_name => $month){
		  foreach($month as $month_name => $fraccion_){
		   if(!empty($fraccion_)){
		    foreach($fraccion_ as $fraccion_name => $day){
		      if(!empty($day)){
		      foreach($day as $day_num => $DailyViajes){
// 			if($days_all_kms[$month_name][$fraccion_name][$day_num] == 0){
// 			  unset($days_all_kms[$month_name][$fraccion_name][$day_num]);
// 			}
		      	if(!isset($days_all_viajes[$month_name][$fraccion_name][$day_num])){
			  $days_all_viajes[$month_name][$fraccion_name][$day_num] = null;
			}
			  $days_all_viajes[$month_name][$fraccion_name][$day_num] += $DailyViajes;
		      }
		     }
		    }
		  }
		}
	      } // Then build the calendar
	      
		    foreach($Calendar as $day => $details){
			  foreach($fraction as $id_fraction => $fraction_desc){
				  if(isset($days_all_viajes[$mes][$fraction_desc])){
					foreach($days_all_viajes[$mes][$fraction_desc] as $day => $viajesValue){
					  if(isset($days_all_viajes[$mes][$fraction_desc][$day])){
						  $cal_viajes[$day][$fraction_desc] = $viajesValue;
						  $_fraccion['viajes'][$id_fraction] = $fraction_desc;
					  }
					}
				  }
			  }
		    }
		    $viajes_days = $cal_viajes;
// // // // // // // // // // // // // // // // // // // // // // // // // // // //
	    }else{
// 		Toneladas <---- bug 
		$DailyReport = $_SESSION['projections']['operacion']['toneladasDaily'][$id_empresa][$this->areas()[$area]][$mes];
		$Calendar = $calendar['days'][$mes]; // Get only the selected month come from detail.ctp
		$viajes_days = $ingresos_days = $kms_days = $cal = $Calendar; //create the array that's containt the toneladas data
		    foreach($Calendar as $day => $details){
			foreach($fraction as $id_fraction => $fraction_desc){
			    if(isset($DailyReport[$fraction_desc])){
				if(isset($DailyReport[$fraction_desc][$day])){
				    $cal[$day][$fraction_desc] = $DailyReport[$fraction_desc][$day];
				    $_fraccion['toneladas'][$id_fraction] = $fraction_desc;
				}
			    }
			}
		    }
// 		Kilometros  <----
		$DailyReportKms = $_SESSION['projections']['operacion']['kilometrosDaily'][$id_empresa][$this->areas()[$area]][$mes];
		    foreach($Calendar as $day => $details){
			foreach($fraction as $id_fraction => $fraction_desc){
			    if(isset($DailyReportKms[$fraction_desc])){
				if(isset($DailyReportKms[$fraction_desc][$day])){
				    $kms_days[$day][$fraction_desc] = $DailyReportKms[$fraction_desc][$day];
				    $_fraccion['kilometros'][$id_fraction] = $fraction_desc;
				}
			    }
			}
		    }

// 		Ingresos  <----
		$DailyReportIngresos = $_SESSION['projections']['operacion']['ingresosDaily'][$id_empresa][$this->areas()[$area]][$mes];
		    foreach($Calendar as $day => $details){
			foreach($fraction as $id_fraction => $fraction_desc){
			    if(isset($DailyReportIngresos[$fraction_desc])){
				if(isset($DailyReportIngresos[$fraction_desc][$day])){
				    $ingresos_days[$day][$fraction_desc] = $DailyReportIngresos[$fraction_desc][$day];
				    $_fraccion['ingresos'][$id_fraction] = $fraction_desc;
				}
			    }
			}
		    }
		    
// 		Viajes  <----
		$DailyReportViajes = $_SESSION['projections']['operacion']['viajesDaily'][$id_empresa][$this->areas()[$area]][$mes];
		  foreach($Calendar as $day => $details){
			foreach($fraction as $id_fraction => $fraction_desc){
				if(isset($DailyReportViajes[$fraction_desc])){
				  if(isset($DailyReportViajes[$fraction_desc][$day])){
					  $viajes_days[$day][$fraction_desc] = $DailyReportViajes[$fraction_desc][$day];
					  $_fraccion['viajes'][$id_fraction] = $fraction_desc;
				  }
				}
			}
		  }
		
	    }
	}
// 	pr($ingresos_days);exit();


		    
	foreach($months as $num => $data){
	    if(in_array($mes,$data)){
	      $mes = $data['spanish'];
		  $id_mes = $data['num'];
// 		  pr($data);
	    }
	}

	if(isset($cal)){
	    $filter['toneladas'] = $cal; // set the Toneladas bug => compability
	}if(isset($kms_days)){
	    $filter['kilometros'] = $kms_days; // Set kilometros daily;
	}if(isset($ingresos_days)){
	    $filter['ingresos'] = $ingresos_days;
	}if(isset($viajes_days)){
		$filter['viajes'] = $viajes_days;
	}
	
	$conceptos = array('1'=>'Toneladas','2'=>'Kilometros','3'=>'Ingresos','4'=>'Viajes');

	if($_SESSION['Auth']['User']['level'] === '7'){ // Means Normal User and can't see the $$
		  unset($conceptos['3']);
	}

	if(dropTabs( $_SESSION['Auth']['User']['email'], null, null ) != null){
	  $viewConfig = dropTabs($_SESSION['Auth']['User']['email'],null,null);
	  foreach($viewConfig as $dropConcept => $set){
		if((isset($viewConfig[$dropConcept]) and $viewConfig[$dropConcept] === true)){
		  $searchConcepto = explode('drop',$dropConcept)['1'];
		  if($keyToDrop = array_search($searchConcepto,$conceptos)){
			unset($conceptos[$keyToDrop]);
		  }
		}
	  }
	}

	/** WARNING work from hir
	$filter['kilometros'] = $kms; // set the kms ==> fixed
	$filter['ingresos'] = $ingresos; // set the ingresos ==> fixed
	**/
	$filter['_fraccion'] = $_fraccion;
	$filter['fraction'] = $fraction;
// 	pr($_fraccion);exit();
	$filter['graphs']['ingresos'] = $ingresos;
	$filter['area'] = $this->areas()[$area];
	$filter['mes'] = $mes;
	$filter['id_mes'] = $id_mes;
	$filter['year'] = $year;
// 	$filter['ical'] = $ical[substr($mes,0,3)];
	$filter['daysArray'] = $calendar['daysArray'];
	

	// Send var to view
	$this->set('filter',$filter);
	$this->set('months',$months);
	$this->set('conceptos',$conceptos);
// 	exit();
	
      } // End Function DailyReport

      
      function ConceptSelected(){
// 	pr($this->data);exit();
		  if(!isset($this->data['Compare'])){
			$this->set('conceptos',null);
		  }else{
			  $this->DailyReport($concepto=null,
						$area=$this->data['Projections']['area'],
						$mes=$this->data['Projections']['mes'],
						$flota=null,
						$fraccion=null,
						$year=date('Y')
			  );
		  $this->set('conceptos',$this->data['Compare']);
		  }
      } // End Function ConceptSelected



      function week(){
		pr($this->Areas->find('all'));
		pr($this->Flotas->find('all'));
// 	  pr($this->data);
exit();
	    App::Import('Shell', 'Shell');
	    App::Import('Vendor',array('shells/calendar'));
	    $myCalendar = new CalendarShell(new Object());
	    $myCalendar->initialize();

	    $calendar = $myCalendar->main($year=date('Y'),false);
	    $fraction = $this->Fraccion->find('list',array('fields'=>array('id','fraccion')));
	    
// 	    pr($fraction);
	    foreach($calendar['days'] as $month => $dia){
		
		foreach($dia as $num_dia => $dia_detail){
		  foreach($fraction as $id_fraction => $fraction_desc){
			$dias[$month][$fraction_desc][$num_dia] = null;
		  }
		}
// 		pr($dia);
	    }
	    
	    pr($dias);exit();
	} // End


  } //End Controller

?>