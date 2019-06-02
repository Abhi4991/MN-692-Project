<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";
include "writestudent.php";

$school = sessinfo($conn,"SCHDOM");
$tenum = sessinfo($conn,"tenum");
$userip = sessinfo($conn,"userip");
$user = sessinfo($conn,"User_name");
$stnum = $_POST['sel'];
$classnum = $_POST['classnum'];
$newclass = $_POST['newclass'];
$xm = '';

$xm .= "<inputs>\r";
$xm .= "<data_source>addstudent4.php</data_source>\r";
$xm .= "<userip>".$userip."</userip>\r";
$xm .= "<user>".$user."</user>\r";
$xm .= "<date>".gmdate(DATE_RFC822)."</date>\r";
$xm .= "<school>".$school."</school>\r";
$xm .= "<tenum>".$tenum."</tenum>\r";
$xm .= "<stnum>".$_POST['studs']."</stnum>\r";
$xm .= "<numles>".$_POST['numles']."</numles>\r";
$xm .= "<leslen>".$_POST['leslen']."</leslen>\r";
$xm .= "<description>".$_POST['description']."</description>\r";

$classnum = $_POST['classnum'];

if ($newclass == 0)
{
	for ($i=0; $i<$classnum; $i++)
	{

	$clnum = $_POST['clnum'.$i];

	$lessons = $_POST['lessons'.$i];

	$xm .= "<insert>\r";
	$xm .= "<clnum>".$clnum."</clnum>\r";
	$xm .= "<lessons>".$lessons."</lessons>\r";
	$xm .= "</insert>\r";
	}
}

$xm .= "</inputs>\r";

$xmm = writexml($xm,$school,$conn);

addstudent($xm,$conn,$school);

header('Refresh:0 ; URL=addstudent1.php');
 
?>
