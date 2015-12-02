<?php
class CalendarShell extends Shell {
//       var $uses = array('Empresas',
// 			'Areas',
// 			'AreasAtm',
// 			'AreasTei',
// 			'Flotas',
// 			'FlotasAtm',
// 			'FlotasTei',
// 			'TipoOperacion',
// 			'Fraccion',
// 			'TonelajeCurrent',
// 			'TonelajeCurrentAtm',
// 			'TonelajeCurrentTei',
// 			'KmsCurrent',
// 			'KmsCurrentAtm',
// 			'KmsCurrentTei',
// 			'IngresosCurrent',
// 			'IngresosCurrentAtm',
// 			'IngresosCurrentTei'
// 			);

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

    function DaysInMonth($year=null){
      $months = $this->months(true,false,$year);
      $blurdays = array(
			'1'=>'Lunes',
			'2'=>'Martes',
			'3'=>'Miercoles',
			'4'=>'Jueves',
			'5'=>'Viernes',
			'6'=>'Sabado',
			'7'=>'Domingo'
		  );
//       1 (for Monday) through 7 (for Sunday)
      foreach($months as $id_month => $struct){
	for($day = '1'; $day <= $struct['days']; $day++){
		$day_in_week = date('N',mktime('0','0','0',$struct['numeric'],$day,$year));
		$day_name = date('D',mktime('0','0','0',$struct['numeric'],$day,$year));
		$day_in_month = date('d',mktime('0','0','0',$struct['numeric'],$day,$year));
		$week = date('W',mktime('0','0','0',$struct['numeric'],$day,$year));
		$month = date('m',mktime('0','0','0',$struct['numeric'],$day,$year));
		
		$daysInMonth[$struct['short']][$day_in_month]['name'] = $day_name;
		$daysInMonth[$struct['short']][$day_in_month]['num_week'] = $day_in_week;
		$daysInMonth[$struct['short']][$day_in_month]['spanish'] = $blurdays[$day_in_week];
		$daysInMonth[$struct['short']][$day_in_month]['sp_short'] = substr($blurdays[$day_in_week],0,3);
		$daysInMonth[$struct['short']][$day_in_month]['week'] = $week;
		$daysInMonth[$struct['short']][$day_in_month]['month'] = $month;
	}
      }
      $Getdays['daysArray'] = $blurdays;
      $Getdays['DaysInMonth'] = $daysInMonth;
    return $Getdays;
//     return $daysInMonth;
    } // End daysInMonth
			
			
    function main($year=null,$debug=null){
	if(empty($year)){
	  $year = date('Y');
	}
	
	$Getdays = $this->DaysInMonth($year);
// 	pr($Getdays);
	$calendar['months'] = $this->months(true,false,$year);
	$calendar['days'] = $Getdays['DaysInMonth'];
	$calendar['daysArray'] = $Getdays['daysArray'];
// 	$calendar['days'] = $this->DaysInMonth($year);
	if($debug){
	  $this->out(pr($calendar));
	}else{
	  return $calendar;
	}
    }// End function main
} //End class months
?>