<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";
include "writegroup.php";

$school = sessinfo($conn,"SCHDOM");
$tenum = sessinfo($conn,"tenum");
$userip = sessinfo($conn,"userip");
$user = sessinfo($conn,"User_name");
$groupbookingnum = $_POST['groupbookingnum'];
$groupbookingtutor = $_POST['groupbookingtutor'];

$xm = '';

$xm .= "<inputs>\r";
$xm .= "<data_source>delgroupbookingtutor.php</data_source>\r";
$xm .= "<userip>".$userip."</userip>\r";
$xm .= "<user>".$user."</user>\r";
$xm .= "<date>".gmdate(DATE_RFC822)."</date>\r";
$xm .= "<school>".$school."</school>\r";
$xm .= "<tenum>".$tenum."</tenum>\r";
$xm .= "<groupbookingnum>".$groupbookingnum."</groupbookingnum>\r";
$xm .= "<groupbookingtutor>".$groupbookingtutor."</groupbookingtutor>\r";

$xm .= "</inputs>\r";

$xmm = writexml($xm,$school,$conn);

delgroupbookingtutor($xm,$conn,$school);

sessupdate($conn,'tempnum',$groupbookingnum);

header('Refresh:0 ; URL=groupbookingaction.php');

 ?>
