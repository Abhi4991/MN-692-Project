<?php
require('fpdf.php');

$message = filter_input(INPUT_POST, 'sel', FILTER_DEFAULT);

//$pdf = new FPDF();
$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','',8);

$pdf->Cell(40,10,'Hello World!',0,0,'C');
$pdf->SetFont('Arial','',16);
$pdf->Cell(70,20,'Powered by FPDF. 1 60 10',1,0);
$pdf->Cell(70,10,'Powered by FPDF. 90 10',1,1);
$pdf->Cell(40,20,$message,1,0);

$pdf->SetX(1);
$pdf->SetY(1);
		$across = 2;
for ($i = 1; $i <=300; $i++)
{
		$line = 0;
	if ($across > 5)
	{
		$line = 1;
		$across = 1;
	}
	
	$pdf->Cell(55,10,$i." A",1,$line,'C');

	$across++;
}

$pdf->Output();

?>