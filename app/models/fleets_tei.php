<?php
// This comes from local mysql database

class FleetsTei extends AppModel{
    var $name = "FleetsTei";
    var $useTable = "areas_tei";
    var $useDbConfig ='teisa';
    var $primaryKey = "id_area";
    var $hasMany = array(
        'FlotasTei' => array(
            'className'     => 'FlotasTei',
            'foreignKey'    => 'id_area',
            'fields'		=> array('FlotasTei.id_flota','FlotasTei.nombre'),
			'conditions'    => array(/*'Flotas.id_flota' => '2',this example is working*/),
			'order'   		=> 'FlotasTei.nombre ASC',
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
    function getFlotasTei(){

      $flotas = $this->find('all',array('fields'=>array('FleetsTei.id_area','FleetsTei.nombre')));

	  foreach($flotas as $upKey => $fleets){
		  $flotas = Set::combine($flotas, '{n}.FleetsTei.id_area', '{n}');
	  }
	  
	  foreach($flotas as $upKey => $fleets){
		foreach($fleets['FlotasTei'] as $UpKey => $values){
		  $flotas[$upKey]['FlotasTei'] = Set::combine($fleets['FlotasTei'], '{n}.id_flota', '{n}');
		}
	  }
       return $flotas;
    } // End function getFlotas

} // End Class 
?>
 
