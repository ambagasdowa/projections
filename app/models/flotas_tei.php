<?php
// This comes from local mysql database

class FlotasTei extends AppModel{
    var $name = "FlotasTei";
    var $useTable = "flota_tei";
    var $useDbConfig ='teisa';
    var $primaryKey = "id_flota";
    var $hasMany = array(
        'TipoOperacionTei' => array(
            'className'     => 'TipoOperacionTei',
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
 
