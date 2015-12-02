<?php
//     pr($_SESSION['theme']);
/** @CONFIG **/
// $bootstrap = true;
?>

<?php if($_SESSION['theme']['legacy'] === true) { ?>

<div id="users">
<?php
  if(isset($_SESSION['Auth']['User']['id'])){
?>
<br/><br/><br/><br/>



<fieldset>
	<table >
	  <tr />
		  <td colspan="3" />
				<div id='cssmenu'>
				<ul>
<!--				  <li>
					<a href="<?php e($this->webroot.'projections/')?>" title="Reportes Operativos" alt="Reportes Operativos"><span>Reportes Operativos</span></a>
				  </li>-->
				  <li>
					<a href="<?php e($this->webroot.'projections/')?>" title="Reportes Operativos" alt="Reportes Operativos"><span>Toneladas,Kilometros,Viajes e Ingresos Operativos</span></a>
				  </li>
				  <?php
					if(isset(userConfig()[$_SESSION['Auth']['User']['email']]['viewMenu'])){
							$emailPermissions = userConfig()[$_SESSION['Auth']['User']['email']]['viewMenu'];
					}
					if(isset($emailPermissions['dropIndicadores']) and $emailPermissions['dropIndicadores'] === false){
				  ?>
				 <li>
					<a href="<?php e($this->webroot.'indicadores/')?>" title="Indicadores" alt="Indicadores"><span>Indicadores</span></a>
				 </li>
				  <?php
					}
				  ?>
				  
				  <?php
					if(isset($emailPermissions['dropIndicadores']) and $emailPermissions['dropCostos'] === false){
				  ?>
				  <li>
					<a href="<?php e($this->webroot.'MssqlPresupuestoAtm/')?>" title="Costos" alt="Costos"><span>Costos</span></a>
				  </li>
				  <?php
					}
				  ?>
				  
				  <?php
					if(isset($emailPermissions['dropIndicadores']) and $emailPermissions['dropFlujo'] === false){
				  ?>
				  <li>
					<a href="<?php e($this->webroot.'search/#openModal')?>" title="Flujo" alt="Flujo"><span>Flujo</span></a>
				  </li>
				  <?php
					}
				  ?>
				  
<!--				  <li>
					<a href="<?php e($this->webroot.'indicadores/')?>" title="Indicadores" alt="Indicadores"><span>Indicadores</span></a>
				  </li>
				  <li>
					<a href="<?php e($this->webroot.'MssqlPresupuestoAtm/')?>" title="Costos" alt="Costos"><span>Costos</span></a>
				  </li>-->
<!--				  <li class='active has-sub'><a href='#'><span>Products</span></a>
					  <ul>
						<li class='has-sub'><a href='#'><span>Product 1</span></a>
							<ul>
							  <li><a href='#'><span>Sub Product</span></a></li>
							  <li class='last'><a href='#'><span>Sub Product</span></a></li>
							</ul>
						</li>
						<li class='has-sub'><a href='#'><span>Product 2</span></a>
							<ul>
							  <li><a href='#'><span>Sub Product</span></a></li>
							  <li class='last'><a href='#'><span>Sub Product</span></a></li>
							</ul>
						</li>
					  </ul>
				  </li>

				  <li class='last'><a href='#'><span>Contact</span></a></li>-->
				</ul>
				</div>
	</table>
    <table border="0" align="center" height="300px" id="<?php e(idTotalIndex);?>" >
<!--        <tr>
            <td align="center"><h3><a href="<?php e($this->webroot.'projections/')?>" class="logout" title="Projecciones" alt="projecciones">Proyecciones</a> <br/></h3></td>
			
            <td style="text-align:center;display:none;"><h3><a href="<?php e($this->webroot.'search/#openModal')?>" class="logout" title="Projecciones" alt="projecciones">Flujo</a> <br/></h3></td>
            <td width="1%"/>&nbsp;
        </tr>-->

        <tr>
            <td colspan="3" align="center">
				<?php 
// 					  echo $html->image("backgrounds/bonampak_alpha_small.png",
// 													  array('title'=>'Proyecciones',
// 															'alt'=>'Proyecciones',
// 															'width'=>'320',
// 															'height'=>'380')
// 													  );
													  
			  if($_SESSION['Auth']['User']['id_empresa'] == '1'){ // id for Bonampak
					  echo $html->image("backgrounds/tbk.png",
													  array('title'=>'Proyecciones',
															'alt'=>'Proyecciones',
															'width'=>'300',
															'height'=>'180')
													  );
			  }if($_SESSION['Auth']['User']['id_empresa'] == '2'){ // id for ATM
					  echo $html->image("backgrounds/atm.png",
													  array('title'=>'Proyecciones',
															'alt'=>'Proyecciones',
															'width'=>'310',
															'height'=>'180')
													  );
			  }if($_SESSION['Auth']['User']['id_empresa'] == '3'){ // id for Teisa
					  echo $html->image("backgrounds/tei.png",
													  array('title'=>'Proyecciones',
															'alt'=>'Proyecciones',
															'width'=>'270',
															'height'=>'230')
													  );
			  }
				?>
            </td>

        </tr>
    </table>
</fieldset>

<?php
  }
?>
</div>

<?php }else if($_SESSION['theme']['protoquery'] === true) { ?>

<?php if(isset($_SESSION['Auth']['User']['id'])){ ?>

    
	<div id="row" >
	
	</div>
	
    <table border="0" align="center" height="300px" id="<?php e(idTotalIndex);?>" >

        <tr>
            <td colspan="3" align="center">
				<?php 

			  if($_SESSION['Auth']['User']['id_empresa'] == '1'){ // id for Bonampak
// 					  echo $html->image("backgrounds/tbk.png",
// 													  array('title'=>'Proyecciones',
// 															'alt'=>'Proyecciones',
// 															'width'=>'300',
// 															'height'=>'180')
// 													  );
					  echo $html->image("backgrounds/gst.png",
													  array('title'=>'Proyecciones',
															'alt'=>'Proyecciones',
															'width'=>'400',
															'height'=>'180')
													  );
			  }if($_SESSION['Auth']['User']['id_empresa'] == '2'){ // id for ATM
// 					  echo $html->image("backgrounds/atm.png",
// 													  array('title'=>'Proyecciones',
// 															'alt'=>'Proyecciones',
// 															'width'=>'310',
// 															'height'=>'180')
// 													  );
					  echo $html->image("backgrounds/gst.png",
													  array('title'=>'Proyecciones',
															'alt'=>'Proyecciones',
															'width'=>'400',
															'height'=>'180')
													  );
			  }if($_SESSION['Auth']['User']['id_empresa'] == '3'){ // id for Teisa
// 					  echo $html->image("backgrounds/tei.png",
// 													  array('title'=>'Proyecciones',
// 															'alt'=>'Proyecciones',
// 															'width'=>'270',
// 															'height'=>'230')
// 													  );
					  echo $html->image("backgrounds/gst.png",
													  array('title'=>'Proyecciones',
															'alt'=>'Proyecciones',
															'width'=>'400',
															'height'=>'180')
													  );
			  } else if($_SESSION['Auth']['User']['id_empresa'] == '4') {
					  echo $html->image("backgrounds/gst.png",
													  array('title'=>'Proyecciones',
															'alt'=>'Proyecciones',
															'width'=>'400',
															'height'=>'180')
													  );
			  }
				?>
            </td>

        </tr>
    </table>

<?php } ?>

<?php } //End Theme ?>



