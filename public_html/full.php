<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

writehead("MAIN MENU",$conn,"mainmenu",1);

$usertype = sessinfo($conn,"User_type");

echo "<input type =\"hidden\" name = \"sel\" value = \"0\">";

	divmaker(0,0,99,99,"white","blue","1","font-size: 100%;
text-align: center;"  
,"<a href=\"students.php\">MY STUDENTS</a>");

echo "</body>\n
</html>";
?>


