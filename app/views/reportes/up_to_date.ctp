<?php ?>
	  <div id="divEstimado"> <!--This is going to update -->
		
		  <?php
			App::Import('Controller','Reportes');
			echo $this->element('estimado');
		  ?> <!--dinamic update -->
		  
		  <?php
// 		    App::import('Controller', 'RemoteTimer');
// 		    echo $this->element('chronos');
// 		    echo $this->element('chronos',array('mkdiv',$this->requestAction('RemoteTimer/mkdiv/')));
		  ?>
      </div> <!--End of observeField=> divEstimado--> 
