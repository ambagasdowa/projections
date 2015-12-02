<?php
// This comes from local mysql database

class FlujoDirConceptAnexoC extends AppModel{
    var $name = "FlujoDirConceptAnexoC";
    var $useTable = "dir_concept_anexo_c";
    var $useDbConfig = 'flujo';
    var $primaryKey = "id_dir_concept_anexo_c";

//     var $hasMany = array(
//         'FlotasAtm' => array(
//             'className'     => 'FlotasAtm',
//             'foreignKey'    => 'id_area',
//             'fields'		=> array('FlotasAtm.id_flota','FlotasAtm.nombre'),
// 			'conditions'    => array(/*'Flotas.id_flota' => '2',this example is working*/),
// 			'order'   		=> 'FlotasAtm.nombre ASC',
// //          'limit'        => '50',
//             'dependent'=> true
//         )
//     );
// 
//     /**
//      * @Callback function for retrieve areas and re-arange with his associated fleets
//      * @package => Build-in
//      * @return array
//      */
//     function getFlotasAtm(){
// 
//       $flotas = $this->find('all',array('fields'=>array('FleetsAtm.id_area','FleetsAtm.nombre')));
// 
// 	  foreach($flotas as $upKey => $fleets){
// 		  $flotas = Set::combine($flotas, '{n}.FleetsAtm.id_area', '{n}');
// 	  }
// 	  
// 	  foreach($flotas as $upKey => $fleets){
// 		foreach($fleets['FlotasAtm'] as $UpKey => $values){
// 		  $flotas[$upKey]['FlotasAtm'] = Set::combine($fleets['FlotasAtm'], '{n}.id_flota', '{n}');
// 		}
// 	  }
//        return $flotas;
//     } // End function getFlotas

} // End Class 
?>
 
