<?php
  class MssqlDespStatusTbk extends AppModel{
	var $name = 'MssqlDespStatusTbk';
	var $useTable = 'desp_status';
	var $primaryKey = 'id_status';
	
	function getStatus(){
	  $getStatus = removeString($arrayString=$this->find('all'),$string='',$model='MssqlDespStatusTbk',$field='nombre',true);
	  return $getStatus;
	}
	
  }
?>