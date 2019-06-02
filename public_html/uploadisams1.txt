<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

writehead("UPLOAD iSAMS",$conn,"uploadisams",0);

updownweek(80,0);

echo "<FORM METHOD=\"POST\" ACTION=\"admin.php\">";

$content = "<button type=\"submit\"class=\"menu-button\">Admin Menu</button>";

divmaker(0,0,19,10,"white","blue","1","",$content);
	
echo "</FORM>";	


echo "<FORM METHOD=\"POST\" ACTION=\"uploadisams1.php\">";


divmaker(40,45,25,5,"","","","
text-align: left;","<button type=\"submit\"  class=\"label\"  disabled><h200>Upload iSams Data:</h200></button>");

$content = "<button type=\"submit\" name = \"sel\" class=\"menu-button\"  >";

$content .= "Start Uploading</button>";

divmaker(40,65,25,10,"white","blue","1","",$content);

echo "</FORM>
</body>
</html>";


?>



