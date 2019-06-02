<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

writehead("STUDENTS",$conn,"students",0);

sessupdate($conn,'addstudent',1);

echo "<FORM METHOD=\"POST\" ACTION=\"addstudent1.php\">";

$content = "<button type=\"submit\"  class=\"menu-button\">Add Student</button>";

echo "<input type=\"hidden\" name=\"camefrom\" value= \"1\" />";

	divmaker(30,30,19,19,"white","blue","1",""  
,$content);

echo "</FORM>";

echo "<FORM METHOD=\"POST\" ACTION=\"selstudent.php\">";

$content = "<button type=\"submit\" class=\"menu-button\" >Modify Student</button>";


divmaker(50,30,19,19,"white","blue","1","" 
,$content);
		


echo "</FORM>";

echo "<FORM METHOD=\"POST\" ACTION=\"menu.php\">";

$content = "<button type=\"submit\" class=\"menu-button\" >Main Menu</button>";

	divmaker(30,50,39,19,"white","blue","1",""
,$content); 


echo "</FORM>";

echo "</body>\n";

echo "</html>";

?>