<?php //addRow ?>
<?php //pr($id_realms_class);?>

	<table id="menu_info_small">
    	<tr />
		  <td width="10%" /> Cuenta Nueva
		  <td width="40%" style="text-align:right;" />
			<?php
					e($form->input("Row.$id_realms_class.account",
							array('type'=>'text',
								  'label'=>false,
								  'placeholder'=>'  Cuenta',
// 								  'size'=>'10',
								  'value'=>null
							)
							)
					);
			?>
		  <td width="40%" />
			<?php
					e($form->input("Row.$id_realms_class.description",
							array('type'=>'text',
								  'label'=>false,
								  'placeholder'=>'  Descripcion/Concepto',
// 								  'size'=>'10',
								  'value'=>null
							)
							)
					);
			?>

	</table>