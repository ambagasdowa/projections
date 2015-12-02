<?php
// This comes from local mysql database

class FleetsAtm extends AppModel{
    var $name = "FleetsAtm";
    var $useTable = "areas_atm";
    var $useDbConfig ='atm';
    var $primaryKey = "id_area";
    var $hasMany = array(
        'FlotasAtm' => array(
            'className'     => 'FlotasAtm',
            'foreignKey'    => 'id_area',
            'fields'		=> array('FlotasAtm.id_flota','FlotasAtm.nombre'),
			'conditions'    => array(/*'Flotas.id_flota' => '2',this example is working*/),
			'order'   		=> 'FlotasAtm.nombre ASC',
//          'limit'        => '50',
            'dependent'=> true
        )
    );
//     var $belongsTo = array('Department'=>array('className'=>'Department',
// 					     'foreignKey'=>'id_department'
// 					)
// 	             );

    /**
     * @Callback function for retrieve areas with is associated fleets
     * @package => Build-in
     * @return array
     */
    function getFlotasAtm(){

      $flotas = $this->find('all',array('fields'=>array('FleetsAtm.id_area','FleetsAtm.nombre')));

	  foreach($flotas as $upKey => $fleets){
		  $flotas = Set::combine($flotas, '{n}.FleetsAtm.id_area', '{n}');
	  }
	  
	  foreach($flotas as $upKey => $fleets){
		foreach($fleets['FlotasAtm'] as $UpKey => $values){
		  $flotas[$upKey]['FlotasAtm'] = Set::combine($fleets['FlotasAtm'], '{n}.id_flota', '{n}');
		}
	  }
       return $flotas;
    } // End function getFlotas

} // End Class 
?>
 
