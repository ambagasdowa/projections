<?php
  class MssqlFlotasTbk extends AppModel{
	var $name = 'MssqlFlotasTbk';
	var $useTable = 'desp_flotas';
	var $primaryKey = 'id_flota';
	
/** NOTE the function removeString comes from appConfig*/

	function getFlotas(){
	  $flotas = $this->find('all');
	  unset($flotas[0]);
	return removeString($arrayString=$flotas,$string='.',$model='MssqlFlotasTbk',$field='nombre');
	}
	
  }
?>