<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

//$sql = "select * from USERS";


$sql = "update USERS set P_WORD = '".generateHash("happy")."' where tenum = 1";

//echo $sql."<BR>";


$recs = qry($conn,$sql);


/*
while ($rec_array = arr($recs))
	{
	
	$stuff = generateHash($rec_array['P_WORD']); 
	
	echo $stuff."<BR>";
	
	
	
	
	$sql = "update USERS set P_WORD = '".$stuff."' where USER_NAME = '".$rec_array['USER_NAME']."'";
	
	echo $sql."<BR>";
	
$aa = qry($conn,$sql);

	
	}

*/


?>



