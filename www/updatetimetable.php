<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

echo "Updating Time Table<BR>";
echo "Updated Time Table<BR>";
echo "<ul><li><a href=\"admin.php\">back to user page</a></ul>";

$sql = "DELETE FROM STLIST WHERE 1";
$delstclass = qry($conn,$sql);

$sql = "DELETE FROM TIMETABLE WHERE 1";
$deltimetable = qry($conn,$sql);

$sql = "SELECT * FROM IMPORT";

$importdata = qry($conn,$sql);

while ($import = arr($importdata))
{
	addstudent($conn,$import['st_code'],$import['st_last'],$import['st_first']);
	addclass($conn,$import['class_code'],$import['class_desc']);
}

$sql = "SELECT st_code,stnum FROM STUDENTS";

$stdata = qry($conn,$sql);

while ($st = arr($stdata))
{
	$sql = "UPDATE IMPORT set stnum = ".$st['stnum']." where st_code = '".$st['st_code']."'";
	
	$importupdate = qry($conn,$sql);
}

$sql = "SELECT class_code,clnum FROM CLASS";

$cldata = qry($conn,$sql);

while ($cl = arr($cldata))
{
	$sql = "UPDATE IMPORT set clnum = ".$cl['clnum']." where class_code = '".$cl['class_code']."'";
	$importupdate = qry($conn,$sql);
}


$sql = "SELECT stnum,clnum FROM IMPORT ";

$importdata = qry($conn,$sql);

while ($import = arr($importdata))
{
	addstcl($conn,$import['stnum'],$import['clnum']);
}

$sql = "SELECT ttday,ttper,perstart,perlength,clnum FROM IMPORT";

$importdata = qry($conn,$sql);

while ($import = arr($importdata))
{
	addttable($conn,1,$import['clnum'],$import['ttday'],$import['ttper'],$import['perstart'],$import['perlength']);
}

function addttable($conn,$tenum,$clnum,$ttday,$ttper,$perstart,$perlength)
{
$sql = "select * from TIMETABLE where clnum = ".$clnum." and ttday = ".$ttday." and ttper = ".$ttper;

$ttdata = qry($conn,$sql);

  $num_rows = mysqli_num_rows($ttdata);
  
	if ($num_rows == 0)
	{
		$sql = "INSERT INTO TIMETABLE (tenum,clnum,ttday,ttper,perstart,perlength) values (".$tenum.",".$clnum.",".$ttday.",".$ttper.",".$perstart.",".$perlength.")";

		$addttable = qry($conn,$sql);
	}
	return;
}

function addstcl($conn,$stnum,$clnum)
{
$sql = "select * from STLIST where stnum = ".$stnum." and clnum = ".$clnum;

$stcldata = qry($conn,$sql);

  $num_rows = mysqli_num_rows($stcldata);
  
	if ($num_rows == 0)
	{
		$sql = "INSERT INTO STLIST (stnum,clnum) values (".$stnum.",".$clnum.")";
		$addstcl = qry($conn,$sql);
	}
	return;
}

function addclass($conn,$class_code,$class_desc)
{
	
$sql = "select class_code from CLASS where class_code = '".$class_code."'";

$classdata = qry($conn,$sql);

  $num_rows = mysqli_num_rows($classdata);
  
	if ($num_rows == 0)
	{
		$sql = "INSERT INTO CLASS (class_code,class_desc) values ('".$class_code."','".$class_desc."')";
		$addclass = qry($conn,$sql);
	}

	return;
}

function addstudent($conn,$st_code,$st_last,$st_first)
{
	
$sql = "select st_code from STUDENTS where st_code = '".$st_code."'";

$studentdata = qry($conn,$sql);

  $num_rows = mysqli_num_rows($studentdata);
  
	if ($num_rows == 0)
	{
		$sql = "INSERT INTO STUDENTS (st_code,st_last,st_first) values ('".$st_code."','".$st_last."','".$st_first."')";
		$addstudent = qry($conn,$sql);
	}
	return;
}


?>