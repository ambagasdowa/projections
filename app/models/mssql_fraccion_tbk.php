<?php
  class MssqlFraccionTbk extends AppModel{
	var $name = 'MssqlFraccionTbk';
	var $useTable = 'trafico_producto';
	var $primaryKey = 'id_fraccion';
	
/** NOTE the function removeString comes from appConfig*/

	function getFraccion(){
	  $conditions['MssqlFraccionTbk.id_producto'] = 0;
	  $fraccion = $this->find('all',array('conditions'=>$conditions));
		return removeString($arrayString=$fraccion,$string='',$model='MssqlFraccionTbk',$field='desc_producto',$unset=true);
	}
	
	
  }
?>
