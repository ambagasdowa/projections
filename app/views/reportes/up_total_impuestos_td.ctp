		  <?php
			  e($this->Form->create());
				  e($form->input('Gastos.impuestos',
							array('type'=>'text',
								  'label'=>false,
								  'disabled'=>true,
								  'placeholder'=>'Impuestos',
					  			  'value'=>'$'.number_format(money_format('%i',$estimate['Impuestos']['FlujoImpuestos']['total_impuestos']), 2, '.', ',')
							)
						)
			  );
			  e($form->end());
		  ?>