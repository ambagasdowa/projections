<?php
// select * from dbo.getRealPresupuesto('ATMMAC','2015','TT|RT|RV|RP|RD','BW|BX','201501|201502|201503|201504|201505|201506|201507|201508|201509|2015010|201511|201512','5E','|') where Mes = 'Marzo' order by NoCta

	class MssqlPresupuestoAtmVariable extends AppModel{
		var $name = 'MssqlPresupuestoAtmVariable';
		var $useDbConfig = 'integraapp';
		var $useTable = "fetchViewPresupuestoRealVariable";

		function getRealPresupuesto(){
			pr($this->find('all'));
		}
	}//MssqlFecthPrepRealVariable
?>