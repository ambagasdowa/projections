<?php
  class MssqlUnidadesAsignadasAtm extends AppModel{
	var $name = 'MssqlUnidadesAsignadasAtm';
	var $useTable = 'mtto_unidades';
	var $useDbConfig = 'mssqlAtm';
	var $primaryKey = 'id_operador';
	var $hasOne = array(
		'MssqlPersonalPersonalAtm' => array(
			'className' => 'MssqlPersonalPersonalAtm',
			'foreignKey'=> 'id_personal',
			'fields' => array(
							  'MssqlPersonalPersonalAtm.id_personal',
							  'MssqlPersonalPersonalAtm.id_area',
							  'MssqlPersonalPersonalAtm.id_empresa',
							  'MssqlPersonalPersonalAtm.nombre'
						)
		  )
	  );
	
	function getUnidades($id_area=null,$id_flota=null,$status=null,$id_empresa=null){

// 	  status_unidad, estatus, id_flota,id_operador,id_area,id_status
// 	  $conditions['MssqlPersonalPersonalAtm.id_area'] = $id_area;
	  if(empty($id_empresa)){
		$id_empresa = $_SESSION['Auth']['User']['id_empresa'];
	  }
// 	  $id_empresa = '2';
	  $config = array('personal','unidades');
	  $fields = array(
	  			$config['0'] => array(
							  '1' => 'MssqlPersonalPersonalAtm.id_personal',
							  '2' => 'MssqlPersonalPersonalAtm.id_area',
							  '3' => 'MssqlPersonalPersonalAtm.id_empresa',
							  '4' => 'MssqlPersonalPersonalAtm.nombre'
						)
				);
	  $conditions = array(
							  'MssqlPersonalPersonalAtm.id_categoria'=>unitConfig()[$id_empresa]['categoriaOperador'],
							  'MssqlPersonalPersonalAtm.estado'=>'A',
						);
	  
	  $getPersonal = $this->MssqlPersonalPersonalAtm->find('all',array(
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
// 		var_dump($tiposUnidad);
		$tiposUnidad = unitConfig();
// 		pr($tiposUnidad[$id_empresa]['TiposUnidad']);
		
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
		$conditionsUnits['MssqlUnidadesAsignadasAtm.tipo_unidad'] = $tiposUnidad[$id_empresa]['TiposUnidad'];
		$conditionsUnits['MssqlUnidadesAsignadasAtm.estatus'] = 'A';
		$conditionsUnits['MssqlUnidadesAsignadasAtm.id_unidad <>'] = $tiposUnidad[$id_empresa]['id_unidad'];
		if(!empty($status)){
		  $conditionsUnits['MssqlUnidadesAsignadasAtm.id_status'] = $status;
		}
		if(!empty($id_flota)){
		  $conditionsUnits['MssqlUnidadesAsignadasAtm.id_flota'] = $id_flota;
		}
		if(!empty($id_area)){
		  $conditionsUnits['MssqlUnidadesAsignadasAtm.id_area'] = $id_area;
		}

		$getUnidades = $this->find('all',array('fields'=>$field['fields'],
												'conditions'=>$conditionsUnits,
												'order'=>'id_status'
												)
								   );
	  $allUnits = count($getUnidades);
	  $operCount = null;
	  foreach($getUnidades as $upKey => $Data){
		if(!isset($getUnidades[$upKey]['MssqlUnidadesAsignadasAtm']['nombre_operador'])){
		  $getUnidades[$upKey]['MssqlUnidadesAsignadasAtm']['nombre_operador'] = null;
		}
		if(isset($getPersonal[$getUnidades[$upKey]['MssqlUnidadesAsignadasAtm']['id_operador']]['MssqlPersonalPersonalAtm']['nombre'])){
		  $getUnidades[$upKey]['MssqlUnidadesAsignadasAtm']['nombre_operador'] = utf8_encode($getPersonal[$getUnidades[$upKey]['MssqlUnidadesAsignadasAtm']['id_operador']]['MssqlPersonalPersonalAtm']['nombre']);
		}
		if(isset($getPersonal[$getUnidades[$upKey]['MssqlUnidadesAsignadasAtm']['id_operador']]['MssqlPersonalPersonalAtm']['nombre'])){
		  $operCount++;
		}
	  }

	$unidades['personalCount'] = $operCount;
	$unidades['allUnits'] = $allUnits;
	$unidades['unidades'] = $getUnidades;
	  return $unidades;
	}//End MssqlUnidadesAsignadasAtm

  }
?>