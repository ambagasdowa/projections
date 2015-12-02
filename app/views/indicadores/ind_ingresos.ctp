	<?php 
		$indicadores = array('1'=>'viajes','2'=>'unidades','3'=>'operadores','4'=>'km-ruta','5'=>'Unidades Designadas','6'=>'Unidades Disponibles','7'=>'Personal Asignado');
		foreach($indicadores as $idIndicadores => $indName){
		  if($idIndicadores > 4){
			unset($indicadores[$idIndicadores]);
		  }
		}
		$width = array('1'=>'5%','2'=>'20%','3'=>'12.5%','4'=>'75%');
	?>

	<script>
	  <?php e("document.observe('dom:loaded',function(){"); //what's this ? you don't know , Go to school then ?>
// 	Example with out over
// 	  new Control.Tabs(<?php e("'indicadoresIngresos'");?>);

	  <?php foreach($indicadores as $ind => $indxName){ ?>
		  new Control.Tabs(<?php e("'indicadoresIngresos".ucfirst($indxName)."'");?>,{
			  hover: true
		  });
	  <?php foreach($_SESSION['projections']['projeccion']['flotasDesc'] as $areasName => $areaCont){?>

		  new Control.Tabs(<?php e("'indicadoresIngresos".ucfirst($indxName).str_replace(' ','',$areasName)."'");?>,{
			  hover: true
		  });

	  <?php 	foreach($_SESSION['projections']['months'] as $idMonth => $MonthsContainer){ ?>
// 		  new Control.Tabs(<?php e("'indicadoresIngresos".ucfirst($indxName).$areasName.$MonthsContainer['short']."'");?>,{
// 			  hover: true
// 		  });

	  <?php 
			  }
			}
		?>

	  <?php }?>

	  <?php e('});');?>
	</script>

	
	<table id="<?php e(idTblHeaders);?>">
	  <tr />
		<td colspan="3" style="text-align:center;font-size:120%;font-weight:bold;" />Indicadores Ingresos
	</table>

	<?php
		foreach($indicadores as $id_indicadores => $indicador){
	?>
	<div id="prototabs">
	  <table id="<?php e(idTotalIndex);?>" >
		  <td style="text-align:center;font-size:12px;font-variant:small-caps;"/>
			  <a href="#" onclick="Effect.toggle('divIngresos<?php e(ucfirst($indicador));?>', 'appear'); return false;">
				&#9660; Ingresos por <?php e(ucfirst($indicador));?> &#9660;
			  </a>
	  </table>

	  <div id="divIngresos<?php e(ucfirst($indicador));?>" style="display:none;">

		  <table id="<?php e(idTotalIndex);?>" >
			<tr />
				<td />
				  <table>
					  <tr />
						<td />
						 <ul id="indicadoresIngresos<?php e(ucfirst($indicador));?>" class="subsection_tabs">
						  <?php foreach($_SESSION['projections']['projeccion']['flotasDesc'] as $areaName => $areaCont){ ?>
							<li class="tab">
							  <a href="#<?php e(ucfirst($indicador).$areaName);?>">
								<?php e($areaName);?>
							  </a>
							</li>
						  <?php }?>
						 </ul>
				  </table>
			<tr />
				<td />

				  <?php foreach($ind_ingresos['viajes'] as $areas => $meses){ ?>
					<div id="<?php e(ucfirst($indicador).$areas);?>">
					  <ul id="indicadoresIngresos<?php e(ucfirst($indicador).str_replace(' ','',$areas));?>" class="subsection_tabs">
						<?php foreach($_SESSION['projections']['months'] as $id_month => $monthsContaint){ ?>
						  <li class="tab">
							<a href="#<?php e(ucfirst($indicador).$areas.$monthsContaint['short']);?>">
								<?php e($monthsContaint['spanish']);?>
							</a>
						  </li>
						<?php }?>
					  </ul>
					  
					<?php foreach($meses as $mesesNames => $fracciones){?>
						<div id="<?php e(ucfirst($indicador).$areas.$mesesNames);?>">
<!-- 						  <?php e(ucfirst($indicador).$mesesNames.$areas);?> -->
<!-- 	  cut detail-->

			<table>
			  <?php
			  foreach($fracciones as $fraccionesName => $dias){
				if(isset($dias)){
			  ?>
				<tr />
				  <td width="<?php e($width['1']);?>" id="<?php e(idTotalIndex);?>" />&nbsp;
				  <td width="<?php e($width['2']);?>" id="<?php e(idTotalIndex);?>" />&nbsp;
				  <td width="<?php e($width['3']);?>" id="<?php e(idTotalIndex);?>" />&nbsp;
				  <td width="<?php e($width['3']);?>" id="<?php e(idTotalIndex);?>" style="text-align:center;font-size:12px;font-variant:small-caps;" />
					  <a href="#" onclick="Effect.toggle('divIngresos<?php e($mesesNames.ucfirst($areas).ucfirst($fraccionesName).ucfirst($indicador));?>', 'appear'); return false;">
						&#9660; <?php e(ucfirst($fraccionesName));?> &#9660;
					  </a>
				  <td id="<?php e(idTotalIndex);?>" width="60%" colspan="4" />
				<tr />
				  <td colspan="8" /><!--Contains the data row by row inside in a table-->
				  <div style="display:none;background-color:black;" id="divIngresos<?php e($mesesNames.ucfirst($areas).ucfirst($fraccionesName).ucfirst($indicador));?>">
			  <table>
				  <tr />
					<th width="<?php e($width['1']);?>" />&gt;
					<th width="<?php e($width['2']);?>" />Area
					<th width="<?php e($width['3']);?>" />Fraccion
					<th width="<?php e($width['3']);?>" />Mes
					<th width="<?php e($width['3']);?>" />D&iacute;a
					<th width="<?php e($width['3']);?>" />Ingresos
					<th width="<?php e($width['3']);?>" /><?php e(ucfirst($indicador));?>
					<th width="<?php e($width['3']);?>" />Ingresos/<?php e(ucfirst($indicador));?>

				<?php foreach($dias as $id_dia => $dataDias){ ?>
					<tr />
					  <td width="<?php e($width['1']);?>"/>&nbsp;
					  <td width="<?php e($width['2']);?>"/><?php e($areas);?>
					  <td width="<?php e($width['3']);?>"/><?php e($fraccionesName);?>
					  <td width="<?php e($width['3']);?>"/><?php e($mesesNames);?>
					  <td width="<?php e($width['3']);?>"/><?php e((int)$id_dia);?>
					  <td width="<?php e($width['3']);?>"/><?php e("\$ ").e(number_format(round($ind_ingresos['ingresos'][$areas][$mesesNames][$fraccionesName][$id_dia])));?>
					  <td width="<?php e($width['3']);?>"/><?php e((int)$dataDias);?>
					  <td width="<?php e($width['3']);?>"/>
				<?php 
						if(isset($ind_ingresos['ingresos'.ucfirst($indicador)])){
						  e("\$ ").e($ind_ingresos['ingresos'.ucfirst($indicador)][$areas][$mesesNames][$fraccionesName][$id_dia]);
						}else{
						  e('&nbsp;');
						}
				  ?>
	<?php		 }//foreach $dias ?>
			</table>
			</div>
	<?php
				}//isset $dias
			  }//foreach $Fracciones
	?>
			</table>
<!-- 	  cut detail -->
						</div>
					<?php }?>

					</div> <!--end indicador por area-->
				  <?php } ?>
		  </table>

	  </div> <!--divIngresos<?php e(ucfirst($indicador));?>-->
	</div> <!--div=>prototabs-->
	<?php
		}//End foreach
	?>
	
	<?php
// 	  pr($ind_ingresos['viajes']);
// 	  pr($_SESSION['projections']['projeccion']['flotasDesc']);
// 	  pr($ind_ingresos['viajes']);
// 	  pr($_SESSION['projections']['months']);
	?>