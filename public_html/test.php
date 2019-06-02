<?php

$xmlnumber = 21;

$school = "school1";

$filename = substr("000000".$xmlnumber,-7);

$filename = $school."/log/".$filename.".xml";

	echo $xmlnumber." ".$filename."<BR>";
	
$file = fopen($filename,"a");
fwrite($file,$xmlstuff);
fclose($file);



  ?>