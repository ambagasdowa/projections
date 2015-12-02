<?php // Reportes/estimado.ctp?>
<?php
  /** @update => from database
	  @package => From Flujo de Marzo.xls
  **/
?>
<!-- <div id="divViewTotals"> -->
<?php
			App::Import('Controller','Reportes');
			echo $this->element('view_totals');
?>
<!-- </div> -->
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
			    <td style="text-align:center;font-size:120%;font-weight:bold;" />Total de Ingresos
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
						  e($this->Form->create());

						  e($form->input('Ingresos.concreto',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>false,
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
											  'disabled'=>false,
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
// 											  'disabled'=>$status,
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
// 						  //e($this->Form->create());
						  e($form->input('Ingresos.traspaso',
										array('type'=>'text',
											  'label'=>false,
											  'placeholder'=>'Traspasos',
// 											  'disabled'=>$status,
								  			  'value'=>$estimate['Ingresos']['FlujoIngresos']['traspaso']
										)
									)
						  );
// 						  //e($form->end());
					  ?>

			</table>

	  </table> <!--End of idMenu-Info-->
		<div style="text-align:right;">
			<?php
			  	e($form->button('Guardar',
								  array('class'=>'button_blue')
						)
				);
// 				e($form->end());
			?>
		</div><br />

<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  EGRESOS %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
      <table id="menu_info_small" >
	    <tr />
		<td width="520" style="text-align:center;" />
<!-- 		    this is going to update -->
<!-- 		    <div id="divArea"> -->
			
			<table> <!--Inside of the main table and align to right-->
			  <tr />
			    <td height="140" style="text-align:center;font-size:180%;font-weight:bold;" />
				  <div id="gastosNormalesOperacion">
				  <?php
					  e('$'.number_format(money_format('%i',$estimate['Egresos']['FlujoEgresos']['total_egresos']), 2, '.', ','));
				  ?>
				  </div>
			  <tr />
			    <td style="text-align:center;font-size:120%;font-weight:bold;" />Gastos Normales de Operaci&oacute;n
			  <tr />
			    <td style="text-align:center;" />...
				 
			</table>

		<td style="text-align:left;" />
			<table id="menu_info_small" >
				<tr />
				  <td />N&oacute;mina Catorcenal
				  <td style="background:none;" />&nbsp;
				  <td style="background:none;" />
					  <?php
// 						  //e($this->Form->create());

						  e($form->input('Egresos.catorcenal',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'placeholder'=>'Nomina Catorcenal',
								  			  'value'=>$estimate['Egresos']['FlujoEgresos']['catorcenal']
										)
									)
						  );
// 						  //e($form->end());
					  ?>

				<tr />
				  <td />N&oacute;mina Confidencial
				  <td style="background:none;" />&nbsp;
				  <td style="background:none;" />
					  <?php
// 						  //e($this->Form->create());

						  e($form->input('Egresos.confidencial',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'placeholder'=>'Nomina confidencial',
								  			  'value'=>$estimate['Egresos']['FlujoEgresos']['confidencial']
										)
									)
						  );
// 						  //e($form->end());
					  ?>

				<tr />
				  <td />N&oacute;mina Administrativa
				  <td style="background:none;"/>&nbsp;
				  <td style="background:none;" />
					  <?php
// 						  //e($this->Form->create());

						  e($form->input('Egresos.administrativa',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'placeholder'=>'Nomina Administrativa',
								  			  'value'=>$estimate['Egresos']['FlujoEgresos']['administrativa']
										)
									)
						  );
// 						  //e($form->end());
// 					  ?>

				<tr />
				  <td />Tel&eacute;fonos de M&eacute;xico
				  <td style="background:none;"/>&nbsp;
				  <td style="background:none;" />
					  <?php
// 						  //e($this->Form->create());
						  e($form->input('Egresos.telmex',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'placeholder'=>'Telmex',
								  			  'value'=>$estimate['Egresos']['FlujoEgresos']['telmex']
										)
									)
						  );
// 						  //e($form->end());
					  ?>

				<tr />
				  <td />Comision Federal de Electricidad
				  <td style="background:none;"/>&nbsp;
				  <td style="background:none;" />
					  <?php
// 						  //e($this->Form->create());
						  e($form->input('Egresos.cfe',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'placeholder'=>'CFE',
								  			  'value'=>$estimate['Egresos']['FlujoEgresos']['cfe']
										)
									)
						  );
// 						  //e($form->end());
					  ?>
				<tr />
				  <td />Pemex (Diesel/Flete Diesel)
				  <td style="background:none;"/>&nbsp;
				  <td style="background:none;" />
					  <?php
// 						  //e($this->Form->create());
						  e($form->input('Egresos.pemex',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'placeholder'=>'pemex',
								  			  'value'=>$estimate['Egresos']['FlujoEgresos']['pemex']
										)
									)
						  );
// 						  //e($form->end());
					  ?>
					  
				<tr />
				  <td />Capufe y Fideicomisos de Peajes
				  <td style="background:none;"/>&nbsp;
				  <td style="background:none;" />
					  <?php
// 						  //e($this->Form->create());
						  e($form->input('Egresos.peajes',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'placeholder'=>'Capufe - Fideicomisos y Peajes',
								  			  'value'=>$estimate['Egresos']['FlujoEgresos']['peajes']
										)
									)
						  );
// 						  //e($form->end());
					  ?>
					  
				<tr />
				  <td />Enlonadas
				  <td style="background:none;"/>&nbsp;
				  <td style="background:none;" />
					  <?php
// 						  //e($this->Form->create());
						  e($form->input('Egresos.enlonadas',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'placeholder'=>'Enlonadas',
								  			  'value'=>$estimate['Egresos']['FlujoEgresos']['enlonadas']
										)
									)
						  );
// 						  //e($form->end());
					  ?>
					  
				<tr />
				  <td />Seguros
				  <td style="background:none;"/>&nbsp;
				  <td style="background:none;" />
					  <?php
// 						  //e($this->Form->create());
						  e($form->input('Egresos.seguros',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'placeholder'=>'Seguros',
								  			  'value'=>$estimate['Egresos']['FlujoEgresos']['seguros']
										)
									)
						  );
// 						  //e($form->end());
					  ?>
					  
				<tr />
				  <td />Tecnolog&iacute;a y Manufactura (Vigilancia)
				  <td style="background:none;"/>&nbsp;
				  <td style="background:none;" />
					  <?php
// 						  //e($this->Form->create());
						  e($form->input('Egresos.manufactura',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'placeholder'=>'Manufactura',
								  			  'value'=>$estimate['Egresos']['FlujoEgresos']['manufactura']
										)
									)
						  );
// 						  //e($form->end());
					  ?>
					  
				<tr />
				  <td />Manpower S.A de C.V.
				  <td style="background:none;"/>&nbsp;
				  <td style="background:none;" />
					  <?php
// 						  //e($this->Form->create());
						  e($form->input('Egresos.manpower',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'placeholder'=>'Manpower',
								  			  'value'=>$estimate['Egresos']['FlujoEgresos']['manpower']
										)
									)
						  );
// 						  //e($form->end());
					  ?>
			</table>
	  </table> <!--End of other-->
		<div style="text-align:right;">
			<?php
			  	e($form->button('Guardar',
								  array('class'=>'button_blue')
						)
				);
// 				//e($form->end());
			?>
		</div><br />
	  
      <table id="menu_info_small" >

	    <tr />
		<td width="520" style="text-align:center;" />
<!-- 		    this is going to update -->
<!-- 		    <div id="divArea"> -->
			
			<table> <!--Inside of the main table and align to right-->
			  <tr />
			    <td height="140" style="text-align:center;font-size:180%;font-weight:bold;" />

				  <div id="total_impuestos">
				  <?php
					  e('$'.number_format(money_format('%i',$estimate['Impuestos']['FlujoImpuestos']['total_impuestos']), 2, '.', ','));
				  ?>
				  </div>

			  <tr />
			    <td style="text-align:center;font-size:120%;" />Impuestos
			  <tr />
			    <td style="text-align:center;" />test
				 
			</table>

		<td style="text-align:left;" />
			<table id="menu_info_small" >
				<tr />
				  <td />IMSS
				  <td style="background:none;" />&nbsp;
				  <td style="background:none;" />
					  <?php
						  //e($this->Form->create());

						  e($form->input('Impuestos.imss',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'placeholder'=>'IMSS',
								  			  'value'=>$estimate['Impuestos']['FlujoImpuestos']['imss']
										)
									)
						  );
						  //e($form->end());
					  ?>

				<tr />
				  <td />ISS
				  <td style="background:none;" />&nbsp;
				  <td style="background:none;" />
					  <?php
						  //e($this->Form->create());

						  e($form->input('Impuestos.iss',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'placeholder'=>'Iss',
								  			  'value'=>$estimate['Impuestos']['FlujoImpuestos']['iss']
										)
									)
						  );
						  //e($form->end());
					  ?>

				<tr />
				  <td />2.5% Estatal
				  <td style="background:none;"/>&nbsp;
				  <td style="background:none;" />
					  <?php
						  //e($this->Form->create());

						  e($form->input('Impuestos.estatal',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'placeholder'=>'Impuesto Estatal',
								  			  'value'=>$estimate['Impuestos']['FlujoImpuestos']['estatal']
										)
									)
						  );
						  //e($form->end());
					  ?>

				<tr />
				  <td />ISTP
				  <td style="background:none;"/>&nbsp;
				  <td style="background:none;" />
					  <?php
						  //e($this->Form->create());
						  e($form->input('Impuestos.istp',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'placeholder'=>'ISTP',
								  			  'value'=>$estimate['Impuestos']['FlujoImpuestos']['istp']
										)
									)
						  );
						  //e($form->end());
					  ?>
					  
				<tr />
				  <td />ISP/IETU
				  <td style="background:none;"/>&nbsp;
				  <td style="background:none;" />
					  <?php
						  //e($this->Form->create());
						  e($form->input('Impuestos.ietu',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'placeholder'=>'ISP/IETU',
								  			  'value'=>$estimate['Impuestos']['FlujoImpuestos']['ietu']
										)
									)
						  );
						  //e($form->end());
					  ?>
					  
				<tr />
				  <td />Impuestos Otros
				  <td style="background:none;"/>&nbsp;
				  <td style="background:none;" />
					  <?php
						  //e($this->Form->create());
						  e($form->input('Impuestos.otros',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'placeholder'=>'Impuestos Otros',
								  			  'value'=>$estimate['Impuestos']['FlujoImpuestos']['otros']
										)
									)
						  );
						  //e($form->end());
					  ?>
					  
				<tr />
				  <td />IVA
				  <td style="background:none;"/>&nbsp;
				  <td style="background:none;" />
					  <?php
						  //e($this->Form->create());
						  e($form->input('Impuestos.iva',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'placeholder'=>'IVA',
								  			  'value'=>$estimate['Impuestos']['FlujoImpuestos']['iva'],
										)
									)
						  );
						  //e($form->end());
					  ?>
					  
				<tr />
				  <td />Provisiones de Impuestos
				  <td style="background:none;"/>&nbsp;
				  <td style="background:none;" />
					  <?php
						  //e($this->Form->create());
						  e($form->input('Impuestos.provisiones',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'placeholder'=>'Provisiones de Impuestos',
								  			  'value'=>$estimate['Impuestos']['FlujoImpuestos']['provisiones']
										)
									)
						  );
						  //e($form->end());
					  ?>

			</table>
	  </table> <!--End of idMenu-Info-->
	  
		<div style="text-align:right;">
			<?php
			  	e($form->button('Guardar',
								  array('class'=>'button_blue')
						)
				);
				//e($form->end());
			?>
		</div><br />
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  EGRESOS %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->


	  
      <table id="menu_info_small" >

	    <tr />
		<td width="520" style="text-align:center;" />
<!-- 		    this is going to update -->
<!-- 		    <div id="divArea"> -->
			
			<table> <!--Inside of the main table and align to right-->
			  <tr />
			    <td height="140" style="text-align:center;font-size:180%;font-weight:bold;" />
				  <div id="divTotalEgresosId">
				  <?php
					e('$'.number_format(money_format('%i',$estimate['totalEgresos']), 2, '.', ','));
				  ?>
				  </div>
			  <tr />
			    <td style="text-align:center;font-size:120%;" />Total de Egresos
			  <tr />
			    <td style="text-align:center;" />test
				 
			</table>

		<td style="text-align:left;" />
			<table id="menu_info_small" >
				<tr />
				  <td />Gastos Normales de Operaci&oacute;n
				  <td style="background:none;" />&nbsp;
				  <td style="background:none;" />
					<div id="gastosNormalesOperacionTd">
					  <?php
						  //e($this->Form->create());

						  e($form->input('Gastos.operacion',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$st_egresos,
											  'placeholder'=>'Gastos Normales de Operacion',
								  			  'value'=>'$'.number_format(money_format('%i',$estimate['Egresos']['FlujoEgresos']['total_egresos']), 2, '.', ',')
										)
									)
						  );
						  //e($form->end());
					  ?>
					</div>
				<tr />
				  <td />Reembolso de fondo fijo de caja
				  <td style="background:none;" />&nbsp;
				  <td style="background:none;" />
					  <?php
						  //e($this->Form->create());
// 						  if(empty($estimate['Egresos']['FlujoEgresos']['reembolso'])){
// 							$reembolso = null;
// 						  }else{
// 							$reembolso = '$'.number_format(money_format('%i',$estimate['Egresos']['FlujoEgresos']['reembolso']), 2, '.', ',');
// 						  }
						  e($form->input('Egresos.reembolso',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$status,
											  'placeholder'=>'Reembolso de fondo fijo de caja',
								  			  'value'=>$estimate['Egresos']['FlujoEgresos']['reembolso']
										)
									)
						  );
						  //e($form->end());
					  ?>

				<tr />
				  <td />Impuestos
				  <td style="background:none;"/>&nbsp;
				  <td style="background:none;" />
					<div id="total_impuestos_td">
					  <?php
						  //e($this->Form->create());

						  e($form->input('Gastos.impuestos',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>$st_egresos,
											  'placeholder'=>'Impuestos',
								  			  'value'=>'$'.number_format(money_format('%i',$estimate['Impuestos']['FlujoImpuestos']['total_impuestos']), 2, '.', ',')
										)
									)
						  );
						  //e($form->end());
					  ?>
					</div>
				<tr />
				  <td />Pago a Provedores (Anexo A)
				  <td style="background:none;"/>&nbsp;
				  <td style="background:none;" />
					  <?php
						  //e($this->Form->create());
						  e($form->input('Gastos.provedores',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>true,
											  'placeholder'=>'Pago a Provedores',
											  'value'=>'$'.number_format(money_format('%i',$estimate['DirAnexos']['Anexo A']['total_importe_prep']), 2, '.', ',')

										)
									)
						  );
						  //e($form->end());
					  ?>

				<tr />
				  <td />Otros Gastos (Anexo B)
				  <td style="background:none;"/>&nbsp;
				  <td style="background:none;" />
					  <?php
						  //e($this->Form->create());
						  e($form->input('Gastos.otros',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>true,
											  'placeholder'=>'Otros Gastos',
											  'value'=>'$'.number_format(money_format('%i',$estimate['DirAnexos']['Anexo B']['total_importe_prep']), 2, '.', ',')
										)
									)
						  );
						  //e($form->end());
					  ?>
					  
				<tr />
				  <td />Inversiones de Activo Fijo (Anexo C)
				  <td style="background:none;"/>&nbsp;
				  <td style="background:none;" />
					  <?php
						  //e($this->Form->create());
						  e($form->input('Gastos.inversionesaf',
										array('type'=>'text',
											  'label'=>false,
											  'disabled'=>true,
											  'placeholder'=>'Inversiones a Activo Fijo',
											  'value'=>'$'.number_format(money_format('%i',$estimate['DirAnexos']['Anexo C']['total_importe_prep']), 2, '.', ',')
										)
									)
						  );
						  //e($form->end());
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