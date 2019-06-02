<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

writehead("SUPER MENU",$conn,"super",0);

$usertype = sessinfo($conn,"User_type");

sessupdate($conn,'addtutor',1);


echo "<input type =\"hidden\" name = \"sel\" value = \"0\">";

echo "<FORM METHOD=\"POST\" ACTION=\"updatetimetable.php\">";

$content = "<button type=\"submit\" class=\"menu-button\">Update Timetable</button>";

	divmaker(20,30,19,19,"white","blue","1",""  
,$content);

echo "</FORM>";

echo "<FORM METHOD=\"POST\" ACTION=\"tutors.php\">";

echo "<input type =\"hidden\" name = \"camefrom\" value = \"1\">";
$content = "<button type=\"submit\" class=\"menu-button\">Manage Tutors</button>";

divmaker(40,30,19,19,"white","blue","1","" 
,$content);
		

echo "</FORM>";

if ($usertype == 3)
{
	echo "<FORM METHOD=\"POST\" ACTION=\"loglist.php\">";
		
		$content = "<button type=\"submit\" class=\"menu-button\">Read Log</button>";
		

		divmaker(60,30,19,19,"white","blue","1","font-size: 200%;
	text-align: center;"
	,$content); 

	echo "</FORM>";

}
	
echo "<FORM METHOD=\"POST\" ACTION=\"updateweek.php\">";

$content = "<button type=\"submit\" class=\"menu-button\">Update Week</button>";


	
divmaker(20,50,19,19,"white","blue","1","font-size: 200%;
text-align: center" 
,$content);
		

echo "</FORM>";


echo "<FORM METHOD=\"POST\" ACTION=\"seltutor.php\">";

$content = "<button type=\"submit\" class=\"menu-button\">Availability</button>";

divmaker(40,50,19,19,"white","blue","1","font-size: 200%;
text-align: center" 
,$content);

echo "</FORM>";

echo "<FORM METHOD=\"POST\" ACTION=\"getfile.php\">";

$content = "<button type=\"submit\" class=\"menu-button\">Upload File</button>";

divmaker(60,50,19,19,"white","blue","1","font-size: 200%;
text-align: center" 
,$content);

echo "</FORM>";

if ($usertype == 3)
{

echo "<FORM METHOD=\"POST\" ACTION=\"deltables.php\">";
	
	$content = "<button type=\"submit\" class=\"menu-button\">Clear Tables</button>";
	

	divmaker(80,0,19,19,"white","blue","1",""
,$content); 

echo "</FORM>";

}

echo "<FORM METHOD=\"POST\" ACTION=\"test1.php\">";
	
	$content = "<button type=\"submit\" class=\"menu-button\">Week Up</button>";
	

	divmaker(60,0,19,19,"white","blue","1",""
,$content); 

echo "</FORM>";




echo "<FORM METHOD=\"POST\" ACTION=\"uploadisams.php\">";


$content = "<button type=\"submit\" class=\"menu-button\">iSAMS Import</button>";

divmaker(0,50,19,19,"white","blue","1","" 
,$content);
	
echo "</FORM>";

echo "<FORM METHOD=\"POST\" ACTION=\"autobook.php\" >";

$content = "<button type=\"submit\" class=\"menu-button\">Auto Book</button>";

divmaker(0,30,19,19,"white","blue","1","" 
,$content);
	
echo "</FORM>";

echo "<FORM METHOD=\"POST\" ACTION=\"insertclass.php\" >";

$content = "<button type=\"submit\" class=\"menu-button\">Insert Classes</button>";

divmaker(0,70,19,19,"white","blue","1","" 
,$content);
	
echo "</FORM>";

echo "<FORM METHOD=\"POST\" ACTION=\"updatestclass.php\" >";

$content = "<button type=\"submit\" class=\"menu-button\">Update Classes Used</button>";

divmaker(20,70,19,19,"white","blue","1","" 
,$content);
	
echo "</FORM>";

echo "<FORM METHOD=\"POST\" ACTION=\"logo.php\" >";

$content = "<button type=\"submit\" class=\"menu-button\">Logo</button>";

divmaker(40,70,19,19,"white","blue","1","" 
,$content);
	
echo "</FORM>";

echo "<FORM METHOD=\"POST\" ACTION=\"soapysyn.php\" >";

$content = "<button type=\"submit\" class=\"menu-button\">Soap</button>";

divmaker(60,70,19,19,"white","blue","1","" 
,$content);
	
echo "</FORM>";

echo "<FORM METHOD=\"POST\" ACTION=\"admin.php\">";

$content = "<button type=\"submit\" class=\"menu-button\">Admin Menu</button>";

divmaker(0,0,19,19,"white","blue","1","" 
,$content);
	
echo "</FORM>";	
	
echo "</body>\n
</html>";

?>


