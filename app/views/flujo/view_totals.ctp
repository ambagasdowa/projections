<?php ?>
<!-- <div id="divViewTotals"> -->
      <table>
	    <tr />
		<td width="<?php e($_SESSION['viewConfig']['width']);?>" style="text-align:center;" />
			<table>
			  <tr />
			    <td height="<?php e($_SESSION['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['viewConfig']['fontSize']);?>%;" />
				  <div id="ingresos">
				  <?php
					  e('$'.number_format(money_format('%i',$estimate['Ingresos']['FlujoIngresos']['total_ingresos']), 2, '.', ','));
				  ?>
				  </div>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['viewConfig']['fontSizeTitle']);?>%;" />Total de Ingresos
			  <tr />
			    <td style="text-align:center;" />test
			</table>
		<td width="<?php e($_SESSION['viewConfig']['width']);?>" style="text-align:center;" />
			<table>
			  <tr />
			    <td height="<?php e($_SESSION['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['viewConfig']['fontSize']);?>%;" />
				  <div id="divTotalEgresos">
				  <?php
					e('$'.number_format(money_format('%i',$estimate['totalEgresos']), 2, '.', ','));
				  ?>
				  </div>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['viewConfig']['fontSizeTitle']);?>%;" />Total de Egresos
			  <tr />
			    <td style="text-align:center;" />test
			</table>
		<td width="<?php e($_SESSION['viewConfig']['width']);?>" style="text-align:center;" />
			<table>
			  <tr />
			    <td height="<?php e($_SESSION['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['viewConfig']['fontSize']);?>%;" />
				  <div id="divSaldoDisponible">
				  <?php
					e('$'.number_format(money_format('%i',($saldo['presupuesto']+$estimate['Ingresos']['FlujoIngresos']['total_ingresos'])-$estimate['totalEgresos']), 2, '.', ','));
				  ?>
				  </div>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['viewConfig']['fontSizeTitle']);?>%;" />Saldo Disponible
			  <tr />
			    <td style="text-align:center;" />test
			</table>
		<td width="<?php e($_SESSION['viewConfig']['width']);?>" style="text-align:center;" />
			<table>
			  <tr />
			    <td height="<?php e($_SESSION['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['viewConfig']['fontSize']);?>%;" />
			    <div id="divEfectivoDisponible">
				  <?php
					e('$'.number_format(money_format('%i',($saldo['presupuesto']+$estimate['Ingresos']['FlujoIngresos']['total_ingresos'])), 2, '.', ','));
				  ?>
				 </div>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['viewConfig']['fontSizeTitle']);?>%;" />Efectivo Disponible
			  <tr />
			    <td style="text-align:center;" />test
			</table>
	  </table>
<!-- </div> -->