<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

writehead("MAIN MENU",$conn,"mainmenu",1);

$usertype = sessinfo($conn,"User_type");

echo "<input type =\"hidden\" name = \"sel\" value = \"0\">";

echo "<FORM METHOD=\"POST\" ACTION=\"students.php\" >";

$content = "<button type=\"submit\"  class=\"menu-button\" >My Students</button>";

divmaker(10,30,19,19,"","","1","",$content);

echo "</FORM>";

echo "<FORM METHOD=\"POST\" ACTION=\"groups.php\" >";

$content = "<button type=\"submit\" class=\"menu-button\" >My Groups</button>";

divmaker(30,30,19,19,"","","1","",$content);

echo "</FORM>";

echo "<FORM METHOD=\"POST\" ACTION=\"timetable.php\">";

$content = "<button type=\"submit\" class=\"menu-button\" >Time Table</button>";

divmaker(50,30,19,19,"","","1","",$content);
		
echo "</FORM>";


echo "<FORM METHOD=\"POST\" ACTION=\"reports.php\">";

$content = "<button type=\"submit\" class=\"menu-button\" >Reports</button>";

divmaker(70,30,19,19,"","","1","",$content);

echo "</FORM>";
	
echo "<FORM METHOD=\"POST\" ACTION=\"selection.php\">";

$content = "<button type=\"submit\" class=\"menu-button\" >Book Lessons</button>";

divmaker(10,50,19,19,"","","1","",$content);

echo "</FORM>";

echo "<FORM METHOD=\"POST\" ACTION=\"bookgroup.php\">";

$content = "<button type=\"submit\" class=\"menu-button\" >Book Groups</button>";

divmaker(30,50,19,19,"","","1","",$content);

echo "</FORM>";

if ($usertype > 1 ) 
{
	echo "<FORM METHOD=\"POST\" ACTION=\"admin.php\">";

	$content = "<button type=\"submit\" class=\"menu-button\" >Administration</button>";

	divmaker(50,50,19,19,"","","1","",$content);

	echo "</FORM>";
}
else
{
	echo "<FORM METHOD=\"POST\" ACTION=\"avail.php\">";

	$content = "<button type=\"submit\" class=\"menu-button\" >Availability</button>";

	divmaker(50,50,19,19,"","","1","",$content);

	echo "</FORM>";
}	

echo "<FORM METHOD=\"POST\" ACTION=\"logout.php\">";

$content = "<button type=\"submit\" class=\"menu-button\" >Log Out</button>";

divmaker(70,50,19,19,"","","1","",$content);

echo "</FORM>";

$svg = aslogo();

divmaker(75,75,25,23,"","","","",$svg);

echo "</body>\n</html>";

?>