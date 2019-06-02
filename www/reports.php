<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

writehead("MAIN MENU",$conn,"mainmenu",1);

$usertype = sessinfo($conn,"User_type");

echo "<FORM METHOD=\"POST\" ACTION=\"timetablereport.php\" >";

$content = "<button type=\"submit\"  class=\"menu-button\" >Time Tables</button>";

	divmaker(20,30,19,19,"white","blue","1","
text-align: center;"  
,$content);

echo "</FORM>";

echo "<FORM METHOD=\"POST\" ACTION=\"menu.php\">";

$content = "<button type=\"submit\" class=\"menu-button\" >Main Menu</button>";

divmaker(0,0,19,10,"white","blue","1","
text-align: center;" 
,$content);
		
echo "</FORM>";


echo "</body>\n
</html>";

?>


