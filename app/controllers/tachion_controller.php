<?php

  class TachionController extends AppController{

      var $name = 'Tachion';
      var $components = array('RequestHandler','Session');
      var $helpers = array('Html','Form','Ajax','Javascript','Js','GoogleMap','Pdf','GChart');
      var $uses = array(/*'Empresas',
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
			'IngresosCurrentTei'*/
			);


    function index(){
	pr($this->Flotas->find('all'));exit();
    }
    
    function tachion($indicator=null){
// 	pr($indicator);exit();
// 	pr($this->Flotas->find('all'));
      	$idx_empresa = $_SESSION['Auth']['User']['id_empresa'];
      	$year = date('Y');
    App::Import('Shell', 'Shell');
	App::Import('Vendor',array('shells/sniffer_data'));
	  $myShell = new SnifferDataShell(new Object());
	  $myShell->initialize();
// 	  Select the method to call
	  $Shell = $myShell->main($view=true,$debug=false);

// 	  pr($Shell['Toneladas']);exit();
	App::Import('Shell', 'Shell');
	App::Import('Vendor',array('shells/calendar'));
	  $myCalendar = new CalendarShell(new Object());
	  $myCalendar->initialize();
	  $months = $myCalendar->months(true,false,$year);
	
// 	App::Import('Shell', 'Shell');
// 	App::Import('Vendor',array('shells/flotas'));
// 	  $fleet = new FlotasShell(new Object());
// 	  $fleet->initialize();
// 	  $fleets = $fleet->fleets(true,false);
// 	pr($fleets);
// exit();
	
	App::import('Controller', 'Holiday');
	  $Holiday = new HolidayController;
	  $Holiday->constructClasses();

	  $startDate = date('Y-m-d',mktime('0','0','0',date('n'),'01',date('Y'))); // for CurrentMonth
	  $endDate = date('Y-m-d',mktime('0','0','0',date('n'),date('t'),date('Y'))); // for CurrentMonth
	  $GoToWork = $Holiday->RetrieveHolidays($startDate,$endDate,$debug=true,$year=date('Y'));
      pr($GoToWork);exit();

	  $toneladas_labour_days = $Shell['Toneladas']['DailyReport']['report_day'];
	  $kilometros_labour_days = $Shell['kms']['report_daily'];
	  $ingresos_labour_days = $Shell['ingresos']['report_daily'];
	
	  foreach($toneladas_labour_days as $id_empresa => $areas){
	   foreach($areas as $area_name => $meses){
		foreach($meses as $NombreMes => $fracciones){
		  foreach($fracciones as $NombreFraccion => $dias){
		    if(!empty($dias)){
		      foreach($dias as $id_dia => $tons_value){
				if($NombreMes == date('M')){
				  if(!empty($tons_value)){
					$dias_toneladas[$id_empresa][$area_name][$NombreMes][$NombreFraccion][$id_dia] = $tons_value;
				  }
				}
		      }
		    }
		  }
		}
	   }
	  }
	
	  foreach($kilometros_labour_days as $id_empresa => $areas){
	    foreach($areas as $area_name => $meses){
		foreach($meses as $NombreMes => $fracciones){
		  foreach($fracciones as $NombreFraccion => $dias){
		    foreach($dias as $id_dia => $kms_value){
		      if($NombreMes == date('M')){
			if(!empty($kms_value)){
			  $dias_kilometros[$id_empresa][$area_name][$NombreMes][$NombreFraccion][$id_dia] = $kms_value;
			}
		      }
		    }
		  }
		}
	    }
	  }
	  
	  foreach($ingresos_labour_days as $id_empresa => $areas){
	    foreach($areas as $area_name => $meses){
		foreach($meses as $NombreMes => $fracciones){
		  foreach($fracciones as $NombreFraccion => $dias){
		    foreach($dias as $id_dia => $ingresos_value){
		      if($NombreMes == date('M')){
			if(!empty($ingresos_value)){
			  $dias_ingresos[$id_empresa][$area_name][$NombreMes][$NombreFraccion][$id_dia] = $ingresos_value;
			}
		      }
		    }
		  }
		}
	    }
	  }
	      $promedio['toneladas'] = $dias_toneladas;
	      $promedio['kilometros'] = $dias_kilometros;
	      $promedio['ingresos'] = $dias_ingresos;
	  foreach($promedio as $indicador => $dias_indicador){
	    foreach($dias_indicador as $id_empresa => $area){
	      foreach($area as $area_name => $meses){
		foreach($meses as $meses_name => $fractiones){
		  foreach($fractiones as $fractiones_name => $days_pr){
		    $acum_men = array_sum($days_pr);
// 		    pr($acum_men);
		    $dias_laborados = count($days_pr);
		    $projection[$indicador][$id_empresa][$area_name][$meses_name][$fractiones_name] = ($acum_men/$dias_laborados)*$GoToWork;
		  }
		}
	      }
	    }
	  }
	  pr($projection);exit();
	  if(!isset($indicator)){
	    $this->set('projection',$projection);
	  }else{
	    $this->set('projection',$projection[$indicator]);
	  }
	  $this->set('months',$months);
	  
	  $today = null;
	
// 	  exit();
    }

    function tachionDetail($indicator=null){
// 	pr($indicator);exit();
// 	pr($this->Flotas->find('all'));

      	$idx_empresa = $_SESSION['Auth']['User']['id_empresa'];
      	$year = date('Y');
    App::Import('Shell', 'Shell');
	App::Import('Vendor',array('shells/sniffer_data'));
	  $myShell = new SnifferDataShell(new Object());
	  $myShell->initialize();
// 	  Select the method to call
	  $Shell = $myShell->main($view=true,$debug=false);

// 	  pr($Shell['Toneladas']);exit();
	App::Import('Shell', 'Shell');
	App::Import('Vendor',array('shells/calendar'));
	  $myCalendar = new CalendarShell(new Object());
	  $myCalendar->initialize();
	  $months = $myCalendar->months(true,false,$year);
	
	App::Import('Shell', 'Shell');
	App::Import('Vendor',array('shells/flotas'));
	  $fleet = new FlotasShell(new Object());
	  $fleet->initialize();
	  $fleets = $fleet->fleets(true,false);
	pr($fleets);
// exit();
	
	App::import('Controller', 'Holiday');
	  $Holiday = new HolidayController;
	  $Holiday->constructClasses();

	  $startDate = date('Y-m-d',mktime('0','0','0',date('n'),'01',date('Y'))); // for CurrentMonth
	  $endDate = date('Y-m-d',mktime('0','0','0',date('n'),date('t'),date('Y'))); // for CurrentMonth
	  $GoToWork = $Holiday->RetrieveHolidays($startDate,$endDate,$debug=true,$year=date('Y'));
//       pr($GoToWork);

	  $toneladas_labour_days = $Shell['Toneladas']['DailyReport']['report_day'];
	  $kilometros_labour_days = $Shell['kms']['report_daily'];
	  $ingresos_labour_days = $Shell['ingresos']['report_daily'];
	
	  foreach($toneladas_labour_days as $id_empresa => $areas){
	   foreach($areas as $area_name => $meses){
		foreach($meses as $NombreMes => $fracciones){
		  foreach($fracciones as $NombreFraccion => $dias){
		    if(!empty($dias)){
		      foreach($dias as $id_dia => $tons_value){
				if($NombreMes == date('M')){
				  if(!empty($tons_value)){
					$dias_toneladas[$id_empresa][$area_name][$NombreMes][$NombreFraccion][$id_dia] = $tons_value;
				  }
				}
		      }
		    }
		  }
		}
	   }
	  }
	
	  foreach($kilometros_labour_days as $id_empresa => $areas){
	    foreach($areas as $area_name => $meses){
		foreach($meses as $NombreMes => $fracciones){
		  foreach($fracciones as $NombreFraccion => $dias){
		    foreach($dias as $id_dia => $kms_value){
		      if($NombreMes == date('M')){
			if(!empty($kms_value)){
			  $dias_kilometros[$id_empresa][$area_name][$NombreMes][$NombreFraccion][$id_dia] = $kms_value;
			}
		      }
		    }
		  }
		}
	    }
	  }
	  
	  foreach($ingresos_labour_days as $id_empresa => $areas){
	    foreach($areas as $area_name => $meses){
		foreach($meses as $NombreMes => $fracciones){
		  foreach($fracciones as $NombreFraccion => $dias){
		    foreach($dias as $id_dia => $ingresos_value){
		      if($NombreMes == date('M')){
			if(!empty($ingresos_value)){
			  $dias_ingresos[$id_empresa][$area_name][$NombreMes][$NombreFraccion][$id_dia] = $ingresos_value;
			}
		      }
		    }
		  }
		}
	    }
	  }
	      $promedio['toneladas'] = $dias_toneladas;
	      $promedio['kilometros'] = $dias_kilometros;
	      $promedio['ingresos'] = $dias_ingresos;
	  foreach($promedio as $indicador => $dias_indicador){
	    foreach($dias_indicador as $id_empresa => $area){
	      foreach($area as $area_name => $meses){
		foreach($meses as $meses_name => $fractiones){
		  foreach($fractiones as $fractiones_name => $days_pr){
		    $acum_men = array_sum($days_pr);
// 		    pr($acum_men);
		    $dias_laborados = count($days_pr);
		    $projection[$indicador][$id_empresa][$area_name][$meses_name][$fractiones_name] = ($acum_men/$dias_laborados)*$GoToWork;
		  }
		}
	      }
	    }
	  }
	  pr($projection);exit();
	  if(!isset($indicator)){
	    $this->set('projection',$projection);
	  }else{
	    $this->set('projection',$projection[$indicator]);
	  }
	  $this->set('months',$months);
	  
	  $today = null;
	
// 	  exit();
    }

  }// End Class
?>