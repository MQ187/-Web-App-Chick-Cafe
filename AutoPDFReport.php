<?php
	session_start();
	require('mpdf/mpdf.php');
	require('report.php');

	$sd = $_POST['startDate'];
	$ed = $_POST['endDate'];
	
	$reportObj= new report();
	
	$pdfAll = new mPDF();

	//set auto page breaks
	$pdfAll->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set font, manager ID header
	$pdfAll->SetFont('helvetica', '', 9, '', true);
	$pdfAll->SetHeader("Manager ID = ".$_SESSION['id']);

	// Add a page for each report
	$pdfAll->AddPage();

	$htmlRefund = $reportObj->rReportPDF($sd,$ed);
	$htmlOrder = $reportObj->oReportPDF($sd,$ed);
	$htmlCS = $reportObj->csReportPDF($sd,$ed);
	$htmlSP = $reportObj->spReportPDF($sd,$ed);

	$test = 'Period: <b>'.$sd.'</b> to <b>'.$ed.'</b> <br><br>Refund Report' . $htmlRefund . '<br><br>Order Report' . $htmlOrder .
	'<br><br>Customer Spending Report' . $htmlCS . '<br><br>Staff Performance Report' . $htmlSP;
	
	$pdfAll->WriteHTML($test);

	$pdfAll->Output('AllReport.pdf', 'I');
	
	exit;
?>
