<?php //Reportes/index.ctp ?>

<?php var_dump($_SESSION['lastDate']);?>
<script type="text/javascript">
// get this from hiden hive
function checkChromeWeek(){
  var val = document.getElementById("FlujoWeek").value;
  if(val == ''){
	var week = alert("Debe ingresar un número de Semana");
	document.getElementById("FlujoWeek").focus();
  }
}// End checkChromeWeek

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
// 					"complete" => "Element.hide('loading');Effect.SlideUp('hide_div',{duration: 2.0});",
					"complete" => "Element.hide('loading');",
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

/**
 * @Update the div of Total de Ingresos Display
 */
// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // 
echo $ajax->remoteTimer(
    array(
    'url' => array( 'controller' => 'Reportes', 'action' => 'UpTotalIngresos'),
    'update' => 'ingresos',
    'frequency' => 1
    )
);
echo $ajax->remoteTimer(
    array(
    'url' => array( 'controller' => 'Reportes', 'action' => 'UpTotalIngresos'),
    'update' => 'ingresosForm',
    'frequency' => 1
    )
);
// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // 
echo $ajax->remoteTimer(
    array(
    'url' => array( 'controller' => 'Reportes', 'action' => 'gastosNormalesOperacion'),
    'update' => 'gastosNormalesOperacion',
    'frequency' => 1
    )
);
echo $ajax->remoteTimer(
    array(
    'url' => array( 'controller' => 'Reportes', 'action' => 'gastosNormalesOperacionTd'),
    'update' => 'gastosNormalesOperacionTd',
    'frequency' => 1
    )
);
echo $ajax->remoteTimer(
    array(
    'url' => array( 'controller' => 'Reportes', 'action' => 'UpTotalImpuestos'),
    'update' => 'total_impuestos',
    'frequency' => 1
    )
);
echo $ajax->remoteTimer(
    array(
    'url' => array( 'controller' => 'Reportes', 'action' => 'UpTotalImpuestosTd'),
    'update' => 'total_impuestos_td',
    'frequency' => 1
    )
);
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

?>

    <!--Build the Saldos input section-->
    <table id="menu_info">
    	<tr />
		  <td colspan="3" /><h4> Flujo de Caja del mes de <?php e(date('m'));?></h4>
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
					  'value'=>$_SESSION['lastDate']['year']."-".$_SESSION['lastDate']['month']."-".$_SESSION['lastDate']['day'],
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
		 ?>
		 <td width="10%" />
		 <td />
		  <?php
			  e($form->input('Flujo.anexo',
							array('type'=>'select',
								  'label'=>false,
								  'disabled'=>false,
								  'empty'=>'-Anexos',
								  'options'=>$AnX
// 								  'placeholder'=>'Concreto',
// 					  			  'value'=>$estimate['Ingresos']['FlujoIngresos']['concreto']
								)
						)
			  );
			  e($ajax->observeField('FlujoAnexo',
							array("url"=>array("controller"=>"Reportes",
								  "action"=>"Anexo",
										  ),
								  "update" => "divAnexos",
							)
								  )
			  );
		  ?>

		 <td width="2%"/>
		<?php
				if($_SESSION['Auth']['User']['level'] == '0'){ // Means Super User
		?>
			 <a href="../config/viewConfig">Configuraci&oacute;n</a>  <!--Uncomment for enable-->
		<?php
				} // En options for administrators
		?>
		<td width="2%" />&nbsp;
		<td width="2%" /><a href="../search/">Consultas</a>
		<td width="2%" />&nbsp;
	</table>
	
	<div id="time">
    <table id="menu_info">
		<tr /> <!--Next row for color fix-->
	    <tr />
		  <th style="text-align:center;" />Concepto
		  <th style="text-align:center;" />Real
		  <th style="text-align:center;" />Presupuesto
	    <tr />
	    
		  <td style="text-align:center;" />Saldo Inicial
		  <td style="text-align:center;" />
					<?php 
// 						e($saldo['real']);
						e('$'.number_format(money_format('%i',$saldo['real']), 2, '.', ','));
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

	</div>
	<div id="loading"></div>
	

<div class="simpleTabs"> <!--Container-->
  <ul class="simpleTabsNavigation">
    <li><a href="#">Flujo</a></li>
    <li><a href="#">Anexos</a></li>
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
		  <td colspan="3" style="text-align:center;font-size:120%;font-weight:bold;" />Flujo
      </table>
	  <div id="divEstimado"> <!--This is going to update -->
		
		  <?php
			App::Import('Controller','flujo');
			echo $this->element('flujo');
		  ?> <!--dinamic update -->

      </div> <!--End of observeField=> divEstimado-->
  </div><!-- End simpleTabsContent Estimado-->



<div class="simpleTabsContent">

   <div id="divAnexos">

      <table id="menu_info">
	  <tr />
	    <td colspan="3" style="text-align:center;font-size:120%;font-weight:bold;" />
	    <?php
		  e($AnX['1']);
	    ?>
      </table>
		  
		  <?php
			App::Import('Controller','Reportes');
			echo $this->element('anexo');
// 			echo $this->element('anexo',array('anxa',$this->requestAction('Reportes/anxa/test')));
		  ?> <!--dinamic update -->

		  <?php
				  e($ajax->observeField('AnexoIdCuenta',
							  array("url"=>array("controller"=>"Reportes",
													  "action"=>"concept"
						// 						       "model"=>"Ingresos"
												),
										"update" => "divConcepts"
								   )
						  )
				  );
		  ?>
   </div> <!--End of div_anexo_a-->
</div> <!--End of simpleTabsContent=>AnexoA-->
	
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



