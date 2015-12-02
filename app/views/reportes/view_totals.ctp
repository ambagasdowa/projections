<?php ?>
<!-- <div id="divViewTotals"> -->
      <table>
	    <tr />
		<td width="<?php e($_SESSION['viewConfig']['width']);?>" style="text-align:center;" />
			<table>
			  <tr />
			    <td height="<?php e($_SESSION['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['viewConfig']['fontSize']);?>%;" />
				  <div id="divIngresosHeader">
				  <?php
					 if(!isset($estimate['totales']['Ingresos'])){
						e('$'.number_format(money_format('%i','0'), 2, '.', ','));
					 }else{
					  e('$'.number_format(money_format('%i',$estimate['totales']['Ingresos']), 2, '.', ','));
					 }
				  ?>
				  </div>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['viewConfig']['fontSizeTitle']);?>%;" />Total de Ingresos
			  <tr />
			    <td style="text-align:center;" />
			</table>
		<td width="<?php e($_SESSION['viewConfig']['width']);?>" style="text-align:center;" />
			<table>
			  <tr />
			    <td height="<?php e($_SESSION['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['viewConfig']['fontSize']);?>%;" />
				  <div id="divEgresosHeader">
				  <?php
					 if(!isset($estimate['totales']['Egresos'])){
						e('$'.number_format(money_format('%i','0'), 2, '.', ','));
					 }else{
						e('$'.number_format(money_format('%i',$estimate['totales']['Egresos']), 2, '.', ','));
					 }
				  ?>
				  </div>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['viewConfig']['fontSizeTitle']);?>%;" />Total de Egresos
			  <tr />
			    <td style="text-align:center;" /><!--...-->
			</table>
		<td width="<?php e($_SESSION['viewConfig']['width']);?>" style="text-align:center;" />
			<table>
			  <tr />
			    <td height="<?php e($_SESSION['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['viewConfig']['fontSize']);?>%;" />

					<div id="divSaldoDisponible">
					  <?php
					    e('$'.number_format(money_format('%i','0'), 2, '.', ','));
					  ?>
					</div>

			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['viewConfig']['fontSizeTitle']);?>%;" />Saldo Disponible
			  <tr />
			    <td style="text-align:center;" /><!--...-->
			</table>
		<td width="<?php e($_SESSION['viewConfig']['width']);?>" style="text-align:center;" />
			<table>
			  <tr />
			    <td height="<?php e($_SESSION['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['viewConfig']['fontSize']);?>%;" />
			    <div id="divEfectivoDisponible">
				  <?php
					e('$'.number_format(money_format('%i','0'), 2, '.', ','));
// 					e('$'.number_format(money_format('%i',($saldo['presupuesto']+$estimate['totales']['Ingresos'])), 2, '.', ','));
				  ?>
				 </div>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['viewConfig']['fontSizeTitle']);?>%;" />Efectivo Disponible
			  <tr />
			    <td style="text-align:center;" /><!--...-->
			</table>
	  </table>
<!-- </div> -->