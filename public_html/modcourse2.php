<?php

include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

//print "Modding Plan<BR><BR>";

$school = $_SESSION['schoolname'];

//print "$stql <BR> ";
 
$xm = '';

$xm = $xm. "<inputs>\r";
$xm = $xm. "<data_source>modcourse1.php</data_source>\r";
$xm = $xm. "<date>".gmdate(DATE_RFC822)."</date>\r";
$xm = $xm. "<description>".$_POST['description']."</description>\r";
$xm = $xm. "<lessons>".$_POST['lessons']."</lessons>\r";
$xm = $xm. "<length>".$_POST['length']."</length>\r";
$xm = $xm. "<tutor>".$_POST['tutor']."</tutor>\r";
$xm = $xm. "<school>".$school."</school>\r";
$xm = $xm. "</inputs>\r";


$xm = writexml($xm,$school,$conn);

  $sqlins = "UPDATE COURSE SET ".
  "lessons = ".$xm->lessons . "," . 
  "length = ".$xm->length . "," . 
  "description = \"".$xm->description . "\"," . 
  "tutor = ".$xm->tutor .
  " where coursenum = ".  $_POST['coursenum'];
  
//  echo $sqlins;
   
updatesql($sqlins,$conn);

header('Refresh:0 ; URL=courses.php');

?>
