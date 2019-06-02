<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

writehead("SELECTIONS",$conn,"selection",0);

updownweek(80,0,False);

$term = SESSINFO($conn,"term");
$week = SESSINFO($conn,"week");
$coursedisp = SESSINFO($conn,"coursedisp");
sessupdate($conn,"addtutor",2);

echo "<FORM METHOD=\"POST\" ACTION=\"coursedisp.php\">";

if ($coursedisp == 0 )
{
	$content = "<button type=\"submit\" class=\"menu-button\" ><h150>Show All Courses</h150></button> ";
}
else
{
	$content = "<button type=\"submit\" class=\"menu-button\" ><h150>Show Unbooked Courses</h150></button> ";
}

divmaker(65,0,15,10,"","","","position: fixed;",$content);

echo "</FORM>";

echo "<FORM METHOD=\"POST\" ACTION=\"autobook1L.php\">";

divmaker(55,0,10,10,"white","blue","1","position: fixed;","<button type=\"submit\" class=\"menu-button\" ><h150>Auto Book</h150></button>");

echo "</FORM>\n";

echo "<FORM METHOD=\"POST\" ACTION=\"timetable.php\">";

divmaker(45,0,10,10,"white","blue","1","position: fixed;","<button type=\"submit\" class=\"menu-button\" ><h150>Time table</h150></button>");

echo "</FORM>\n";

divmaker(15,0,30,10,"white","blue","","position: fixed;","<button type=\"submit\" class= \"labelwhite\" disabled><h200><center>Term ".$term." Week ".$week."</center></h200></button>");

$firstday = SESSINFO($conn,"firstday");

$lastday = SESSINFO($conn,"lastday");

$tenum = SESSINFO($conn,"tenum");

$stql = "SELECT * FROM COURSE AS CO INNER JOIN COURSELIST AS CL ON CO.coursenum = CL.coursenum INNER JOIN STUDENTS AS ST ON CL.stnum = ST.stnum where CO.tutor = $tenum and courseactive = 1";

if ($coursedisp == 0)
{	
$stql = $stql . " and not exists(select * from TRELLIS where coursenum = CO.coursenum and daynum >= $firstday and daynum <= $lastday)";
}

$stql = $stql . " order by ST.st_last,ST.st_first";

$stud = qry($conn,$stql);

echo "<FORM METHOD=\"POST\" ACTION=\"timebook.php\">";

$x = 1;
$y = 0;

while ($cl_array = arr($stud))
{
	$content = "<button type=\"submit\" value = \"".$cl_array['coursenum']."\" class=\"mediummenu-button\" name = \"sel\" >";
		
	$content = $content ."<h150>".$cl_array['description']."</h150></button>";

	divmaker(0 + $y,$x*10+5,25,10,"white","blue","1","",$content);
	
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

echo "<FORM METHOD=\"POST\" ACTION=\"menu.php\">";

		divmaker(0,0,15,10,"white","blue","1","position: fixed;","<button type=\"submit\" class=\"menu-button\" ><h200>Main Menu</h200></button>");

echo "</FORM>\n";

echo "</body>\n</html>";
?>