<?php //Viajes.ctp ?>
<?php 
//  date('n') => Representación numérica de un mes, sin ceros iniciales 1 hasta 12
	if($_SESSION['Auth']['User']['year'] < date('Y')){
	  $numMonth = '12';
	}else{
	  $numMonth = date('n');
	}
// 					  $_SESSION['Auth']['User']['year']
?>
      <table id="<?php e(idTotalIndex);?>" >
	    <tr />
		<td width="520" style="text-align:center;" />
<!-- 		    this is going to update -->
<!-- 		    <div id="divArea"> -->
			
			<table id="<?php e(idTotalIndex);?>" class="table table-responsive">
			  <tr />
			    <td height="140" style="text-align:center;font-size:180%;" />
					<?php 
					  if($AreaCorp['Area'] == 'Tijuana'){
						e('Mexicali');
					  }else{
						e($AreaCorp['Area']);
					  }
					?>
			      <br />
				<p style="text-align:center;font-size:160%;">
				  <?php
					if(isset($_SESSION['projections']['decimals'])){
					  e(number_format($AreaCorp['TotalMes'], 2, '.', ','));
					}else{
					  e(number_format(round($AreaCorp['TotalMes'])));
					}
				  ?>
				</p><?php e($AreaCorp['months'][$numMonth]['spanish']);?>
			  <tr />
			    <td id="<?php e(idDateBottom);?>" />
			      <?php e(date('Y-m-d'));?>
			  <tr />
			    <td style="text-align:center;" />

			</table>

		<td colspan="2" style="text-align:center;" />
		    <?php 
		      $today = date('Y-m-d');
		      echo $this->Html->link( 
			   $this->Html->image("thumbs/daily/viajes_".$AreaCorp['Area']."_".$numMonth."_".$_SESSION['Auth']['User']['year'].".png", 
			                array("alt" => "Detalles",
					      'title' => 'Detalles',
				              'width' => '680',
				              'height' => '210'
					)
			   ),
					array(
					  'action'=>'ViajesDetail',
					  $year=$_SESSION['Auth']['User']['year'],
					  $AreaCorp['id_area'],
					  $AreaCorp['fraccion'],
					  $AreaCorp['flota']= '0'
					) ,
					array('escape' => false),
					null
			);
		    ?>
		<span style="float:right;margin-top:10px;">
		<?php
// 		  e($flt[$key][0]);
		  echo $this->Html->link(detalles,
					array(
					  'action'=>'ViajesDetail',
					  $year=$_SESSION['Auth']['User']['year'],
					  $AreaCorp['id_area'],
					  $AreaCorp['fraccion'],
					  $AreaCorp['flota']= '0'
					) ,
					array(
					    'class'=>'button_link',
					    'title'=>'Ver Detalle de las Flotas',
					    'alt'=>'Ver Detalles de las Flotas'
					)
				    );
		?>
		</span>
    
	  </table>
	  
	  <?php if($_SESSION['Auth']['User']['id_empresa'] > '1' OR ( $_SESSION['Auth']['User']['id_empresa'] === '1' AND $AreaCorp['id_area'] === '2')) { ?>
   <table id="<?php e(idTotalIndex);?>" class="table table-responsive">
	  <td style="text-align:center;font-size:12px;font-variant:small-caps;"/>
		  <a href="#" class="btn btn-default" role="button" onclick="Effect.toggle('detallesFlotasViajes', 'appear'); return false;">
			&#9660; Flotas &#9660;
		  </a>
  </table>
  <div id="detallesFlotasViajes" style="display:none;">
  
	    <?php $idx=1;?>
	  <table id="<?php e(idTotalIndexGray);?>" >
<!-- 	    work from hir -->
	    <?php
	      $fleet = $fleets['fleet'][$AreaCorp['id_area']];

	      foreach($fleet as $key => $data){
		$flt[$key] = explode(',',$data);
		$ftl_back = $flt;
		unset($ftl_back[$key]['0']);
		$comma_separated = implode(",", $ftl_back[$key]);
	    ?>
	      <tr />
		<td /><?php e($idx++); ?>
		<td colspan="2" style="text-align:left;" width="2%"/>
		    <?php 
		      $today = date('Y-m-d');
		      echo $this->Html->link( 
			   $this->Html->image("icons/bonampak.png", 
			                array("alt" => "Detalles de Las Flotas",
					      'title' => 'Detalles de Las Flotas',
				              'width' => '14',
				              'height' => '14'
					)
			   ),
					array(
					  'action'=>'ViajesDetail',
					  $year=$_SESSION['Auth']['User']['year'],
					  $AreaCorp['id_area'],
					  $AreaCorp['fraccion'],
					  $AreaCorp['flota']= $comma_separated
					) ,
					array('escape' => false),
					null
			);
// 			e($AreaCorp['flota']= $flt[$key][0]);
		    ?>
	      <td />
		<?php
		  if(trim($flt[$key][0]) === 'TIJUANA'){
			$flota = 'MEXICALI';
		  }else{
			$flota = $flt[$key][0];
		  }
		  echo $this->Html->link($flota,
					array(
// 					  'title'=>'test',
					  'action'=>'ViajesDetail',
					  $year=$_SESSION['Auth']['User']['year'],
					  $AreaCorp['id_area'],
					  $AreaCorp['fraccion'],
					  $AreaCorp['flota']= $comma_separated,
					  $AreaCorp['fleet_name'] = $flt[$key][0]
					),
					array(
					    'title'=>'Ver Detalle de las Flotas',
					    'alt'=>'Ver Detalles de las Flotas'
					)
				    );
		?>
	      <?php  
	      } // End foreach
	    ?>


	  </table>
		<?php }?>
	  <?php //echo $this->Html->link('Borrar', array('action' => 'delete', $phones[$key]['Phones']['id']), null, 'Estas seguro?' );?>