<?php 
// 	pr($_SESSION['Auth']['User']['id_empresa']);
/** @set=>this_comes_from_controller_and_SESSION */
	$acumulado = $_SESSION['projections']['acumulado'];
	$projeccion = $_SESSION['projections']['projeccion'];
	
// pr($_SESSION['projections']['operacion']['totalToneladasAreaAnual'][$id_empresa]['Granel']);	
// pr($_SESSION['projections']['acumulado']);
// 	$mesOld = $_SESSION['projections']['months'][date('m')-1]['spanish'];
	$id_empresa = $_SESSION['Auth']['User']['id_empresa'];
	
	/** TODO @var=>year build to be dynamic in acumulado controller */
// 	$year= date('Y');
// 	$year= $_SESSION['Auth']['User']['year'];
	$mes = $_SESSION['projections']['months'][$_SESSION['projections']['acumulado']['acumuladoDate']['id_mes']]['spanish'];
	
	$year = $_SESSION['projections']['acumulado']['acumuladoDate']['year'];
	$day = $_SESSION['projections']['acumulado']['acumuladoDate']['day'];
	
// 	$mes = $_SESSION['projections']['acumualdo']['acumuladoDate']['id_mes'];
	/** @Config=>table_of_details re-arrange the align and red status */
	$style = 'style="text-align:right;"';
	$addstyle = 'style="text-align:right;color:red;"';
	$styleleft = 'style="text-align:left;"';
	$down = '<div class="arrow-up"></div>';
	$normal = null;

// 	pr($mes);
// 	pr($mesOld);
?>
<style>
.arrow-up{
	width: 0; 
	height: 0; 
	border-left: 5px solid transparent;
	border-right: 5px solid transparent;
	border-bottom: 5px solid black;
}
</style>


  <table id="dateBottom" class="table-responsive">
	<tr />
		<td colspan="2" class="text-justified text-center" />Acumulado Proyecciones
  </table>

      <table id="menu_info_small" class="table table-responsive">
		<tr />
		<td colspan="3" style="text-align:center;font-size:20px;" />Con datos al <?php e($day);?> de <?php e($mes);?> de <?php e($year);?>
	    <tr />
		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:#f4f4f4;" />
			<table id="<?php e(idTotalIndex);?>" class="table table-responsive">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:#f4f4f4;" />
				  <?php
					if(!isset($acumulado['totalGlobalAcumuladoVarToneladas'])){
					  e(number_format(round(0)));
					}else{
					  e(number_format(round($acumulado['totalGlobalAcumuladoVarToneladas'])));
					}
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" />Variaci&oacute;n Toneladas
			  <tr />
<!-- 			    <td style="text-align:center;" /> -->
			</table>
		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:#f4f4f4;" />
			<table id="<?php e(idTotalIndex);?>" class="table table-responsive">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:#f4f4f4;" />
				  <?php
// 					e(number_format(($acumulado['totalGlobalAcumuladoVariation'])).' %');
					if(!isset($acumulado['totalGlobalAcumuladoVariation'])){
					  e((number_format(money_format('%i',0), 2, '.', ',')).' %');
					}else{
					  e((number_format(money_format('%i',$acumulado['totalGlobalAcumuladoVariation']), 2, '.', ',')).' %');
					}
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" />Variaci&oacute;n
			  <tr />
<!-- 			    <td style="text-align:center;" /> -->
			</table>
		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:#f4f4f4;" />
			<table id="<?php e(idTotalIndex);?>" class="table table-responsive">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:#f4f4f4;" />
				  <?php
// 					e(number_format(money_format('%i',$projeccion['projectado']['totalGlobalOperationData']), 2, '.', ','));
					e(number_format(round($acumulado['operacionTotalCurrent'])));
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" /><?php e($mes);?> a la fecha Granel
			  <tr />
<!-- 			    <td style="text-align:center;" /> -->
			</table>

	  </table>

 
  <table id="<?php e(idTotalIndex);?>" class="table table-responsive" >
	  <td style="text-align:center;font-size:12px;font-variant:small-caps;"/>
		  <a href="#" class="btn btn-default" role="button" onclick="Effect.toggle('detallesAcumulado', 'appear'); return false;">
			&#9660; Detalles &#9660;
		  </a>
  </table>


  <div id="detallesAcumulado" style="display:none;">

  <table id="menu_info_small" class="table table-responsive table-bordered" >
	<th />Unidad de Negocio
	<th />Presupuesto 
	<th />Toneladas Reales
	<th />Variaci&oacute;n Toneladas
	<th />Variaci&oacute;n
  <?php
	if(isset($acumulado['acumuladoPresupuesto'])){
	  foreach($acumulado['acumuladoPresupuesto'] as $areaName => $variationsValues){
  ?>
		<tr />
			<td <?php e($styleleft);?> />
			  <?php
// 				if($areaName){
				  if($areaName == 'Culiacan'){
					e('Culiac&aacute;n');
				  }elseif($areaName == 'Tijuana'){
					e('Mexicali');
				  }elseif($areaName == 'Ciudad Juarez'){
					  e('Ciudad Ju&aacute;rez');
				  }else{
					e($areaName);
				  }
				  
// 				}
			  ?>
			<td <?php e($style);?> />
			  <?php 
				  e(number_format(round($acumulado['acumuladoBuildingPrep'][$id_empresa][$year][$areaName])));
			  ?>
			<td <?php e($style);?> />
			  <?php
				  e(number_format(round($acumulado['acumuladoBuildingWork'][$id_empresa][$year][$areaName])));
			  ?>
			<td <?php $check = ($variationsValues['varToneladas'] < 0) ? e($addstyle) : e($style) ; ?> />
			  <?php
				  e(number_format(round($variationsValues['varToneladas'])));
// 				  $checkdiv = ($variationsValues['varToneladas'] < 0) ? e(' &#9660;') : e(' '/*.'&#9679;'*/) ;
			  ?>
			<td <?php $check = ($variationsValues['variation'] < 0) ? e($addstyle) : e($style) ; ?> />
			  <?php
				  e((number_format(money_format('%i',$variationsValues['variation']*100), 2, '.', ',')) .' %');
			  ?>
	
  <?php
	  }
	}
  ?>
  </table>
  </div>
