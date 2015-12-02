	<?php 
		$indicadores = array('1'=>'viajes','2'=>'unidades','3'=>'operadores','4'=>'km-ruta','5'=>'Unidades Designadas','6'=>'Unidades Disponibles','7'=>'Personal Asignado');
		foreach($indicadores as $idIndicadores => $indName){
		  if($idIndicadores === 3 OR $idIndicadores > 4){
			unset($indicadores[$idIndicadores]);
		  }
		}
	?>
	
	<table id="<?php e(idTblHeaders);?>">
	  <tr />
		<td colspan="3" style="text-align:center;font-size:120%;font-weight:bold;" />Indicadores Costos
	</table>
	
	<?php
		foreach($indicadores as $id_indicadores => $indicador){
	?>

	<table id="<?php e(idTotalIndex);?>" >
		<td style="text-align:center;font-size:12px;font-variant:small-caps;"/>
			<a href="#" onclick="Effect.toggle('divCostos<?php e(ucfirst($indicador));?>', 'appear'); return false;">
			  &#9660; Costos por <?php e(ucfirst($indicador));?> &#9660;
			</a>
	</table>

	<div id="divCostos<?php e(ucfirst($indicador));?>" style="display:none;">
	
	  <table id="<?php e(idTotalIndex);?>" >
		<tr />
		  <td />&nbsp;
	  </table>
	
	
	</div>

	<?php
		}//End foreach
	?>
	