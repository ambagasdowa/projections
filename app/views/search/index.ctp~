<?php
// C:\Program Files\Internet Explorer\iexplore.exe http://www.google.com

// start iexplore http://google.com
// 
// O bien:
// 
// cmd /c start iexplore http://google.com

?>
<?php ?>
    <table id="menu_info">
    	<tr />

		  <td id="label" width="5%" />
			<?php
			  e($form->label('Reportes.data',
				 'Seleccionar Semana',
				 array('accessKey'=>'B')
				)
			  );
			?>
	      <td />
	      <?php
			e($this->Form->text('Flujo.week',
				    array('type' => 'week',
					  'label'=>false,
					  'class'=>'in_cal',
					  'value'=>date('Y-m-d'),
					  'dateFormat' => 'YMD',
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
			  e($ajax->observeField('FlujoWeek',
							array("url"=>array("controller"=>"Search",
								  "action"=>"search",
										  ),
								  "update" => "divSearch",
							)
								  )
			  );
		 ?>
		<td width="10%"/>
		
		<td width="10%" />
		<?php
				if($_SESSION['Auth']['User']['level'] == '0'){ // Means Super User
		?>
		  <?php
		      echo $this->Html->link(
			   $this->Html->image("icons/pen.png",
			                array('alt' => "Configurar Cuentas",
								  'title' => 'Configurar Cuentas',
								  'width' => '22',
								  'height' => '22'
					)
			   ),
					array(
					  'controller'=>'config',
					  'action'=>'viewConfig'
// 					  'Reporte de Flujo',
// 					  "ReporteFlujo-".date('Y-m-d'),
// 					  "export_flujo"
					) ,
					array('escape' => false),
					null
			);
		  ?>
		<?php
				}else{
				e('&nbsp;');
				} // En options for administrators
		?>
		 <td width="10%" />
		<?php
				if($_SESSION['Auth']['User']['level'] == '0'){ // Means Super User
		?>
		  <?php
		      echo $this->Html->link(
			   $this->Html->image("icons/add.png",
			                array('alt' => "Ingresar Registros",
								  'title' => 'Ingresar Registros',
								  'width' => '22',
								  'height' => '22'
					)
			   ),
					array(
					  'controller'=>'Reportes',
					  'action'=>'index'
// 					  'Reporte de Flujo',
// 					  "ReporteFlujo-".date('Y-m-d'),
// 					  "export_flujo"
					) ,
					array('escape' => false),
					null
			);
		  ?>
<?php
				}else{
				e('&nbsp;');
				} // En options for administrators
?>
		<td width="10%" />
		  <?php
		      echo $this->Html->link(
			   $this->Html->image("icons/home3d_alpha.png",
			                array('alt' => "Ir al Inicio",
								  'title' => 'Ir al inicio',
								  'width' => '22',
								  'height' => '22'
					)
			   ),
					array(
					  'controller'=>'search/#openModal'
// 					  'action'=>'index'
// 					  'Reporte de Flujo',
// 					  "ReporteFlujo-".date('Y-m-d'),
// 					  "export_flujo"
					) ,
					array('escape' => false),
					null
			);
		  ?>
		<td width="2%" />&nbsp;
	</table>
	
	<div id="divSearch"></div>