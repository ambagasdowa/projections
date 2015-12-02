<?php
  class MssqlDespStatusTei extends AppModel{
	var $name = 'MssqlDespStatusTei';
	var $useDbConfig = 'mssqlTei';
	var $useTable = 'desp_status';
	var $primaryKey = 'id_status';
	
	function getStatus(){
	  $getStatus = removeString($arrayString=$this->find('all'),$string='',$model='MssqlDespStatusTei',$field='nombre',true);
	  return $getStatus;
	}
	
  }
?>