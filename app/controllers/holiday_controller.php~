<?php

    class HolidayController extends AppController{

      var $name = 'Holiday';
      var $components = array('RequestHandler','Session');
      var $helpers = array('Html','Form','Ajax','Javascript','Js','GoogleMap','Pdf');
      var $uses = array();
    

// 	this can come from a db record
// 	  $year = date('Y');
/**

Object oriented style
---sub
$date = new DateTime('2000-01-20');
$date->sub(new DateInterval('P10D'));
echo $date->format('Y-m-d') . \"\n\";
---add
$date = new DateTime('2000-01-01');
$date->add(new DateInterval('P10D'));
echo $date->format('Y-m-d') . \"\n\";

Procedural style
---sub
$date = date_create('2000-01-20');
date_sub($date, date_interval_create_from_date_string('10 days'));
echo date_format($date, 'Y-m-d');
----add
$date = date_create('2000-01-01');
date_add($date, date_interval_create_from_date_string('10 days'));
echo date_format($date, 'Y-m-d');

period:
P1Y2M3DT1H2M3S

period time:
PT1H2M3S

**/
// DB?
// pr($year);exit();
      function GetNationalMexicanHolidays($year=null){
		  $HolyMonth['sub']['AshesWednesday']= 'P46D';
		  $HolyMonth['sub']['PalmSunday']= 'P7D';
		  $HolyMonth['sub']['HolyThursday']= 'P3D';
		  $HolyMonth['sub']['GoodFriday']= 'P2D';
		  $HolyMonth['sub']['SaturdayOfGlory']= 'P1D';
		  $HolyMonth['add']['AscentionOfMigthyLord']= 'P39D';
		  $HolyMonth['add']['Pentecostes']= 'P49D';
		  $HolyMonth['add']['HolynessTrinity']= 'P56D';
		  $HolyMonth['add']['CorpusChristi']= 'P60D';
		
		  $GetEaster = $this->get_easter_datetime($year)->format('Y-m-d');
      
		  foreach($HolyMonth['sub'] as $DayCeleb => $celebration ){
			$date = new DateTime($GetEaster);
			$date->sub(new DateInterval($celebration));
			$BeforeEaster[$DayCeleb] = $date->format('Y-m-d');
		  }foreach($HolyMonth['add'] as $DayCeleb => $celebration){
			$date = new DateTime($GetEaster);
			$date->add(new DateInterval($celebration));
			$AfterEaster[$DayCeleb] = $date->format('Y-m-d');
		  }

      
      
		  $MxBankHolidays = array( 
					'NewYearsDay' => $year.'-01-01',
					'BattleOfPuebla' => ''.date('Y-m-d',strtotime('first Monday of February'.$year)),
					'JuarezBirthday' => ''.date('Y-m-d',strtotime('third Monday of March'.$year)),
					'LabourDay' => $year.'-05-01',
					'IndependenceDay' => $year.'-09-16',
					'MexicanRevolution' => ''.date('Y-m-d',strtotime('third Monday of November'.$year)),
					'Christmas' => $year.'-12-25'
		  );

      
		  $MxMexicanHolidays = array( 
					'HolyThursday' => $BeforeEaster['HolyThursday'],// Holy Thursday
					'GoodFriday' => $BeforeEaster['GoodFriday'], // Good Friday
					'HolySaturday' => $BeforeEaster['SaturdayOfGlory'], // Holy Saturday
					'AllSoulsDay' => $year.'-11-02', // All Souls'Day
					'OurLadyOfGuadalupe' => $year.'-12-12' // Our Lady of Guadalupe
		  );
		  
	//       array_push($MxBankHolidays,$BeforeEaster['GoodFriday']);
	//       array_push($MxBankHolidays,$MxMexicanHolidays['AllSoulsDay']);
		  
		  $MexicanoHolidays['holiday'] = $MxBankHolidays;
		  $MexicanoHolidays['holiday']['GoodFriday'] = $BeforeEaster['GoodFriday'];
		  $MexicanoHolidays['holiday']['SaturdayOfGlory'] = $BeforeEaster['SaturdayOfGlory'];
		  $MexicanoHolidays['holiday']['AllSoulsDay'] = $MxMexicanHolidays['AllSoulsDay'];
		  $MexicanoHolidays['mexican'] = $MxMexicanHolidays;
		  $MexicanoHolidays['easter'] = $GetEaster;
		  $MexicanoHolidays['holymonth'] = $HolyMonth;
		  $MexicanoHolidays['beforeeaster'] = $BeforeEaster;
		  $MexicanoHolidays['aftereaster'] = $AfterEaster;

		  return $MexicanoHolidays;
      }

      function GetWorkingDays($startDate=null,$endDate=null,$MexicanoHolidays=null,$debug=null,$return=null,$saturday=null){

		$holidays = $MexicanoHolidays['holiday'];
		$work = 0;
		$nowork = 0;
		$dayx = strtotime($startDate);
		$endx = strtotime($endDate);
		$detailWorkingDays = null;
		
// 		var_dump($startDate);
// 		var_dump($return);
// 		var_dump($weekend);
		
		if (!empty($saturday) and $saturday == true) {
			$daysOfWeekend = 5;
		} else {
			$daysOfWeekend = 6;
		}
		
		if($debug){
		  echo '<h1>get_working_days</h1>';
		  echo 'startDate: '.date('r',strtotime( $startDate)).'<br>';
		  echo 'endDate: '.date('r',strtotime( $endDate)).'<br>';
		  pr($holidays);
  // 	  foreach($holidays as $date){
  // 	  pr(key($holidays));
  // 	  next($holidays);
  // 	  }
		  echo '<p>Go to work...</p>';
		}
	  
		  while($dayx <= $endx){
			$day = date('N',$dayx);
			$date = date('Y-m-d',$dayx);
		  if($debug) {
			echo '<br />'.date('r',$dayx).' ';
		  }
		  if($day > $daysOfWeekend || in_array($date,$holidays)){
			$detailWorkingDays['list'][$date] = false;
			$nowork++;
			/** ALERT add the logic for build the day */
			  if($debug){
				if($day > $daysOfWeekend) {
					echo '<span style="background-color:#4ECA06;display:inline;">weekend</span>';
					$detailWorkingDays['weekend'][$date] = false;
				} else {
					echo '<span style="background-color:yellow;display:inline;">holiday</span>';
					$detailWorkingDays['holiday'][$date] = false;
					if($date) {
						$get_holiday = array_keys($holidays,$date);
							foreach($get_holiday as $key => $desc) {
								echo '=><span style="background-color:yellow;display:inline;">'.$desc.'</span>';
							}
					}
				}
			  }
		  } else {
			  /** ALERT add if no holiday or weekend*/
			  $work++;
			  $detailWorkingDays['laboral'][$date] = true;
			  $detailWorkingDays['list'][$date] = true;
		  }
			$dayx = strtotime($date.' +1 day');
		}
		if($debug) {
		  echo '<p>No work: '.$nowork.'<br>';
		  echo 'Work: '.$work.'<br>';
		  echo 'Work + no work: '.($nowork+$work).'<br>';
		  echo 'All seconds / seconds in a day: '.floatval(strtotime($endDate)-strtotime($startDate))/floatval(24*60*60);
		  echo '</p>';
		}
		
		if( !empty($return) ) {
			return $detailWorkingDays;
		} else {
			return $work;
		}
	} // GetWorkingDays end's

/**
easter_date() relies on your system's C library time functions, rather than using PHP's internal date and time functions. As a consequence, easter_date() uses the TZ environment variable to determine the time zone it should operate in, rather than using PHP's default time zone, which may result in unexpected behaviour when using this function in conjunction with other date functions in PHP.
As a workaround, you can use the easter_days() with DateTime and DateInterval to calculate the start of Easter in your PHP time zone as follows:
**/
      function get_easter_datetime($year=null){
		  $base = new DateTime("$year-03-21");
		  $days = easter_days($year);
		return $base->add(new DateInterval("P{$days}D"));
      }

      function EasterDate($year = null){
		if(!isset($year)){
		  $year = date('Y'); //Takes Default as current year
		}
		$GetEaster = $this->get_easter_datetime($year)->format('Y-m-d');
	// 	$GetEasterDatetime = explode('-',$easter);
		$easter = explode('-',$GetEaster);
// 	  foreach (range(2012, 2015) as $year) {
// 	    printf("HolyWeek of year %d => %s\n<br />",$year,$Holiday->get_easter_datetime($year)->format('F j'));
// 	  }
      return $easter;
      }

      function index(){

      }
      /**
	  @param => This function is called for print in the view
      **/

      function RetrieveHolidays($startDate = null, $endDate = null, $debug = null, $year= null,$currentWDays = null){
		if(!isset($year)){ // if no year are specific then use current year
			$year = date('Y');
		}
	  return $this->GetWorkingDays( $startDate,$endDate,$this->GetNationalMexicanHolidays($year),$debug);
      } // End RetrieveHolidays();


 /** @uses=> Testing functions
 **/
 
 /**
 * This function returns an array of timestamp corresponding to french holidays
  I recently had to write a function that allows me to know if today is a holiday.
And in France, we have some holidays which depends on the easter date. Maybe this will be helpful to someone.
Just modify in the $holidays array the actual holidays dates of your country.
 */
    protected static function getHolidays($year = null){
	if ($year === null){
	    $year = intval(date('Y'));
	}
    
	$easterDate  = easter_date($year);
	$easterDay   = date('j', $easterDate);
	$easterMonth = date('n', $easterDate);
	$easterYear   = date('Y', $easterDate);

	$holidays = array(
	// These days have a fixed date
	mktime(0, 0, 0, 1,  1,  $year),  // 1er janvier
	mktime(0, 0, 0, 5,  1,  $year),  // Fête du travail
	mktime(0, 0, 0, 5,  8,  $year),  // Victoire des alliés
	mktime(0, 0, 0, 7,  14, $year),  // Fête nationale
	mktime(0, 0, 0, 8,  15, $year),  // Assomption
	mktime(0, 0, 0, 11, 1,  $year),  // Toussaint
	mktime(0, 0, 0, 11, 11, $year),  // Armistice
	mktime(0, 0, 0, 12, 25, $year),  // Noel

	// These days have a date depending on easter
	mktime(0, 0, 0, $easterMonth, $easterDay + 2,  $easterYear),
	mktime(0, 0, 0, $easterMonth, $easterDay + 40, $easterYear),
	mktime(0, 0, 0, $easterMonth, $easterDay + 50, $easterYear),
	);

	sort($holidays);
  
	return $holidays;
    }
    
    /**
    To compute the correct Easter date for Eastern Orthodox Churches I made a function based on the Meeus Julian algorithm:
    **/
    function orthodox_eastern($year) { 
	$a = $year % 4; 
	$b = $year % 7; 
	$c = $year % 19; 
	$d = (19 * $c + 15) % 30; 
	$e = (2 * $a + 4 * $b - $d + 34) % 7; 
	$month = floor(($d + $e + 114) / 31); 
	$day = (($d + $e + 114) % 31) + 1; 
    
	$de = mktime(0, 0, 0, $month, $day + 13, $year); 
    
      return $de; 
    }
    
    
    /** @var => This is from wikipedia seems very interesting so scorunge deep on it!
    **  @uses => antoher functions mesespanol() and diaespanol() 
    **/
    
    function pascua ($anno){
	# Constantes mágicas
	$M = 24;
	$N = 5;
    #Cálculo de residuos
	$a = $anno % 19;
	$b = $anno % 4;
	$c = $anno % 7;
	$d = (19*$a + $M) % 30;
	$e = (2*$b+4*$c+6*$d + $N) % 7;
    # Decidir entre los 2 casos:
	if( $d + $e < 10 ){
	    $dia = $d + $e + 22;
	    $mes = 3; // marzo
	}else{
	    $dia = $d + $e - 9;
	    $mes = 4; //abril
        }
    # Excepciones especiales (según artículo)
	if ( $dia == 26  and $mes == 4 ) { // 4 = abril
	    $dia = 19;
	}
	if ( $dia == 25 and $mes == 4 and $d==28 and $e == 6 and $a >10 ) { // 4 = abril
	    $dia = 18;
        }
	$ret = $dia.'-'.$mes.'-'.$anno;
	return ($ret);
    }

    function mesespanol($m){
	$m=intval($m);
	$meses="No Especificado,Enero,Febrero,Marzo,Abril,Mayo,Junio,Julio,Agosto,Septiembre,Octubre,Noviembre,Diciembre";
	$mes=explode(",",$meses);
	$mesespan=$mes[$m];
    return $mesespan;
    }
    
    function diaespanol($d){
	$d=intval($d);
	$dias="No Especificado,Lunes,Martes,Miercoles,Jueves,Viernes,Sabado,Domingo";
	$dia=explode(",",$dias);
	$diasspan=$dia[$d];
    return $diasspan;
    }
 
    /** @var oldies-section
	@uses => C#
	@package => ansi i think?
	
	/// <summary>
	/// Método que devuelve el Domingo de Pascua dado un año a consultar.
	/// </summary>
	/// <param name="anyo">Año a consultar.</param>
	/// <returns>Día del año que es Domingo de Pascua.</returns>
    public static DateTime GetEasterSunday(int anyo)
    {
	int M = 25;
	int N = 5;
 
	if 	(anyo >= 1583 && anyo <= 1699) 		{ M = 22; N = 2; }
	else if (anyo >= 1700 && anyo <= 1799) 	{ M = 23; N = 3; }
	else if (anyo >= 1800 && anyo <= 1899) 	{ M = 23; N = 4; }
	else if (anyo >= 1900 && anyo <= 2099) 	{ M = 24; N = 5; }
	else if (anyo >= 2100 && anyo <= 2199) 	{ M = 24; N = 6; }
	else if (anyo >= 2200 && anyo <= 2299) 	{ M = 25; N = 0; }
 
	int a, b, c, d, e, dia, mes;
 
	//Cálculo de residuos
	a = anyo % 19;
	b = anyo % 4;
	c = anyo % 7;
	d = (19 * a + M) % 30;
	e = (2 * b + 4 * c + 6 * d + N) % 7;
 
	// Decidir entre los 2 casos:
	if (d + e < 10) { dia = d + e + 22; mes = 3; }
	else { dia = d + e - 9; mes = 4; }
 
	// Excepciones especiales
	if (dia == 26 && mes == 4) dia = 19;
	if (dia == 25 && mes == 4 && d == 28 && e == 6 && a > 10) dia = 18;
 
	return new DateTime(anyo, mes, dia);
}
 
void Main()
{
	DateTime domingo = GetEasterSunday(2014);
	DateTime jueves = domingo.AddDays(-3);
	DateTime viernes = domingo.AddDays(-2);
	DateTime lunes = domingo.AddDays(+1);
 
	//Console.WriteLine(domingo);
	Console.WriteLine("Jueves Santo -> " + jueves.ToShortDateString());
	Console.WriteLine("Viernes Santo -> " + viernes.ToShortDateString());
	Console.WriteLine("Lunes de Pascua -> " + lunes.ToShortDateString());
}
Esta es la salida al ejecutar el código anterior.

// Jueves Santo -> 17/04/2014
// Viernes Santo -> 18/04/2014
// Lunes de Pascua -> 21/04/2014
	
	
	
    **/
 
 
  } // End class

?>