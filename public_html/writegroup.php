<?php
function addgroup($xmm,$conn,$school)
{
$xm = simplexml_load_string($xmm);
	
	$sql = "insert into GROUPS (description) values (";

$sql.=  "'";
$sql.=  $xm->description."')";

$groupnum = updatesql($sql,$conn);

sessupdate($conn,"tempnum",$groupnum);

return;
}

function addgrouptutor($xmm,$conn,$school)
{
$xm = simplexml_load_string($xmm);
	
	$sql = "insert into GROUPTUTORS (tenum,groupnum) values (";

$sql.=  $xm->tenum.",".$xm->groupnum.")";

updatesql($sql,$conn);

return;
}

function addgroupstudent($xmm,$conn,$school)
{
$xm = simplexml_load_string($xmm);
	
	$sql = "insert into GROUPSTUDENTS (stnum,groupnum) values (";

$sql.=  $xm->stnum.",".$xm->groupnum.")";

updatesql($sql,$conn);

return;
}

function delgroup($xmm,$conn,$school)
{
$xm = simplexml_load_string($xmm);
	
	$sql = "delete from GROUPS where groupnum = ".$xm->groupnum;

updatesql($sql,$conn);


	$sql = "delete from GROUPTUTORS where groupnum = ".$xm->groupnum;

updatesql($sql,$conn);

	$sql = "delete from GROUPSTUDENTS where groupnum = ".$xm->groupnum;

updatesql($sql,$conn);

return;
}

function delgrouptutor($xmm,$conn,$school)
{
$xm = simplexml_load_string($xmm);
	
	$sql = "delete from GROUPTUTORS where groupnum = ".$xm->groupnum." and tenum = ".$xm->grouptutor;

updatesql($sql,$conn);

return;
}

function delgroupstudent($xmm,$conn,$school)
{
$xm = simplexml_load_string($xmm);
	
	$sql = "delete from GROUPSTUDENTS where groupnum = ".$xm->groupnum." and stnum = ".$xm->stnum;

updatesql($sql,$conn);

return;
}
function addgroupbooking($xmm,$conn,$school)
{
$xm = simplexml_load_string($xmm);

$daynum = $xm->daynum;

for ($int = 0;$int < $xm->numles;$int++)
	{
		$sql = "select * from DAYS where daynum = ".$daynum;

		$daysdata = qry($conn,$sql);

		while ($days = arr($daysdata))
		{
			if ($days['schoolday'] == 1)
			{
					$sql = "insert into GROUPBOOKING (groupnum) values (".$xm->groupnum.")";
				//$result = qry($conn,$sql);

				updatesql($sql,$conn);

				$sql = "select groupbookingnum from GROUPBOOKING order by groupbookingnum DESC LIMIT 1";

				$groupbookingdata = qry($conn,$sql);

				$groupbooking = arr($groupbookingdata);
				$groupbookingnum = $groupbooking['groupbookingnum'];
				

				$sqlins = "INSERT INTO TRELLIS (block,daynum,groupnum,groupbookingnum,lesson_length,fixed) VALUES (";
				  $sqlins = $sqlins . 
				  $xm->block . "," . 
				  $daynum . "," . 
				  $xm->groupnum . "," .
				  $groupbookingnum . "," .
				  $xm->duration . ",1)"; 
				  
				  updatesql($sqlins,$conn);
				  
				addbookingtutors($conn,$xm->groupnum,$groupbookingnum);

				addbookingstudents($conn,$xm->groupnum,$groupbookingnum);

				  
				  
				  
	
			}
			else
			{
			$int = $int-1;
			}
		}
		if ($xm->interval == 0)
		{$daynum = $daynum + 7;}else{$daynum = $daynum + 14;}

	}		
return;
}

function addbookingtutors($conn,$groupnum,$groupbookingnum)
{
$school = sessinfo($conn,"SCHDOM");
$tenum = sessinfo($conn,"tenum");
$userip = sessinfo($conn,"userip");
$user = sessinfo($conn,"User_name");

$sql = "select * from GROUPTUTORS where groupnum = ".$groupnum;

$grouptutorsdata = qry($conn,$sql);

while ($grouptutors = arr($grouptutorsdata))
	{

	$tbookingnum = $grouptutors['tenum'];

	$xm = '';

	$xm .= "<inputs>\r";
	$xm .= "<data_source>writegroup.php</data_source>\r";
	$xm .= "<userip>".$userip."</userip>\r";
	$xm .= "<user>".$user."</user>\r";
	$xm .= "<date>".gmdate(DATE_RFC822)."</date>\r";
	$xm .= "<school>".$school."</school>\r";
	$xm .= "<tenum>".$tbookingnum."</tenum>\r";
	$xm .= "<groupbookingnum>".$groupbookingnum."</groupbookingnum>\r";
	$xm .= "</inputs>\r";

	$xmm = writexml($xm,$school,$conn);

	$xm = simplexml_load_string($xm);
		
		$sql = "insert into GROUPBOOKINGTUTORS (tenum,groupbookingnum) values (";

	$sql.=  $xm->tenum.",".$xm->groupbookingnum.")";

	updatesql($sql,$conn);

	}
return;
}

function addbookingstudents($conn,$groupnum,$groupbookingnum)
{
$school = sessinfo($conn,"SCHDOM");
$tenum = sessinfo($conn,"tenum");
$userip = sessinfo($conn,"userip");
$user = sessinfo($conn,"User_name");

$sql = "select * from GROUPSTUDENTS where groupnum = ".$groupnum;

$groupstudentsdata = qry($conn,$sql);

while ($groupstudents = arr($groupstudentsdata))
	
{

$stnum = $groupstudents['stnum'];

$xm = '';

$xm .= "<inputs>\r";
$xm .= "<data_source>addgroupstudent.php</data_source>\r";
$xm .= "<userip>".$userip."</userip>\r";
$xm .= "<user>".$user."</user>\r";
$xm .= "<date>".gmdate(DATE_RFC822)."</date>\r";
$xm .= "<school>".$school."</school>\r";
$xm .= "<stnum>".$stnum."</stnum>\r";
$xm .= "<groupbookingnum>".$groupbookingnum."</groupbookingnum>\r";
$xm .= "</inputs>\r";

$xmm = writexml($xm,$school,$conn);

$xm = simplexml_load_string($xm);
	
	$sql = "insert into GROUPBOOKINGSTUDENTS (stnum,groupbookingnum,attendance) values (";

$sql.=  $xm->stnum.",".$xm->groupbookingnum.",1)";

updatesql($sql,$conn);

}
return;
}

function delgroupbooking($xmm,$conn,$school)
{
$school = sessinfo($conn,"SCHDOM");
$tenum = sessinfo($conn,"tenum");
$userip = sessinfo($conn,"userip");
$user = sessinfo($conn,"User_name");

$xm = simplexml_load_string($xmm);
	
	$sql = "delete from GROUPBOOKINGSTUDENTS where groupbookingnum = ".$xm->groupbookingnum;

updatesql($sql,$conn);

	$sql = "delete from GROUPBOOKINGTUTORS where groupbookingnum = ".$xm->groupbookingnum;

updatesql($sql,$conn);

	$sql = "delete from GROUPBOOKING where groupbookingnum = ".$xm->groupbookingnum;

updatesql($sql,$conn);

	$sql = "delete from TRELLIS where groupbookingnum = ".$xm->groupbookingnum;

updatesql($sql,$conn);


return;
}

function delgroupbookingtutor($xmm,$conn,$school)
{
$xm = simplexml_load_string($xmm);
	
	$sql = "delete from GROUPBOOKINGTUTORS where groupbookingnum = ".$xm->groupbookingnum." and tenum = ".$xm->groupbookingtutor;

updatesql($sql,$conn);

return;
}
function delgroupbookingstudent($xmm,$conn,$school)
{
$xm = simplexml_load_string($xmm);
	
	$sql = "delete from GROUPBOOKINGSTUDENTS where groupbookingnum = ".$xm->groupbookingnum." and stnum = ".$xm->stnum;

updatesql($sql,$conn);

return;
}



function addbookingtutor($xmm,$conn,$school)
{
$xm = simplexml_load_string($xmm);
	
	$sql = "insert into GROUPBOOKINGTUTORS (tenum,groupbookingnum) values (";

$sql.=  $xm->tenum.",".$xm->groupbookingnum.")";

updatesql($sql,$conn);

return;
}

function addbookingstudent($xmm,$conn,$school)
{
$xm = simplexml_load_string($xmm);
	
	$sql = "insert into GROUPBOOKINGSTUDENTS (stnum,groupbookingnum,attendance) values (";

$sql.=  $xm->stnum.",".$xm->groupbookingnum.",1)";

updatesql($sql,$conn);

return;
}

function presentgroupbookingstudent($xmm,$conn,$school)
{
$xm = simplexml_load_string($xmm);
	
	$sql = "update GROUPBOOKINGSTUDENTS set attendance = attendance*(-1) where groupbookingnum = ".$xm->groupbookingnum." and stnum = ".$xm->stnum;

updatesql($sql,$conn);

return;
}

?>
