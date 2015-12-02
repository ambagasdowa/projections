<?php
  class FlotasTbk extends AppModel{
	var $name = 'FlotasTbk';
	var $useTable = 'desp_flotas';
	var $primaryKey = 'id_flota';
	
/** NOTE the function removeString comes from appConfig*/

	function getFlotas(){
	  $flotas = $this->find('all');
	  unset($flotas[0]);
	return removeString($arrayString=$flotas,$string='.',$model='FlotasTbk',$field='nombre');
	}
	
  }
?>