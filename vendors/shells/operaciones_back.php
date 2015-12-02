<?php
  class OperacionesBackShell extends Shell{
	var $uses = array('Fraccion',
					  'Operacion',
					  'OperacionMensual'
					  );

	/** TODO no pendings
	 * @usage function idCheck()
	 * @description 
	 * 		@conditions=> <conditions to filter for example by year array('ModelName.fieldName'=>'condition') >
	 * 		@tipoOperacion=> <print just print an indicator for example inside of a loop print the times of executing..>	* 	   @@tipoOperacion=> <this function>
	 * 		@frecuency=> <print just print an indicator for internal operation if data is erasing or update or delete>
	 * 		@data=> <the data to save as an array in cakephp format example array(['model']=>array(['index']=>['data']))>
	 * 		@model=> <the model to execute this function>
	 * 		@useTable=> <the table to update,erase or save,this is for know which is the last id in the table and for> 	*      @@useTable=> <make the alter to the index>
	 * 		@prefix=> <the default is 'id_' if you need overwrite use it else null this value used to found the last id>
	 * 		@debug=> <is not obvious anyway is disabled>
	 */
	
	
	function idCheck($conditions=null,$tipoOperacion=null,$frecuency=null,$data=null,$model=null,$useTable=null,$prefix=null,$debug=null){

	  if(empty($prefix)){
		$prefix = 'id_';
	  }
// 	  $this->out($conditions);

		if($this->$model->find('all',array('conditions'=>$conditions))){
		  $this->out('Data => in Db\'s by '.$frecuency.' find erasing ...');
		  $this->$model->deleteAll($conditions,false);
		  $this->out('Erasing is done...');
		  $this->out('Checking the last id of the old data');
		  $lastIdFound = $this->$model->query('select max('.$prefix.$useTable.') from '.$useTable.';');
		  if(isset($debug)){
			  var_dump($lastIdFound);
		  }
			  foreach($lastIdFound as $firstLevel){
				foreach($firstLevel as $maxId){
				  foreach($maxId as $Id){
					if(empty($Id)){
						$this->out('No data of any kind found anyway going to reset the indexing');
						$this->$model->query('alter table '.$useTable.' AUTO_INCREMENT=1;');
						$this->out('Reseting the indexes => Done');
						$this->out('Updating => Db\'s By '.$frecuency.' Data ...');
						$this->$model->saveAll($data);
						$this->out('Updating the data => Done');
					}else{
						$this->out('The id is '.$Id);
						$LasFoundId = $Id+1;
						$this->$model->query('alter table '.$useTable.' AUTO_INCREMENT='.$LasFoundId.';');
						$this->out('Updating => Db\'s By '.$frecuency.' with updated Data ...');
						$this->$model->saveAll($data);
					}
				  }
				}
			  }
// 		  }
		}else{
		  $this->out('Updating => '.$tipoOperacion.' By '.$frecuency.' Data no issues');
		  $this->$model->saveAll($data);
		}
	}//End Checking

	function dbOp(){
	  $operations=array('1'=>'Toneladas','2'=>'kms','3'=>'ingresos'); // extract the Mensual ingresos
	  return $operations;
	}
	
	function operations(){
		
		$operations=$this->dbOp();

	    App::Import('Shell', 'Shell');
	    App::Import('Vendor',array('shells/calendar'));
	    $myCalendar = new CalendarShell(new Object());
	    $myCalendar->initialize();
	    $calendar = $myCalendar->main($year=date('Y'),false);
	    $months = $calendar['months'];
	    $fraction = $this->Fraccion->find('list',array('fields'=>array('id','fraccion')));
// 		pr($fraction);
		App::Import('Shell', 'Shell');
		App::Import('Vendor',array('shells/sniffer_data'));
		$myShell = new SnifferDataShell(new Object());
		$myShell->initialize();
		// 	Select the method to call
		$Shell = $myShell->main($view=true,$debug=false);
		
		$coverOps['Toneladas']['days'] = $Shell['Toneladas']['DailyReport']['report_day'];
		$coverOps['Toneladas']['months'] = $Shell['Toneladas']['DetailData']['toneladas'];
		
		$coverOps['kms']['days'] = $Shell['kms']['report_day_all'];
		$coverOps['kms']['months'] = $Shell['kms']['kms_month_by_fraction'];
		
		$coverOps['ingresos']['days'] = $Shell['ingresos']['report_daily'];
		$coverOps['ingresos']['months'] = $Shell['ingresos']['total_ingresos_monthly'];

		foreach($operations as $idOp => $opName){
		  $tipoOperacion = $idOp;
			if(in_array($operations[$tipoOperacion],$operations) == true){
			  $Operacion = $coverOps[$operations[$tipoOperacion]]['days'];
			  $monthOperacion = $coverOps[$operations[$tipoOperacion]]['months'];
			}
		// Building databases
			foreach($Operacion as $id_empresa =>$areas){
			  foreach($areas as $areaName => $Months){
				foreach($Months as $monthName => $Fractions ){
				  foreach($Fractions as $fractionName => $DaysOperacion){
					if(isset($DaysOperacion)){
					  foreach($DaysOperacion as $day => $operacion){
						if(!empty($operacion)){
							foreach($months as $numMonth => $monthData){
							  foreach($monthData as $description => $monthContent){
								if($monthData['short'] == $monthName){
								  $numMes = $monthData['num'];
								}
							  }
							}
							foreach($fraction as $id_fraction => $fractionDescription){
							  if($fractionDescription == $fractionName){
								$numFraction = $id_fraction;
							  }
							}
							$day = str_pad((int) $day,'2',"0",STR_PAD_LEFT);
							$operacionesDiarias['Operacion'][] = array('id_empresa'=>$id_empresa,
																	'area'=>$areaName,
																	'year'=>$year,
																	'day'=>$day,
																	'operacion'=>$operacion,
																	'tipoOperacion'=>$tipoOperacion,
																	'month'=>$monthName,
																	'numMes'=> $numMes,
																	'id_fraction' => $numFraction,
																	'fraccion'=>$fractionName
															);
						}
					  }
					}// if isset($DaysToneladas)
				  }
				}
			  }
			}
			//next go for mensual toneladas
			// Reset the vars to reuse;
			$areas = $areaName = $monthName = $dataOperacion = $numMes = null;
			foreach($monthOperacion as $id_empresa => $areas){ // in this case the Area is under Empresa
			  foreach($areas as $areaName => $month){
				foreach($month as $monthName => $dataOperacion){
					foreach($dataOperacion as $fractionName => $dataOperacionValue){
						if(isset($dataOperacionValue) and !empty($dataOperacionValue)){
						foreach($months as $numMonth => $monthData){
						  foreach($monthData as $description => $monthContent){
							if($monthData['short'] == $monthName){
							  $numMes = $monthData['num'];
							}
						  }
						}
						foreach($fraction as $id_fraction => $fractionDescription){
						  if($fractionDescription == $fractionName){
							$numFraction = $id_fraction;
						  }
						}
						$operacionesMensuales['OperacionMensual'][] = array('id_empresa'=>$id_empresa,
																'area'=>$areaName,
																'year'=>$year,
																'operacion'=>$dataOperacionValue,
																'tipoOperacion'=>$tipoOperacion,
																'month'=>$monthName,
																'numMes'=> $numMes,
																'id_fraction' => $numFraction,
																'fraccion'=>$fractionName
														);
						}
					}
				}
			  }
			}
		}//End of each operations
			$conditionsDaily['Operacion.year'] = $year;
			$this->idCheck($conditionsDaily,$operations[$tipoOperacion],$frecuency='Diaria',$data=$operacionesDiarias['Operacion'],$model='Operacion',$useTable='operacion');
			
			$conditions['OperacionMensual.year'] = $year;
			$this->idCheck($conditions,$operations[$tipoOperacion],$frecuency='Mensual',$data=$operacionesMensuales['OperacionMensual'],$model='OperacionMensual',$useTable='operacionMensual');
	}//End main()
	
	
	function main(){
	  $this->operations();
	}// end main
	
  }//End OperacionesShell
?>