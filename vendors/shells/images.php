<?php
class ImagesShell extends Shell {
      var $uses = array('Empresas','Operacion','OperacionMensual','Fleets','FleetsAtm','FleetsTei','Presupuesto',
			'Areas',
			'AreasAtm',
			'AreasTei',
			'Flotas',
			'FlotasAtm',
			'FlotasTei',
			'TipoOperacion',
			'TipoOperacionAtm',
			'TipoOperacionTei',
			'Fraccion'
// 			'TonelajeCurrent',
// 			'TonelajeCurrentAtm',
// 			'TonelajeCurrentTei',
// 			'KmsCurrent',
// 			'KmsCurrentAtm',
// 			'KmsCurrentTei',
// 			'IngresosCurrent',
// 			'IngresosCurrentAtm',
// 			'IngresosCurrentTei'
			);
			
//     var $params = array('');
    
	function Empresas(){
	  $EmpConditions['Empresas.active'] = '1'; // Check if the area is alive
	  $empresas = $this->Empresas->find('list',array('fields'=>array('id_empresa','empresa'),array('conditions'=>$EmpConditions)));
	  $corp = null;
	  
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
		
		return $extract;
	}
	

    
    function buildVars($year=null,$debug=null){

	  $year=date('Y');
		App::Import('Shell', 'Shell');
		App::Import('Vendor',array('shells/calendar'));
		$myCalendar = new CalendarShell(new Object());
		$myCalendar->initialize();
  // 	  $calendar = $myCalendar->main($year=date('Y'),false);
		$month = $myCalendar->months(true,false,$year);
		$empresas = $this->Empresas();
	  $tipoOperacion = array('1'=>'toneladas','2'=>'kilometros','3'=>'ingresos','4'=>'viajes');//not same TipoOperacion from lis data
	  $conditions['Operacion.year'] = $year;
// 	  $conditions['Operacion.id_empresa'] = '1';
// 	  $conditions['Operacion.tipoOperacion'] = '1';
// 	  $confitions['Operacion.area']

	 $dailyChart = $dailyOperation = $this->Operacion->find('all',array('conditions'=>$conditions));

// 	  foreach($dailyOperation as $idOp => $operacionContainer){
// 		foreach($operacionContainer as $operacionLabel => $operacionDescription){
// 		  foreach($operacionDescription as $operacionField => $operacionValue){
// 			$Operations[$operacionDescription['id_empresa']][$tipoOperacion[$operacionDescription['tipoOperacion']]][$operacionDescription['area']][$operacionDescription['numMes']]/*[$operacionDescription['fraccion']]*/[$operacionDescription['day']] = round($operacionDescription['operacion']);
// 			$days[$operacionDescription['id_empresa']][$tipoOperacion[$operacionDescription['tipoOperacion']]][$operacionDescription['area']][$operacionDescription['numMes']]/*[$operacionDescription['fraccion']]*/[$operacionDescription['day']] = (int)$operacionDescription['day'];
// 
// 		  }
// 		}
// 	  }

	  /** ALERT this part is tricky need to fix
	   * 
	   */
		foreach($dailyChart as $idxOp => $opContData){
			foreach($opContData as $opLabelName => $opDescriptionName){
				foreach($opDescriptionName as $opFieldName => $opValueData){
					$operationsDailyNews[$opDescriptionName['id_empresa']][$tipoOperacion[$opDescriptionName['tipoOperacion']]][$opDescriptionName['area']][$opDescriptionName['numMes']][$opDescriptionName['fraccion']][$opDescriptionName['day']] = round($opDescriptionName['operacion']);
// 					pr($opDescriptionName['fraccion']);
					$operationsDailyNewsDay[$opDescriptionName['id_empresa']][$tipoOperacion[$opDescriptionName['tipoOperacion']]][$opDescriptionName['area']][$opDescriptionName['numMes']][$opDescriptionName['fraccion']][$opDescriptionName['day']] = (int)$opDescriptionName['day'];
				}
			}
		}
// 		pr($operationsDailyNews);
// 		exit();
	  $OperationsEmpresa = $operationsDailyNews;
	  foreach($OperationsEmpresa as $idx_empresa => $OperationType){
		foreach($OperationType as $OperationName => $areaNameContent){
		  foreach($areaNameContent as $area_Name => $MonthlyDaysContent){
			foreach($MonthlyDaysContent as $idx_month => $fractionsContent){
				foreach($fractionsContent as $fractNameData => $daysContent){
				/** NOTE insert the data for delimiter of !"·*/
// 					pr($OperationName);
// 					pr($fractNameData);
					if(trim((string)$OperationName) === 'toneladas'){
						if(trim((string)$fractNameData) === 'Granel' OR trim((string)$fractNameData) === 'Envasado' OR trim((string)$fractNameData) === 'Clinker'){
							// ALERT calculation of daily data without area
							foreach($daysContent as $idx_day => $dayData){
								if(!isset($operationNoAreaDaily[$idx_empresa][$OperationName][$idx_month][$idx_day])){
								$operationNoAreaDaily[$idx_empresa][$OperationName][$idx_month][$idx_day] = null;
								}
								$operationNoAreaDaily[$idx_empresa][$OperationName][$idx_month][$idx_day] += $dayData;
								$dateParamNoArea[$idx_empresa][$OperationName][$idx_month][$idx_day] = (int)$idx_day;
							}
							// ALERT calculation of daily data 
							foreach($daysContent as $idx_day => $dayData){
								if(!isset($operationAreaDaily[$idx_empresa][$OperationName][$area_Name][$idx_month][$idx_day])){
								$operationAreaDaily[$idx_empresa][$OperationName][$area_Name][$idx_month][$idx_day] = null;
								}
								$operationAreaDaily[$idx_empresa][$OperationName][$area_Name][$idx_month][$idx_day] += $dayData;
								$dateParamArea[$idx_empresa][$OperationName][$area_Name][$idx_month][$idx_day] = (int)$idx_day;
							}
							// ALERT calculation of data by area and month
							foreach($daysContent as $idx_day => $dayData){
								if(!isset($operationMensualAreaDaily[$idx_empresa][$OperationName][$area_Name][$idx_month])){
								$operationMensualAreaDaily[$idx_empresa][$OperationName][$area_Name][$idx_month] = null;
								}
								$operationMensualAreaDaily[$idx_empresa][$OperationName][$area_Name][$idx_month] += $dayData;
								$dateParamMensualArea[$idx_empresa][$OperationName][$area_Name][$idx_month] = $month[$idx_month]['spanish'];
							}
							// ALERT calculation of all areas by month
							foreach($daysContent as $idx_day => $dayData){
								if(!isset($operationMensualNoAreaDaily[$idx_empresa][$OperationName][$idx_month])){
								$operationMensualNoAreaDaily[$idx_empresa][$OperationName][$idx_month] = null;
								}
								$operationMensualNoAreaDaily[$idx_empresa][$OperationName][$idx_month] += $dayData;
								$dateParamMensualNoArea[$idx_empresa][$OperationName][$idx_month] = $month[$idx_month]['spanish'];
							}
							
						}
					}else{

						foreach($daysContent as $idx_day => $dayData){
							if(!isset($operationNoAreaDaily[$idx_empresa][$OperationName][$idx_month][$idx_day])){
							$operationNoAreaDaily[$idx_empresa][$OperationName][$idx_month][$idx_day] = null;
							}
							$operationNoAreaDaily[$idx_empresa][$OperationName][$idx_month][$idx_day] += $dayData;
							$dateParamNoArea[$idx_empresa][$OperationName][$idx_month][$idx_day] = (int)$idx_day;
						}
						
						foreach($daysContent as $idx_day => $dayData){
							if(!isset($operationAreaDaily[$idx_empresa][$OperationName][$area_Name][$idx_month][$idx_day])){
							$operationAreaDaily[$idx_empresa][$OperationName][$area_Name][$idx_month][$idx_day] = null;
							}
							$operationAreaDaily[$idx_empresa][$OperationName][$area_Name][$idx_month][$idx_day] += $dayData;
							$dateParamArea[$idx_empresa][$OperationName][$area_Name][$idx_month][$idx_day] = (int)$idx_day;
						}
						
						foreach($daysContent as $idx_day => $dayData){
							if(!isset($operationMensualAreaDaily[$idx_empresa][$OperationName][$area_Name][$idx_month])){
							$operationMensualAreaDaily[$idx_empresa][$OperationName][$area_Name][$idx_month] = null;
							}
							$operationMensualAreaDaily[$idx_empresa][$OperationName][$area_Name][$idx_month] += $dayData;
							$dateParamMensualArea[$idx_empresa][$OperationName][$area_Name][$idx_month] = $month[$idx_month]['spanish'];
						}
						
						foreach($daysContent as $idx_day => $dayData){
							if(!isset($operationMensualNoAreaDaily[$idx_empresa][$OperationName][$idx_month])){
							$operationMensualNoAreaDaily[$idx_empresa][$OperationName][$idx_month] = null;
							}
							$operationMensualNoAreaDaily[$idx_empresa][$OperationName][$idx_month] += $dayData;
							$dateParamMensualNoArea[$idx_empresa][$OperationName][$idx_month] = $month[$idx_month]['spanish'];
						}
							
					}
					
				}
			}
		  }
		}
	  }

// 	  pr($operationAreaDaily);
// 		pr($dateParamArea);
// 		exit();
	  
		$Operations = $operationAreaDaily;

		/** NOTE @graphs->of->allAreas->daily */
	  foreach($operationNoAreaDaily as $idX_empresa => $Optype){
		foreach($Optype as $OptypeName => $numericalMonth){
		  $graphBuilder = array_search($OptypeName,$tipoOperacion);
		  foreach($numericalMonth as $idNumMonth => $opContent){
// 			if(!isset($dateParamNoArea[$idX_empresa][$OptypeName][$idNumMonth])){
// 				$dateParamNoArea[$idX_empresa][$OptypeName][$idNumMonth] = 0;
// 			}
			$paramNotArea = $dateParamNoArea[$idX_empresa][$OptypeName][$idNumMonth];
			ksort($opContent,SORT_REGULAR);
			ksort($paramNotArea,SORT_REGULAR);
			$this->grapBuild($idX_empresa,$OptypeName,$areaNonmbre=null,$fracciones_name=null,$idNumMonth,$graphBuilder,$opContent,$paramNotArea,$year);//daily
		  }
		}
	  }
	  /** ALERT this part is tricky need to fix
	   * 
	   */
		  foreach($Operations as $id_empresa => $conceptoContainer){
// 			pr($id_empresa);
			foreach($conceptoContainer as $conceptoName => $areaContainer){
			  
				$graphBuild = array_search($conceptoName,$tipoOperacion);
				$anualOperationContainer = $operationMensualNoAreaDaily[$id_empresa][$conceptoName];
				$anualOperationContainerMonthly = $dateParamMensualNoArea[$id_empresa][$conceptoName];
				$this->out('Building YearChart image of '."Concepto=>".$conceptoName);
				$this->grapBuild($id_empresa,$conceptoName,$area_name=null,$fracciones_name=null,$month_name=null,$graphBuild,$anualOperationContainer,$anualOperationContainerMonthly,$year);//annual
				
			  foreach($areaContainer as $areaName => $areasContainer){
// 				pr($areaName);
				$mensualOperationContainer = $operationMensualAreaDaily[$id_empresa][$conceptoName][$areaName];
				$dateParamMensual = $dateParamMensualArea[$id_empresa][$conceptoName][$areaName];

// 				$graphBuild = array_search($conceptoName,$tipoOperacion);
				$this->out('Building MensualChart image of '."Concepto=>".$conceptoName." area =>".$areaName);
				$this->grapBuild($id_empresa,$conceptoName,$areaName,$fracciones_name=null,$id_month=null,$graphBuild,$mensualOperationContainer,$dateParamMensual,$year);//monthly
				
				
			/** WARNING ALERT @startFromHir */ /** WARNING ALERT @startFromHir */ /** WARNING ALERT @startFromHir */
// 			 do a new or a bathc etc do you kmo spadmas, ... jajaja
				foreach($areasContainer as $id_month => $operationContainer){

				  if(isset($dateParamArea[$id_empresa][$conceptoName][$areaName][$id_month])){
					$dateParam = $dateParamArea[$id_empresa][$conceptoName][$areaName][$id_month];
// 					$graphBuild = array_search($conceptoName,$tipoOperacion);
// 					pr($operationContainer);
// 					pr($dateparam);
					ksort($operationContainer,SORT_REGULAR);
					ksort($dateParam,SORT_REGULAR);
					$this->out('Building DailyChart image of '."Concepto=>".$conceptoName." area =>".$areaName." id_month=>".$id_month);
					$this->grapBuild($id_empresa,$conceptoName,$areaName,$fracciones_name=null,$id_month,$graphBuild,$operationContainer,$dateParam,$year);//daily
				  }

				  //ALERT //TODO mensual total acumulado por empresa
				  /** @temporal */
// 				  if(isset($operationNoAreaDaily[$id_empresa][$conceptoName][$id_month])){
// 					  $operationNoAreaContainer = $operationNoAreaDaily[$id_empresa][$conceptoName][$id_month];
// 					  $dateParamNoAreabuild = $dateParamNoArea[$id_empresa][$conceptoName][$id_month];
// 					  $this->out('Building DailyChart allAreas monthly image of '."Concepto=>".$conceptoName." id_month=>".$id_month);
// 					  $this->grapBuild($id_empresa,$conceptoName,$areaNombre=null,$fracciones_name=null,$id_month,$graphBuild,$operationNoAreaContainer,$dateParamNoAreabuild,$year);//daily
// 				  }

				}
			  }
			}
		  }
	}//End buildVars
	
	function grapBuild($id_empresa=null,$concepto=null,$area_name=null,$fracciones_name=null,$month_name=null,$grapColor=null,$operacion=null,$dateParam=null,$year=null){
// 		    build the data for ImagesShell
		
// 		$operacion = array('1'=>'0');
// 		$month_name = '';
		
		$EmpConditions['Empresas.active'] = '1'; // Check if the area is alive
		  $empresas = $this->Empresas->find('list',array('fields'=>array('id_empresa','empresa'),array('conditions'=>$EmpConditions)));
	  
		App::Import('Shell', 'Shell');
		App::Import('Vendor',array('shells/calendar'));
		$myCalendar = new CalendarShell(new Object());
		$myCalendar->initialize();
  // 	  $calendar = $myCalendar->main($year=date('Y'),false);
		$month = $myCalendar->months(true,false,$year);
//   		$url= '/tmp/images/';
		$url = "../../app/webroot/img/thumbs/daily/" ;
	    $this->autoRender = false; // i don't remember why is this but do it
	    App::import('Vendor','pData', array('file' =>'pcharts'.DS.'class'.DS.'pData.class.php'));
	    App::import('Vendor','pDraw', array('file' =>'pcharts'.DS.'class'.DS.'pDraw.class.php'));
	    App::import('Vendor','pImage', array('file' =>'pcharts'.DS.'class'.DS.'pImage.class.php'));
	    $fontFolder = '..'.DS.'..'.DS.'vendors'.DS.'pcharts'.DS.'fonts'.DS;
		$maxValue = max($operacion);
/* Create and populate the pData object */
		$MyData = new pData();
// 		$MyData->addPoints($report_day,"Temperature");
		$MyData->addPoints($operacion,$concepto);
// 		$MyData->setSerieDrawable($concepto,TRUE);
		$MyData->setAxisName(0,$concepto);
// 		$MyData->addPoints(array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"),"Labels");
		$MyData->addPoints($dateParam,"dateParam");
		$MyData->setSerieDescription("dateParam","Dias");
		$MyData->setAbscissa("dateParam");
// 		$MyData->drawAll();
		/* Create the per bar palette */
		$Palette = array(
						"0"=>array("R"=>188,"G"=>224,"B"=>46,"Alpha"=>80),//Yellow
						"1"=>array("R"=>143,"G"=>189,"B"=>216,"Alpha"=>80),//BlueOld **
// 						"2"=>array("R"=>176,"G"=>46,"B"=>224,"Alpha"=>80),//Violet **
						"2"=>array("R"=>239,"G"=>210,"B"=>121,"Alpha"=>80),
						"3"=>array("R"=>122,"G"=>224,"B"=>146,"Alpha"=>80), //Green **
						"4"=>array("R"=>224,"G"=>100,"B"=>46,"Alpha"=>80),//Orange **
						"5"=>array("R"=>46,"G"=>151,"B"=>224,"Alpha"=>80),//Blue
						"6"=>array("R"=>137,"G"=>154,"B"=>173,"Alpha"=>80),//otherBlue
						"7"=>array("R"=>76,"G"=>136,"B"=>190,"Alpha"=>80),//ColdBlue
						"8"=>array("R"=>229,"G"=>11,"B"=>11,"Alpha"=>80) // Red
				);

// 		$MyData->normalize(100,"%");
		$xLenght = "220";
		/* Create the pChart object */
		$myPicture = new pImage(700,$xLenght,$MyData,TRUE);
		

		/* Draw serie 1 in red with a 80% opacity */
		$MyData->setPalette(array($concepto/*,"Labels"*/),$Palette[$grapColor]);

		$Settings = array(
						  "R"=>200,
						  "G"=>200,
						  "B"=>200,
						  "StartR"=>250,
						  "StartG"=>250,
						  "StartB"=>250,
						  "EndR"=>255,
						  "EndG"=>255,
						  "EndB"=>255,
						  "Alpha"=>0
					);
		$Settings = array(
						  "R"=>255,
						  "G"=>255,
						  "B"=>255,
						  "StartR"=>255,
						  "StartG"=>255,
						  "StartB"=>255,
						  "EndR"=>255,
						  "EndG"=>255,
						  "EndB"=>255,
						  "Alpha"=>0
					);
		//$myPicture->drawRectangle(0,0,699,229,array("R"=>200,"G"=>200,"B"=>200));
		$myPicture->drawFilledRectangle(0,0,700,($xLenght+10),$Settings);
		
		/* Overlay with a gradient */
		$myPicture->drawGradientArea(0,0,700,($xLenght+10),DIRECTION_VERTICAL,$Settings);

		/* Write the chart title */  
		$myPicture->setFontProperties(array("FontName"=>$fontFolder."Forgotte.ttf","FontSize"=>10));
		
		/* Draw some thresholds */
// 		$myPicture->setShadow(FALSE);
// 		$myPicture->drawThreshold(-40,array("WriteCaption"=>TRUE,"R"=>0,"G"=>0,"B"=>0,"Ticks"=>4));
// 		$myPicture->drawThreshold($maxValue,array("WriteCaption"=>TRUE,"R"=>0,"G"=>0,"B"=>0,"Ticks"=>4));
		
		//TODO->Define if mensual or annual
		
		if(isset($month_name) and isset($area_name)){
		  if(trim($area_name) === 'Tijuana'){
			$area = 'Mexicali';
		  }else{
			$area = $area_name;
		  }
		  $myPicture->drawText(350,30,ucfirst($concepto)."-".$area./*"-".$fracciones_name.*/"-".$month[$month_name]['spanish']."-".$year,array("FontSize"=>14,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));//Diario
		}if(!isset($month_name) and !isset($area_name)){
		  $myPicture->drawText(350,30,ucfirst($concepto)."-".$empresas[$id_empresa]."-".$year,array("FontSize"=>14,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));//Annual
		}if(!isset($month_name) and isset($area_name)){
		  if(trim($area_name) === 'Tijuana'){
			$area = 'Mexicali';
		  }else{
			$area = $area_name;
		  }
		  $myPicture->drawText(350,30,ucfirst($concepto)."-".$area."-".$year,array("FontSize"=>14,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));//areaAnnual
		}if(isset($month_name) and !isset($area_name)){
		  $myPicture->drawText(350,30,ucfirst($concepto)."-".$empresas[$id_empresa]."-".$month[$month_name]['spanish']."-".$year,array("FontSize"=>14,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));//areaAnnual
		}

		/* Define the 2nd chart area */
		$myPicture->setGraphArea(60,35,660,200);
		$myPicture->setFontProperties(array("FontName"=>$fontFolder."pf_arma_five.ttf","FontSize"=>6));
		
		/* Draw the scale */
		$scaleSettings = array("DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>10,"RemoveXAxis"=>FALSE,"Mode"=>SCALE_MODE_ADDALL_START0,"DrawArrows"=>TRUE,"ArrowSize"=>6);

		$myPicture->drawScale($scaleSettings);
		$myPicture->drawBarChart(array("DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>FALSE,"Rounded"=>FALSE,"Surrounding"=>15,"InnerSurrounding"=>15/*,"OverrideColors"=>$Palette*/));
		
		//TODO->Define if mensual or annual
		
		if(isset($month_name) and isset($area_name)){
		$myPicture->autoOutput($url."$concepto"."_"."$area_name"."_"."$month_name"/*."_"."$fracciones_name"*/."_".$year.".png");//Diario
		}if(!isset($month_name) and !isset($area_name)){
		$myPicture->autoOutput($url.$concepto."_".strtolower($empresas[$id_empresa])."_".$year.".png");//Annual
		}if(!isset($month_name) and isset($area_name)){
		$myPicture->autoOutput($url."$concepto"."_".$area_name."_".$year.".png");//areaAnnual
		}if(isset($month_name) and !isset($area_name)){
		$myPicture->autoOutput($url.$concepto."_".strtolower($empresas[$id_empresa])."_".$month_name."_".$year.".png");//areaAnnual
		
		}


	}// End buildVars

    function main(){

		 $this->out($this->buildVars());

     }

} // End Class
?> 
 
