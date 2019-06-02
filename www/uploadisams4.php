<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

writehead("UPLOAD iSAMS4",$conn,"uploadisams4",0);

divmaker(40,45,25,5,"","","","
text-align: left;","<button type=\"submit\"  class=\"label\"  disabled><h200>Uploading Subjects</h200></button>");

$url = "https://developerdemo.isams.cloud/api/batch/1.0/xml.ashx?apiKey=7B69F223-E4CC-42E8-B32C-F11A74359B7A";
$xm = file_get_contents($url);

$xml = simplexml_load_string($xm);

$count = 0;

foreach($xml->TimetableManager->Structure->Week as $week)
{   

$weeknum = $week['Id'];
				
	foreach($week->Days->Day as $days)
	{
	$daynum = $days['Id'];
		
		foreach($days->Periods->Period as $period)
		{

			
			$periodnum = $period['Id'];
			$name = $period->Name;
			
			$sql = " select * from TIMES where 24disp >= '".substr($period->StartTime,0,2).substr($period->StartTime,3,2)."' and 24disp <= '".substr($period->StartTime,0,2).substr($period->StartTime,3,2)."'";
			
			$timesdata = qry($conn,$sql);
			
							
			$timess = arr($timesdata);
			
			$perstart = $timess['blocknum'];
						
			$sql = " select * from TIMES where 24disp >= '".substr($period->EndTime,0,2).substr($period->EndTime,3,2)."' limit 1 ";
					
			$timesdata = qry($conn,$sql);
				
			$timesf = arr($timesdata);
						
			$perlength = $timesf['blocknum'] - $timess['blocknum'];
			
			addperiod($conn,$weeknum,$daynum,$periodnum,$name,$perstart,$perlength);
			
		}
			
	}

$count++;	
				
}

Function addperiod($conn,$weeknum,$daynum,$periodnum,$name,$perstart,$perlength)
{
	
$sql = "select periodnum from PERIODNAMES where periodnum = ".$periodnum;

$perioddata = qry($conn,$sql);

  $num_rows = mysqli_num_rows($perioddata);
  
	if ($num_rows == 0)
	{
		$sql = "INSERT INTO PERIODNAMES (weeknum,daynum,periodnum,perstart,perlength,Name) values ('".$weeknum."',".$daynum.",".$periodnum.",".$perstart.",".$perlength.",'".$name."')";
		qry($conn,$sql);
	}
	return;
}
?>
<script type="text/javascript">

window.location.href = "uploadisams5.php";

</script>