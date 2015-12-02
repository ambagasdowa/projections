<?php
// pr($flujo);
?> 

<?php
	if(isset($flujo['saldo'])){
?>
  <table id="menu_info_small" >
	  <td width="10%">&nbsp;
	  <td style="text-align:center;font-weight:bold;font-variant:small-caps;"/> 
			<a href="#" onclick="Effect.toggle('resumen', 'appear'); return false;">
			  &#9660; Resumen &#9660;
			</a>
	  <td width="5%" style="text-alig:right;"/>
		  <?php
		      echo $this->Html->link( 
			   $this->Html->image("icons/excel_small.png",
			                array('alt' => "Exportar a una hoja de Excel",
								  'title' => 'Exportar a una hoja de Excel',
								  'width' => '22',
								  'height' => '22'
					)
			   ),
					array(
					  'action'=>'xlsExport',
					  'Reporte de Flujo',
					  "CreacionReporteFlujo-".date('Y-m-d'),
					  "export_flujo"
					) ,
					array('escape' => false),
					null
			);
		  ?>
	  <td width="2%" style="text-alig:right;" />
	      <!--<a href="#openModal">Open Modal</a>--> <!--Open link -->
		  <?php
		      echo $this->Html->link( 
			   $this->Html->image("icons/acumulado.png",
			                array('alt' => "Acumulado",
								  'title' => 'Acumulado',
								  'width' => '46',
								  'height' => '22'
					)
			   ),
					array(
					  'controller'=>'search/#openModal'
					) ,
					array('escape' => false),
					null
			);
		  ?>
  </table>

  <div id="resumen">
<?php
	  foreach( $flujo['saldo'] as $monthName => $saldoData){
?>
      <table id="menu_info_small">
		<td colspan="4" />
		<tr />
		<th colspan="4" style="text-align:center;" >
			<?php
				if(!isset($flujo['mes'][$monthName])){
				  e('');
				}else{
				e($flujo['mes'][$monthName]);
				}
			?>
	    <tr />
		<td width="<?php e($_SESSION['viewConfig']['width']);?>" style="text-align:center;" />
			<table>
			  <tr />
			    <td height="<?php e($_SESSION['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['viewConfig']['fontSize']);?>%;" />
				  <div id="divIngresosHeader">
					  <?php
						if(!isset($flujo['saldo'][$monthName]['FlujoSaldo']['presupuesto'])){
						  e('$ '.number_format(money_format('%i',0), 2, '.', ','));
						}else{
						  e('$ '.number_format(money_format('%i',$flujo['saldo'][$monthName]['FlujoSaldo']['presupuesto']), 2, '.', ','));
						}
					  ?>
				  </div>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['viewConfig']['fontSizeTitle']);?>%;" />Presupuesto
			  <tr />
			    <td style="text-align:center;" />
			</table>
		<td width="<?php e($_SESSION['viewConfig']['width']);?>" style="text-align:center;" />
			<table>
			  <tr />
			    <td height="<?php e($_SESSION['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['viewConfig']['fontSize']);?>%;" />
				  <div id="divEgresosHeader">
				  <?php
				  if(!isset($flujo['flujoTotalByRealm'][$monthName]['Egresos'])){
					e('$ '.number_format(money_format('%i',0), 2, '.', ','));
				  }else{
					e('$ '.number_format(money_format('%i',$flujo['flujoTotalByRealm'][$monthName]['Egresos']), 2, '.', ','));
				  }
				  ?>
				  </div>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['viewConfig']['fontSizeTitle']);?>%;" />Total de Egresos
			  <tr />
			    <td style="text-align:center;" />
			</table>
		<td width="<?php e($_SESSION['viewConfig']['width']);?>" style="text-align:center;" />
			<table>
			  <tr />
			    <td height="<?php e($_SESSION['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['viewConfig']['fontSize']);?>%;" />

					<div id="divSaldoDisponible">
					  <?php
						e('$ '.number_format(money_format('%i',$flujo['saldo'][$monthName]['FlujoSaldo']['SaldoDisponible']), 2, '.', ','));
					  ?>
					</div>

			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['viewConfig']['fontSizeTitle']);?>%;" />Saldo Disponible
			  <tr />
			    <td style="text-align:center;" />
			</table>
		<td width="<?php e($_SESSION['viewConfig']['width']);?>" style="text-align:center;" />
			<table>
			  <tr />
			    <td height="<?php e($_SESSION['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['viewConfig']['fontSize']);?>%;" />
			    <div id="divEfectivoDisponible">
				  <?php
					e('$ '.number_format(money_format('%i',$flujo['saldo'][$monthName]['FlujoSaldo']['EfectivoDisponible']), 2, '.', ','));
				  ?>
				 </div>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['viewConfig']['fontSizeTitle']);?>%;" />Efectivo Disponible
			  <tr />
			    <td style="text-align:center;" />
			</table>
	  </table>
	  
<!-- <table><td />zzZZ</table> -->
<?php
	  }
	}
?>
  </div>

  <table id="menu_info_small" >
	  <td style="text-align:center;font-weight:bold;font-variant:small-caps;"/>
		  <a href="#" onclick="Effect.toggle('detalles', 'appear'); return false;">
			&#9660; Detalles &#9660;
		  </a>
  </table>

  <div id="detalles" style="display:none;">
<?php 
	foreach($flujo['flujo'] as $monthName => $flujoData){
	  
	  foreach( $flujoData as $Realms => $RealmsClass ){

?>
		<table id="menu_info_small">
		  <tr />
			<th colspan="7" style="text-align:center;" /><?php e($Realms);?> para el mes de <?php e($flujo['mes'][$monthName])?>

<?php 
	  foreach($RealmsClass as $RealmsClassName => $accounts){

?>
		<tr />
		<td colspan="7" style="font-weight:bold" /><?php e($RealmsClassName);?>

<?php
		  foreach($accounts as $accounts_name => $saldo){

?>

		<tr />
		<td width="10%" />&nbsp;
		<td width="10%" />&nbsp;
		<td width="10%" />&nbsp;
		<td width="40%" style="font-weight:bold" /><?php e($accounts_name);?>
		<td width="10%" style="text-align:right;" /><?php e('$ '.number_format(money_format('%i',$saldo), 2, '.', ','));?>
		<td width="10%" />&nbsp;
		<td width="10%" />&nbsp;
<?php
		  } // end foreach of $accounts
?>
<!-- Insert total of accounts  -->
		<tr />
<!-- 		<td />&nbsp; -->
		<td />&nbsp;
		<td colspan="2" style="font-weight:bold" />Total para <?php e($RealmsClassName);?>
		<td  />&nbsp;
		<td />&nbsp;
		<td width="10%" style="text-align:right;" /><?php e('$ '.number_format(money_format('%i',$flujo['flujoTotalByRealmsClass'][$monthName][$Realms][$RealmsClassName]), 2, '.', ','));?>
		<td />&nbsp;
<?php
	  } // End foreach of RealmsClass
?>
		<tr />
		<td />&nbsp;
		<td />&nbsp;
		<td style="font-weight:bold" />Total para <?php e($Realms);?>
		<td />&nbsp;
		<td />&nbsp;
		<td />&nbsp;
		<td width="10%" style="text-align:right;" /><?php e('$ '.number_format(money_format('%i',$flujo['flujoTotalByRealm'][$monthName][$Realms]), 2, '.', ','));?>


		</table>
		
<?php

	  } // end main foreach of $flujo['flujo']
	}//end foreach month

?>
	</div> <!--end detalles-->

		<div id="openModal" class="modalDialog"> <!--executable-->
		  <div>  <!--content-->
			  <a href="#close" title="Cerrar" alt="Cerrar" class="close">X</a>
				
				<table id="menu_info_small">
				<td width="40%" />
				  <div style="font-size:12pt;font-color:blue;font-weight:bold;"> Acumulados para el mes de</div>
				<td />
				  <?php
						  e($form->input('Flujo.month',
							  array('type'=>'select',
									'selected'=>'empty',
									'label'=>false,
									'options'=>$flujo['mes'],
									'empty'=>'Mes'
							  )
							)
						  );
						  e($form->input('Flujo.year',
							  array('type'=>'hidden',
// 									'selected'=>'empty',
									'label'=>false,
									'value'=>$flujo['year']
// 									'empty'=>'Mes'
							  )
							)
						  );
						  e($ajax->observeField('FlujoMonth',
									  array("url"=>array("controller"=>"search",
												"action"=>"Acumulado"
												),
										"update" => "divModal",
									  )
								  )
						  );

				  ?>
				</table>
				<div id="divModal" ></div>
		  </div>
		</div>

