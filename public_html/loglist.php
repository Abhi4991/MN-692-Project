<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

writehead("MAIN MENU",$conn,"logdisplay",0);


echo "<FORM METHOD=\"POST\" ACTION=\"admin.php\">";

$content = "<button type=\"submit\" class = \"menu\" >Admin Menu</button>";


divmaker(0,0,20,10,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);

echo "</FORM>";

echo "<FORM METHOD=\"POST\" ACTION=\"readlog.php\"  target=\"_blank\">";

$school = SESSINFO($conn,'SCHDOM');

//path to directory to scan
$directory = $school."/log/";

//get all text files with a .txt extension.
$texts = glob($directory . "*.txt");

//print each file name

$y = 10;
$x = 0;

//   function bmaker($mobile,$left,$top,$width,$height,$class,$value,$name,$title,$state,$content)

foreach($texts as $filename)

{
	
	$filelen = strlen($filename)-4;
		
	$xmlstuff = file_get_contents(substr($filename,0,$filelen).".xml");
$xm = simplexml_load_string($xmlstuff);

$source = $xm->data_source;
	
	
bmaker(False,$x*20,$y,20,5,"",$filename,"selxml","","","<h100>"
//.$filename.
." ".date("F d Y H:i:s",filemtime($filename))." ".$source."</h100> ");
	
//    echo $filename." ".filesize($filename)." Last modified: ".date("F d Y H:i:s.",filemtime($filename))."<br>";

$x = $x + 1;

	if ($x == 5)
	{
		$x = 0;
		$y = $y +5;
		
	}
}

echo "</FORM>";

?>