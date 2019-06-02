<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";
include "writegroup.php";

$school = sessinfo($conn,"SCHDOM");
$tenum = sessinfo($conn,"tenum");
$userip = sessinfo($conn,"userip");
$user = sessinfo($conn,"User_name");
$groupnum = $_POST['groupnum'];



$xm = "";

$xm .= "<inputs>\r";
$xm .= "<data_source>delgroup2.php</data_source>\r";
$xm .= "<userip>".$userip."</userip>\r";
$xm .= "<user>".$user."</user>\r";
$xm .= "<date>".gmdate(DATE_RFC822)."</date>\r";
$xm .= "<school>".$school."</school>\r";
$xm .= "<tenum>".$tenum."</tenum>\r";
$xm .= "<groupnum>".$groupnum."</groupnum>\r";

$xm .= "</inputs>\r";

$xmm = writexml($xm,$school,$conn);

delgroup($xm,$conn,$school);

header('Refresh:0 ; URL=groups.php');


 ?>
