	<?php 
		$indicadores = array('1'=>'viajes','2'=>'unidades','3'=>'operadores','4'=>'km-ruta','5'=>'Unidades Designadas','6'=>'Unidades Disponibles','7'=>'Personal Asignado');
		foreach($indicadores as $idIndicadores => $indName){
		  if($idIndicadores < 5){
			unset($indicadores[$idIndicadores]);
		  }
		}

// 		$indicadores = $disponibilidad['disponibilidad']['view']['flotas'];
	?>
  <?php
	  e($ajax->form(array("type"=>"post",
						  "options"=>array("model"=>"disponibilidad",
						  'update' => 'divfetchDisponibilidad',
						  "url"=>array("controller"=>'Indicadores',"action"=>"fetchDisponibilidad"),
							  )
						)
				  )
	  );
  ?>

<?php $fecha = $disponibilidad['disponibilidad']['date']['year'].'-'.$disponibilidad['disponibilidad']['date']['month'].'-'.$disponibilidad['disponibilidad']['date']['day'];?>
<?php //var_dump($id_area);?>
<?php //pr($disponibilidad);?>


	<table id="<?php e(idTblHeaders);?>">
	  <tr />
		<td colspan="5" style="text-align:center;font-size:120%;font-weight:bold;" />Indicadores Disponibilidad para <?php e($disponibilidad['disponibilidad']['title']['area']);?>
	</table>

<!--   <div id="waiting" style="display:none;">Recalculating Projeccion</div> -->

	<?php
		foreach(fleetsConfig() as $id => $fleetConfig){
		  if(!empty($disponibilidad['disponibilidad'][$fleetConfig])){
	?>
	
	<table id="<?php e(idTotalIndex);?>" >
		<td style="text-align:center;font-size:12px;font-variant:small-caps;"/>
			<a href="#" onclick="Effect.toggle('divDisponibilidad<?php e(ucfirst($fleetConfig));?>', 'appear'); return false;">
			  &#9660; <?php e(ucfirst($fleetConfig));?> &#9660;
			</a>
	</table>

	<?php
	  if($fleetConfig == 'terceros'){
		$style = 'style="display:none;"';
	  }else{
		$style = null;
	  }
	?>
	<div id="divDisponibilidad<?php e(ucfirst($fleetConfig));?>" <?php e($style)?> >

      <table id="menu_info_small">
		<tr />
		<td colspan="6" style="text-align:center;font-size:20px;" />Con datos al <?php e($disponibilidad['disponibilidad']['date']['day']);?> de <?php e($disponibilidad['disponibilidad']['date']['mes']);?> de <?php e($disponibilidad['disponibilidad']['date']['year']);?>
	    <tr />
		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:white;" />
			<table id="<?php e(idTotalIndex);?>">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:white;" />
				  <?php
					e($disponibilidad['disponibilidad']['date']['currentWorkingday']);
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" />D&iacute;as Laborados
			  <tr />
<!-- 			    <td style="text-align:center;" /> -->
			</table>
		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:white;" />
			<table id="<?php e(idTotalIndex);?>">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:white;" />
				  <?php
// 					e($disponibilidad['disponibilidad']['date']['totalCurrentWorkingdays']);
					e($disponibilidad['disponibilidad'][$fleetConfig]['unidades']['totales']);
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" />Unidades Totales
			  <tr />
<!-- 			    <td style="text-align:center;" /> -->
			</table>
			
		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:white;" />
			<table id="<?php e(idTotalIndex);?>">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:white;" />
				  <?php
					if(!isset($disponibilidad['disponibilidad'][$fleetConfig]['personal']['asignado'])){
					  e('0');
					}else{
					  e($disponibilidad['disponibilidad'][$fleetConfig]['personal']['asignado']);
					}
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" />Personal Asignado
			  <tr />
<!-- 			    <td style="text-align:center;" /> -->
			</table>
			
		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:white;" />
			<table id="<?php e(idTotalIndex);?>">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:white;" />
				  <?php
// 					e(number_format(money_format('%i',$disponibilidad['projectado']['totalGlobalOperationData']), 2, '.', ','));
					if(!isset($disponibilidad['disponibilidad'][$fleetConfig]['unidades']['disponibles'])){
					  e(number_format(round(0)));
					}else{
					  e(number_format(round($disponibilidad['disponibilidad'][$fleetConfig]['unidades']['disponibles'])));
					}
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" /><?php //e($disponibilidad['disponibilidad']['date']['mes']);?> Unidades Disponibles
			  <tr />
<!-- 			    <td style="text-align:center;" /> -->
			</table>
			
		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:white;" />
			<table id="<?php e(idTotalIndex);?>">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:white;" />
				  <?php
// 					e(number_format(money_format('%i',$disponibilidad['projectado']['totalGlobalProjectionOperationData']), 2, '.', ','));
					e(number_format(round($disponibilidad['disponibilidad'][$fleetConfig]['unidades']['transito'])));
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" />Unidades en Transito
			  <tr />
<!-- 			    <td style="text-align:center;" /> -->
			</table>
		
		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:white;" />
			<table id="<?php e(idTotalIndex);?>">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:white;" />
				  <?php
// 					e(number_format(money_format('%i',$disponibilidad['projectado']['totalGlobalCurrentPresupuesto']), 2, '.', ','));				
					if($disponibilidad['disponibilidad'][$fleetConfig]['unidades']['totales'] > $disponibilidad['disponibilidad'][$fleetConfig]['unidades']['disponibles']){
					  e(number_format(round($disponibilidad['disponibilidad'][$fleetConfig]['unidades']['totales']-$disponibilidad['disponibilidad'][$fleetConfig]['personal']['asignado'])));
					}else{
					  e(number_format(round(0)));
					}
					
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" /> Unidades sin Operador
			  <tr />
<!-- 			    <td style="text-align:center;" /> -->
			</table>
		
	  </table>

      <table id="menu_info_small">

<!--		<tr />
		<td colspan="2" style="text-align:center;font-size:20px;" />-->
	    <tr />
		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:white;" />
			<table id="<?php e(idTotalIndex);?>">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:white;" />
				  <?php
// 					e(number_format(money_format('%i',$disponibilidad['projectado']['totalGlobalProjectionOperationData']), 2, '.', ','));
					e(number_format(round($disponibilidad['disponibilidad'][$fleetConfig]['unidades']['fuera_de_servicio'])));
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" />Unidades Fuera de servicio
			  <tr />
<!-- 			    <td style="text-align:center;" /> -->
			</table>
			
		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:white;" />
			<table id="<?php e(idTotalIndex);?>">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:white;" />
				  <?php
// 					e(number_format(money_format('%i',$disponibilidad['projectado']['totalGlobalCurrentPresupuesto']), 2, '.', ','));				
					if(isset($disponibilidad['disponibilidad'][$fleetConfig]['unidades']['mantenimiento'])){
					  e(number_format(round($disponibilidad['disponibilidad'][$fleetConfig]['unidades']['mantenimiento'])));
					}else{
					  e(number_format(round(0)));
					}
					
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" /> Unidades en Mantenimiento
			  <tr />
<!-- 			    <td style="text-align:center;" /> -->
			</table>

		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:white;" />
			<table id="<?php e(idTotalIndex);?>">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:white;" />
				  <?php
// 					e($disponibilidad['projectado']['totalGlobalvarPresupuesto']);
// 					e(number_format(money_format('%i',$disponibilidad['projectado']['totalGlobalVarPresupuesto']), 2, '.', ','));
					e(number_format(round($disponibilidad['disponibilidad'][$fleetConfig]['unidades']['accidentados'])));
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" />Unidades Accidentadas
			  <tr />
<!-- 			    <td style="text-align:center;" /> -->
			</table>
			
		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:white;" />
			<table id="<?php e(idTotalIndex);?>">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:white;" />
				  <?php
					if(isset($disponibilidad['disponibilidad'][$fleetConfig]['unidades']['cargado'])){
					  e(number_format(money_format('%i',$disponibilidad['disponibilidad'][$fleetConfig]['unidades']['cargado'])));
					}else{
					  e(number_format(money_format('%i',0), 2, '.', ',').'%');
					}
					
					
// 					e(number_format(round($disponibilidad['projectado']['totalGlobalVarPromedioDiario'])).' %');
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" />Unidades Cargadas
			  <tr />

<!-- 			    <td style="text-align:center;" /> -->
			</table>

		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:white;" />
			<table id="<?php e(idTotalIndex);?>">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:white;" />
				  <?php
// 					e(number_format(money_format('%i',$disponibilidad['projectado']['totalGlobalProjectionOperationData']), 2, '.', ','));
					e(number_format(round($disponibilidad['disponibilidad'][$fleetConfig]['unidades']['descargado'])));
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" />Unidades Descargadas
			  <tr />
<!-- 			    <td style="text-align:center;" /> -->
			</table>
		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:white;" />
			<table id="<?php e(idTotalIndex);?>">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:white;" />
				  <?php
// 					e(number_format(money_format('%i',$disponibilidad['projectado']['totalGlobalProjectionOperationData']), 2, '.', ','));
					e(number_format(round($disponibilidad['disponibilidad'][$fleetConfig]['unidades']['fuera_de_servicio'])));
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" />Unidades sin Descargar
			  <tr />
<!-- 			    <td style="text-align:center;" /> -->
			</table>
			
	  </table>

      <table id="menu_info_small">

<!--		<tr />
		<td colspan="2" style="text-align:center;font-size:20px;" />-->
	    <tr />
		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:white;" />
			<table id="<?php e(idTotalIndex);?>">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:white;" />
				  <?php
// 					e($disponibilidad['projectado']['totalGlobalvarPresupuesto']);
// 					e(number_format(money_format('%i',$disponibilidad['projectado']['totalGlobalVarPresupuesto']), 2, '.', ','));
					e(number_format(round($disponibilidad['disponibilidad'][$fleetConfig]['unidades']['accidentados'])));
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" />Unidades Detenidas
			  <tr />
<!-- 			    <td style="text-align:center;" /> -->
			</table>
			
		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:white;" />
			<table id="<?php e(idTotalIndex);?>">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:white;" />
				  <?php
// 					e(number_format(money_format('%i',$disponibilidad['projectado']['totalGlobalProjectionOperationData']), 2, '.', ','));
					e(number_format(round($disponibilidad['disponibilidad'][$fleetConfig]['unidades']['fuera_de_servicio'])));
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" />Toneladas Programa
			  <tr />
<!-- 			    <td style="text-align:center;" /> -->
			</table>
			
		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:white;" />
			<table id="<?php e(idTotalIndex);?>">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:white;" />
				  <?php
// 					e(number_format(money_format('%i',$disponibilidad['projectado']['totalGlobalCurrentPresupuesto']), 2, '.', ','));				
					if(isset($disponibilidad['disponibilidad'][$fleetConfig]['unidades']['toneladas'])){
					  e(number_format(round($disponibilidad['disponibilidad'][$fleetConfig]['unidades']['toneladas'])));
					}else{
					  e(number_format(round(0)));
					}
					
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" />Toneladas Real
			  <tr />
<!-- 			    <td style="text-align:center;" /> -->
			</table>
			
		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:white;" />
			<table id="<?php e(idTotalIndex);?>">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:white;" />
				  <?php
					if(isset($disponibilidad['disponibilidad'][$fleetConfig]['unidades']['viajes_despachados'])){
					  e(number_format(money_format('%i',$disponibilidad['disponibilidad'][$fleetConfig]['unidades']['viajes_despachados'])));
					}else{
					  e(number_format(money_format('%i',0)));
					}
					
					
// 					e(number_format(round($disponibilidad['projectado']['totalGlobalVarPromedioDiario'])).' %');
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" />Viajes HA
			  <tr />

<!-- 			    <td style="text-align:center;" /> -->
			</table>

		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:white;" />
			<table id="<?php e(idTotalIndex);?>">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:white;" />
				  <?php
					if(isset($disponibilidad['disponibilidad'][$fleetConfig]['unidades']['productividad'])){
					  e(number_format(money_format('%i',$disponibilidad['disponibilidad'][$fleetConfig]['unidades']['productividad']), 2, '.', ',').'%');
					}else{
					  e(number_format(money_format('%i',0), 2, '.', ',').'%');
					}
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" />Productividad HA
			  <tr />
<!-- 			    <td style="text-align:center;" /> -->
			</table>
		<td width="<?php e($_SESSION['projections']['viewConfig']['width']);?>" style="text-align:center;background-color:white;" />
			<table id="<?php e(idTotalIndex);?>">
			  <tr />
			    <td height="<?php e($_SESSION['projections']['viewConfig']['height']);?>" style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSize']);?>%;font-weight:bold;background-color:white;" />
				  <?php
// 					e($disponibilidad['projectado']['totalGlobalvarPresupuesto']);
// 					e(number_format(money_format('%i',$disponibilidad['projectado']['totalGlobalVarPresupuesto']), 2, '.', ','));
					e(number_format(round($disponibilidad['disponibilidad'][$fleetConfig]['unidades']['accidentados'])));
				  ?>
			  <tr />
			    <td style="text-align:center;font-size:<?php e($_SESSION['projections']['viewConfig']['fontSizeTitle']);?>%;" />Cumplimiento
			  <tr />
<!-- 			    <td style="text-align:center;" /> -->
			</table>
	  </table>

	</div>
	
	<?php
		  }//End if isset $fleetConfig
		}//End foreach
	?>
	
	  <?php

		e($this->Form->input('Projections.id_area',
										array('type'=>'hidden',
											  'value'=>$disponibilidad['disponibilidad']['post']['id_area'],
											  'label'=>false
											 )
							)
		);
		e($this->Form->input('Projections.fecha',
										array('type'=>'hidden',
											  'value'=>$disponibilidad['disponibilidad']['post']['fecha'],
											  'label'=>false
											 )
							)
		);
	  ?>
	  <div>
		  <?php
		  if(!empty($disponibilidad['disponibilidad']['post']['id_area'])){
			e($this->Form->button('Detalles',array("label"=>false,
												   'class'=>'button_gray'
												   )
								  )
			 );
		  }
		  ?>
	  </div>

	  <div id="divfetchDisponibilidad">
		  <?php
// 			  echo date("h:m:s");
// 			  echo $this->element('fetch_disponibilidad',array('getDisponibilidadHistory'=>$this->requestAction('Indicadores/fetchDisponibilidad')));
			  echo $this->element('fetch_disponibilidad');
// 			  e($this->element('nomina',array(	'getNominaXml'=>$this->requestAction('Nomina/getNominaXml'),
// 												'nomina'=>$this->requestAction('Nomina/viewNomina'),
// 												'getVindicators'=>$this->requestAction('Nomina/getVindicators')
// 										)
// 							  )
// 			  );

		  ?>
	  </div>
