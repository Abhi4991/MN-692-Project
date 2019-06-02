<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

$school = SESSINFO($conn,"SCHDOM");

$password = generateHash($_POST['password']) ;

$xm = '';


$xm = $xm. "<inputs>\r";
$xm = $xm. "<data_source>tutoradd2.php</data_source>\r";
$xm = $xm. "<date>".gmdate(DATE_RFC822)."</date>\r";
$xm = $xm. "<first_name>".$_POST['first_name']."</first_name>\r";
$xm = $xm. "<last_name>".$_POST['last_name']."</last_name>\r";
$xm = $xm. "<user_name>".$_POST['user_name']."</user_name>\r";
$xm = $xm. "<password>".$password."</password>\r";
$xm = $xm. "<school>".$school."</school>\r";
$xm = $xm. "</inputs>\r";

$xm = writexml($xm,$school,$conn);


  $sqlins = "INSERT INTO USERS (user_type,first_name,last_name,P_WORD,USER_NAME,firsttime) VALUES (";
  $sqlins = $sqlins . 
  "1,'" .
  $xm->first_name . "','" . 
  $xm->last_name . "','" . 
  $xm->password . "','" . 
  $xm->user_name . "',1)";
 
 updatesql($sqlins,$conn);

$sql = "select max(tenum) from USERS";

$te = qry($conn,$sql);

$te_array = arr($te);
	
$tenum = $te_array[0];
	 

  $sqlins = "INSERT INTO TUTOR (first_name,last_name,tenum) VALUES ('";
  $sqlins = $sqlins . 
  $xm->first_name . "','" . 
  $xm->last_name . "'," .
  $tenum .")";
   
updatesql($sqlins,$conn);

header('Refresh:0 ; URL=tutors.php');


?>
