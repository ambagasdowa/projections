<?php
  class MssqlTipoOperacionTbk extends AppModel{
	var $name = 'MssqlTipoOperacionTbk';
	var $useTable = 'desp_tipooperacion';
	var $primaryKey = 'id_tipo_operacion';
	
/** NOTE the function removeString comes from appConfig*/

	function getTipoOperacion(){
	  $tipoOperacion = $this->find('all');
	// 	  unset($tipoOperacion[0]);
		return removeString($arrayString=$tipoOperacion,$string=array('PLANTA','CD'),$model='MssqlTipoOperacionTbk',$field='tipo_operacion',$unset=true);
	}
	
  }
?>
