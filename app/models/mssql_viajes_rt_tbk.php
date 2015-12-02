<?php
/**
select a.no_viaje,d.tipo_doc,a.status_viaje,d.status_guia,d.prestamo,a.id_area,a.id_unidad,a.id_origen,c.peso,c.peso_estimado,d.num_guia,d.id_fraccion,a.id_configuracionviaje from trafico_viaje as a inner join trafico_renglon_viaje as b on a.no_viaje = b.no_viaje and a.id_area=b.id_area inner join trafico_renglon_guia as c on b.no_guia = c.no_guia and a.id_area = c.id_area inner join trafico_guia as d on a.id_area=d.id_area and a.no_viaje=d.no_viaje where YEAR(a.f_despachado) = '2015' and MONTH(a.f_despachado) ='01' and day(a.f_despachado)='20' and d.status_guia <> 'B' and d.tipo_origen <> 1 and d.prestamo='N' and a.id_area='2' ;
inner mtto_unidades
select a.no_viaje,d.tipo_doc,a.status_viaje,d.status_guia,d.prestamo,a.id_area,a.id_unidad,e.id_flota,a.id_origen,c.peso,c.peso_estimado,d.num_guia,d.id_fraccion,a.id_configuracionviaje from trafico_viaje as a inner join trafico_renglon_viaje as b on a.no_viaje = b.no_viaje and a.id_area=b.id_area inner join trafico_renglon_guia as c on b.no_guia = c.no_guia and a.id_area = c.id_area inner join trafico_guia as d on a.id_area=d.id_area and a.no_viaje=d.no_viaje inner join mtto_unidades as e on a.id_area=e.id_area and a.id_unidad = e.id_unidad and a.id_area=e.id_area where YEAR(a.f_despachado) = '2015' and MONTH(a.f_despachado) ='01' and day(a.f_despachado)='20' and d.status_guia <> 'B' and d.tipo_origen <> 1 and d.prestamo='N' and a.id_area='2' ;


tables => trafico_viaje ,trafico_renglon_guia,trafico_renglon_viaje,trafico_guia .
*/
?>
<?php
  class MssqlViajesRtTbk extends AppModel{
	var $name = 'MssqlViajesRtTbk';
// 	var $useDbConfig = 'mssqlAtm';
	var $useTable = 'trafico_viaje';
	var $primaryKey = 'no_viaje';

// 	var $virtualFields = array(
// 								'div'=>'CONCAT(RealmsClass.prefix,RealmsClass.id_realms_class)'
// 						);
// 	var $displayField = 'div';

/** NOTE the function removeString comes from appConfig*/

// 	function getAreas(){
// // 	  from isql -v odbc-macuspanadb zam lis
// // 	  select id_area,nombre from general_area;select * from desp_flotas;select * from desp_tipooperacion;
// 	  $areas = $this->find('all');
// 	  unset($areas[0]);
// 	  $string=array('AUTOTRANSPORTE','S.A.','DE','C.V.','.');
// 	  return removeString($arrayString=$areas,$string,$model='MssqlAreasAtm',$field='nombre');
// 	} /** @end of @getAreas() */

	
	function getMssqlTraficoViaje($id_area=null,$no_viaje=null,$fecha=null,$id_empresa=null){

	  /** Define some variables 
	   */
	  if(!isset($no_guia)){
		$no_guia= null;
	  }
	  if(empty($id_empresa)){
		$id_empresa = $_SESSION['Auth']['User']['id_empresa'];
	  }
	  if(empty($id_area)){
	  	$id_area = '1';
	  }
	  if(empty($fecha)){
		$fecha = date('Y-m-d');
	  }
		$getDate = explode('-',$fecha);
// 		var_dump($getDate);
		$fieldTraficoViaje = array('MssqlViajesRtTbk.no_viaje');
		$conditions['MssqlViajesRtTbk.id_area'] = $id_area;
// 		$conditions['MssqlViajesRtTbk.no_viaje'] = $no_viaje;
		$conditions['YEAR(MssqlViajesRtTbk.f_despachado)'] = $getDate['0'];
		$conditions['MONTH(MssqlViajesRtTbk.f_despachado)'] = $getDate['1'];
		$conditions['DAY(MssqlViajesRtTbk.f_despachado)'] = $getDate['2'];
// 		$conditions['DAY(MssqlViajesRtTbk.f_despachado)'] = '20';

		
		$fieldsTraficoViaje = array(
						'id_area',
						'no_viaje',
						'f_despachado',
						'id_personal',
						'id_unidad',
						'status_viaje',
						'id_configuracionviaje',
						'id_origen'
					   );
		
		$getTraficoViaje = $this->find('all',array('fields'=>$fieldsTraficoViaje,'conditions'=>$conditions));
		foreach($getTraficoViaje as $upKey => $Data){
			$getTraficoViaje = Set::combine($getTraficoViaje, '{n}.'.$fieldTraficoViaje['0'], '{n}');
		}

		$traficoViaje['trafico_viaje'] = $getTraficoViaje;
		foreach($getTraficoViaje as $numero_viaje => $viajeContents){
		  $no_viaje[] = $numero_viaje;
		}
// 		pr($no_viaje);

		$fieldTraficoRengloViaje = array('MssqlTraficoRenglonViajeTbk.no_viaje');
		$conditionsTraficoRenglonViaje['MssqlTraficoRenglonViajeTbk.id_area'] = $id_area;
		$conditionsTraficoRenglonViaje['MssqlTraficoRenglonViajeTbk.no_viaje'] = $no_viaje;
		$fieldsTraficoRenglonViaje = array(
						'MssqlTraficoRenglonViajeTbk.id_area',
						'MssqlTraficoRenglonViajeTbk.no_viaje',
						'MssqlTraficoRenglonViajeTbk.no_guia'
					   );

		App::import('model','MssqlTraficoRenglonViajeTbk');
		  $TraficoRenglonViaje = new MssqlTraficoRenglonViajeTbk();
		  $getTraficoRenglonViaje = $TraficoRenglonViaje->find('all',array('conditions'=>$conditionsTraficoRenglonViaje,'fields'=>$fieldsTraficoRenglonViaje));
// 		pr($getTraficoRenglonViaje);
// 		exit();
		foreach($getTraficoRenglonViaje as $upKey => $Data){
			$getTraficoRenglonViaje = Set::combine($getTraficoRenglonViaje, '{n}.'.$fieldTraficoRengloViaje['0'], '{n}');
		}
		$traficoViaje['traficoRenglonViaje'] = $getTraficoRenglonViaje;
// 		pr($getTraficoRenglonViaje);
		foreach($getTraficoRenglonViaje as $numeroViaje => $ViajeContent){
		  $no_guia[] = $ViajeContent['MssqlTraficoRenglonViajeTbk']['no_guia'];
		}

		if(!isset($no_guia)){
		  return null;
		  break;
		}
	
		$fieldTraficoRenglonGuia = array('MssqlTraficoRenglonGuiaTbk.no_guia');
		$conditionsTraficoRenglonGuia['MssqlTraficoRenglonGuiaTbk.id_area'] = $id_area;
// 		if(isset($no_guia) OR !empty($no_guia)){
		  $conditionsTraficoRenglonGuia['MssqlTraficoRenglonGuiaTbk.no_guia'] = $no_guia;
// 		}
		$fieldsTraficoRenglonGuia = array(
						'MssqlTraficoRenglonGuiaTbk.no_guia',
						'MssqlTraficoRenglonGuiaTbk.id_area',
						'MssqlTraficoRenglonGuiaTbk.id_fraccion',
						'MssqlTraficoRenglonGuiaTbk.peso',
						'MssqlTraficoRenglonGuiaTbk.peso_estimado',
						'MssqlTraficoRenglonGuiaTbk.descripcion_producto'
					   );

		App::import('model','MssqlTraficoRenglonGuiaTbk');
		  $TraficoRenglonGuia = new MssqlTraficoRenglonGuiaTbk();
		  $getTraficoRenglonGuia = $TraficoRenglonGuia->find('all',array('conditions'=>$conditionsTraficoRenglonGuia,'fields'=>$fieldsTraficoRenglonGuia));
// 		pr($getTraficoRenglonGuia);
		foreach($getTraficoRenglonGuia as $upKey => $Data){
			$getTraficoRenglonGuia = Set::combine($getTraficoRenglonGuia, '{n}.'.$fieldTraficoRenglonGuia['0'], '{n}');
		}
// 		pr($getTraficoRenglonGuia);
// 		exit();
		$traficoViaje['traficoRenglonGuia'] = $getTraficoRenglonGuia;
		
		$fieldTraficoGuia = array('MssqlTraficoGuiaTbk.no_guia');
// 		$conditionsTraficoGuia['MssqlTraficoGuiaTbk.no_guia'] = $no_guia;
		$conditionsTraficoGuia['MssqlTraficoGuiaTbk.id_area'] = $id_area;
		$conditionsTraficoGuia['MssqlTraficoGuiaTbk.no_viaje'] = $no_viaje;
		$conditionsTraficoGuia['MssqlTraficoGuiaTbk.tipo_doc'] = '2';
// 		$conditionsTraficoGuia['MssqlTraficoGuiaTbk.prestamo'] = 'N';
		$conditionsTraficoGuia['MssqlTraficoGuiaTbk.status_guia <>'] = 'B';
		$fieldsTraficoGuia = array(
						'MssqlTraficoGuiaTbk.no_guia',
						'MssqlTraficoGuiaTbk.id_area',
						'MssqlTraficoGuiaTbk.tipo_doc',
						'MssqlTraficoGuiaTbk.status_guia',
						'MssqlTraficoGuiaTbk.id_fraccion',
						'MssqlTraficoGuiaTbk.num_guia',
						'MssqlTraficoGuiaTbk.id_unidad',
						'MssqlTraficoGuiaTbk.no_viaje',
						'MssqlTraficoGuiaTbk.id_fraccion',
// 						'MssqlTraficoGuiaTbk.id_flota',
						'MssqlTraficoGuiaTbk.prestamo'
					   );

		App::import('model','MssqlTraficoGuiaTbk');
		  $TraficoGuia = new MssqlTraficoGuiaTbk();
// 		exit();
		$getTraficoGuia = $TraficoGuia->find('all',array('conditions'=>$conditionsTraficoGuia,'fields'=>$fieldsTraficoGuia));
// 		pr($getTraficoGuia);
// 		exit();
		foreach($getTraficoGuia as $upKey => $Data){
			$getTraficoGuia = Set::combine($getTraficoGuia, '{n}.'.$fieldTraficoGuia['0'], '{n}');
		}
// 		pr(count($getTraficoGuia));
		$traficoViaje['traficoGuia'] = $getTraficoGuia;
		
		
		
/** NOTE set the tons according with is no of viaje remenber they have a id_configuracionviaje but ....**/
/** NOTE don't forget commit this **/
		foreach($traficoViaje['traficoGuia'] as $numero_no_de_guia => $sqlTraficoGuia){
// 		  pr($sqlTraficoGuia);
		  $no_of_guia['MssqlTraficoRenglonGuiaTbk.no_guia'][] = $sqlTraficoGuia['MssqlTraficoGuiaTbk']['no_guia'];
		  $noOfGuia['no_guia'][$sqlTraficoGuia['MssqlTraficoGuiaTbk']['no_viaje']][] = $sqlTraficoGuia['MssqlTraficoGuiaTbk']['no_guia'];
		}
		$no_of_guia['MssqlTraficoRenglonGuiaTbk.id_area'] = $id_area;
// 		pr($no_of_guia);
// 		pr($noOfGuia);
		$peso = $TraficoRenglonGuia->find('all',array('conditions'=>$no_of_guia,'fields'=>$fieldsTraficoRenglonGuia));
		foreach($peso as $idCount => $tonsContent){
		  if(!isset($toneladas[$tonsContent['MssqlTraficoRenglonGuiaTbk']['no_guia']])){
			$toneladasNoOfGuia[$tonsContent['MssqlTraficoRenglonGuiaTbk']['no_guia']] = null;
		  }
		  $toneladasNoOfGuia[$tonsContent['MssqlTraficoRenglonGuiaTbk']['no_guia']] += $tonsContent['MssqlTraficoRenglonGuiaTbk']['peso'] + $tonsContent['MssqlTraficoRenglonGuiaTbk']['peso_estimado'];
		}
// 		pr($toneladasNoOfGuia);
		if(isset($noOfGuia['no_guia'])){
		  foreach($noOfGuia['no_guia'] as $noViaje => $noGuiaContent){
			foreach($noGuiaContent as $inx =>$noGuia){
			  if(!isset($toneladas[$noViaje])){
				$toneladas[$noViaje] = null;
			  }
			  $toneladas[$noViaje] += $toneladasNoOfGuia[$noGuia];
			}
		  }
		}

// // // // // // // // // // // // // // // // // // // // // // // // //
		App::import('model','MssqlMttoUnidadesTbk');
		  $MttoUnidades = new MssqlMttoUnidadesTbk();

// 		  pr(unitConfig()[$id_empresa]['id_unidad']);
		$fieldMttoUnidades = array('MssqlMttoUnidadesTbk.id_unidad');
		$conditionsMttoUnidades['MssqlMttoUnidadesTbk.id_area'] = $id_area;
		$conditionsMttoUnidades['MssqlMttoUnidadesTbk.tipo_unidad'] = unitConfig()[$id_empresa]['TiposUnidad'];
		$conditionsMttoUnidades['MssqlMttoUnidadesTbk.estatus'] = 'A';
		$conditionsMttoUnidades['MssqlMttoUnidadesTbk.id_unidad <>'] = unitConfig()[$id_empresa]['id_unidad'];
		
		$fieldsMttoUnidades = array(
						'MssqlMttoUnidadesTbk.id_unidad',
						'MssqlMttoUnidadesTbk.id_area',
						'MssqlMttoUnidadesTbk.id_flota',
						'MssqlMttoUnidadesTbk.tipo_unidad',
						'MssqlMttoUnidadesTbk.status_unidad',
						'MssqlMttoUnidadesTbk.id_operador',
						'MssqlMttoUnidadesTbk.id_status',
						'MssqlMttoUnidadesTbk.estatus'
					   );

		$getMttoUnidades = $MttoUnidades->find('all',array('conditions'=>$conditionsMttoUnidades,'fields'=>$fieldsMttoUnidades));
		foreach($getMttoUnidades as $Key => $Dato){
			$getMttoUnidad = Set::combine($getMttoUnidades, '{n}.'.$fieldMttoUnidades['0'], '{n}');
		}
// 		pr($getMttoUnidad);
// 		exit();
// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // 
		
// 		$fields['camps'] = array('id_fraccion',);
		foreach($traficoViaje['trafico_viaje'] as $numero_de_viaje => $mssqlViajesTbk){
		  $traficoViaje['viajes'][$numero_de_viaje] = $mssqlViajesTbk['MssqlViajesRtTbk'];
		  foreach($mssqlViajesTbk['MssqlViajesRtTbk'] as $fieldDescription => $fieldData){

			//NOTE add offset null
			$guia = $getTraficoRenglonViaje[$numero_de_viaje]['MssqlTraficoRenglonViajeTbk']['no_guia'];
// 			pr($guia);
			$traficoViaje['viajes'][$numero_de_viaje]['no_guia'] = $guia;
			
			if(isset($getTraficoRenglonGuia[$guia])){
			  $traficoViaje['viajes'][$numero_de_viaje]['id_fraccion'] = $getTraficoRenglonGuia[$guia]['MssqlTraficoRenglonGuiaTbk']['id_fraccion'];
			  $traficoViaje['viajes'][$numero_de_viaje]['peso'] = $getTraficoRenglonGuia[$guia]['MssqlTraficoRenglonGuiaTbk']['peso'];
			  $traficoViaje['viajes'][$numero_de_viaje]['peso_estimado'] = $getTraficoRenglonGuia[$guia]['MssqlTraficoRenglonGuiaTbk']['peso_estimado'];
			  $traficoViaje['viajes'][$numero_de_viaje]['toneladas'] = $toneladas[$numero_de_viaje];
			  $traficoViaje['viajes'][$numero_de_viaje]['descripcion_producto'] = $getTraficoRenglonGuia[$guia]['MssqlTraficoRenglonGuiaTbk']['descripcion_producto'];
			}
			if(isset($getTraficoGuia[$guia])){
			  $traficoViaje['viajes'][$numero_de_viaje]['tipo_doc'] = $getTraficoGuia[$guia]['MssqlTraficoGuiaTbk']['tipo_doc'];
			  $traficoViaje['viajes'][$numero_de_viaje]['status_guia'] = $getTraficoGuia[$guia]['MssqlTraficoGuiaTbk']['status_guia'];
			  $traficoViaje['viajes'][$numero_de_viaje]['num_guia'] = $getTraficoGuia[$guia]['MssqlTraficoGuiaTbk']['num_guia'];
			  $traficoViaje['viajes'][$numero_de_viaje]['id_unidad'] = $getTraficoGuia[$guia]['MssqlTraficoGuiaTbk']['id_unidad'];
			  $traficoViaje['viajes'][$numero_de_viaje]['prestamo'] = $getTraficoGuia[$guia]['MssqlTraficoGuiaTbk']['prestamo'];
			}
			
			  
			if(!empty($guia)){
			$traficoViaje['viajes'][$numero_de_viaje]['id_flota'] = $getMttoUnidad[$getTraficoGuia[$guia]['MssqlTraficoGuiaTbk']['id_unidad']]['MssqlMttoUnidadesTbk']['id_flota'];
			
			  $traficoViaje['viajes_count'][$getMttoUnidad[$getTraficoGuia[$guia]['MssqlTraficoGuiaTbk']['id_unidad']]['MssqlMttoUnidadesTbk']['id_flota']][$numero_de_viaje] = $getMttoUnidad[$getTraficoGuia[$guia]['MssqlTraficoGuiaTbk']['id_unidad']]['MssqlMttoUnidadesTbk']['id_flota'];
			  
			  $traficoViaje['toneladas'][$getMttoUnidad[$getTraficoGuia[$guia]['MssqlTraficoGuiaTbk']['id_unidad']]['MssqlMttoUnidadesTbk']['id_flota']][$numero_de_viaje] = $toneladas[$numero_de_viaje];
			}
		  }
		}
// 		pr($traficoViaje);
	  return $traficoViaje;
	}//End MssqlUnidadesAsignadasTei
	
  }//End get viajes despachados
?>









