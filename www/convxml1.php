<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

writehead("CONVERT XML",$conn,"convxml1",0);

echo "<FORM METHOD=\"POST\" ACTION=\"upload.php\"   enctype=\"multipart/form-data\">";

$content = "<input type=\"file\" class=\"label\" name=\"fileToUpload\" id=\"fileToUpload\" accept=\".xml\" >";

divmaker(40,20,60,10,"white","blue","1","" 
,$content);

$content = "<button type=\"submit\"class=\"menu-button\">Upload File</button>";

divmaker(40,40,20,10,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);

echo "</FORM>";

?>



