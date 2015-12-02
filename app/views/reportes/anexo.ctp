<?php // Reportes/anexo_a.ctp?>
<?php
  /** @update => from database
	  @package => From Flujo de Marzo.xls
  **/
//   Config view
?>


<?php

// echo $ajax->remoteTimer(
//     array(
//     'url' => array( 'controller' => 'Reportes', 'action' => 'anexos'),
//     'update' => 'divViewTotals',
//     'frequency' => 1
//     )
// );

?>

<?php
				  e($ajax->observeField('AnexoIdCuenta',
							  array("url"=>array("controller"=>"Reportes",
													  "action"=>"concept"
												),
										"update" => "divConcepts"
								   )
						  )
				  );

$status = false;
$anexo = null;

if(!isset($accounts)){
  $anx = $GetAccounts;
}else{
  $anx = $accounts;
}
// $anx['new'] = 'Nuevo';
?>
<div id="divConceptos"></div>
<?php 
if(isset($titleAnexo)){
						  e($form->input('Anexos.id_dir_anexo',
										array('type'=>'hidden',
											  'label'=>false,
											  'value'=>$_SESSION['anexo']
										)
									)
						  );
?>

      <table id="menu_info">
	  <tr />
	    <td colspan="3" style="text-align:center;font-size:120%;font-weight:bold;" /><?php e($titleAnexo);?>
      </table>

<?php
	  
	}else{
						  e($form->input('Anexos.id_dir_anexo',
										array('type'=>'hidden',
											  'label'=>false,
											  'value'=>'1'
										)
									)
						  );
	}
?>

<div id="divViewTotals">
<?php
/** @Description => If empty record in db show an input arrow
 *
 */
// 			App::Import('Controller','Reportes');
// 			echo $this->element('view_totals');

?>
</div>

<?php 
// pr($estimate['GetAnexoInput']);
// pr($estimate['GetAnexo']);
if(!isset($estimate['GetAnexoInput']) or $_SESSION['anexo'] == '0' ){
			App::Import('Controller','Reportes');
			echo $this->element('get_anexo');
}else{
?>
	  <table id="menu_info_small">
		<tr />
		  <?php
		  if(!empty($anx)){
		  ?>
				  <td />
					  <?php
						
						  e($form->input('Anexo.id_cuenta',
										array('type'=>'select',
											  'label'=>false,
// 											  'disabled'=>array('text' => 'usertype','selected'=>TRUE,'disabled' =>true),
											  'empty' => ' • Seleccionar Cuenta',
											  'error' => array('escape' => false),
											  'options'=>$anx
										)
									)
						  );

					  ?>
				  <td />
					<div id="divConcepts" >
					  <?php
						  e($form->input('Anx.concepto',
										array('type'=>'select',
											  'label'=>false,
											  'disabled'=>true,
											  'options'=>array(' • Seleccionar un Concepto')
										)
									)
						  );
					  ?>
					</div>
				  <td style="background:none;" />
					  <?php
						  e($form->input('Anexo.importe_prep',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'placeholder'=>'Cantidad'
// 								  			  'value'=>$estimate['Ingresos']['FlujoIngresos']['concreto']
										)
									)
						  );
// 						  e($form->end());
					  ?>
		  <?php }else{ ?>
			
				  <td />
					  <?php
						
						  e($form->input('Anexo.id_cuenta',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'placeholder'=>'  Nombre de la Cuenta'
										)
									)
						  );
						  

					  ?>
				  <td />
					  <?php
						  e($form->input('Anexo.id_concepto',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'options'=>$anx,
											  'placeholder'=>'  Nombre del Concepto'
										)
									)
						  );
					  ?>
				  <td style="background:none;" />
					  <?php
						  e($form->input('Anexo.importe_prep',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'placeholder'=>'  Cantidad',
// 								  			  'value'=>$estimate['Ingresos']['FlujoIngresos']['concreto']
										)
									)
						  );
// 						  e($form->end());
					  ?>
		  <?php } //end else?>

	  </table>
	
	<div id="divViewTotals">
	  <?php
			App::Import('Controller','Reportes');
			echo $this->element('anexos');
	  ?>
	</div>
	
		<div style="text-align:right;">
			<?php
			  	e($form->button('Guardar',
								  array('class'=>'button_blue')
						)
				);
				e($form->end());
			?>
		</div><br />
		
  <?php 
	} //end else of this view
  ?>