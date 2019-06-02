<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";


$school = sessinfo($conn,"SCHDOM");
$tenum = sessinfo($conn,"tenum");
$userip = sessinfo($conn,"userip");
$user = sessinfo($conn,"User_name");
$availnum = $_POST['sel'];


$xm = '';

$xm .= "<inputs>\r";
$xm .= "<data_source>delavail.php</data_source>\r";
$xm .= "<userip>".$userip."</userip>\r";
$xm .= "<user>".$user."</user>\r";
$xm .= "<date>".gmdate(DATE_RFC822)."</date>\r";
$xm .= "<school>".$school."</school>\r";
$xm .= "<tenum>".$tenum."</tenum>\r";
$xm .= "<availnum>".$availnum."</availnum>\r";

$xm .= "</inputs>\r";

$xmm = writexml($xm,$school,$conn);

$xm = simplexml_load_string($xm);
	
	$sql = "delete from AVAILABILITY where availnum = ".$xm->availnum;

updatesql($sql,$conn);

header('Refresh:0 ; URL=avail.php');

 ?>
