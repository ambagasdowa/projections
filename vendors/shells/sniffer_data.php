<?php
class SnifferDataShell extends Shell {
      var $uses = array('Empresas',
			'Areas',
			'AreasAtm',
			'AreasTei',
			'Flotas',
			'FlotasAtm',
			'FlotasTei',
			'TipoOperacion',
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

//     var $params = array('');


  function Empresas(){
	$EmpConditions['Empresas.active'] = '1'; // Check if the area is alive
// 	pr($this->Empresas->getEmpresas());
// 	$empresas = $this->find('list',array('conditions'=>$conditions,'fields'=>array('id_empresa','empresa')));
	$empresas = $this->Empresas->find('list',array('fields'=>array('id_empresa','empresa'),'conditions'=>$EmpConditions));
	$corp = null;
// 	pr($empresas);
	foreach($empresas as $key => $value){
	    if($key == '1'){
		    $_append[$key] = null;
	    }else{
		    $_append[$key]  = substr(ucwords(strtolower($value)),0,3);
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
// 	  Build the models
	  foreach($_append as $key => $value){
	      $model['area'][$key] = 'Areas'.$value;
	      $FindAreas[$key] = $this->$model['area'][$key]->find('list',array('fields'=>array('id_area','nombre')));
	  } // End main control structure foreach $_append
	  
	  
	  foreach($FindAreas as $k => $value){
// 	    $this->out(pr($value));
	    if( $k == '1' ){ // This is for Bonampak and always will be 
		  foreach($value as $key => $data){
			  $extracting[$k][$key] = explode('BONAMPAK',$data);
  // 		    if($extracting[$k][$key] == '1'){
			  $extract[$k][$key] = ucwords(strtolower($extracting[$k][$key]['1']));
  // 		    }
		  }
	    }else{
		  foreach($value as $key => $data){
		  $extract[$k][$key] = explode(' ',$data);
			if(isset($extract[$k][$key])){ // is $extract created?
				if(in_array('MACUSPANA' ,$extract[$k][$key])){
			  $extract[$k][$key] = ucwords(strtolower('MACUSPANA'));
			  break;
				}if(in_array('ESPECIALIZADA' ,$extract[$k][$key])){
			  $extract[$k][$key] = ucwords(strtolower('TEISA'));
			  break;
				}
			} // End $extract comprobation
		  }
	    } // End firts level struct if-else
	  }
	  
	  
	// Set the areas var
// 	  $this->out(pr($extract));
	  return $extract;
   }
  
  /** @function fleets()
   ** @param <set true to return data as variable> <set true to set the variables in view> 
   ** @var for both modes the returned var are in set mode :: $fleets = array($fleet,$flota)
   **/
   function fleets($return=null,$set=null){
	
		App::Import('Shell', 'Shell');
		App::Import('Vendor',array('shells/flotas'));
		  $fleet = new FlotasShell(new Object());
		  $fleet->initialize();
		  $fleets = $fleet->fleets(true,false);
		pr($fleets);
		exit();
	
// 	$_append = $this->Empresas();
// 	$fleets = $areas = $this->areas();
// 	$SearchFleets = $areas;
// 	pr($fleets); 
// 	exit();
	foreach($fleets as $id_empresa => $data){
	    $model[$id_empresa] = 'Flotas'.$_append[$id_empresa];
	    foreach($data as $id_area => $area){
// 		pr($area);
		$flota_[$id_empresa][trim($area)] = $this->$model[$id_empresa]->find('all');
// 		$SearchFleets[$id_empresa][trim($area)] = $flota_[$id_area]['TipoOperacion'.$_append[$id_empresa]];
// 		$TipoOperacion[$id_empresa][$id_area] = 'TipoOperacion'.$data;
		$Flotas[$id_empresa][$id_area] = 'Flotas'.$data;
	    }
	}
	foreach($flota_ as $id_empresa => $area){
// 	    pr($area);
	    foreach($area as $area_name => $desc){
// 		pr($desc);
		foreach($desc as $key => $data){
		
		    foreach($data['TipoOperacion'.$_append[$id_empresa]] as $id_flota => $values){
			$SearchFleets[$id_empresa][$area_name][$id_flota+1][$values['id_tipo_operacion']] = $values['tipo_operacion'];
		    }
		}
	    }
	
	}
	
	
	pr($SearchFleets);
// 	pr($model);
// 	pr($flota_);
	exit();
// 	pr($TipoOperacion);
// 	pr($Flotas);
	foreach($SearchFleets as $id_empresa => $flotas){
	      pr($flotas);
	  foreach($flotas as $id_flota => $flota){
// 	    pr($id_flota);
	    if(!isset($fleet[$id_empresa][$id_flota])){
	      $fleet[$id_empresa][$id_flota] = null;
	    }
	    $fleet[$id_empresa][$flota[$Flotas[$id_empresa]]['id_flota']] = trim($flota[$Flotas[$id_empresa]]['nombre']);
	    foreach($flota as $flotaEmp => $data){
		if($flotaEmp == $TipoOperacion[$id_empresa]){
		    foreach($data as $idx => $value){
// 		    		pr($fleet[$id_empresa][$id_flota]);
// 		    		pr($value['tipo_operacion']);
// 		    		$fleet[$id_empresa][$id_flota] .= ','.$value['id_tipo_operacion'];
// 			$fleet[$id_empresa] .= $value['id_tipo_operacion'];
		    }
		}

	    }
	    
	  }
	} // End of SearchFleets
// 	pr($fleet);
// 	pr($flt);
	exit();

// 	$flota['0'] = null;

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
// 	pr($area);
// 	pr($fleets);
// 	exit();
      if($return == false && $set == true){
	  $this->set('fleets',$fleets);
      }elseif($return == true && $set == false){
	  return $fleets;
      }
   } // End's function fleets()   
//     pr($fleets);exit();
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
    

     function RetrieveData($year=null,$fraction=null,$model=null,$criteria=null,$debug=null,$flotas=null){
	  
	 if(empty($year) OR !isset($year) ){
	   $year = date('Y');
	   $mes  = date('n');
	}else{
	  if($year < date('Y')){
		$mes = '12';
	  }elseif($year > date('Y')){
		exit();
	  }else{
		$mes = date('n');
	  }
	}
	
// 	var_dump($year);
// 	var_dump($mes);
// 	$year='2014';
// 	exit(); 
// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // //

     App::Import('Shell', 'Shell');
     App::Import('Vendor',array('shells/calendar'));
     $myCalendar = new CalendarShell(new Object());
     $myCalendar->initialize();
     $calendar = $myCalendar->main($year,false);
     $fraction_for_day = $this->Fraccion->find('list',array('fields'=>array('id','fraccion')));
     $reporte_diario = $criteria['kms'];

     foreach($reporte_diario as $id_empresa => $area){
		foreach($area as $area_name => $month){
			foreach($calendar['days'] as $month_name => $dia){
			  foreach($dia as $num_dia => $dia_detail){
				  foreach($fraction_for_day as $id_fraction => $fraction_desc){
					$dias[$id_empresa][$area_name][$month_name][$fraction_desc][$num_dia] = null;
				  }
			  }
			}
		}
     }
     
     
//      pr($dias);pr($reporte_diario);exit();

// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // //

     $_append = $this->Empresas();
     $areas = $this->areas();
     $months = $this->months($return=true,$set=false,$year);
// 	  var_dump($months);exit();
     $filter['area'] = true;
// pr($months);
     $toneladas = $criteria['toneladas'];
     $kms = $criteria['kms'];
     $ingresos = $criteria['ingresos'];
	 
     foreach($areas as $key =>$value){
       foreach( $value as $idx => $areadist){
	foreach($months as $ky =>$dat){
	  foreach($fraction as $llave => $dato){
	    if($dat['num'] <= $mes){
		$ConditionsToneladas[$key][trim($areadist)][$dat['short']][$dato][$model[$key]['tonelaje'].'.fecha_guia LIKE'] = "%".$year."-".$dat['numeric']."%";
		
		$ConditionsKms[$key][trim($areadist)][$dat['short']][$dato][$model[$key]['kms'].'.fecha_guia LIKE'] = "%".$year."-".$dat['numeric']."%";
		
		$ConditionsIngresos[$key][trim($areadist)][$dat['short']][$dato][$model[$key]['ingresos'].'.fecha_guia LIKE'] = "%".$year."-".$dat['numeric']."%";
		
	      if($filter['area'] == true){
	    // Only check the area , will assume that 0 are all areas -- remenber that zero value is taken as false
		$ConditionsToneladas[$key][trim($areadist)][$dat['short']][$dato][$model[$key]['tonelaje'].'.id_area'] = $idx;
		
		$ConditionsKms[$key][trim($areadist)][$dat['short']][$dato][$model[$key]['kms'].'.id_area'] = $idx;
		
		$ConditionsIngresos[$key][trim($areadist)][$dat['short']][$dato][$model[$key]['ingresos'].'.id_area'] = $idx;
		
	      }

	      if(isset($filter['flota'])){ // is $filter['flota'] over there ??
			if($filter['flota'] == true){ // is breathing ?
			  foreach($TpoOp as $k => $val){
				$ConditionsToneladas[$key][trim($areadist)][$dat['short']][$dato]['OR'][$k][$model[$key]['tonelaje'].'.id_tipo_operacion'] = $val;
		    
				$ConditionsKms[$key][trim($areadist)][$dat['short']][$dato]['OR'][$k][$model[$key]['kms'].'.id_tipo_operacion'] = $val;
		    
				$ConditionsIngresos[$key][trim($areadist)][$dat['short']][$dato]['OR'][$k][$model[$key]['ingresos'].'.id_tipo_operacion'] = $val;
			  }
			}
	      } // already have our answer
	      
	    $ConditionsToneladas[$key][trim($areadist)][$dat['short']][$dato][$model[$key]['tonelaje'].'.id_fraccion'] = $llave ;
	    
	    $ConditionsKms[$key][trim($areadist)][$dat['short']][$dato][$model[$key]['kms'].'.id_fraccion'] = $llave ;
	    
	    $ConditionsIngresos[$key][trim($areadist)][$dat['short']][$dato][$model[$key]['ingresos'].'.id_fraccion'] = $llave ;
	    
	    } // End if to current month dat[num]


	/** ALERT Scavenger
	 ** @var => Sniff in the Databases
	    @obj => Objetive Search for erroneous data in DB's only need one data to retrieve
	 **/
	    // See what's happend
	    if($dat['num'] > $mes){
	      $ConditionsToneladasWarning[$key][trim($areadist)][date('M',mktime('0','0','0',$dat['numeric'],'01',$year))][$dato][$model[$key]['tonelaje'].'.fecha_guia LIKE'] = "%".$year."-".$dat['numeric']."%";
	      
	      $ConditionsToneladasWarning[$key][trim($areadist)][date('M',mktime('0','0','0',$dat['numeric'],'01',$year))][$dato][$model[$key]['tonelaje'].'.id_fraccion'] = $llave ;

	      	if($filter['area'] == true){
	    // Only check the area , will assume that 0 are all areas -- remenber that zero value is taken as false
		  $ConditionsToneladasWarning[$key][trim($areadist)][date('M',mktime('0','0','0',$dat['numeric'],'01',$year))][$dato][$model[$key]['tonelaje'].'.id_area'] = $idx;
			}
	    }
	  } // End foreach fraction
	} //end foreach of months
       } // End seek of area distinction
      } // End foreach areas with fleets

//       pr($ConditionsToneladasWarning['1']['Orizaba']);exit();
// pr($ConditionsToneladas);exit();

    /** ALERT => Get the data from databases firts Toneladas then Kms and last Ingresos
     ** @var => no vars yet
     ** @params => unknow parameter yet
     ** @var => Set Toneladas arrays
     **/
// 	  pr($toneladas);
      $tons_sum = $report_warning = $report_day = $tonelaje = $toneladas;
// 	  var_dump($ConditionsToneladas);
      foreach($ConditionsToneladas as $id_empresa => $area){

		  foreach($area as $id_area => $mes){ // Retrieve data for each area
			foreach($mes as $month_name => $fraction){ // Retrieve data by month
			  foreach($fraction as $fraction_name => $query){ // And retrieve data for each fraction under month
			  $tonelaje[$id_empresa][trim($id_area)][$month_name][$fraction_name] = $this->$model[$id_empresa]['tonelaje']->find('all',array('conditions'=>$query));
			  }
			}
		  }

      } // End of the world for conditions Die!! areas Die!! XD!!!

//       pr($tonelaje);exit();
	$canceladas = $edicion = null;
	foreach($tonelaje as $id_empresa => $area){
	  foreach($area as $area_name => $mes){
		if(isset($mes)){ // fix for tonelaje
	    foreach($mes as $month_name => $GetFractionData){
	      foreach($GetFractionData as $FractionName => $GetData){
			foreach($GetData as $idx => $TonelajeCurrentData){
			  $toneladas[$id_empresa][$area_name][$month_name][$FractionName] += $TonelajeCurrentData[$model[$id_empresa]['tonelaje']]['peso'];

			  /** @param => Set the tonelaje by day  **/
			  $day = substr($TonelajeCurrentData[$model[$id_empresa]['tonelaje']]['fecha_guia'],8,2);
			  if(!isset($report_day[$id_empresa][$area_name][$month_name][$FractionName][$day])){
				$report_day[$id_empresa][$area_name][$month_name][$FractionName][$day] = null;
			  }

			  $report_day[$id_empresa][$area_name][$month_name][$FractionName][$day] += $TonelajeCurrentData[$model[$id_empresa]['tonelaje']]['peso'];
			  
			  
			  if(!isset($report_day_check[$id_empresa][$area_name][$month_name][$FractionName][$day][trim($TonelajeCurrentData[$model[$id_empresa]['tonelaje']]['num_guia'])]['peso'])){
				$report_day_check[$id_empresa][$area_name][$month_name][$FractionName][$day][trim($TonelajeCurrentData[$model[$id_empresa]['tonelaje']]['num_guia'])]['peso'] = null;
			  }
			  $report_day_check[$id_empresa][$area_name][$month_name][$FractionName][$day][trim($TonelajeCurrentData[$model[$id_empresa]['tonelaje']]['num_guia'])]['peso'] += $TonelajeCurrentData[$model[$id_empresa]['tonelaje']]['peso'];
			  
			  $report_day_check[$id_empresa][$area_name][$month_name][$FractionName][$day][trim($TonelajeCurrentData[$model[$id_empresa]['tonelaje']]['num_guia'])]['tipo_operacion'] = $TonelajeCurrentData[$model[$id_empresa]['tonelaje']]['id_tipo_operacion'];
			  
			  $report_day_check[$id_empresa][$area_name][$month_name][$FractionName][$day][trim($TonelajeCurrentData[$model[$id_empresa]['tonelaje']]['num_guia'])]['id_flota'] = $TonelajeCurrentData[$model[$id_empresa]['tonelaje']]['id_flota'];
			  
			  $report_day_check[$id_empresa][$area_name][$month_name][$FractionName][$day][trim($TonelajeCurrentData[$model[$id_empresa]['tonelaje']]['num_guia'])]['id_unidad'] = $TonelajeCurrentData[$model[$id_empresa]['tonelaje']]['id_unidad'];
			  
			/** @param => Check if peso is zero **/
			  if($TonelajeCurrentData[$model[$id_empresa]['tonelaje']]['peso'] == '0'){
				if(!isset($report_warning[$id_empresa][$area_name][$month_name][$FractionName][$day])){
				$report_warning[$id_empresa][$area_name][$month_name][$FractionName][$day][] = $TonelajeCurrentData[$model[$id_empresa]['tonelaje']]['num_guia'];
				}
			  }
			  // Marauder
			  /** @param => Check if tonelaje is overcharged  **/
			  if($TonelajeCurrentData[$model[$id_empresa]['tonelaje']]['peso'] > 60){
				$ToneladasWarningData[$id_empresa][$area_name][$month_name][$FractionName][] = $TonelajeCurrentData[$model[$id_empresa]['tonelaje']];
			  }
			  
	// 		  ByFleet
			}
	      }
	    }
	  }// end filtering of !isset months
	  }//End foreach area => mes
	}

	if($debug){
	  pr($ToneladasWarningData);
	  pr($toneladas);
	  pr($report_day);
	  pr($report_warning);
	}else{
	  $DataTons['DetailData']['toneladas'] = $toneladas;
	  $DataTons['DailyReport']['report_day'] = $report_day;
	  if(isset($ToneladasWarningData)){
		$DataTons['Warnings']['ToneladasWarningData'] = $ToneladasWarningData;
	  }
	  $DataTons['Warnings']['report_warning'] = $report_warning;
	  $DataTons['Warnings']['report_day_check_toneladas'] = $report_day_check;
	}
//   pr($DataTons);exit();
	foreach($toneladas as $id_empresa => $area){
// 	      pr($area);
	    foreach($area as $area_name => $month){
	      foreach($month as $month_name => $fracciones){
		$TotalByMonth[$id_empresa][$area_name][$month_name] = array_sum($fracciones);
		  foreach($fracciones as $fraction_name => $data){
		      if(!isset($TotalByFraction[$id_empresa][$area_name][$fraction_name])){
			  $TotalByFraction[$id_empresa][$area_name][$fraction_name] = null;
		      }
		      $TotalByFraction[$id_empresa][$area_name][$fraction_name] += $data;
		  }
	      }
	    }
	}

	if($debug){
	  pr($TotalByMonth);
	  pr($TotalByFraction);
	}else{
	  $DataTons['totals']['TotalByMonth'] = $TotalByMonth;
	  $DataTons['totals']['TotalByFraction'] = $TotalByFraction;
	}
	foreach($TotalByMonth as $id_empresa => $area){
	    foreach($area as $area_name => $fracciones){
		$TotalByYear[$id_empresa][$area_name] = array_sum($fracciones);
	    }
	}
	if($debug){
	  pr($TotalByYear);
	}else{
	  $DataTons['totals']['TotalByYear'] = $TotalByYear;
	}
	if(isset($DataTons)){
	    $Result['Toneladas'] = $DataTons;
	
	}

// 	pr($report_day_check_toneladas);
// 	exit();
// 	exit();

/** WARNING => @firts reset the vars that you going to need like totals
**  @Section Kms => Result['kms']
    @use => ConditionsKms
**/
// pr($ConditionsKms);exit();
	// KMS <---
	//glosary
//       tonelaje = kilometros
// 	 toneladas = kms
// 	 tons_sum = kms_sum
// 	 TonelajeCurrentData = KilometrosCurrentData

	$full = $kms_full = $kms_all = $kms_sum = $report_warning = $kilometros = $count_month = $kms;
	$report_day_all = $report_day_full = $report_day = $report_day_plus = $dias;
	/*$count_day_merge =*/ $count_day_all = $count_day_full = /*$count_day =*/ $dias ;
	$test = $query = $toneladas = null;
      foreach($ConditionsKms as $id_empresa => $area){
		foreach($area as $id_area => $mes){ // Retrieve data for each area
		  foreach($mes as $month_name => $fraction){ // Retrieve data by month
			foreach($fraction as $fraction_name => $query){ // And retrieve data for each fraction under month
			  $kilometros[$id_empresa][trim($id_area)][$month_name][$fraction_name] = $this->$model[$id_empresa]['kms']->find('all',array('conditions'=>$query));
			}
		  }
		}
      } // End of the world for conditions Die!! areas Die!! XD!!!
// 		pr($kilometros['1']);
// 		pr($ConditionsKms['1']);
// 		var_dump($id_empresa);
// 		exit();
	$canceladas = $edicion = null;
	foreach($kilometros as $id_empresa => $area){
	  foreach($area as $area_name => $mes){
	    foreach($mes as $month_name => $GetFractionData){
	      foreach($GetFractionData as $FractionName => $GetData){
			foreach($GetData as $idx => $KilometrosCurrentData){
		  /** WARNING WARNING WARNING  @fix @kms from @detail ****/
// 		    issues for kms->sencillo are the same as for kms->full can have n->"cartas porte" for a onlyone dispatch so in consequence use the same logic for both and can use only one recurrence track for both otherside i use separates trackings just in case the need of know data of each of them
		  /** WARNING WARNING WARNING  @continue work form hir ****/
			  if($KilometrosCurrentData[$model[$id_empresa]['kms']]['id_configuracionviaje'] == '3'){
				  /** @param => Set kilometros by day full **/
				  /** NOTE if the fraction is others then use kms_real */
				  if(trim((string)$FractionName) === 'Granel' OR trim((string)$FractionName) === 'Envasado' OR trim((string)$FractionName) === 'Clinker' ){
						$tripKms = 'kms_viaje';
				  }else{
						$tripKms = 'kms_real';
				  }
				  $kms_day_full[$id_empresa][$area_name][$month_name][$FractionName][$KilometrosCurrentData[$model[$id_empresa]['kms']]['no_viaje']][substr($KilometrosCurrentData[$model[$id_empresa]['kms']]['fecha_guia'],8,2)] = $KilometrosCurrentData[$model[$id_empresa]['kms']][$tripKms];

/** WARNING*/
				  if(!isset($full[$id_empresa][$area_name][$month_name][$FractionName][$KilometrosCurrentData[$model[$id_empresa]['kms']]['no_viaje']][substr($KilometrosCurrentData[$model[$id_empresa]['kms']]['fecha_guia'],8,2)])){
					$full[$id_empresa][$area_name][$month_name][$FractionName][$KilometrosCurrentData[$model[$id_empresa]['kms']]['no_viaje']][substr($KilometrosCurrentData[$model[$id_empresa]['kms']]['fecha_guia'],8,2)]= null;
				  }if(isset($KilometrosCurrentData[$model[$id_empresa]['kms']]['num_guia'])){
					$full[$id_empresa][$area_name][$month_name][$FractionName][$KilometrosCurrentData[$model[$id_empresa]['kms']]['no_viaje']][substr($KilometrosCurrentData[$model[$id_empresa]['kms']]['fecha_guia'],8,2)] = $KilometrosCurrentData[$model[$id_empresa]['kms']]['num_guia'];
				  }

				  foreach($kms_day_full[$id_empresa][$area_name][$month_name][$FractionName][$KilometrosCurrentData[$model[$id_empresa]['kms']]['no_viaje']] as $valueKms){
					if( count($kms_day_full[$id_empresa][$area_name][$month_name][$FractionName][$KilometrosCurrentData[$model[$id_empresa]['kms']]['no_viaje']]) > 1 ){
						// NOTE ok then assuming this is happeng always how to know in which day add the --
						// NOTE counting travel and add the kilometers , in the total is ok but in the detail 
						// NOTE we have the diferences in which day will put the data ???
						$counting = count($kms_day_full[$id_empresa][$area_name][$month_name][$FractionName][$KilometrosCurrentData[$model[$id_empresa]['kms']]['no_viaje']]);
						
						
						// NOTE if pass still be > 1 then 
							array_pop($kms_day_full[$id_empresa][$area_name][$month_name][$FractionName][$KilometrosCurrentData[$model[$id_empresa]['kms']]['no_viaje']]);

						pr($kms_day_full[$id_empresa][$area_name][$month_name][$FractionName][$KilometrosCurrentData[$model[$id_empresa]['kms']]['no_viaje']]);
// 						$this->out('travel => '.$KilometrosCurrentData[$model[$id_empresa]['kms']]['no_viaje'].' month => '.$month_name.' Area => '.$area_name.' Sencillo and have => '.$counting.' records');
					}
				  }

/** WARNING*/
				  
			  }elseif( $KilometrosCurrentData[$model[$id_empresa]['kms']]['id_configuracionviaje'] == '2' OR $KilometrosCurrentData[$model[$id_empresa]['kms']]['id_configuracionviaje'] == '1' ){
				  /** @param => Set kilometros by day kms_sencillo **/
				  /** NOTE if the fraction is others then use kms_real */
				  if(trim((string)$FractionName) === 'Granel' OR trim((string)$FractionName) === 'Envasado' OR trim((string)$FractionName) === 'Clinker' ){
						$tripKms = 'kms_viaje';
				  }else{
						$tripKms = 'kms_real';
				  }
				  $kms_day_all[$id_empresa][$area_name][$month_name][$FractionName][$KilometrosCurrentData[$model[$id_empresa]['kms']]['no_viaje']][substr($KilometrosCurrentData[$model[$id_empresa]['kms']]['fecha_guia'],8,2)] = $KilometrosCurrentData[$model[$id_empresa]['kms']][$tripKms];
/** WARNING*/
				  if(!isset($sencillo[$id_empresa][$area_name][$month_name][$FractionName][$KilometrosCurrentData[$model[$id_empresa]['kms']]['no_viaje']][substr($KilometrosCurrentData[$model[$id_empresa]['kms']]['fecha_guia'],8,2)])){
					$sencillo[$id_empresa][$area_name][$month_name][$FractionName][$KilometrosCurrentData[$model[$id_empresa]['kms']]['no_viaje']][substr($KilometrosCurrentData[$model[$id_empresa]['kms']]['fecha_guia'],8,2)] = null;
				  }if(isset($KilometrosCurrentData[$model[$id_empresa]['kms']]['num_guia'])){
					$sencillo[$id_empresa][$area_name][$month_name][$FractionName][$KilometrosCurrentData[$model[$id_empresa]['kms']]['no_viaje']][substr($KilometrosCurrentData[$model[$id_empresa]['kms']]['fecha_guia'],8,2)] = $KilometrosCurrentData[$model[$id_empresa]['kms']]['num_guia'];
				  }
				
				  foreach($kms_day_all[$id_empresa][$area_name][$month_name][$FractionName][$KilometrosCurrentData[$model[$id_empresa]['kms']]['no_viaje']] as $valuesKms){
					if(count($kms_day_all[$id_empresa][$area_name][$month_name][$FractionName][$KilometrosCurrentData[$model[$id_empresa]['kms']]['no_viaje']]) > 1){
						// NOTE ok then assuming this is happeng always how to know in which day add the --
						// NOTE counting travel and add the kilometers , in the total is ok but in the detail 
						// NOTE we have the diferences in which day will put the data ???
						$counting = count($kms_day_all[$id_empresa][$area_name][$month_name][$FractionName][$KilometrosCurrentData[$model[$id_empresa]['kms']]['no_viaje']]);
						
							array_pop($kms_day_all[$id_empresa][$area_name][$month_name][$FractionName][$KilometrosCurrentData[$model[$id_empresa]['kms']]['no_viaje']]);

						pr($kms_day_all[$id_empresa][$area_name][$month_name][$FractionName][$KilometrosCurrentData[$model[$id_empresa]['kms']]['no_viaje']]);
// 						$this->out('travel => '.$KilometrosCurrentData[$model[$id_empresa]['kms']]['no_viaje'].' month => '.$month_name.' Area => '.$area_name.' Sencillo and have => '.$counting.' records');
					}
				  }

/** WARNING*/
			  }
			  
			}
	      }
	    }
	  }
	}
// 	  pr($kilometros);
// 	  exit();
// 	  pr($kms_day_full['1']['Tijuana']['Mar']);
// 	  pr($kms_day_all['1']['Tijuana']['Mar']);
// 	  exit();
// 	  pr($full);
// 	  pr($sencillo);
// 	  exit();
// 	  pr(count($kms_day_all['1']['Orizaba']['Nov']['Granel']));
// 	  exit();
	foreach($kms_day_full as $id_empresa => $area){
	  foreach($area as $area_name => $month){
	    foreach($month as $month_name => $fractions_data){
	      foreach($fractions_data as $fraction_name => $viaje){
			if($viaje !== null){ // fix for empty fractions_data like Envasado ProductosVarios etc
			  foreach($viaje as $no_viaje => $kms_viaje_full){
				foreach($kms_viaje_full as $day_kms => $kms_value){
				  if(!isset($report_day_full[$id_empresa][$area_name][$month_name][$fraction_name][$day_kms])){
					$report_day_full[$id_empresa][$area_name][$month_name][$fraction_name][$day_kms] = null;
				  }
					$report_day_full[$id_empresa][$area_name][$month_name][$fraction_name][$day_kms] += $kms_value;
				  if(!isset($count_day_full[$id_empresa][$area_name][$month_name][$fraction_name][$day_kms])){
					$count_day_full[$id_empresa][$area_name][$month_name][$fraction_name][$day_kms] = null;
				  }
					$count_day_full[$id_empresa][$area_name][$month_name][$fraction_name][$day_kms] += 1;
// 					if($no_viaje == '8211'){
// 						pr($no_viaje);
// 					}

// // // // // // // @make detail
// 				  if(!isset($count_day_full_detail[$id_empresa][$area_name][$month_name][$fraction_name][$day_kms])){
// 					$count_day_full_detail[$id_empresa][$area_name][$month_name][$fraction_name][$day_kms] = null;
// 				  }
// 					$count_day_full_detail[$id_empresa][$area_name][$month_name][$fraction_name][$day_kms][] = $no_viaje;
// // // // // // // @make detail
/** WARNING*/
					
				  if(!isset($count_day_full_detail[$id_empresa][$area_name][$month_name][$fraction_name][$day_kms])){
					$count_day_full_detail[$id_empresa][$area_name][$month_name][$fraction_name][$day_kms] = null;
				  }
					$count_day_full_detail[$id_empresa][$area_name][$month_name][$fraction_name][$day_kms][$no_viaje] = $full[$id_empresa][$area_name][$month_name][$fraction_name][$no_viaje][$day_kms];
/** WARNING*/
					
				}
			  }
			}
	      }
	    }
	  }
	} // end $kms_sum

	
	foreach($kms_day_all as $id_empresa => $area){
	  foreach($area as $area_name => $month){
	    foreach($month as $month_name => $fractions_data){
	      foreach($fractions_data as $fraction_name => $viaje){
			if($viaje !== null){ // fix for empty fractions_data like Envasado ProductosVarios etc
			  foreach($viaje as $no_viaje => $kms_viaje_all){
				foreach($kms_viaje_all as $day_kms => $kms_value){
				  if(!isset($report_day_all[$id_empresa][$area_name][$month_name][$fraction_name][$day_kms])){
	// 			if var not exists then build it
					$report_day_all[$id_empresa][$area_name][$month_name][$fraction_name][$day_kms] = null;
				  }
					$report_day_all[$id_empresa][$area_name][$month_name][$fraction_name][$day_kms] += $kms_value;
				  if(!isset($count_day_all[$id_empresa][$area_name][$month_name][$fraction_name][$day_kms])){
	// 			if var not exists then build it
					$count_day_all[$id_empresa][$area_name][$month_name][$fraction_name][$day_kms] = null;
				  }
					$count_day_all[$id_empresa][$area_name][$month_name][$fraction_name][$day_kms] += 1;

// // // // // // // // // detail of counting
// 				  if(!isset($count_day_all_detail[$id_empresa][$area_name][$month_name][$fraction_name][$day_kms])){
// 					$count_day_all_detail[$id_empresa][$area_name][$month_name][$fraction_name][$day_kms] = null;
// 				  }
// 					$count_day_all_detail[$id_empresa][$area_name][$month_name][$fraction_name][$day_kms][] = $no_viaje;
// // // // // // // // //
					
/** WARNING*/
				  if(!isset($count_day_all_detail[$id_empresa][$area_name][$month_name][$fraction_name][$day_kms])){
					$count_day_all_detail[$id_empresa][$area_name][$month_name][$fraction_name][$day_kms] = null;
				  }
					$count_day_all_detail[$id_empresa][$area_name][$month_name][$fraction_name][$day_kms][$no_viaje] = $sencillo[$id_empresa][$area_name][$month_name][$fraction_name][$no_viaje][$day_kms];
/** WARNING*/
					
				}
			  }
			}
		  }
	    }
	  }
	} // end $kms_sum
// 	pr($kms_day_all);
// 	pr($kms_day_full);
// // 	pr($count_day_full);
// // 	pr($count_day_all);
// 	pr($count_day_full_detail);
// 	pr($count_day_all_detail);
// // // 	exit();
// 	pr($counting_day_full_detail);
// 	pr($counting_day_all_detail);
// 	unset($count_day_full_detail);
// 	unset($count_day_all_detail);
// 	$count_day_all_detail = $count_day_full_detail = null;
// 	$count_day_full_detail = $counting_day_full_detail;
// 	$count_day_all_detail = $counting_day_all_detail;
// 	pr($kms_day_full['1']['Tijuana']['Mar']);
// 	pr($kms_day_all['1']['Tijuana']['Mar']);
// 		pr($count_day_full_detail['1']['Tijuana']['Mar']);
// 		pr($count_day_all_detail['1']['Tijuana']['Mar']);

// 	pr($count_day_full['1']['Tijuana']['Mar']['Granel']);
// 	pr($count_day_all['1']['Tijuana']['Mar']['Granel']);
// 	exit();
// // 	exit();
	foreach($report_day as $id_empresa => $area){
	  foreach($area as $area_name => $month){
	    foreach($month as $month_name => $fractions_data){
// 		if(!isset($kms_day[$id_empresa][$area_name][$month_name])){
// 		      $kms_day[$id_empresa][$area_name][$month_name] = null;
// 		  }
	      foreach($fractions_data as $fraction_name => $month_days){
			foreach($month_days as $dia_kms => $value_kms){
			  if(!empty($report_day_all[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms]) OR !empty($report_day_full[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms])){
				$report_day[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms] = $report_day_full[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms] + $report_day_all[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms];
				
				// NOTE if one day you need made changes for otros
				// NOTE and now that day comes to live jajajaja NOTE
				if(trim((string)$fraction_name) === 'Granel' OR trim((string)$fraction_name) === 'Envasado' OR trim((string)$fraction_name) === 'Clinker'){
					$report_day_plus[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms] = ($report_day_full[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms] + $report_day_all[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms])*2;
				}else{
					$report_day_plus[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms] = ($report_day_full[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms] + $report_day_all[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms]);
				}

			  }

			  if(!empty($count_day_all[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms]) OR !empty($count_day_full[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms])){
				//counting trips
				if(!isset($count_day[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms])){
				  $count_day[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms] = null;
				}
				$count_day[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms] = $count_day_full[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms] + $count_day_all[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms];
				
				/**
				 * @first ask if is an array or exists but this is implicit right!!! on not ?
				 */

				if( (isset($count_day_full_detail[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms]) AND is_array($count_day_full_detail[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms])) AND ( isset($count_day_all_detail[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms]) AND is_array($count_day_all_detail[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms])) ){

				if(!isset($count_day_merge[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms])){
				  $count_day_merge[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms] = null;
				}

				  $count_day_merge[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms] = array_merge_recursive($count_day_full_detail[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms] , $count_day_all_detail[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms]);

				}else{//hir goes the else

				  if(isset($count_day_full_detail[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms])){
					if(!isset($count_day_merge[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms])){
					  $count_day_merge[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms] = null;
					}
					$count_day_merge[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms] = $count_day_full_detail[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms];
				  }if(isset($count_day_all_detail[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms])){
					if(!isset($count_day_merge[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms])){
					  $count_day_merge[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms] = null;
					}
					$count_day_merge[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms] = $count_day_all_detail[$id_empresa][$area_name][$month_name][$fraction_name][$dia_kms];
				  }
				}

			  }//End if not empty
			}
	      }
	    }
	  }
	}
// 	pr($count_day_full_detail);exit();
// 	pr($count_day_all_detail);exit();
// 	pr($count_day_merge);
// exit();
// $log = $this->Model->getDataSource()->getLog(false, false);
// debug($log);
// 	pr($report_day);exit();//for operations this is the correct param
// 	pr($report_day_all);pr($report_day_full); // this is for DailyReport()
	foreach($report_day_full as $id_empresa => $area){
	  foreach($area as $area_name => $month){
	    foreach($month as $month_name => $fractions_data){
		if(!isset($kms_sum[$id_empresa][$area_name][$month_name])){
		      $kms_sum[$id_empresa][$area_name][$month_name] = null;
		  }
	      foreach($fractions_data as $fraction_name => $viaje){
			if(!isset($kms_sum[$id_empresa][$area_name][$month_name][$fraction_name])){
				$kms_sum[$id_empresa][$area_name][$month_name][$fraction_name] = null;
			}
				// NOTE if one day you need made changes for otros
				// NOTE and now that day comes to live jajajaja NOTE
			if(trim((string)$fraction_name) === 'Granel' OR trim((string)$fraction_name) === 'Envasado' OR trim((string)$fraction_name) === 'Clinker'){
				$kms_sum[$id_empresa][$area_name][$month_name][$fraction_name] += (array_sum($report_day_full[$id_empresa][$area_name][$month_name][$fraction_name])+array_sum($report_day_all[$id_empresa][$area_name][$month_name][$fraction_name]))*2;
			}else{
				$kms_sum[$id_empresa][$area_name][$month_name][$fraction_name] += (array_sum($report_day_full[$id_empresa][$area_name][$month_name][$fraction_name])+array_sum($report_day_all[$id_empresa][$area_name][$month_name][$fraction_name]));
			}
				// NOTE if one day you need made changes for otros
				// NOTE and now that day comes to live jajajaja NOTE
			if(isset($count_day[$id_empresa][$area_name][$month_name][$fraction_name])){
// 			  $count_month[$id_empresa][$area_name][$month_name][$fraction_name] = null;
			  $count_month[$id_empresa][$area_name][$month_name][$fraction_name] = array_sum($count_day[$id_empresa][$area_name][$month_name][$fraction_name]);
			  if(!isset($count_year[$id_empresa][$area_name][$fraction_name])){
				$count_year[$id_empresa][$area_name][$fraction_name] = null;
			  }
			  $count_year[$id_empresa][$area_name][$fraction_name] += array_sum($count_day[$id_empresa][$area_name][$month_name][$fraction_name]);
			}
	      }
	    }
	  }
	}
// 	pr($count_day);exit();
// 	pr($count_month);
// 	exit();
// 	pr($kms_sum);exit(); // this is for fraction report by month
	foreach($kms_sum as $id_empresa => $area){
	  foreach($area as $area_name => $month){
	    
		foreach($month as $month_name => $fractions_data){
	      foreach($fractions_data as $fraction => $value){
			if(!isset($kms_monthly[$id_empresa][$area_name][$month_name])){
			  $kms_monthly[$id_empresa][$area_name][$month_name] = null;
			}
			  $kms_monthly[$id_empresa][$area_name][$month_name] += $value;
	      }

	      if(isset($count_month[$id_empresa][$area_name][$month_name])){
			$count_month_no_fraction[$id_empresa][$area_name][$month_name] = array_sum($count_month[$id_empresa][$area_name][$month_name]);
		  }
		  

	    }
	  }
	}

// 	pr($kms_monthly); // totals by month
// 	exit();
// yearly report
// 	pr($count_year);exit();
	foreach($kms_monthly as $id_empresa => $area){
	  foreach($area as $area_name => $month){
	      $kms_yearly[$id_empresa][$area_name] = array_sum($month);
	      if(!isset($count_year_no_fraction[$id_empresa][$area_name])){
			$count_year_no_fraction[$id_empresa][$area_name] = null;
		  }
		  if(isset($count_year[$id_empresa][$area_name])){
			$count_year_no_fraction[$id_empresa][$area_name] = array_sum($count_year[$id_empresa][$area_name]);
		  }
	  }
	}
// 	pr($count_year_no_fraction);exit();
// 	pr($kms_yearly); // Totals by Year
	foreach($kms_yearly as $id_empresa => $area_name ){
	  $kms_full_year[$id_empresa] = array_sum($area_name);
	}

	$kms_detail = array();
	$kms_detail['report_day_all'] = $report_day_all;
	$kms_detail['report_day_full'] = $report_day_full;
	$kms_detail['report_daily'] = $report_day;
	$kms_detail['report_daily_plus'] = $report_day_plus;
	$kms_detail['kms_month_by_fraction'] = $kms_sum;
	$kms_detail['total_kms_monthly'] =$kms_monthly;
	$kms_detail['total_kms_yearly'] = $kms_yearly;
	$kms_detail['full_total_kms_yearly'] = $kms_full_year;
	
	//Counting trips...
	$kms_detail['count']['count_day_all'] = $count_day_all; //count all "sencillos" by empresa,area,month,fraction and day
	$kms_detail['count']['count_day_full'] = $count_day_full; // same as before but is for "full"

	$kms_detail['count']['count_day'] = $count_day; // sum of both count's before and classified by day
	$kms_detail['count']['count_month'] = $count_month; // the sum counting by id_empresa, area, month and fraction
	$kms_detail['count']['count_month_no_fraction'] = $count_month_no_fraction; //same as before with out fraction
	$kms_detail['count']['count_year'] = $count_year ; //sum of all the months by area yearly by fraction
	$kms_detail['count']['count_year_no_fraction'] = $count_year_no_fraction;//sum of all the months by area yearly without fraction
	$kms_detail['count']['count_day_merge'] = $count_day_merge;

// 	pr($kms_detail['count']);
// 	exit();
	$Result['kms'] = $kms_detail;
	if($debug){
	  pr($Result['kms']);
	}

/** WARNING => @firts reset the vars that you going to need like totals
**  @Section Ingresos => Result['ingresos']
    @use => ConditionsIngresos
**/
	//INGRESOS <---
	$report_warning = $ingresos;
	$report_day_all = $report_day_full = $report_day = $dias;
	$test = $query = null;
      foreach($ConditionsIngresos as $id_empresa => $area){
		foreach($area as $id_area => $mes){ // Retrieve data for each area
		  foreach($mes as $month_name => $fraction){ // Retrieve data by month
			foreach($fraction as $fraction_name => $query){ // And retrieve data for each fraction under month
			$ingresos[$id_empresa][trim($id_area)][$month_name][$fraction_name] = $this->$model[$id_empresa]['ingresos']->find('all',array('conditions'=>$query));
			}
		  }
		}
      } // End of the world for conditions Die!! areas Die!! XD!!!
//       pr($ingresos);exit();
// 	 pr($model);
//       exit();
	$canceladas = $edicion = null;
	foreach($ingresos as $id_empresa => $area){
	  foreach($area as $area_name => $mes){
	    foreach($mes as $month_name => $GetFractionData){
	      foreach($GetFractionData as $FractionName => $GetData){
			foreach($GetData as $idx => $IngresosCurrentData){
	// 		  pr($IngresosCurrentData);
				  /** @param => Set ingresos by day full **/
				if(!isset($ingresos_day[$id_empresa][$area_name][$month_name][$FractionName][substr($IngresosCurrentData[$model[$id_empresa]['ingresos']]['fecha_guia'],8,2)])){
				  $ingresos_day[$id_empresa][$area_name][$month_name][$FractionName][substr($IngresosCurrentData[$model[$id_empresa]['ingresos']]['fecha_guia'],8,2)]= null;
				}
				
				$ingresos_day[$id_empresa][$area_name][$month_name][$FractionName][substr($IngresosCurrentData[$model[$id_empresa]['ingresos']]['fecha_guia'],8,2)] += $IngresosCurrentData[$model[$id_empresa]['ingresos']]['subtotal'];
// 				  pr($ingresos_day[$id_empresa][$area_name][$month_name][$FractionName][substr($IngresosCurrentData[$model[$id_empresa]['ingresos']]['fecha_guia'],8,2)]);
// 				  pr($IngresosCurrentData[$model[$id_empresa]['ingresos']]['subtotal']);
			}
	      }
	    }
	  }
	}
// 	pr($ingresos_day);exit();
	foreach($ingresos_day as $id_empresa => $Areas){
	  foreach($Areas as $AreasName => $months_){
		foreach($months_ as $months_Name => $fractions_){
		  foreach($fractions_ as $fractions_Name => $fractionValue){
			$ingresos_by_month[$id_empresa][$AreasName][$months_Name][$fractions_Name] = array_sum($fractionValue);
		  }
		}
	  }
	}
	
	$ingresos_detail = array();
	$ingresos_detail['report_daily'] = $ingresos_day;
	$ingresos_detail['ingresos_month_by_fraction'] = $ingresos_sum = null; // pending 
	$ingresos_detail['total_ingresos_monthly'] =$ingresos_by_month ;// Done 
// 	$ingresos_detail['totalIngresosByMonth'] =$ingresos_by_month ;// Done 
	$ingresos_detail['total_ingresos_yearly'] = $ingresos_yearly = null;// pending 
	$Result['ingresos'] = $ingresos_detail;

// 	pr($this->fleets(true,false));
// 	exit();
	return $Result;
     } // End of SnifferDataShell

     function detail($debug=null,$year=null){
		$_append = $this->Empresas();
		$areas =   $this->areas();

		if(empty($year) OR !isset($year) ){
		  $year = date('Y');
		  $mes  = date('n');
		}else{
		  if($year < date('Y')){
			$mes = '12';
		  }elseif($year > date('Y')){
			exit();
		  }else{
			$mes = date('n');
		  }
		}
// 	var_dump($year);
//  ALERT this can change having the table.db
/** ALERT  => TODO rebuild the structure according to the new approach
    @param => This is going inside of _append loop to buid fraction for each Empresa
**/
	$TpoOp = explode(',',$filter['flota']=null); // this select which is calculating ALERT @param => Expecting
	
	$months = $this->months($return=true,$set=false,$year);
	$fraction = $this->Fraccion->find('list',array('fields'=>array('id','fraccion')));
	
	foreach($areas as $key => $data){
	    for($i=1;$i<=$mes;$i++){
	      foreach($data as $idx => $content){
		$toneladas[$key][trim($content)][date('M',mktime('0','0','0',$i,'01',$year))] = null ;
		$kms[$key][trim($content)][date('M',mktime('0','0','0',$i,'01',$year))] = null ;
		$ingresos[$key][trim($content)][date('M',mktime('0','0','0',$i,'01',$year))] = null ;
		foreach($fraction as $h => $d ){
		  $toneladas[$key][trim($content)][date('M',mktime('0','0','0',$i,'01',$year))][$d] = null;
		  $kms[$key][trim($content)][date('M',mktime('0','0','0',$i,'01',$year))][$d] = null;
		  $ingresos[$key][trim($content)][date('M',mktime('0','0','0',$i,'01',$year))][$d] = null;
		  $TotalByFraction[$key][trim($content)][$d] = null; // pending ...
		}
	      }
	    }
	} // End of each area
	// Building the models for each Empresa
	foreach($_append as $k => $v){

	    $model[$k]['tonelaje'] = 'TonelajeCurrent'.$_append[$k];
	    $model[$k]['kms'] = 'KmsCurrent'.$_append[$k];
	    $model[$k]['ingresos'] = 'IngresosCurrent'.$_append[$k];

	} // End of retrieve _append Enterprise array
	
// 	unset($toneladas);
// 	unset($kms);
// 	unset($toneladas);
	if(!isset($toneladas) && !isset($kms) && !isset($ingresos)){
	    pr('warning => Criteria :error'."\n"."SnifferDataShell::detail()\n@params => criteria,debug");exit();
	}else{
	   if(isset($toneladas)){
		$criteria['toneladas'] = $toneladas;
	   }else{
		$criteria['toneladas'] = null;
	   }if(isset($kms)){
		$criteria['kms'] = $kms;
	   }else{
		$criteria['kms'] = null;
	   }if(isset($ingresos)){
		$criteria['ingresos'] = $ingresos;
	   }else{
		$criteria['ingresos'] = null;
	   }
	}
	
	if($debug){
	    pr($this->RetrieveData($year,$fraction,$model,$criteria,$debug,$flotas=null));
	}else{
	    return($this->RetrieveData($year,$fraction,$model,$criteria,$debug,$flotas=null));
	}
// 	exit();
      } // End of Detail


    function main($view=null,$debug=null,$year=null){
    
	// 	 $debug = true;
		$CurrentMonth = date('m');
		if(empty($year) OR !isset($year)){
		  $year = date('Y');
		}
// 		$year = '2014';
// 		var_dump($year);
// 		exit();
		$CurrentYear = $year;
		$_append = $this->Empresas();
		$areas = $this->areas();
		$months = $this->months(true,false,$CurrentYear);
		$ThisArea = $areas;
		$NumDays = date('t',mktime('0','0','0',$CurrentMonth,'01',$CurrentYear));
		  
		  if($debug){
			$this->out(pr($this->detail($debug,$CurrentYear)));
		  }else{
			return $this->detail($debug=null,$CurrentYear);
		  }

     } 

} // End Class
?> 
