<?php
  class MssqlFlotasTei extends AppModel{
	var $name = 'MssqlFlotasTei';
	var $useDbConfig = 'mssqlTei';
	var $useTable = 'desp_flotas';
	var $primaryKey = 'id_flota';
	
/** NOTE the function removeString comes from appConfig*/

	function getFlotas(){
	  $flotas = $this->find('all');
	  unset($flotas[0]);
	return removeString($arrayString=$flotas,$string='.',$model='MssqlFlotasTei',$field='nombre');
	}
	
  }
?>