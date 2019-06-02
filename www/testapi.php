<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

writehead("ADMIN MENU",$conn,"adminmenu",0);


$url = "https://developerdemo.isams.cloud/api/batch/1.0/xml.ashx?apiKey=0A1C996B-8E74-4388-A3C4-8DA1E40ADA57";
$xm = file_get_contents($url);

$xml = simplexml_load_string($xm);

$count = 0;

             foreach($xml->PupilManager->CurrentPupils->Pupil as $pupil)
			{   

/*				echo $count." count ";
				
				echo $xml->PupilManager->CurrentPupils->Pupil[$count]["Id"]." Pupil ID ";
				echo $pupil->UPN." ";
				echo $pupil->SchoolCode." ";
				echo $pupil->SchoolId." ";
				echo $pupil->Title." ";
				echo $pupil->Preferredname." ";
				echo $pupil->Surname." ";
			
				echo "<BR> ";	*/
				

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
		$addstudent = qry($conn,$sql);
	}
	return;
}


 
echo "<FORM METHOD=\"POST\" ACTION=\"admin.php\">";

$content = "<button type=\"submit\"><h200>Admin Menu</h200></button>";

divmaker(0,80,20,10,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);

echo "</FORM>";









?>