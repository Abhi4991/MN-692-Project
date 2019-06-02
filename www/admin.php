<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

writehead("ADMIN MENU",$conn,"adminmenu",0);

$usertype = sessinfo($conn,"User_type");

sessupdate($conn,'addtutor',1);


echo "<input type =\"hidden\" name = \"sel\" value = \"0\">";


echo "<FORM METHOD=\"POST\" ACTION=\"tutors.php\">";

echo "<input type =\"hidden\" name = \"camefrom\" value = \"1\">";
$content = "<button type=\"submit\" class=\"menu-button\">Manage Tutors</button>";

divmaker(40,30,19,19,"white","blue","1","" 
,$content);
		

echo "</FORM>";

echo "<FORM METHOD=\"POST\" ACTION=\"updateweek.php\">";

$content = "<button type=\"submit\" class=\"menu-button\">Update Week</button>";


	
divmaker(20,50,19,19,"white","blue","1","font-size: 200%;
text-align: center" 
,$content);
		

echo "</FORM>";

echo "<FORM METHOD=\"POST\" ACTION=\"lessonlist.php\">";

$content = "<button type=\"submit\" class=\"menu-button\">Lesson List</button>";


	
divmaker(20,30,19,19,"white","blue","1","font-size: 200%;
text-align: center" 
,$content);
		

echo "</FORM>";


echo "<FORM METHOD=\"POST\" ACTION=\"seltutor.php\">";

$content = "<button type=\"submit\" class=\"menu-button\">Availability</button>";

divmaker(40,50,19,19,"white","blue","1","font-size: 200%;
text-align: center" 
,$content);

echo "</FORM>";

if ($usertype == 3)
{

echo "<FORM METHOD=\"POST\" ACTION=\"super.php\">";
	
	$content = "<button type=\"submit\" class=\"menu-button\">Super User</button>";
	

	divmaker(80,0,19,19,"white","blue","1",""
,$content); 

echo "</FORM>";

}

/*echo "<FORM METHOD=\"POST\" ACTION=\"autobook.php\" >";

$content = "<button type=\"submit\" class=\"menu-button\">Auto Book</button>";

divmaker(0,30,19,19,"white","blue","1","" 
,$content);
	
echo "</FORM>";
*/
echo "<FORM METHOD=\"POST\" ACTION=\"menu.php\">";

$content = "<button type=\"submit\" class=\"menu-button\">Main Menu</button>";

divmaker(0,0,19,19,"white","blue","1","" 
,$content);
	
echo "</FORM>";	
	
echo "</body>\n
</html>";

?>


