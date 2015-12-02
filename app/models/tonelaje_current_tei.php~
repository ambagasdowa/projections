<?php
// This comes from local mysql database

class TonelajeCurrentTei extends AppModel{
    var $name = "TonelajeCurrentTei";
    var $useTable = "tonelaje_current_tei";
    var $useDbConfig ='teisa';
    var $primaryKey = "id_tonelaje_current_tei";
    var $hasMany = array(
        'Flotas' => array(
            'className'     => 'Flotas',
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
 
