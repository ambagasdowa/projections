<?php
  class GranelController extends AppController{

      var $name = 'Granel';
      var $components = array('RequestHandler','Session');
      var $helpers = array('Html','Form','Ajax','Javascript','Js','GoogleMap','Pdf','GChart');
      var $uses = array(
			'MssqlAreasTbk','MssqlFlotasTbk','MssqlDespStatusTbk','MssqlUnidadesAsignadasTbk','MssqlPersonalPersonalTbk',
			'MssqlAreasAtm','MssqlFlotasAtm','MssqlDespStatusAtm','MssqlUnidadesAsignadasAtm','MssqlPersonalPersonalAtm',
			'MssqlAreasTei','MssqlFlotasTei','MssqlDespStatusTei','MssqlUnidadesAsignadasTei','MssqlPersonalPersonalTei',
			'MssqlViajesRtTbk',
			'MssqlViajesKmsTbk'
			
			);
			
	/** NOTE <Approach with views in mssql> */
	
	function modelTest(){
		$START = time();
			pr($this->MssqlAreasTbk->getAreas());
			pr($this->MssqlFlotasTbk->getFlotas());
		$END = time() - $START;
		echo "This query took $END seconds\n";
		$START = time();
			pr($this->MssqlAreasAtm->getAreas());
			pr($this->MssqlFlotasAtm->getFlotas());
		$END = time() - $START;
		echo "This query took $END seconds\n";
		
		$START = time();
			pr($this->MssqlViajesKmsTbk->find('all'));
		$END = time() - $START;
		echo "This query took $END seconds\n";
		exit();
	}
	
	function index(){
		
	}
	
  }// end class
?>