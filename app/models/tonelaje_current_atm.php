<?php
// This comes from local mysql database

class TonelajeCurrentAtm extends AppModel{
    var $name = "TonelajeCurrentAtm";
    var $useTable = "tonelaje_current_atm";
    var $useDbConfig ='atm';
    var $primaryKey = "id_tonelaje_current_atm";
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
 
