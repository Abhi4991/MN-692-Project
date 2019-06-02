<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

writehead("TIME TABLE REPORT",$conn,"timetablereport",0);

updownweek(80,0,False);

$term = SESSINFO($conn,"term");
$week = SESSINFO($conn,"week");

	divmaker(25,0,35,10,"white","blue","","position: fixed;
" ,"<button type=\"submit\" class= \"labelwhite\" disabled><h200><center>Term ".$term." Week ".$week."</center></h200></button>");

echo "<FORM METHOD=\"POST\" ACTION=\"ttprint.php\" target=\"_blank\">";


		divmaker(30,20,25,5,"white","blue","1","","<button type=\"submit\" class= \"label\" disabled><h200>Start Week</h200></button>");
		
		$content = termweeksel($conn,$term,$week,'startweek',10);
		

divmaker(60,20,15,5,"white","blue","1","","<h200>".$content."</h200>");

		divmaker(30,30,25,5,"white","blue","1","","<button type=\"submit\" disabled class= \"label\"><h200>Finish Week</h200></button>");
		
		$content = termweeksel($conn,$term,$week,'finishweek',10);
		

divmaker(60,30,15,5,"white","blue","1","","<h200>".$content."</h200>");


divmaker(30,40,25,5,"white","blue","1","","<button type=\"submit\" class= \"label\" disabled><h200>Tutor</h200></button>");
		
		$content = seltutor($conn,'tutor');
		

divmaker(60,40,15,5,"white","blue","1","","<h200>".$content."</h200>");


		divmaker(30,80,25,5,"white","blue","1","" 
,"<button type=\"submit\" class=\"menu-button\" ><h200>Print Timetables</h200></button>");

echo "</FORM>\n";

echo "<FORM METHOD=\"POST\" ACTION=\"reports.php\">";

$content = "<button type=\"submit\" class=\"menu-button\" ><h200>Reports Menu</h200></button>";

divmaker(0,0,19,19,"white","blue","1","
text-align: center;" 
,$content);

		
echo "</FORM>";

echo "</body>\n
</html>";
?>