<?php

  /** @themes **/
// 	function themes() {
// 		$themes = array(
// 							'legacy' => false,
// 							'protoquery' => true,
// 							'other' => false
// 			);
// 		return $themes;
// 	}
// 	
// 	function themes() {
// 		$themes = array(
// 						'1'=>array('name'=>'legacy','vendor'=>'legacy','status'=>'production','default'=>false),
// 						'2'=>array('name'=>'dashboard','vendor'=>'protoquery','status'=>'beta','default'=>true),
// 						'3'=>array('name'=>'other','vendor'=>'protoquery','status'=>'beta','default'=>false)
// 			);
// 		return $themes;
// 	}

	function plus($data=null){
			return $data * 2;
	}

	function dbAnexos(){
	  $prefix = 'FlujoDirNames';
	  $dbAnexos = array('1'=>'anexo_a',
						'2'=>'anexo_b',
						'3'=>'anexo_c'
		  );

			foreach($dbAnexos as $tblIdx => $tableName){
			  $drop = str_replace('_',' ',$tableName);
			  $ucaps = ucwords($drop);
			  $tblNamaeAnx[$tblIdx] = str_replace(' ','',$ucaps);
			  $tblNamaeAnxp[$tblIdx] = $prefix.str_replace(' ','',$ucaps);
			}
			
		$AnxNames['tbl'] = $dbAnexos;
		$AnxNames['sufix'] = $tblNamaeAnx;
		$AnxNames['prefix'] = $tblNamaeAnxp;
		
		return $AnxNames;
	}

	
	 /**
	 * @package name <checkBrowser> this must change
	 * @congif build a script code to call datepicker
	 * @usage
	 * @param=>userAgent <string | set the string of "HTTP_USER_AGENT" >
	 * NOTE  this function is far away to be complete but for the purpose is ok
	 */
		
	function checkBrowser($userAgent=null){
	  $userAgentHaystack = array('Firefox','Trident','konqueror');
// 	  $browser = null;
		foreach($userAgentHaystack as $idx => $stack){
		  $agentFound = strpos($userAgent, $stack);
		  if(strpos($userAgent, $stack) !== false){
			return true;
			break;
		  }
		}
		return false;
	}//End of checkBrowser
	
		/**
	 * @package name <setDatepicker> this must change
	 * @congif build a script code to call datepicker
	 * @print print the script 
	 * @usage
	 * @param=>fieldname <string | set the parameter name of the <tag name = "fieldname">
	 * @param=>fieldid <string | set the parameter name of the <tag id = "fieldid">
	 * @param=>keepFieldEmpty <boolean | bool>
	 * NOTE  array('model'=>array('field','value'));
	 */
	function setDatepicker($fieldname=null,$fieldid=null,$keepFieldEmpty=null){
	  $datepicker = "\nvar dpck_fieldname = new DatePicker({\n".
	  "relative:'$fieldid',\n".
	  "keepFieldEmpty:$keepFieldEmpty,\n".
// 	  "dateFilter:DatePickerUtils.noWeekends()".
// 	  ".append(DatePickerUtils.noDatesBefore(3))".
// 	  ".append(DatePickerUtils.noDatesAfter(240)),\n".
	  "});\n".
	  "dpck_fieldname._dateFilter.append(new GoogleDatePickerFilter(dpck_fieldname, 'es.mexican#holiday@group.v.calendar.google.com'));\n";
	  return $datepicker;
	}
	
		/**
	 * @package name <removeString> this must change
	 * @congif extract areas from lis-db
	 * @extract areas,flotas and tipo de Operacion
	 * @use isql model connection with mssql
	 * @param=>arrayString <array | string>
	 * @param=>string <array | string>
	 * @param=>$model <name of the model|1stlevet array>
	 * @param=>field <name of the table|2nd level array>
	 * @param=>unset <bool if you want remove the first pointer>
	 * NOTE  array('model'=>array('field','value'));
	 */
	function removeString($arrayString=null,$string=null,$model=null,$field=null,$unset=null){

	  if(is_array($arrayString)){

		  if(!empty($unset) AND $unset == true){
			unset($arrayString[0]);
		  }
		  foreach($arrayString as $id_arrayString => $getString){
			if(is_array($string)){
			  $dropString = $getString[$model][$field];
			  foreach($string as $String){
				$dropString = str_replace((string)$String,'',$dropString);
			  }
			  $modStr = utf8_encode(strtolower(trim($dropString)));
			}elseif(is_string($string)){
			  $modStr = utf8_encode(strtolower(trim(str_replace((string)$string,'',$getString[$model][$field]))));
			}else{
			  $this->err(__("check your string parameter , this must be an array or a string"));
			  $this->_stop();
			}
	  		if(stripos((string)$modStr,"\x20") === false){
			  $resultString[$id_arrayString] = ucfirst($modStr);
			}else{
			  $explode = explode("\x20",$modStr);
			  if(!isset($resultString[$id_arrayString])){
				$resultString[$id_arrayString] = null;
			  }
			  foreach($explode as $ind => $implodeString){
				if(isset($explode[$ind])){
				  $resultString[$id_arrayString] .= ucfirst($explode[$ind])."\x20";
				}
			  }
			}
		  }//End foreach
	  }else{
		__('check your input the first argument must be an array');
		exit();
	  }
	  return $resultString;
	}// End removeString
	
	  
	function disponibleFlotasConfig($arrayFlotas=null,$id_empresa=null,$session=null){
		  /** @Config the index of the flotas you want to unset */
		if($session !== false){
		  if(!isset($id_empresa)){
			//try with session
			$id_empresa = $_SESSION['Auth']['User']['id_empresa'];
		  }else{
			//if no session argument and not session then go out
			exit();
		  }
		}
		  if($id_empresa == '1'){
			$unsetFlotas = array('2','4','9','10','12','11','13','15','18','19');
		  }elseif($id_empresa == '2' OR $id_empresa == '3'){ // then Atm
			$unsetFlotas = null;
		  }else{
			$unsetFlotas = null;
		  }

		  if(isset($unsetFlotas)){
			foreach($unsetFlotas as $key => $keyToUnset){
			  unset($arrayFlotas[$keyToUnset]);
			}
		  }
	  return $arrayFlotas;
	}//End disponibleConfigTbk
	
  function userConfig(){
	// NOTE for drop areas must have an multiarray like array('id_empresa'=>array('ids_flota'));
	$setConfig['alexandro.hernandezc@bonampak.com.mx'] = array(
														  'flotas'=>array('1','3','4','5'),
														  'redirect'=>'test',
														  'viewTabs'=>array(
																		'dropToneladas'=>false,
																		'dropKilometros'=>false,
																		'dropIngresos'=>false,
																		'dropViajes'=>false,
																		'dropProjection'=>false,
																		'dropAcumulado'=>false
																	  ),
														  'viewMenu'=>array(
																		'dropProjections'=>false,
																		'dropIndicadores'=>true,
																		'dropCostos'=>true,
																		'dropFlujo'=>true
																	  ),
														  'other'=>null
														 );
	$setConfig['marco.vegar@bonampak.com.mx'] = array(
														  'flotas'=>array('1','3'),
														  'redirect'=>'test',
														  'viewTabs'=>array(
																		'dropToneladas'=>false,
																		'dropKilometros'=>false,
																		'dropIngresos'=>false,
																		'dropViajes'=>false,
																		'dropProjection'=>false,
																		'dropAcumulado'=>false
																	  ),
														  'viewMenu'=>array(
																		'dropProjections'=>false,
																		'dropIndicadores'=>true,
																		'dropCostos'=>true,
																		'dropFlujo'=>true
																	  ),
														  'other'=>null
														 );
	$setConfig['jorge.flores@bonampak.com.mx'] = array(
														  'flotas'=>array('1','3','4','5'),
														  'redirect'=>'test',
														  'viewTabs'=>array(
																		'dropToneladas'=>false,
																		'dropKilometros'=>false,
																		'dropIngresos'=>false,
																		'dropViajes'=>false,
																		'dropProjection'=>false,
																		'dropAcumulado'=>false
																	  ),
														  'viewMenu'=>array(
																		'dropProjections'=>false,
																		'dropIndicadores'=>true,
																		'dropCostos'=>true,
																		'dropFlujo'=>true
																	  ),
														  'other'=>null
														 );
	$setConfig['wilfrido.galiciag@tei-sa.com.mx'] = array(
								'dropEmpresas'=>null,
								'flotas'=>array(null),
								'redirect'=>null,
								'viewTabs'=>array(
											  'dropToneladas'=>true,
											  'dropKilometros'=>false,
											  'dropIngresos'=>true,
											  'dropViajes'=>true,
											  'dropProjection'=>true,
											  'dropAcumulado'=>true
								             ),
								'viewMenu'=>array(
												'dropProjections'=>false,
												'dropIndicadores'=>true,
												'dropCostos'=>true,
												'dropFlujo'=>true
											),
								'other'=>null
							);
	$setConfig['joel.aganzaf@bonampak.com.mx'] = array(
														  'flotas'=>array(null),
														  'redirect'=>'test',
														  'viewTabs'=>array(
																		'dropToneladas'=>false,
																		'dropKilometros'=>false,
																		'dropIngresos'=>false,
																		'dropViajes'=>false,
																		'dropProjection'=>false,
																		'dropAcumulado'=>false
																	  ),
														  'viewMenu'=>array(
																			'dropProjections'=>false,
																			'dropIndicadores'=>true,
																			'dropCostos'=>true,
																			'dropFlujo'=>true
																	  ),
														  'other'=>null
														 );
	$setConfig['1@2.com'] = array(
														  'flotas'=>array(null),
														  'redirect'=>'test',
														  'viewTabs'=>array(
																		'dropToneladas'=>false,
																		'dropKilometros'=>false,
																		'dropIngresos'=>false,
																		'dropViajes'=>false,
																		'dropProjection'=>false,
																		'dropAcumulado'=>false,
																		'dropConfig'=>false
																	  ),
														  'viewMenu'=>array(
																		'dropProjections'=>false,
																		'dropIndicadores'=>false,
																		'dropCostos'=>false,
																		'dropFlujo'=>false
																	  ),
														  'other'=>null
														 );
	$setConfig['admin@bonamapak.com.mx'] = array(
														  'flotas'=>array(null),
														  'redirect'=>'test',
														  'viewTabs'=>array(
																		'dropToneladas'=>false,
																		'dropKilometros'=>false,
																		'dropIngresos'=>false,
																		'dropViajes'=>false,
																		'dropProjection'=>false,
																		'dropAcumulado'=>false,
																		'dropConfig'=>false
																	  ),
														  'viewMenu'=>array(
																		'dropProjections'=>false,
																		'dropIndicadores'=>false,
																		'dropCostos'=>false,
																		'dropFlujo'=>false
																	  ),
														  'other'=>null
														 );
	
	return $setConfig;
  }
	
  /** NOTE drop an area from the user */
  function filterUser($email=null,$areas=null){
	$setConfig = userConfig();
	
	if(isset($setConfig[$email]['flotas'])){ //search mail
	  foreach($setConfig[$email]['flotas'] as $id => $keyToDropArea){
		unset($areas[$keyToDropArea]);
	  }
		$filter['flotas'] = $areas;
		$filter['redirect'] = $setConfig[$email]['redirect'];

	}else{
	  return false;
	}
	return $filter;
  }
  
  function dropTabs($email=null,$areas=null,$id_empresa=null){
	$setConfig = userConfig();
	if(isset($setConfig[$email]['viewTabs'])){ //search mail
	  return $setConfig[$email]['viewTabs'];
	}else{
	  return null;
	}
  }
  
  /** ALERT Operations Sections*/
  
  function unitConfig(){
	/** NOTE @config for tbk */
	$unitConfig['1'] = array(
							  'TiposUnidad'=>array('1','9'),//set the mtto_unidades.tipo_unidad
							  'categoriaOperador'=>'21',//set from personal_catalogo_categoria
							  'id_unidad'=>'TT1000'
							  );
	/** NOTE @config for atm */
	$unitConfig['2'] = array(
							  'TiposUnidad'=>array('1'),//set the mtto_unidades.tipo_unidad
							  'categoriaOperador'=>'2',//set from personal_catalogo_categoria
							  'id_unidad'=>'TT2000'
							  );
	/** NOTE @config for tei */
	$unitConfig['3'] = array(
							  'TiposUnidad'=>array('1'),//set the mtto_unidades.tipo_unidad
							  'categoriaOperador'=>'1',//set from personal_catalogo_categoria
							  'id_unidad'=>'TT3000'
							  );
	return $unitConfig;
  }

  
	  function fleetsConfig(){
		$filter = array('cemento','terceros');
			return $filter;
	  }

	  
	function translate(){
	  $translate = array(
// 						'Area' => 'area',
						'Dia Laboral' => 'current_work_day',
						'Fecha' => 'set_date',
						'Unidades Totales' => 'total_units',
						'Personal Asignado' => 'asigned_personal',
						'Unidades Disponibles' => 'unit_disp',
						'Unidades en Transito' => 'unit_transit',
						'Unidades en Mantenimiento' => 'unit_maintenance',
						'Unidades Accidentadas' => 'unit_accidented',
						'Unidades Cargadas' => 'unit_loaded',
						'Unidades Descargadas' => 'unit_unloaded',
						'Unidades Fuera de Servicio' => 'unit_out_service',
						'Unidades sin Descargar' => 'unit_loaded_stanby',
						'Unidades sin Operador' => 'unit_without_operator',
						'Unidades Detenidas' => 'unit_stopped',
						'Viajes' => 'unit_trips_ha',
						'Cumplimiento' => 'performance',
						'Toneladas Programa' => 'tons_program',
						'Toneladas' => 'tons_real',
						'Productividad' => 'accomplishment'
				  );
		return $translate;
	}
	
	function unidadesNegocio(){
		$bussinessUnits =array(	'1'=>array('Orizaba'=>array('Granel'=>array('Orizaba'=>array('Orizaba'=>'0'))),
								'Guadalajara'=>array('Granel'=>array('Guadalajara'=>array('Guadalajara'=>'0'))),
								'Ramos Arizpe'=>array('Granel'=>array('Ramos Arizpe'=>array('Ramos Arizpe'=>'0'))),
								'Tijuana'=>array('Granel'=>array('Tijuana'=>array('Mexicali'=>'0'))),
								'Hermosillo'=>array('Granel'=>array('Hermosillo'=>array('Hermosillo'=>'0')))
								),
								'2'=>array('Macuspana'=>array('Granel'=>array('Macuspana'=>array('Macuspana'=>'0') ))),
								
								'3'=>array('Teisa'=>array('Granel'=>array('Cuautitlan'=>array('Cuautitlan'=>'0'))))
						);
		
		return $bussinessUnits;
		
	}

	function microtime_float() {
		list($usec, $sec) = explode(" ", microtime());
     return ((float)$usec + (float)$sec);
	}
	
	function case_flotas_tbk() {
		$tipoOperacion['Guadalajara']['La Paz'] = array(
														'12'
												  );
		$tipoOperacion['Guadalajara']['Culiacan'] = array(
														'14'
												  );
		$tipoOperacion['Guadalajara']['Guadalajara'] = array();
		
		return $tipoOperacion;
	}
?>
