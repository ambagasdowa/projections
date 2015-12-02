<?php
  class MssqlPersonalPersonalTbk extends AppModel{
	var $name = 'MssqlPersonalPersonalTbk';
	var $useTable = 'personal_personal';
	var $primaryKey = 'id_personal';
	
	function getPersonal($id_area=null,$id_empresa=null){

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
	  if(!empty($id_area)){
		$conditions['MssqlPersonalPersonalTbk.id_area'] = $id_area;
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