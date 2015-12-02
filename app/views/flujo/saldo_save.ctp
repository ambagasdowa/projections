<?php //Saldo ?>
	<table id="menu_info_small">
    	<tr />
		  <td width="10%" /> Saldo Inicial
		  <td width="40%" style="text-align:right;" />
			<?php
					e($form->input("Saldo.real",
							array('type'=>'text',
								  'label'=>false,
// 								  'size'=>'10',
								  'value'=>null
							)
							)
					);
			?>
		  <td width="40%" />
			<?php
					e($form->input("Saldo.presupuesto",
							array('type'=>'text',
								  'label'=>false,
// 								  'size'=>'10',
								  'value'=>null
							)
							)
					);
			?>
	      <td />
			<?php
			  	e($form->button('Guardar',
								  array('class'=>'button_blue')
						)
				);
				e($form->end());
			?>

	</table>