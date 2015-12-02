<?php
$filter['backgroundColor']['Granel'] = '#BFD9FF';
$filter['backgroundColor']['Envasado'] = '#BFFFBF';
$filter['backgroundColor']['Agregados'] = '#FFFFBF';
$filter['backgroundColor']['Caja Seca'] = '#F8FFBF';
$filter['backgroundColor']['Productos Varios'] = '#EEEEEE';
$filter['backgroundColor']['Clinker'] = '#E0E0E0';
$filter['backgroundColor']['Otros'] = '#E6E6E6';
// $filter['backgroundColor']['Envasado'] = '#EEEEEE';
// $filter['backgroundColor']['Agregados'] = '#EEEEEE';
// $filter['backgroundColor']['Caja Seca'] = '#EEEEEE';
// $filter['backgroundColor']['Productos Varios'] = '#EEEEEE';
// pr($filter['concepto']);
// pr($filter['get_area']);
// pr($filter['get_mes']);
// pr($filter['_fraccion']);exit();
// pr($filter);exit();
$today = date('Y-m-d');
// pr($_SESSION['Auth']['User']['empresa']);
if($filter['get_area'] == 0){
  $level = strtolower($_SESSION['Auth']['User']['empresa']);
}if($filter['get_area'] > 0){
//   $imageUrl = "thumbs/daily/".$indicador."_".$filter['area']."_".$filter['id_mes']."_".$year=date('Y').".png";
  $level = $filter['area'];
}
$fraction = $filter['fraction'];

?>

<?php
e($ajax->form(array("type"=>"post",
                    "options"=>array("model"=>"Projections",
                    "update"=>"divComp",
                    "loading" => "Element.hide('divComp');Element.show('loading_div');",
                    "complete" => "Element.hide('loading_div');Effect.Grow('divComp',{duration: 2.0});",
                    "url"=>array("controller"=>'Projections',"action"=>"ConceptSelected"),
			       )
                   )
             )
 );

 
 	e($form->input('Concept',
			array('type'=>'hidden',
// 			      'selected'=>'empty',
			      'label'=>false,
			      'value'=>$filter['concepto'],
// 			      'empty'=>'Seleccionar Area'
			)
		      )
	);
	e($form->input('area',
			array('type'=>'hidden',
// 			      'selected'=>'empty',
			      'label'=>false,
			      'value'=>$filter['get_area']
// 			      'empty'=>'Seleccionar Area'
			)
		      )
	);
	e($form->input('mes',
			array('type'=>'hidden',
// 			      'selected'=>'empty',
			      'label'=>false,
			      'value'=>$filter['get_mes']
// 			      'empty'=>'Seleccionar Area'
			)
		      )
	);
// 	var_dump($conceptos);
// $conceptos = array('1'=>'Toneladas','2'=>'Kilometros','3'=>'Ingresos','4'=>'Viajes');
// 
// 
//   if($_SESSION['Auth']['User']['level'] === '7'){ // Means Normal User and can't see the $$
// 		unset($conceptos['3']);
//   }
// 
//   if(dropTabs( $_SESSION['Auth']['User']['email'], null, null ) != null){
// 	$viewConfig = dropTabs($_SESSION['Auth']['User']['email'],null,null);
//   }
// 
//   if((!isset($viewConfig['dropProjection'])) OR (isset($viewConfig['dropProjection']) and $viewConfig['dropProjection'] === false)){
//   }

$compare = array('1'=>'current','2'=>'all'); // for update fields

$colspan = 'colspan="'.count($fraction).'"';
?>
  <table id="<?php e(idDateBottom);?>" class="table">
  <td width="1%"/>
  <td />
	<span style="float:left;">
		<?php
		  echo $this->Html->link('<< Volver ',
					array(
					  'action'=>'index'
					 ),
					array(
					    'class'=>'btn btn-default button_link',
					    'title'=>'Volver',
					    'alt'=>'Volver'
					)
				    );
		?>
	</span>
  <td />
	  <?php
		if($filter['area'] == 'Tijuana'){
		  e('Mexicali');
		}else{
		  e($filter['area']);
		}
	  ?>
      <?php
		foreach($conceptos as $key => $data){
			if($data==$filter['concepto']){
		  $checked = 'checked';
			}else{
		  $checked = null;
			}

	  if(in_array(ucwords($filter['concepto']),$conceptos)){
		  $get_concepto = strtolower($filter['concepto']);
  }
  ?>
    <td />
    <?php
	/** TODO : fix this with cakephp make a translation of input
	 *  ALERT: For now this is already a working stuff!!
	 */
    ?>
    <?php 	if( isset($_SESSION['theme']['legacy']) and $_SESSION['theme']['legacy'] === true) {?>
    <?php e('<span style="font-variant:small-caps;font-size:12px;font-weight:bold;">'.$data.'</span>');?>
    <label name="data[Compare][<?php e($key); ?>]"
	    class="switch switch-green"
	    accesskey="A"
    >

    <input name="data[Compare][<?php e($key); ?>]"
	    type="checkbox"
	    class="switch-input"
	    value="<?php e($conceptos[$key]);?>" 
	    <?php 
	    e($checked);
	    ?>
    >
    <span class="switch-label"
	   data-on="On"
	   data-off="Off">
    </span>
    </label>
    
    <?php } else if(isset ($_SESSION['theme']['protoquery']) and $_SESSION['theme']['protoquery'] === true) { ?>
    
	<div class="checkbox">
		<label>
			<input type="checkbox" name="data[Compare][<?php e($key); ?>]" value="<?php e($conceptos[$key]);?>" <?php e($checked);?> > <?php e($conceptos[$key]);?>
			<i class="fa fa-square-o"></i>
		</label>
	</div>
<!--      -->
	<?php }?>
    <?php
    } // End foreach
    ?>
    
	<td />
	    <?php
		  e($form->button('Mostrar',array('class'=>'btn btn-default button_blue')));
		  e($form->end());
	    ?>
    
  </table>
  
    <div id="loading_div" style="display:none;">
	<table id="menu_info_small" class="table">
	  <tr />
	      <td />&nbsp;
	      <td />Recibiendo Informaci&oacute;n
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
	
	
<?php
// setlocale(LC_MONETARY, 'es_MX');
?>

  <table id="menu_info_small" class="table">

    <tr />
    <th colspan="14" style="border-bottom:none;" />&nbsp;
    <?php
	e($form->input('ProjectionsCompare',
			array('type'=>'hidden',
			      'selected'=>'empty',
			      'label'=>false,
			      'options'=>$compare,
// 			      'empty'=>'Seleccionar Area'
			)
		      )
	);
			
// 	    e($form->end());
	e($ajax->observeField('ProjectionsCompare',
	    array("url"=>array("controller"=>"Projections",
			       "action"=>"UpCompare"
// 			       "model"=>"Ingresos"
			      ),
		  "update" => "divCompare"
		 )
	    )
	);


    ?>
    <tr />
    <th colspan="14"  style="text-align:center;" />
    <tr />
<!--       <td colspan="5" width="40%">&nbsp; -->
      <td colspan="1">&nbsp;
<!--       <td />Detalle Diario para el mes de  -->
      <td colspan="4" style="text-align:left;" /><?php e('<h4>'.$filter['mes'].'<h4>'); ?>
      <td colspan="4" style="text-align:center;" /><?php //e('<h2>'.$filter['area'].'</h2>'); ?>
      <td colspan="4" style="text-align:right;" /><?php e('<h4>'.date('Y').'</h4>'); ?>
      <td colspan="1" width="8%" >&nbsp;
<!--       <td colspan="1" width="40%">&nbsp; -->
    <tr />
	<td colspan="14" style="text-align:center;background:white;" />
	  <div id="carrousell-wrapper">
	    <div id="carrousell-content">
		    <?php
		      foreach($filter['_fraccion'] as $indicador => $fracciones){
// 				foreach($fracciones as $id_fraccion => $fraccion_name){
				  e('<div class="slide">'."\n");
					echo $this->Html->link( 
				      $this->Html->image("thumbs/daily/".$indicador."_".$level."_".$filter['id_mes']."_".$year=$_SESSION['Auth']['User']['year'].".png",
// 					  $this->Html->image($imageUrl,
							array("alt" => "Volver al Inicio",
							  'title' => 'Volver al Inicio',
							  'width' => '820',
							  'height' => '210'
							)
					  ),
							array(
							  'action'=>'index'
	// 					  		$consulta[$key]['Padre']['id_padre'],
	// 					  		$date='var'
							) ,
							array('escape' => false),
							null
					);
				e("\n".'</div>'."\n");
// 			 }
		      }
		    ?>
	    </div>
	  </div>
      <tr />
	<td colspan="14"/>
	
	<script type="text/javascript">
	      new Carousel('carrousell-wrapper', 
			$$('#carrousell-content .slide'), 
			$$('a.carrousell-control', 'a.carrousell-jumper'),{
			transition: 'spring',
			effect: 'fade',
			duration: 0.4,
			wheel: false
			}
		  );
	 </script>
<!-- 	  <div class="clearfix"> -->
		<a href="javascript:" class="carrousell-control ico-next btn btn-default" rel="next" style="float:right;">Siguiente &rsaquo;</a>
<!-- 	  </div> -->
<!-- 	  <div class="clearfix center-block"> -->
		<a href="javascript:" class="carrousell-control ico-prev btn btn-default" rel="prev" style="float:left;">&lsaquo; Anterior</a>
<!-- 	  </div> -->
      <tr />

	<td colspan="14"/> <!--Make the calendar-->
  </table> <!--End headers presentation-->

<!--	  <div id="divCompare">--> <!--Update section-->
      <div id='divComp'><!--Update section-->
	<table id="menu_info_small" style="color:black;" class="table table-hover table-condensed table-bordered table-striped"> <!--fix of the default css from menu_info_small-->
		<tr /> <!--Make the headers-->
		  <th colspan="2" style="text-align:center;" width="10%"/><h4>Dia</h4>
		  <?php
		      e('<th '.$colspan.' style="text-align:center;" /><h4>'.$filter['concepto'].'</h4>');
		  ?>
		<tr />
		  <td colspan="2" />&nbsp;
		  <?php foreach($fraction as $idFraction => $fractionName){ ?>
		  <td colspan="1" style="text-align:center;font-weight:800;" width="10%" /><?php e($fractionName);?>
		  <?php } ?>

		  <?php
		   foreach($conceptos as $id_concepto => $concepto){

		    if($concepto == $filter['concepto']){
		    foreach($filter[$get_concepto] as $id_dia => $datos){
			e('<tr />');
			if($datos['num_week'] == 7){
			  e('<td style="text-align:left;color:red;" />'.$datos['spanish']);
			  e('<td style="text-align:center;color:red;" />'.$id_dia);
			}else{
			  e('<td style="text-align:left;" />'.$datos['spanish']);
			  e('<td style="text-align:center;" />'.$id_dia);
			}
			
			foreach($fraction as $idFraction => $fractionName){
			
			  if(isset($datos[$fractionName]) AND $datos[$fractionName] > 0 ){
				if($id_concepto == '3'){
				  if(isset($_SESSION['projections']['decimals'])){
					e('<td style="text-align:center;background-color:'.$filter['backgroundColor'][$fractionName].';font-weight:800;" width="10%" />'."\$ ".number_format(money_format('%i',$datos[$fractionName]), 2, '.', ','));
				  }else{
					e('<td style="text-align:center;background-color:'.$filter['backgroundColor'][$fractionName].';font-weight:800;" width="10%" />'."\$ ".number_format(round($datos[$fractionName])));
				  }
				}else{
				  if(isset($_SESSION['projections']['decimals'])){
					e('<td style="text-align:center;background-color:'.$filter['backgroundColor'][$fractionName].';font-weight:800;" width="10%" />'.number_format(money_format('%i',$datos[$fractionName]), 2, '.', ','));
				  }else{
					e('<td style="text-align:center;background-color:'.$filter['backgroundColor'][$fractionName].';font-weight:800;" width="10%" />'.number_format(round($datos[$fractionName])));
				  }
				}
			  }else{
				e('<td style="text-align:center;" width="10%" />&nbsp;');
			  }
			}
			
// 			  if(isset($datos['Granel']) AND $datos['Granel'] > 0 ){
// 				if($id_concepto == '3'){
// 				  if(isset($_SESSION['projections']['decimals'])){
// 					e('<td style="text-align:center;background-color:'.$filter['backgroundColor']['Granel'].';font-weight:800;" width="10%" />'."\$ ".number_format(money_format('%i',$datos['Granel']), 2, '.', ','));
// 				  }else{
// 					e('<td style="text-align:center;background-color:'.$filter['backgroundColor']['Granel'].';font-weight:800;" width="10%" />'."\$ ".number_format(round($datos['Granel'])));
// 				  }
// 				}else{
// 				  if(isset($_SESSION['projections']['decimals'])){
// 					e('<td style="text-align:center;background-color:'.$filter['backgroundColor']['Granel'].';font-weight:800;" width="10%" />'.number_format(money_format('%i',$datos['Granel']), 2, '.', ','));
// 				  }else{
// 					e('<td style="text-align:center;background-color:'.$filter['backgroundColor']['Granel'].';font-weight:800;" width="10%" />'.number_format(round($datos['Granel'])));
// 				  }
// 				}
// 			  }else{
// 				e('<td style="text-align:center;" width="10%" />&nbsp;');
// 			  }if(isset($datos['Envasado']) AND $datos['Envasado'] > 0){
// 				if($id_concepto == '3'){
// 				  if(isset($_SESSION['projections']['decimals'])){
// 					e('<td style="text-align:center;background-color:'.$filter['backgroundColor']['Envasado'].';font-weight:800;" />'."\$ ".number_format(money_format('%i',$datos['Envasado']), 2, '.', ','));
// 				  }else{
// 					e('<td style="text-align:center;background-color:'.$filter['backgroundColor']['Envasado'].';font-weight:800;" />'."\$ ".number_format(round($datos['Envasado'])));
// 				  }
// 				}else{
// 				  if(isset($_SESSION['projections']['decimals'])){
// 					e('<td style="text-align:center;background-color:'.$filter['backgroundColor']['Envasado'].';font-weight:800;" />'.number_format(money_format('%i',$datos['Envasado']), 2, '.', ','));
// 				  }else{
// 					e('<td style="text-align:center;background-color:'.$filter['backgroundColor']['Envasado'].';font-weight:800;" />'.number_format(round($datos['Envasado'])));
// 				  }
// 				}
// 			  }else{
// 				e('<td style="text-align:center;" />&nbsp;');
// 			  }if(isset($datos['Agregados']) AND $datos['Agregados'] > 0){
// 				if($id_concepto == '3'){
// 				  if(isset($_SESSION['projections']['decimals'])){
// 					e('<td style="text-align:center;background-color:'.$filter['backgroundColor']['Agregados'].';font-weight:800;" />'."\$ ".number_format(money_format('%i',$datos['Agregados']), 2, '.', ','));
// 				  }else{
// 					e('<td style="text-align:center;background-color:'.$filter['backgroundColor']['Agregados'].';font-weight:800;" />'."\$ ".number_format(round($datos['Agregados'])));
// 				  }
// 				}else{
// 				  if(isset($_SESSION['projections']['decimals'])){
// 					e('<td style="text-align:center;background-color:'.$filter['backgroundColor']['Agregados'].';font-weight:800;" />'.number_format(money_format('%i',$datos['Agregados']), 2, '.', ','));
// 				  }else{
// 					e('<td style="text-align:center;background-color:'.$filter['backgroundColor']['Agregados'].';font-weight:800;" />'.number_format(round($datos['Agregados'])));
// 				  }
// 				}
// 			  }else{
// 				e('<td style="text-align:center;" />&nbsp;');
// 			  }if(isset($datos['Caja Seca']) AND $datos['Caja Seca'] > 0){
// 				if($id_concepto == '3'){
// 				  if(isset($_SESSION['projections']['decimals'])){
// 					e('<td style="text-align:center;background-color:'.$filter['backgroundColor']['Caja Seca'].';font-weight:800;" />'."\$ ".number_format(money_format('%i',$datos['Caja Seca']), 2, '.', ','));
// 				  }else{
// 					e('<td style="text-align:center;background-color:'.$filter['backgroundColor']['Caja Seca'].';font-weight:800;" />'."\$ ".number_format(round($datos['Caja Seca'])));
// 				  }
// 				}else{
// 				  if(isset($_SESSION['projections']['decimals'])){
// 					e('<td style="text-align:center;background-color:'.$filter['backgroundColor']['Caja Seca'].';font-weight:800;" />'.number_format(money_format('%i',$datos['Caja Seca']), 2, '.', ','));
// 				  }else{
// 					e('<td style="text-align:center;background-color:'.$filter['backgroundColor']['Caja Seca'].';font-weight:800;" />'.number_format(round($datos['Caja Seca'])));
// 				  }
// 				}
// 			  }else{
// 				e('<td style="text-align:center;" />&nbsp;');
// 			  }if(isset($datos['Productos Varios']) AND $datos['Productos Varios'] > 0){
// 				if($id_concepto == '3'){
// 				  if(isset($_SESSION['projections']['decimals'])){
// 					e('<td style="text-align:center;background-color:'.$filter['backgroundColor']['Productos Varios'].';font-weight:800;" />'."\$ ".number_format(money_format('%i',$datos['Productos Varios']), 2, '.', ','));
// 				  }else{
// 					e('<td style="text-align:center;background-color:'.$filter['backgroundColor']['Productos Varios'].';font-weight:800;" />'."\$ ".number_format(round($datos['Productos Varios'])));
// 				  }
// 				}else{
// 				  if(isset($_SESSION['projections']['decimals'])){
// 					e('<td style="text-align:center;background-color:'.$filter['backgroundColor']['Productos Varios'].';font-weight:800;" />'.number_format(money_format('%i',$datos['Productos Varios']), 2, '.', ','));
// 				  }else{
// 					e('<td style="text-align:center;background-color:'.$filter['backgroundColor']['Productos Varios'].';font-weight:800;" />'.number_format(round($datos['Productos Varios'])));
// 				  }
// 				}
// 			  }else{
// 				e('<td style="text-align:center;" />&nbsp;');
// 			  }


		     } // End foreach conceptos
		    } // End toneladas

		   } // End conceptos
		  ?>
	</table>

      </div> <!--End of divCompare update-->

<!-- next	   -->
<!--      <tr />
	<td colspan="14"/>-->
<!-- 	    <div id="ChartWrapper" style="width: 600px; height: 400px;"></div><br /><br /><br /> -->

<!--   </table> -->


  
<!--     <div id='divCompare'>...<?php //include('show_phones.ctp');?></div> -->
    
    