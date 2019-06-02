<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

writehead("UPDATE WEEK",$conn,"updateweek",0);

changeweek(80,0);

echo "<FORM METHOD=\"POST\" ACTION=\"admin.php\">";

divmaker(0,0,15,10,"white","blue","1","font-size: 150%;
text-align: center;" 
,"<button type=\"submit\">ADMIN MENU</button>");

echo "</FORM>\n";

echo "<FORM METHOD=\"POST\" ACTION=\"updateweek1.php\">";

$term = SESSINFO($conn,"term");
$week = SESSINFO($conn,"week");
$firstday = SESSINFO($conn,"firstday");
$lastday = SESSINFO($conn,"lastday");

divmaker(25,20,40,5,"white","blue","","font-size: 200%;
text-align: center;" ,"Term ".$term." Week ".$week);

$content = "<button type=\"submit\">SETUP WEEK</button>";


divmaker(40,30,19,19,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);
		
echo "</FORM>\n";
?>