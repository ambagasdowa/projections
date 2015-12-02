<?php
	class PresupuestoShell extends Shell{
		var $uses = array('MssqlPresupuestoAtm');

		function main(){
			$this->MssqlPresupuestoAtm->getRealPresupuesto();
		}
	}//PREp
?> 
