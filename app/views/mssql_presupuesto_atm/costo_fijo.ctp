<?php
	//CostoFijo
	$totalReal = $totalCargo = $totalAbono = $totalPresupuesto = null;
	
?>
	<div class="simpleTabs"> <!--Container-->
		<ul class="simpleTabsNavigation">

		<?php foreach($mes as $idx => $mesName){?>
			<li><a href="#"><?php e($mesName);?></a></li>
		<?php }?>

		</ul>

<?php foreach($MssqlCostoFijoAtm as $month => $mssqlFetchMonth){?>

	<div class="simpleTabsContent">
	
	<table id="dateBottom">
<!-- 	<table id="menu_info_small" > -->
	<tr />
		<td colspan="2" />Costos Fijos <?php e($month);?>
	</table>

<!-- 	<table id="<?php e(idTotalIndex);?>"> -->
	<table id="menu_info_small" >
		<th />Mes
		<th />Numero de Cuenta
		<th />Nombre de Cuenta
<!-- 		<th />Cargo -->
<!-- 		<th />Abono -->
		<th />Real
		<th />Presupuesto
	<tr />
		<?php foreach($mssqlFetchMonth as $accountName => $mssqlFetch){?>
			<tr />
			<td /><?php e($mssqlFetch['Mes']);?>
			<td /><?php e($mssqlFetch['NoCta']);?>
			<td />
				<?php
					echo $this->Html->link($accountName,
								array(
									'controller'=>'MssqlPresupuestoAtm',
									'action'=>'costoFijoDetail',
									$mssqlFetch['NoCta'],
									$mssqlFetch['Mes']
								),
								array(
// 									'class'=>'button_link',
									'title'=>'Volver',
									'alt'=>'Volver',
									'target'=>'blank'
								)
				    );
				?>
<!-- 			<td /><?php e($mssqlFetch['realCargo']);?> -->
<!-- 			<td /><?php e($mssqlFetch['realAbono']);?> -->
			<td /><?php e($mssqlFetch['realCargo']-$mssqlFetch['realAbono']);?>
			<td /><?php e($mssqlFetch['Presupuesto']);?>
			
			<?php $totalPresupuesto += $mssqlFetch['Presupuesto'];?>
			<?php $totalCargo += $mssqlFetch['realCargo'];?>
			<?php $totalAbono += $mssqlFetch['realAbono'];?>
			
		<?php }?>
	</table>
		<div>
			<?php
				e('<pre>');
				e('Total Presupuesto => '.$totalPresupuesto);
				e("\n");
				e('Total Cargo => '.$totalCargo);
				e("\n");
				e('Total Abono => '.$totalAbono);
				e("\n");
				e('Total Real => '.($totalCargo - $totalAbono));
				e("\n");
				e('</pre>');
			?>
		</div>
	</div>
<?php }?>
	</div>
<?php

// 		    e($this->Ajax->link('link',
// 			array(
// 			      'controller'=>'MssqlPresupuestoAtm',
// 			      'action'=>'costoFijodetail',
// 				  'var'
// 			),
// 			array(
// 			      'escape' => false,
// 			      "class" => 'link_blue',
// 			      "update" => "hide_div",
// 			      "loading" => "Element.hide('hide_div');Element.show('loading');",
// 			      "complete" => "Element.hide('loading');Effect.Grow('hide_div',{duration: 2.0});",
// // 			      'target'=>'_blank',
// 			      'alt'=>'Detalles',
// 			      'title' => 'Detalles'
// 			)
// 			// set msj to confirm
// // 			"Are you sure of this??"
// 		    )
// 		);
?>

		<?php
// 		  echo $this->Html->link('go ',
// 					array(
// 					  'action'=>'costosFijosDetail'
// 					 ),
// 					array(
// 					    'class'=>'button_link',
// 					    'title'=>'Volver',
// 					    'alt'=>'Volver',
// 						'target'=>'blank'
// 					)
// 				    );
		?>
		
		<?php 
// 				echo $this->Html->link($post['Post']['title'],
// 						array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); 
		?>