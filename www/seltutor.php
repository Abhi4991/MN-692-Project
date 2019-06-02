<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

writehead("DELECT TUTOR",$conn,"seltutor",0);


$tenum = SESSINFO($conn,"tenum");

$sql = "SELECT * FROM TUTOR order by last_name,first_name";

$tutor = qry($conn,$sql);


echo "<FORM METHOD=\"POST\" ACTION=\"avail.php\">";

$x = 0;
$y = 0;

while ($tu_array = arr($tutor))

{

$content = "<button type=\"submit\" value = \"".$tu_array['tenum']."\" name = \"tenum\" class=\"mediummenu-button\" >";
	
$content = $content .$tu_array['first_name']." ".$tu_array['last_name']."</button>";

if ($x == 2)
{$x=0;$y++;}


divmaker(10+$x*35,30+$y*10,30,8,"white","blue","1","
text-align: center;" 
,$content);

$x = $x + 1;


}	

echo "</FORM>\n";

echo "<FORM METHOD=\"POST\" ACTION=\"admin.php\">";

$content = "<button type=\"submit\" class=\"menu-button\" >Admin Menu</button>";


divmaker(0,0,19,19,"white","blue","1","
text-align: center;" 
,$content);

echo "</FORM>\n";

echo "</body>\n
</html>";
?>


