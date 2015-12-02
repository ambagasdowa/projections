<?php
// 	  App::import('Core', 'Controller');
// 	  App::import('Controller', 'Holiday');
// 	  App::import('AppController', 'Controller');
	  
  class DisponibilidadShell extends Shell{
      var $uses = array('Empresas','Operacion','OperacionMensual','Fleets','FleetsAtm','FleetsTei','Presupuesto',
			'MssqlAreasTbk','MssqlFlotasTbk','MssqlDespStatusTbk','MssqlUnidadesAsignadasTbk','MssqlPersonalPersonalTbk',
			'MssqlAreasAtm','MssqlFlotasAtm','MssqlDespStatusAtm','MssqlUnidadesAsignadasAtm','MssqlPersonalPersonalAtm',
			'MssqlAreasTei','MssqlFlotasTei','MssqlDespStatusTei','MssqlUnidadesAsignadasTei','MssqlPersonalPersonalTei',
			'MssqlViajesRtTbk','MssqlViajesRtAtm','MssqlViajesRtTei',
			'Disponibilidad',
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
			'IngresosCurrentTei'
			);
	
  function Empresas(){
	$EmpConditions['Empresas.active'] = '1'; // Check if the area is alive
	$empresas = $this->Empresas->find('list',array('fields'=>array('id_empresa','empresa'),array('conditions'=>$EmpConditions)));
	$corp = null;
	unset($empresas['4']);
	
	foreach($empresas as $key => $value){
// 	    if($key == $_SESSION['Auth']['User']['id_empresa']){
		if($key == '1'){ // only for Bonmapak
		    $_append[$key] = null;
		}else{
		    $_append[$key]  = substr(ucwords(strtolower($value)),0,3);
// 		}
	    }
	} // End foreach of empresas
	return $_append;
  }

	
	  function model(){

		$id_empresa = '1';
		$id_area='2';
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
		  $resultFleets[$fleetConfig] = $this->MssqlUnidadesAsignadasTbk->getUnidades($id_area,$id_flota,$status=null,$id_empresa);
		}
		pr($resultFleets);
		exit();
	  }
	  
	  function whereEmpresa($id_empresa=null){
		
		if(!empty($id_empresa)){
		  if($this->Empresas()[$id_empresa] == null){
			$_append = 'Tbk';
		  }else{
			$_append = $this->Empresas()[$id_empresa];
		  }
		}else{
		  foreach($this->Empresas() as $id_empresa => $empresa){
			if($id_empresa == '1'){
			  $_append[$id_empresa] = 'Tbk';
			}else{
			  $_append[$id_empresa] = $empresa;
			}
		  }
		}
		return $_append;
	  }//End whereEmpresa
	  
	  function arrayFlotas($id_empresa=null){

		$_append = $this->whereEmpresa($id_empresa);
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
// 		if(empty($id_empresa)){
// 		  $id_empresa = $_SESSION['Auth']['User']['id_empresa'];
// 		}
		$_append = $this->whereEmpresa($id_empresa);
		$modelStatus = 'MssqlDespStatus'.$_append;
		$modelFlotas = 'MssqlFlotas'.$_append;
		$modelUnidades = 'MssqlUnidadesAsignadas'.$_append;
		$modelViajesRt = 'MssqlViajesRt'.$_append;
		
		$getFlotasArray = $this->arrayFlotas($id_empresa);
		
// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // //
// las labour day
// firstlabour day
//NOTE work form hir
	  
	  $this->hr();
	  pr($id_area);
	  $this->hr();
	  pr($id_empresa);
	  $this->hr();
// 	  exit();
	  $fechaViajes = implode('-',explode('-',date_format(date_sub(date_create(date('Y-m-d')), date_interval_create_from_date_string('1 day')),  'Y-m-d')));
// 	  pr($fechaViajes);
// 	  exit();
	  $getTraficoViaje = $this->$modelViajesRt->getMssqlTraficoViaje($id_area,$no_viaje=null,$fechaViajes,$id_empresa);
	  $viajesDespachados[$id_empresa] = $getTraficoViaje['viajes_count'];
	  $toneladasDespachados[$id_empresa] = $getTraficoViaje['toneladas'];
	  $this->hr();
// 	  pr($viajesDespachados);
// 	  if($id_empresa == '2'){
// 		exit();
// 	  }
	  
// 	  $disponibilidad['disponibilidad'][$fleetConfig]['unidades']['viajes_despachados'] = $viajesDespachados;
// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // //
		if(empty($view)){
		  $status = $this->$modelStatus->getStatus();
// 		  $flotas = $this->$modelFlotas->getFlotas();
		  foreach(fleetsConfig() as $ind => $fleetConfig){


			if(isset($getFlotasArray[$id_area][$fleetConfig])){
			  $id_flota = $getFlotasArray[$id_area][$fleetConfig];
			  
// 			  pr($id_flota);
			  
			  if( isset($id_flota) and !empty($id_flota) ){
				foreach($id_flota as $idFleet => $indexFleet){
				  if(isset($viajesDespachados[$id_empresa][$indexFleet])){
					if(!isset($countIdFlota)){
					  $countIdFlota = null;
					  $countTonsFlota = null;
					}
					$countIdFlota += count($viajesDespachados[$id_empresa][$indexFleet]);
					$countTonsFlota += array_sum($toneladasDespachados[$id_empresa][$indexFleet]);
				  }
				}
			  }
// 			  pr($countIdFlota);
// 			  exit();
			  $getUnidadesTotales  = $this->$modelUnidades->getUnidades($id_area,$id_flota,null,$id_empresa);
			  $getUnidadesDisponibles = $this->$modelUnidades->getUnidades($id_area,$id_flota,$status='1',$id_empresa);
			  $getUnidadesTransito = $this->$modelUnidades->getUnidades($id_area,$id_flota,$status='2',$id_empresa);
			  $getUnidadesMantenimiento = $this->$modelUnidades->getUnidades($id_area,$id_flota,$status='3',$id_empresa);
			  $getUnidadesAccidentados = $this->$modelUnidades->getUnidades($id_area,$id_flota,$status='4',$id_empresa);
			  $getUnidadesCargado = $this->$modelUnidades->getUnidades($id_area,$id_flota,$status='5',$id_empresa);
			  $getUnidadesDescargado = $this->$modelUnidades->getUnidades($id_area,$id_flota,$status='6',$id_empresa);
			  $getUnidadesFueraDeServicio = $this->$modelUnidades->getUnidades($id_area,$id_flota,$status='7',$id_empresa);
// 			  if(isset($viajesDespachados[$id_empresa][$id_flota])){
// 				$getViajesDespachados = $countIdFlota;
// 			  }
			  $disponibilidad['disponibilidad'][$fleetConfig]['unidades']['totalDetail'] = $getUnidadesTotales;
			  
			  $disponibilidad['disponibilidad'][$fleetConfig]['unidades']['totales'] = $getUnidadesTotales['allUnits'];
			  $disponibilidad['disponibilidad'][$fleetConfig]['personal']['asignado'] = $getUnidadesTotales['personalCount'];
// 			  pr($getUnidadesTotales);
			  $disponibilidad['disponibilidad'][$fleetConfig]['unidades']['detalle'] = $getUnidadesTotales['unidades'];
// 			  $disponibilidad['disponibilidad'][$fleetConfig]['unidades']['viajes_ha'] =
			  $disponibilidad['disponibilidad'][$fleetConfig]['unidades']['disponibles'] = count($getUnidadesDisponibles['unidades']);
			  $disponibilidad['disponibilidad'][$fleetConfig]['unidades']['transito'] = count($getUnidadesTransito['unidades']);
			  $disponibilidad['disponibilidad'][$fleetConfig]['unidades']['mantenimiento'] = count($getUnidadesMantenimiento['unidades']);
			  $disponibilidad['disponibilidad'][$fleetConfig]['unidades']['accidentados'] = count($getUnidadesAccidentados['unidades']);
			  $disponibilidad['disponibilidad'][$fleetConfig]['unidades']['cargado'] = count($getUnidadesCargado['unidades']);
			  $disponibilidad['disponibilidad'][$fleetConfig]['unidades']['descargado'] = count($getUnidadesDescargado['unidades']);
			  $disponibilidad['disponibilidad'][$fleetConfig]['unidades']['fuera_de_servicio'] = count($getUnidadesFueraDeServicio['unidades']);
			  if(isset($countIdFlota)){
				$disponibilidad['disponibilidad'][$fleetConfig]['unidades']['viajes_despachados'] = $countIdFlota;
				$disponibilidad['disponibilidad'][$fleetConfig]['unidades']['toneladas'] = $countTonsFlota;
				$disponibilidad['disponibilidad'][$fleetConfig]['unidades']['productividad'] = ($disponibilidad['disponibilidad'][$fleetConfig]['unidades']['viajes_despachados']/$disponibilidad['disponibilidad'][$fleetConfig]['unidades']['disponibles']);
			  }else{
				$disponibilidad['disponibilidad'][$fleetConfig]['unidades']['viajes_despachados'] = '0';
				$disponibilidad['disponibilidad'][$fleetConfig]['unidades']['productividad'] = '0';
				$disponibilidad['disponibilidad'][$fleetConfig]['unidades']['toneladas'] = '0';
			  }
			  $countIdFlota = null;//reset countIdFlota
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
			  if( isset($id_flota) and !empty($id_flota) ){
				foreach($id_flota as $idFleet => $indexFleet){
				  if(isset($viajesDespachados[$id_empresa][$indexFleet])){
					if(!isset($countIdFlota)){
					  $countIdFlota = null;
					  $countTonsFlota = null;
					}
					$countIdFlota += count($viajesDespachados[$id_empresa][$indexFleet]);
					$countTonsFlota += array_sum($toneladasDespachados[$id_empresa][$indexFleet]);
				  }
				}
			  }
// 			$this->hr('test');
// 			pr($countIdFlota);
// 			$this->hr('test');
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
			  if(isset($countIdFlota)){
				$disponibilidad['disponibilidad'][$fleetConfig]['unidades']['viajes_despachados'] = $countIdFlota;
				$disponibilidad['disponibilidad'][$fleetConfig]['unidades']['toneladas'] = $countTonsFlota;
				$disponibilidad['disponibilidad'][$fleetConfig]['unidades']['productividad'] = ($disponibilidad['disponibilidad'][$fleetConfig]['unidades']['viajes_despachados']/$disponibilidad['disponibilidad'][$fleetConfig]['unidades']['disponibles']);
			  }else{
				$disponibilidad['disponibilidad'][$fleetConfig]['unidades']['viajes_despachados'] = '0';
				$disponibilidad['disponibilidad'][$fleetConfig]['unidades']['productividad'] = '0';
				$disponibilidad['disponibilidad'][$fleetConfig]['unidades']['toneladas'] = '0';
			  }
		  }
		}
// 		pr($viajesDespachados);
		return $disponibilidad;
	  }
	  
	  function ind_disponibilidad($set=null,$return=null,$id_empresa=null,$id_area=null,$id_flota=null,$console=null){
// 		if(empty($id_empresa)){
// 		  $id_empresa = $_SESSION['Auth']['User']['id_empresa'];
// 		}
		$modelAreas = 'MssqlAreas'.$this->whereEmpresa($id_empresa);
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

		$fecha = $year.'-'.$month.'-'.$day;
// 		$fecha = ('2014-01-31');
		
		$set_date = explode('-',date_format(date_sub(date_create($fecha), date_interval_create_from_date_string('1 day')), 'Y-m-d'));
		
		App::Import('Shell', 'Shell');
		App::Import('Vendor',array('shells/tachion'));
		$tachionShell = new TachionShell(new Object());
		$tachionShell->initialize();
	// 	Select the method to call
		$workDays = $tachionShell->workingDays(false,$set_date['0'],$set_date['1'],$session=true);
// 		$workDays = $this->workingDays(false,$year,$month,$session=true);
		$months = $tachionShell->months(true,false,$set_date['0']);
		$mes = $months[(int)$set_date['1']]['spanish'];
		
		$disponibilidad['disponibilidad']['date']['currentWorkingday'] = $workDays['currentWorkDays'];
		$disponibilidad['disponibilidad']['date']['totalCurrentWorkingdays'] = $workDays['totalCurrentWorkingDays'];
		$disponibilidad['disponibilidad']['date']['year'] = $set_date['0'];
		$disponibilidad['disponibilidad']['date']['month'] = $set_date['1'];
		$disponibilidad['disponibilidad']['date']['day'] = $set_date['2'];
		$disponibilidad['disponibilidad']['date']['mes'] = $mes;
		$disponibilidad['disponibilidad']['title']['area'] = $areaName;
		
		if(isset($this->params['requested']) OR ($return === true AND $set === false )){
			return $disponibilidad;
        }else{
            $this->set('disponibilidad',$disponibilidad);
        }
	  }//end ind_disponibilidad

	function saveDisponibilidad(){
// 	  $id_empresa = '1';
	  $empresa = $this->whereEmpresa();

	  foreach($empresa as $id_empresa => $empresa_name){
		$extractFlotas = $this->arrayFlotas($id_empresa);
		foreach($extractFlotas as $id_area => $areasContent){
		  $extractDisponibilidad[$id_empresa][$id_area] = $this->ind_disponibilidad(false,true,$id_empresa,$id_area,$id_flota=null,$console=true);
		}
	  }
// 	  pr($extractDisponibilidad);
	  foreach($extractDisponibilidad as $id_empresa => $id_flota_content){
		foreach($id_flota_content as $id_flota => $flotaContenido){
		  foreach($flotaContenido['disponibilidad'] as $tipoDisponibilidad =>$dispContents){

			  if(trim((string)$tipoDisponibilidad) === 'cemento' OR trim((string)$tipoDisponibilidad) === 'terceros'){

				  $asigned_personal = $flotaContenido['disponibilidad'][$tipoDisponibilidad]['personal']['asignado'];
				  $total_units = $flotaContenido['disponibilidad'][$tipoDisponibilidad]['unidades']['totales'];
				  $unit_disp = $flotaContenido['disponibilidad'][$tipoDisponibilidad]['unidades']['disponibles'];
				  $unit_transit = $flotaContenido['disponibilidad'][$tipoDisponibilidad]['unidades']['transito'];
				  $unit_maintenance = $flotaContenido['disponibilidad'][$tipoDisponibilidad]['unidades']['mantenimiento'];
				  $unit_accidented = $flotaContenido['disponibilidad'][$tipoDisponibilidad]['unidades']['accidentados'];
				  $unit_loaded = $flotaContenido['disponibilidad'][$tipoDisponibilidad]['unidades']['cargado'];
				  $unit_unloaded = $flotaContenido['disponibilidad'][$tipoDisponibilidad]['unidades']['descargado'];
				  $unit_out_service = $flotaContenido['disponibilidad'][$tipoDisponibilidad]['unidades']['fuera_de_servicio'];
				  $unit_trips_ha = $flotaContenido['disponibilidad'][$tipoDisponibilidad]['unidades']['viajes_despachados'];
				  $tons_real = $flotaContenido['disponibilidad'][$tipoDisponibilidad]['unidades']['toneladas'];
			  /** TODO NOTE the accomplishment tons_program against tons_real */
				  $tons_program = '0';
				  if((int)$tons_program > 0 and (int)$tons_real > 0){
				  $accomplishment = $tons_real/($tons_program);
				  }elseif((int)$tons_program === 0 and (int)$tons_real > 0){
					$accomplishment = $tons_real/$tons_real;
				  }else{
					$accomplishment = '0';
				  }
				  $currentWorkingday = $flotaContenido['disponibilidad']['date']['currentWorkingday'];
				  $totalCurrentWorkingdays = $flotaContenido['disponibilidad']['date']['totalCurrentWorkingdays'];
				  $performance = $flotaContenido['disponibilidad'][$tipoDisponibilidad]['unidades']['productividad'];
				  $year = $flotaContenido['disponibilidad']['date']['year'];
				  $month = $flotaContenido['disponibilidad']['date']['month'];
				  $day = $flotaContenido['disponibilidad']['date']['day'];
				  $mes = $flotaContenido['disponibilidad']['date']['mes'];
				  $title = $flotaContenido['disponibilidad']['title']['area'];
				  $set_date = $year.'-'.$month.'-'.$day;
				  $fecha = $set_date;
				  if((int)$month === (int)date('m') and ((int)$year === (int)date('Y')) ){
					$workingDay = ($currentWorkingday - 1);
				  }else{
					$workingDay = $currentWorkingday;
				  }

				  $dispSaveData['Disponibilidad'][] = array(
											  'id_empresa'=>$id_empresa,
											  'id_area'=>$id_flota,//???
											  'tipo_disponibilidad'=>$tipoDisponibilidad,
											  'asigned_personal'=>$asigned_personal,
											  'total_units'=>$total_units,
											  'unit_disp'=>$unit_disp,
											  'unit_transit'=>$unit_transit,
											  'unit_maintenance'=>$unit_maintenance,
											  'unit_accidented'=>$unit_accidented,
											  'unit_loaded'=>$unit_loaded,
											  'unit_unloaded'=>$unit_unloaded,
											  'unit_out_service'=>$unit_out_service,
											  'unit_without_operator'=>($total_units-$asigned_personal),
											  'unit_trips_ha'=>$unit_trips_ha,
											  'tons_real' => $tons_real,
											  'tons_program'=>'0',
											  'current_work_day'=>$workingDay,
											  'total_current_working_days'=>$totalCurrentWorkingdays,
											  'performance'=>$performance,
											  'accomplishment'=>$accomplishment,
											  'set_date'=>$set_date,//@fix properly done
											  'year'=>$year,
											  'month'=>$month,
											  'day'=>$day,
											  'area'=>$title,
											  'mes'=>$mes
					);
			  }//end if
			  
		  }
		}
	  }
// 	  pr($dispSaveData);

	  $this->hr();
	  $this->out('all data already collected');
	  $this->hr();
	  
	  $this->Disponibilidad->set($dispSaveData['Disponibilidad']);
	  
	  if($this->Disponibilidad->saveAll()){
		$this->out('Save data of Operations for Date of => '.$set_date.' at '.date('Y-m-d H:i:s'));
	  }
// 	  pr($this->Disponibilidad->find('all'));
	  return true;
	}
	
	function main(){
// 	  pr($this->MssqlViajesRtTbk->getMssqlTraficoViaje('1',$no_viaje=null,'2015-01-28','1'));
// 	  pr($this->MssqlViajesRtAtm->getMssqlTraficoViaje('1',$no_viaje=null,'2015-01-28','2'));
// 	  pr($this->MssqlViajesRtTei->getMssqlTraficoViaje('1',$no_viaje=null,'2015-01-27','3'));
	  return $this->saveDisponibilidad();

	}// end main
  
  }// End Shell Class Disponibilidad
?>