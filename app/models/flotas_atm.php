<?php
// This comes from local mysql database
class FlotasAtm extends AppModel{
    var $name = "FlotasAtm";
    var $useTable = "flota_atm";
    var $useDbConfig ='atm';
    var $primaryKey = "id_flota";
    var $hasMany = array(
        'TipoOperacionAtm' => array(
            'className'     => 'TipoOperacionAtm',
            'foreignKey'    => 'id_flota',
//             'conditions'    => array(
// 				     'TraficoRenglonGuia.id_area' => '1',
// // 				     'TraficoRenglonGuia.status_guia' => 'A',
// // 				     'TraficoRenglonGuia.status_guia' => 'C',
// // 				     'TraficoRenglonGuia.status_guia' => 'R',
// // 				     'TraficoRenglonGuia.status_guia' => 'T',
// 				),
//          'order'    => 'TraficoGuia.fecha_guia DESC',
//             'limit'        => '50',
            'dependent'=> true
        )
    );
//     var $belongsTo = array('Department'=>array('className'=>'Department',
// 					     'foreignKey'=>'id_department'
// 					)
// 	             );







}

?>
 
