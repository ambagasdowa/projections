					  <?php
// 						  e($this->Form->create());
// 
// 						  e($form->input('Gastos.operacion',
// 										array('type'=>'text',
// 											  'label'=>false,
// 											  'disabled'=>true,
// 											  'placeholder'=>'Gastos Normales de Operacion',
// 								  			  'value'=>'$'.number_format(money_format('%i',e('$'.number_format(money_format('%i',$estimate['totals']['Ingresos']), 2, '.', ','));), 2, '.', ',')
// 										)
// 									)
// 						  );
// 						  e($form->end());
e('$'.number_format(money_format('%i',$estimate['totals']['Gastos Normales de Operacion']), 2, '.', ','));
					  ?>