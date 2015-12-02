
<?php
//   viewConfig
	    e($ajax->form(array("type"=>"post",
				"options"=>array("model"=>"Config",
				"update"=>"divRealmsClass",
				"loading" => "Element.hide('hide_div');Element.show('loading');",
// 				'loading' => "load()",
// 				"before" =>"window.location.reload();",
			    "complete" => "Element.hide('loading');Effect.Grow('hide_div',{duration: 2.0});",
				"url"=>array("controller"=>'Config',"action"=>"ConfigRealmsClass"),
						  )
                      )
                )
	    );
?>

    <div id="loading" style="display:none;">
	<table id="menu_info_small">
	  <tr />
	      <td width="40%" />&nbsp;
	      <td />
		    <?php echo $html->image("loaders/loading.gif"/*,
					      array("width"=>280,
						    "height"=>10,
					      )*/
				); 
		    ?>
<!-- 		</div> -->
	      <td width="30%" />&nbsp;
	</table>
    </div>


    
<div id="modal">

<script type="text/javascript">
// get this from hiden hive
function checkChromeWeek(){
  var val = document.getElementById("FlujoWeek").value;
  if(val == ''){
	var week = alert("Debe ingresar un número de Semana");
	document.getElementById("FlujoWeek").focus();
  }
}// End checkChromeWeek

function checkFirefoxWeek(){
  var val = document.getElementById("FlujoWeek").value;
  if(val == ''){
	var week = prompt("Debe ingresar un número de Semana", "27");
	  if(week != null){
		document.getElementById("FlujoWeek").value = week ;
		document.getElementById("FlujoWeek").focus();
	  }
  }
} // end checkFirefoxWeek

function load(e){
		Event.stop(e);
  		new Modal({	content: "Cargando ...",
					cancelButton: false,
					okButton: false,
					duration: 0.4,
					afterShow: function(){container.remove()},
					afterFinish: function(){ container.remove()},
		});
}
</script>
<!--<a href="#" id="demo">link</a>-->

  <script type="text/javascript">
//     document.observe("dom:loaded", function(){
//       
//      $("demo").observe("click", function(e){
//         Event.stop(e);
// 		new Modal({	content: "Cargando ...",
// 					cancelButton: false,
// 					okButton: false,
// 					duration: 0.4,
// 					afterFinish: function(){ content.remove()},
// // 					ok: true,
// // 					closeEffect: function(self){ self.container.puff({ duration: 0.4, afterFinish: function(){ container.remove();}}
// 		});
//       });
// 	 
//       $("demo_1").observe("click", function(e){
//         Event.stop(e);
//         new Modal({content: "Hello World",
// 		});
//       });
// 
//     });
  </script>
</div>
<div id="divRealmsClass">

    <table id="menu_info">
    	<tr />
		  <td />Editar Cuentas
		  <td />

		<td width="10%" />
		<?php
				if($_SESSION['Auth']['User']['level'] == '0'){ // Means Super User
		?>
		  <?php
		      echo $this->Html->link(
			   $this->Html->image("icons/pen.png",
			                array('alt' => "Configurar Cuentas",
								  'title' => 'Configurar Cuentas',
								  'width' => '22',
								  'height' => '22'
					)
			   ),
					array(
					  'controller'=>'config',
					  'action'=>'viewConfig'
// 					  'Reporte de Flujo',
// 					  "ReporteFlujo-".date('Y-m-d'),
// 					  "export_flujo"
					) ,
					array('escape' => false),
					null
			);
		  ?>
		<?php
				}else{
				e('&nbsp;');
				} // En options for administrators
		?>
		 <td width="10%" />
		<?php
				if($_SESSION['Auth']['User']['level'] == '0'){ // Means Super User
		?>
		  <?php
		      echo $this->Html->link(
			   $this->Html->image("icons/add.png",
			                array('alt' => "Ingresar Registros",
								  'title' => 'Ingresar Registros',
								  'width' => '22',
								  'height' => '22'
					)
			   ),
					array(
					  'controller'=>'Reportes',
					  'action'=>'index'
// 					  'Reporte de Flujo',
// 					  "ReporteFlujo-".date('Y-m-d'),
// 					  "export_flujo"
					) ,
					array('escape' => false),
					null
			);
		  ?>
<?php
				}else{
				e('&nbsp;');
				} // En options for administrators
?>
		<td width="10%" />
		  <?php
		      echo $this->Html->link(
			   $this->Html->image("icons/home3d_alpha.png",
			                array('alt' => "Ir al Inicio",
								  'title' => 'Ir al inicio',
								  'width' => '22',
								  'height' => '22'
					)
			   ),
					array(
					  'controller'=>'search/#openModal',
					  'action'=>'index'
// 					  'Reporte de Flujo',
// 					  "ReporteFlujo-".date('Y-m-d'),
// 					  "export_flujo"
					) ,
					array('escape' => false),
					null
			);
		  ?>
		<td width="2%" />&nbsp;
	</table>


<!-- this can be an Element -->

<?php
			App::Import('Controller','Config');
// 			echo $this->element('config');
			echo $this->element('config',array('viewConfig',$this->requestAction('Config/viewConfig')));
?>

</div>

