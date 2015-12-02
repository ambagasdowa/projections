<?php
// This comes from local mysql database

class TraficoRenglonGuia extends AppModel {
    var $name = 'TraficoRenglonGuia';
    var $useDbConfig ='login';
    var $useTable = 'trafico_renglon_guia';
    var $primaryKey = "id";
//     var $hasMany = array(
//         'TraficoRenglonGuia' => array(
//             'className'     => 'TraficoRenglonGuia',
//             'foreignKey'    => 'no_guia',
//             'conditions'    => array('TraficoRenglonGuia.id_area' => '1',
// 				     'TraficoRenglonGuia.estatus_guia' => 'A',
// 				     'TraficoRenglonGuia.estatus_guia' => 'C',
// 				     'TraficoRenglonGuia.estatus_guia' => 'R',
// 				     'TraficoRenglonGuia.estatus_guia' => 'T',
// 				),
//             'order'    => 'TraficoGuia.fecha_guia DESC',
//             'limit'        => '5',
//             'dependent'=> true
//         )
//     );
    
    
//     var $belongsTo = array('Department'=>array('className'=>'Department',
// 					     'foreignKey'=>'id_department'
// 					)
// 	             );

}
?>