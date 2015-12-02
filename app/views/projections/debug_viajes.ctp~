<?php 
//warning
// pr($warning);
$empresa = array('1'=>'tbk','2'=>'atm','3'=>'teisa');
$area = array('1'=>'Orizaba','2'=>'Guadalajara','3'=>'Ramos Arizpe','4'=>'Mexicali','5'=>'Hermosillo');
$fraccionDesc = array('1'=>'granel','2'=>'Envasado','3'=>'Agregados','4'=>'Caja Seca','5'=>'Productos Varios','6'=>'Clinker');

	header ("Expires: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/vnd.ms-excel");
	header ("Content-Disposition: attachment; filename="."Viajes".".xls" );
	header ("Content-Description: Exported as XLS" );

// pr($warning);exit();
?>

  <table id="<?php e(idTotalIndex);?>">
  
  <th />Empresa
  <th />Area
  <th />fraccion
  <th />Mes
  <th />Dia
  <th />Viaje
  <th />num_guia

<?php 
  foreach($warning as $id_empresa => $areas){
	foreach($areas as $area_name => $month){
	  foreach($month as $month_name => $fracciones){
		foreach($fracciones as $fraction_name => $days){
		  foreach($days as $numDay => $num_guia){
			foreach($num_guia as $cartaPorte => $details){
// 			  if($month_name === 'Nov'){
// 				if($id_empresa == '1'){
?>
	<tr />
	  <td /><?php e($empresa[$id_empresa]);?>
	  <td /><?php e($area_name);?>
	  <td /><?php e($fraction_name);?>
	  <td /><?php e($month_name);?>
	  <td /><?php e($numDay);?>
	  <td /><?php e($cartaPorte);?>
	  <td /><?php e($details);?>
<?php
// 			   }
// 			 }

			}
		  }
		}
	  }
	}
  }
?>


	  <td />
  </table> 
