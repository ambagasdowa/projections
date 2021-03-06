<?php
  class FlotasShell extends Shell{
          var $uses = array('Empresas',
			'Areas',
			'AreasAtm',
			'AreasTei',
			'Fleets',
			'FleetsAtm',
			'FleetsTei',
			'Flotas',
			'FlotasAtm',
			'FlotasTei',
			'TipoOperacion',
			'Fraccion'
			);

  function Empresas(){
	$EmpConditions['Empresas.active'] = '1'; // Check if the area is alive
	$empresas = $this->Empresas->find('list',array('fields'=>array('id_empresa','empresa'),array('conditions'=>$EmpConditions)));
	$corp = null;
	
	foreach($empresas as $key => $value){
	    if($key == '1'){
		    $_append[$key] = null;
	    }else{
		    $_append[$key]  = substr(ucwords(strtolower($value)),0,3);
	    }
	} // End foreach of empresas
	return $_append;
  }

  /** @function areas()
   ** @get empresas an get the areas as flotas indeed so this is root
   ** @param <set true to return data as variable> <set true to set the variables in view> 
   ** @var for both modes the returned var are in set mode :: $areas = array()
   **/    
   function areas(){
	  $_append = $this->Empresas();
// 	  Build the models
	  foreach($_append as $key => $value){
	      $model['area'][$key] = 'Areas'.$value;
	      $FindAreas[$key] = $this->$model['area'][$key]->find('list',array('fields'=>array('id_area','nombre')));
	  } // End main control structure foreach $_append
	  
	  
	  foreach($FindAreas as $k => $value){
// 	    $this->out(pr($value));
	    if( $k == '1' ){ // This is for Bonampak and always will be 
		foreach($value as $key => $data){
		    $extracting[$k][$key] = explode('BONAMPAK',trim($data));
// 		    if($extracting[$k][$key] == '1'){
			$extract[$k][$key] = ucwords(strtolower($extracting[$k][$key]['1']));
// 		    }
		}
	    }else{
		foreach($value as $key => $data){
		$extract[$k][$key] = explode(' ',$data);
		  if(isset($extract[$k][$key])){ // is $extract created?
		      if(in_array('MACUSPANA' ,$extract[$k][$key])){
			$extract[$k][$key] = ucwords(strtolower('MACUSPANA'));
			break;
		      }if(in_array('ESPECIALIZADA' ,$extract[$k][$key])){
			$extract[$k][$key] = ucwords(strtolower('TEISA'));
			break;
		      }
		  } // End $extract comprobation
		}
	    } // End firts level struct if-else
	  }

	  return $extract;
    }
  
  /** @function fleets()
   ** @param => <set true to return data as variable> <set true to set the variables in view> 
   ** @var => for both modes the returned var are in set mode :: $fleets = array($fleet,$flota)
   **/    
   function fleets($return=null,$set=null){
//       pr('FLEETS');
	$_append = $this->Empresas();
	$areas = $this->areas();
	$flotas['1'] = $this->Fleets->getFlotas();
// 	$flotas = $this->Fleets->find('all');
	$flotas['2'] = $this->FleetsAtm->getFlotasAtm();
// 	$flotasAtm = $this->FleetsAtm->find('all');
	$flotas['3'] = $this->FleetsTei->getFlotasTei();
// 	Build the model
	foreach($_append as $id_empresa => $emp){
	  if($id_empresa == '2'){
	    $model[$id_empresa] = 'Flotas'.$emp;
	  }else{
	    $model[$id_empresa] = 'Fleets'.$emp;
	  }
	}
	/**
	  WARNING => Clean the array
	  @fix => <Use names againts ids id_area in areas>
	**/
	foreach($areas as $id_empresa => $emp){
		foreach($flotas[$id_empresa] as $id_area => $area_name){
		  foreach($area_name['Flotas'.$_append[$id_empresa]] as $id_flota => $flota_name){
			if(!isset($fleets[$id_empresa][$id_area][$id_flota])){
			  $fleets[$id_empresa][$id_area][$id_flota] = null;
			}
			$fleets[$id_empresa][$id_area][$id_flota] = trim($flota_name['nombre']);
		  }
		}
	}
	
	return($fleets);
// 	exit();
   } // End's function fleets()

    function main(){
      $this->out($this->fleets());
//       $this->out($this->Empresas());
    }

} // End ShellClass
?>