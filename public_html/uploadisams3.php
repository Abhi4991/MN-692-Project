<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

writehead("UPLOAD iSAMS3",$conn,"uploadisams3",0);

divmaker(40,45,25,5,"","","","
text-align: left;","<button type=\"submit\"  class=\"label\"  disabled><h200>Uploading Periods</h200></button>");


$url = "https://developerdemo.isams.cloud/api/batch/1.0/xml.ashx?apiKey=E370EE48-0A72-48E4-A926-FE8916F99570";
$xm = file_get_contents($url);

$xml = simplexml_load_string($xm);

$count = 0;

             foreach($xml->HRManager->CurrentStaff->StaffMember as $staff)
			{   

addstaff($conn,$xml->HRManager->CurrentStaff->StaffMember[$count]["Id"],$staff->Surname,$staff->Forename);
$count++;	
			
            }

Function addstaff($conn,$te_code,$te_last,$te_first)
{
	
$sql = "select te_code from TEACHERS where te_code = '".$te_code."'";

$studentdata = qry($conn,$sql);

  $num_rows = mysqli_num_rows($studentdata);
  
	if ($num_rows == 0)
	{
		$sql = "INSERT INTO TEACHERS (te_code,te_last,te_first) values ('".$te_code."','".$te_last."','".$te_first."')";
		qry($conn,$sql);
	}
	return;
}

?>
<script type="text/javascript">

window.location.href = "uploadisams4.php";

</script>