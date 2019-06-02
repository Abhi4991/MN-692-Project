<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

writehead("SELECTIONS",$conn,"selection",0);

$tenum = SESSINFO($conn,"tenum");

$stql = "SELECT * 
FROM COURSE AS CO
INNER JOIN COURSELIST AS CL 
ON CO.coursenum = CL.coursenum
INNER JOIN STUDENTS AS ST
ON CL.stnum = ST.stnum

where CO.tutor = ".$tenum;

$stql = $stql . " order by ST.st_last,ST.st_first";

$stud = qry($conn,$stql);

echo "<FORM METHOD=\"POST\" ACTION=\"addstudent3.php\">";

echo "<input type =\"hidden\" name = \"addmod\" value = \"1\">";

$x = 1;
$y = 0;

while ($cl_array = arr($stud))
	
{

	$content = "<button type=\"submit\" class=\"menu-button\" value = \"".$cl_array['coursenum']."\" name = \"sel\" >";
		
	$content = $content ."<h150>".$cl_array['description']."</h150></button>";

	divmaker(0 + $y,$x*10+5,25,10,"white","blue","1",""
	,$content);
	
	if ($y < 75 )
	{
		$y = $y + 25;
	}
	else
	{
		$y = 0;
		$x = $x + 1;
	}	

}	

echo "</FORM>\n";

echo "<FORM METHOD=\"POST\" ACTION=\"students.php\">";

		divmaker(0,0,15,10,"white","blue","1","
text-align: center;" 
,"<button type=\"submit\" class=\"menu-button\" ><h200>Back</h200></button>");

echo "</FORM>\n";

echo "</body>\n
</html>";
?>