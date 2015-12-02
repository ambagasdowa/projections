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
<?php $idx = 0;$total = null; ?>
<?php 
// 		pr($estimate);
// $RealmsClass = $_SESSION['RealmsClass'];
?>

<?php
  foreach($RealmsClass as $idRealmsAccounts => $RealmsAndAccountsData){
?>
      <table id="menu_info_small" >
	    <tr />
		<td width="520" style="text-align:center;" />

			<table> <!--Inside of the main table and align to right-->
			  <tr />
			    <td height="140" style="text-align:center;font-size:180%;font-weight:bold;" />

			    <div id="<?php e($RealmsAndAccountsData['RealmsClass']['div']);?>">
				  <?php
						if(isset($estimate['totals'][$RealmsAndAccountsData['RealmsClass']['realms_class']])){
						  e('$'.number_format(money_format('%i',$estimate['totals'][$RealmsAndAccountsData['RealmsClass']['realms_class']]), 2, '.', ','));
						}else{
						  e('$'.number_format(money_format('%i',0), 2, '.', ','));
						}
				  ?>
				  </div>
			  <tr />
			    <td style="text-align:center;font-size:120%;font-weight:bold;" />
				  <?php 
					e($RealmsAndAccountsData['RealmsClass']['realms_class']);
				  ?>
			  <tr />
			    <td style="text-align:center;" />
					<?php 
// 						if(isset($estimate['totals'][$RealmsAndAccountsData['RealmsClass']['realms_class']])){
// 						  e('$'.number_format(money_format('%i',$estimate['totals'][$RealmsAndAccountsData['RealmsClass']['realms_class']]), 2, '.', ','));
// 						}
					?>
				 
			</table>

		<td style="text-align:left;" />
			<table id="menu_info_small" >
				<tr />
				  <td colspan="3" style="font-variant:small-caps;font-weight:bold;text-align:center;"/><?php e($RealmsAndAccountsData['RealmsClass']['realms']);?>
				<?php
				  foreach($RealmsAndAccountsData['AccountsViews'] as $id_accounts => $Accounts){
				?>
				<tr />
				  <td /><?php e($Accounts['account']);?>
				  <td style="background:none;" />&nbsp;
				  <td style="background:none;" />
					  <?php
						  e($this->Form->create());
						  if(isset($estimate['flujo'][$id_accounts])){
							$presupuesto = $estimate['flujo'][$id_accounts]['Flujo']['presupuesto'];
							if(!isset($total[$RealmsAndAccountsData['RealmsClass']['realms_class']])){
							  $total[$RealmsAndAccountsData['RealmsClass']['realms_class']] = null;
							}
							$total[$RealmsAndAccountsData['RealmsClass']['realms_class']] += $presupuesto;
						  }else{
							$presupuesto = null;
						  }
						  $id = $idx++; // Set array index for save the data
						  e($form->input("Accounts.".$id.".presupuesto",
										array('type'=>'text',
											  'class'=>'validate',
											  'label'=>false,
											  'disabled'=>false,
											  'placeholder'=>$Accounts['account'],
											  'title'=>$Accounts['description'],
											  'alt'=>$Accounts['description'],
								  			  'value'=>$presupuesto
// 											  'value'=>$Flujo
										)
									)
						  );
						  
						  e($form->input("Accounts.".$id.".id_accounts",
										array('type'=>'hidden',
											  'label'=>false,
											  'disabled'=>false,
											  'placeholder'=>$Accounts['account'],
								  			  'value'=>$id_accounts
// 											  'value'=>$Flujo
										)
									)
						  );
						  if(isset($estimate['flujo'][$id_accounts]['Flujo']['month'])){
						  e($form->input("Accounts.".$id.".month",
										array('type'=>'hidden',
											  'label'=>false,
											  'disabled'=>false,
											  'placeholder'=>$Accounts['account'],
								  			  'value'=>$estimate['flujo'][$id_accounts]['Flujo']['month']
// 											  'value'=>$Flujo
										)
									)
						  );
						  }
						  if(isset($estimate['flujo'][$id_accounts]['Flujo']['id_flujo'])){
						  e($form->input("Accounts.".$id.".id_flujo",
										array('type'=>'hidden',
											  'label'=>false,
											  'disabled'=>false,
											  'placeholder'=>$Accounts['account'],
								  			  'value'=>$estimate['flujo'][$id_accounts]['Flujo']['id_flujo']
// 											  'value'=>$Flujo
										)
									)
						  );
						  }
					  ?>
				<?php
				  }
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
<?php
  }
?>
