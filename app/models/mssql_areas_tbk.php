<?php
  class MssqlAreasTbk extends AppModel{
	var $name = 'MssqlAreasTbk';
	var $useTable = 'general_area';
	var $primaryKey = 'id_area';

/** NOTE the function removeString comes from appConfig*/
	
	function getAreas(){
// 	  from isql -v odbc-bonampakdb zam lis
// 	  select id_area,nombre from general_area;select * from desp_flotas;select * from desp_tipooperacion;
	  $areas = $this->find('all');
	  unset($areas[0]);
	  return removeString($arrayString=$areas,$string='BONAMPAK',$model='MssqlAreasTbk',$field='nombre');
	} /** @end of @getAreas() */
	
  }//End AreasTbk
?>