<?php
// This comes from local mysql database
/** TODO changue all other models
 * 
 */
class TonelajeCurrent extends AppModel{
    var $name = "TonelajeCurrent";
    var $useTable = "tonelaje_current";
    var $useDbConfig ='login';
    var $primaryKey = "id_tonelaje_current";
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
 
