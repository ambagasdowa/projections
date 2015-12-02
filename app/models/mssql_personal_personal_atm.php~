<?php
  class MssqlPersonalPersonalAtm extends AppModel{
	var $name = 'MssqlPersonalPersonalAtm';
	var $useDbConfig = 'mssqlAtm';
	var $useTable = 'personal_personal';
	var $primaryKey = 'id_personal';
	
	function getPersonal($id_area=null,$id_empresa=null){
	  if(empty($id_empresa)){
		$id_empresa = $_SESSION['Auth']['User']['id_empresa'];
	  }
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
	  if(!empty($id_area)){
		$conditions['MssqlPersonalPersonalAtm.id_area'] = $id_area;
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