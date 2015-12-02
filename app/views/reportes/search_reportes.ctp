<?php //search_reportes.ctp?> 
<?php
    $pdf = $this->Html->image("icons/pdf.png",
			    array("alt" => 'Export to pdf',
					   'width'=>15,
					   'valign'=>'center',
					   'url' => array('controller' => 'Reportes',
							  'action' => 'CreatePdf',
							   1
						    )
				 )
			     );
?>

<!--     Servicios Telefonicos Section -->
<div id="warning"><span>Servicios Telefonicos </span></div>
<?php
    if(empty($daily_report)){
	e('<div id="warning"><span>No se Encontraron Registros Telefonicos</span></div>');
    }else{
?>
<div id="reports">
<table id="menu_info">
    <tr />
      <th />ID
      <th />ID-Movil
      <th />ID-Economico
      <th />Colonia
      <th />Calle
      <th />N&uacute;mero
      <th />Telefono
      <th />Hora
    <?php $idx=1;?>
    <?php foreach($daily_report as $key => $value){?>
    <tr />
      <td /><?php e($idx++);?>
      <td /><?php e($daily_report[$key]['ServiciosTelefonicos']['id_movil']);?>
      <td /><?php e($daily_report[$key]['ServiciosTelefonicos']['id_economico']);?>
      <td /><?php e($colonia[$daily_report[$key]['ServiciosTelefonicos']['id_colonia']]);?>
      <td /><?php e($street[$daily_report[$key]['ServiciosTelefonicos']['id_calle']]);?>
      <td /><?php e($daily_report[$key]['ServiciosTelefonicos']['numero']);?>
      <td /><?php e($daily_report[$key]['ServiciosTelefonicos']['telefono']);?>
      <td /><?php e($daily_report[$key]['ServiciosTelefonicos']['hora']);?>
    <?php
	   } //End foreach
    ?>
</table>
</div>

    <?php
	e($this->Form->create('Reportes', array('action'=>'CreatePdf')));
	e($this->Form->input('Pdf.data',
			array('type'=>'hidden',
			      'label'=>false,
			      'class'=>'reports',
			      'value'=>'ServiciosTelefonicos'
			)
		      )
	 );
	e($this->Form->input('Pdf.date',
			array('type'=>'hidden',
			      'label'=>false,
			      'class'=>'reports',
			      'value'=>$date
			)
		      )
	 );
	e($this->Form->input('Pdf.week',
			array('type'=>'hidden',
			      'label'=>false,
			      'class'=>'reports',
			      'value'=>$week
			)
		      )
	 );
	e($this->Form->submit('Exportar a Pdf',array("label"=>false)));
	e($this->Form->end());
    ?>
    </div>
	<br /><br />
    <?php
    } //End if-else
    ?>

<!--     Servicios Programados Section -->
<div id="warning"><span>Servicios Programados</span></div>

<?php
    if(empty($weekly_report)){
	e('<div id="warning"><span>No se Encontraron Registros Programados</span></div>');
    }else{
?>
<div id="reports">
<table id="menu_info">
    <tr />
      <th />ID
      <th />Hora
      <th />Colonia
      <th />Calle
      <th />N&uacute;mero
      <th />L
      <th />M
      <th />M
      <th />J
      <th />V
      <th />S
      <th />D
    <?php $idx=1;?>
    <?php foreach($weekly_report as $key => $value){?>
    <tr />
      <td /><?php e($idx++);?>
      <td /><?php e($weekly_report[$key]['ServiciosProgramados']['hora']);?>
      <td /><?php e($weekly_report[$key]['Calle']['Colonia']['colonia']);?>
      <td /><?php e($weekly_report[$key]['Calle']['calle']);?>
      <td /><?php e($weekly_report[$key]['ServiciosProgramados']['numero']);?>
      <td /><?php e($weekly_report[$key]['ServiciosProgramados']['lunes']);?>
      <td /><?php e($weekly_report[$key]['ServiciosProgramados']['martes']);?>
      <td /><?php e($weekly_report[$key]['ServiciosProgramados']['miercoles']);?>
      <td /><?php e($weekly_report[$key]['ServiciosProgramados']['jueves']);?>
      <td /><?php e($weekly_report[$key]['ServiciosProgramados']['viernes']);?>
      <td /><?php e($weekly_report[$key]['ServiciosProgramados']['sabado']);?>
      <td /><?php e($weekly_report[$key]['ServiciosProgramados']['domingo']);?>
    <?php }?>
</table>
</div>
    <?php
	e($this->Form->create('Reportes', array('action'=>'CreatePdf')));
	e($this->Form->input('Pdf.data',
			array('type'=>'hidden',
			      'label'=>false,
			      'class'=>'reports',
			      'value'=>'ServiciosProgramados'
			)
		      )
	 );
	e($this->Form->input('Pdf.date',
			array('type'=>'hidden',
			      'label'=>false,
			      'class'=>'reports',
			      'value'=>$date
			)
		      )
	 );
	e($this->Form->input('Pdf.week',
			array('type'=>'hidden',
			      'label'=>false,
			      'class'=>'reports',
			      'value'=>$week
			)
		      )
	 );
	e($this->Form->submit('Exportar a Pdf',array("label"=>false)));
	e($this->Form->end());
    ?>
	<br /><br />
    <?php
    } //End if-else
    ?>

<!-- Unidades en Servicio Section -->

<div id="warning"><span>Control de Unidades en Fuera de la Ciudad</span></div>
<?php
    if(empty($city_report)){
	e('<div id="warning"><span>No se Encontraron Registros</span></div>');
    }else{
?>
<div id="reports">
<table id="menu_info">
    <tr />
      <th />Movil
      <th />Destino
      <th />Tipo de Servicio
      <th />Salida
      <th />Llegada
      <th />Mon

    <?php foreach($city_report as $key => $value){?>
    <tr />
      <td /><?php e($city_report[$key]['UnidadesFueraCiudad']['id_movil']);?>
      <td /><?php e($localidades[$city_report[$key]['UnidadesFueraCiudad']['id_localidad']]);?>
      <td /><?php e($city_report[$key]['UnidadesFueraCiudad']['tpo_servicio']);?>
      <td /><?php e($city_report[$key]['UnidadesFueraCiudad']['hora_salida']);?>
      <td /><?php e($city_report[$key]['UnidadesFueraCiudad']['hora_llegada']);?>
      <td />
	    <?php
	    $check = $city_report[$key]['UnidadesFueraCiudad']['mom_r'];
	    if($check == true){
		$img = 'check.png';
	    }else{
		$img = 'spam-2.png';
	    }
		e($html->image("icons/$img",
					array('title'=>'Mon',
					      'alt'=>'Mon',
					      'width'=>'15',
					      'height'=>'15'
					      )
			       )
		 );
	    ?>

    <?php }?>
</table>
</div>
    <?php
	e($this->Form->create('Reportes', array('action'=>'CreatePdf')));
	e($this->Form->input('Pdf.data',
			array('type'=>'hidden',
			      'label'=>false,
			      'class'=>'reports',
			      'value'=>'UnidadesFueraCiudad'
			)
		      )
	 );
	e($this->Form->input('Pdf.date',
			array('type'=>'hidden',
			      'label'=>false,
			      'class'=>'reports',
			      'value'=>$date
			)
		      )
	 );
	e($this->Form->input('Pdf.week',
			array('type'=>'hidden',
			      'label'=>false,
			      'class'=>'reports',
			      'value'=>$week
			)
		      )
	 );
	e($this->Form->submit('Exportar a Pdf',array("label"=>false)));
	e($this->Form->end());
    ?>
	<br /><br />
    <?php
    } //End if-else
    ?>


    <div id="warning"><span>Control de Unidades en Servicio</span></div>
    <?php
    if(empty($list_report)){
	e('<div id="warning"><span>No se Encontraron Registros</span></div>');
    }else{
	?>
	<div id="reports">
	    <table id="menu_info">
		<tr />
		    <th />ID
		    <th colspan="4"/>Unidades En Servicio
		    <th />Lista
		    <th colspan='6'/>Fuera de Momento
		    <th colspan='6'/>En Servicio Nuevamente
		    <th colspan='4' />Cambio de Canal
		<tr />
		    <td />Mov
		    <td />Unidad
		    <td />Nombre
		    <td />Inicio
		    <td />Fin
		    <td /><center>P</center>
			<?php
			    for($i=0;$i<=11;$i++){
				e('<td />Hora');
			    }
			?>
			<?php
			    for($i=0;$i<=2;$i++){
				e('<td />Uni');
			    }
			?>
		    <td />C/U
	
	<?php foreach($list_report as $key => $value){?>
	<tr />
	<td /><?php e($value['UnidadesEnServicio']['id_movil']);?>
	<td /><?php e($all['Operadores'][$value['UnidadesEnServicio']['id_movil']]['id_economico']);?>
	<td /><?php e($all['Operadores'][$value['UnidadesEnServicio']['id_movil']]['nombre']);?>
	<td /><?php e($all['UnidadesEnServicio'][$key]['UnidadesEnServicio']['entrada']);?>
	<td /><?php e($all['UnidadesEnServicio'][$key]['UnidadesEnServicio']['salida']);?>
	<td />
	    <center>
	    <?php
	    $chk=$value['UnidadesEnServicio']['pase_de_lista'];
	    if($chk == true){
		$img = 'check.png';
	    }else{
		$img = 'spam-2.png';
	    }
		e($html->image("icons/$img",
					array('title'=>'Lista',
					      'alt'=>'Lista',
					      'width'=>'15',
					      'height'=>'15'
					      )
			       )
		 );
	    ?>
	    </center>
	<?php
		for($i=0;$i<=5;$i++){
		    if(!empty($all['FueraDeMomento'])){
			    e('<td />'.$all['FueraDeMomento'][$key]['FueraDeMomento']["hora_ini_$i"]);
		    }else{
			    e('<td />');
		    }
		}
		for($i=0;$i<=5;$i++){
		    if(!empty($all['FueraDeMomento'])){
			    e('<td />'.$all['FueraDeMomento'][$key]['FueraDeMomento']["hora_fin_$i"]);
		    }else{
			e('<td />');
		    }
		}
		for($i=0;$i<=2;$i++){
		    if(!empty($all['CambioCanal'])){
			    e('<td />'.$all['CambioCanal'][$key]['CambioCanal']["canal_$i"]);
		    }else{
			    e('<td />');
		    }
		}
		if(!empty($all['CambioCanal'])){
		    e('<td />'.$all['CambioCanal'][$key]['CambioCanal']["canal_3"]);
		}else{
		    e('<td />');
		}
	?>

    <?php }?>
</table>
</div>
    <?php
	e($this->Form->create('Reportes', array('action'=>'CreatePdf')));
	e($this->Form->input('Pdf.data',
			array('type'=>'hidden',
			      'label'=>false,
			      'class'=>'reports',
			      'value'=>'UnidadesEnServicio'
			)
		      )
	 );
	e($this->Form->input('Pdf.date',
			array('type'=>'hidden',
			      'label'=>false,
			      'class'=>'reports',
			      'value'=>$date
			)
		      )
	 );
	e($this->Form->input('Pdf.week',
			array('type'=>'hidden',
			      'label'=>false,
			      'class'=>'reports',
			      'value'=>$week
			)
		      )
	 );
	e($this->Form->submit('Exportar a Pdf',array("label"=>false)));
	e($this->Form->end());
    ?>
	<br /><br />
    <?php
    } //End if-else
//     pr($list_report);
//     pr($all);
    ?>