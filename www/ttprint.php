<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";
require('fpdf.php');

$tenum = SESSINFO($conn,"tenum");
$sessnum = SESSINFO($conn,"SESS");
$term = SESSINFO($conn,"term");
$week = SESSINFO($conn,"week");
//$firstday = SESSINFO($conn,"firstday");
//$lastday = SESSINFO($conn,"lastday");

$startweek = $_POST['startweek'];
$finishweek = $_POST['finishweek'];

$teprintnum = $_POST['tutor'];

$sql = "select first_name,last_name from TUTOR where tenum = ".$teprintnum;

$tutordata = qry($conn,$sql);

$tutor = arr($tutordata);

$tefirst = $tutor['first_name'];
$telast = $tutor['last_name'];

$pdf = new FPDF('L','mm','A4');
//$pdf->AddPage();
$pdf->SetFont('Arial','',8);
$pdf->SetMargins(0,0);

$sql = "SELECT DISTINCT termnum,weeknum FROM DAYS WHERE termnum <> 0 and weeknum <> 0 and daynum >= ".$startweek." and daynum <= ".$finishweek." order by daynum";

$daysreportdata = qry($conn,$sql);

while ($daysreport = arr($daysreportdata))
{

	$sql = "select * from DAYS where termnum = ".$daysreport['termnum']." and weeknum = ".$daysreport['weeknum'];


	$daysdata = qry($conn,$sql);

	while ($days = arr($daysdata))
	{	
		if ($days['dayofweek'] == 1)
		{	
			$firstday = $days['daynum'];
		}
		if ($days['dayofweek'] == 5)
		{
			$lastday = $days['daynum'];
		}
	}	


	$sql = "select * from TRELLIS inner join COURSE on TRELLIS.coursenum = COURSE.coursenum where daynum >= ".
	$firstday." and daynum <= ".$lastday. " and tenum = ".$teprintnum;
	
$trellisdata = qry($conn,$sql);

  $num_rows = mysqli_num_rows($trellisdata);
  
  
  	$sql = "select * from TRELLIS tr inner join GROUPS gr on tr.groupnum = gr.groupnum inner join GROUPBOOKINGTUTORS gt on tr.groupbookingnum = gt.groupbookingnum where daynum >= ".
	$firstday." and daynum <= ".$lastday. " and gt.tenum = ".$teprintnum;
	
	//echo $sql."<BR>";
	
	$trellisgrdata = qry($conn,$sql);
  
    $num_rows = $num_rows + mysqli_num_rows($trellisgrdata);
   
  
  if ($num_rows == 0)
  {	
	
	
  }		
	else
	{		
		
	$pdf->AddPage();

		$sql = "select MIN(block) minblock, MAX(block) maxblock from TRELLIS where daynum >= ".$firstday." and daynum <= ".$lastday. " and tenum = ".$teprintnum;
		
		$trellisblockdata = qry($conn,$sql);
		
		$trellisblock = arr($trellisblockdata);
		
		$minblock = $trellisblock['minblock'];
		$maxblock = $trellisblock['maxblock'];
		
		$sql = "select Min(block) minblock, MAX(block) maxblock from TRELLIS tr inner join GROUPS gr on tr.groupnum = gr.groupnum inner join GROUPTUTORS gt on gr.groupnum = gt.groupnum where daynum >= ".
	$firstday." and daynum <= ".$lastday. " and gt.tenum = ".$teprintnum;
		
		$trellisblockdata = qry($conn,$sql);
		
		$trellisblock = arr($trellisblockdata);
		
		If (empty($minblock))
		{
		$minblock= $trellisblock['minblock'];
		}
		If (empty($maxblock))
		{
		$maxblock = $trellisblock['maxblock'];
		}
				
		
		$sql = "SELECT MAX(blocknum) as starttime FROM `TIMES` WHERE truncate(blocknum/12,0) = blocknum/12 and blocknum < ".$minblock;
		
		$timesdata = qry($conn,$sql);
		
		$times = arr($timesdata);
		
		$startblock = $times['starttime'] + 1;
		
		$sql = "SELECT count(*) as recs FROM `TIMES` WHERE truncate(blocknum/12,0) = blocknum/12 and blocknum >= ".$minblock." and blocknum <= ".$maxblock;
		
		$timesdata = qry($conn,$sql);
		
		$times = arr($timesdata);
		
		$dispsteps = $times['recs'] + 1; 
		
	$pdf->SetFont('Arial','',18);
	$pdf->Cell(200,10,"Tutor: ".$tefirst." ".$telast." Term ".$daysreport['termnum']." Week ".$daysreport['weeknum'],0,1,'C');
		
		$pdf->SetFont('Arial','',15);
	
	$dayname = array("Monday","Tuesday","Wednesday","Thursday","Friday");

for ($i=0;$i <= 4;$i++)
{
	
$pdf->Cell(50,10,$dayname[$i],0,0,'C');

}

	$pdf->Cell(0,10,'',0,1);
	
	$pdf->SetFont('Arial','',15);
for ($i=0;$i <= 4;$i++)

{


$dispdate = daydate($conn,$firstday+$i);

$pdf->Cell(50,10,$dispdate,0,0,'C');

}


$last_day = 0;
$last_block = 0;

$pdf->SetFont('Arial','',8);

//$pdf->SetTextColor(219,238,221);
$pdf->SetMargins(0,0);
for ($int=0;$int<=$dispsteps;$int++)
{
//		$blocktime = $startblock+$int*16;
		
		$disptime = $startblock+$int*12;
						
		if (strlen(daytime($conn,$disptime)) == 7)
		{
			$content = " ".substr(daytime($conn,$disptime),0,1)." ".substr(daytime($conn,$disptime),5,2);
		}
		else
		{
			$content = substr(daytime($conn,$disptime),0,2)." ".substr(daytime($conn,$disptime),6,2);
		}			
				
		$pdf->SetXY(0,($int*15)+28);
		
		$pdf->Cell(5,5,$content,0,0);

				
}
$pdf->SetTextColor(0,0,0);

		


$pdf->SetFillColor(255,255,255);

while ($trellis = arr($trellisdata))
{
		
	$top = (($trellis['block'] - $startblock))*1.28+28;
	$height = $trellis['lesson_length']*1.2;
	$left = ($trellis['daynum'] - $firstday)*50 + 10;

$pdf->SetXY($left,$top);
	$pdf->SetFont('Arial','',12);
$pdf->Cell(50,$height-3,$trellis['description'],'LTR',0,'C');

$pdf->SetXY($left,$top+$height-3);

	$timedisp = daytime($conn,$trellis['block'])."-".daytime($conn,$trellis['block']+$trellis['lesson_length']);
	$pdf->SetFont('Arial','',8);
$pdf->Cell(50,3,$timedisp,'LBR',0,'C');
}
	
while ($trellisgr = arr($trellisgrdata))
{

	$top = (($trellisgr['block'] - $startblock))*1.28+28;
	$height = $trellisgr['lesson_length']*1.2;
	$left = ($trellisgr['daynum'] - $firstday)*50 + 10;

$pdf->SetXY($left,$top);
	$pdf->SetFont('Arial','',12);
$pdf->Cell(50,$height-3,$trellisgr['description'],'LTR',0,'C');

$pdf->SetXY($left,$top+$height-3);

	$timedisp = daytime($conn,$trellisgr['block'])."-".daytime($conn,$trellisgr['block']+$trellisgr['lesson_length']);
	$pdf->SetFont('Arial','',8);
$pdf->Cell(50,3,$timedisp,'LBR',0,'C');
}	
	
}
	//$pdf->AddPage();
}

$pdf->Output();

?>

