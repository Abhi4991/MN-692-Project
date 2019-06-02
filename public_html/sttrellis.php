<?php
include "opendb.php";

for ( $x = 1; $x <=96; $x++) {



	for ( $days = 1; $days <=5; $days++) {
	
	
	
	$sql = "insert into STTRELL (block,daynum,lesson_num) values (";
	
	$sql = $sql. $x;
		
	$sql = $sql. ",";
	
	$sql = $sql. ($days+47);
	
	$sql = $sql. ",0)";
	
	echo $sql."<br>";
	
	
	$result = mysql_query($sql,$conn) or die(mysql_error());
	}

}

?>
