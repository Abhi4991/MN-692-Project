<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

writehead("ADMIN MENU",$conn,"adminmenu",0);
/*
$sql = "select * from STUDENTS order by stnum";

$studentsdata = qry($conn,$sql);

while ($students = arr($studentsdata))
{

$sql = "select * from namelist where stnum = ".$students['stnum'];

$namelistdata = qry($conn,$sql);

$namelist = arr($namelistdata);
	
$sql = "update STUDENTS set st_first = '".$namelist['st_first']."', st_last = '".$namelist['st_last']."' where stnum = ".
$namelist['stnum']

;
echo $sql."<BR>";
qry($conn,$sql);

$sql = "update `COURSE` as co 
inner join COURSELIST as cs
on co.coursenum = cs.coursenum
set co.description = '".$namelist['st_first']." ".$namelist['st_last']."' 
where cs.stnum = ".$namelist['stnum'];
qry($conn,$sql);
echo $sql."<BR>";
$sql = "update namelist set used = 1 where stnum = ".$namelist['stnum'];
qry($conn,$sql);
echo $sql."<BR>";

}
*/
$sql = "select * from TUTOR where tenum > 2 order by tenum";

$tutordata = qry($conn,$sql);

while ($tutor = arr($tutordata))
{

$sql = "select * from namelist where stnum = ".($tutor['tenum']+711) ;

$namelistdata = qry($conn,$sql);

$namelist = arr($namelistdata);
	
$sql = "update TUTOR set first_name = '".$namelist['st_first']."', last_name = '".$namelist['st_last']."' where tenum+711 = ".
$namelist['stnum'];
echo $sql."<BR>";
qry($conn,$sql);

$sql = "update USERS set first_name = '".$namelist['st_first']."', last_name = '".$namelist['st_last']."' where tenum+711 = ".
$namelist['stnum'];

echo $sql."<BR>";
qry($conn,$sql);

}







?>