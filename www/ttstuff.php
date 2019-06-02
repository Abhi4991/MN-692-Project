<?php

function drawtrellis($conn,$term,$week,$booking,$tenum,$sessnum,$startblock,$firstday,$lastday,$daynum)
{

$last_day = 0;
$last_block = 0;


	for ($int=0;$int<=10;$int++)
	{
			$blocktime = $startblock+$int*12;
					
			if (strlen(daytime($conn,$blocktime)) == 7)
			{
				$content = " ".substr(daytime($conn,$blocktime),0,1)." ".substr(daytime($conn,$blocktime),5,2);
			}
			else
			{
				$content = substr(daytime($conn,$blocktime),0,2)." ".substr(daytime($conn,$blocktime),6,2);
			}			
				divmaker(5,($int*12)+14,94,1,"white","blue","1","text-align: left;","<hr/>");
				divmaker(1,($int*12)+15,4,3,"white","blue","1","text-align: center;","<h120>".$content."</h120>");
	}

$sql = "DELETE from wTTAB where SESS = '".$sessnum."'";

$ttut = qry($conn,$sql);

	$blocknum = $startblock;
	
	for ($int=0;$int<=120;$int++)
	{

			for ($across=0; $across<=count($daynum)-1; $across++)
			{

		
				$sql = "INSERT INTO wTTAB (SESS,lookup,blocknum,daynum) values
				('".$sessnum."',".($blocknum+($across*288)).",".$blocknum.",".$daynum[$across].")";

				$ttut = qry($conn,$sql);
					
			}
			
			$blocknum = $blocknum + 1 ;
			 
	}
	
	if ($booking < 2)
	{
	
		$sql = "select * from TRELLIS inner join COURSE on TRELLIS.coursenum = COURSE.coursenum where daynum >= ".
		$firstday." and daynum <= ".$lastday. " and tenum = ".$tenum;
		
	$trellisdata = qry($conn,$sql);

		while ($trellis = arr($trellisdata))
		{
				$content = "";
					
				$content = "<button type=\"submit\" class = \"smallmenu-button blue \" value = \"".$trellis['lessonnum']."\" name = \"sel\"";
				
			if ($booking == 1)
			{
				$content = $content . " disabled";
				$boxwidth = 9;
				$description = "<h80>".$trellis['description']."</h80><BR>";
			}
			else
			{
				$boxwidth = 15;
				echo "<FORM METHOD=\"POST\" ACTION=\"lessonaction.php\">";
				
				$description = "<h120>".$trellis['description']."</h120><BR>";
			}

			$timedisp = "<h80>".daytime($conn,$trellis['block'])."-".daytime($conn,$trellis['block']+$trellis['lesson_length'])."</h80>";
			
			$content = $content .">".$description.$timedisp."</button>";
				//	$content = $trellis['description'];
			
				$top = (($trellis['block']  - $startblock))+15;
				$height = $trellis['lesson_length'];
				$left = ($trellis['daynum'] - $daynum[0])*17 + 10;
				$width = $boxwidth;
				
			$posinfo = "";

			$posinfo = "";
			
			divmaker($left,$top,$width,$height,"white","blue","1",$posinfo,$content); 
			
			if ($booking == 1) {}else{echo "</FORM>";}
	

			$sql = "update wTTAB set lesson_num = ".$trellis['lessonnum'].", coursenum = ".$trellis['coursenum']." where SESS = '".$sessnum."' and daynum = ".$trellis['daynum']." and blocknum >= ".$trellis['block']." and blocknum < ".($trellis['block']+$trellis['lesson_length']);
			
			$timenum = qry($conn,$sql);
					//		$sqltot = $sqltot." bbb <BR>".$sql;
		}	
		
		$sql = "select * from TRELLIS tr inner join GROUPS gr on tr.groupnum = gr.groupnum inner join GROUPBOOKINGTUTORS gbt on tr.groupbookingnum = gbt.groupbookingnum where daynum >= ".
		$firstday." and daynum <= ".$lastday. " and gbt.tenum = ".$tenum;
		
	$trellisdata = qry($conn,$sql);
	
		while ($trellis = arr($trellisdata))
		{
				$content = "";
					
				$content = "<button type=\"submit\" class = \"smallmenu-button blue\" value = \"".$trellis['groupbookingnum']."\" name = \"sel\"";
				
			if ($booking == 1)
			{
				$content = $content . " disabled";
				$boxwidth = 9;
				$description = "<h80>".$trellis['description']."</h80><BR>";
			
			}
			else
			{
				$boxwidth = 15;
				echo "<FORM METHOD=\"POST\" ACTION=\"groupbookingaction.php\">";
				$description = "<h120>".$trellis['description']."</h120><BR>";
				
			}

			$timedisp = "<h80>".daytime($conn,$trellis['block'])."-".daytime($conn,$trellis['block']+$trellis['lesson_length'])."</h80>";
				
			$content = $content .">".$description.$timedisp."</button>";
				//	$content = $trellis['description'];
			
				$top = (($trellis['block']  - $startblock))+15;
				$height = $trellis['lesson_length'];
				$left = ($trellis['daynum'] - $daynum[0])*17 + 10;
				$width = $boxwidth;
				
				$posinfo = "line-height:0;text-align: center;";	
			
			
			divmaker($left,$top,$width,$height,"white","blue","1",$posinfo,$content); 
			
			if ($booking == 1) {}else{echo "</FORM>";}

			$sql = "update wTTAB set groupnum = ".$trellis['groupnum'].",groupbookingnum = ".$trellis['groupbookingnum']." where SESS = '".$sessnum."' and daynum = ".$trellis['daynum']." and blocknum >= ".$trellis['block']." and blocknum < ".($trellis['block']+$trellis['lesson_length']);
			
			$timenum = qry($conn,$sql);
					//		$sqltot = $sqltot." bbb <BR>".$sql;
		}	
		
			
	}
		
}


function coursebooking($conn,$sessnum,$firstday,$lastday,$coursenum,$daynum,$startblock,$term,$week)
{
		$sql = "select description from COURSE where coursenum = ".$coursenum;
		$cor = qry($conn,$sql);
		$co_array = arr($cor);
		$bookdesc = "Adding booking for ".$co_array['description']." Term ".$term." Week ".$week;
				
		$sql = "select * from COURSELIST where coursenum = ".$coursenum;

		$stu = qry($conn,$sql);
	
		 while ($st_array = arr($stu))
		{
			$stnum = $st_array['stnum'];
			$sql = "select * from COURSELIST where stnum = ".$stnum;
			$cor = qry($conn,$sql);
		 		
			 while ($cor_array = arr($cor))
			{
				$lookcor = $cor_array['coursenum'];
			
				$sql = "select * from TRELLIS TR inner join TUTOR TU on TR.tenum = TU.tenum where daynum >= ".$firstday." and daynum <= ".$lastday. " and coursenum = ".$lookcor;

				$trellisdata = qry($conn,$sql);
			
				$sqli = 1;
				
				while ($trellis = arr($trellisdata))
				{
					$content = "<button type=\"submit\" class = \"smallmenu-button red\" disabled>".$trellis['first_name']." ".$trellis['last_name']."</button>";
					
					$top = (($trellis['block']  - $startblock))+15;
					$height = $trellis['lesson_length'];
					$left = ($trellis['daynum'] - $daynum[0])*17 + 10;
					
					divmaker($left,$top,9,$height,"","","1","",$content);
					
					$sql = "update wTTAB set lesson_num = ".$trellis['lessonnum'].", coursenum = ".$trellis['coursenum']." where SESS = '".$sessnum."' and daynum = ".$trellis['daynum']." and blocknum >= ".$trellis['block']." and blocknum < ".($trellis['block']+$trellis['lesson_length']);
					
					$sqli++;
	
					$timenum = qry($conn,$sql);
					
				}	
			}
		}
		
		
			$sql = "select * from GROUPBOOKINGSTUDENTS where stnum = ".$stnum;
			$groupbookingstudentsdata = qry($conn,$sql);
		 		
			 while ($groupbookingstudents = arr($groupbookingstudentsdata))
			{
				$groupbookingnum = $groupbookingstudents['groupbookingnum'];
			
				$sql = "select * from TRELLIS TR inner join GROUPS GR on TR.groupnum = GR.groupnum where daynum >= ".$firstday." and daynum <= ".$lastday. " and TR.groupbookingnum = ".$groupbookingnum;

				$trellisdata = qry($conn,$sql);
			
				$sqli = 1;
				
				while ($trellis = arr($trellisdata))
				{
					$content = "<button type=\"submit\" class = \"smallmenu-button red\" disabled>".$trellis['description']."</button>";
					
					$top = (($trellis['block']  - $startblock))+15;
					$height = $trellis['lesson_length'];
					$left = ($trellis['daynum'] - $daynum[0])*17 + 10;
					
					divmaker($left,$top,9,$height,"","","1","",$content);
					
					$sql = "update wTTAB set lesson_num = ".$trellis['lessonnum'].", groupnum = ".$trellis['groupnum']." where SESS = '".$sessnum."' and daynum = ".$trellis['daynum']." and blocknum >= ".$trellis['block']." and blocknum < ".($trellis['block']+$trellis['lesson_length']);
					
					$sqli++;
	
					$timenum = qry($conn,$sql);
				}
			}
			
bookingsel($conn,$firstday,$startblock,$sessnum);
	
		$sql = "SELECT DISTINCT * FROM ROLL AS RL INNER JOIN CLASS AS CL ON RL.clnum = CL.clnum INNER JOIN STCLASS AS STC ON RL.clnum = STC.clnum AND RL.stnum = STC.stnum WHERE RL.stnum = ".$stnum." AND RL.daynum >= ".$firstday." AND RL.daynum <=".$lastday. "	ORDER BY RL.daynum, RL.pernum";
		
		divmaker(0,100,65,65,"white","blue","","position:fixed;" ,"<button type=\"submit\" class= \"labelwhite\" disabled><h200><center>".$sql."</center></h200></button>");
		

		$roll = qry($conn,$sql);
	
		while ($roll_array = arr($roll))
		{			
			$left = (($roll_array['daynum'] - $daynum[0])*17) + 19;
			$top = (($roll_array['perstart']-$startblock))+15;
			$height = $roll_array['perlength'];
			$width = 8;
			
			if (($roll_array['clavail'] - $roll_array['clused']) > 0)
			{


				$content = "<button type=\"submit\" class = \"smallmenu-button green\" title= \"".daytime($conn,$roll_array['perstart'])."-".daytime($conn,$roll_array['perstart']+$roll_array['perlength'])."\" name = \"ttime\" value = ".($roll_array['perstart']+($roll_array['daynum']- $daynum[0])*288)."><h100>".($roll_array['clavail'] - $roll_array['clused'])." ".$roll_array['class_desc']."</h100></button>" ;



			}
			else
			{
				$content = "<button type=\"submit\"	class = \"smallmenu-button red\" title= \"".daytime($conn,$roll_array['perstart'])."-".daytime($conn,$roll_array['perstart']+$roll_array['perlength'])."\" disabled>"."<h100>".($roll_array['clavail'] - $roll_array['clused'])." ".$roll_array['class_desc']."</h100></button>" ;
			}
			
			divmaker($left,$top,$width,$height,"","","1","text-align: center;",$content);
		}
		
			headings($bookdesc,$conn);

			
}
			
function groupbooking($conn,$sessnum,$firstday,$lastday,$groupnum,$daynum,$startblock,$term,$week)
	

	{
		$sql = "select description from GROUPS where groupnum = ".$groupnum;

		$groupsdata = qry($conn,$sql);
		
		$groups = arr($groupsdata);
		
		$bookdesc = "Adding booking for ".$groups['description']." Term ".$term." Week ".$week;
			
bookingsel($conn,$firstday,$startblock,$sessnum);		
				
		headings($bookdesc,$conn);
	}

function headings($bookdesc,$conn)	
{
	
	if (sessinfo($conn,"User_type") == 1)
	{
		
	divmaker(15,0,65,10,"white","blue","","position:fixed;" ,"<button type=\"submit\" class= \"labelwhite\" disabled><h200><center>".$bookdesc."</center></h200></button>");
	}
	else
		
	
	{
	echo "<FORM METHOD=\"POST\" ACTION=\"tutors.php\">";
	sessupdate($conn,"addtutor",4);
	$content = "<button type=\"submit\" class=\"menu-button\" >".$bookdesc."</button>";
	divmaker(15,0,65,10,"white","blue","1","
	position:fixed;" 
	,$content);

	echo "</FORM>\n";
	
	}
		
	$dayname = array("Monday","Tuesday","Wednesday","Thursday","Friday");

	for ($i=0;$i <= 4;$i++)
	{
		
		$posinfo = "font-size: 200%;text-align: left;position:fixed;";	
			divmaker(0,10,10,4,"","blue","1","font-size: 150%;text-align: center;position:fixed;" ,"<button type=\"submit\" class= \"labelwhite\" disabled></button>");
			divmaker(90,10,10,4,"","blue","1","font-size: 150%;text-align: center;position:fixed;" ,"<button type=\"submit\" class= \"labelwhite\" disabled></button>");
			
		divmaker(10+($i*17),10,17,4,"","blue","1","position:fixed;" ,"<button type=\"submit\" class= \"labelwhite\" disabled><h150>".$dayname[$i]."</h150></button>");
	}
}

function bookingsel($conn,$firstday,$startblock,$sessnum)
{
	
	for ($daydisp = 0;$daydisp <= 4;$daydisp++)
	{
	
		for ($hourdisp = 0;$hourdisp <= 9;$hourdisp++)
		{
			$sql = " select * from wTTAB where daynum = ".($daydisp+$firstday)." and blocknum >= ".
			($hourdisp*12+$startblock)." and blocknum < ".($hourdisp*12+$startblock+12).
			" and SESS = '".$sessnum."' order by lookup";
			$firstblock = 0;
			$lastblock = 0;
								
			$wTTABdata = qry($conn,$sql);
			
			while ($wTTAB = arr($wTTABdata))
			{
				if ($wTTAB['lesson_num'] <> 0 or $wTTAB['groupbookingnum'] <> 0)
				{
					if ($firstblock <> 0)
					{
						$left = 10+$daydisp*17;	
						$top = ($firstblock-$startblock)+15;
						$height = ($lastblock - $firstblock)*1.1;
						$width = 9;
						
						$timedisp = daytime($conn,$firstblock)."-".daytime($conn,$lastblock);
						
						$firstlookup = $wTTAB['lookup'];
			
//					$content = "<button type=\"submit\" class = \"period\" value = \"".$firstblock."\" name = \"ttime\" title  = \"".$timedisp."\"></button>";

					$content = "<button type=\"submit\" class =\"period\" value  = ".($firstblock+($daydisp*288))." name = \"ttime\" title  = \"".$timedisp."\"></button>";
													
					divmaker($left,$top,$width,$height,"white","black","1","",$content);
				
						$firstblock = 0;
						$lastblock = 0;
					}
				}
				else
				{
				if ($firstblock == 0)
				{ $firstblock = $wTTAB['blocknum'];}
				$lastblock = $wTTAB['blocknum'];
				}				
			}
				if ($firstblock <> 0)
				{
						$left = 10+$daydisp*17;	
						$top = ($firstblock-$startblock)+15;
						$height = ($lastblock - $firstblock)*1.1;
						$width = 9;
						
						$timedisp = daytime($conn,$firstblock)."-".daytime($conn,$lastblock);
						
						$firstlookup = $wTTAB['lookup'];
			
$content = "<button type=\"submit\" class = \"period\" value = ".($firstblock+($daydisp*288))." name = \"ttime\" title  = \"".$timedisp."\"></button>";
													
					divmaker($left,$top,$width,$height,"white","black","1","",$content);
					
				}
								
		}
	
	}



}
?>