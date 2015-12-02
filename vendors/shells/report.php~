<?php
class ReportShell extends Shell {
    var $uses = array(/*'Ingresos',*/'TonelajeCurrent');
//     var $params = array('');
    
    function main(){
      $ThisArea = array('1'=>'Orizaba','2'=>'Guadalajara','3'=>'Ramos Arizpe','4'=>'Tijuana');
    if (!($this->args)) {
	 $this->help();
         $this->err(__('Usage report <id_area> <id_fraccion> <year> <month> <all_areas> ', true));
         $this->_stop();
      }
      $KeyArea = $this->args[0];
      $Fraccion = $this->args[1];
      $CurrentYear = $this->args[2];
      $CurrentMonth = $this->args[3];
      $all = $this->args[4];

      $args = $this->args;
      $this->out(pr($args));
      
      $NumDays = date('t',mktime('0','0','0',$CurrentMonth,'01',$CurrentYear));

      if(empty($all) && !empty($KeyArea) && !empty($CurrentMonth)){ // CurrentMonth Area
      $TonelajeConditions['TonelajeCurrent.fecha_guia LIKE'] = "%".$CurrentYear."-".$CurrentMonth."%";
      $TonelajeConditions['TonelajeCurrent.id_area'] = $KeyArea;
      $TonelajeConditions['TonelajeCurrent.id_fraccion'] = $Fraccion;
      }if($all == true && $KeyArea == false && $CurrentMonth == false){ // AllYear 
      $TonelajeConditions['TonelajeCurrent.fecha_guia LIKE'] = "%".$CurrentYear."%";
      $TonelajeConditions['TonelajeCurrent.id_fraccion'] = $Fraccion;
      }if($all == true && $KeyArea > 0 && $CurrentMonth == false ){ // AllYearArea
      $TonelajeConditions['TonelajeCurrent.fecha_guia LIKE'] = "%".$CurrentYear."%";
      $TonelajeConditions['TonelajeCurrent.id_area'] = $KeyArea;
      $TonelajeConditions['TonelajeCurrent.id_fraccion'] = $Fraccion;
      }
      
//       $this->out(pr($TonelajeConditions));exit();
      
//       $TonelajeConditions['TonelajeCurrent.fecha_guia LIKE'] = "%".$CurrentYear."-".$CurrentMonth."%";
//       $TonelajeConditions['TonelajeCurrent.id_area'] = $KeyArea;
//       $TonelajeConditions['TonelajeCurrent.id_fraccion'] = $Fraccion;
      
//       $this->out(pr($TonelajeConditions));exit();
      $report = $this->TonelajeCurrent->find('all',array('conditions'=>$TonelajeConditions));
      $toneladas = null;
      $report_day = array();
      $report_year = array();
//     $this->out(pr($report));exit();
      foreach($report as $key => $data){
	    if($data['TonelajeCurrent']['status_guia'] == ' B'){
	      $canceladas[] = $data;
	    }
	    $MyMonth = date('M',mktime('0','0','0',$CurrentMonth,'01',$CurrentYear));
// 	    $this->out(pr($data));
// 	    $report_day['00'] = '0';
	    if($data['TonelajeCurrent']['status_guia'] !== ' B'){
		$toneladas += $data['TonelajeCurrent']['peso'] ;
		$counter[] = $data['TonelajeCurrent']['peso'] ;
		$day = substr($data['TonelajeCurrent']['fecha_guia'],8,2);
		$report_day[$day] += $data['TonelajeCurrent']['peso'];
	    }
	  } // End foreach $report
	  /** ALERT Save the result for Display in the view
	  */
	  
//       $this->out(pr($report_day));exit();
//       $this->out($NumDays);
//       $this->out($MyMonth);
//       exit();

//       $this->out(count($counter));exit();
         //2
         $this->autoRender = false;
          
         //3                                               
         App::import('Vendor','pData', array('file' =>'pchart'.DS.'pData.class')); 
         App::import('Vendor','pChart', array('file' =>'pchart'.DS.'pChart.class'));
          
         //4
         $fontFolder = APP.'vendors'.DS.'pchart'.DS.'Fonts';
         $fontFolder = '..'.DS.'..'.DS.'vendors'.DS.'pchart'.DS.'Fonts';
//          $SchemaFolder = APP.'vendors'.DS.'pchart'.DS.'schema';

         //5
         // Dataset definition
        $DataSet = new pData;
	$MaxTons = max($report_day);
	$MaxTons = $MaxTons+100;
	
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
        $DataSet->SetSerieName("Toneladas","Serie1");
        $DataSet->SetSerieName("Dia","Serie2");        
	$DataSet->SetYAxisName("Toneladas Dias");  
	$DataSet->SetYAxisUnit("Ton");
	$DataSet->SetXAxisName("Dias");
	$DataSet->SetXAxisFormat("number");
	  
	
         // Initialise the graph
//          pr($SchemaFolder);
	$Test = new pChart(820,260);
	
	$Test->setFixedScale(1,$MaxTons,5,0,$NumDays,5);
	$Test->setDateFormat("H:m");
	$Test->setFontProperties($fontFolder.DS."tahoma.ttf",10);
	$Test->setColorPalette(0,115,173,207);
	$Test->setColorPalette(1,144,196,226);
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
	
       if(empty($all) && !empty($KeyArea) && !empty($CurrentMonth)){ // CurrentMonth Area
	$Test->drawTitle(220,22,"Toneladas $ThisArea[$KeyArea] $MyMonth $CurrentYear",50,50,50,585);
	$Test->Render("../../app/webroot/img/thumbs/graph_".$today."_".$KeyArea."_".$Fraccion.".png");
      }if($all == true && $KeyArea == false && $CurrentMonth == false){ // AllYear 
	$Test->drawTitle(220,22,"Toneladas $CurrentYear",50,50,50,585);
	$Test->Render("../../app/webroot/img/thumbs/graph_".$CurrentYear."_".$KeyArea.".png");
      }if($all == true && $KeyArea > 0 && $CurrentMonth == false ){ // AllYearArea
      	$Test->drawTitle(220,22,"Toneladas $ThisArea[$KeyArea] $CurrentYear",50,50,50,585);
	$Test->Render("../../app/webroot/img/thumbs/graph_".$CurrentYear."_".$KeyArea.".png");
      }
     
// 	$Test->drawTitle(220,22,"Toneladas $MyMonth $CurrentYear",50,50,50,585);
// 	$Test->Render("../../app/webroot/img/thumbs/graph_".$today."_".$KeyArea."_".$Fraccion.".png");

     } 

} // End Class
?> 
