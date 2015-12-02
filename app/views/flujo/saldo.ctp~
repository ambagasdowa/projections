<?php //Saldo ?>
	<table id="menu_info_small">
    	<tr />
		  <td width="10%" /> Nuevo Saldo
		  <td width="40%" style="text-align:right;" />
			<?php
					e($form->input("Saldo.real",
							array('type'=>'text',
								  'label'=>false,
								  'placeholder'=>'  Real',
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
								  'placeholder'=>'  Presupuesto',
// 								  'size'=>'10',
								  'value'=>null
							)
							)
					);
			?>
	      <td />
			<?php

				e($this->Form->create());
			  	e($form->button('Guardar',
								  array(
										'class'=>'button_blue',
								  		"update" => "hide_div",
										"loading" => "Element.hide('hide');Element.show('loading');",
										"complete" => "Element.hide('loading');Effect.SlideUp('hide_div',{duration: 3.0});"
								  )
						)
				);
				e($form->end());
			?>

	</table>
