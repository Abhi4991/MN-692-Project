<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

writehead("ADD GROUP DETAILS",$conn,"addgroup",0);

echo "<FORM METHOD=\"POST\" ACTION=\"addgroup2.php\">";
 
divmaker(50,5,40,10,"","","","
text-align: left;","<button type=\"submit\" class= \"label\" disabled><h200>Add Group</h200></button>");
  
divmaker(20,35,15,10,"","","","font-size: 150%;
text-align: left;","<button type=\"submit\" class= \"label\" disabled><h200>Description:</h200></button>");

$content = "<button type=\"submit\" class= \"label\" disabled><INPUT TYPE=\"text\" NAME=\"description\" class= \"label\" value = \"\" ></button>";

divmaker(35,35,50,10,"","","","",$content);

$content = "<button type=\"submit\" class=\"menu-button\" ><h200>Add Group</h200></button>";

divmaker(40,55,25,10,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);

echo "</FORM>";

echo "<FORM METHOD=\"POST\" ACTION=\"groups.php\">";

divmaker(0,0,10,10,"white","blue","1","
text-align: center;" 
,"<button type=\"submit\" class=\"menu-button\" ><h200>Back</h200></button>");

echo "</FORM>
</body>
</html>";

?>
