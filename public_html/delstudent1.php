<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";
include "writestudent.php";

writehead("MAIN MENU",$conn,"delstudent1",1);

echo "<FORM METHOD=\"POST\" ACTION=\"delstudentxml.php\">";

$coursenum = $_POST['course'];

echo "<input type=\"hidden\" name=\"course\" value= \"".$coursenum."\" />";

$sql = "select * from COURSE where coursenum = ".$coursenum;

$coursedata = qry($conn,$sql);

while ($course = arr($coursedata))
{
$coursedesc = $course['description'];
}	

$content = "<button type=\"submit\" class = \"menu\" disabled>Delete Course ".$coursedesc."</button>";

	divmaker(20,30,40,19,"white","blue","1","font-size: 200%;
text-align: center;"  
,$content);

$content = "<button type=\"submit\" class = \"menu\" >Yes</button>";

divmaker(20,50,10,19,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);




echo "</FORM>";

echo "<FORM METHOD=\"POST\" ACTION=\"selstudent.php\">";

$content = "<button type=\"submit\" class = \"menu\" >No</button>";


divmaker(50,50,10,19,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);

echo "</FORM>";

echo "</body>\n
</html>";
 
?>
