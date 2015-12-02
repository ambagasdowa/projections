<?php
  class SearchController extends AppController{
	  var $name = 'Search';
      var $components = array('RequestHandler','Session');
      var $helpers = array('Html','Form','Ajax','Javascript','Js','GoogleMap','Pdf');
      var $uses = array(
						'Accounts',
						'Realms',
						'RealmsClass',
						'Flujo',
						'FlujoSaldo'
				  );

	  function ModelTest($year=null){
			$year= date('Y');
// 			$year = '2014';
			pr($account=$this->RealmsClass->getAccount());exit();
			pr($_SESSION);exit();
			
			App::Import('Shell', 'Shell');
			App::Import('Vendor',array('shells/calendar'));
			$myCalendar = new CalendarShell(new Object());
			$myCalendar->initialize();
			$calendar = $myCalendar->main($year,false);
			$_SESSION['calendar']['months'] = $calendar['months'];
			foreach($calendar['days'] as $month => $dia){

				foreach($dia as $num_dia => $dia_detail){
// 					pr($num_dia);
					$stats[$month][$dia_detail['week']] = $num_dia;
				}
			}
			pr($stats);
			foreach($stats as $month => $weekMonth){
			  foreach($weekMonth as $week => $monthNum){
				$weeksMonth[$week][$monthNum] = $month;
				
			  }
			}
			pr($weeksMonth);
			

		exit();
	  }
		
	  function xlsExport($ReportTitle=null,$ReportFileName=null,$view=null){
		
		$this->export_xls($_SESSION['flujo'], $ReportTitle, $ReportFileName,'export_flujo'); // filename without xls extension
		
	  }
	  
	  function exportXlsAcum($ReportTitle=null,$ReportFileName=null,$view=null){
		$this->export_xls($_SESSION['acumulate']['xls']['acumMonth'], $ReportTitle, $ReportFileName,'export_acumulado'); // filename without xls
	  }

	  function Acumulado($year=null,$months=null){

// 	  pr($this->data);
	  if(!isset($_SESSION['flujo']['year'])){
		$year = date('Y-m-d');
	  }else{
		$year = $_SESSION['flujo']['year'];
	  }
	  
	  if(empty($this->data['Flujo']['month'])){
		$this->render('alerts','ajax');
	  }else{
		
		if(!isset($_SESSION['calAcumulado'])){
			/**
			 *@Set acumulado-calendar to session
			 */
			$this->monthWeeks($year);
		}
		if(!isset($_SESSION['calendar'])){
			App::Import('Shell', 'Shell');
			App::Import('Vendor',array('shells/calendar'));
			$myCalendar = new CalendarShell(new Object());
			$myCalendar->initialize();
			$calendar = $myCalendar->main($year,false);
			$_SESSION['calendar'] = $calendar;
		}
		  $meses = $_SESSION['calendar']['months'];
// 		  pr($this->data);
// 		  $year=date('Y-m-d');
		  $months[] = $this->data['Flujo']['month']; // Set the data as array
		  $calc = $_SESSION['calAcumulado'];
		  
			foreach($months as $month){
			  foreach($calc[$month] as $week => $numMonth){
				$acum[$month][$week] = $this->Flujo->getFlujo($week,$year,'Active',$numMonth);
				$saldo[$month][$week] = $this->FlujoSaldo->getSaldo($week,$year,'Active',$numMonth)['FlujoSaldo']['presupuesto'];
				$mes = $meses[(int)$numMonth]['spanish'];
			  }
			}
  // 		
			$accounts = $this->RealmsClass->getAccount();
// 			pr($saldo);
			foreach($acum as $month => $week){
  // 			pr($week);
			  foreach($week as $numWeek => $Accounts){
				foreach($Accounts as $numAccount => $flujo){
  // 				pr($flujo);
				  if(!isset($acumulateByAccount/*[$month][$numWeek]*/[$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms']][$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms_class']])){
					$acumulateByAccount/*[$month][$numWeek]*/[$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms']][$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms_class']] = null;
				  }
				  $acumulateByAccount/*[$month][$numWeek]*/[$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms']][$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms_class']] += $flujo['Flujo']['presupuesto'];
//accounts by month
				  if(!isset($acumulateByAccountClass/*[$month]*//*[$numWeek]*/[$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms']][$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms_class']][$accounts[$flujo['Accounts']['id_realms_class']]['Accounts'][$numAccount]['account']])){
					$acumulateByAccountClass/*[$month]*//*[$numWeek]*/[$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms']][$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms_class']][$accounts[$flujo['Accounts']['id_realms_class']]['Accounts'][$numAccount]['account']] = null;
				  }
				  $acumulateByAccountClass/*[$month]*//*[$numWeek]*/[$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms']][$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms_class']][$accounts[$flujo['Accounts']['id_realms_class']]['Accounts'][$numAccount]['account']] += $flujo['Flujo']['presupuesto'];
// accounts by week
				  if(!isset($acumulateByAccountClassWeek/*[$month]*/[$numWeek][$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms']][$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms_class']][$accounts[$flujo['Accounts']['id_realms_class']]['Accounts'][$numAccount]['account']])){
					$acumulateByAccountClassWeek/*[$month]*/[$numWeek][$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms']][$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms_class']][$accounts[$flujo['Accounts']['id_realms_class']]['Accounts'][$numAccount]['account']] = null;
				  }
				  $acumulateByAccountClassWeek/*[$month]*/[$numWeek][$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms']][$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms_class']][$accounts[$flujo['Accounts']['id_realms_class']]['Accounts'][$numAccount]['account']] += $flujo['Flujo']['presupuesto'];

				  if(!isset($totalByAccountWeek/*[$month]*/[$numWeek][$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms']][$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms_class']])){
					$totalByAccountWeek/*[$month]*/[$numWeek][$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms']][$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms_class']] = null;
				  }
				  $totalByAccountWeek/*[$month]*/[$numWeek][$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms']][$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms_class']] += $flujo['Flujo']['presupuesto'];
				  

				  if(!isset($acumulate[$month][$numWeek][$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms']])){
					$acumulate[$month][$numWeek][$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms']] = null;
				  }
				  
				  $acumulate[$month][$numWeek][$accounts[$flujo['Accounts']['id_realms_class']]['RealmsClass']['realms']] += $flujo['Flujo']['presupuesto'];

				  $acumulate[$month][$numWeek]['SaldoInicial'] = $saldo[$month][$numWeek];

				}
				
			  }
			}
			
// 			pr($acumulate);
			foreach($acumulate as $month => $WeekContainer){
			  foreach($WeekContainer as $Week => $accounting){
				if(!isset($accounting['Ingresos'])){
				  $accounting['Ingresos'] = 0;
				}if(!isset($accounting['SaldoInicial'])){
				  $accounting['SaldoInicial'] = 0;
				}
				$getAcumulate[$Week] = ( $accounting['SaldoInicial'] + $accounting['Ingresos'] ) - $accounting['Egresos'] ;
			  }
			}
			
			//Retrieve the total mens of Account
			foreach($acumulateByAccount as $Realms => $Account){
			  $realms[$Realms] = array_sum($acumulateByAccount[$Realms]);
			}
			
			$acumulado['until'] = $_SESSION['daysWeek'][$this->data['Flujo']['month']];
			$acumulado['acumulateByAccount'] = $acumulateByAccount;
			$acumulado['acumulateByRealms'] = $realms;
			$acumulado['acumulateByAccountClass'] = $acumulateByAccountClass;
			$acumulado['acumByWeek'] = $getAcumulate ;
			$acumulado['acumulate'] = array_sum($getAcumulate);
			$acumulado['accountByWeek'] = $acumulateByAccountClassWeek;
			$acumulado['totalByAccountWeek'] = $totalByAccountWeek;
// 			pr($acumulateByAccountClassWeek);
			$acumulado['mes'] = $mes;
			$_SESSION['acumulate']['xls']['acumMonth'] = $acumulado;
			$this->set('acumulado',$acumulado);
		} // end Else
	  }

	  function monthWeeks($year=null){
//
		  $_SESSION['viewConfig'] = null;

		  $_SESSION['viewConfig']['width'] = '320';
		  $_SESSION['viewConfig']['height'] = '80';
		  $_SESSION['viewConfig']['fontSize'] = '180';
		  $_SESSION['viewConfig']['fontSizeTitle'] = '110';

			App::Import('Shell', 'Shell');
			App::Import('Vendor',array('shells/calendar'));
			$myCalendar = new CalendarShell(new Object());
			$myCalendar->initialize();
			$calendar = $myCalendar->main($year,false);
			$_SESSION['calendar']['months'] = $calendar['months'];
			foreach($calendar['days'] as $month => $dia){

				foreach($dia as $num_dia => $dia_detail){
					$stats[$month][$dia_detail['week']] = $dia_detail['month'];
					$daysWeek[$month][$dia_detail['week']] = $num_dia;
				}
			}
// 			pr($stats);
			foreach($stats as $month => $weekMonth){
			  foreach($weekMonth as $week => $monthNum){
				$weeksMonth[$week][$monthNum] = $month;
			  }
			}
			$_SESSION['weeksMonth'] = $weeksMonth;
			$_SESSION['calAcumulado'] = $stats;
			$_SESSION['daysWeek'] = $daysWeek;
			
			return $weeksMonth;
	  }

	  function index(){
		$this->monthWeeks(date('Y'));
	  }

	  function search(){
// 		pr($this->data);// debug
// // 		Do the maths for consulting recycle the code is already done!!
		if(empty($this->data)){
		  $this->read($this->data);
		}else{
// 		  if(!isset($_SESSION['weeksMonth'])){
// 			  $this->monthWeeks(date('Y'));
// 		  }

		  if(($this->data['Flujo']['week'])){
			$extract_w = explode('-',$this->data['Flujo']['week']);
			$year = $extract_w['0'];
			$week = str_replace('W','',$extract_w['1']);
		  }
		  $months = $_SESSION['weeksMonth'][$week]; // Set how many months we have in given week
		  $account=$this->RealmsClass->getAccount();
		  $this->monthWeeks($year);

		  foreach($months as $MonthNum => $MonthName){
			$flujo[$MonthName] = $this->Flujo->getFlujo($week,$year,'Active',$MonthNum);
			$getSaldo[$MonthName] = $this->FlujoSaldo->getSaldo($week,$year,$status='Active',$MonthNum);
		  }


		  foreach($flujo as $monthName => $flujoDetail){
// 			pr($flujoDetail);
			foreach($flujoDetail as $accountId => $flujoData){
				$flujoView[$monthName][$account[$flujoData['Accounts']['id_realms_class']]['RealmsClass']['realms']][$account[$flujoData['Accounts']['id_realms_class']]['RealmsClass']['realms_class']][$flujoData['Accounts']['account']] = $flujoData['Flujo']['presupuesto'];

			$mes[$monthName] = $_SESSION['calendar']['months'][$flujoData['Flujo']['month']]['spanish'];
				
				// 			Sum the total by class and realms
				
			if(!isset($flujoTotalByRealmsClass[$monthName][$account[$flujoData['Accounts']['id_realms_class']]['RealmsClass']['realms']][$account[$flujoData['Accounts']['id_realms_class']]['RealmsClass']['realms_class']])){
			  $flujoTotalByRealmsClass[$monthName][$account[$flujoData['Accounts']['id_realms_class']]['RealmsClass']['realms']][$account[$flujoData['Accounts']['id_realms_class']]['RealmsClass']['realms_class']] = null;
			}
			$flujoTotalByRealmsClass[$monthName][$account[$flujoData['Accounts']['id_realms_class']]['RealmsClass']['realms']][$account[$flujoData['Accounts']['id_realms_class']]['RealmsClass']['realms_class']] += $flujoData['Flujo']['presupuesto'];
			
			if(!isset($flujoTotalByRealm[$monthName][$account[$flujoData['Accounts']['id_realms_class']]['RealmsClass']['realms']])){
			  $flujoTotalByRealm[$monthName][$account[$flujoData['Accounts']['id_realms_class']]['RealmsClass']['realms']] = null;
			}
			$flujoTotalByRealm[$monthName][$account[$flujoData['Accounts']['id_realms_class']]['RealmsClass']['realms']] += $flujoData['Flujo']['presupuesto'];
			// Build var of saldos
			$getSaldo[$monthName]['FlujoSaldo']['EfectivoDisponible'] = $getSaldo[$monthName]['FlujoSaldo']['SaldoDisponible'] = null;
		  
			}
		  }

		  foreach($getSaldo as $month => $SaldoData){
			  if(isset($flujoTotalByRealm)){
				  if(!isset($getSaldo[$month]['FlujoSaldo']['presupuesto'])){
					$getSaldo[$month]['FlujoSaldo']['presupuesto'] = 0;
				  }
				  if(!isset($flujoTotalByRealm[$month]['Ingresos'])){
					$flujoTotalByRealm[$month]['Ingresos'] = 0 ;
				  }
					$getSaldo[$month]['FlujoSaldo']['EfectivoDisponible'] = $getSaldo[$month]['FlujoSaldo']['presupuesto'] + $flujoTotalByRealm[$month]['Ingresos'];

				  if(!isset($flujoTotalByRealm[$month]['Egresos'])){
					$flujoTotalByRealm[$month]['Egresos'] = 0 ;
				  }
					$getSaldo[$month]['FlujoSaldo']['SaldoDisponible'] = $getSaldo[$month]['FlujoSaldo']['EfectivoDisponible'] - $flujoTotalByRealm[$month]['Egresos'];

			  }
		  }

		  if(!isset($flujoView)){
			$this->render('alerts','ajax');
		  }else{
		  $estimate['saldo'] = $getSaldo;
		  $estimate['flujo'] = $flujoView;
		  $estimate['flujoTotalByRealm'] = $flujoTotalByRealm;
		  $estimate['flujoTotalByRealmsClass'] = $flujoTotalByRealmsClass;
		  $estimate['mes'] = $mes;
		  $estimate['year'] = $year;
// 		  pr($estimate);
		  $_SESSION['flujo'] = $estimate;
		  $this->set('flujo',$estimate);
		  }
		}
	  }//End Function search()

  }//End Class
?>