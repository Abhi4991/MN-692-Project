<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

writehead("MAIN MENU",$conn,"mainmenu",0);

$usertype = sessinfo($conn,"User_type");

echo "<input type =\"hidden\" name = \"sel\" value = \"0\">";

	divmaker(20,30,19,19,"white","blue","1","font-size: 200%;
text-align: center;"  
,"<a href=\"students.php\"><BR>MY STUDENTS</a>");

	divmaker(40,30,19,19,"white","blue","1","font-size: 200%;
text-align: center;" 
,"<a href=\"timetable.php\"><BR>TIME TABLE</a>");
	
	divmaker(60,30,19,19,"white","blue","1","font-size: 200%;
text-align: center;"
,"<a href=\"deltables.php\"><BR>CLEAR TABLES</a>"); 
	
	divmaker(20,50,19,19,"white","blue","1","font-size: 200%;
text-align: center" 
,"<a href=\"selection.php\"><BR>BOOK LESSONS</a>");



if ($usertype == 2) 

{
	divmaker(40,50,19,19,"white","blue","1","font-size: 200%;
text-align: center;" 
,"<a href=\"admin.php\">ADMIN</a>");

}

divmaker(60,50,19,19,"white","blue","1","font-size: 200%;
text-align: center;" 
,"<a href=\"http://".$schdom.".rolltutor.com/\"><BR>LOG OUT</a>");
	
echo "</body>\n
</html>";
?>


