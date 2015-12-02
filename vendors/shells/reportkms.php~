<?php
class ReportkmsShell extends Shell {
          var $uses = array('Areas',
			'Flotas',
			'TipoOperacion',
			'Fraccion',
			'TonelajeCurrent',
			'KmsCurrent'
			);
//     var $params = array('');
    
    function main(){
      $ThisArea = array('1'=>'Orizaba','2'=>'Guadalajara','3'=>'Ramos Arizpe','4'=>'Tijuana');
    if (!($this->args)) {
	 $this->help();
         $this->err(__('Usage report <year> <area> <month> <fraction> <all_areas> ', true));
         $this->_stop();
      }

      $KmsConditions = null;
      if(isset($this->args[0]) && !isset($this->args[3])){
	$CurrentYear = $this->args[0];
	$KmsConditions['KmsCurrent.fecha_guia LIKE'] = "%".$CurrentYear."%";
      }if(isset($this->args[1])){
	$KeyArea = $this->args[1];
	$KmsConditions['KmsCurrent.id_area'] = $KeyArea;
      }else{
	$KeyArea = null;
      }if(isset($this->args[2])){
      $CurrentMonth = $this->args[2];
      $CurrentYear = $this->args[0];
      $KmsConditions['KmsCurrent.fecha_guia LIKE'] = "%".$CurrentYear."-".$CurrentMonth."%";
      }else{
	$CurrentMonth = null;
      }if(isset($this->args[3])){
	$Fraccion = $this->args[3];
	$KmsConditions['KmsCurrent.id_fraccion'] = $Fraccion;
      }else{
	$Fraccion = null;
      }if(isset($this->args[4])){
	$all = $this->args[4];
      }else{
	$all = null;
      }
      $args = $this->args;
      /** ALERT Like in the ancient times Define the vars firts
      **/
//       $KmsConditions = null;
//       $this->out(pr($KmsConditions));
//       $this->out(pr($args));exit();
      
      $NumDays = date('t',mktime('0','0','0',$CurrentMonth,'01',$CurrentYear));
/** TODO => Firts we need all areas => all fractions => CurrentYear
**	 => Second Detail By Four Areas => CurrentYear
**	 => Third Graphics by Area => Month => Fraction => CurrentYear
**/
	  $kms_full = $full = $kms_all = null;

	  $kms_search = $this->KmsCurrent->find('all',array('conditions'=>$KmsConditions));
	  
//       $this->out(pr($KmsConditions));
//       $this->out(pr($kms_search));
//       exit();
         if(!empty($kms_search)){
	  foreach($kms_search as $key => $value){
	      if($value['KmsCurrent']['id_configuracionviaje'] == '3'){
		 $kms_full[$value['KmsCurrent']['no_viaje']][] = $value['KmsCurrent']['kms_viaje'];
		 $kms_full[$value['KmsCurrent']['no_viaje']]['day'] = substr($value['KmsCurrent']['fecha_guia'],8,2);

	      }elseif(($value['KmsCurrent']['id_configuracionviaje'] == '2') OR ($value['KmsCurrent']['id_configuracionviaje'] == '1')){
		$kms_all += $value['KmsCurrent']['kms_viaje'];
		$kms_senc[substr($value['KmsCurrent']['fecha_guia'],8,2)] = $value['KmsCurrent']['kms_viaje'];;
	      }
	  }
	  foreach($kms_full as $k => $data){
	      $full += $data['0'];
	      $full_days[$data['day']] += $data['0'];
	  }
	  $AreaCorp['kms_all'] = ($kms_all+$full)*2;
	  $all_days = ($kms_all+array_sum($full_days))*2;
	 }else{
	    $AreaCorp['kms_all'] = null;
	 }

      
//       $this->out(pr($full));
      $this->out(pr($full_days));
//       $this->out(array_sum($full_days));
      $this->out(pr($kms_senc));
      $this->out(pr($AreaCorp));
      $this->out(pr($all_days));
//       exit();

	 $report_day = $kms_senc;
	 $report_year = array();
 	  /** ALERT Save the result for Display in the view
	  */

         //2
         $this->autoRender = false;
         //3                                               
         App::import('Vendor','pData', array('file' =>'pchart'.DS.'pData.class')); 
         App::import('Vendor','pChart', array('file' =>'pchart'.DS.'pChart.class'));
          
         //4
         $fontFolder = APP.'vendors'.DS.'pchart'.DS.'Fonts';
         $fontFolder = '..'.DS.'..'.DS.'vendors'.DS.'pchart'.DS.'Fonts';

         //5
         // Dataset definition
        $DataSet = new pData;
	$MaxKms = max($report_day);
	$MaxKms = $MaxKms+100;
	
	foreach($report_day as $key => $value){
	    $MyDay[] = (int)$key;
	}
	
// 	$this->out(pr($MyDay));
	$DataSet->AddPoint($report_day,"Serie1");
// 	$DataSet->AddPoint('4',"Serie2");
// 	$DataSet->AddPoint('20',"Serie3");
// 	$DataSet->AddPoint($MyDay,"Name");
	
// exit();
//         $this->out(pr($DataSet->GetData()));
// 	$idx=0;
//         foreach($MyDay as $key => $value){	  
// 	  $DataSet->AddPoint($value,"Serie1");
// 	  $DataSet->AddPoint((int)$key,"Name");
//         }
// 	    $this->out(pr($MyDay));
//         $DataSet->GetData()['0']['Name']=;
// 	  $DataSet->GetData()['0']['Name']=1;
        $this->out(pr($DataSet->GetData()));
        
        $DataSet->AddAllSeries();
        $DataSet->SetAbsciseLabelSerie();
        $key = $value = null;
        $DataSet->SetSerieName("Kilometros","Serie1");
        $DataSet->SetSerieName("Dia","Serie2");        
	$DataSet->SetYAxisName("Kilometros Dias");  
	$DataSet->SetYAxisUnit("Kms");
	$DataSet->SetXAxisName("Dias");
	$DataSet->SetXAxisFormat("number");
	  
	
         // Initialise the graph
//          pr($SchemaFolder);
	$Test = new pChart(820,260);
	
	$Test->setFixedScale(1,$MaxKms,5,0,$NumDays,5);
	$Test->setDateFormat("H:m");
	$Test->setFontProperties($fontFolder.DS."tahoma.ttf",10);
// 	$Test->setColorPalette(0,115,173,207);
// 	$Test->setColorPalette(1,144,196,226);
	$Test->setColorPalette(2,174,216,240);  
	$Test->setColorPalette(3,64,140,195);  
	$Test->setColorPalette(4,104,188,209);  
	$Test->setColorPalette(5,99,200,226);  
	$Test->setColorPalette(6,82,124,148);  
	$Test->setColorPalette(7,97,152,183);
	$Test->setColorPalette(8,105,210,231);
	$Test->setColorPalette(9,167,219,216);
	$Test->setColorPalette(10,224,228,204);
	$Test->setColorPalette(11,243,134,48);
// 	$Test->loadColorPalette("/tmp/schema/blue.txt",",");
	$Test->setGraphArea(100,30,790,200);
//       $Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);
     $Test->drawRoundedRectangle(5,5,810,225,5,230,230,230);
	$Test->drawGraphArea(255,255,255,TRUE);
// 	dibujar la grafica
	$Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2,TRUE);
	$Test->drawGrid(4,TRUE,230,230,230,50);
         
         // Draw the line graph

	 // Draw the 0 line
	$Test->setFontProperties($fontFolder.DS."tahoma.ttf",10);
	$Test->drawTreshold(0,143,55,72,TRUE,TRUE);

	   // Draw the bar graph
 $Test->drawBarGraph($DataSet->GetData(),$DataSet->GetDataDescription(),TRUE,80);
//  $Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription()); 
//     $Test->drawXYPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),"Serie1","Serie2");
//     $Test->drawXYPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),"Serie1","Serie3");
//     $Test->drawXYGraph($DataSet->GetData(),$DataSet->GetDataDescription(),"Serie1","Serie2");  

 
    // Finish the graph
	$today = date('Y-m-d');
// 	$Test->setFontProperties($fontFolder.DS."tahoma.ttf",8);
//  	$Test->drawLegend(820,150,$DataSet->GetDataDescription(),255,255,255);
	$Test->setFontProperties($fontFolder.DS."tahoma.ttf",10);

// 	$_today = 
	if(isset($KeyArea)){
	    $area = "_".$KeyArea ;
	}else{
	    $area = "_0";
	}if(isset($Fraccion)){
	    $fraction = "_".$Fraccion ;
	}else{
	    $fraction = "_0";
	}
	$Test->drawTitle(220,22,"Kilometros $ThisArea[$KeyArea] $MyMonth $CurrentYear",50,50,50,585);
	$Test->Render("../../app/webroot/img/thumbs/graph_kms_".$today.$area.$fraction.".png");

     } // End Main hahaha! like C 

} // End Class
?> 
