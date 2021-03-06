<?php
// This comes from local mysql database
class Fleets extends AppModel{
    var $name = "Fleets";
    var $useTable = "areas";
    var $useDbConfig ='login';
    var $primaryKey = "id_area";
    var $hasMany = array(
        'Flotas' => array(
            'className'     => 'Flotas',
            'foreignKey'    => 'id_area',
            'fields'		=> array('Flotas.id_flota','Flotas.nombre'),
			'conditions'    => array(/*'Flotas.id_flota' => '2',this example is working*/),
			'order'   		=> 'Flotas.nombre ASC',
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
    function getFlotas(){ // Retrieve the data ans set the keys with the id_empresa

      $flotas = $this->find('all',array('fields'=>array('Fleets.id_area','Fleets.nombre')));

	  foreach($flotas as $upKey => $fleets){
		  $flotas = Set::combine($flotas, '{n}.Fleets.id_area', '{n}'); //set id_empresa as key
	  }
	  foreach($flotas as $upKey => $fleets){
		foreach($fleets['Flotas'] as $UpKey => $values){ // set id_flota as key of Flotas
		  $flotas[$upKey]['Flotas'] = Set::combine($fleets['Flotas'], '{n}.id_flota', '{n}');
		}
	  }
       return $flotas; // return the Build array with the id's set
    } // End function getFlotas

} // End Class 
?>

