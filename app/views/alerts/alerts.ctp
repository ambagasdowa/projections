<?php
	//ALERT
?>

	<table>
	  <tr />
		  <td width="35%" />&nbsp;
		  <td />
			<?php
	  /** TODO automate this with the db maybe foreach and equal to we-a-reaver-tomorrow
	  **/
			  if($_SESSION['Auth']['User']['id_empresa'] == '1'){ // id for Bonampak
				e($html->image("backgrounds/bonampak_alpha_small.png",array('width'=>'290','height'=>'220','valign'=>'center')));
			  }if($_SESSION['Auth']['User']['id_empresa'] == '2'){ // id for ATM
				e($html->image("backgrounds/atm_alpha_small.png",array('width'=>'290','height'=>'220','valign'=>'center')));
			  }if($_SESSION['Auth']['User']['id_empresa'] == '3'){ // id for Teisa
				e($html->image("backgrounds/teisa_alpha_small.png",array('width'=>'270','height'=>'290','valign'=>'center')));
			  }
			?>
		  <td width="35%"/>&nbsp;
	</table>