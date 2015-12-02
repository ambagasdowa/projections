<?php
	//CostoVariable
?>

	<div class="simpleTabs"> <!--Container-->
		<ul class="simpleTabsNavigation">

		<?php foreach($mes as $idx => $mesName){?>
			<li><a href="#"><?php e($mesName);?></a></li>
		<?php }?>

		</ul>
		
<?php foreach($MssqlCostoFijoAtmVariable as $month => $mssqlFetchMonth){?>
	
	<div class="simpleTabsContent">
	
	<table id="dateBottom">
	<tr />
		<td colspan="2" />Costos Variables <?php e($month);?>
	</table>

<!-- 	<table id="<?php e(idTotalIndex);?>"> -->
	<table id="menu_info_small" >
		<th />Mes
		<th />Numero de Cuenta
		<th />Entidad
		<th />Nombre de Cuenta
<!-- 		<th />Cargo -->
<!-- 		<th />Abono -->
		<th />Real
		<th />Presupuesto
	<tr />
		<?php foreach($mssqlFetchMonth as $accountName => $mssqlDistinct){?>
		
		<?php foreach($mssqlDistinct as $distinct => $mssqlFetch){?>
			<tr />
			<td /><?php e($mssqlFetch['Mes']);?>
			<td /><?php e($mssqlFetch['NoCta']);?>
			<td /><?php e($distinct)?>
			<td />
				<?php
					echo $this->Html->link($accountName,
								array(
								'controller'=>'MssqlPresupuestoAtm',
								'action'=>'costoVariableDetail',
								$mssqlFetch['NoCta'],
								$mssqlFetch['Mes'],
								$distinct
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
			<?php }?>
		<?php }?>
	</table>
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