<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

writehead("UPLOAD iSAMS5",$conn,"uploadisams5",0);

divmaker(40,45,25,5,"","","","
text-align: left;","<button type=\"submit\"  class=\"label\"  disabled><h200>Uploading Timetable</h200></button>");


$url = "https://developerdemo.isams.cloud/api/batch/1.0/xml.ashx?apiKey=E4DBF841-72A2-4193-9977-7AC21FC2B4E8";
$xm = file_get_contents($url);

$xml = simplexml_load_string($xm);

foreach($xml->TeachingManager->Departments->Department as $department)
{   

	if (@count($department->Subjects->Subject) <> 0)
	{
		foreach($department->Subjects->Subject as $subject)
		{
		$clnum = $subject['Id'];
		$class_code = $subject->Code;
		$class_desc = $subject->Name;
		
		addclass($conn,$clnum,$class_code,$class_desc);
		}		
	}
}

Function addclass($conn,$clnum,$class_code,$class_desc)
{
	
$sql = "select clnum from CLASS where clnum = ".$clnum;

$classdata = qry($conn,$sql);

  $num_rows = mysqli_num_rows($classdata);
  
	if ($num_rows == 0)
	{
		$sql = "INSERT INTO CLASS(clnum,class_code,class_desc) values (".$clnum.",'".$class_code."','".$class_desc."')";
		qry($conn,$sql);
	}
	return;
}
?>
<script type="text/javascript">

window.location.href = "uploadisams6.php";

</script>