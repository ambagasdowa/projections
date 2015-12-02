				  <div id="divDisponible">
				  <?php
					if(!isset($estimate['totales']['Ingresos'])){
					  $estimate['totales']['Ingresos']= 0;
					}
					if(!isset($estimate['totales']['Egresos'])){
					  $estimate['totales']['Egresos'] = 0 ;
					}
					e('$'.number_format(money_format('%i',($saldo['presupuesto']+$estimate['totales']['Ingresos'])-$estimate['totales']['Egresos']), 2, '.', ','));
				  ?>
				  </div>