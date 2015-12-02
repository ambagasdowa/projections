<?php //concept_a.ctp ?>
<?php if(isset($concepts)){
	  $getConceptAnexo = $concepts;
} ?>
<?php
  if(!empty($getConceptAnexo)){
?>
					  <?php
						  e($form->input('Anexo.id_concepto',
										array('type'=>'select',
											  'label'=>false,
											  'disabled'=>false,
											  'empty' => ' • Seleccionar Concepto',
											  'options'=>$getConceptAnexo
// 											  'placeholder'=>'Concreto',
// 								  			  'value'=>$estimate['Ingresos']['FlujoIngresos']['concreto']
										)
									)
						  );
					  ?>
<?php
  }else{
?>

					  <?php
						  e($form->input('Anexo.id_concepto',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>false
// 											  'options'=>$getConceptAnexoA
// 											  'placeholder'=>'Concreto',
// 								  			  'value'=>$estimate['Ingresos']['FlujoIngresos']['concreto']
										)
									)
						  );
					  ?>

<?php
  }
?>
