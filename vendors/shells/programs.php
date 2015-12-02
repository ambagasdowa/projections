<?php
class ProgramsShell extends Shell {
          var $uses = array(
			'Empresas',
			'Areas',
			'AreasAtm',
			'AreasTei',
			'FlotasAtm',
			'FlotasTei',
			'Flotas',
			'TipoOperacion',
			'TipoOperacionAtm',
			'TipoOperacionTei',
			'Fraccion',
			'TonelajeCurrent',
			'KmsCurrent',
			'IngresosCurrent',
			'TonelajeCurrentAtm',
			'KmsCurrentAtm',
			'IngresosCurrentAtm',
			'TonelajeCurrentTei',
			'KmsCurrentTei',
			'IngresosCurrentTei'
			);
//     var $params = array('');

/** TODO make an function for areas with remenber the string to convert is Bonampak <area> 
 **       firts drop Bonampak string and convert to ucfirts(ucwords()) the rest etc
 */
   function areas(){
// 	pr('areas');
   } 

   
   function corp(){
      $conditions['Empresas.active'] = '1';
      $corp = $this->Empresas->find('list',array('fields'=>array('id_empresa','empresa'),'conditions'=>$conditions));
      
      return $corp;
   }
 /** @variant: in var $uses drop the models => TraficoGuia and TraficoRenglonGuia
  */

  /** @function fleets()
   ** @param <set true to return data as variable> <set true to set the variables in view> 
   ** @var for both modes the returned var are in set mode :: $fleets = array($fleet,$flota)
   **/    
   function fleets($return=null,$set=null){
	$SearchFleets = $this->Flotas->find('all');
	$area = $this->Areas->find('list',array('fields'=>array('id_area','nombre')));
	$flota = null;
	for($i=1;$i<=count($area);$i++){
	  $flota[$i] = null;
	}
	foreach($SearchFleets as $key => $value){

	  if(!empty($SearchFleets[$key]['TipoOperacion'])){
	  
	    $fleet[$SearchFleets[$key]['Flotas']['id_area']][$SearchFleets[$key]['Flotas']['id_flota']] = $SearchFleets[$key]['Flotas']['nombre'];

	    foreach($SearchFleets[$key]['TipoOperacion'] as $k => $v){
	    
	      $fleet[$SearchFleets[$key]['Flotas']['id_area']][$SearchFleets[$key]['Flotas']['id_flota']] .= ','.$SearchFleets[$key]['TipoOperacion'][$k]['id_tipo_operacion'];
	      
	      $flota[$SearchFleets[$key]['Flotas']['id_area']] .= ','.$SearchFleets[$key]['TipoOperacion'][$k]['id_tipo_operacion'];
	    }
	  }
	}
	$fleets['fleet'] = $fleet; 
	$fleets['flota'] = $flota;
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

   
    function extractData($year=null){

	  if(empty($year)){
		$year=date('Y');
	  }
	  $months = $this->months(true,false,$year);
	  $CurrentYear = $year;
	  $idx=1;
	  /** @params config urls
	  */
	  $url = array();
	  $root = '/tmp/';
	  $corporate = $this->corp();
	  
	  foreach($corporate as $key => $value){

		// Define the connection data for each enterprise from database 1= Bonampak ,2 = ATM and 3 = Tespecializada
		// TODO make this with an db relation 
		if($key == '1'){
			$_append  = null;
			$connection = 'odbc-bonampakdb';
		}if($key == '2'){
				$_append  = '_'.substr(strtolower($value),0,3);
				$connection = 'odbc-macuspanadb';
		}if($key == '3'){
			$_append  = '_'.substr(strtolower($value), 0, 3);
			$connection = 'odbc-tespecializadadb';
		}
		  $mysql[$value]['host'] = 'localhost';
		  $mysql[$value]['pass'] = '@projections'.$_append.'#';
		  $mysql[$value]['user'] = 'projections'.$_append;
		  $mysql[$value]['id_empresa'] = $key;
		  
		  $url[$value][1]['url'] = "tonelaje_current".$_append.".sql";
		  $url[$value][1]['save'] = "tonelaje_current".$_append.".csv";
		  $url[$value][1]['truncate'] = "query_tonelaje_current".$_append.".sql";
		  $url[$value][1]['query_truncate'] = "truncate tonelaje_current".$_append."";
		if($key == '3'){
		  $url['Teisa'][1]['query'] = "select a.id_area,a.status_guia,a.fecha_guia,b.id_fraccion,b.peso,a.id_tipo_operacion,a.id_unidad,d.id_flota,a.num_guia,a.prestamo from trafico_guia as a INNER JOIN trafico_renglon_guia as b ON a.id_area = b.id_area and a.no_guia= b.no_guia INNER JOIN trafico_viaje as c ON a.id_area = c.id_area and a.no_viaje = c.no_viaje INNER JOIN mtto_unidades as d ON a.id_unidad = d.id_unidad where a.fecha_guia like '%".$CurrentYear."%' and a.tipo_doc = '2' and a.status_guia not like 'B' and a.prestamo NOT LIKE 'P' order by a.fecha_guia";
		}else{
		  $url[$value][1]['query'] = "select a.id_area,a.status_guia,a.fecha_guia,a.id_fraccion,b.peso,a.id_tipo_operacion,a.id_unidad,d.id_flota,a.num_guia,a.prestamo from trafico_guia as a INNER JOIN trafico_renglon_guia as b ON a.id_area = b.id_area and a.no_guia= b.no_guia INNER JOIN trafico_viaje as c ON a.id_area = c.id_area and a.no_viaje = c.no_viaje INNER JOIN mtto_unidades as d ON a.id_unidad = d.id_unidad where a.fecha_guia like '%".$CurrentYear."%' and a.tipo_doc = '2' and a.status_guia not like 'B' and a.prestamo NOT LIKE 'P' order by a.fecha_guia";
		}
		$url[$value][2]['url'] = "kms_current".$_append.".sql";
		$url[$value][2]['save'] = "kms_current".$_append.".csv";
		$url[$value][2]['truncate'] = "query_kms_current".$_append.".sql";
		$url[$value][2]['query_truncate'] = "truncate kms_current".$_append;
		// WARNING WARNING => The problem n-CartaPorte assigned to one no_viaje in kms and  trips is a headache
		// WARNING WARNING => so the solution approach is and is not a solution, instead because is confronting a sqlview
		// NOTE really? I'm must change the field a.num_guia_asignado to a.fecha_confirmacion ... Area you sure 
		// NOTE exists over-there another method ?? the answer is not? ok call the random-world' 
		// NOTE why teisa is a theme apart ?? because they don't store the id_fraccion data in trafico_guia, they do in 
		// NOTE trafico_renglon_guia , crap XD!
		if($key == '3'){
		  $url['Teisa'][2]['query'] = "select c.id_configuracionviaje,c.kms_viaje,c.kms_real,a.fecha_guia,b.id_fraccion,a.id_area,a.id_tipo_operacion,a.id_unidad,d.id_flota,a.num_guia,a.no_viaje,a.num_guia_asignado FROM trafico_guia as a INNER JOIN trafico_renglon_guia as b ON a.id_area = b.id_area and a.no_guia= b.no_guia INNER JOIN trafico_viaje as c ON a.id_area = c.id_area and a.no_viaje = c.no_viaje INNER JOIN mtto_unidades as d ON a.id_unidad = d.id_unidad INNER JOIN trafico_ruta as e ON c.id_ruta=e.id_ruta where YEAR(a.fecha_guia) = ".$CurrentYear." and a.status_guia not like 'B' and a.prestamo NOT LIKE 'P' and a.tipo_doc = '2' and c.kms_viaje > 0 order by a.fecha_guia";
		}else{
		  $url[$value][2]['query'] = "select c.id_configuracionviaje,c.kms_viaje,c.kms_real,a.fecha_guia,a.id_fraccion,a.id_area,a.id_tipo_operacion,a.id_unidad,d.id_flota,a.num_guia,a.no_viaje,a.num_guia_asignado FROM trafico_guia as a INNER JOIN trafico_renglon_guia as b ON a.id_area = b.id_area and a.no_guia= b.no_guia INNER JOIN trafico_viaje as c ON a.id_area = c.id_area and a.no_viaje = c.no_viaje INNER JOIN mtto_unidades as d ON a.id_unidad = d.id_unidad INNER JOIN trafico_ruta as e ON c.id_ruta=e.id_ruta where YEAR(a.fecha_guia) = ".$CurrentYear." and a.status_guia not like 'B' and a.prestamo NOT LIKE 'P' and a.tipo_doc = '2' and c.kms_viaje > 0 order by a.fecha_guia";
		}
		$url[$value][3]['url'] = "ingresos_current".$_append.".sql";
		$url[$value][3]['save'] = "ingresos_current".$_append.".csv";
		$url[$value][3]['truncate'] = "query_ingresos_current".$_append.".sql";
		$url[$value][3]['query_truncate'] = "truncate ingresos_current".$_append."";

		if($key == 3){
		$url['Teisa'][3]['query'] = "select a.fecha_guia,a.id_area,a.id_tipo_operacion,b.id_fraccion,a.id_unidad,a.num_guia,a.no_viaje,a.num_guia_asignado,a.subtotal,d.id_flota from trafico_guia as a INNER JOIN trafico_renglon_guia as b ON a.id_area = b.id_area and a.no_guia= b.no_guia INNER JOIN trafico_viaje as c ON a.id_area = c.id_area and a.no_viaje = c.no_viaje INNER JOIN mtto_unidades as d ON a.id_unidad = d.id_unidad where a.fecha_guia like '%".$CurrentYear."%' and a.tipo_doc = '2' and a.status_guia not like 'B' and a.prestamo NOT LIKE 'P' order by a.fecha_guia";	
		}else{
		  $url[$value][3]['query'] = "select a.fecha_guia,a.id_area,a.id_tipo_operacion,a.id_fraccion,a.id_unidad,a.num_guia,a.no_viaje,a.num_guia_asignado,a.subtotal,d.id_flota from trafico_guia as a INNER JOIN trafico_viaje as c ON a.id_area = c.id_area and a.no_viaje = c.no_viaje INNER JOIN mtto_unidades as d ON a.id_unidad = d.id_unidad where a.fecha_guia like '%".$CurrentYear."%' and a.tipo_doc = '2' and a.status_guia not like 'B' and a.prestamo NOT LIKE 'P' order by a.fecha_guia";
		}

		foreach($url[$value] as $k => $data){

		  if(file_exists($root.$data['url'])){
			system('rm '.$root.$data['url']);
		  }if(file_exists($root.$data['truncate'])){
			system('rm '.$root.$data['truncate']);
		  }
		  system("touch ".$root.$data['truncate']);
		  $ftruncate = fopen($root.$data['truncate'],'w');
		  fwrite($ftruncate,$data['query_truncate']."\n");
		  fclose($ftruncate);

		  system("touch ".$root.$data['url']);
		  $fquery = fopen($root.$data['url'],'w');
		  fwrite($fquery,$data['query']."\n");
		  
		  fclose($fquery);

		  system("/usr/bin/isql -v ".$connection." zam lis -bt  < ".$root.$data['url']." > ".$root."list_".$data['url']);
		  system("sed -e "."'\$d' ".$root."list_".$data['url']." > ".$root."list_".$data['url'].$idx);
		  system("sed -e "."'\$d' ".$root."list_".$data['url'].$idx." > ".$root."db_".$data['url']);

		  system("sed -e '1,3d' -e 's/[ \|]*$//g' -e 's/^[ \|]*//g' -e 's/|/\t/g' -e 's/^/null\\t/g' -e '\$d' ".$root."db_".$data['url']." > ".$root.$data['save']);

		  $useTable = substr(strtolower($data['url']), 0, -4);
		  
		  $modelExtract = explode('_',$useTable);
		  foreach($modelExtract as $idExtract => $string){
			if(!isset($modelBuild[$useTable])){
			  $modelBuild[$useTable] = null;
			}
			$modelBuild[$useTable] .= ucfirst($string);
		  }

		  $model = $modelBuild[$useTable];
		  $conditions = array('YEAR('.$model.'.fecha_guia)'=>$year);
		  
		  $frecuency = $model;
		  $tipoOperacion = $modelBuild[$useTable];
		  $system['user'] = $mysql[$value]['user'];
		  $system['host'] = $mysql[$value]['host'];
		  $system['pass'] = $mysql[$value]['pass'];
		  $system['file_import_path'] = $root.$data['save'];
		  
		  //debugging
// 		  pr($model);
// 		  pr($conditions);
// 		  pr($useTable);
// 		  pr($system);
		  //debugging

		  $this->idCheck($conditions,$tipoOperacion,$frecuency,$data=null,$model,$useTable,$prefix=null,$debug=false,$system);

		} // End foreach write url
	  } // End foreach $corporate
    } // End extractData() like the ancient times of the all migthy C

	/** TODO no pendings maybe convert as a fork
	 * @usage function idCheck()
	 * @description of the @param and@conditions
	 * 		@conditions=> <conditions to filter for example by year array('ModelName.fieldName'=>'condition') >
	 * 		@tipoOperacion=> <print just print an indicator for example inside of a loop print the times of executing..>	* 	   @@tipoOperacion=> <this function>
	 * 		@frecuency=> <print just print an indicator for internal operation if data is erasing or update or delete>
	 * 		@data=> <the data to save as an array in cakephp format example array(['model']=>array(['index']=>['data']))>
	 * 		@model=> <the model to execute this function>
	 * 		@useTable=> <the table to update,erase or save,this is for know which is the last id in the table and for> 	*      @@useTable=> <make the alter to the index>
	 * 		@prefix=> <the default is 'id_' if you need overwrite use it else null this value used to found the last id>
	 * 		@debug=> <is not obvious XD!!>
	 */
	
	
	function idCheck($conditions=null,$tipoOperacion=null,$frecuency=null,$data=null,$model=null,$useTable=null,$prefix=null,$debug=null,$system=null){

	  if(empty($prefix)){
		$prefix = 'id_';
	  }

		if($this->$model->find('all',array('conditions'=>$conditions))){
		  $this->out('Data => in Db\'s by '.$frecuency.' find erasing ...');

		  if(!($this->$model->deleteAll($conditions,false))){
			$this->out('Error erasing data in =>'.$model.'with conditions'.pr($conditions));
			$this->out('Erasing fail...');
			exit();
		  }else{
			$this->out('Erasing is done...');
			$this->out('Checking the last id of the old data in => '.$prefix.$useTable);
			$lastIdFound = $this->$model->query('select max('.$prefix.$useTable.') from '.$useTable.';');

			if(!empty($debug)){
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
						  if(!empty($data) and empty($system)){
							$this->$model->saveAll($data);
						  }elseif(empty($data) and !empty($system)){
							system("mysqlimport --local -u ".$system['user']." -h ".$system['host']." --password=".$system['pass']." ".$system['user']." ".$system['file_import_path']);
						  }

						  $this->out('Updating the data => Done');
					  }else{
						  $this->out('The id is '.$Id);
						  $LasFoundId = $Id+1;
						  $this->$model->query('alter table '.$useTable.' AUTO_INCREMENT='.$LasFoundId.';');
						  $this->out('Updating => Db\'s By '.$frecuency.' with updated Data ...');
						  
						  if(!empty($data) and empty($system)){
							$this->$model->saveAll($data);
						  }elseif(empty($data) and !empty($system)){
							system("mysqlimport --local -u ".$system['user']." -h ".$system['host']." --password=".$system['pass']." ".$system['user']." ".$system['file_import_path']);
						  }
					  }
					}
				  }
				}
		  }//end erasing conditions
		}else{
		  if(!empty($data) and empty($system)){
			$this->$model->saveAll($data);
		  }elseif(empty($data) and !empty($system)){
			system("mysqlimport --local -u ".$system['user']." -h ".$system['host']." --password=".$system['pass']." ".$system['user']." ".$system['file_import_path']);
		  }
		  $this->out('Updating => '.$tipoOperacion.' By '.$frecuency.' Data no issues');
		}
	}//End Checking

	function tachionTravel($deep=null){
	  $currentYear=date('Y');
	  if(empty($deep)){
		$deep= '2' ;
	  }
	  for($i=0;$i<=$deep;$i++){
		$tau[$i] = (int)$currentYear-(int)$i;
	  }
	  return $tau;
	}//End tachionTravel
	
	function truncateCfg(){
	  /** @config if you need truncate more tables just add */
		$table[] = 'tonelaje_current';
		$table[] = 'tonelaje_current_atm';
		$table[] = 'tonelaje_current_tei';
		$table[] = 'kms_current';
		$table[] = 'kms_current_atm';
		$table[] = 'kms_current_tei';
		$table[] = 'ingresos_current';
		$table[] = 'ingresos_current_atm';
		$table[] = 'ingresos_current_tei';
		foreach($table as $index => $tableName){
		  $split = explode('_',$tableName);
		  $model[$index] = implode(array_map('ucfirst',$split));
		}
	  return array('table'=>$table,'model'=>$model);
	}
	
	function truncateDb(){
	  foreach($this->truncateCfg()['model'] as $index => $model){
		$this->$model->query("truncate ".$this->truncateCfg()['table'][$index]);
	  }
	  return true;
	}
	
    function main(){

	 if(!($this->args)){
// 		 $this->help();
         $this->err(__("Usage : if you need define how may years backwards are going to update set as first parameter 
						\n if you need define the year going to update backwards set as second parameter
						\n programs <yearCountBackwards|(int)> <year|(int)>
						\n if you want to count backwards starting from 2014 and end in 2011 then
						\n example: programs 3 2014
						\n if you on want go backwards from the current year just set the firts parameter
						\n example : programs 1
						\n without arguments the default options is one year backwards from current year and truncate
						\n all data in db
						\n if you need truncate all the data in db set as third argument
						\n example programs 1 2015 truncate", true));

	  /** ALERT  so we are hir because you automatize this process and because you know what are you doing */
	  /** ALERT and @remenber this process only takes the (date('Y')-1) and the current year data and until march**/
	  if(date('n') < 3){
		$this->out('Truncate the data in DB');
		$this->out('Mes => '.date('M'));
		if(!$this->truncateDb()){ /** DANGER function use with CAUTION */
		  $this->out('Error truncating Db please check your db data and you know wereaver to do');
		}else{
		  $this->out('Truncate is successfull executing');
		}
		// Ok go and truncate the db XD
		$this->out('Updating data in DB with records of year '.(date('Y')-1));
		$this->extractData($year=(date('Y')-1)); // current year -1 ;
		$this->out('Now Updating data in DB with records of year '.date('Y'));
		$this->extractData(); //then current Year
		$this->out('All the jobs is done .. bye');
		$this->_stop();
		// the routine is truncate all data then execute anter year but if we have more years ? then what
	  }else{
		/** ALERT after march of current year go normal*/
		$this->extractData();
	  }

     }else{
	  /** TODO @status=>developing in progress **/
	  if(isset($this->args[0])){
		  if(is_numeric($this->args[0])){
			$options['yearBackwards'] = $this->args[0];
		  }else{
			$this->err(__("The first Argument must be integer : how many years you won to go backwards?"));
			$this->_stop();
		  }
		  if(isset($this->args[1])){
			if(is_numeric($this->args[1])){
			  $options['year'] = $this->args[1];
			}else{
			  $this->err(__("The last Argument must be integer : from which year must begin to count backwards"));
			  $this->_stop();
			}
		  }
		  if(isset($this->args[2])){
			if((is_string($this->args[2]) and ($this->args[2] == 'truncate'))){
			  $options['truncate'] = $this->args[2];
			}else{
			  $this->err(__("The last Argument must be string and the value always is 'truncate' :\nand only set if you won delete all data in db .\nUse with CAUTION"));
			  $this->_stop();
			}
		  }
		  
		if(isset($options)){
		  pr($options);
		  if(isset($options['yearBackwards'])){
			pr($this->tachionTravel($options['yearBackwards']));
		  }
		}

	  }//End isset args
	 }//End else no arg
// 	  $this->extractData($year=(date('Y')-1)); // current year -1 ;
// 	  $this->extractData();
	}// End main()
} // End Class Programs