<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";
include "writelesson.php";

$school = sessinfo($conn,"SCHDOM");

$sessnum = sessinfo($conn,"SESS");
$userip = sessinfo($conn,"userip");
$user = sessinfo($conn,"User_name");

$term = sessinfo($conn,'term');
$week = sessinfo($conn,'week');
$whichweek = sessinfo($conn,'whichweek');
$firstday = sessinfo($conn,'firstday');
$lastday = sessinfo($conn,'lastday');

writehead("AUTO BOOK",$conn,"autobook",0);

$term = sessinfo($conn,'term');
$week = sessinfo($conn,'week');

$content = "<button type=\"submit\" class=\"label\" disabled><h300>Term ".$term." Week ".$week."</h300></button>";

divmaker(35,20,40,10,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);

$content = "<button type=\"submit\" class=\"label\" disabled><h300>Bookings Completed</h300></button>";

divmaker(35,40,40,10,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);

$sql = "select * from COURSE co inner join COURSELIST cl on co.coursenum = cl.coursenum

where coursepriority >= 0 and tutor = ".sessinfo($conn,'tenum')." order by coursepriority";

$coursedata = qry($conn,$sql);

while ($courseinfo = arr($coursedata))
{
	$coursenum = $courseinfo['coursenum'];
	$stnum = $courseinfo['stnum'];
	$tenum = $courseinfo['tutor'];
	
	$booking = 0;
	
	$sql = "DELETE from wTTAB where SESS = '".$sessnum."'";

	$ttut = qry($conn,$sql);
	
	$sql = "select * from AVAILABILITY where tenum = ".$tenum." order by daynum,startblock";

	$availabilitydata = qry($conn,$sql);
			
	while ($availability = arr($availabilitydata))
	{
		$startblock = $availability['startblock'];
		$duration = $availability['duration'];	
		$int = $availability['daynum'];
		
		for ($blint = $startblock; $blint<=$startblock+$duration; $blint++)
		{
			$daynum = $firstday + $int - 1;
	
			$sql = "INSERT INTO wTTAB (SESS,lookup,blocknum,daynum,availability) values
			('".$sessnum."',".($blint+($int*288)).",".$blint.",".$daynum.",1)";
			
			$ttut = qry($conn,$sql);
		}
	}

	$sql = "select * from TRELLIS where tenum = ".$tenum." and daynum >= ".$firstday." and daynum <= ".$lastday;
						
	$trellisdata = qry($conn,$sql);
	
	while($trellis = arr($trellisdata))
	{

		$sql = "delete from wTTAB where blocknum >= ".$trellis['block']." and blocknum <= ".($trellis['block']+$trellis['lesson_length'])." and daynum = ".$trellis['daynum']." and SESS = '".$sessnum."'";

		$updatewTTAB = qry($conn,$sql);
	
	}
		
	$sql = "select * from COURSE co inner join COURSELIST cl on co.coursenum = cl.coursenum where stnum =".$stnum;
	
	$stcodata = qry($conn,$sql);
		
	while ($stco = arr($stcodata))
	{
		$sql = "select * from TRELLIS where coursenum = ".$stco['coursenum']." and daynum >= ".$firstday." and daynum <= ".$lastday." and tenum <> ".$tenum;	

		$trellisdata = qry($conn,$sql);		
				
		while($trellis = arr($trellisdata))
		{
				
					$sql = "delete from wTTAB where blocknum >= ".$trellis['block']." and blocknum <= ".($trellis['block']+$trellis['lesson_length'])." and daynum = ".$trellis['daynum']." and SESS = '".$sessnum."'";	
			$updatewTTAB = qry($conn,$sql);
		}
		
	}
	
		$sql = "select * from GROUPBOOKING gb inner join GROUPBOOKINGSTUDENTS gbs on gb.groupbookingnum = gbs.groupbookingnum where stnum =".$stnum;
	
	$stcodata = qry($conn,$sql);
		
	while ($stco = arr($stcodata))
	{
		$sql = "select * from TRELLIS where groupbookingnum = ".$stco['groupbookingnum']." and daynum >= ".$firstday." and daynum <= ".$lastday;	

		$trellisdata = qry($conn,$sql);		
				
		while($trellis = arr($trellisdata))
		{
				
					$sql = "delete from wTTAB where blocknum >= ".$trellis['block']." and blocknum <= ".($trellis['block']+$trellis['lesson_length'])." and daynum = ".$trellis['daynum']." and SESS = '".$sessnum."'";
					
			$updatewTTAB = qry($conn,$sql);
		}
		
	}
	
			$sql = "select * from GROUPBOOKING gb inner join GROUPBOOKINGTUTORS gbt on gb.groupbookingnum = gbt.groupbookingnum where tenum =".$tenum;
	
	$stcodata = qry($conn,$sql);
		
	while ($stco = arr($stcodata))
	{
		$sql = "select * from TRELLIS where groupbookingnum = ".$stco['groupbookingnum']." and daynum >= ".$firstday." and daynum <= ".$lastday;	
							
		$trellisdata = qry($conn,$sql);		
				
		while($trellis = arr($trellisdata))
		{
				
					$sql = "delete from wTTAB where blocknum >= ".$trellis['block']." and blocknum <= ".($trellis['block']+$trellis['lesson_length'])." and daynum = ".$trellis['daynum']." and SESS = '".$sessnum."'";	
			$updatewTTAB = qry($conn,$sql);
		}
		
	}
	
	$sql = "SELECT DISTINCT * FROM ROLL AS RL INNER JOIN CLASS AS CL ON RL.clnum = CL.clnum INNER JOIN STCLASS AS STC ON RL.clnum = STC.clnum AND RL.stnum = STC.stnum WHERE RL.stnum = ".$stnum." AND RL.daynum >= ".$firstday." and RL.daynum <= ".$lastday. " order by daynum,perstart";

		$rolldata = qry($conn,$sql);
		
		while($rollinfo = arr($rolldata))
		{
			$availability = $rollinfo['clavail'] - $rollinfo['clused'];
	
			$sql = "update wTTAB set availability = ".$availability." where daynum = ".$rollinfo['daynum']." and blocknum > ".$rollinfo['perstart']." and blocknum < ".($rollinfo['perstart']+$rollinfo['perlength'])." and SESS = '".$sessnum."' and availability <> 0";
			
//			echo $sql."<BR>";
		
			$updatewTTAB = qry($conn,$sql);
			
//			$sql = "update wTTAB set availability = ".($availability*1.1)." where daynum = ".$rollinfo['daynum']." and blocknum = ".$rollinfo['perstart']." and SESS = '".$sessnum."'";

			$sql = "update wTTAB set availability = ".($availability)." where daynum = ".$rollinfo['daynum']." and blocknum = ".$rollinfo['perstart']." and SESS = '".$sessnum."'";


			
			$updatewTTAB = qry($conn,$sql);
			
		}

	for ($dayselect = $firstday;$dayselect <= $lastday;$dayselect++)
	{
		$sql = "select * from wTTAB where SESS = '".$sessnum."' and daynum = ".$dayselect." and availability <> 0 order by blocknum";
		
		$wTTABdata = qry($conn,$sql);
				
		$firstblock = 0;
		$lastblock = 0;
		$duration = 0;
		
		while($wTTAB = arr($wTTABdata))
		{
			if ($firstblock == 0)
			{
				$firstblock = $wTTAB['blocknum']; // 143
				$lastblock = $wTTAB['blocknum']; // 143
				$duration = 0;
			}
			else
			{
				if ($wTTAB['blocknum'] <> $lastblock+1)
				{	
				$sql = "update wTTAB set duration = ".$duration." where daynum = ".$dayselect." and  blocknum >= ".$firstblock." and blocknum <= ".$lastblock." and SESS = '".$sessnum."'";
				
//				echo $sql."<BR>";
				$wTTABupdate = qry($conn,$sql);
				$firstblock = $wTTAB['blocknum'];
				$duration = 0;
				}
			
				$duration++;
				$lastblock = $wTTAB['blocknum'];
				
			}
		}
		
		$sql = "update wTTAB set duration = ".$duration." where daynum = ".$dayselect." and  blocknum >= ".$firstblock." and blocknum <= ".$lastblock." and SESS = '".$sessnum."'";
				
			$wTTABupdate = qry($conn,$sql);
				
		
	}
		
	$sql = "select * from DAYS where daynum >= ".$firstday. " and daynum <= ".$lastday;
	
	$daysdata = qry($conn,$sql);
		
	while ($days = arr($daysdata))
	{
		if ($days['schoolday'] <> 1)
		{
		$sql = "delete from wTTAB where daynum = ".$days['daynum'];
		$wTTABdelete  = qry($conn,$sql);
		}
	}
		
//		$sql = "select * from wTTAB where duration >= ".($courseinfo['length']/5)." and availability > 0 and lesson_num = 0 and SESS = '".$sessnum."' order by (99-availability),daynum,blocknum limit 1";
		
		
		
				$sql = "select * from wTTAB where duration >= ".($courseinfo['length']/5)." and availability > 0 and lesson_num = 0 and SESS = '".$sessnum."' order by (99-availability),daynum,blocknum";

	$wTTABdata = qry($conn,$sql);
	

$rowcount=mysqli_num_rows($wTTABdata);

	if ($rowcount <> 0)
	{
			
		while ($wTTAB = arr($wTTABdata))
		{
		
		$daynum = $wTTAB['daynum'];
		$block = $wTTAB['blocknum'];
		
		$sql = "select * from TRELLIS where block+lesson_length > ".$block." and block < ".($block+($courseinfo['length']/5)). " and tenum = ".$tenum." and daynum = ".$daynum;

		

	$trellisinfo = qry($conn,$sql);

	$num_rows = mysqli_num_rows($trellisinfo);

		if ($num_rows == 0)
			{
				$file = fopen("autobook3.txt","a+");
				fwrite($file,$sql.";\r\n");

				fwrite($file,$wTTAB['daynum']." ".$wTTAB['blocknum']." ".$coursenum.";\r\n");
						
				$xm = '';

				$xm .=  "<inputs>\r";
				$xm .=  "<data_source>autobook3.php</data_source>\r";
				$xm .= "<userip>".$userip."</userip>\r";
				$xm .= "<user>".$user."</user>\r";
				$xm .= "<date>".gmdate(DATE_RFC822)."</date>\r";
				$xm .= "<school>".$school."</school>\r";

				$xm .=  "<block>".$block."</block>\r";
				$xm .=  "<daynum>".$daynum."</daynum>\r";
				$xm .=  "<lessonlength>".($courseinfo['length']/5)."</lessonlength>\r";
				$xm .=  "<coursenum>".$coursenum."</coursenum>\r";
				$xm .=  "<tutor>".$tenum."</tutor>\r";
				$xm .=  "<repeat>99</repeat>\r";
				$xm .=  "<numles>1</numles>\r";
				$xm .=  "<interval>0</interval>\r";
				$xm .=  "</inputs>\r";

				$xmm = writexml($xm,$school,$conn);

				addlesson($xm,$conn,$school);
				
				$sql = "update COURSE set lessonsbooked = lessonsbooked = 1 where coursenum = ".$coursenum;
				
				$courseupdate = qry($conn,$sql);
				
				$commitdata = qry($conn,"commit");
				break;
			}
			else
			{
			}
	}
		
	fwrite($file,$daynum." ".$block." ".$coursenum.";\r\n");
	
	
	
fclose($file);


	}
}



$numweeks = sessinfo($conn,"numweeks");

$weeksbooked = sessinfo($conn,"weeksbooked");

sessupdate($conn,"weeksbooked",$weeksbooked+1);

if (sessinfo($conn,"addtutor") == 1)
{
	weekup($conn);
	
	if ($weeksbooked+1 == $numweeks)
	{
		$targetpage = "admin.php";
	}
	else
	{
		$targetpage = "autobook1.php";
	}	
}
else
{
$targetpage = "timetable.php";
}	

?>
<script type="text/javascript">
function adminmenu()
{

var targetpage = "<?php echo $targetpage ?>";

	window.location.href = targetpage;
}
setTimeout(adminmenu,2000);
</script>

