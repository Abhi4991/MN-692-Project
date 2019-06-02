<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

writehead("AUTO BOOK",$conn,"autobook",0);

updownweek(80,0);

echo "<FORM METHOD=\"POST\" ACTION=\"admin.php\">";

$content = "<button type=\"submit\"class=\"menu-button\">Admin Menu</button>";

divmaker(0,0,19,10,"white","blue","1","",$content);
	
echo "</FORM>";	

$term = sessinfo($conn,'term');
$week = sessinfo($conn,'week');

$content = "<button type=\"submit\" class=\"label\" disabled><h200>Term ".$term." Week ".$week."</h200></button>";

divmaker(40,10,20,10,"white","blue","1","" 
,$content);

echo "<FORM METHOD=\"POST\" ACTION=\"autobooka.php\">";


divmaker(20,25,25,5,"","","","
text-align: left;","<button type=\"submit\"  class=\"label\"  disabled><h150>Number of Weeks to Book:</h150></button>");



 $numbers = array(1,2,3,4,5,6,7,8,9,11,12,13,14,15,16);
    divmaker(50,25,7,5,"","","","","<button type=\"submit\" class= \"label\" disabled>".numsel("mediummenu-button","numles",$numbers,1,0)."</button>");


$content = "<button type=\"submit\" name = \"sel\" class=\"menu-button\"  >";

$content .= "Start Booking</button>";

divmaker(40,65,25,10,"white","blue","1","",$content);

echo "</FORM>
</body>
</html>";


?>



