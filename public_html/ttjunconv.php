<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

echo "Updating Time Table<BR>";
echo "Updated Time Table<BR>";
echo "<ul><li><a href=\"admin.php\">back to user page</a></ul>";

$forms = array("PRE","01B","01R","02C","02I","03H","03T","04SB","04W","05A","05H","06C","06K","06S");

/*
for ($int = 0;$int < 14;$int++)
{	
$sql = "update ttjunconv set f".($int+5)." = concat('".$forms[$int]."',f".($int+5).") where f".($int+5)." <> ''"; 

echo $sql."<BR>";

$ttdata = qry($conn,$sql);

}



$sql = "select * from ttjunconv where f4 <> '' and f4 not in ('Monday','Tuesday','Wednesday','Thursday','Friday') ";

$ttjunconvdata = qry($conn,$sql);

while ($ttjunconv = arr($ttjunconvdata))
{
	
	for ($int = 0;$int < 14;$int++)
		
		{
				
			$classcode =  "f".($int+5)."";
			
			if ($ttjunconv[$classcode] <> "")
			{
			
			$sql = "insert into ttconv (ttday,classcode,ttime) values (";
			$sql = $sql. $ttjunconv['f2'].",'".$ttjunconv[$classcode]."','".$ttjunconv['f4']."')";
			}
			
			echo $sql."<BR>";
			
			$ttdata = qry($conn,$sql);
		}
		
}

$sql = "select distinct * from ttconv";

$ttconvdata = qry($conn,$sql);

while ( $ttconv = arr($ttconvdata))
	
	{
		addclass($conn,$ttconv['classcode'],$ttconv['classcode']);
	}
	
$sql = "select * from CLASS";

$classdata = qry($conn,$sql);

		while ( $class = arr($classdata))
		{

			$sql = "update ttconv set clnum = ".$class['clnum']. " where classcode = '".$class['class_code']."'";
			
			echo $sql."<BR>";
			

			$upttconv = qry($conn,$sql);
		}
*/	

/*	
for ($hour = 0; $hour <= 12; $hour++)
{
	for ($minper = 0; $minper < 12; $minper++)
	{
		if ($hour < 10 )
			
		{
			if ($minper == 1 )
			{
				$tstr = substr($hour.":0".($minper*5),0,4);
			}
			else
			{
				$tstr = substr($hour.":".($minper*5)."0",0,4);
			}
		}
		else
		{
			if ($minper == 1 )
			{
				$tstr = substr($hour.":0".($minper*5),0,5);
			}
			else
			{
				$tstr = substr($hour.":".($minper*5)."0",0,5);
			}
			
		}
		
	
	$sql = "update ttconv set perstart = ".($hour*12+$minper+1)." where ttime = '".$tstr."'";
	
	$upttconv = qry($conn,$sql);
	
			echo $sql."<BR>";
	}

}	



$sql = "SELECT DISTINCT ttday, clnum, perstart,perlength
FROM  `ttconv` 
ORDER BY ttday, clnum, perstart";

$ttconvdata = qry($conn,$sql);

$lasttday = 0;
$lastclnum = 0;
$perstart = 0;
$tottime = 0;


while ( $ttconv = arr($ttconvdata))
{

if ($ttconv['ttday'] <>  $lasttday or  $ttconv['clnum'] <> $lastclnum)
{
$sql = "insert into ttconvtt (ttday,clnum,perstart,perlength) values (".$lasttday.",".$lastclnum.",".$perstart.",".$tottime.")";

echo $sql."<BR>";


$ttconvtt = qry($conn,$sql);

$lasttday = $ttconv['ttday'];
$lastclnum = $ttconv['clnum'];
$perstart = $ttconv['perstart'];
$tottime = $ttconv['perlength'];
}

$tottime = $tottime + $ttconv['perlength'];

}
$sql = "insert into TTCONVTT (ttday,clnum,perstart,perlength) values (".$lasttday.",".$lastclnum.",".$perstart.",".$tottime.")";



	//	update ttconv set perstart = 101 where ttime = ''8:20'
				


$sql = "select * from ttconvtt";

$ttconvttdata = qry($conn,$sql);

while ($ttconvtt = arr($ttconvttdata))
{
	
$sql = "insert into TIMETABLE (tenum,clnum,ttday,ttper,perstart,perlength) values(1,".$ttconvtt['clnum'].",".$ttconvtt['ttday'].
",1,".$ttconvtt['perstart'].",".$ttconvtt['perlength'].")";

echo $sql."<BR>";

$ttupdate = qry($conn,$sql);

}			
	
		
$sql = "select * from stconv";

$stconvdata = qry($conn,$sql);

while ($stconv = arr($stconvdata))
		
{
	
$sql = "update STUDENTS set home_group = '".$stconv['stform']."' where st_code = '".$stconv['st_code']."'";

		$modstudent = qry($conn,$sql);	
	
		
}
	*/
	
	$sql = "select * from STUDENTS where home_group is not null";
	
	$STUDENTSdata = qry($conn,$sql);
	
while ($STUDENTS = arr($STUDENTSdata))	
{

$hlen = strlen($STUDENTS['home_group']);

	$sql = "select * from CLASS where substr(class_code,1,".$hlen.") = '".$STUDENTS['home_group']."'";
	
		echo $sql."<BR>";

	$CLASSdata = qry($conn,$sql);
	
	while ($CLASSES = arr($CLASSdata))
	
	{
	
	$sql = "insert into STLIST (stnum,clnum) values (".$STUDENTS['stnum'].",".$CLASSES['clnum'].")";
	
	echo $sql."<BR>";

			$upSTLIST = qry($conn,$sql);
	}
	
}

	
	
	
		
function addstudent($conn,$st_code,$st_last,$st_first,$home_group)
{
	
$sql = "select st_code from STUDENTS where st_code = '".$st_code."'";

$studentdata = qry($conn,$sql);

  $num_rows = mysqli_num_rows($studentdata);
  
	if ($num_rows == 0)
	{
		$sql = 'INSERT INTO STUDENTS (st_code,st_last,st_first,home_group) values ("'.$st_code.'","'.$st_last.'","'.$st_first.
		'","'.$home_group.'")';
		
		echo $sql."<BR>";
		
		$addstudent = qry($conn,$sql);
	}
	return;
}





















?>
