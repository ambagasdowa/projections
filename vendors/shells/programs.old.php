<?php
class ProgramsShell extends Shell {
          var $uses = array(
			'Empresas',
			'Areas',
			'AreasAtm',
			'AreasTei',
			'FlotasAtm',
			'FlotasTei',
			'Flotas',
			'TipoOperacion',
			'TipoOperacionAtm',
			'TipoOperacionTei',
			'Fraccion',
			'TonelajeCurrent',
			'KmsCurrent',
			'IngresosCurrent'
			);
//     var $params = array('');

/** TODO make an function for areas with remenber the string to convert is Bonampak <area> 
 **       firts drop Bonampak string and convert to ucfirts(ucwords()) the rest etc
 */
   function areas(){
// 	pr('areas');
   } 

   
   function corp(){
      $conditions['Empresas.active'] = '1';
      $corp = $this->Empresas->find('list',array('fields'=>array('id_empresa','empresa'),'conditions'=>$conditions));
      
      return $corp;
   }
 /** @variant: in var $uses drop the models => TraficoGuia and TraficoRenglonGuia
  */

  /** @function fleets()
   ** @param <set true to return data as variable> <set true to set the variables in view> 
   ** @var for both modes the returned var are in set mode :: $fleets = array($fleet,$flota)
   **/    
   function fleets($return=null,$set=null){
	$SearchFleets = $this->Flotas->find('all');
	$area = $this->Areas->find('list',array('fields'=>array('id_area','nombre')));
	$flota = null;
	for($i=1;$i<=count($area);$i++){
	  $flota[$i] = null;
	}
	foreach($SearchFleets as $key => $value){

	  if(!empty($SearchFleets[$key]['TipoOperacion'])){
	  
	    $fleet[$SearchFleets[$key]['Flotas']['id_area']][$SearchFleets[$key]['Flotas']['id_flota']] = $SearchFleets[$key]['Flotas']['nombre'];

	    foreach($SearchFleets[$key]['TipoOperacion'] as $k => $v){
	    
	      $fleet[$SearchFleets[$key]['Flotas']['id_area']][$SearchFleets[$key]['Flotas']['id_flota']] .= ','.$SearchFleets[$key]['TipoOperacion'][$k]['id_tipo_operacion'];
	      
	      $flota[$SearchFleets[$key]['Flotas']['id_area']] .= ','.$SearchFleets[$key]['TipoOperacion'][$k]['id_tipo_operacion'];
	    }
	  }
	}
	$fleets['fleet'] = $fleet; 
	$fleets['flota'] = $flota;
      if($return == false && $set == true){
	  $this->set('fleets',$fleets);
      }elseif($return == true && $set == false){
	  return $fleets;
      }
   } // End's function fleets()   
//     pr($fleets);exit();
  /** @function month()
   ** @param <var returned> <vars set in view> <the year> 
   ** TODO use this as global research about controller::method import use AppController
   ** for now will generate an array
   **/    
   function months($return=null,$set=null,$year=null){
      
      // firts make the month and classified according to given year
      // this is going to define section
      $translate = array(
		'1'=>'Enero',
		'2'=>'Febrero',
		'3'=>'Marzo',
		'4'=>'Abril',
		'5'=>'Mayo',
		'6'=>'Junio',
		'7'=>'Julio',
		'8'=>'Agosto',
		'9'=>'Septiembre',
		'10'=>'Octubre',
		'11'=>'Noviembre',
		'12'=>'Diciembre'
      );
      for($i=1;$i<=12;$i++){
     	$months[$i]['spanish'] = $translate[$i];
	$months[$i]['large'] = date('F',mktime('0','0','0',$i,'01',$year));
	$months[$i]['short'] = date('M',mktime('0','0','0',$i,'01',$year));
	$months[$i]['numeric'] = date('m',mktime('0','0','0',$i,'01',$year));
	$months[$i]['num'] = date('n',mktime('0','0','0',$i,'01',$year));
	$months[$i]['days'] = date('t',mktime('0','0','0',$i,'01',$year));
	$months[$i]['leap'] = date('L',mktime('0','0','0',$i,'01',$year));
      }
      // Now select if set the vars to the view or return the vars to the controller
      if($return == false && $set == true){
	  $this->set('months',$months);
      }elseif($return == true && $set == false){
	  return $months;
      }
   } // End's function months()  


    function main(){
//       $ThisArea = array('1'=>'Orizaba','2'=>'Guadalajara','3'=>'Ramos Arizpe','4'=>'Tijuana');

	  $months = $this->months(true,false,date('Y'));
	  $CurrentYear = date('Y');
	  $idx=1;
	  /** @params config urls
	  */
	  // Firts clean the files 
  // 	system("rm /tmp/*.sql");
	  $url = array();
	  $root = '/tmp/';
  // 	$this->out(pr($this->corp()));
	  $corporate = $this->corp();
	  
  // 	$this->out(substr("_teisa", 0,4));exit();
	
	  foreach($corporate as $key => $value){

		
		// Define the connection data for each enterprise from database 1= Bonampak ,2 = ATM and 3 = Tespecializada
		// TODO make this with an db relation 
		if($key == '1'){
			$_append  = null;
			$connection = 'odbc-bonampakdb';
		}if($key == '2'){
				$_append  = '_'.substr(strtolower($value),0,3);
				$connection = 'odbc-macuspanadb';
		}if($key == '3'){
			$_append  = '_'.substr(strtolower($value), 0, 3);
			$connection = 'odbc-tespecializadadb';
		}
		$mysql[$value]['host'] = 'localhost';
		$mysql[$value]['pass'] = '@projections'.$_append.'#';
		$mysql[$value]['user'] = 'projections'.$_append;
		$mysql[$value]['id_empresa'] = $key;
		
		
		$url[$value][1]['url'] = "tonelaje_current".$_append.".sql";
		$url[$value][1]['save'] = "tonelaje_current".$_append.".csv";
		$url[$value][1]['truncate'] = "query_tonelaje_current".$_append.".sql";
		$url[$value][1]['query_truncate'] = "truncate tonelaje_current".$_append."";
		if($key == '3'){
		  $url['Teisa'][1]['query'] = "select a.id_area,a.status_guia,a.fecha_guia,b.id_fraccion,b.peso,a.id_tipo_operacion,a.id_unidad,d.id_flota,a.num_guia,a.prestamo from trafico_guia as a INNER JOIN trafico_renglon_guia as b ON a.id_area = b.id_area and a.no_guia= b.no_guia INNER JOIN trafico_viaje as c ON a.id_area = c.id_area and a.no_viaje = c.no_viaje INNER JOIN mtto_unidades as d ON a.id_unidad = d.id_unidad where a.fecha_guia like '%".$CurrentYear."%' and a.tipo_doc = '2' and a.status_guia not like 'B' and a.prestamo NOT LIKE 'P' order by a.fecha_guia";
		}else{
		  $url[$value][1]['query'] = "select a.id_area,a.status_guia,a.fecha_guia,a.id_fraccion,b.peso,a.id_tipo_operacion,a.id_unidad,d.id_flota,a.num_guia,a.prestamo from trafico_guia as a INNER JOIN trafico_renglon_guia as b ON a.id_area = b.id_area and a.no_guia= b.no_guia INNER JOIN trafico_viaje as c ON a.id_area = c.id_area and a.no_viaje = c.no_viaje INNER JOIN mtto_unidades as d ON a.id_unidad = d.id_unidad where a.fecha_guia like '%".$CurrentYear."%' and a.tipo_doc = '2' and a.status_guia not like 'B' and a.prestamo NOT LIKE 'P' order by a.fecha_guia";
		}
		$url[$value][2]['url'] = "kms_current".$_append.".sql";
		$url[$value][2]['save'] = "kms_current".$_append.".csv";
		$url[$value][2]['truncate'] = "query_kms_current".$_append.".sql";
		$url[$value][2]['query_truncate'] = "truncate kms_current".$_append;
		if($key == '3'){
		  $url['Teisa'][2]['query'] = "select c.id_configuracionviaje,c.kms_viaje,c.kms_real,a.fecha_guia,b.id_fraccion,a.id_area,a.id_tipo_operacion,a.id_unidad,d.id_flota,a.no_guia,a.no_viaje,a.num_guia_asignado FROM trafico_guia as a INNER JOIN trafico_renglon_guia as b ON a.id_area = b.id_area and a.no_guia= b.no_guia INNER JOIN trafico_viaje as c ON a.id_area = c.id_area and a.no_viaje = c.no_viaje INNER JOIN mtto_unidades as d ON a.id_unidad = d.id_unidad INNER JOIN trafico_ruta as e ON c.id_ruta=e.id_ruta where YEAR(a.fecha_guia) LIKE '".$CurrentYear."' and a.status_guia not like 'B' and a.prestamo NOT LIKE 'P' and a.tipo_doc = '2' order by a.fecha_guia";
		}else{
		  $url[$value][2]['query'] = "select c.id_configuracionviaje,c.kms_viaje,c.kms_real,a.fecha_guia,a.id_fraccion,a.id_area,a.id_tipo_operacion,a.id_unidad,d.id_flota,a.no_guia,a.no_viaje,a.num_guia_asignado FROM trafico_guia as a INNER JOIN trafico_renglon_guia as b ON a.id_area = b.id_area and a.no_guia= b.no_guia INNER JOIN trafico_viaje as c ON a.id_area = c.id_area and a.no_viaje = c.no_viaje INNER JOIN mtto_unidades as d ON a.id_unidad = d.id_unidad INNER JOIN trafico_ruta as e ON c.id_ruta=e.id_ruta where YEAR(a.fecha_guia) LIKE '".$CurrentYear."' and a.status_guia not like 'B' and a.prestamo NOT LIKE 'P' and a.tipo_doc = '2' order by a.fecha_guia";
		}
		$url[$value][3]['url'] = "ingresos_current".$_append.".sql";
		$url[$value][3]['save'] = "ingresos_current".$_append.".csv";
		$url[$value][3]['truncate'] = "query_ingresos_current".$_append.".sql";
		$url[$value][3]['query_truncate'] = "truncate ingresos_current".$_append."";

		if($key == 3){
		$url['Teisa'][3]['query'] = "select a.fecha_guia,a.id_area,a.id_tipo_operacion,b.id_fraccion,a.id_unidad,a.no_guia,a.no_viaje,a.num_guia_asignado,a.subtotal,d.id_flota from trafico_guia as a INNER JOIN trafico_renglon_guia as b ON a.id_area = b.id_area and a.no_guia= b.no_guia INNER JOIN trafico_viaje as c ON a.id_area = c.id_area and a.no_viaje = c.no_viaje INNER JOIN mtto_unidades as d ON a.id_unidad = d.id_unidad where a.fecha_guia like '%".$CurrentYear."%' and a.tipo_doc = '2' and a.status_guia not like 'B' and a.prestamo NOT LIKE 'P' order by a.fecha_guia";	
		}else{
		  $url[$value][3]['query'] = "select a.fecha_guia,a.id_area,a.id_tipo_operacion,a.id_fraccion,a.id_unidad,a.no_guia,a.no_viaje,a.num_guia_asignado,a.subtotal,d.id_flota from trafico_guia as a INNER JOIN trafico_viaje as c ON a.id_area = c.id_area and a.no_viaje = c.no_viaje INNER JOIN mtto_unidades as d ON a.id_unidad = d.id_unidad where a.fecha_guia like '%".$CurrentYear."%' and a.tipo_doc = '2' and a.status_guia not like 'B' and a.prestamo NOT LIKE 'P' order by a.fecha_guia";
		}
		
		// toneladas are n records in trafico_renglon_guia associate with trafico_guia generate n records firts sum peso with the n records associated with trafico_guia , in that way you have n records of trafico_renglon_guia as peso and one trafico_guia as ingresos,
		
	// 	$url[$value][3]['query'] = "select a.fecha_guia,a.id_area,a.id_tipo_operacion,b.id_fraccion,a.id_unidad,a.no_guia,a.no_viaje,a.num_guia_asignado,a.subtotal,d.id_flota from trafico_guia as a INNER JOIN trafico_renglon_guia as b ON a.id_area = b.id_area and a.no_guia= b.no_guia INNER JOIN trafico_viaje as c ON a.id_area = c.id_area and a.no_viaje = c.no_viaje INNER JOIN mtto_unidades as d ON a.id_unidad = d.id_unidad where a.fecha_guia like '%".$CurrentYear."%' and a.tipo_doc = '2' and a.status_guia not like 'B' and a.prestamo NOT LIKE 'P' order by a.fecha_guia";	
		// Add for temporal tables
	// 	if($_append == '_atm' OR $_append == '_tei'){
	// 	$url[$value][4]['url'] = "tipo_operacion".$_append.".sql";
	// 	$url[$value][4]['save'] = "tipo_operacion".$_append.".csv";
	// 	$url[$value][4]['truncate'] = "query_tipo_operacion".$_append.".sql";
	// 	$url[$value][4]['query_truncate'] = "truncate tipo_operacion".$_append."";
	// 	$url[$value][4]['query'] = "select tipo_operacion,segmento1,clasificacion from desp_tipooperacion";
	// 	}
	//   pr($value);
		foreach($url[$value] as $k => $data){

		  if(file_exists($root.$data['url'])){
			system('rm '.$root.$data['url']);
		  }if(file_exists($root.$data['truncate'])){
			system('rm '.$root.$data['truncate']);
		  }
		  system("touch ".$root.$data['truncate']);
		  $ftruncate = fopen($root.$data['truncate'],'w');
		  fwrite($ftruncate,$data['query_truncate']."\n");
		  fclose($ftruncate);

		  system("touch ".$root.$data['url']);
		  $fquery = fopen($root.$data['url'],'w');
		  fwrite($fquery,$data['query']."\n");
		  
		  fclose($fquery);

		  system("/usr/bin/isql -v ".$connection." zam lis -bt  < ".$root.$data['url']." > ".$root."list_".$data['url']);
		  system("sed -e "."'\$d' ".$root."list_".$data['url']." > ".$root."list_".$data['url'].$idx);
		  system("sed -e "."'\$d' ".$root."list_".$data['url'].$idx." > ".$root."db_".$data['url']);

		  system("sed -e '1,3d' -e 's/[ \|]*$//g' -e 's/^[ \|]*//g' -e 's/|/\t/g' -e 's/^/null\\t/g' -e '\$d' ".$root."db_".$data['url']." > ".$root.$data['save']);

		  system("mysql -u ".$mysql[$value]['user']." --password=".$mysql[$value]['pass']." ".$mysql[$value]['user']." < ".$root.$data['truncate']);
		  
		  system("mysqlimport --local -u ".$mysql[$value]['user']." -h ".$mysql[$value]['host']." --password=".$mysql[$value]['pass']." ".$mysql[$value]['user']." ".$root.$data['save']);
		  
		} // End foreach write url
	  } // End foreach $corporate
    } // End main() like the ancient times of the all migthy C
    
} // End Class Programs