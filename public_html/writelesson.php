<?php
function addlesson($xmm,$conn,$school)
{
$xm = simplexml_load_string($xmm);

$daynum = $xm->daynum;

for ($int = 0;$int < $xm->numles;$int++)
	{
		$sql = "select * from DAYS where daynum = ".$daynum;

		$daysdata = qry($conn,$sql);

		$days = arr($daysdata);
		
			if ($days['schoolday'] == 1)
			{
					$sql = "insert into LESSON (coursenum) values (".$xm->coursenum.")";
				//$result = qry($conn,$sql);

				updatesql($sql,$conn);

				$sql = "select lesson_num from LESSON ORDER BY lesson_num DESC LIMIT 1";

				$lessondata = qry($conn,$sql);

				$lesson = arr($lessondata);
				$lessonnum = $lesson['lesson_num'];
				

				$sqlins = "INSERT INTO TRELLIS (block,daynum,coursenum,lessonnum,lesson_length,tenum,fixed) VALUES (";
				  $sqlins = $sqlins . 
				  $xm->block . "," . 
				  $daynum . "," . 
				  $xm->coursenum . "," .
				  $lessonnum . "," .
				  $xm->lessonlength . "," .
				  $xm->tutor . "," .
				  $xm->repeat . ")"; 
				  
				  updatesql($sqlins,$conn);
				  
				  $sqlup = "UPDATE COURSE set lessonsbooked = lessonsbooked + 1 where coursenum = ".$xm->coursenum;
				  
					updatesql($sqlup,$conn);
				  
				$sql = "select * from COURSELIST where coursenum = ".$xm->coursenum;

				$stinfo = qry($conn,$sql);

				$daynum;
				$blocknum =   $xm->block;
				$lessonlength =   $xm->lessonlength;

				$stinfo_array = arr($stinfo);
					
						
					$sql = "SELECT * FROM ROLL WHERE stnum = ".$stinfo_array['stnum']." AND daynum = ".$daynum." AND perstart+perlength > ".$blocknum." and perstart < ".($blocknum+$lessonlength);
						
					$rollinfo = qry($conn,$sql);
						
						while ($rollinfo_array = arr($rollinfo))
						{
							
							$sqlins = "update STCLASS set clused = clused + 1 where stnum = ".$stinfo_array['stnum']." and clnum = ".$rollinfo_array['clnum'];
						
						updatesql($sqlins,$conn);
								
						}
						
					$sqlins = "update ROLL set lessonnum = ".$lessonnum." WHERE stnum = ".$stinfo_array['stnum']." AND daynum = ".$daynum." AND perstart+perlength > ".$blocknum." and perstart < ".($blocknum+$lessonlength);
						
						updatesql($sqlins,$conn);	
					
				
			}
			else
			{
			$int = $int-1;
			}
		
	if ($xm->interval == 0)
	{$daynum = $daynum + 7;}else{$daynum = $daynum + 14;}
}		
return;
}
?>
