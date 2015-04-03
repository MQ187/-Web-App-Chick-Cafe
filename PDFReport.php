<?php
	session_start();
	require_once('mpdf/mpdf.php');
	require('report.php');
	
	$reportObj= new report();
	$type = $_SESSION['reportType'];
	$pdf = new mPDF();

	$pdf->SetAuthor($_SESSION['id']);
	$pdf->SetTitle('Refund Report');

	//set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set font
	$pdf->SetFont('helvetica', '', 9, '', true);

	$pdf->SetHeader("Manager ID = ".$_SESSION['id']);
	// Add a page 
	$pdf->AddPage();

	Switch($type){
		case "refund":
			$html = $reportObj->rReportPDF($_SESSION['startDate'],$_SESSION['endDate']);
			break;

		case "order":
			$html = $reportObj->oReportPDF($_SESSION['startDate'],$_SESSION['endDate']);
			break;

		case "activeCustomer":
			$html = $reportObj->acReportPDF();
			break;

		case "customerSpending":
			$html = $reportObj->csReportPDF($_SESSION['startDate'],$_SESSION['endDate']);
			break;
	}

	$pdf->WriteHTML($html);

	Switch($type){
		case "refund":
			$pdf->Output('RefundReport.pdf', 'I');
			break;

		case "order":
			$pdf->Output('OrderReport.pdf', 'I');
			break;

		case "activeCustomer":
			$pdf->Output('ActiveCustomerReport.pdf', 'I');
			break;

		case "customerSpending":
			$pdf->Output('CustomerSpendingReport.pdf', 'I');
			break;
	}

	unset($_SESSION['startDate']);
	unset($_SESSION['endDate']);
	exit;
?>
