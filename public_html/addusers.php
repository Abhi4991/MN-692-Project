<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

$school = SESSINFO($conn,"SCHDOM");

$sql = "select * from impusers";

$impusersdata = qry($conn,$sql);

$pwd = 'rolltutor';

while ($impusers = arr($impusersdata))
{
	
	$password = generateHash($pwd) ;

	$xm = '';

	$xm = $xm. "<inputs>\r";
	$xm = $xm. "<data_source>tutoradd2.php</data_source>\r";
	$xm = $xm. "<date>".gmdate(DATE_RFC822)."</date>\r";
	$xm = $xm. "<first_name>".$impusers['first_name']."</first_name>\r";
	$xm = $xm. "<last_name>".$impusers['last_name']."</last_name>\r";
	$xm = $xm. "<user_name>".substr($impusers['first_name'],1,1).$impusers['last_name']."</user_name>\r";
	$xm = $xm. "<password>".$password."</password>\r";
	$xm = $xm. "<user_type>".$impusers['user_type']."</user_type>\r";
	$xm = $xm. "<school>".$school."</school>\r";
	$xm = $xm. "</inputs>\r";

	$xm = writexml($xm,$school,$conn);

	$sqlins = "INSERT INTO USERS (user_type,first_name,last_name,P_WORD,USER_NAME,firsttime) VALUES (";
	$sqlins = $sqlins . 
	$xm->user_type.",'" .
	$xm->first_name . "','" . 
	$xm->last_name . "','" . 
	$xm->password . "','" . 
	$xm->user_name . "',0)";
	 
	updatesql($sqlins,$conn);
	 
	$mysqli->commit();

	$sql = "select max(tenum) from USERS";

	$te = qry($conn,$sql);

	while ($te_array = arr($te))
	{
		$tenum = $te_array[0];
	}

	$sqlins = "INSERT INTO TUTOR (first_name,last_name,tenum) VALUES ('";
	$sqlins = $sqlins . 
	$xm->first_name . "','" . 
	$xm->last_name . "'," .
	$tenum .")";
	 
	updatesql($sqlins,$conn);

}

header('Refresh:0 ; URL=admin.php');

?>
