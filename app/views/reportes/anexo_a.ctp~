<?php // Reportes/anexo_a.ctp?>
<?php
  /** @update => from database
	  @package => From Flujo de Marzo.xls
  **/
?>
<?php
$anx = $estimate['accountsA'];
// 		e($this->Form->create());
?>
      <table>
	    <tr />
		<td width="320" style="text-align:center;" />
			<table>
			  <tr />
			    <td height="140" style="text-align:center;font-size:180%;" />
				  <div id="ingresos">
				  <?php
					  e('$'.number_format(money_format('%i',$estimate['Ingresos']['FlujoIngresos']['total_ingresos']), 2, '.', ','));
				  ?>
				  </div>
			  <tr />
			    <td style="text-align:center;font-size:120%;" />Pago a Proveedores
			  <tr />
			    <td style="text-align:center;" />test
			</table>
		<td width="320" style="text-align:center;" />
			<table>
			  <tr />
			    <td height="140" style="text-align:center;font-size:180%;" />$3,098.271
			  <tr />
			    <td style="text-align:center;font-size:120%;" />Total de Egresos
			  <tr />
			    <td style="text-align:center;" />test
			</table>
		<td width="320" style="text-align:center;" />
			<table>
			  <tr />
			    <td height="140" style="text-align:center;font-size:180%;" />$1,090.585
			  <tr />
			    <td style="text-align:center;font-size:120%;" />Saldo Disponible
			  <tr />
			    <td style="text-align:center;" />test
			</table>
		<td width="320" style="text-align:center;" />
			<table>
			  <tr />
			    <td height="140" style="text-align:center;font-size:180%;" />$4,188.856
			  <tr />
			    <td style="text-align:center;font-size:120%;" />Efectivo Disponible
			  <tr />
			    <td style="text-align:center;" />test
			</table>
	  </table>
<?php
/** @Description => If empty record in db show an input arrow
 *
 */
?>

	  <table id="menu_info_small">
		<tr />
		  <?php
		  if(!empty($anx)){
		  ?>
				  <td />
					  <?php
						
						  e($form->input('Anxa.nombre',
										array('type'=>'select',
											  'label'=>false,
											  'disabled'=>$status,
											  'options'=>$anx
// 											  'placeholder'=>'Concreto',
// 								  			  'value'=>$estimate['Ingresos']['FlujoIngresos']['concreto']
										)
									)
						  );
					  ?>
				  <td />
					<div id="divConceptsA" >
					  <?php
						  e($form->input('Anxa.concepto',
										array('type'=>'select',
											  'label'=>false,
											  'disabled'=>true,
											  'options'=>array('Seleccionar un Concepto')
// 											  'options'=>$estimate['conceptsA']
// 											  'placeholder'=>'Concreto',
// 								  			  'value'=>$estimate['Ingresos']['FlujoIngresos']['concreto']
										)
									)
						  );
					  ?>
					</div>
				  <td style="background:none;" />
					  <?php
						  e($form->input('AnexoA.importe_prep',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'placeholder'=>'Cantidad',
								  			  'value'=>$estimate['Ingresos']['FlujoIngresos']['concreto']
										)
									)
						  );
// 						  e($form->end());
					  ?>
		  <?php }else{ ?>
			
				  <td />
					  <?php
						
						  e($form->input('NameanxA.nombre',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'options'=>$anx,
											  'placeholder'=>'  Nombre de la Cuenta'
// 								  			  'value'=>$estimate['Ingresos']['FlujoIngresos']['concreto']
										)
									)
						  );
						  

					  ?>
				  <td />
					  <?php
						  e($form->input('DirConceptAnexoA.concepto',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'options'=>$anx,
											  'placeholder'=>'  Nombre del Concepto'
// 								  			  'value'=>$estimate['Ingresos']['FlujoIngresos']['concreto']
										)
									)
						  );
					  ?>
				  <td style="background:none;" />
					  <?php
						  e($form->input('AnexoA.importe_prep',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'placeholder'=>'  Cantidad',
								  			  'value'=>$estimate['Ingresos']['FlujoIngresos']['concreto']
										)
									)
						  );
// 						  e($form->end());
					  ?>
		  <?php } //end else?>

	  </table>
	  
	  <table>
		<tr />
		  <th />Nombre
		  <th />Importe Real
		  <th />Importe Presupuesto
		  <th />Concepto
	  </table>
	  
	  
      <table id="menu_info_small" >
	    <tr />
		<td width="520" style="text-align:center;" />
<!-- 		    this is going to update -->
<!-- 		    <div id="divArea"> -->
			
			<table> <!--Inside of the main table and align to right-->
			  <tr />
			    <td height="140" style="text-align:center;font-size:180%;font-weight:bold;" />
				  <div id="ingresosForm">
				  <?php
					  e('$'.number_format(money_format('%i',$estimate['Ingresos']['FlujoIngresos']['total_ingresos']), 2, '.', ','));
				  ?>
				  </div>
			  <tr />
			    <td style="text-align:center;font-size:120%;font-weight:bold;" />Total para la Semana del xx-xx
			  <tr />
			    <td style="text-align:center;" />...
				 
			</table>

		<td style="text-align:left;" />

			<table id="menu_info_small" >
				<tr />
				  <td />Cobranza Concretos Apasco , S.A
				  <td style="background:none;" />&nbsp;
				  <td style="background:none;" />
					  <?php
// 						  e($this->Form->create());

						  e($form->input('Ingresos.concreto',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'placeholder'=>'Concreto',
								  			  'value'=>$estimate['Ingresos']['FlujoIngresos']['concreto']
										)
									)
						  );
// 						  e($form->end());
					  ?>

				<tr />
				  <td />Cobranza Cementos Apasco , S.A
				  <td style="background:none;" />&nbsp;
				  <td style="background:none;" />
					  <?php
// 						  e($this->Form->create());

						  e($form->input('Ingresos.cemento',
										array('type'=>'text',
											  'label'=>false,
											  'placeholder'=>'Cemento',
											  'disabled'=>$status,
								  			  'value'=>$estimate['Ingresos']['FlujoIngresos']['cemento']
										)
									)
						  );
// 						  e($form->end());
					  ?>

				<tr />
				  <td />Cobranza Otros Clientes
				  <td style="background:none;"/>&nbsp;
				  <td style="background:none;" />
					  <?php
// 						  e($this->Form->create());

						  e($form->input('Ingresos.otros',
										array('type'=>'text',
											  'label'=>false,
											  'placeholder'=>'Otros',
											  'disabled'=>$status,
								  			  'value'=>$estimate['Ingresos']['FlujoIngresos']['otros']
										)
									)
						  );
// 						  e($form->end());
					  ?>

				<tr />
				  <td />Otros Ingresos / Traspasos
				  <td style="background:none;"/>&nbsp;
				  <td style="background:none;" />
					  <?php
// 						  e($this->Form->create());
						  e($form->input('Ingresos.traspaso',
										array('type'=>'text',
											  'label'=>false,
											  'placeholder'=>'Traspasos',
											  'disabled'=>$status,
								  			  'value'=>$estimate['Ingresos']['FlujoIngresos']['traspaso']
										)
									)
						  );
// 						  e($form->end());
					  ?>

			</table>

	  </table> <!--End of idMenu-Info-->

		<div style="text-align:right;">
			<?php
			  	e($form->button('Guardar',
								  array('class'=>'button_blue')
						)
				);
				e($form->end());
			?>
		</div><br />