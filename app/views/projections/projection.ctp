<?php //Projection.ctp ?>

<?php
// 	  $projeccion = $_SESSION['projections']['projeccion'];
// 	  $monthLimit = date('n');
// 	  foreach($_SESSION['projections']['months'] as $id_months => $monthsName){
// 		if((int)$id_months <= $monthLimit){
// 		  $meses[$id_months] = $monthsName['spanish'];
// 		}
// 	  }
?>
<script type="text/javascript">
//   function reloading(){
// 	window.location='/projections/projections/';
//   }
</script>

<?php //pr($projeccion);?>
  <table id="dateBottom" class="table-responsive">
	<tr />
		<td colspan="2" class="text-justified text-center" />Reporte Toneladas Granel a la fecha Proyecci&oacute;n y Variaci&oacute;n contra Presupuesto
  </table>

<!--   <div id="waiting" style="display:none;">Recalculating Projeccion</div> -->
  
      <table id="menu_info_small" class="table table-responsive">
		<tr />
		<td colspan="3" style="text-align:center;font-size:20px;" />Con datos al <?php e($projeccion['viewConfig']['currentDay']);?> de <?php e($projeccion['viewConfig']['mes']);?> de <?php e($projeccion['viewConfig']['year']);?>
	    <tr />
		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:#f4f4f4;" />
			<table id="<?php e(idTotalIndex);?>" class="table table-responsive">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:#f4f4f4;" />
				  <?php
					e($projeccion['workingDays']['currentWorkDays']);
// 					e($projeccion['workingDays']['currentWorkDaysDelay']);
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" />D&iacute;as Laborados
			  <tr />
<!-- 			    <td style="text-align:center;" /> -->
			</table>
		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:#f4f4f4;" />
			<table id="<?php e(idTotalIndex);?>" class="table table-responsive">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:#f4f4f4;" />
				  <?php
					e($projeccion['workingDays']['totalCurrentWorkingDays']);
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" />D&iacute;as Laborables
			  <tr />
<!-- 			    <td style="text-align:center;" /> -->
			</table>
		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:#f4f4f4;" />
			<table id="<?php e(idTotalIndex);?>" class="table table-responsive">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:#f4f4f4;" />
				  <?php
// 					e(number_format(money_format('%i',$projeccion['projectado']['totalGlobalOperationData']), 2, '.', ','));
					e(number_format(round($projeccion['projectado']['totalGlobalOperationData'])));
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" /><?php e($projeccion['viewConfig']['mesLabel']);?> a la fecha
			  <tr />
<!-- 			    <td style="text-align:center;" /> -->
			</table>

	  </table>

      <table id="menu_info_small" class="table table-responsive">

		<tr />
		<td colspan="2" style="text-align:center;font-size:20px;" />
	    <tr />
		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:#f4f4f4;" />
			<table id="<?php e(idTotalIndex);?>" class="table table-responsive">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:#f4f4f4;" />
				  <?php
// 					e(number_format(money_format('%i',$projeccion['projectado']['totalGlobalProjectionOperationData']), 2, '.', ','));
					e(number_format(round($projeccion['projectado']['totalGlobalProjectionOperationData'])));
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" /><?php e($projeccion['viewConfig']['mesLabel']);?> Proyectado
			  <tr />
<!-- 			    <td style="text-align:center;" /> -->
			</table>
			
		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:#f4f4f4;" />
			<table id="<?php e(idTotalIndex);?>" class="table table-responsive">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:#f4f4f4;" />
				  <?php
// 					e(number_format(money_format('%i',$projeccion['projectado']['totalGlobalCurrentPresupuesto']), 2, '.', ','));				
					if(isset($projeccion['projectado']['totalGlobalCurrentPresupuesto'])){
					  e(number_format(round($projeccion['projectado']['totalGlobalCurrentPresupuesto'])));
					}else{
					  e(number_format(round(0)));
					}
					
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" /> Presupuesto <?php e($projeccion['viewConfig']['mesLabel']);?>
			  <tr />
<!-- 			    <td style="text-align:center;" /> -->
			</table>

		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:#f4f4f4;" />
			<table id="<?php e(idTotalIndex);?>" class="table table-responsive">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:#f4f4f4;" />
				  <?php
// 					e($projeccion['projectado']['totalGlobalvarPresupuesto']);
// 					e(number_format(money_format('%i',$projeccion['projectado']['totalGlobalVarPresupuesto']), 2, '.', ','));
					e(number_format(round($projeccion['projectado']['totalGlobalVarPresupuesto'])));
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" />Variacion vs Presupuesto
			  <tr />
<!-- 			    <td style="text-align:center;" /> -->
			</table>
		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:#f4f4f4;" />
			<table id="<?php e(idTotalIndex);?>" class="table table-responsive">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:#f4f4f4;" />
				  <?php
					if(isset($projeccion['projectado']['totalGlobalVarPromedioDiario'])){
					  e(number_format(money_format('%i',$projeccion['projectado']['totalGlobalVarPromedioDiario']), 2, '.', ',').'%');
					}else{
					  e(number_format(money_format('%i',0), 2, '.', ',').'%');
					}
					
					
// 					e(number_format(round($projeccion['projectado']['totalGlobalVarPromedioDiario'])).' %');
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" />Variaci&oacute;n Promedio diario 
			  <tr />

<!-- 			    <td style="text-align:center;" /> -->
			</table>


	  </table>
 
  <table id="<?php e(idTotalIndex);?>" class="table table-responsive" >
	  <td style="text-align:center;font-size:12px;font-variant:small-caps;"/>
		  <a href="#" class="btn btn-default" role="button" onclick="Effect.toggle('detalles', 'appear'); return false;">
			&#9660; Detalles &#9660;
		  </a>
  </table>

  <div id="detalles" style="display:none;">
  
  <table id="menu_info_small" class="table table-responsive table-bordered">
	<tr />
		<th style="text-align:center;" />Unidades de Negocio
		<th style="text-align:center;" /><?php e($projeccion['viewConfig']['mesLabel']); e(' al d&iacute;a '); e($projeccion['viewConfig']['currentDay']); e(' de ') ; e($projeccion['viewConfig']['mes'])?>
		<th style="text-align:center;" /><?php e($projeccion['viewConfig']['mesLabel']);?> Proyectado
		<th style="text-align:center;" />Presupuesto <?php e($projeccion['viewConfig']['mesLabel']);?>
		<th style="text-align:center;" />Variacion vs Presupuesto diario
		<th style="text-align:center;" />Variacion Promedio Diario
	<tr />
		<td colspan="6" />&nbsp;
	<?php
	  if(!empty($projeccion['CurrentOperation'])){
		foreach($projeccion['CurrentOperation'] as $vindicator => $flotasVindicator){
				e('<tr />');
				if($vindicator == 'Tijuana'){
				  e('<th colspan="6" style="text-align:center;" />Mexicali');
				}else{
				  e('<th colspan="6" style="text-align:center;" />'.$vindicator);
				}
  // 		foreach($flotasVindicator as $fraccionVindicator => $fleetVindicator){
			foreach($flotasVindicator as $flotaName => $flotaOpData ){
  // 			if($fraccionVindicator === 'Granel'){
				e('<tr />');
				if($flotaName == 'Tijuana'){
				  e('<td />Mexicali');
				}else{
				  e('<td />'.$flotaName);
				}
// 				e('<td style="text-align:right;" />'.number_format(money_format('%i',$flotaOpData), 2, '.', ','));
				e('<td style="text-align:right;" />'.number_format(round($flotaOpData)));
				if(!isset($projeccion['projectado']['proyectadoTipoOperacion'][$vindicator][$flotaName])){
				  e('<td style="text-align:right;color:red;" />&nbsp;');
				}else{
// 				  e('<td style="text-align:right;" />'.number_format(money_format('%i',$projeccion['projectado']['proyectadoTipoOperacion'][$vindicator][$flotaName]), 2, '.', ','));
				  e('<td style="text-align:right;" />'.number_format(round($projeccion['projectado']['proyectadoTipoOperacion'][$vindicator][$flotaName])));
				}
				
  				if(array_search($flotaName,$projeccion['flotasDesc'][$vindicator])){
// 				  e('<td style="text-align:right;" />'.number_format(money_format('%i',$projeccion['Presupuesto'][$projeccion['id_empresa']][$projeccion['viewConfig']['year']][$projeccion['viewConfig']['monthLabel']][$flotaName]), 2, '.', ','));		
					//ALERT NOTE this case is beacuase i can have a existent flota but without "presupuesto"
					if(!isset($projeccion['Presupuesto'][$projeccion['id_empresa']][$projeccion['viewConfig']['year']][$projeccion['viewConfig']['monthLabel']][$flotaName])){
						
						e('<td style="text-align:right;" />&nbsp;');
					}else{
						e('<td style="text-align:right;" />'.number_format(round($projeccion['Presupuesto'][$projeccion['id_empresa']][$projeccion['viewConfig']['year']][$projeccion['viewConfig']['monthLabel']][$flotaName])));
					}
				  if(!isset($totalPresupuestoArea[$flotaName])){
					$totalPresupuestoArea[$vindicator] = null;
				  }
// 				  $totalPresupuestoArea[$vindicator]] += $projeccion['Presupuesto'][$projeccion['id_empresa']][$projeccion['viewConfig']['year']][$projeccion['viewConfig']['monthLabel']][$flotaName];
				}else{
				  e('<td style="text-align:right;color:red;" />&nbsp;');
				}

				if(!isset($projeccion['projectado']['proyectadoVarPresupuesto'][$vindicator][$flotaName])){
				  $projeccion['projectado']['proyectadoVarPresupuesto'][$vindicator][$flotaName] = null;
				  e('<td style="text-align:right;color:red;" />&nbsp;');
				}else{
				  if($projeccion['projectado']['proyectadoVarPresupuesto'][$vindicator][$flotaName] < 0){
// 					e('<td style="color:red;text-align:right;"/>'.number_format(money_format('%i',$projeccion['projectado']['proyectadoVarPresupuesto'][$vindicator][$flotaName]), 2, '.', ','));
					e('<td style="color:red;text-align:right;"/>'.number_format(round($projeccion['projectado']['proyectadoVarPresupuesto'][$vindicator][$flotaName])));
				  }else{
// 					e('<td style="text-align:right;" />'.number_format(money_format('%i',$projeccion['projectado']['proyectadoVarPresupuesto'][$vindicator][$flotaName]), 2, '.', ','));
					e('<td style="text-align:right;" />'.number_format(round($projeccion['projectado']['proyectadoVarPresupuesto'][$vindicator][$flotaName])));
				  }
				}
				
				if(!isset($projeccion['projectado']['proyectadoVarPromedioDiario'][$vindicator][$flotaName])){
				  $projeccion['projectado']['proyectadoVarPromedioDiario'][$vindicator][$flotaName]= null;
				}
				  if($projeccion['projectado']['proyectadoVarPromedioDiario'][$vindicator][$flotaName] < 0){
					e('<td style="color:red;text-align:center;" />'.number_format(money_format('%i',$projeccion['projectado']['proyectadoVarPromedioDiario'][$vindicator][$flotaName]), 2, '.', ',').'%');
// 					e('<td style="color:red;text-align:center;" />'.round($projeccion['projectado']['proyectadoVarPromedioDiario'][$vindicator][$flotaName]).'%');
				  }else{
					e('<td style="text-align:center;"/>'.number_format(money_format('%i',$projeccion['projectado']['proyectadoVarPromedioDiario'][$vindicator][$flotaName]), 2, '.', ',').'%');
// 					e('<td style="text-align:center;"/>'.round($projeccion['projectado']['proyectadoVarPromedioDiario'][$vindicator][$flotaName]).'%');
				  }

			  }
  // 		  }
  // 		}
				e('<tr />');
				
				if($vindicator == 'Tijuana'){
				  e('<th style="text-align:left;" />Mexicali');
				}else{
				  e('<th style="text-align:left;" />'.$vindicator);
				}
				e('<th style="text-align:right;" />'.number_format(round($projeccion['projectado']['totalOperationData'][$vindicator])));
				
				e('<th style="text-align:right;" />'.number_format(round($projeccion['projectado']['totalProjectionOperationData'][$vindicator])));
				
				e('<th style="text-align:right;" />'.number_format(round($projeccion['projectado']['totalCurrentPresupuesto'][$vindicator])));
				
				e('<th style="text-align:right;" />'.number_format(round($projeccion['projectado']['totalVarPresupuesto'][$vindicator])));
				e('<th style="text-align:right;" />'.number_format(money_format('%i',$projeccion['projectado']['totalVarPromedioDiario'][$vindicator]), 2, '.', ',') .'%');
  // number_format(money_format('%i',$projeccion['projectado']['totalVarPromedioDiario'][$vindicator]), 2, '.', ',')
		}
	  }
	?>

  </table>
	<?php //pr($totalPresupuestoArea);?>
  </div>
  
