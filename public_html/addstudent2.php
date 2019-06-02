<?php

include "opendb.php";
include "rollgen.php";
include "dbstuff.php";
include "writegroup.php";

writehead("SELECT STUDENT",$conn,"addstudent2",0);

$addstudent = sessinfo($conn,'addstudent');

if ($addstudent == 1)
{
	echo "<FORM METHOD=\"POST\" ACTION=\"addstudent3.php\">";
}

if ($addstudent == 2)
{
	echo "<FORM METHOD=\"POST\" ACTION=\"addgroupstudent.php\">";
}

if ($addstudent == 3)
{
	echo "<FORM METHOD=\"POST\" ACTION=\"addgroupbookingstudent.php\">";
}

echo "<input type =\"hidden\" name = \"addmod\" value = \"0\">";

$firstchar = $_POST['sel'];

$sql = "select * from STUDENTS where substring(st_last,1,1) = '".$firstchar."' order by st_last,st_first";

$stud = qry($conn,$sql);

$x = 1;
$y = 0;

while ($st_array = arr($stud))
{
	$content = "<button type=\"submit\" class=\"menu-button\" value = \"".$st_array['stnum']."\" name = \"sel\" ><h150>";
		
	$content = $content .$st_array['st_first']." ".$st_array['st_last']."</h150></button>";

	divmaker(0 + $y*20,0+$x*10,20,10,"white","blue","1","" 
	,$content);

	if ($y == 4)
	{
		$x = $x + 1;
		$y = 0;
	}
	else
	{
		$y = $y + 1;
	}
}	

echo "</FORM>";

if ($addstudent == 1)
{
	echo "<FORM METHOD=\"POST\" ACTION=\"addstudent1.php\">";

	divmaker(0,0,15,10,"white","blue","1","","<button type=\"submit\" class=\"menu-button\" >Back</button>");

	echo "</FORM>";
}
	
if ($addstudent == 2)
{
	echo "<FORM METHOD=\"POST\" ACTION=\"modgroup.php\">";

	divmaker(0,0,15,10,"white","blue","1","","<button type=\"submit\" class=\"menu-button\" >Back</button>");

	echo "</FORM>";
}

echo "</body></html>";
 
?>
