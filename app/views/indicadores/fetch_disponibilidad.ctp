<?php if(isset($getDisponibilidadHistory)){?>
<table style="background:none;">
  <tr />
	<?php foreach($getDisponibilidadHistory['getTipoDisponibilidad'] as $tipoDisponibilidad => $idxContent){ ?>
<td width="50%" />
		<table id="<?php e(idTblHeaders);?>">
		  <tr />
			<td colspan="5" style="text-align:center;font-size:120%;font-weight:bold;" />
			  <?php
				e(ucfirst($tipoDisponibilidad));
			  ?>
			  <?php
				e($getDisponibilidadHistory['areaNamae']);
			  ?>
		</table>
		
	<?php
// 	  if((string)$tipoDisponibilidad == 'terceros'){
// 		$style = 'style="display:none;"';
// 	  }else{
// 		$style = null;
// 	  }
	?>

	<?php 	foreach($idxContent as $index => $disponibilidadValues){ ?>

		<table id="<?php e(idTotalIndexGray);?>" >
	<?php		foreach($getDisponibilidadHistory['translate'] as $labelDisponibilidad => $valueDisponibilidad){ ?>
		  <tr />
			<td width="4%"/>&nbsp;
			<td /><?php e($labelDisponibilidad)?>
			<td width="4%"/>&nbsp;
	<?php 		if((string)$labelDisponibilidad == 'Cumplimiento'){ ?>
		  <td /><?php e(number_format(money_format('%i',$disponibilidadValues[$valueDisponibilidad]*100), 2, '.', ','));e(' %');?>
		  
	<?php 		}else{ ?>
		  <td /><?php e($disponibilidadValues[$valueDisponibilidad])?>
	<?php 		} ?>
	<?php		}?>
		</table>
	<?php 	} ?>
	  
	<?php } ?>
</table>
<?php } ?>