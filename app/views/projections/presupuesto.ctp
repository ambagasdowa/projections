<?php
//   presupuesto
// pr($view);Date
?>

<table id="menu_info_small">
  <tr />
	  <td />Seleccion de Mes
	  <td widht="40%"/>
	  <?php
			e($this->Form->text('Date.month',
				    array('type' => 'month',
					  'label'=>false,
					  'class'=>'in_cal',
					  'value'=>date('Y-m-d'),
					  'dateFormat' => 'DMY',
					  'min' => '2010-08-14',
					  'max' => '2036-12-31',
					  'separator'=>'/',
// 					  'onclick'=>"confirmInput()",
					  "onKeyPress"=>"return soloNumeros(event)",
// 					  'value'=>null,
					  'placeholder'=>'Buscar registro => Ingresa Fecha en formato (yy-mm-dd) (alt+shift+b)'
					 )
				     )
			);
			  e($ajax->observeField('DateMonth',
							array("url"=>array("controller"=>"Projections",
								  "action"=>"ShowPresupuesto",
										),
								  "update" => "divPresupuesto",
							)
					)
			  );
	  ?>
	  <td width="10%"/>&nbsp;
</table>

<div id="divPresupuesto"><?php include('show_presupuesto.ctp');?></div>