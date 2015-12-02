<?php
  class MssqlTraficoRenglonGuiaAtm extends AppModel{
	var $name = 'MssqlTraficoRenglonGuiaAtm';
	var $useDbConfig = 'mssqlAtm';
	var $useTable = 'trafico_renglon_guia';
	var $primaryKey = 'id_area';
  }
?>