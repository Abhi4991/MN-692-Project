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
$stnum = $_POST['stnum'];


$xm = '';

$xm .= "<inputs>\r";
$xm .= "<data_source>delgroupstudent.php</data_source>\r";
$xm .= "<userip>".$userip."</userip>\r";
$xm .= "<user>".$user."</user>\r";
$xm .= "<date>".gmdate(DATE_RFC822)."</date>\r";
$xm .= "<school>".$school."</school>\r";
$xm .= "<tenum>".$tenum."</tenum>\r";
$xm .= "<groupnum>".$groupnum."</groupnum>\r";
$xm .= "<stnum>".$stnum."</stnum>\r";


$xm .= "</inputs>\r";

$xmm = writexml($xm,$school,$conn);

delgroupstudent($xm,$conn,$school);

header('Refresh:0 ; URL=modgroup.php');

 ?>
