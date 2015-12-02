<?php
  class MssqlTraficoRenglonViajeTei extends AppModel{
	var $name = 'MssqlTraficoRenglonViajeTei';
	var $useDbConfig = 'mssqlTei';
	var $useTable = 'trafico_renglon_viaje';
	var $primaryKey = 'no_viaje';
  }
?>