<?php

function addavail($xmm,$conn,$school)
{
$xm = simplexml_load_string($xmm);

$daynum = $xm->daynum;

	$sqlins = "INSERT INTO AVAILABILITY (daynum,startblock,duration,tenum) VALUES (";
	$sqlins = $sqlins . $daynum . "," . $xm->startblock . "," . $xm->duration . "," . $xm->tutor .")";
  
	  updatesql($sqlins,$conn);
	
return;
}
?>
