<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";
include "writestudent.php";

writehead("DELETE GROUP",$conn,"delgroup1",1);

echo "<FORM METHOD=\"POST\" ACTION=\"delgroup2.php\">";

$groupnum = $_POST['groupnum'];

echo "<input type=\"hidden\" name=\"groupnum\" value= \"".$groupnum."\" />";

$sql = "select * from GROUPS where groupnum = ".$groupnum;

$groupsdata = qry($conn,$sql);

$groups = arr($groupsdata);

$description = $groups['description'];

$content = "<button type=\"submit\" class = \"menu\" disabled>Delete Group ".$description."</button>";

	divmaker(20,30,40,19,"white","blue","1","font-size: 200%;
text-align: center;"  
,$content);

$content = "<button type=\"submit\" class = \"menu\" >Yes</button>";

divmaker(20,50,10,19,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);

echo "</FORM>";

echo "<FORM METHOD=\"POST\" ACTION=\"modgroup.php\">";

$content = "<button type=\"submit\" class = \"menu\" >No</button>";

divmaker(50,50,10,19,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);

echo "</FORM>";

echo "</body>\n
</html>";
 
?>
