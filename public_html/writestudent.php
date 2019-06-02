<?php
function addstudent($xmm,$conn,$school)
{
$xm = simplexml_load_string($xmm);
	
	$sql = "insert into COURSE (tutor,lessons,length,description) values (";

$sql.=  $xm->tenum.",";
$sql.=  $xm->numles.",";
$sql.=  $xm->leslen.",'";
$sql.=  $xm->description."')";

$coursenum = updatesql($sql,$conn);


$sql = "select coursenum from COURSE ORDER BY coursenum DESC LIMIT 1";

$coursedata = qry($conn,$sql);

while ($course = arr($coursedata))
{
	$coursenum = $course['coursenum'];
}

$sqlins = "insert into COURSELIST (stnum,coursenum) values (";

$sqlins.= $xm->stnum. ",";
$sqlins.= $coursenum. ")";

updatesql($sqlins,$conn);

foreach ($xm->insert as $insert)
	{
	$sqlins = "insert into STCLASS (stnum,clnum,clavail) values (";

	$sqlins.= $xm->stnum. ",";
	$sqlins.= $insert->clnum. ",";
	$sqlins.= $insert->lessons. ")";
	
	updatesql($sqlins,$conn);
	}

return;
}

function modstudent($xmm,$conn,$school)
{
$xm = simplexml_load_string($xmm);
	
	$sql = "update COURSE set lessons = ";

$sql.=  $xm->numles.", length = ";
$sql.=  $xm->leslen.",description = '";
$sql.=  $xm->description."' where coursenum = ".$xm->coursenum;

updatesql($sql,$conn);

foreach ($xm->update as $update)
	{
		
	$sql = "select clnum from STCLASS where stnum = ".$xm->stnum. " and clnum = ".$update->clnum;

$stcl = qry($conn,$sql);
			
 $num_rows = mysqli_num_rows($stcl);
  
if ($num_rows == 0)	
{
		
			$sqlins = "insert into STCLASS (stnum,clnum,clavail) values (";

	$sqlins.= $xm->stnum. ",";
	$sqlins.= $update->clnum. ",";
	$sqlins.= $update->lessons. ")";
	
	updatesql($sqlins,$conn);
}
else
{
		
		
		
	$sqlins = "update STCLASS set clavail = ";
	$sqlins.= $update->lessons. " where stnum = ";
	$sqlins.= $xm->stnum. " and clnum = ";
	$sqlins.= $update->clnum;

	updatesql($sqlins,$conn);
	}
	}
return;
}

function delstudent($xmm,$conn,$school)
{
$xm = simplexml_load_string($xmm);
	
	$sql = "delete from COURSELIST where coursenum = ".$xm->coursenum;

updatesql($sql,$conn);

	$sql = "delete from TRELLIS where coursenum = ".$xm->coursenum;

updatesql($sql,$conn);

	$sql = "delete from COURSE where coursenum = ".$xm->coursenum;

updatesql($sql,$conn);

	$sql = "delete from LESSON where coursenum = ".$xm->coursenum;

updatesql($sql,$conn);

return;
}


function courseactive($xmm,$conn,$school)
{
	$xm = simplexml_load_string($xmm);

	$sql = "select courseactive from COURSE where  coursenum = ".$xm->coursenum;

	$coursearray = qry($conn,$sql);
	
	$course = arr($coursearray);
	
	if ($course['courseactive'] == 1)
	{
		$sql = "update COURSE set courseactive = 0 where coursenum = ".$xm->coursenum;
	}
	else	
	{
		$sql = "update COURSE set courseactive = 1 where coursenum = ".$xm->coursenum;
	}
	updatesql($sql,$conn);

	return;
}


?>
