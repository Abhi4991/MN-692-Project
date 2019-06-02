<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

writehead("READ LOG",$conn,"readlog",0);

echo "<FORM METHOD=\"POST\" ACTION=\"loglist.php\">";

$content = "<button type=\"submit\" class = \"menu\" >Back to log</button>";


divmaker(0,0,20,10,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);

echo "</FORM>";


$filename = $_POST['selxml'];

$filename = substr($filename,0,(strlen($filename)-3));



divmaker(0,20,20,10,"white","blue","1","font-size: 200%;
text-align: center;" 
,$filename);


$txtstuff = file_get_contents($filename."txt");
 
$xmlstuff = file_get_contents($filename."xml");
//$xm = simplexml_load_string($xmlstuff);


$xm = htmlentities($xmlstuff);

$xm = str_replace("\r", "<br>", $xm);

divmaker(0,30,50,50,"white","blue","1","font-size: 200%;
text-align: center;" 
,$xm);

$txtstuff = str_replace(";", ";<br>", $txtstuff);



divmaker(50,30,50,50,"white","blue","1","font-size: 200%;
text-align: left;" 
,$txtstuff);


?>






