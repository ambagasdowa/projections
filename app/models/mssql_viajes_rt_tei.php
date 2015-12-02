<?php
/**
select a.no_viaje,d.tipo_doc,a.status_viaje,d.status_guia,d.prestamo,a.id_area,a.id_unidad,a.id_origen,c.peso,c.peso_estimado,d.num_guia,d.id_fraccion,a.id_configuracionviaje from trafico_viaje as a inner join trafico_renglon_viaje as b on a.no_viaje = b.no_viaje and a.id_area=b.id_area inner join trafico_renglon_guia as c on b.no_guia = c.no_guia and a.id_area = c.id_area inner join trafico_guia as d on a.id_area=d.id_area and a.no_viaje=d.no_viaje where YEAR(a.f_despachado) = '2015' and MONTH(a.f_despachado) ='01' and day(a.f_despachado)='20' and d.status_guia <> 'B' and d.tipo_origen <> 1 and d.prestamo='N' and a.id_area='2' ;
inner mtto_unidades
select a.no_viaje,d.tipo_doc,a.status_viaje,d.status_guia,d.prestamo,a.id_area,a.id_unidad,e.id_flota,a.id_origen,c.peso,c.peso_estimado,d.num_guia,d.id_fraccion,a.id_configuracionviaje from trafico_viaje as a inner join trafico_renglon_viaje as b on a.no_viaje = b.no_viaje and a.id_area=b.id_area inner join trafico_renglon_guia as c on b.no_guia = c.no_guia and a.id_area = c.id_area inner join trafico_guia as d on a.id_area=d.id_area and a.no_viaje=d.no_viaje inner join mtto_unidades as e on a.id_area=e.id_area and a.id_unidad = e.id_unidad and a.id_area=e.id_area where YEAR(a.f_despachado) = '2015' and MONTH(a.f_despachado) ='01' and day(a.f_despachado)='20' and d.status_guia <> 'B' and d.tipo_origen <> 1 and d.prestamo='N' and a.id_area='2' ;


tables => trafico_viaje ,trafico_renglon_guia,trafico_renglon_viaje,trafico_guia .
*/
?>
<?php
  class MssqlViajesRtTei extends AppModel{
	var $name = 'MssqlViajesRtTei';
	var $useDbConfig = 'mssqlTei';
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
		$fieldTraficoViaje = array('MssqlViajesRtTei.no_viaje');
		$conditions['MssqlViajesRtTei.id_area'] = $id_area;
// 		$conditions['MssqlViajesRtTei.no_viaje'] = $no_viaje;
		$conditions['YEAR(MssqlViajesRtTei.f_despachado)'] = $getDate['0'];
		$conditions['MONTH(MssqlViajesRtTei.f_despachado)'] = $getDate['1'];
		$conditions['DAY(MssqlViajesRtTei.f_despachado)'] = $getDate['2'];
// 		$conditions['DAY(MssqlViajesRtTei.f_despachado)'] = '20';

		
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
// 		pr($getTraficoViaje);
// exit();
		foreach($getTraficoViaje as $upKey => $Data){
			$getTraficoViaje = Set::combine($getTraficoViaje, '{n}.'.$fieldTraficoViaje['0'], '{n}');
		}

		$traficoViaje['trafico_viaje'] = $getTraficoViaje;
		foreach($getTraficoViaje as $numero_viaje => $viajeContents){
		  $no_viaje[] = $numero_viaje;
		}
// 		pr($getTraficoViaje);
// 		pr($no_viaje);
// exit();

		$fieldTraficoRengloViaje = array('MssqlTraficoRenglonViajeTei.no_viaje');
		$conditionsTraficoRenglonViaje['MssqlTraficoRenglonViajeTei.id_area'] = $id_area;
		$conditionsTraficoRenglonViaje['MssqlTraficoRenglonViajeTei.no_viaje'] = $no_viaje;
		$fieldsTraficoRenglonViaje = array(
						'MssqlTraficoRenglonViajeTei.id_area',
						'MssqlTraficoRenglonViajeTei.no_viaje',
						'MssqlTraficoRenglonViajeTei.no_guia'
					   );

		App::import('model','MssqlTraficoRenglonViajeTei');
		  $TraficoRenglonViaje = new MssqlTraficoRenglonViajeTei();
		  $getTraficoRenglonViaje = $TraficoRenglonViaje->find('all',array('conditions'=>$conditionsTraficoRenglonViaje,'fields'=>$fieldsTraficoRenglonViaje));
		
		foreach($getTraficoRenglonViaje as $upKey => $Data){
			$getTraficoRenglonViaje = Set::combine($getTraficoRenglonViaje, '{n}.'.$fieldTraficoRengloViaje['0'], '{n}');
		}
		$traficoViaje['traficoRenglonViaje'] = $getTraficoRenglonViaje;
// 		pr($getTraficoRenglonViaje);
		foreach($getTraficoRenglonViaje as $numeroViaje => $ViajeContent){
		  $no_guia[] = $ViajeContent['MssqlTraficoRenglonViajeTei']['no_guia'];
		}
		if(!isset($no_guia)){
		  return null;
		  break;
		}
		$fieldTraficoRenglonGuia = array('MssqlTraficoRenglonGuiaTei.no_guia');
		$conditionsTraficoRenglonGuia['MssqlTraficoRenglonGuiaTei.id_area'] = $id_area;
		if(isset($no_guia) OR empty($no_guia)){
		  $conditionsTraficoRenglonGuia['MssqlTraficoRenglonGuiaTei.no_guia'] = $no_guia;
		}
		$fieldsTraficoRenglonGuia = array(
						'MssqlTraficoRenglonGuiaTei.no_guia',
						'MssqlTraficoRenglonGuiaTei.id_area',
						'MssqlTraficoRenglonGuiaTei.id_fraccion',
						'MssqlTraficoRenglonGuiaTei.peso',
						'MssqlTraficoRenglonGuiaTei.peso_estimado',
						'MssqlTraficoRenglonGuiaTei.descripcion_producto'
					   );

		App::import('model','MssqlTraficoRenglonGuiaTei');
		  $TraficoRenglonGuia = new MssqlTraficoRenglonGuiaTei();
		  $getTraficoRenglonGuia = $TraficoRenglonGuia->find('all',array('conditions'=>$conditionsTraficoRenglonGuia,'fields'=>$fieldsTraficoRenglonGuia));
		
		foreach($getTraficoRenglonGuia as $upKey => $Data){
			$getTraficoRenglonGuia = Set::combine($getTraficoRenglonGuia, '{n}.'.$fieldTraficoRenglonGuia['0'], '{n}');
		}
// 		pr($getTraficoRenglonGuia);
// 		exit();
		$traficoViaje['traficoRenglonGuia'] = $getTraficoRenglonGuia;
		
		$fieldTraficoGuia = array('MssqlTraficoGuiaTei.no_guia');
		$conditionsTraficoGuia['MssqlTraficoGuiaTei.no_guia'] = $no_guia;
		$conditionsTraficoGuia['MssqlTraficoGuiaTei.id_area'] = $id_area;
		$conditionsTraficoGuia['MssqlTraficoGuiaTei.no_viaje'] = $no_viaje;
// 		$conditionsTraficoGuia['MssqlTraficoGuiaTei.prestamo'] = 'N';
		$conditionsTraficoGuia['MssqlTraficoGuiaTei.status_guia <>'] = 'B';
		$fieldsTraficoGuia = array(
						'MssqlTraficoGuiaTei.no_guia',
						'MssqlTraficoGuiaTei.id_area',
						'MssqlTraficoGuiaTei.tipo_doc',
						'MssqlTraficoGuiaTei.status_guia',
						'MssqlTraficoGuiaTei.id_fraccion',
						'MssqlTraficoGuiaTei.num_guia',
						'MssqlTraficoGuiaTei.id_unidad',
						'MssqlTraficoGuiaTei.no_viaje',
						'MssqlTraficoGuiaTei.id_fraccion',
// 						'MssqlTraficoGuiaTei.id_flota',
						'MssqlTraficoGuiaTei.prestamo'
					   );

		App::import('model','MssqlTraficoGuiaTei');
		  $TraficoGuia = new MssqlTraficoGuiaTei();
// 		exit();
		$getTraficoGuia = $TraficoGuia->find('all',array('conditions'=>$conditionsTraficoGuia,'fields'=>$fieldsTraficoGuia));
// 		pr($getTraficoGuia);
		foreach($getTraficoGuia as $upKey => $Data){
			$getTraficoGuia = Set::combine($getTraficoGuia, '{n}.'.$fieldTraficoGuia['0'], '{n}');
		}
// 		pr($getTraficoGuia);
		$traficoViaje['traficoGuia'] = $getTraficoGuia;
		
/** NOTE set the tons according with is no of viaje remenber they have a id_configuracionviaje but ....**/
/** NOTE don't forget commit this **/
		foreach($traficoViaje['traficoGuia'] as $numero_no_de_guia => $sqlTraficoGuia){
// 		  pr($sqlTraficoGuia);
		  $no_of_guia['MssqlTraficoRenglonGuiaTei.no_guia'][] = $sqlTraficoGuia['MssqlTraficoGuiaTei']['no_guia'];
		  $noOfGuia['no_guia'][$sqlTraficoGuia['MssqlTraficoGuiaTei']['no_viaje']][] = $sqlTraficoGuia['MssqlTraficoGuiaTei']['no_guia'];
		}
		$no_of_guia['MssqlTraficoRenglonGuiaTei.id_area'] = $id_area;
// 		pr($no_of_guia);
// 		pr($noOfGuia);
		$peso = $TraficoRenglonGuia->find('all',array('conditions'=>$no_of_guia,'fields'=>$fieldsTraficoRenglonGuia));
		foreach($peso as $idCount => $tonsContent){
		  if(!isset($toneladas[$tonsContent['MssqlTraficoRenglonGuiaTei']['no_guia']])){
			$toneladasNoOfGuia[$tonsContent['MssqlTraficoRenglonGuiaTei']['no_guia']] = null;
		  }
		  $toneladasNoOfGuia[$tonsContent['MssqlTraficoRenglonGuiaTei']['no_guia']] += $tonsContent['MssqlTraficoRenglonGuiaTei']['peso'] + $tonsContent['MssqlTraficoRenglonGuiaTei']['peso_estimado'];
		}
// 		pr($toneladasNoOfGuia);
		foreach($noOfGuia['no_guia'] as $noViaje => $noGuiaContent){
		  foreach($noGuiaContent as $inx =>$noGuia){
			if(!isset($toneladas[$noViaje])){
			  $toneladas[$noViaje] = null;
			}
			$toneladas[$noViaje] += $toneladasNoOfGuia[$noGuia];
		  }
		}
// // // // // // // // // // // // // // // // // // // // // // // // //
		App::import('model','MssqlMttoUnidadesTei');
		  $MttoUnidades = new MssqlMttoUnidadesTei();

// 		  pr(unitConfig()[$id_empresa]['id_unidad']);
		$fieldMttoUnidades = array('MssqlMttoUnidadesTei.id_unidad');
		$conditionsMttoUnidades['MssqlMttoUnidadesTei.id_area'] = $id_area;
		$conditionsMttoUnidades['MssqlMttoUnidadesTei.tipo_unidad'] = unitConfig()[$id_empresa]['TiposUnidad'];
		$conditionsMttoUnidades['MssqlMttoUnidadesTei.estatus'] = 'A';
		$conditionsMttoUnidades['MssqlMttoUnidadesTei.id_unidad <>'] = unitConfig()[$id_empresa]['id_unidad'];
		
		$fieldsMttoUnidades = array(
						'MssqlMttoUnidadesTei.id_unidad',
						'MssqlMttoUnidadesTei.id_area',
						'MssqlMttoUnidadesTei.id_flota',
						'MssqlMttoUnidadesTei.tipo_unidad',
						'MssqlMttoUnidadesTei.status_unidad',
						'MssqlMttoUnidadesTei.id_operador',
						'MssqlMttoUnidadesTei.id_status',
						'MssqlMttoUnidadesTei.estatus'
					   );

		$getMttoUnidades = $MttoUnidades->find('all',array('conditions'=>$conditionsMttoUnidades,'fields'=>$fieldsMttoUnidades));
		foreach($getMttoUnidades as $Key => $Dato){
			$getMttoUnidad = Set::combine($getMttoUnidades, '{n}.'.$fieldMttoUnidades['0'], '{n}');
		}
// 		pr($getMttoUnidad);
// 		exit();
// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // 
		
// 		$fields['camps'] = array('id_fraccion',);
		foreach($traficoViaje['trafico_viaje'] as $numero_de_viaje => $mssqlViajesTei){
		  $traficoViaje['viajes'][$numero_de_viaje] = $mssqlViajesTei['MssqlViajesRtTei'];
		  foreach($mssqlViajesTei['MssqlViajesRtTei'] as $fieldDescription => $fieldData){

			//NOTE add offset null
			$guia = $getTraficoRenglonViaje[$numero_de_viaje]['MssqlTraficoRenglonViajeTei']['no_guia'];
// 			pr($guia);
			$traficoViaje['viajes'][$numero_de_viaje]['no_guia'] = $guia;
			
			if(isset($getTraficoRenglonGuia[$guia])){
			  $traficoViaje['viajes'][$numero_de_viaje]['id_fraccion'] = $getTraficoRenglonGuia[$guia]['MssqlTraficoRenglonGuiaTei']['id_fraccion'];
			  $traficoViaje['viajes'][$numero_de_viaje]['peso'] = $getTraficoRenglonGuia[$guia]['MssqlTraficoRenglonGuiaTei']['peso'];
			  $traficoViaje['viajes'][$numero_de_viaje]['peso_estimado'] = $getTraficoRenglonGuia[$guia]['MssqlTraficoRenglonGuiaTei']['peso_estimado'];
			  $traficoViaje['viajes'][$numero_de_viaje]['descripcion_producto'] = $getTraficoRenglonGuia[$guia]['MssqlTraficoRenglonGuiaTei']['descripcion_producto'];
			}
			if(isset($getTraficoGuia[$guia])){
			  $traficoViaje['viajes'][$numero_de_viaje]['tipo_doc'] = $getTraficoGuia[$guia]['MssqlTraficoGuiaTei']['tipo_doc'];
			  $traficoViaje['viajes'][$numero_de_viaje]['status_guia'] = $getTraficoGuia[$guia]['MssqlTraficoGuiaTei']['status_guia'];
			  $traficoViaje['viajes'][$numero_de_viaje]['num_guia'] = $getTraficoGuia[$guia]['MssqlTraficoGuiaTei']['num_guia'];
			  $traficoViaje['viajes'][$numero_de_viaje]['id_unidad'] = $getTraficoGuia[$guia]['MssqlTraficoGuiaTei']['id_unidad'];
			  $traficoViaje['viajes'][$numero_de_viaje]['prestamo'] = $getTraficoGuia[$guia]['MssqlTraficoGuiaTei']['prestamo'];
			}
			
			
			if(!empty($guia)){
			  $traficoViaje['viajes'][$numero_de_viaje]['id_flota'] = $getMttoUnidad[$getTraficoGuia[$guia]['MssqlTraficoGuiaTei']['id_unidad']]['MssqlMttoUnidadesTei']['id_flota'];
			  $traficoViaje['viajes_count'][$getMttoUnidad[$getTraficoGuia[$guia]['MssqlTraficoGuiaTei']['id_unidad']]['MssqlMttoUnidadesTei']['id_flota']][$numero_de_viaje] = $getMttoUnidad[$getTraficoGuia[$guia]['MssqlTraficoGuiaTei']['id_unidad']]['MssqlMttoUnidadesTei']['id_flota'];

			  $traficoViaje['toneladas'][$getMttoUnidad[$getTraficoGuia[$guia]['MssqlTraficoGuiaTei']['id_unidad']]['MssqlMttoUnidadesTei']['id_flota']][$numero_de_viaje] = $toneladas[$numero_de_viaje];

			}

		  }
		}
// 		pr($traficoViaje['viajes']);
	  return $traficoViaje;
	}//End MssqlUnidadesAsignadasTei
	
  }//End get viajes despachados
?>









