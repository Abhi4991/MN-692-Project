<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

writehead("UPLOAD iSAMS5",$conn,"uploadisams5",0);

divmaker(40,45,25,5,"","","","
text-align: left;","<button type=\"submit\"  class=\"label\"  disabled><h200>Uploads Complete</h200></button>");



$url = "https://developerdemo.isams.cloud/api/batch/1.0/xml.ashx?apiKey=5123373A-009B-401C-AB79-6A61E5FE13CD";
$xm = file_get_contents($url);

$xml = simplexml_load_string($xm);

foreach($xml->TimetableManager->Timetable->Pupils as $pupils)
{   

	if (@count($pupils->Pupil) <> 0)
	{
		foreach($pupils->Pupil as $pupil)
		{
		$stcode = $pupil['Id'];
		
		$sql = "select stnum from STUDENTS where st_code = ".$stcode;
		
		$studentsdata = qry($conn,$sql);

		$students = arr($studentsdata);
		
		$stnum = $students['stnum'];
		
			if (@count($pupils->Pupil->Periods) <> 0)
			{
				foreach($pupils->Pupil->Periods->Period as $period)
				{
				$periodid = $period['Id'];
				$clnum = $period['SubjectId'];
				$tenum = $period['TeacherId'];
				
				
				//echo $periodid."<BR>";
				//echo $clnum."<BR>";
				
					if ($clnum <> 0 and $stnum <> 0)
					{
					addstlist($conn,$clnum,$stnum);
					addtimetable($conn,$periodid,$clnum,$tenum);
					}
				}
			}

		}		
	}
}

Function addstlist($conn,$clnum,$stnum)
{
	
$sql = "select stnum from STLIST where stnum = ".$stnum." and clnum = ".$clnum;

$stlistdata = qry($conn,$sql);

  $num_rows = mysqli_num_rows($stlistdata);
  
	if ($num_rows == 0)
	{
		$sql = "INSERT INTO STLIST(clnum,stnum) values (".$clnum.",".$stnum.")";
		$addstlist = qry($conn,$sql);
	}
	return;
}
Function addtimetable($conn,$periodid,$clnum,$tenum)
{

$sql = "select * from PERIODNAMES where periodnum = ".$periodid;

$periodnamesdata = qry($conn,$sql);

$periodnames = arr($periodnamesdata);

$sql = "select tenum from TIMETABLE where tenum = ".$tenum." and clnum = ".$clnum." and ttper = ".$periodid;

$timetabledata = qry($conn,$sql);

  $num_rows = mysqli_num_rows($timetabledata);
  
	if ($num_rows == 0)
	{
		$sql = "INSERT INTO TIMETABLE(tenum,clnum,ttday,ttper,perstart,perlength)
		values (".$tenum.",".$clnum.",".$periodnames['daynum'].",".$periodnames['periodnum'].",".$periodnames['perstart'].
		",".$periodnames['perlength'].")";
		
		qry($conn,$sql);
	}
	return;
}
?>
<script type="text/javascript">
function adminmenu()
{
window.location.href = "admin.php";
}
setTimeout(adminmenu,2000);
</script>