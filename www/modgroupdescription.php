<?php

include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

$tenum = SESSINFO($conn,'tenum');
$school = SESSINFO($conn,'SCHDOM');

$xm = '';

$xm = $xm. "<inputs>\r";
$xm = $xm. "<data_source>modgroup.php</data_source>\r";
$xm = $xm. "<date>".gmdate(DATE_RFC822)."</date>\r";
$xm = $xm. "<description>".$_POST['description']."</description>\r";
$xm = $xm. "<groupnum>".$_POST['groupnum']."</groupnum>\r";
$xm = $xm. "<tutor>".$tenum."</tutor>\r";
$xm = $xm. "</inputs>\r";


$xm = writexml($xm,$school,$conn);

  $sqlins = "UPDATE GROUPS SET description = '".$xm->description."' where groupnum = ".$xm->groupnum;
  
  //  echo $sqlins;
   
updatesql($sqlins,$conn);

header('Refresh:0 ; URL=modgroup.php');

?>
