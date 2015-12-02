<?php
class PchartsController extends AppController {
     public  $name = 'Pcharts';
     //1   
     public  $uses = null;                                                         
     
      
     public function index(){      
         //2
         $this->autoRender = false;
          
         //3                                               
         App::import('Vendor','pData', array('file' =>'pchart'.DS.'pData.class')); 
         App::import('Vendor','pChart', array('file' =>'pchart'.DS.'pChart.class'));
          
         //4
         $fontFolder = APP.'vendors'.DS.'pchart'.DS.'Fonts';
//          $SchemaFolder = APP.'vendors'.DS.'pchart'.DS.'schema';
          
         //5
         // Dataset definition
        $DataSet = new pData;
	$DataSet->AddPoint(array(1,4,-3,2,-3,3,2,1,0,7,4),"Serie1");
	$DataSet->AddPoint(array(3,3,-4,1,-2,2,1,0,-1,6,3),"Serie2");
	$DataSet->AddPoint(array(4,1,2,-1,-4,-2,3,2,1,2,2),"Serie3");
	$DataSet->AddPoint(array(4,1,2,-1,-4,-2,3,2,1,2,2),"Serie4");
	$DataSet->AddPoint(array(4,5,2,-1,-2,-2,1,2,1,3,4),"Serie5");
	$DataSet->AddPoint(array(4,5,2,-1,-2,-2,1,2,1,3,4),"Serie6");
	$DataSet->AddPoint(array(4,5,2,-1,-2,-2,1,2,1,3,4),"Serie7");
	$DataSet->AddPoint(array(4,5,2,-1,-2,-2,1,2,1,3,4),"Serie8");
	$DataSet->AddPoint(array(4,5,2,-1,-2,-2,1,2,1,3,4),"Serie9");
	$DataSet->AddPoint(array(4,5,2,-1,-2,-2,1,2,1,3,4),"Serie10");
	$DataSet->AddPoint(array(4,5,2,-1,-2,-2,1,2,1,3,4),"Serie11");
	$DataSet->AddPoint(array(4,5,2,-1,-2,-2,1,2,1,3,4),"Serie12");
	$DataSet->AddAllSeries();
	$DataSet->SetAbsciseLabelSerie();
	$DataSet->SetSerieName("Enero","Serie1");
	$DataSet->SetSerieName("Febrero","Serie2");
	$DataSet->SetSerieName("Marzo","Serie3");
	$DataSet->SetSerieName("Abril","Serie4");
	$DataSet->SetSerieName("Mayo","Serie5");
	$DataSet->SetSerieName("Junio","Serie6");
	$DataSet->SetSerieName("Julio","Serie7");
	$DataSet->SetSerieName("Agosto","Serie8");
	$DataSet->SetSerieName("Septiembre","Serie9");
	$DataSet->SetSerieName("Octubre","Serie10");
	$DataSet->SetSerieName("Noviembre","Serie11");
	$DataSet->SetSerieName("Diciembre","Serie12");
         
         // Initialise the graph
//          pr($SchemaFolder);
	$Test = new pChart(800,260);
	$Test->setFontProperties($fontFolder.DS."tahoma.ttf",8);
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
	$Test->setGraphArea(50,30,680,200);
//      $Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);
     $Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);
	$Test->drawGraphArea(255,255,255,TRUE);
	$Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2,TRUE);
	$Test->drawGrid(4,TRUE,230,230,230,50);
         
         // Draw the line graph
//          $Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());
//          $Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);
	 // Draw the 0 line
	$Test->setFontProperties($fontFolder.DS."tahoma.ttf",6);
	$Test->drawTreshold(0,143,55,72,TRUE,TRUE);

//          // Finish the graph
//          $Test->setFontProperties($fontFolder.DS."tahoma.ttf",8);
//          $Test->drawLegend(45,35,$DataSet->GetDataDescription(),255,255,255);
//          $Test->setFontProperties($fontFolder.DS."tahoma.ttf",10);
//          $Test->drawTitle(60,22,"My pretty graph",50,50,50,585);
//          $Test->Stroke();
// //          $Test->Render("example1.png");
//  $Test->Render("/tmp/graph-$today.png");
	   // Draw the bar graph
 $Test->drawBarGraph($DataSet->GetData(),$DataSet->GetDataDescription(),TRUE,80);


 
    // Finish the graph
	$today = date('Y-m-d');
	$Test->setFontProperties($fontFolder.DS."tahoma.ttf",8);
//  $Test->drawLegend(596,150,$DataSet->GetDataDescription(),255,255,255);
	$Test->setFontProperties($fontFolder.DS."tahoma.ttf",10);
	$Test->drawTitle(50,22,"Grafica de 2014",50,50,50,585);
	$Test->Render("/home/ambagasdowa/web/projections/app/webroot/img/thumbs/graph-$today.png");
// 	$Test->stroke();

     } 
      
 }
 
/*- See more at: http://www.startutorial.com/articles/view/how-to-use-pchart-in-cakephp#sthash.WNkC7gn1.dpuf */
?>

