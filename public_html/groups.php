<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

writehead("GROUPS",$conn,"groups",0);


if ( sessinfo($conn,"sheight") > sessinfo($conn,"swidth"))
{
	$mobile = True;
}
else
{
	$mobile = False;
}

echo "<FORM METHOD=\"POST\" ACTION=\"addgroup1.php\">";

$content = "<button type=\"submit\" class=\"menu-button\" ><h200>Add Group</h200></button>";


	divmaker(30,30,19,19,"white","blue","1",""  
,$content);

echo "</FORM>";

echo "<FORM METHOD=\"POST\" ACTION=\"selgroup.php\">";

$content = "<button type=\"submit\" class=\"menu-button\" ><h200>Modify Group</h200></button>";

divmaker(50,30,19,19,"white","blue","1","" 
,$content);
		
echo "</FORM>";

echo "<FORM METHOD=\"POST\" ACTION=\"menu.php\">";

$content = "<button type=\"submit\" class=\"menu-button\" ><h200>Main Menu</h200></button>";

divmaker(30,50,39,19,"white","blue","1",""
,$content); 

echo "</FORM>";

echo "</body>\n";

echo "</html>";

?>