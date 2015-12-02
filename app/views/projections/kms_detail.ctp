<?php
// pr('KmsDetailView');
?>
 <div id="hide_div" >
 
 <table id="<?php e(idTblHeaders);?>" class="table table-responsive table-bordered">
  <tr />
    <td colspan="14" style="text-align:center;font-size:120%;font-weight:bold;" />
	<?php 
	  if($filter['area'] == false && $filter['flota'] == false){
	    e('Detalle Anual');
// 	    $imageUrl = "thumbs/graph_".$filter['year']."_".$filter['area'].".png";
		$imageUrl = "thumbs/daily/kilometros_".strtolower($_SESSION['Auth']['User']['empresa'])."_".$_SESSION['Auth']['User']['year'].".png";
// 		pr($imageUrl);
// 		pr($filter);
	  }elseif($filter['area'] == true && $filter['flota'] == false){
	    e('Detalle Mensual');
	    $imageUrl = "thumbs/daily/kilometros_".$filter['areaName']."_".$_SESSION['Auth']['User']['year'].".png";
// 				pr($filter);
	  }elseif($filter['flota'] == true && $filter['area'] == true){
	    e('Detalle Mensual '.$filter['fleet_name']);
	    $imageUrl = "thumbs/daily/kilometros_".$filter['areaName']."_".$_SESSION['Auth']['User']['year'].".png";
// 	    		pr($filter);
	  }
	
	
	?>
 </table>
 
  <table id="menu_info_small" class="table table-responsive table-bordered">
    <th colspan="14" style="border-bottom:none;" />
	<span style="float:left;">
		<?php
		  echo $this->Html->link(back,
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
      <tr />
	<td colspan="14" style="text-align:center;background:white;" />
		    <?php 
		      $today = date('Y-m-d');
		      echo $this->Html->link( 
			   $this->Html->image($imageUrl, 
			                array("alt" => "Volver al Inicio",
					      'title' => 'Volver al Inicio',
				              'width' => '820',
				              'height' => '210'
					)
			   ),
					array(
					  'action'=>'index'
// 					  $consulta[$key]['Padre']['id_padre'],
// 					  $date='var'
					) ,
					array('escape' => false),
					null
			);
		    ?>
      <tr />
	<?php
	    e('<th style="text-align:center;" />Fracci&oacute;n');
	    foreach($months as $key => $data){
		e('<th style="text-align:center;" />');
		    e($this->Ajax->link($months[$key]['spanish'],
			array(
			      'controller'=>'projections',
			      'action'=>'DailyReport',
			      'Kilometros',
			      $filter['area'],
			      $months[$key]['short'],
			      $filter['flota']
			),
			array(
			      'escape' => false,
			      "class" => 'link_blue',
			      "update" => "hide_div",
			      "loading" => "Element.hide('hide_div');Element.show('loading');",
			      "complete" => "Element.hide('loading');Effect.Grow('hide_div',{duration: 2.0});",
// 			      'target'=>'_blank',
			      'alt'=>'Detalles Diarios',
			      'title' => 'Detalles Diarios'
			)
			// set msj to confirm
// 			"Are you sure of this??"
		    )
		);
	    }
	    e('<th style="text-align:center;" />Total');
	?>
      
	<?php
	    // firsts reset the control variables
// 	    pr($fraccion);
	    $key = null ; $data = null ;
	    foreach($fraccion as $k => $data){
		e('<tr /><td />'.$data);
		    foreach($months as $ky => $dt){
// 		get the totals for month and fraction
			  if(!empty($kms[$dt['short']][$data])){
				  $num = money_format('%i',$kms[$dt['short']][$data]);
				  if(isset($_SESSION['projections']['decimals'])){
					e('<td style="text-align:center;" />'.number_format($num, 2, '.', ','));
				  }else{
					e('<td style="text-align:center;" />'.number_format(round($num)));
				  }
			  }else{
				  e('<td />&nbsp;');
			  }
		    } // End months
		  if(isset($_SESSION['projections']['decimals'])){
		    e('<td style="text-align:center;" />'.number_format(money_format('%i',$Totales['TotalByFraction'][$data]), 2, '.', ','));
		  }else{
			e('<td style="text-align:center;" />'.number_format(round($Totales['TotalByFraction'][$data])));
		  }
	    } // End Fraction
	    e('<tr /><td colspan="1" style="font-weight:bold;" />Mensual');
	    foreach($months as $key => $value){
		if(!empty($Totales['TotalByMonth'][$value['short']])){
		  if(isset($_SESSION['projections']['decimals'])){
		    e('<td style="text-align:center;font-weight:bold;" />'.number_format(money_format('%i',$Totales['TotalByMonth'][$value['short']]), 2, '.', ','));
		  }else{
			e('<td style="text-align:center;font-weight:bold;" />'.number_format(round($Totales['TotalByMonth'][$value['short']])));
		  }
		}else{
		    e('<td />&nbsp;');
		}
	    }
	    e('<td colspan="1" />&nbsp;');
	    e('<tr /><td colspan="12" />&nbsp;');
	    e('<td colspan="1" style="font-weight:bold;" />TOTAL');
	    if(isset($_SESSION['projections']['decimals'])){
		  e('<td style="text-align:center;font-weight:bold;" />'.number_format(money_format('%i',$Totales['TotalByYear']), 2, '.', ','));
		}else{
		  e('<td style="text-align:center;font-weight:bold;" />'.number_format(round($Totales['TotalByYear'])));
		}
	    
// 	    foreach($fraccion as $k => $data){
// 		e('<tr /><td />'.$data);
// // 		get the totals for month and fraction
// 		foreach($kms as $key => $value){ 
// 		      if(!empty($value[$data])){
// 			$num = money_format('%i',$value[$data]);
// 			e('<td style="text-align:center;" />'.number_format($num, 2, '.', ','));
// 		      }else{
// 			e('<td />&nbsp;');
// 		      }
// 		}
// 	    }
	?>
      
  </table>
  
    </div>
  <div id="loading" style="display:none;">
    <table id="menu_info_small" >
      <tr />
	<th colspan="3" style="background:white;" />Recibiendo Informaci&oacute;n ...
      <tr />
	<td colspan="3" style="background:white;" />&nbsp;
      <tr />
	<td width="40%" style="background:white;" />&nbsp;
	<td style="background:white;" />
	  <?php echo $html->image("loaders/loading.gif"); ?>
	<td width="40%" style="background:white;" />&nbsp;
      <tr />
	<td colspan="3" style="background:white;" />&nbsp;
      <tr />
	<td colspan="3" style="background:white;" />&nbsp;
    </table>
  
  </div>