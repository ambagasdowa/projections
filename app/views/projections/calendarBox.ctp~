<?php
//	calendarBox.ctp
//	var_dump(checkBrowser($_SERVER['HTTP_USER_AGENT']));
?>

<?php
	$params = implode(array_map('ucwords',explode('_',$paramA)));
?>

  <?php
	if(checkBrowser($_SERVER['HTTP_USER_AGENT']) === TRUE){
  ?>

<?php
	e($ajax->form(array("type"=>"post",
						"options"=>array("model"=>$control,
						"update"=>$update,
						"url"=>array("controller"=>$control,"action"=>$action),
								  )
						)
				  )
	);
  
?>

<table id="<?php e(idTotalIndex);?>">
  <tr />
	  <td /><?php e($calTitle);?>
	  <td widht="40%"/>
		<?php
					e($this->Form->text($control.'.'.$paramA, // in this case must be equal to Projections.id_mes
										  array('type' => 'text',
											'label'=>false,
											'class'=>'form-control',
											'value'=>''
											)
										)
					);
		?>
	  <td width="10%"/>&nbsp;

</table>

<script type="text/javascript" >
  <?php e(setDatepicker($fieldname="data[$control][$params]",$fieldid=$control.$params,$keepFieldEmpty=true)); //params = IdMes ?>
</script>

<?php
	e($form->button('Buscar',array('class'=>'button_blue')));
?>

<?php }else{ ?>

<table id="<?php e(idTotalIndex);?>">
  <tr />
	  <td /><?php e($calTitle);?>
	  <td widht="40%"/>
	  <?php
			e($this->Form->text($control.'.'.$paramA,
				    array('type' => $calType,
					  'label'=>false,
					  'class'=>'form-control',
					  'value'=>date('Y-m-d'),
					  'dateFormat' => 'DMY',
					  'min' => '2010-08-14',
					  'max' => '2036-12-31',
					  'separator'=>'/',
// 					  "onKeyPress"=>"return soloNumeros(event)",
					  'placeholder'=>'Buscar registro => Ingresa Fecha en formato (yy-mm-dd) (alt+shift+b)'
					 )
				     )
			);
			e($ajax->observeField($control.$params,
						  array("url"=>array("controller"=>$control,
								"action"=>$action,
									  ),
								"update" => $update,
						  )
				  )
			);
	  ?>
	  <td width="10%"/>&nbsp;

</table>

<?php }?>

<?php e($form->end());?>