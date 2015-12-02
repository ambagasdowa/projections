<?php
	class MssqlPresupuestoAtmController extends AppController{
		
		var $name = 'MssqlPresupuestoAtm';
		var $components = array('RequestHandler','Session');
		var $helpers = array('Html','Form','Ajax','Javascript','Js','GoogleMap','Pdf','GChart');
		var $uses = array('MssqlPresupuestoAtm','MssqlPresupuestoAtmVariable');
		

		function index(){
			
		}
		/** NOTE can use and array as month for the acumulative view */
		function CostoFijo($month=null){
			
			$month = array('Enero','Febrero','Marzo','Abril');
// 			$month = 'Enero';
			$MssqlPresupuestoAtm = null;
			$conditionsPrepAtm['MssqlPresupuestoAtm.Mes'] = $month;
			
			$costodet = $this->MssqlPresupuestoAtm->find('all',array('conditions'=>$conditionsPrepAtm));
			
			$id=0;
			foreach($costodet as $idx => $modelName){
				foreach($modelName as $modelString => $costoFijoContent){
// 					pr($costoFijoContent);

					$MssqlPresupuestoAtm[$costoFijoContent['Mes']][trim(utf8_encode($costoFijoContent['NombreCta']))]['Mes'] = $costoFijoContent['Mes'];
					$MssqlPresupuestoAtm[$costoFijoContent['Mes']][trim(utf8_encode($costoFijoContent['NombreCta']))]['NoCta'] = $costoFijoContent['NoCta'];
					$MssqlPresupuestoAtm[$costoFijoContent['Mes']][trim(utf8_encode($costoFijoContent['NombreCta']))]['Presupuesto']  = $costoFijoContent['Presupuesto'];
					if(!isset($MssqlPresupuestoAtm[$costoFijoContent['Mes']][trim(utf8_encode($costoFijoContent['NombreCta']))]['realCargo'])){
						$MssqlPresupuestoAtm[$costoFijoContent['Mes']][trim(utf8_encode($costoFijoContent['NombreCta']))]['realCargo'] = null;
					}
					$MssqlPresupuestoAtm[$costoFijoContent['Mes']][trim(utf8_encode($costoFijoContent['NombreCta']))]['realCargo'] += $costoFijoContent['Cargo'];
					if(!isset($MssqlPresupuestoAtm[$costoFijoContent['Mes']][trim(utf8_encode($costoFijoContent['NombreCta']))]['realAbono'])){
						$MssqlPresupuestoAtm[$costoFijoContent['Mes']][trim(utf8_encode($costoFijoContent['NombreCta']))]['realAbono'] = null;
					}
					$MssqlPresupuestoAtm[$costoFijoContent['Mes']][trim(utf8_encode($costoFijoContent['NombreCta']))]['realAbono'] += $costoFijoContent['Abono'];
				}$id += 1;
			}
// 			pr($MssqlPresupuestoAtm);
			$this->set('costoDetail',$costodet);
			$this->set('MssqlCostoFijoAtm',$MssqlPresupuestoAtm);
			$this->set('mes',$month);
// 			$this->set('queryMonth',$month);
		}
		
		function costoFijoDetail($nocta=null,$mes=null){

// 			var_dump($nocta);
// 			var_dump($mes);
			$conditionsDetailAtm['MssqlPresupuestoAtm.Mes'] = $mes;
			$conditionsDetailAtm['MssqlPresupuestoAtm.NoCta'] = $nocta;
			$costoDetail = $this->MssqlPresupuestoAtm->find('all',array('conditions'=>$conditionsDetailAtm));
// 			pr($costoDetail);
			$this->set('costoDetail',$costoDetail);
			$this->set('costoDetailMes',$mes);
		}

		
		function costoVariable($month=null){
			$month = array('Enero','Febrero','Marzo','Abril');
// 			$month = 'Enero';
			$MssqlPresupuestoAtmVariable = null;
			$conditionsPrepAtm['MssqlPresupuestoAtmVariable.Mes'] = $month;
			
			$costodet = $this->MssqlPresupuestoAtmVariable->find('all',array('conditions'=>$conditionsPrepAtm));
			
// 			pr($costodet);
// 			exit();
			$id=0;
			foreach($costodet as $idx => $modelName){
				foreach($modelName as $modelString => $costoFijoContent){
// 					pr($costoFijoContent);

					$MssqlPresupuestoAtmVariable[$costoFijoContent['Mes']][trim(utf8_encode($costoFijoContent['NombreCta']))][trim(substr($costoFijoContent['Entidad'],0,11))]['Mes'] = $costoFijoContent['Mes'];
					$MssqlPresupuestoAtmVariable[$costoFijoContent['Mes']][trim(utf8_encode($costoFijoContent['NombreCta']))][trim(substr($costoFijoContent['Entidad'],0,11))]['NoCta'] = $costoFijoContent['NoCta'];
					$MssqlPresupuestoAtmVariable[$costoFijoContent['Mes']][trim(utf8_encode($costoFijoContent['NombreCta']))][trim(substr($costoFijoContent['Entidad'],0,11))]['Presupuesto']  = $costoFijoContent['Presupuesto'];
					if(!isset($MssqlPresupuestoAtmVariable[$costoFijoContent['Mes']][trim(utf8_encode($costoFijoContent['NombreCta']))][trim(substr($costoFijoContent['Entidad'],0,11))]['realCargo'])){
						$MssqlPresupuestoAtmVariable[$costoFijoContent['Mes']][trim(utf8_encode($costoFijoContent['NombreCta']))][trim(substr($costoFijoContent['Entidad'],0,11))]['realCargo'] = null;
					}
					$MssqlPresupuestoAtmVariable[$costoFijoContent['Mes']][trim(utf8_encode($costoFijoContent['NombreCta']))][trim(substr($costoFijoContent['Entidad'],0,11))]['realCargo'] += $costoFijoContent['Cargo'];
					if(!isset($MssqlPresupuestoAtmVariable[$costoFijoContent['Mes']][trim(utf8_encode($costoFijoContent['NombreCta']))][trim(substr($costoFijoContent['Entidad'],0,11))]['realAbono'])){
						$MssqlPresupuestoAtmVariable[$costoFijoContent['Mes']][trim(utf8_encode($costoFijoContent['NombreCta']))][trim(substr($costoFijoContent['Entidad'],0,11))]['realAbono'] = null;
					}
					$MssqlPresupuestoAtmVariable[$costoFijoContent['Mes']][trim(utf8_encode($costoFijoContent['NombreCta']))][trim(substr($costoFijoContent['Entidad'],0,11))]['realAbono'] += $costoFijoContent['Abono'];
				}$id += 1;
			}
// 			pr($MssqlPresupuestoAtmVariable);
// 			exit();
			$this->set('costoDetail',$costodet);
			$this->set('MssqlCostoFijoAtmVariable',$MssqlPresupuestoAtmVariable);
			$this->set('mes',$month);
		}
		
		function costoVariableDetail($nocta=null,$mes=null,$entidad=null){

// 			var_dump($nocta);
// 			var_dump($mes);
// 			var_dump($entidad);
			$conditionsDetailAtmVariable['MssqlPresupuestoAtmVariable.Mes'] = $mes;
			$conditionsDetailAtmVariable['MssqlPresupuestoAtmVariable.NoCta'] = $nocta;
			$conditionsDetailAtmVariable['MssqlPresupuestoAtmVariable.distinto'] = $entidad;
			
			$costoDetail = $this->MssqlPresupuestoAtmVariable->find('all',array('conditions'=>$conditionsDetailAtmVariable));
// 			pr($costoDetail);
			$this->set('costoDetail',$costoDetail);
			$this->set('costoDetailMes',$mes);
		}

		
	}//End MssqlIntegraappViewPresupuestoAtm
?> 
