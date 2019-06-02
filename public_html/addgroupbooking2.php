<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";
include "writegroup.php";

$school = sessinfo($conn,"SCHDOM");
$tenum = sessinfo($conn,"tenum");
$sessnum = sessinfo($conn,"SESS");
$userip = sessinfo($conn,"userip");
$user = sessinfo($conn,"User_name");
$lookup = $_POST['lookup'];

$sql = "select * from wTTAB where SESS = '".$sessnum."' and lookup = ".$lookup;

$lessinfo = qry($conn,$sql);

$lessinfo_array = arr($lessinfo);
$daynum = $lessinfo_array['daynum'];
$blocknum = $lessinfo_array['blocknum'];
	
$blocknum = $_POST['lessontime'];
$duration = $_POST['hour'] + $_POST['minute'] - $blocknum;
$groupnum = $_POST['groupnum'];
$repeat = $_POST['repeat'];
$numles = $_POST['numles'];
$interval = $_POST['interval'];

$xm = '';

$xm .=  "<inputs>\r";
$xm .=  "<data_source>addlesson2.php</data_source>\r";
$xm .= "<userip>".$userip."</userip>\r";
$xm .= "<user>".$user."</user>\r";
$xm .= "<date>".gmdate(DATE_RFC822)."</date>\r";
$xm .= "<school>".$school."</school>\r";
$xm .=  "<tutor>".$tenum."</tutor>\r";
$xm .=  "<block>".$blocknum."</block>\r";
$xm .=  "<daynum>".$daynum."</daynum>\r";
$xm .=  "<duration>".$duration."</duration>\r";
$xm .=  "<groupnum>".$groupnum."</groupnum>\r";
$xm .=  "<repeat>".$repeat."</repeat>\r";
$xm .=  "<numles>".$numles."</numles>\r";
$xm .=  "<interval>".$interval."</interval>\r";
$xm .=  "</inputs>\r";

$test = "test";
sessupdate($conn,'xm',"'".$xm."'");

$xmm = writexml($xm,$school,$conn);

addgroupbooking($xm,$conn,$school);

header('Refresh:0 ; URL=bookgroup.php');

?>
