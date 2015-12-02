<?php 
  class AreasShell extends Shell{
	var $uses = array(
					  'Empresas',
					  'Areas',
					  'AreasAtm',
					  'AreasTei',
					  'FlotasAtm',
					  'FlotasTei',
					  'Flotas',
					  'TipoOperacion',
					  'TipoOperacionAtm',
					  'TipoOperacionTei',
					  'AreasTbk',
					  'FlotasTbk',
					  'TipoOperacionTbk'
	  );
	/** NOTE update the local db with the new areas,flotas*/

	function main(){
	  pr($this->AreasTbk->getAreas());
	  pr($this->FlotasTbk->getFlotas());
	  pr($this->TipoOperacionTbk->getTipoOperacion());
	}

  }//End AreasShell
?>