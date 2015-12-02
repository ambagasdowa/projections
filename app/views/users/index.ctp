<?php
//     pr($_SESSION['theme']);
/** @CONFIG **/
// $bootstrap = true;
if(isset($_SESSION['theme']['legacy']) and $_SESSION['theme']['legacy'] === true) {
	$btnAdd = 'button_link';
	$btnDrop = 'button_blue';
	$tableTitleConfig = ' id="menu_info_small" ';
	$tableBodyConfig = ' id="menu_info_small" ';
}else if(isset($_SESSION['theme']['protoquery']) and $_SESSION['theme']['protoquery'] === true) {
	$btnAdd = 'btn btn-primary';
	$btnDrop = 'btn btn-danger';
	$tableTitleConfig = ' class="table-condensed" ';
	$tableBodyConfig = ' class="table-hover table-condensed table-bordered table-striped" ';
}

?>
<div class="table-responsive">
	<table <?php e($tableTitleConfig);?>>
	<tr />
		<td /><h4> Usuarios</h4>
	</table>

		<div style="margin: 5px 0 10px 0 ;">
				<?php 
					echo $html->link('Agregar Usuarios',
												array('action' => 'add'),
												array('class'=>$btnAdd));
				?>
		</div>
	<?php
	// echo '<h2>Users</h2>';

	if (!empty($users)) {
		echo $form->create('User', array('action' => 'delete','onSubmit' => 'return confirm("Está Seguro de Eliminar  éste Usuario");'));
		echo '<table width="100%" '.$tableBodyConfig.'>';
		echo '  <thead>';
		$cells = array(
			$form->checkbox(null, array('id' => 'select-all')),
	//         null,
			'Editar',
			$this->Paginator->sort('Name', 'full_name'),
			$this->Paginator->sort('Email', 'email'),
			$this->Paginator->sort('Ultimo acceso', 'last_access'),
			$this->Paginator->sort("Nivel de permisos", 'level'),
		);
		echo $this->Html->tableHeaders($cells);
		echo '  </thead>';
		echo '  <tbody>';
		foreach($users as $i) {
			$cells = array(
				$form->checkbox('User.delete.' . $i['User']['id']),

				'<center>'.$this->Html->link($this->Html->image("icons/pen.png",
											array("alt" => "Editar",
												'title' => 'Editar',
												'width' => '15',
												'height' => '15'
											)
							),
											array(
												'action' => 'edit',
												$i['User']['id']
											),
											array('escape' => false),null
								).
				'</center>',
				$i['User']['full_name'],
				$i['User']['email'],
				$i['User']['last_access'],
				$i['User']['level'],
			);
			echo $this->Html->tableCells($cells, array('class' => 'odd'), array('class' => 'even'));
		}
		echo '  </tbody>';
		$numbers = $this->Paginator->numbers();
		if (!empty($numbers)) {
			$counter = $this->Paginator->prev('« Previous', null, null, array('class' => 'disabled'));
			$counter .= ' | '.$numbers.' | ';
			$counter .= $this->Paginator->next('Next »', null, null, array('class' => 'disabled'));
			echo '<tfoot>';
			echo $this->Html->tableCells(array(array(array($counter, array('colspan' => count($cells))))), null, null, true);
			echo '</tfoot>';
		}
		echo '</table>';
					
		e($form->button('Eliminar Usuario',array('class'=>$btnDrop)));
		echo $form->end();
	//     echo $form->end('Delete Selected');
	}
	?>

	<br />

	<table id="menu_info_small" >
		<td style="text-align:center;font-weight:bold;font-variant:small-caps;"/>
			<a href="#" onclick="Effect.toggle('detallesUsers', 'appear'); return false;" alt="More" title="More">
				&#9660; Informaci&oacute;n sobre los usuarios &#9660;
			</a>
	</table>



	<div id="detallesUsers" style="display:none;">
	<table id="menu_info_small">
	<tr />
		<th colspan="4" />Descripci&oacute;n de niveles de Usuario
	<tr />
		<td style="font-weight:bold;"/>Nivel
		<td style="font-weight:bold;"/>Empresas que puede consultar
		<td style="font-weight:bold;"/>Descripci&oacute;n
		<td style="font-weight:bold;"/>Permisos para Crear/Editar/Eliminar Usuarios
	<tr />
		<td />0
		<td />Todas las Empresas
		<td />Administrador/SuperUser
		<td />
			<?php
				e($this->Html->image("icons/check.png",
											array("alt" => "Con Permisos",
													'title' => 'Con permisos',
													'width' => '15',
													'height' => '15'
											)
				)
				);

	//             e($this->Html->link($this->Html->image("icons/check.png",
	// 										array("alt" => "Editar",
	// 											  'title' => 'Editar',
	// 											  'width' => '15',
	// 											  'height' => '15'
	// 										)
	// 						),
	// 										array(
	// 											'action' => 'edit',
	// 											$i['User']['id']
	// 										),
	// 									    array('escape' => false),null
	// 							)
	// 			);
			?>
	<tr />
		<td />2
		<td />Empresas Bonampak &amp; Atm
		<td />Usuario-Operaciones/OpUser
		<td />
			<?php
				e($this->Html->image("icons/delete.png",
											array("alt" => "Sin Permisos",
													'title' => 'Sin permisos',
													'width' => '15',
													'height' => '15'
											)
				)
				);
			?>
	<tr />
		<td />3
		<td />Empresas Bonampak &amp; Teisa
		<td />Usuario-Operaciones/OpUser
		<td />
			<?php
				e($this->Html->image("icons/delete.png",
											array("alt" => "Sin Permisos",
													'title' => 'Sin permisos',
													'width' => '15',
													'height' => '15'
											)
				)
				);
			?>
	<tr />
		<td />7
		<td />Empresa a la que pertenece el usuario
		<td />Usuario/User
		<td />
			<?php
				e($this->Html->image("icons/delete.png",
											array("alt" => "Sin Permisos",
													'title' => 'Sin permisos',
													'width' => '15',
													'height' => '15'
											)
				)
				);
			?>
	</table>
	</div>

</div>

