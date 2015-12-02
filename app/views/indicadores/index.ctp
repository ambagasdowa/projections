<?php
  //indicadores
?>
<?php
//   e('indicadores');
?>
<?php
//   projections/index.ctp
	    if($_SESSION['Auth']['User']['id_empresa'] == '1'){
		  if(isset($areas['4'])){
			if($areas['4'] == 'Tijuana'){
			  $areas['4'] = 'Mexicali';
			}
		  }
		}

?>

<script type="text/javascript">
  function reloading(){
	window.location='/projections/indicadores/';
  }
</script>

    <br />
    	  <table id="<?php e(idTotalIndexGray);?>">
			<tr />
			  <td />
			  <td />
				<?php
					e($form->input('Projections.area',
							array('type'=>'select',
								  'selected'=>'empty',
								  'label'=>false,
								  'options'=>$areas,
		// 					      'empty'=>'Seleccionar Area'
							)
					  )
					);
					

					e($ajax->observeField('ProjectionsArea',
								array("url"=>array("controller"=>"Indicadores",
										  "action"=>"getDateDisponibilidad"
										  ),
								  "update" => "divIndicadoresDisponibilidad",
								  "loading"=>"Element.hide(hide);Element.show('waiting');",
								  "complete" => "Element.hide('waiting');Effect.Grow('hide',{duration: 2.0});"
								)
							)
					);
				?>
			  <td width="3%" />A&ntilde;o &#58;
			  <td width="10%" />
				  <?php
					  e($form->input('Projections.year',
								array(
									'type'=>'select',
									'selected'=>array_search($_SESSION['Auth']['User']['year'],$tau),
									'label'=>false,
									'options'=>$tau
								)
							)
					  );
					  e($ajax->observeField('ProjectionsYear',
									  array('url'=>array('controller'=>'Indicadores',
														  'action'=>'blackWars',
												   ),
											"loading"=>"Element.hide(hide);Element.show('waiting');",
											"complete"=>"reloading()"
// 											"update"=>"divYear"
									  )
						)
					  );
				  ?>
		<?php if($_SESSION['Auth']['User']['level'] !== '7'){ ?>
		  <?php 
				if($_SESSION['Auth']['User']['level'] === '2'){
				  unset($unidadDeNegocio['3']);
				}if($_SESSION['Auth']['User']['level'] === '3'){
				  unset($unidadDeNegocio['2']);
				}
		  ?>
			  
			  <td width="6%" />Empresa &#58;
			  <td width="10%" />
				  <?php
						e($form->input('Projections.id_empresa',
										array('type'=>'select',
											  'selected'=>$_SESSION['Auth']['User']['id_empresa'],
											  'label'=>false,
											  'options'=>$unidadDeNegocio
	// 									      'empty'=>'Empresa'
										)
								)
						);

						e($ajax->observeField('ProjectionsIdEmpresa',
									array("url"=>array("controller"=>"Indicadores",
													  "action"=>"shiftCorp",
												),
										  "loading" => "Element.hide('hide');Element.show('waiting');",
	// 									  "after" => "Effect.Grow(reloading(),{duration: 2.0});",
										  "complete" => "reloading();",
									)
								)
						);
				?>

		<?php }//End Auth?>
			  <td width="5%" />
				<div id="logo">
				<?php
				  e($this->Html->link('·',
										array(
											  'controller'=>'Users',
											  'action'=>'edit',
											  $_SESSION['Auth']['User']['id'],
											  '?'=>array('chpass'=>true)
											)
									  )
				  );
				?>
			  <td width="1%" />
		
	</table>
	
<!-- 	<div id="divYear">...</div> -->
	
    <div id="waiting" style="display:none;">
	<table id="<?php e(idTotalIndexGray);?>">
	  <tr />
	      <td />&nbsp;
	      <td />Actualizando ...
		    <?php 
// 				echo $html->image("loaders/loader_text.gif",
// 					      array("width"=>280,
// 						    "height"=>10,
// 					      )
// 				); 
		    ?>
	      <td />
		    <?php echo $html->image("loaders/loading.gif"/*,
					      array("width"=>280,
						    "height"=>10,
					      )*/
				); 
		    ?>
<!-- 		</div> -->
	      <td />&nbsp;
	</table>
    </div>

    <div id='hide'>

<div class="simpleTabs"> <!--Container-->
  <ul class="simpleTabsNavigation">

    <?php
      if($_SESSION['Auth']['User']['level'] !== '7'){ // Means Normal User
    ?>
	  <li><a href="#">Indicadores de Ingresos</a></li>
	  <li><a href="#">Indicadores de Costos</a></li>
    <?php
    } // En options for users
    ?>
      <li><a href="#">Indicadores de Disponibilidad</a></li>
    <?php
      if($_SESSION['Auth']['User']['level'] === '0' and $_SESSION['Auth']['User']['status'] === 'Inactive'){ // Means Super User with SuperCow powa
    ?>
     <li><a href="#">Configuraci&oacute;n</a></li>  <!--Uncomment for enable-->
    <?php
    } // En options for administrators
    ?>
  </ul>


    <?php
      if($_SESSION['Auth']['User']['level'] !== '7'){ // Means Normal User
    ?>
    
  <div class="simpleTabsContent">
<!--   selection controller -->
   <div id="divIndicadoresIngresos"> <!--this is for Controller-->
<!-- 		  view to render -->
		  <?php
			echo $this->element('ind_ingresos',array('ind_ingresos'=>$this->requestAction('Indicadores/ind_ingresos')));
		  ?> <!--dinamic update -->
   </div> <!--End of divIngresosViajes-->
  </div> <!--End of simpleTabsContent=>IngresosViajes-->
  
  <div class="simpleTabsContent">
   <div id="divIndicadoresCostos"> <!--this is for Controller-->
		  <?php
			echo $this->element('ind_costos',array('ind_costos'=>$this->requestAction('Indicadores/ind_costos')));
		  ?> <!--dinamic update -->
   </div> <!--End of divIngresosTracto-->
  </div> <!--End of simpleTabsContent=>IngresosTracto-->

    <?php
	  } // Means Normal User
    ?>


  <div class="simpleTabsContent">
   <div id="divIndicadoresDisponibilidad">
   <!--this is for Controller-->
		  <?php
			  echo $this->element('get_date_disponibilidad',array('disponibilidad'=>$this->requestAction('Indicadores/ind_disponibilidad')));
		  ?>
   </div> <!--End of divIndicadoresDisponibilidad-->
  </div> <!--End of simpleTabsContent=>IngresosOperador-->


 <div class="simpleTabsContent"> 
   <div id="divPrograms"> <!--this is for Controller-->
	  <table id="<?php e(idTotalIndexGray);?>">
		<tr>
		  <td>
			<?php
				  echo $this->Html->link( 
				  $this->Html->image("icons/user-4.png",
								array("alt" => "users",
							  'title' => 'users',
								  'width' => '15',
								  'height' => '15'
						)
				  ),
									array(
										  'controller'=>'Users',
										  'action'=>'index',
										  'alt'=>'Users',
										  'title'=>'users'
										 ) ,
						array('escape' => false),
						null
				);
			?>
		  </td>
		  <td>
			<?php
			  e($this->Html->link('Configuracion de Usuarios',
									array(
										  'controller'=>'Users',
										  'action'=>'index',
										  'alt'=>'Users',
										  'title'=>'users'
										 )
								  )
			   );
			?>
		  </td>
		</tr>
		<tr>
		  <td>
			<?php
				  echo $this->Html->link( 
				  $this->Html->image("icons/pen.png",
								array("alt" => "users",
							  'title' => 'users',
								  'width' => '15',
								  'height' => '15'
						)
				  ),
									array(
										  'controller'=>'Projections',
										  'action'=>'modelTest',
										  'alt'=>'debug',
										  'title'=>'debug'
										 ) ,
						array('escape' => false),
						null
				);
			?>
		  </td>
		  <td>
			<?php
			  e($this->Html->link('Detalle Toneladas',
									array(
										  'controller'=>'Projections',
										  'action'=>'modelTest',
										  'alt'=>'debug',
										  'title'=>'debug'
										 )
								  )
			   );
			?>
		  </td>
		</tr>
		<tr>
		  <td>
			<?php
				  echo $this->Html->link( 
				  $this->Html->image("icons/pen.png",
								array("alt" => "users",
							  'title' => 'users',
								  'width' => '15',
								  'height' => '15'
						)
				  ),
									array(
										  'controller'=>'Projections',
										  'action'=>'debugViajes',
										  'alt'=>'debug',
										  'title'=>'debug'
										 ) ,
						array('escape' => false),
						null
				);
			?>
		  </td>
		  <td>
			<?php
			  e($this->Html->link('Detalle Viajes',
									array(
										  'controller'=>'Projections',
										  'action'=>'debugViajes',
										  'alt'=>'debug',
										  'title'=>'debug'
										 )
								  )
			   );
			?>
		  </td>
		</tr>
	  </table>
   </div> <!--End of divPrograms-->
</div> <!--End of simpleTabsContent=>Programs-->

</div> <!-- Ends div SimpleTabs container-->


<?php
// 	e($form->submit('Actualizar'));
	e($form->end());
?>

  </div> <!--End hide-->