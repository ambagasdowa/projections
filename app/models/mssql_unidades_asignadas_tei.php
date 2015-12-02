<?php
  class MssqlUnidadesAsignadasTei extends AppModel{
	var $name = 'MssqlUnidadesAsignadasTei';
	var $useTable = 'mtto_unidades';
	var $useDbConfig = 'mssqlTei';
// 	var $useDbConfig = 'flujo';
	var $primaryKey = 'id_operador';
// 	var $uses = array('DespStatus');
	var $hasOne = array(
		'MssqlPersonalPersonalTei' => array(
			'className' => 'MssqlPersonalPersonalTei',
			'foreignKey'=> 'id_personal',
			'fields' => array(
							  'MssqlPersonalPersonalTei.id_personal',
							  'MssqlPersonalPersonalTei.id_area',
							  'MssqlPersonalPersonalTei.id_empresa',
							  'MssqlPersonalPersonalTei.nombre'
						)
		  )
	  );
	
	function getUnidades($id_area=null,$id_flota=null,$status=null,$id_empresa=null){

// 	  status_unidad, estatus, id_flota,id_operador,id_area,id_status
// 	  $conditions['MssqlPersonalPersonalTei.id_area'] = $id_area;
	  
	  if(empty($id_empresa)){
		$id_empresa = $_SESSION['Auth']['User']['id_empresa'];
	  }

	  $config = array('personal','unidades');
	  $fields = array(
	  			$config['0'] => array(
							  '1' => 'MssqlPersonalPersonalTei.id_personal',
							  '2' => 'MssqlPersonalPersonalTei.id_area',
							  '3' => 'MssqlPersonalPersonalTei.id_empresa',
							  '4' => 'MssqlPersonalPersonalTei.nombre'
						)
				);
	  $conditions = array(
							  'MssqlPersonalPersonalTei.id_categoria'=>unitConfig()[$id_empresa]['categoriaOperador'],
							  'MssqlPersonalPersonalTei.estado'=>'A',
						);
	  
	  $getPersonal = $this->MssqlPersonalPersonalTei->find('all',array(
															'fields'=>array(
																			$fields[$config['0']]['1'],
																			$fields[$config['0']]['2'],
																			$fields[$config['0']]['3'],
																			$fields[$config['0']]['4']
																			),
															'conditions'=>$conditions
									   )
							);

	  foreach($getPersonal as $upKey => $Data){
		  $getPersonal = Set::combine($getPersonal, '{n}.'.$fields[$config['0']]['1'], '{n}');
	  }

// 		$tiposUnidad = array('TiposUnidad'=>array('9','1'));
		$tiposUnidad = unitConfig();
		
		$field = array('fields'=>array('id_unidad',
										'tipo_unidad',
										'status_unidad',
										'estatus',
										'id_flota',
										'id_operador',
										'id_area',
										'id_status'
								  )
				);
		$conditionsUnits['MssqlUnidadesAsignadasTei.tipo_unidad'] = $tiposUnidad[$id_empresa]['TiposUnidad'];
		$conditionsUnits['MssqlUnidadesAsignadasTei.estatus'] = 'A';
		$conditionsUnits['MssqlUnidadesAsignadasTei.id_unidad <>'] = $tiposUnidad[$id_empresa]['id_unidad'];
// 		$conditionsUnits = array('MssqlUnidadesAsignadasTbk.tipo_unidad'=>array($tiposUnidad[$id_empresa]['TiposUnidad']));
// 		$conditionsUnits = array('MssqlUnidadesAsignadasTbk.estatus'=>array('A'));
// 		$conditionsUnits = array('NOT' => array('MssqlUnidadesAsignadasTei.id_unidad'=>array('TT300')));
		if(!empty($status)){
		  $conditionsUnits['MssqlUnidadesAsignadasTei.id_status'] = $status;
		}
		if(!empty($id_flota)){
		  $conditionsUnits['MssqlUnidadesAsignadasTei.id_flota'] = $id_flota;
		}
		if(!empty($id_area)){
		  $conditionsUnits['MssqlUnidadesAsignadasTei.id_area'] = $id_area;
		}

		$getUnidades = $this->find('all',array('fields'=>$field['fields'],
												'conditions'=>$conditionsUnits,
												'order'=>'id_status'
												)
								   );
	  $allUnits = count($getUnidades);
	  $operCount = null;
	  foreach($getUnidades as $upKey => $Data){
		if(!isset($getUnidades[$upKey]['MssqlUnidadesAsignadasTei']['nombre_operador'])){
		  $getUnidades[$upKey]['MssqlUnidadesAsignadasTei']['nombre_operador'] = null;
		}
		if(isset($getPersonal[$getUnidades[$upKey]['MssqlUnidadesAsignadasTei']['id_operador']]['MssqlPersonalPersonalTei']['nombre'])){
		  $getUnidades[$upKey]['MssqlUnidadesAsignadasTei']['nombre_operador'] = utf8_encode($getPersonal[$getUnidades[$upKey]['MssqlUnidadesAsignadasTei']['id_operador']]['MssqlPersonalPersonalTei']['nombre']);
		}
		if(isset($getPersonal[$getUnidades[$upKey]['MssqlUnidadesAsignadasTei']['id_operador']]['MssqlPersonalPersonalTei']['nombre'])){
		  $operCount++;
		}
	  }

	$unidades['personalCount'] = $operCount;
	$unidades['allUnits'] = $allUnits;
	$unidades['unidades'] = $getUnidades;
	  return $unidades;
	}//End MssqlUnidadesAsignadasTei

  }
?>