<?php
  class MssqlAreasTei extends AppModel{
	var $name = 'MssqlAreasTei';
	var $useDbConfig = 'mssqlTei';
	var $useTable = 'general_area';
	var $primaryKey = 'id_area';

/** NOTE the function removeString comes from appConfig*/
	
	function getAreas(){
// 	  from isql -v odbc-macuspanadb zam lis
// 	  select id_area,nombre from general_area;select * from desp_flotas;select * from desp_tipooperacion;
	  $areas = $this->find('all');
	  unset($areas[0]);
	  $string=array('S.A.','DE','C.V.','.');
	  return removeString($arrayString=$areas,$string,$model='MssqlAreasTei',$field='nombre');
	} /** @end of @getAreas() */
	
  }//End AreasTei
?>