<?php
  class MssqlUnidadesAsignadasTbk extends AppModel{
	var $name = 'MssqlUnidadesAsignadasTbk';
	var $useTable = 'mtto_unidades';
	var $primaryKey = 'id_operador';
	var $hasOne = array(
		'MssqlPersonalPersonalTbk' => array(
									  'className' => 'MssqlPersonalPersonalTbk',
									  'foreignKey'=> 'id_personal',
									  'fields' => array(
														'MssqlPersonalPersonalTbk.id_personal',
														'MssqlPersonalPersonalTbk.id_area',
														'MssqlPersonalPersonalTbk.id_empresa',
														'MssqlPersonalPersonalTbk.nombre'
														)
											)
	  );
	
	function getUnidades($id_area=null,$id_flota=null,$status=null,$id_empresa=null){

// 	  status_unidad, estatus, id_flota,id_operador,id_area,id_status
// 	  $conditions['MssqlPersonalPersonalTbk.id_area'] = $id_area;
	  if(empty($id_empresa)){
		$id_empresa = $_SESSION['Auth']['User']['id_empresa'];
	  }

	  $config = array('personal','unidades');
	  $fields = array(
	  			$config['0'] => array(
							  '1' => 'MssqlPersonalPersonalTbk.id_personal',
							  '2' => 'MssqlPersonalPersonalTbk.id_area',
							  '3' => 'MssqlPersonalPersonalTbk.id_empresa',
							  '4' => 'MssqlPersonalPersonalTbk.nombre'
						)
				);
	  $conditions = array(
							  'MssqlPersonalPersonalTbk.id_categoria'=>unitConfig()[$id_empresa]['categoriaOperador'],
							  'MssqlPersonalPersonalTbk.estado'=>'A',
						);
	  
	  $getPersonal = $this->MssqlPersonalPersonalTbk->find('all',array(
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
		$conditionsUnits['MssqlUnidadesAsignadasTbk.tipo_unidad'] = $tiposUnidad[$id_empresa]['TiposUnidad'];
		$conditionsUnits['MssqlUnidadesAsignadasTbk.estatus'] = 'A';
		$conditionsUnits['MssqlUnidadesAsignadasTbk.id_unidad <>'] = $tiposUnidad[$id_empresa]['id_unidad'];
// 		$conditionsUnits = array('MssqlUnidadesAsignadasTbk.tipo_unidad'=>array($tiposUnidad[$id_empresa]['TiposUnidad']));
// 		$conditionsUnits = array('MssqlUnidadesAsignadasTbk.estatus'=>array('A'));
// 		$conditionsUnits = array('NOT' => array('MssqlUnidadesAsignadasTbk.id_unidad'=>array('TT300')));

		if(!empty($status)){
		  $conditionsUnits['MssqlUnidadesAsignadasTbk.id_status'] = $status;
		}
		if(!empty($id_flota)){
		  $conditionsUnits['MssqlUnidadesAsignadasTbk.id_flota'] = $id_flota;
		}
		if(!empty($id_area)){
		  $conditionsUnits['MssqlUnidadesAsignadasTbk.id_area'] = $id_area;
		}

		$getUnidades = $this->find('all',array('fields'=>$field['fields'],
												'conditions'=>$conditionsUnits,
												'order'=>'id_status'
												)
								   );
		$allUnits = count($getUnidades);
		$operCount = null;
	  
	  foreach($getUnidades as $upKey => $Data){
		if(!isset($getUnidades[$upKey]['MssqlUnidadesAsignadasTbk']['nombre_operador'])){
		  $getUnidades[$upKey]['MssqlUnidadesAsignadasTbk']['nombre_operador'] = null;
		}
		if(isset($getPersonal[$getUnidades[$upKey]['MssqlUnidadesAsignadasTbk']['id_operador']]['MssqlPersonalPersonalTbk']['nombre'])){
		  $getUnidades[$upKey]['MssqlUnidadesAsignadasTbk']['nombre_operador'] = utf8_encode($getPersonal[$getUnidades[$upKey]['MssqlUnidadesAsignadasTbk']['id_operador']]['MssqlPersonalPersonalTbk']['nombre']);
		}
		if(isset($getPersonal[$getUnidades[$upKey]['MssqlUnidadesAsignadasTbk']['id_operador']]['MssqlPersonalPersonalTbk']['nombre'])){
		  $operCount++;
		}
	  }

	$unidades['personalCount'] = $operCount;
	$unidades['allUnits'] = $allUnits;
	$unidades['unidades'] = $getUnidades;
	
	  return $unidades;
	}//End MssqlUnidadesAsignadasTbk

  }
?>