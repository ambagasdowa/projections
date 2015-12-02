<?php
  class MssqlPersonalPersonalTei extends AppModel{
	var $name = 'MssqlPersonalPersonalTei';
	var $useDbConfig = 'mssqlTei';
	var $useTable = 'personal_personal';
	var $primaryKey = 'id_personal';
	
	function getPersonal($id_area=null,$id_empresa=null){
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
	  if(!empty($id_area)){
		$conditions['MssqlPersonalPersonalTei.id_area'] = $id_area;
	  }
	  
	  $getPersonal = $this->find('all',array(
											  'fields'=>array(
															  $fields[$config['0']]['1'],
															  $fields[$config['0']]['2'],
															  $fields[$config['0']]['3'],
															  $fields[$config['0']]['4']
															  ),
											  'conditions'=>$conditions
									   )
							);
	  return $getPersonal;
	}	
  }
?>