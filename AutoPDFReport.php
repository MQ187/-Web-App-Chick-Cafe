<?php
	session_start(); //start the session
	require('mpdf/mpdf.php');
	require('report.php');
	//include the external mpdf and report file

	$sd = $_POST['startDate'];
	$ed = $_POST['endDate'];
	//set the start and end date
	
	$reportObj= new report();
	//make new instance of report
	
	$pdfAll = new mPDF();
	//make new instance of mPDF

	//set auto page breaks
	$pdfAll->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set font, manager ID header
	$pdfAll->SetFont('helvetica', '', 9, '', true);
	$pdfAll->SetHeader("Manager ID = ".$_SESSION['id']);

	// Add a page for each report
	$pdfAll->AddPage();

	//create all four reports but the active customer report
	$htmlRefund = $reportObj->rReportPDF($sd,$ed);
	$htmlOrder = $reportObj->oReportPDF($sd,$ed);
	$htmlCS = $reportObj->csReportPDF($sd,$ed);
	$htmlSP = $reportObj->spReportPDF($sd,$ed);

	//add them to test variable
	$test = 'Period: <b>'.$sd.'</b> to <b>'.$ed.'</b> <br><br>Refund Report' . $htmlRefund . '<br><br>Order Report' . $htmlOrder .
	'<br><br>Customer Spending Report' . $htmlCS . '<br><br>Staff Performance Report' . $htmlSP;
	
	//write the tables to the pdf
	$pdfAll->WriteHTML($test);

	//output the tables in a new pdf
	$pdfAll->Output('AllReport.pdf', 'I');
	
	exit;
?>
