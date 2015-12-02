<?php
  class TipoOperacionTbk extends AppModel{
	var $name = 'TipoOperacionTbk';
	var $useTable = 'desp_tipooperacion';
	var $primaryKey = 'id_area';

/** NOTE the function removeString comes from appConfig*/
	
	function getTipoOperacion(){
	  $tipoOp = $this->find('all');
	  unset($tipoOp[0]);
	  return removeString($arrayString=$tipoOp,$string=array('CD','PLANTA','POTOSI','.'),$model='TipoOperacionTbk',$field='tipo_operacion');
	}
  }//End TipoOperacionTbk
?>