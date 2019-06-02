<?php
include "opendb.php";

$sql = "SELECT * FROM TIMETABLE WHERE ttday < 6 ORDER BY ttday+ttper";

//echo $sql;

$result = mysql_query($sql,$conn) or die(mysql_error());


while($row = mysql_fetch_array($result)){
	

echo $row['tenum'];

echo $row['clnum'] ;
echo $row['ttday'] ;
echo $row['ttper'] ;
echo $row['room'] ;









echo "<BR>";

$te = $row['tenum'] ;
$cl = $row['clnum'] ;
$da = $row['ttday'] + 35 ;
$pe = $row['ttper'] ;
$per = 0 ;
$ro = $row['room'] ;
	
		$sql = "INSERT INTO MARKED (
tenum,
clnum,
daynum,
pernum,
peroff,
room)
values
($te,$cl,$da,$pe,$per,'$ro')";



if (mysql_query($sql, $conn)) {
	echo $respon;
} else {
	echo "something went wrong";
	
	echo $respon;
}



}

echo "Updated MARKED<BR>";


$sql = "SELECT TIMETABLE.TENUM,TIMETABLE.CLNUM, TIMETABLE.TTDAY, TIMETABLE.TTPER, TIMETABLE.ROOM, STLIST.STNUM
FROM TIMETABLE INNER JOIN STLIST ON TIMETABLE.CLNUM = STLIST.CLNUM
WHERE STLIST.STNUM >= 600
ORDER BY TIMETABLE.TTDAY, TIMETABLE.TTPER ";



$result = mysql_query($sql,$conn) or die(mysql_error());


while($row = mysql_fetch_array($result)){
	

echo $row['TENUM'];
echo " ";
echo $row['STNUM'];
echo " ";
echo $row['CLNUM'] ;
echo " ";
echo $row['TTDAY'] ;
echo " ";
echo $row['TTPER'] ;
echo " ";
echo $row['ROOM'] ;



echo "<BR>" ;

$te = $row['TENUM'] ;
$cl = $row['CLNUM'] ;
$st = $row['STNUM'] ;
$da = $row['TTDAY'] + 35 ;
$pe = $row['TTPER'] ;
$ro = $row['ROOM'] ;


	
		$sql = "INSERT INTO ROLL (
tenum,
clnum,
stnum,
daynum,
pernum,
ststat,
stnote,
extrac,
resolv,
notify,
peroff,
room)
values
($te,$cl,$st,$da,$pe,0,0,0,0,0,0,'$ro')";



$respon = mysql_query($sql,$conn) or die(mysql_error());


//if (mysql_query($sql, $conn)) {
//	echo $respon;
//} else {
//	echo "something went wrong";
//	
//	echo $respon;
//}





}






echo "Updated ROLL<BR>";















 
echo "<ul><li><a href=\"menu.php\">back to user page</a></ul>";
?>