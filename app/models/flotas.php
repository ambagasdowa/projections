<?php
// This comes from local mysql database

class Flotas extends AppModel{
    var $name = "Flotas";
    var $useTable = "flota";
    var $useDbConfig ='login';
    var $primaryKey = "id_flota";
    var $hasMany = array(
        'TipoOperacion' => array(
            'className'     => 'TipoOperacion',
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
 
