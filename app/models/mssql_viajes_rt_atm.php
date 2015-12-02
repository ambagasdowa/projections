<?php
/**
select a.no_viaje,d.tipo_doc,a.status_viaje,d.status_guia,d.prestamo,a.id_area,a.id_unidad,a.id_origen,c.peso,c.peso_estimado,d.num_guia,d.id_fraccion,a.id_configuracionviaje from trafico_viaje as a inner join trafico_renglon_viaje as b on a.no_viaje = b.no_viaje and a.id_area=b.id_area inner join trafico_renglon_guia as c on b.no_guia = c.no_guia and a.id_area = c.id_area inner join trafico_guia as d on a.id_area=d.id_area and a.no_viaje=d.no_viaje where YEAR(a.f_despachado) = '2015' and MONTH(a.f_despachado) ='01' and day(a.f_despachado)='20' and d.status_guia <> 'B' and d.tipo_origen <> 1 and d.prestamo='N' and a.id_area='2' ;
inner mtto_unidades
select a.no_viaje,d.tipo_doc,a.status_viaje,d.status_guia,d.prestamo,a.id_area,a.id_unidad,e.id_flota,a.id_origen,c.peso,c.peso_estimado,d.num_guia,d.id_fraccion,a.id_configuracionviaje from trafico_viaje as a inner join trafico_renglon_viaje as b on a.no_viaje = b.no_viaje and a.id_area=b.id_area inner join trafico_renglon_guia as c on b.no_guia = c.no_guia and a.id_area = c.id_area inner join trafico_guia as d on a.id_area=d.id_area and a.no_viaje=d.no_viaje inner join mtto_unidades as e on a.id_area=e.id_area and a.id_unidad = e.id_unidad and a.id_area=e.id_area where YEAR(a.f_despachado) = '2015' and MONTH(a.f_despachado) ='01' and day(a.f_despachado)='20' and d.status_guia <> 'B' and d.tipo_origen <> 1 and d.prestamo='N' and a.id_area='2' ;


tables => trafico_viaje ,trafico_renglon_guia,trafico_renglon_viaje,trafico_guia .
*/
?>
<?php
  class MssqlViajesRtAtm extends AppModel{
	var $name = 'MssqlViajesRtAtm';
	var $useDbConfig = 'mssqlAtm';
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
		$fieldTraficoViaje = array('MssqlViajesRtAtm.no_viaje');
		$conditions['MssqlViajesRtAtm.id_area'] = $id_area;
// 		$conditions['MssqlViajesRtAtm.no_viaje'] = $no_viaje;
		$conditions['YEAR(MssqlViajesRtAtm.f_despachado)'] = $getDate['0'];
		$conditions['MONTH(MssqlViajesRtAtm.f_despachado)'] = $getDate['1'];
		$conditions['DAY(MssqlViajesRtAtm.f_despachado)'] = $getDate['2'];
// 		$conditions['DAY(MssqlViajesRtAtm.f_despachado)'] = '20';

		
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


		$fieldTraficoRengloViaje = array('MssqlTraficoRenglonViajeAtm.no_viaje');
		$conditionsTraficoRenglonViaje['MssqlTraficoRenglonViajeAtm.id_area'] = $id_area;
		$conditionsTraficoRenglonViaje['MssqlTraficoRenglonViajeAtm.no_viaje'] = $no_viaje;
		$fieldsTraficoRenglonViaje = array(
						'MssqlTraficoRenglonViajeAtm.id_area',
						'MssqlTraficoRenglonViajeAtm.no_viaje',
						'MssqlTraficoRenglonViajeAtm.no_guia'
					   );

		App::import('model','MssqlTraficoRenglonViajeAtm');
		  $TraficoRenglonViaje = new MssqlTraficoRenglonViajeAtm();
		  $getTraficoRenglonViaje = $TraficoRenglonViaje->find('all',array('conditions'=>$conditionsTraficoRenglonViaje,'fields'=>$fieldsTraficoRenglonViaje));
		
		foreach($getTraficoRenglonViaje as $upKey => $Data){
			$getTraficoRenglonViaje = Set::combine($getTraficoRenglonViaje, '{n}.'.$fieldTraficoRengloViaje['0'], '{n}');
		}
		$traficoViaje['traficoRenglonViaje'] = $getTraficoRenglonViaje;
// 		pr($getTraficoRenglonViaje);
		foreach($getTraficoRenglonViaje as $numeroViaje => $ViajeContent){
		  $no_guia[] = $ViajeContent['MssqlTraficoRenglonViajeAtm']['no_guia'];
		}
		if(!isset($no_guia)){
		  return null;
		  break;
		}

		$fieldTraficoRenglonGuia = array('MssqlTraficoRenglonGuiaAtm.no_guia');
		$conditionsTraficoRenglonGuia['MssqlTraficoRenglonGuiaAtm.id_area'] = $id_area;
		if(isset($no_guia) OR empty($no_guia)){
		  $conditionsTraficoRenglonGuia['MssqlTraficoRenglonGuiaAtm.no_guia'] = $no_guia;
		}
		$fieldsTraficoRenglonGuia = array(
						'MssqlTraficoRenglonGuiaAtm.no_guia',
						'MssqlTraficoRenglonGuiaAtm.id_area',
						'MssqlTraficoRenglonGuiaAtm.id_fraccion',
						'MssqlTraficoRenglonGuiaAtm.peso',
						'MssqlTraficoRenglonGuiaAtm.peso_estimado',
						'MssqlTraficoRenglonGuiaAtm.descripcion_producto'
					   );

		App::import('model','MssqlTraficoRenglonGuiaAtm');
		  $TraficoRenglonGuia = new MssqlTraficoRenglonGuiaAtm();
		  $getTraficoRenglonGuia = $TraficoRenglonGuia->find('all',array('conditions'=>$conditionsTraficoRenglonGuia,'fields'=>$fieldsTraficoRenglonGuia));
// 		pr($getTraficoRenglonGuia);
// 		exit();
		foreach($getTraficoRenglonGuia as $upKey => $Data){
			$getTraficoRenglonGuia = Set::combine($getTraficoRenglonGuia, '{n}.'.$fieldTraficoRenglonGuia['0'], '{n}');
		}
// 		pr($getTraficoRenglonGuia);
// 		exit();
		$traficoViaje['traficoRenglonGuia'] = $getTraficoRenglonGuia;
		
		$fieldTraficoGuia = array('MssqlTraficoGuiaAtm.no_guia');
		$conditionsTraficoGuia['MssqlTraficoGuiaAtm.no_guia'] = $no_guia;
		$conditionsTraficoGuia['MssqlTraficoGuiaAtm.id_area'] = $id_area;
		$conditionsTraficoGuia['MssqlTraficoGuiaAtm.no_viaje'] = $no_viaje;
// 		$conditionsTraficoGuia['MssqlTraficoGuiaAtm.prestamo'] = 'N';
		$conditionsTraficoGuia['MssqlTraficoGuiaAtm.status_guia <>'] = 'B';
		$fieldsTraficoGuia = array(
						'MssqlTraficoGuiaAtm.no_guia',
						'MssqlTraficoGuiaAtm.id_area',
						'MssqlTraficoGuiaAtm.tipo_doc',
						'MssqlTraficoGuiaAtm.status_guia',
						'MssqlTraficoGuiaAtm.id_fraccion',
						'MssqlTraficoGuiaAtm.num_guia',
						'MssqlTraficoGuiaAtm.id_unidad',
						'MssqlTraficoGuiaAtm.no_viaje',
						'MssqlTraficoGuiaAtm.id_fraccion',
// 						'MssqlTraficoGuiaAtm.id_flota',
						'MssqlTraficoGuiaAtm.prestamo'
					   );

		App::import('model','MssqlTraficoGuiaAtm');
		  $TraficoGuia = new MssqlTraficoGuiaAtm();
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
		  $no_of_guia['MssqlTraficoRenglonGuiaAtm.no_guia'][] = $sqlTraficoGuia['MssqlTraficoGuiaAtm']['no_guia'];
		  $noOfGuia['no_guia'][$sqlTraficoGuia['MssqlTraficoGuiaAtm']['no_viaje']][] = $sqlTraficoGuia['MssqlTraficoGuiaAtm']['no_guia'];
		}
		$no_of_guia['MssqlTraficoRenglonGuiaAtm.id_area'] = $id_area;
// 		pr($no_of_guia);
// 		pr($noOfGuia);
		$peso = $TraficoRenglonGuia->find('all',array('conditions'=>$no_of_guia,'fields'=>$fieldsTraficoRenglonGuia));
		foreach($peso as $idCount => $tonsContent){
		  if(!isset($toneladas[$tonsContent['MssqlTraficoRenglonGuiaAtm']['no_guia']])){
			$toneladasNoOfGuia[$tonsContent['MssqlTraficoRenglonGuiaAtm']['no_guia']] = null;
		  }
		  $toneladasNoOfGuia[$tonsContent['MssqlTraficoRenglonGuiaAtm']['no_guia']] += $tonsContent['MssqlTraficoRenglonGuiaAtm']['peso'] + $tonsContent['MssqlTraficoRenglonGuiaAtm']['peso_estimado'];
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
		App::import('model','MssqlMttoUnidadesAtm');
		  $MttoUnidades = new MssqlMttoUnidadesAtm();

// 		  pr(unitConfig()[$id_empresa]['id_unidad']);
		$fieldMttoUnidades = array('MssqlMttoUnidadesAtm.id_unidad');
		$conditionsMttoUnidades['MssqlMttoUnidadesAtm.id_area'] = $id_area;
		$conditionsMttoUnidades['MssqlMttoUnidadesAtm.tipo_unidad'] = unitConfig()[$id_empresa]['TiposUnidad'];
		$conditionsMttoUnidades['MssqlMttoUnidadesAtm.estatus'] = 'A';
		$conditionsMttoUnidades['MssqlMttoUnidadesAtm.id_unidad <>'] = unitConfig()[$id_empresa]['id_unidad'];
		
		$fieldsMttoUnidades = array(
						'MssqlMttoUnidadesAtm.id_unidad',
						'MssqlMttoUnidadesAtm.id_area',
						'MssqlMttoUnidadesAtm.id_flota',
						'MssqlMttoUnidadesAtm.tipo_unidad',
						'MssqlMttoUnidadesAtm.status_unidad',
						'MssqlMttoUnidadesAtm.id_operador',
						'MssqlMttoUnidadesAtm.id_status',
						'MssqlMttoUnidadesAtm.estatus'
					   );

		$getMttoUnidades = $MttoUnidades->find('all',array('conditions'=>$conditionsMttoUnidades,'fields'=>$fieldsMttoUnidades));
		foreach($getMttoUnidades as $Key => $Dato){
			$getMttoUnidad = Set::combine($getMttoUnidades, '{n}.'.$fieldMttoUnidades['0'], '{n}');
		}
// 		pr($getMttoUnidad);
// 		exit();
// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // 
		
// 		$fields['camps'] = array('id_fraccion',);
		foreach($traficoViaje['trafico_viaje'] as $numero_de_viaje => $mssqlViajesAtm){
		  $traficoViaje['viajes'][$numero_de_viaje] = $mssqlViajesAtm['MssqlViajesRtAtm'];
		  foreach($mssqlViajesAtm['MssqlViajesRtAtm'] as $fieldDescription => $fieldData){

			//NOTE add offset null
			$guia = $getTraficoRenglonViaje[$numero_de_viaje]['MssqlTraficoRenglonViajeAtm']['no_guia'];
// 			pr($guia);
			$traficoViaje['viajes'][$numero_de_viaje]['no_guia'] = $guia;
			
			if(isset($getTraficoRenglonGuia[$guia])){
			  $traficoViaje['viajes'][$numero_de_viaje]['id_fraccion'] = $getTraficoRenglonGuia[$guia]['MssqlTraficoRenglonGuiaAtm']['id_fraccion'];
			  $traficoViaje['viajes'][$numero_de_viaje]['peso'] = $getTraficoRenglonGuia[$guia]['MssqlTraficoRenglonGuiaAtm']['peso'];
			  $traficoViaje['viajes'][$numero_de_viaje]['peso_estimado'] = $getTraficoRenglonGuia[$guia]['MssqlTraficoRenglonGuiaAtm']['peso_estimado'];
			  $traficoViaje['viajes'][$numero_de_viaje]['descripcion_producto'] = $getTraficoRenglonGuia[$guia]['MssqlTraficoRenglonGuiaAtm']['descripcion_producto'];
			}
			if(isset($getTraficoGuia[$guia])){
			  $traficoViaje['viajes'][$numero_de_viaje]['tipo_doc'] = $getTraficoGuia[$guia]['MssqlTraficoGuiaAtm']['tipo_doc'];
			  $traficoViaje['viajes'][$numero_de_viaje]['status_guia'] = $getTraficoGuia[$guia]['MssqlTraficoGuiaAtm']['status_guia'];
			  $traficoViaje['viajes'][$numero_de_viaje]['num_guia'] = $getTraficoGuia[$guia]['MssqlTraficoGuiaAtm']['num_guia'];
			  $traficoViaje['viajes'][$numero_de_viaje]['id_unidad'] = $getTraficoGuia[$guia]['MssqlTraficoGuiaAtm']['id_unidad'];
			  $traficoViaje['viajes'][$numero_de_viaje]['prestamo'] = $getTraficoGuia[$guia]['MssqlTraficoGuiaAtm']['prestamo'];
			}
			
			if(!empty($guia)){
			  $traficoViaje['viajes'][$numero_de_viaje]['id_flota'] = $getMttoUnidad[$getTraficoGuia[$guia]['MssqlTraficoGuiaAtm']['id_unidad']]['MssqlMttoUnidadesAtm']['id_flota'];

			  $traficoViaje['viajes_count'][$getMttoUnidad[$getTraficoGuia[$guia]['MssqlTraficoGuiaAtm']['id_unidad']]['MssqlMttoUnidadesAtm']['id_flota']][$numero_de_viaje] = $getMttoUnidad[$getTraficoGuia[$guia]['MssqlTraficoGuiaAtm']['id_unidad']]['MssqlMttoUnidadesAtm']['id_flota'];

			  $traficoViaje['toneladas'][$getMttoUnidad[$getTraficoGuia[$guia]['MssqlTraficoGuiaAtm']['id_unidad']]['MssqlMttoUnidadesAtm']['id_flota']][$numero_de_viaje] = $toneladas[$numero_de_viaje];

			}
		  }
		}
// 		pr($traficoViaje['viajes']);
	  return $traficoViaje;
	}//End MssqlUnidadesAsignadasTei
	
  }//End get viajes despachados
?>









