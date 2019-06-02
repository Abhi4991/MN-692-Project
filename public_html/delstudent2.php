<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";
include "writestudent.php";

$school = sessinfo($conn,"SCHDOM");
$tenum = sessinfo($conn,"tenum");
$userip = sessinfo($conn,"userip");
$user = sessinfo($conn,"User_name");
$course = $_POST['course'];

$xm = '';

$xm .= "<inputs>\r";
$xm .= "<data_source>delstudent2.php</data_source>\r";
$xm .= "<userip>".$userip."</userip>\r";
$xm .= "<user>".$user."</user>\r";
$xm .= "<date>".gmdate(DATE_RFC822)."</date>\r";
$xm .= "<school>".$school."</school>\r";
$xm .= "<tenum>".$tenum."</tenum>\r";
$xm .= "<coursenum>".$course."</coursenum>\r";

$xm .= "</inputs>\r";

$xmm = writexml($xm,$school,$conn);

delstudent($xm,$conn,$school);

header('Refresh:0 ; URL=selstudent.php');

 ?>
