<?php //Reportes/index.ctp ?>

<?php 

?>
<div id="divUpToDate"></div>
<script type="text/javascript">
// get this from hiden hive
function checkChromeWeek(){
  var val = document.getElementById("FlujoWeek").value;
  if(val == ''){
	var week = alert("Debe ingresar un número de Semana");
	document.getElementById("FlujoWeek").focus();
  }else{

//   var inputs, index, count;
// 
// 	inputs = document.getElementsByClassName('validate');
// 	for (index = 0; index < inputs.length; ++index) {
//     // deal with inputs[index] element.
// 	  if(inputs[index].value != ''){
// 		alert('value=>'+ inputs[index].value);
// 		window.location.reload();
// 	  }
// 	}

  }
}// End checkChromeWeek

function reload(){
// 	var week = prompt("Debe ingresar un número de Semana", "27");
  var inputs, index, count;

	inputs = document.getElementsByClassName('validate');
	for (index = 0; index < inputs.length; ++index) {
    // deal with inputs[index] element.
	  if(inputs[index].value != ''){
		document.open();
		document.writeln("<p>value=>"+ inputs[index].value +"</p>");
		document.close();
// 		window.location.reload();
	  }
	}
}

function checkFirefoxWeek(){
  var val = document.getElementById("FlujoWeek").value;
  if(val == ''){
	var week = prompt("Debe ingresar un número de Semana", "27");
	  if(week != null){
		document.getElementById("FlujoWeek").value = week ;
		document.getElementById("FlujoWeek").focus();
	  }
  }
} // end checkFirefoxWeek

</script>

<?php
	    /**
		 @description => Sends and Save the data then close the form.
		**/
e($ajax->form(array("type"=>"post",
                    "options"=>array("model"=>"Reportes",
                    "update"=>"divView",
					'after'=>"checkChromeWeek();",
// 					"loading" => "Element.hide('hide_div');Element.show('loading');",
// 					'loaded' => "reload();",
// 					'before'=>"reload();",
// 					"complete" => "Element.hide('loading');Effect.SlideUp('hide_div',{duration: 2.0});",
					"complete" => "Element.hide('loading');", // add reload of the page
                    "url"=>array("controller"=>'Reportes',"action"=>"SaldoSave"),
			       )
                   )
             )
 );
echo $ajax->remoteTimer(
    array(
    'url' => array( 'controller' => 'Reportes', 'action' => 'update', 11,12 ),
    'update' => 'time',
    'frequency' => 1
    )
);

echo $ajax->remoteTimer(
    array(
    'url' => array( 'controller' => 'Reportes', 'action' => 'mes', 11,12 ),
    'update' => 'mes',
    'frequency' => 1
    )
);
/**
 * @Update the div of Total de Ingresos Display
 */
// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // 
echo $ajax->remoteTimer( // Total header
    array(
    'url' => array( 'controller' => 'Reportes', 'action' => 'Ingresos'),
    'update' => 'divIngresosHeader',
    'frequency' => 1
    )
);
echo $ajax->remoteTimer( // Total header
    array(
    'url' => array( 'controller' => 'Reportes', 'action' => 'Egresos'),
    'update' => 'divEgresosHeader',
    'frequency' => 1
    )
);
// echo $ajax->remoteTimer(
//     array(
//     'url' => array( 'controller' => 'Reportes', 'action' => 'Ingresos'),
//     'update' => 'Ingresos',
//     'frequency' => 1
//     )
// );

// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // 
// echo $ajax->remoteTimer(
//     array(
//     'url' => array( 'controller' => 'Reportes', 'action' => 'gastosNormalesOperacion'),
//     'update' => 'Gastos Normales de Operacion', // Edit according the db
//     'frequency' => 1
//     )
// );

echo $ajax->remoteTimer(
    array(
    'url' => array( 'controller' => 'Reportes', 'action' => 'Impuestos'),
    'update' => 'Impuestos',
    'frequency' => 1
    )
);
echo $ajax->remoteTimer(
    array(
    'url' => array( 'controller' => 'Reportes', 'action' => 'div1'),
    'update' => 'div1',
    'frequency' => 1
    )
);
echo $ajax->remoteTimer(
    array(
    'url' => array( 'controller' => 'Reportes', 'action' => 'div2'),
    'update' => 'div2',
    'frequency' => 1
    )
);
echo $ajax->remoteTimer(
    array(
    'url' => array( 'controller' => 'Reportes', 'action' => 'div3'),
    'update' => 'div3',
    'frequency' => 1
    )
);

echo $ajax->remoteTimer(
    array(
    'url' => array( 'controller' => 'Reportes', 'action' => 'div4'),
    'update' => 'div4',
    'frequency' => 1
    )
);
echo $ajax->remoteTimer(
    array(
    'url' => array( 'controller' => 'Reportes', 'action' => 'div5'),
    'update' => 'div5',
    'frequency' => 1
    )
);
echo $ajax->remoteTimer(
    array(
    'url' => array( 'controller' => 'Reportes', 'action' => 'div6'),
    'update' => 'div6',
    'frequency' => 1
    )
);
echo $ajax->remoteTimer(
    array(
    'url' => array( 'controller' => 'Reportes', 'action' => 'div7'),
    'update' => 'div7',
    'frequency' => 1
    )
);
echo $ajax->remoteTimer(
    array(
    'url' => array( 'controller' => 'Reportes', 'action' => 'div8'),
    'update' => 'div8',
    'frequency' => 1
    )
);

// echo $ajax->remoteTimer(
//     array(
//     'url' => array( 'controller' => 'Reportes', 'action' => 'reembolsoDeFondoFijoDeCaja'),
//     'update' => 'Reembolso de fondo Fijo de Caja',
//     'frequency' => 1
//     )
// );
echo $ajax->remoteTimer(
    array(
    'url' => array( 'controller' => 'Reportes', 'action' => 'UpTotalEgresosId'),
    'update' => 'divTotalEgresos',
    'frequency' => 1
    )
);
echo $ajax->remoteTimer(
    array(
    'url' => array( 'controller' => 'Reportes', 'action' => 'UpTotalEgresos'),
    'update' => 'divTotalEgresosId',
    'frequency' => 1
    )
);
echo $ajax->remoteTimer(
    array(
    'url' => array( 'controller' => 'Reportes', 'action' => 'UpEfectivoDisponibleId'),
// 	'loading' => "Element.hide('SaldoDisp');Element.show('spinSaldoDisp');",
// 	'complete' => "Element.hide('spinSaldoDisp');;Effect.SlideUp('SaldoDisp',{duration: 0.5};",
    'update' => 'divEfectivoDisponible',
    'frequency' => 1
    )
);
echo $ajax->remoteTimer(
    array(
    'url' => array( 'controller' => 'Reportes', 'action' => 'UpSaldoDisponibleId'),
    'update' => 'divSaldoDisponible',
    'frequency' => 1
    )
);
// echo $ajax->remoteTimer(
//     array(
//     'url' => array( 'controller' => 'Reportes','action' => 'UpViewTotals'),
//     'update' => 'divViewTotals',
//     'frequency' => 1
//     )
// );
?>

    <!--Build the Saldos input section-->
    <table id="menu_info">
    	<tr />
		  <td width="45%" /><h4> Flujo de Caja del mes de <div id="mes" style="display:inline;"> <?php e($Date['mes']);?> Semana  <?php e($Date['week']);?> </div> </h4>
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
				    array('type' => 'date',
					  'label'=>false,
					  'class'=>'in_cal',
					  'value'=>$Date['year'].'-'.$Date['month'].'-'.$Date['day'],
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
			  e($ajax->observeField('FlujoWeek',
							array("url"=>array("controller"=>"Reportes",
								  "action"=>"upToDate",
										  ),
								  "update" => "divEstimado",
							)
								  )
			  );
		 ?>
<!-- 		 <td /> -->
		 <td width="2%"/>


		<td width="5%" />
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
		 <td width="5%" />
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
		<td width="5%" />
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
					  'controller'=>'search/#openModal',
					  'action'=>'index'
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
	
	
	
	
<!-- 	<div id="divAny"></div> -->
	
	
	
	<div id="time">
    <table id="menu_info">
		<tr /> <!--Next row for color fix-->
	    <tr />
		  <th style="text-align:center;" />Concepto
<!-- 		  <th style="text-align:center;" />Real -->
		  <th style="text-align:center;" />Presupuesto
	    <tr />
	    
		  <td style="text-align:center;" />Saldo Inicial
<!-- 		  <td style="text-align:center;" />&nbsp; -->
					<?php 
// 						e($saldo['real']);
// 						e('$'.number_format(money_format('%i',$saldo['real']), 2, '.', ','));
					?>
		  <td style="text-align:center;" />
					<?php 
// 						e($saldo['presupuesto']);
						e('$'.number_format(money_format('%i',$saldo['presupuesto']), 2, '.', ','));
					?>
		
		<tr />
		  <td />
	</table>
	</div>
	
	<table style="background:none;">
		<tr />
		  <td />
		  <td style="text-align:right;"/>
			<?php
			/**
			  @description => open the edition inputs
			**/
			e($this->Ajax->link('Editar Saldo',
			array(
			      'controller'=>'Reportes',
			      'action'=>'Saldo',
			      'saldo'
			),
			array(
			      'escape' => false,
			      "class" => 'link_blue',
			      "update" => "hide_div",
			      "complete" => "Element.hide('loading');Effect.SlideDown('hide_div',{duration: 1.5});",
			      'alt'=>'Edicion de Saldo',
			      'title' => 'Edicion de Saldo'
			)
			// set msj to confirm
// 			"Are you sure of this??"
		    )
		);
			?>

	</table>
	
	
	<div id="hide_div">
	  <?php //ALERT loading section ?>

<!--		<div id="loading" style="display:none;">
		  <table id="menu_info_small">
			<tr />
			  <th colspan="3" style="background:white;" />Recibiendo Informaci&oacute;n ...
			<tr />
			  <td colspan="3" style="background:white;" />&nbsp;
			<tr />
			  <td width="40%" style="background:white;" />&nbsp;
			  <td style="background:white;" />
			<?php //echo $html->image("loaders/loading.gif"); ?>
			  <td width="40%" style="background:white;" />&nbsp;
			<tr />
			  <td colspan="3" style="background:white;" />&nbsp;
			 <tr />
			  <td colspan="3" style="background:white;" />&nbsp;
		  </table>
		</div>-->
	</div>
	<div id="loading"></div>
	

<!-- 	<div id="divConceptos">...</div> -->
	<?php



// 	    e($ajax->observeField('ReportesArea',
// 				    array("url"=>array("controller"=>"Reportes",
// 						       "action"=>"Kms"
// // 						       "model"=>"Ingresos"
// 						      ),
// 					  "update" => "divKms"
// 					 )
// 				 )
// 	    );
// 	    
// 	    e($ajax->observeField('ReportesArea',
// 				    array("url"=>array("controller"=>"Reportes",
// 						       "action"=>"Ingresos"
// // 						       "model"=>"Ingresos"
// 						      ),
// 					  "update" => "divIngresos"
// 					 )
// 				 )
// 	    );
// 	    
// 	    e($ajax->observeField('ReportesArea',
// 				    array("url"=>array("controller"=>"tachion",
// 						       "action"=>"tachion"
// // 						       "model"=>"Ingresos"
// 						      ),
// 					  "update" => "divTachion"
// 					 )
// 				 )
// 	    );
// 	    
// 	    e($ajax->observeField('ReportesArea',
// 				    array("url"=>array("controller"=>"Reportes",
// 						       "action"=>"Programs"
// // 						       "model"=>"Ingresos"
// 						      ),
// 					  "update" => "divPrograms"
// 					 )
// 				 )
// 	    );
		  ?>


<div class="simpleTabs"> <!--Container-->
  <ul class="simpleTabsNavigation">
    <li><a href="#">Estimado</a></li>
<!--     <li><a href="#">Anexos</a></li> -->
<!--     <li><a href="#">Anexo B</a></li> -->
<!--     <li><a href="#">Anexo C</a></li> -->
    <?php
      if($_SESSION['Auth']['User']['level'] == '0'){ // Means Super User
    ?>
<!--      <li><a href="#">Configuracion</a></li> Uncomment for enable--> 
    <?php
    } // En options for administrators
    ?>
  </ul>

  

  
  <div class="simpleTabsContent">
      <table id="menu_info"> <!--Title of the sheet-->
		<tr />
		  <td style="text-align:center;font-size:120%;font-weight:bold;" />Estimado
      </table>
	  <div id="divEstimado"> <!--This is going to update -->
		  
		  <?php
			App::Import('Controller','Reportes');
			echo $this->element('estimado');
		  ?> <!--dinamic update -->
		  
		  <?php
// 		    App::import('Controller', 'RemoteTimer');
// 		    echo $this->element('chronos');
// 		    echo $this->element('chronos',array('mkdiv',$this->requestAction('RemoteTimer/mkdiv/')));
		  ?>
      </div> <!--End of observeField=> divEstimado-->
  </div><!-- End simpleTabsContent Estimado-->

	
<div class="simpleTabsContent">
      <table id="menu_info">
	  <tr />
	    <td colspan="3" style="text-align:center;font-size:120%;font-weight:bold;" />Configuracion
      </table>
   <div id="divIngresos">
   
      <table id="menu_info" >
	    <tr />
		<td width="520" style="text-align:center;" />
<!-- 		    this is going to update -->
<!-- 		    <div id="divArea"> -->
			
			<table>
			  <tr />
			    <td height="140" style="text-align:center;font-size:180%;" />
				<?php

				?>   
			      <br />
				<p style="text-align:center;font-size:160%;">
				<?php

				?>   
				</p>    
			  <tr />
			    <td style="text-align:center;font-size:120%;" />

			  <tr />
			    <td style="text-align:center;" />
		    <?php 

		    ?>
			</table>

		<td colspan="2" style="text-align:center;" />
		    <?php 

		    ?>
		    
		<span style="float:right;">
		<?php

		?>
		</span>
    
	  </table>

   </div> <!--End of divIngresos-->
</div> <!--End of simpleTabsContent=>Ingresos-->


<div class="simpleTabsContent">
   <div id="divPrograms">
	  
   </div> <!--End of divPrograms-->
</div> <!--End of simpleTabsContent=>Programs-->



  
</div> <!-- Ends div SimpleTabs container-->


<?php
// 	e($form->submit('Actualizar'));
// 	e($form->end());
?>
 
<div id='divUpdateAll'>...<?php //include('show_phones.ctp');?></div>



