<?php

include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

$school = $_SESSION['schoolname'];

$xm = '';

$xm = $xm. "<inputs>\r";
$xm = $xm. "<data_source>addcourse1.php</data_source>\r";
$xm = $xm. "<date>".gmdate(DATE_RFC822)."</date>\r";
$xm = $xm. "<description>".$_POST['description']."</description>\r";
$xm = $xm. "<lessons>".$_POST['lessons']."</lessons>\r";
$xm = $xm. "<length>".$_POST['length']."</length>\r";
$xm = $xm. "<tutor>".$_POST['tutor']."</tutor>\r";
$xm = $xm. "<school>".$school."</school>\r";
$xm = $xm. "</inputs>\r";

$xm = writexml($xm,$school,$conn);

$sqlins = "INSERT INTO COURSE (tutor,lessons,length,description) VALUES (";
$sqlins = $sqlins . 
$xm->tutor . "," . 
$xm->lessons . "," . 
$xm->length . ",'" .
$xm->description . "')";
  
updatesql($sqlins,$conn);

header('Refresh:0 ; URL=menu.php');

?>
