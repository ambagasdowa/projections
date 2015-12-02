<?php
//   var_dump($edit);
//   var_dump($empresas);
// 	 var_dump($this->params['url']);
// 	 var_dump($_SESSION['Auth']['User']);
  if(isset($edit)){
	$msg='Editar ';
	if(isset($this->params['url']['chpass']) and !empty($this->params['url']['chpass'])){
	  $_SESSION['Auth']['User']['chpass'] = $this->params['url']['chpass'];
	}
  }else{
	$msg = 'Nuevo ';
  }
//   var_dump($_SESSION['Auth']['User']);
?>
<table id="menu_info_small">
  <tr />
	  <td /><h4><?php e($msg);?> Usuario</h4>
</table>

<?php
echo $form->create('User');
// $authUsers = array('0' => 'Good','2'=>'Atm-Tbk','3'=>'Teisa-Tbk' ,'7' => 'Human');
// $status = array('Active' => 'Activo', 'Inactive' => 'Inactivo');
echo $form->hidden('id');
?>
<table id="menu_info_small">
     <tr />
        <td />Usuario:
        <td /><?php echo $form->input('User.username',array('type'=>'text',"label"=>false,'class'=>'user_txt_login')); ?>
    
     <tr />
        <td />Contraseña:
        <td /><?php echo $form->input('User.clear_password', array('type' => 'password', "label"=>false,'class'=>'user_txt_pass')); ?>
    
     <tr />
        <td />Repetir:
        <td /><?php echo $form->input('User.confirm_password', array('type' => 'password',"label"=>false,'class'=>'user_txt_pass'));?>
    
    <tr />
        <td />Nombre:
        <td /><?php echo $form->input('User.first_name',array('type'=>'text',"label"=>false,'class'=>'user_txt_login')); ?>
    
    <tr />
        <td />Apellido:
        <td /><?php echo $form->input('User.last_name',array('type'=>'text',"label"=>false,'class'=>'user_txt_login')); ?>
    
    <tr />
        <td />Correo:
        <td /><?php echo $form->input('User.email',array('type'=>'text',"label"=>false,'class'=>'user_txt_mail')); ?>
     <tr />
        <td />Tema:
        <td /><?php echo $form->input('User.id_theme',array('type'=>'text',"label"=>false,'class'=>'user_txt_login')); ?>
    <tr />
        <td />Nivel de Autorizaci&oacute;n:
        <td />
			<?php
				if($_SESSION['Auth']['User']['level'] !== '0'){
				  echo $form->input('User.nivel',
									array('type'=>'text',
										  "label"=>false,
//										  'empty'=>'Select',
										  'disabled'=>true,
										  'value' => $authUsers[$_SESSION['Auth']['User']['level']]
										  )
									);
				  echo $form->input('User.level',
									array('type'=>'hidden',
										  "label"=>false,
										  'value' => $_SESSION['Auth']['User']['level']
										  )
									);
					if(isset($this->params['url']['chpass'])){
					  echo $form->input('User.chpass',
										array('type'=>'hidden',
											  "label"=>false,
											  'value' => $this->params['url']['chpass']
											  )
										);
					}
				}else{
				  echo $form->input('User.level',
									array('type' =>'select',
										  "label"=>false,
										  'empty'=>'Select',
										  'options' => $authUsers
									)
					  );
					  e($ajax->observeField('UserLevel',
								  array("url"=>array("controller"=>"Users",
													"action"=>"ShiftCorporation"
											  ),
  // 									  "loading" => "Element.hide('hide');Element.show('waiting');",
  // 									  "after" => "Effect.Grow(reloading(),{duration: 2.0});",
  // 									  "complete" => "reloading();",
										'update'=>'divShiftEmpresa',
								  )
							  )
					  );
				}
			?>
			
    <tr />
        <td />Empresa:
        <td />
			<div id="divShiftEmpresa">
				<?php
				    if(isset($edit)){
// 					  echo $form->input('User.id_empresa',
// 										array('type'=>'select',
// 											  "label"=>false,
// 											  'empty'=>'Select',
// 											  'options' => $empresas
// 										)
// 						  );
					  echo $form->input('User.id_empresa',
										array('type'=>'hidden',
											  "label"=>false,
// 											  'empty'=>'Select',
											  'value' => $_SESSION['Auth']['User']['id_empresa']
										)
						  );
					  echo $form->input('User.empresa',
										array('type'=>'text',
											  "label"=>false,
// 											  'empty'=>'Select',
											  'disabled'=>true,
											  'value' => $empresa
										)
						  );
					}else{
					  echo $form->input('User.id_empresa',
										array('type'=>'text',
											  "label"=>false,
// 											  'empty'=>'Select',
											  'disabled'=>true,
// 											  'options' => $empresas
										)
						  );
					}
				?>
			</div>

    <tr />
        <td />Estatus:
        <td /><?php echo $form->input('User.status', array('type'=>'select',"label"=>false,'class'=>'user_txt_check' ,'options' => $status)); ?>

    <tr />
	<td />
			<?php
			  echo $html->link(' Cancelar ',
								array('action' => 'index'),
								array('class' => 'button_link')
					);
			?>
    <td style="text-align:right;" />
			<?php 
				e($form->button($msg,array('class'=>'button_blue')));
			?>
						<?php 
// 								echo $form->submit('Agregar',
// 									array('class' => 'submit_blue',
// 										  'after' => ' '.$html->link('Cancel',
// 																		array('action' => 'index'),
// 																		array('class' => 'button_link')
// 														  )
// 									)
// 								);
						?>

</table>

<?php
echo $form->end();
?>
