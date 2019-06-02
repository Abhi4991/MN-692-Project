<?php

include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

//print "Adding Plan<BR><BR>";

$school = sessinfo($conn,"SCHDOM");
$tenum = sessinfo($conn,"tenum");

//print "$stql <BR> ";

$lessonnum = $_POST['lesnum'];
 
$xm = '';

$xm = $xm. "<inputs>\r";
$xm = $xm. "<data_source>lessonaction2.php</data_source>\r";
$xm = $xm. "<date>".gmdate(DATE_RFC822)."</date>\r";
$xm = $xm. "<lessonnum>".$lessonnum."</lessonnum>";
$xm = $xm. "<comments>".$_POST['lcomments']."</comments>\r";
$xm = $xm. "<attendance>".$_POST['attendance']."</attendance>\r";
$xm = $xm. "<late>".$_POST['late']."</late>\r";
$xm = $xm. "<fetched>".$_POST['fetched']."</fetched>\r";
$xm = $xm. "<tutor>".$tenum."</tutor>\r";
$xm = $xm. "<school>".$school."</school>\r";
$xm = $xm. "</inputs>\r";

//echo $xm;

$xm = writexml($xm,$school,$conn);

  $sqlins = "update LESSON set lcomments = '".$_POST['lcomments']."',attendance = ".$_POST['attendance'].",late = ".$_POST['late'].",fetched = ".$_POST['fetched']." where lesson_num = ".$lessonnum;
  
//echo "<BR>";

//echo $sqlins;
    
updatesql($sqlins,$conn);

header('Refresh:0 ; URL=timetable.php');

?>
