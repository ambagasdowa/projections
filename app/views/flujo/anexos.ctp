<?php 
$totalImportePresupuesto = null;
$totalImporteReal = null;
?>
	  <table id="menu_info_small">
		<tr />
		  <th />Id
		  <th />Nombre
		  <th />Importe Real
		  <th />Importe Presupuesto
		  <th />Concepto
		  
		  <?php
			foreach($estimate['GetAnexoInput'] as $id_anexo => $anexoData){
		  ?>
				<tr />
				  <td /><?php e($anexoData['Anexos']['id_anexo']);?>
				  <td style="background:none;" />
					  <?php
						  e($form->input("Anexos.$id_anexo.id_anexo",
										array('type'=>'hidden',
											  'label'=>false,
								  			  'value'=>$anexoData['Anexos']['id_anexo']
										)
									)
						  );
// 						  
						  e($anexoData['Cuentas']['cuenta']);
						  e($form->input("Anexos.$id_anexo.id_cuenta",
										array('type'=>'hidden',
											  'label'=>false,
// 											  'disabled'=>false,
								  			  'value'=>$anexoData['Anexos']['id_cuenta']
										)
									)
						  );
					  ?>
				  <td style="background:none;" />
					  <?php
// 						  e($this->Form->create());

						  e($form->input("Anexos.$id_anexo.importe",
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>false,
											  'placeholder'=>'Importe Real',
								  			  'value'=>$anexoData['Anexos']['importe']
										)
									)
						  );
// 						  e($form->end());
					  ?>

				  <td style="background:none;" />
					  <?php
// 						  e($this->Form->create());
						  e($form->input("Anexos.$id_anexo.importe_prep",
										array('type'=>'text',
											  'label'=>false,
											  'placeholder'=>'Importe Presupuestado',
											  'disabled'=>false,
								  			  'value'=>$anexoData['Anexos']['importe_prep']
										)
									)
						  );
					  ?>
					  <td style="background:none;" />
						<?php 
						  e($anexoData['Conceptos']['concepto']);
						  e($form->input("Anexos.$id_anexo.id_concepto",
										array('type'=>'hidden',
											  'label'=>false,
// 											  'disabled'=>false,
								  			  'value'=>$anexoData['Anexos']['id_dir_anexo']
										)
									)
						  );
						  e($form->input("Anexos.$id_anexo.id_dir_anexo",
										array('type'=>'hidden',
											  'label'=>false,
								  			  'value'=>$anexoData['Anexos']['id_dir_anexo']
										)
									)
						  );
						  e($form->input("Anexos.$id_anexo.week",
										array('type'=>'hidden',
											  'label'=>false,
								  			  'value'=>$anexoData['Anexos']['week']
										)
									)
						  );

						  $totalImportePresupuesto += $anexoData['Anexos']['importe_prep'];
						  $totalImporteReal += $anexoData['Anexos']['importe'];
						?>
		  <?php
			}
		  ?>
<!-- 					<tr /> -->
<!-- 					  <td colspan="2"/>Totales -->
<!-- 					  <td /><?php //e($totalImporteReal);?> -->
<!-- 					  <td /><?php //e($totalImportePresupuesto);?> -->
<!-- 					  <td />&nbsp; -->
	  </table>