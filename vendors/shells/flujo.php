<?php
class FlujoShell extends Shell {
      var $uses = array(
						'FlujoIngresos',
						'FlujoPrepIngresos'
				  );

/** @function GetSaldo()
 * 	  @arg <vars to define>
   ** @param var_returned => <retrieve update data and set new one >
   *  @package scriptaculous
   *  @function => yes
   ** @use => App::Import = true
   ** @set => retrieve old data and get new data for export and update the db
   *  @div => null
   **/

	  function GetSaldo($year=null,$real=null,$presupuesto=null,$debug=null){ // fix for get data from database
		
		pr($year);pr($real);pr($presupuesto);
		pr($this->FlujoIngresos->find('all'));
		pr($this->FlujoPrepIngresos->find('all'));
// 		if(!isset($_SESSION['saldo'])){
// 		  $saldo['real'] = null;
// 		  $saldo['presupuesto'] = null;
// 		}else{
// 		  $saldo['real'] = $_SESSION['saldo']['real'];
// 		  $saldo['presupuesto'] = $_SESSION['saldo']['presupuesto'];
// 		}
// 		return $saldo;
	  } // End GetSaldo

/** @function SaveSaldo()
 * 	  @arg <vars to define>
   ** @param var_returned => <retrieve update data and set new one >
   *  @package scriptaculous
   *  @function => yes
   ** @use => App::Import = true
   ** @set => retrieve old data and get new data for export and update the db
   *  @div => null
   **/
  
	  function SaveSaldo($saldo=null,$cobranza=null){ // fix for save the data to database
		if(!empty($this->data['Saldo']['real']) && !empty($this->data['Saldo']['presupuesto'])){
			$saldo['real'] = $this->data['Saldo']['real'];
			$saldo['presupuesto'] = $this->data['Saldo']['presupuesto'];
			$_SESSION['saldo'] = $saldo; // launch a callback function for update remote timer the index
			$flujo['saldo'] = $saldo;
		}
		
// 		build input data sheet
		if( $this->data['Ingresos'] !== null ){
		  $ingresos = $_SESSION['flujo']['ingresos'] = $this->data['Ingresos'];
		  $flujo['ingresos'] = $ingresos;
		}else{
		  $_SESSION['ingresos'] = null;
		  $flujo['ingresos'] = null;
		}
		
		if( $this->data['Egresos'] !== null ){
		  $egresos = $_SESSION['flujo']['egresos'] = $this->data['Egresos'];
		  $flujo['egresos'] = $egresos;
		}else{
		  $_SESSION['egresos'] = null;
		}
		
		if( $this->data['Impuestos'] !== null ){
		  $impuestos = $_SESSION['flujo']['impuestos'] = $this->data['Impuestos'];
		  $flujo['impuestos'] = $impuestos;
		}else{
		  $_SESSION['impuestos'] = null;
		}
		
		return $flujo;
	  }// End SaldoSave
	
/** @function main()
 * 	  @arg <vars to define>
   ** @param var_returned => <retrieve update data and set new one >
   *  @package scriptaculous
   *  @function => yes
   ** @use => App::Import = true
   ** @set => retrieve old data and get new data for export and update the db
   *  @div => null
   **/
	  function main($year=null,$real=null,$presupuesto=null,$debug=null){
		$this->out($this->GetSaldo($year='2014',$real='11111',$presupuesto='22222',$debug=false));
	  }// End function main
    
    
    
} //End class months
?>