<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

$school = SESSINFO($conn,"SCHDOM");

if ($_POST['password'] <> '')
{
	$password = generateHash($_POST['password']);
}

$tenum = $_POST['tenum'];

$xm = '';

$xm = $xm. "<inputs>\r";
$xm = $xm. "<data_source>tutoradd2.php</data_source>\r";
$xm = $xm. "<date>".gmdate(DATE_RFC822)."</date>\r";
$xm = $xm. "<tenum>".$_POST['tenum']."</tenum>\r";
$xm = $xm. "<first_name>".$_POST['first_name']."</first_name>\r";
$xm = $xm. "<last_name>".$_POST['last_name']."</last_name>\r";
$xm = $xm. "<user_name>".$_POST['user_name']."</user_name>\r";
$xm = $xm. "<password>".$password."</password>\r";
$xm = $xm. "<school>".$school."</school>\r";
$xm = $xm. "</inputs>\r";

$xm = writexml($xm,$school,$conn);

$sql = "update USERS set first_name = '".$xm->first_name
."',last_name = '".$xm->last_name
."',USER_NAME = '".$xm->user_name
."',P_WORD = '".$xm->password."' where tenum = ".$tenum;
   
 updatesql($sql,$conn);
 
  $sql = "update TUTOR set first_name = '".$xm->first_name
  ."',last_name = '".$xm->last_name."' where tenum = ".$tenum;
   
updatesql($sql,$conn);

header('Refresh:0 ; URL=tutors.php');

?>
