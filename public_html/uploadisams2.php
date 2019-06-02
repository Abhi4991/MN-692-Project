<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

writehead("UPLOAD iSAMS2",$conn,"uploadisams2",0);

divmaker(40,45,25,5,"","","","
text-align: left;","<button type=\"submit\"  class=\"label\"  disabled><h200>Uploading Staff</h200></button>");


$url = "https://developerdemo.isams.cloud/api/batch/1.0/xml.ashx?apiKey=0A1C996B-8E74-4388-A3C4-8DA1E40ADA57";
$xm = file_get_contents($url);

$xml = simplexml_load_string($xm);

$count = 0;

             foreach($xml->PupilManager->CurrentPupils->Pupil as $pupil)
			{   


addstudent($conn,$xml->PupilManager->CurrentPupils->Pupil[$count]["Id"],$pupil->Surname,$pupil->Preferredname);
$count++;	

				
            }

function addstudent($conn,$st_code,$st_last,$st_first)
{
	
$sql = "select st_code from STUDENTS where st_code = '".$st_code."'";

$studentdata = qry($conn,$sql);

  $num_rows = mysqli_num_rows($studentdata);
  
	if ($num_rows == 0)
	{
		$sql = "INSERT INTO STUDENTS (st_code,st_last,st_first) values ('".$st_code."','".$st_last."','".$st_first."')";
		qry($conn,$sql);
	}
	return;
}

?><script type="text/javascript">

window.location.href = "uploadisams3.php";

</script>