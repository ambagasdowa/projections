<?php 
//     pr($_SESSION);
	$theme = 'black/';
	$theme = '';//default

	
	$link = 'login';
	if(isset($_SESSION['Auth']['User']['id'])){
		$link = 'logout';
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
date_default_timezone_set('America/Mexico_City');
// $msi6 = strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
<?php echo $this->Html->charset();?>
<title><?php echo $title_for_layout?></title>
<link rel="shortcut icon" href="icons/favicon.ico" type="image/x-icon">
<!-- Include external files and scripts here (See HTML helper for more info.) -->
<?php 
// e($this->Html->css('win2k/win2k', 'stylesheet')); 
$this->Session->activate();

	if( isset($_SESSION['theme']['legacy']) and $_SESSION['theme']['legacy'] === true) {
		e($this->Html->css($theme.'default_dark', 'stylesheet')); 
		e($this->Html->css($theme.'tables', 'stylesheet')); 
		e($this->Html->css($theme.'BlueLogin', 'stylesheet'));
		e($this->Html->css($theme.'switch', 'stylesheet'));
		e($this->Html->css($theme.'button_blue', 'stylesheet'));
		e($this->Html->css($theme.'button_gray', 'stylesheet'));
		e($this->Html->css($theme.'user', 'stylesheet'));
		e($this->Html->css($theme.'BlueLink', 'stylesheet'));
		e($this->Html->css($theme.'link_blue', 'stylesheet'));
		e($this->Html->css($theme.'menu', 'stylesheet'));
		e($this->Html->css($theme.'table', 'stylesheet'));
		e($this->Html->css($theme.'modal_window_css3', 'stylesheet'));
		e($this->Html->css($theme.'select', 'stylesheet'));
		e($this->Html->css($theme.'gh-buttons', 'stylesheet'));
		e($this->Html->css($theme.'topo', 'stylesheet'));
		e($this->Html->css($theme.'cssmenu', 'stylesheet'));
	}
?>
  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
  <![endif]-->

<?php


// tabbing files 
e($this->Html->script('simpletabs_1.3.packed.js'));
e($this->Html->css($theme.'simpletabs'));
//tabbing wrapped
e($this->Html->script('simpletabs_1.3.js'));
e($this->Html->css($theme.'simpletab'));

// we can omit this two and use protoculous instead
// e($this->Html->script('scriptaculous'));
e($this->Html->script('prototype'));
setlocale(LC_MONETARY, 'es_MX');

e($this->Html->script('modal.js'));
// carousel required files for awesone carousel
e($this->Html->script('protoculous.js'));
e($this->Html->css($theme.'carousel'));
e($this->Html->script('carousel.js'));

/**From cyberio data
*/
// e($this->Html->css('jscal2', 'stylesheet'));

e($this->Html->script('scriptaculous.js?load=effects'));

e($this->Html->script('livepipe'));
e($this->Html->script('prototabs'));
e($this->Html->css($theme.'prototabs'));
// e($this->Html->script('ajaxManual'));
// e($this->Html->script(array('jscal2', 'lang/es')));

// echo $javascript->link('jquery-1.6.1.min.js');
// e($this->Html->script('jquery-1.6.1.min.js'));


// e($this->Html->script('jquery.js'));
// e($this->Html->script('jquery.chrony.js'));

/** NOTE set the datepicker for other than chrome based
 * 
 */
e($this->Html->script('datepicker'));
	
	if(isset($_SESSION['theme']['legacy']) and $_SESSION['theme']['legacy'] === true) {
		e($this->Html->css($theme.'datepicker', 'stylesheet'));
	

/**
*/

/** Module: Control de unidades en servicio
 *
**/ 
		e($this->Html->css($theme.'headers', 'stylesheet'));
/**
  End of Module
**/
	}

/** @WORKAROUND for @jquery AND @bootstrap **/
/** NOTE @begin->devoops */
$theme = 'devoops/';
/** @css **/
	/** @font-awesome */
	e($this->Html->css($theme.'devoops/font-awesome.min.css', 'stylesheet'));
	
	if(isset ($_SESSION['theme']['protoquery']) and $_SESSION['theme']['protoquery'] === true) {
		e($this->Html->css($theme.'bootstrap/bootstrap', 'stylesheet'));
		e($this->Html->css($theme.'jquery/jquery-ui', 'stylesheet'));
		e($this->Html->css('projections/style', 'stylesheet')); // local style
	}
/** @require*/
		e($this->Html->script($theme.'require/require'));
// e($this->Html->script($theme.'devoops/devoops'));


	/** ALERT @build this function with php and set the libs with an array **/
?>
<script>
require.config({
    baseUrl: './',
    paths: {
		'jquery': "<?php e($this->webroot.'js/devoops/jquery/jquery.min');?>",
        'bootstrap': "<?php e($this->webroot.'js/devoops/bootstrap/bootstrap.min');?>"
    },
    shim: {
        'bootstrap': ['jquery']
    },
    map: {
        '*': {
            'jquery': 'jQueryNoConflict'
        },
        'jQueryNoConflict': {
            'jquery': 'jquery'
        }
    }
});
define('jQueryNoConflict', ['jquery'], function ($) {
    return $.noConflict();
});
if (Prototype.BrowserFeatures.ElementExtensions) {
    require(['jquery', 'bootstrap'], function ($) {
        // Fix incompatibilities between BootStrap and Prototype
        var disablePrototypeJS = function (method, pluginsToDisable) {
                var handler = function (event) {  
                    event.target[method] = undefined;
                    setTimeout(function () {
                        delete event.target[method];
                    }, 0);
                };
                pluginsToDisable.each(function (plugin) { 
                    $(window).on(method + '.bs.' + plugin, handler); 
                });
            },
            pluginsToDisable = ['collapse', 'dropdown', 'modal', 'tooltip', 'popover', 'tab'];
        disablePrototypeJS('show', pluginsToDisable);
        disablePrototypeJS('hide', pluginsToDisable);
    });
}
</script>

<script type="text/javascript">
  function reloading(){
	window.location='/projections/';
  }
</script>

<?php
/** NOTE @ends->devoops */
/** @WORKAROUND for @jquery AND @bootstrap **/
?>

<?php echo $scripts_for_layout ?>
<?php
/**
Script for the counter stuff
*/
?>


<?php
/**
End of the script
*/

?>

</head>

<body>
<!-- If you'd like some sort of menu to
show up on all of your views, include it here -->
<?php 	if(isset($_SESSION['theme']['legacy']) and $_SESSION['theme']['legacy'] === true) { ?>

<div id="header">
	<table id="<?php e(idTotalIndex);?>">
<!-- 	<table id="<?php e(idTblHeaders);?>"> -->
<!-- 	  <tr> -->
		<td width="10%">
		<?php 
// 	  		pr($_SESSION);
			if(!isset($_SESSION['Auth']['User']['id_empresa'])){
// 			  e($html->image("backgrounds/gst.png",array('width'=>'120','height'=>'64','valign'=>'center')));
// 			  e($html->image("icons/glade.png",array('width'=>'64','height'=>'64','valign'=>'center')));
			}else{
	  
	  /** TODO automate this with the db maybe foreach and equal to we-a-reaver-tomorrow
	  **/
			if($_SESSION['Auth']['User']['id_empresa'] == '1'){ // id for Bonampak
			  e($html->image("backgrounds/tbk.png",array('width'=>'120','height'=>'64','valign'=>'center')));
			}if($_SESSION['Auth']['User']['id_empresa'] == '2'){ // id for ATM
			  e($html->image("backgrounds/atm.png",array('width'=>'120','height'=>'64','valign'=>'center')));
			}if($_SESSION['Auth']['User']['id_empresa'] == '3'){ // id for ATM
			  e($html->image("backgrounds/tei.png",array('height'=>'64','valign'=>'center')));
			}
		  }
	?>
      </td>
	  <td width="20%" />
	  <td width="5%">
		  <?php 
			$link = 'login';
			if(isset($_SESSION['Auth']['User']['id'])){
			  $link = 'logout';
			}else{
			  e('');
			}
		  ?>
      </td>

      <?php 
		  if(isset($_SESSION['Auth']['User']['id'])){ ?>

      <td width="25%" >
		<center>
<!-- 		  <h2> -->
			<a href="<?php e($this->webroot)?>">
				<?php
// 					e($html->image("backgrounds/gst.png",array('width'=>'120','height'=>'68','valign'=>'center'))); 
				?>
			</a>
<!-- 		  </h2> -->
		</center>
	  </td>
      
      <td valign="middle">
		  <?php 
			  e($html->image("icons/user-4.png",array("width"=>"24","height"=>"24",'id'=>'...')));
		  ?>
	  </td>
	  
      <td valign="middle">
		  <?php 
			  e($_SESSION['Auth']['User']['first_name'].' '.$_SESSION['Auth']['User']['last_name']);
		  ?>
	  </td>

	  <td>
		  <?php
		      echo $this->Html->link('Salir '.
			   $this->Html->image("icons/logout.png",
			                array('alt' => "Salir",
								  'title' => 'Salir',
								  'width' => '22',
								  'height' => '22'
					)
			   ),
					array(
					  'controller'=>'Users',
					  'action'=>$link
// 					  'Reporte de Flujo',
// 					  "ReporteFlujo-".date('Y-m-d'),
// 					  "export_flujo"
					) ,
					array('escape' => false),
					null
			);
		  ?>
		  </td>
	  
      <td valign="middle">
	    <?php
// 			e($html->image("backgrounds/gst.png",array('width'=>'120','height'=>'68','valign'=>'center')));
// 			e($html->image("icons/xhome.png",array('width'=>'64','height'=>'64','valign'=>'center')));

		      echo $this->Html->link(
			   $this->Html->image("icons/xhome.png",
			                array('alt' => "Pagina Principal",
								  'title' => 'Pagina Principal',
								  'valign'=>'center',
								  'width' => '48',
								  'height' => '48'
					)
			   ),
					array(
					  'controller'=>'.',
// 					  'action'=>$link
// 					  'Reporte de Flujo',
// 					  "ReporteFlujo-".date('Y-m-d'),
// 					  "export_flujo"
					) ,
					array('escape' => false),
					null
			);
		  ?>
      </td>

      <?php 
	    }else{
      ?>
	  <td>
		<center>
<!-- 		  <h2> -->
			  <a  href="<?php e($this->webroot)?>">&nbsp;</a>
<!-- 		  </h2> -->
		</center>
	  </td>
      
      <?php
	    }
      ?>
	<?php if(!isset($_SESSION['Auth']['User']['id'])){ ?>
      
      <td style=text-align:right;>
		  <?php 
			  e($html->image("backgrounds/gst.png",array('width'=>'140', 'height'=>'60','valign'=>'center')));
// 			  e($html->image("backgrounds/gst.png",array('width'=>'130','valign'=>'center')));
		  ?>
	  </td>
	<?php }?>
<!-- 	  </tr> -->
  </table>

  
<?php
  if(isset($_SESSION['Auth']['User']['id']) ){
?>

<!--<div id='cssmenu'>
<ul>
   <li><a href='#'>Inicio<span></span></a></li>
   <li class='active has-sub'><a href='#'><span>Configuraci&oacute;n</span></a>
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
   <li><a href='#'><span>About</span></a></li>
   <li class='last'><a href='#'><span>Contact</span></a></li>
</ul>
</div>-->

 <!--   <div id="menu">
    
        <div class='menu_nav'>
	  <ul class="nav">
	    <li>
		<a  href="<?php //e($this->webroot.'#')?>">Data<span class="flecha">&#43;</span></a>-->
			 <!-- Start Submenu -->
		  <!--<ul>
		    <li>
		      <a  href="<?php //e($this->webroot.'Clients/')?>">Nivel 1<span class="flecha">&#43;</span></a>
		  	<ul>
		    		<li>
		      			<a  href="<?php //e($this->webroot.'Clients/')?>">Sub-Nivel 1<span class="flecha">&#43;</span></a>
		    		</li>
		   	</ul>
		    </li>

		    <li>
		      <a  href="<?php //e($this->webroot.'Clients/')?>">Nivel 2<span class="flecha">&#43;</span></a>
		    </li>
		    <li>
		      <a  href="<?php //e($this->webroot.'Clients/')?>">Nivel 3<span class="flecha">&#43;</span></a>
		    </li>
		  </ul>

	     </li>--> <!--this level-->


	    <!--</ul>--> <!--end of class nav-->
	  <!--</div>
   
    </div>--> <!--end id=menu-->
    <?php } ?>
</div> <!--end id=header-->

<br />
<br />
<!-- Here's where I want my views to be displayed -->

	<div id="container">
		<?php echo $content_for_layout ?>
		<?php e($this->Session->flash()); ?>
	</div>

	<!-- Add a footer to each displayed page -->
<div>&nbsp;</div>

<div id="footer">
    <table id="<?php e(idTotalIndex);?>">
	  <tr />
		  <td />
			<div id="copyright" style="text-align:center;">
			  <?php
				  App::import('Controller', 'RemoteTimer');
				  echo $this->element('chronos');
//		 		  echo $this->element('chronos',array('mkdiv',$this->requestAction('RemoteTimer/mkdiv/')));
			  ?>
			  Designed by GST I.T. Department Software Development &copy; 2014
			</div>
    </table>
</div>

  <div>
    <?php
// 	  e($this->element('sql_dump')); 
    ?>
  </div>

</body>
</html>

<?php  } // end of the legacy menu ?>


<?php 	if(isset($_SESSION['theme']['protoquery']) and $_SESSION['theme']['protoquery'] === true) {?>

<?php if(isset($_SESSION['Auth']['User']['id'])){ ?>

<div id="header">
<header class="navbar">
    <nav class="navbar navbar-inverse navbar-fixed-top">

	 <div class="container-fluid">

		<div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
			
			<a id="home" class="navbar-brand" href="<?php e($this->webroot)?>" alt="Landing Page" title="Inicio" data-toggle="tooltip" data-placement="bottom">
				<i class="fa fa-home"></i>
			</a>
			
			<a class="navbar-brand" href="<?php e($this->webroot.'projections/')?>" title="Reportes Operativos" alt="Reportes Operativos"><span>Reportes Operativos</span>
			</a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
<!-- 				<li><a href="<?php e($this->webroot.'Users')?>" >Settings</a></li> -->
<!-- 			<ul class="nav navbar-nav"> -->
<!--				<li class="dropdown">
				<a href="<?php e($this->webroot)?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" alt="Landing Page" title="Tema"><i class="fa fa-picture-o"></i> <span class="caret"></span>
				</a>-->
<!--				<ul class="dropdown-menu">
					<li class="dropdown-header">Temas</li>
					<li role="separator" class="divider"></li>
					<?php foreach($_SESSION['tema'] as $keyIdxTheme => $tmCont) { ?>
					<?php foreach($tmCont as $optionsAllThemes) {?>
						<?php //pr($optionsAllThemes)?>
					<?php 	
							if($optionsAllThemes['id_theme'] === $_SESSION['Auth']['User']['id_theme']) {
								$addTagMethod[$optionsAllThemes['id_theme']] = '<i class="fa fa-check-square-o"></i>&nbsp;';
							} else { // end if
								$addTagMethod[$optionsAllThemes['id_theme']] = '<i class="fa fa-square-o"></i>&nbsp;';
							}
					?>
					<?php 	if($optionsAllThemes['version'] === 'beta' ) {?>

					<li>
					<?php
								echo $this->Ajax->link( $addTagMethod[$optionsAllThemes['id_theme']]
									.$this->Html->tag('i','', array('class' => 'fa fa-picture-o')) .
									'&nbsp;<span>'.$optionsAllThemes['themename'].'</span>'.
									'&nbsp;<span class="label label-warning">&nbsp;Under Construction&nbsp;</span>&nbsp;<i class="fa fa-cog fa-spin"></i>&nbsp;',
									array('controller'=>'Projections',
										  'action' => 'blackTheme',
										  $optionsAllThemes['id_theme'],
										  $_SESSION['Auth']['User']['id'],
										  $optionsAllThemes['library']
										  ),
// 									array(null),
									array('class' => 'ajax-link',
// 									"loading" => "Element.hide('hide');Element.show('waiting');",
									'complete'=>'reloading();', 
									'escape' => false)
								);
					?>
					</li>
					<?php 	} else {?>
					<li>
					<?php
								echo $this->Ajax->link( $addTagMethod[$optionsAllThemes['id_theme']]
									.$this->Html->tag('i','', array('class' => 'fa fa-picture-o')) .
									'&nbsp;<span>'.$optionsAllThemes['themename'].'</span>',
									array('controller'=>'Projections',
										  'action' => 'blackTheme',
										  $optionsAllThemes['id_theme'],
										  $_SESSION['Auth']['User']['id'],
										  $optionsAllThemes['library']
										  ),
// 									array(null),
									array('class' => 'ajax-link','complete'=>'reloading();', 'escape' => false)
// 									array('class' => 'ajax-link','update'=>'divuser', 'escape' => false)
								);
					?>
					</li>
					<?php 	} // end if?>
					<?php }?>
					<?php } // end foreach?>
				</ul>-->
<!-- 				</li> -->
<!-- 			</ul> -->
	<!--             this becomes handy -->
				<li><a href="#" data-toggle="modal" data-target="#myModal">Ayuda</a></li>
				<li><a href="<?php e($this->webroot.'Users/'.$link)?>">Salir</a></li>
			</ul>
			<ul class="nav navbar-nav pull-right panel-menu">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle account" data-toggle="dropdown">
						<i class="fa fa-angle-down pull-right"></i>
						<div class="user-mini pull-right">
							<span class="welcome">Bienvenido,</span>
							<span>
								<?php 
									e($_SESSION['Auth']['User']['first_name'].' '.$_SESSION['Auth']['User']['last_name']);
								?>
							</span>
						</div>
					</a>
					<ul class="dropdown-menu">
					<li class="divider"></li>
					<li class="dropdown-header">Sitios</li>
						<li>
							<a href="<?php e($this->webroot.'projections/')?>">
								<i class="fa fa-external-link"></i>&nbsp;
								<span>Toneladas,Kms,Viajes e Ingresos Operativos</span>
							</a>
						</li>
						
				<?php
					if(isset(userConfig()[$_SESSION['Auth']['User']['email']]['viewMenu'])){
							$emailPermissions = userConfig()[$_SESSION['Auth']['User']['email']]['viewMenu'];
					}
					if(isset($emailPermissions['dropIndicadores']) and $emailPermissions['dropIndicadores'] === false){
				?>
				
					<?php
						if(isset(userConfig()[$_SESSION['Auth']['User']['email']]['viewMenu'])){
								$emailPermissions = userConfig()[$_SESSION['Auth']['User']['email']]['viewMenu'];
						}
						if(isset($emailPermissions['dropIndicadores']) and $emailPermissions['dropIndicadores'] === false){
					?>
					<li>
						<a href="<?php e($this->webroot.'indicadores/')?>" title="Indicadores" alt="Indicadores">
							<i class="fa fa-external-link"></i>&nbsp;
								<span>Indicadores</span>
						</a>
					</li>
					<?php
						}
					?>
					<?php
						if(isset($emailPermissions['dropIndicadores']) and $emailPermissions['dropCostos'] === false){
					?>
					<li>
						<a href="<?php e($this->webroot.'MssqlPresupuestoAtm/')?>" title="Costos" alt="Costos">
							<i class="fa fa-external-link"></i>&nbsp;
								<span>Costos</span>
						</a>
					</li>
					<?php
						}
					?>
					
					<?php
						if(isset($emailPermissions['dropIndicadores']) and $emailPermissions['dropFlujo'] === false){
					?>
					<li>
						<a href="<?php e($this->webroot.'search/#openModal')?>" title="Flujo" alt="Flujo">
							<i class="fa fa-external-link"></i>&nbsp;
								<span>Flujo</span>
						</a>
					</li>
					<?php
						}
					?>
				<?php }?>
					<li class="divider"></li>
					<li class="dropdown-header">Opciones</li>
						<li>
							<?php
								echo $this->Html->link(
									$this->Html->tag('i','', array('class' => 'fa fa-user')) .
									'&nbsp;<span>Usuario</span>',
									array('controller'=>'Users','action' => 'edit',$_SESSION['Auth']['User']['id'],'?'=>array('chpass'=>true)),
									array('class' => 'ajax-link', 'escape' => false)
								);
							?>
							
						</li>
						<?php
							if(isset(userConfig()[$_SESSION['Auth']['User']['email']]['viewMenu'])){
									$emailPermissions = userConfig()[$_SESSION['Auth']['User']['email']]['viewMenu'];
							}
							if(isset($emailPermissions['dropIndicadores']) and $emailPermissions['dropIndicadores'] === false){
						?>
						<li>
							<a href="<?php e($this->webroot.'Users')?>">
								<i class="fa fa-cog"></i>
								<span>Configuraci&oacute;n</span>
							</a>
						</li>
						<?php }?>
						<li>
							<a href="<?php e($this->webroot.'Users/'.$link)?>">
								<i class="fa fa-power-off"></i>
								<span>Salir</span>
							</a>
						</li>
					</ul>
				</li>
			</ul>
<!--			<form class="navbar-form navbar-right">
				<input type="text" class="form-control" placeholder="Search...">
				<i class="fa fa-search"></i>
			</form>-->
        </div>
      </div>
    </nav>
</header>

<!-- Modal the better way to call this is with a element -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Menus</h4>
      </div>
      <div class="modal-body">
        Navega por el menu desplegable debajo de tu nombre de usuario con la etiqueta sitios para visualizar los Reportes
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
<!--         <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!-- end modal -->

<?php } ?>

</div><!--<div id="header">-->
<!-- Here's where I want my views to be displayed -->
<style>
/** Layout **/
#fix-layout {
	text-align: left;
	margin-top:60px;
	margin-bottom:10px;
	margin-left:30px;
	margin-right:30px;
	height:560px;
	min-height:100%;
	overflow-x:hidden;
/* 	overflow-y:hidden;  */
/* 	overflow-x:scroll; */
/* 	overflow-y:scroll; */
	overflow-y:auto;
/* Scrollbar section */
/* Chrome and Safari */
::-webkit-scrollbar {
    width: 12px;
}
 
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
    border-radius: 10px;
}
 
::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(95,191,255,0.9); 
}

/* firefox */
  @-moz-document url-prefix(http://),url-prefix(https://){
    scrollbar{
	-moz-appearance: none !important;
	background: rgb(0,255,0) !important;
    }
    thumb,scrollbarbutton {
	-moz-appearance: none !important;
	background-color: rgb(0,0,255) !important;
    }
    thumb:hover,scrollbarbutton:hover {
	-moz-appearance: none !important;
	background-color: rgb(255,0,0) !important;
    }
    scrollbarbutton {
	display: none !important;
    }
    scrollbar[orient="vertical"] {
	min-width: 15px !important;
    }
  }

}

</style>


	<div id="fix-layout" >
		<?php echo $content_for_layout ?>
	</div>
<!-- Add a footer to each displayed page -->
<!--	<div>
		<?php
// 		  e($this->element('sql_dump')); 
		?>
	</div>-->
	
<!-- 	<div class="panel"> -->

			<footer>
				<?php
					App::import('Controller', 'RemoteTimer');
					echo $this->element('chronos');
				?>
				<p class="pull-right"><a href="#">Back to top</a></p>
				<p><i class="fa fa-truck"></i>&nbsp;GST Software Development Department &copy; 2014 &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
			</footer>
<!-- 	</div> -->
</div>


<!-- initialize tooltip -->
<script>
		require(['jquery', 'bootstrap'], function($) {
			$(document).ready(function () {
// 				$(function () {
// 				$('[data-toggle="tooltip"]').tooltip()
// 				})
// 				initialize tooltip home
				$('#home').tooltip()
			});
		});

</script>

</body>
</html> 

<?php 	} // end of protoquery menu ?>
