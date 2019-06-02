<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";
include "writeavail.php";

$school = sessinfo($conn,"SCHDOM");

$sessnum = sessinfo($conn,"SESS");
$userip = sessinfo($conn,"userip");
$user = sessinfo($conn,"User_name");
$tenum = sessinfo($conn,'tenum');
$startblock = $_POST['lessontime'];

$duration = $_POST['hour'] + $_POST['minute'] - $startblock;

$daynum = $_POST['daynum'];

$xm = '';

$xm .=  "<inputs>\r";
$xm .=  "<data_source>addavail2.php</data_source>\r";
$xm .= "<userip>".$userip."</userip>\r";
$xm .= "<user>".$user."</user>\r";
$xm .= "<date>".gmdate(DATE_RFC822)."</date>\r";
$xm .= "<school>".$school."</school>\r";
$xm .=  "<tutor>".$tenum."</tutor>\r";
$xm .=  "<daynum>".$daynum."</daynum>\r";
$xm .=  "<startblock>".$startblock."</startblock>\r";
$xm .=  "<duration>".$duration."</duration>\r";
$xm .=  "</inputs>\r";

$xmm = writexml($xm,$school,$conn);

addavail($xm,$conn,$school);

header('Refresh:0 ; URL=avail.php');

?>
