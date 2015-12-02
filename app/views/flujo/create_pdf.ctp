<?php
if( (is_string($mkpdf)) && ($mkpdf == 'ServiciosTelefonicos') && !is_numeric($mkpdf) ){
    $title = 'Servicios Telefonicos';
}if( (is_string($mkpdf)) && ($mkpdf == 'ServiciosProgramados') && !is_numeric($mkpdf) ){
    $title = 'Servicios Programados';
}if( (is_string($mkpdf)) && ($mkpdf == 'UnidadesFueraCiudad') && !is_numeric($mkpdf) ){
    $title = 'Unidades Fuera de la Ciudad';
}if( (is_string($mkpdf)) && ($mkpdf == 'UnidadesEnServicio') && !is_numeric($mkpdf) ){
    $title = 'Unidades en Servicio';
}else{}
/** ALERT : This is the default layout for the pdf
 * 
 */
$pdf->core = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->core->SetCreator(PDF_CREATOR);
$pdf->core->SetAuthor('Sekai Hakaimono');
$pdf->core->SetTitle("$title Report");
$pdf->core->SetSubject("Report of $title");
$pdf->core->SetKeywords("TCPDF, PDF, Report, Reporte, $title" );
// set default header data
$pdf->core->SetHeaderData( 'taxi.png', 20 ,"Bitacora $title", "Fecha \t\t\t $date                                                                                                       Semana :\t\t\t $week  \nOperador(a):\t\t\t $username \nTurno :\t\t\t $turno");
// set header and footer fonts
$pdf->core->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->core->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->core->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
$pdf->core->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->core->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->core->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->core->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
$pdf->core->setImageScale(PDF_IMAGE_SCALE_RATIO);


    if( (is_string($mkpdf)) && ($mkpdf == 'ServiciosTelefonicos') && !is_numeric($mkpdf) ){

// the for each in hir for multiple pages
    $pdf->core->SetFont('dejavusans', '', 10);
    $pdf->core->AddPage('P', 'USLETTER');
// 	$html table or loop body
    $pdf->core->writeHTML($html['ServiciosTelefonicos'], true, false, true, false, '');
    $pdf->core->lastPage();
// End for loop
    $pdf->core->Output("Reporte $title $username $date.pdf", 'D');
    }

    if( (is_string($mkpdf)) && ($mkpdf == 'ServiciosProgramados') && !is_numeric($mkpdf) ){

    $pdf->core->SetFont('dejavusans', '', 10);
    $pdf->core->AddPage('P', 'USLETTER');
    // 	$html table or loop body
    $pdf->core->writeHTML($html['ServiciosProgramados'], true, false, true, false, '');
    $pdf->core->lastPage();
    $pdf->core->Output("Reporte $title $username $date.pdf", 'D');
    }

    if( (is_string($mkpdf)) && ($mkpdf == 'UnidadesFueraCiudad') && !is_numeric($mkpdf) ){

	$pdf->core->SetFont('dejavusans', '', 10);
	$pdf->core->AddPage('P', 'USLETTER');
	// 	$html table or loop body
	$pdf->core->writeHTML($html['UnidadesFueraCiudad'], true, false, true, false, '');
	$pdf->core->lastPage();
	$pdf->core->Output("Reporte $title $username $date.pdf", 'D');
    }

    if( (is_string($mkpdf)) && ($mkpdf == 'UnidadesEnServicio') && !is_numeric($mkpdf) ){
	
	$pdf->core->SetFont('dejavusans', '', 10);
	$pdf->core->AddPage('P', 'USLETTER');
	// 	$html table or loop body
	$pdf->core->writeHTML($html['UnidadesEnServicio'], true, false, true, false, '');
	$pdf->core->lastPage();
	$pdf->core->Output("Reporte $title $username $date.pdf", 'D');
    }

    else{
	e('<div id="warning"><span>Warning</span></div>');
    }

?>