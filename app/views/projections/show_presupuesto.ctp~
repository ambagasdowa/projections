<?php
	    e($ajax->form(array("type"=>"post",
							"options"=>array("model"=>"Projections",
							"update"=>"divPresupuesto",
							"url"=>array("controller"=>'Projections',"action"=>"savePresupuesto"),
							)
                     )
               )
	    );

		if(isset($dateMonth)){
			echo $this->Form->input('Date.year',
						array('type'=>'hidden',
							  'label'=>false,
							  'value'=>$dateMonth['year'],
							  'class'=>''
						)
				);
			echo $this->Form->input('Date.month',
						array('type'=>'hidden',
							  'label'=>false,
							  'value'=>$dateMonth['month'],
							  'class'=>''
						)
				);
		}else{//CHECK This
			echo $this->Form->input('Date.year',
						array('type'=>'hidden',
							  'label'=>false,
							  'value'=>date('Y'),
							  'class'=>''
						)
				);
			echo $this->Form->input('Date.month',
						array('type'=>'hidden',
							  'label'=>false,
							  'value'=>date('m'),
							  'class'=>''
						)
				);
		}
?>

<table id="menu_info_small" >

<?php
	foreach($flotas['description'] as $idArea => $flotasDesc){
?>
<?php
		foreach($flotasDesc as $areaName => $flotasContents){
?>
	<tr />
	  <td /><?php e($idArea);?>
	  <td colspan="2" width="50%"/><?php e($areaName);?>
<?php
// 			$idx=0;
			foreach($flotasContents as $idFlotaName => $flotaName){
?>
	  <tr />
	  <td /><?php e($idFlotaName);?>
	  <td width="50%"/><?php e($flotaName);?>
	  <td width="50%"/><?php //e($flotaName);?>
						<?php 
							if(isset($flotas['presupuesto'][$idArea][$areaName][$idFlotaName][$flotaName]['id_presupuesto'])){
							  $id_presupuesto = $flotas['presupuesto'][$idArea][$areaName][$idFlotaName][$flotaName]['id_presupuesto'];
							echo $this->Form->input('Presupuesto.'.$idFlotaName.'.id_presupuesto',
										array('type'=>'hidden',
											  'label'=>false,
// 											  'placholder'=>'',
											  'value'=>$id_presupuesto,
											  'class'=>''
											  
										)
								);
							}
							echo $this->Form->input('Presupuesto.'.$idFlotaName.'.id_empresa',
										array('type'=>'hidden',
											  'label'=>false,
											  'placholder'=>'',
											  'value'=>$_SESSION['Auth']['User']['id_empresa'],
											  'class'=>''
											  
										)
								);
								
// 							echo $this->Form->input('Presupuesto.'.$idx.'.id_empresa',
// 										array('type'=>'hidden',
// 											  'label'=>false,
// 											  'placholder'=>'',
// 											  'value'=>$_SESSION['Auth']['User']['id_empresa'],
// 											  'class'=>''
// 											  
// 										)
// 								);
							if(!empty($flotas['presupuesto'][$idArea][$areaName][$idFlotaName][$flotaName]['presupuesto']) and isset($flotas['presupuesto'][$idArea][$areaName][$idFlotaName][$flotaName]['presupuesto'])){
							  $presupuestoData = $flotas['presupuesto'][$idArea][$areaName][$idFlotaName][$flotaName]['presupuesto'];
							echo $this->Form->input('Presupuesto.'.$idFlotaName.'.presupuesto',
										array('type'=>'text',
											  'label'=>false,
											  'placholder'=>$flotaName,
											  'value'=>$presupuestoData,
											  'class'=>''
										)
								);
							}else{
// 							  $presupuestoData = null;
							echo $this->Form->input('Presupuesto.'.$idFlotaName.'.presupuesto',
										array('type'=>'text',
											  'label'=>false,
											  'placholder'=>$flotaName,
											  'value'=>'',
											  'class'=>''
										)
								);
							}
							
// 							echo $this->Form->input('Presupuesto.'.$idFlotaName.'.presupuesto',
// 										array('type'=>'text',
// 											  'label'=>false,
// 											  'placholder'=>$flotaName,
// 											  'value'=>$presupuestoData,
// 											  'class'=>''
// 										)
// 								);
// 							}

							echo $this->Form->input('Presupuesto.'.$idFlotaName.'.id_area',
										array('type'=>'hidden',
											  'label'=>false,
// 											  'placholder'=>$flotaName,
											  'value'=>$idArea,
											  'class'=>''
											  
										)
								);
							echo $this->Form->input('Presupuesto.'.$idFlotaName.'.area',
										array('type'=>'hidden',
											  'label'=>false,
// 											  'placholder'=>$flotaName,
											  'value'=>$areaName,
											  'class'=>''
											  
										)
								);
							echo $this->Form->input('Presupuesto.'.$idFlotaName.'.unidadNegocio',
										array('type'=>'hidden',
											  'label'=>false,
// 											  'placholder'=>$flotaName,
											  'value'=>$flotaName,
											  'class'=>''
											  
										)
								);
							echo $this->Form->input('Presupuesto.'.$idFlotaName.'.id_flota',
										array('type'=>'hidden',
											  'label'=>false,
// 											  'placholder'=>$flotaName,
											  'value'=>$idFlotaName,
											  'class'=>''
											  
										)
								);
						if(isset($dateMonth)){
							echo $this->Form->input('Presupuesto.'.$idFlotaName.'.year',
										array('type'=>'hidden',
											  'label'=>false,
// 											  'placholder'=>$flotaName,
											  'value'=>$dateMonth['year'],
											  'class'=>''
											  
										)
								);
							echo $this->Form->input('Presupuesto.'.$idFlotaName.'.month',
										array('type'=>'hidden',
											  'label'=>false,
// 											  'placholder'=>$flotaName,
											  'value'=>$dateMonth['month'],
											  'class'=>''
											  
										)
								);
						}
						?>
	  <td style="text-align:right;background-color:white;" />
		<label name="data[Presupuesto][<?php e($idArea); ?>]" 
			class="switch switch-green"
			accesskey="A"
		  > <!--end label-->

		  <input name="data[Presupuesto][<?php e($idArea);?>]"
			type="checkbox"
			class="switch-input"
			value=<?php e($idFlotaName);?>
			<?php
// 			  if($realms_class == 'Active'){
// 				e($checked="checked");
// 			  }
			?>
		  > <!--end input-->
		  <span class="switch-label"
			data-on="on"
			data-off="off">
		  </span>
		</label>
<?php
// 			$idx++;
			}
?>
<?php
		}
?>
<?php
	} // End's foreach flota
// 	exit();
?>

</table>

<div style="text-align:right;">
<?php
	e($form->button('Guardar',array('class'=>'button_blue')));
	e($form->end());
?>
</div>