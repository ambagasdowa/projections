<?php
// This comes from local mysql database

class TraficoGuia extends AppModel {
    var $name = 'TraficoGuia';
    var $useDbConfig ='login';
    var $useTable = 'trafico_guia';
    var $primaryKey = "no_guia";
    var $hasMany = array(
        'TraficoRenglonGuia' => array(
            'className'     => 'TraficoRenglonGuia',
            'foreignKey'    => 'no_guia',
//             'conditions'    => array(
// 				     'TraficoRenglonGuia.id_area' => '1',
// // 				     'TraficoRenglonGuia.status_guia' => 'A',
// // 				     'TraficoRenglonGuia.status_guia' => 'C',
// // 				     'TraficoRenglonGuia.status_guia' => 'R',
// // 				     'TraficoRenglonGuia.status_guia' => 'T',
// 				),
//          'order'    => 'TraficoGuia.fecha_guia DESC',
            'limit'        => '50',
            'dependent'=> true
        )
    );
    
    
//     var $belongsTo = array('Department'=>array('className'=>'Department',
// 					     'foreignKey'=>'id_department'
// 					)
// 	             );

}
?>