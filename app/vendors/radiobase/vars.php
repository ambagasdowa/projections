<?php
	  $all[$key]['Operadores'] = array();
	  $all[$key]['Operadores']['id_movil'] = null;
	  $all[$key]['Operadores']['id_economico'] = null;
	  $all[$key]['Operadores']['nombre'] = null;
	  $all[$key]['UnidadesEnServicio']['entrada'] = null;
	  $all[$key]['UnidadesEnServicio']['salida'] = null;
	  $all[$key]['UnidadesEnServicio']['pase_de_lista'] = null;
	  $all[$key]['FueraDeMomento']['hora_ini_0'] = null;
	  $all[$key]['FueraDeMomento']['hora_ini_1'] = null;
	  $all[$key]['FueraDeMomento']['hora_ini_2'] = null;
	  $all[$key]['FueraDeMomento']['hora_ini_3'] = null;
	  $all[$key]['FueraDeMomento']['hora_ini_4'] = null;
	  $all[$key]['FueraDeMomento']['hora_ini_5'] = null;
	  $all[$key]['FueraDeMomento']['hora_fin_0'] = null;
	  $all[$key]['FueraDeMomento']['hora_fin_1'] = null;
	  $all[$key]['FueraDeMomento']['hora_fin_2'] = null;
	  $all[$key]['FueraDeMomento']['hora_fin_3'] = null;
	  $all[$key]['FueraDeMomento']['hora_fin_4'] = null;
	  $all[$key]['FueraDeMomento']['hora_fin_5'] = null;
	  $all[$key]['CambioCanal']['canal_0'] = null;
	  $all[$key]['CambioCanal']['canal_1'] = null;
	  $all[$key]['CambioCanal']['canal_2'] = null;
	  $all[$key]['CambioCanal']['canal_3'] = null;
	  $all[$key]['Operadores']['id_movil'] .= $operators['Operadores']['id_movil'];
	  $all[$key]['Operadores']['id_economico'] .= $operators['Operadores']['id_economico'];
	  $all[$key]['Operadores']['nombre'] .= $operators['Operadores']['nombre'];
	  $all[$key]['UnidadesEnServicio']['entrada'] = $Registros['UnidadesEnServicio']['entrada'];
	  $all[$key]['UnidadesEnServicio']['salida'] = $Registros['UnidadesEnServicio']['salida'];
	  $all[$key]['UnidadesEnServicio']['pase_de_lista'] = $Registros['UnidadesEnServicio']['pase_de_lista'];
	  $all[$key]['FueraDeMomento']['hora_ini_0'] = $moment_registros['FueraDeMomento']['hora_ini_0'];
	  $all[$key]['FueraDeMomento']['hora_ini_1'] = $moment_registros['FueraDeMomento']['hora_ini_1'];
	  $all[$key]['FueraDeMomento']['hora_ini_2'] = $moment_registros['FueraDeMomento']['hora_ini_2'];
	  $all[$key]['FueraDeMomento']['hora_ini_3'] = $moment_registros['FueraDeMomento']['hora_ini_3'];
	  $all[$key]['FueraDeMomento']['hora_ini_4'] = $moment_registros['FueraDeMomento']['hora_ini_4'];
	  $all[$key]['FueraDeMomento']['hora_ini_5'] = $moment_registros['FueraDeMomento']['hora_ini_5'];
	  $all[$key]['FueraDeMomento']['hora_fin_0'] = $moment_registros['FueraDeMomento']['hora_fin_0'];
	  $all[$key]['FueraDeMomento']['hora_fin_1'] = $moment_registros['FueraDeMomento']['hora_fin_1'];
	  $all[$key]['FueraDeMomento']['hora_fin_2'] = $moment_registros['FueraDeMomento']['hora_fin_2'];
	  $all[$key]['FueraDeMomento']['hora_fin_3'] = $moment_registros['FueraDeMomento']['hora_fin_3'];
	  $all[$key]['FueraDeMomento']['hora_fin_4'] = $moment_registros['FueraDeMomento']['hora_fin_4'];
	  $all[$key]['FueraDeMomento']['hora_fin_5'] = $moment_registros['FueraDeMomento']['hora_fin_5'];
	  $all[$key]['CambioCanal']['canal_0'] = $ch_registros['CambioCanal']['canal_0'];
	  $all[$key]['CambioCanal']['canal_1'] = $ch_registros['CambioCanal']['canal_1'];
	  $all[$key]['CambioCanal']['canal_2'] = $ch_registros['CambioCanal']['canal_2'];
	  $all[$key]['CambioCanal']['canal_3'] = $ch_registros['CambioCanal']['canal_3'];
?> 