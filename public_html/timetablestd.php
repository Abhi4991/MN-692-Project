<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

writehead("TIME TABLE",$conn,"timetable",0);

updownweek(80,0);

echo "<FORM METHOD=\"POST\" ACTION=\"menu.php\">";

divmaker(0,0,15,10,"white","blue","1","font-size: 150%;
text-align: center;" 
,"<button type=\"submit\">MAIN MENU</button>");

echo "</FORM>\n";

$coursenum = filter_input(INPUT_POST, 'sel', FILTER_DEFAULT);

if($coursenum === NULL) 
	{ 
	$booking = 0;
	echo "<FORM METHOD=\"POST\" ACTION=\"lessonaction.php\">";
	}
else
	{ 
	$booking = 1;
	echo "<FORM METHOD=\"POST\" ACTION=\"addlesson1.php\">";
	}
	
$tenum = SESSINFO($conn,"tenum");
$sessnum = SESSINFO($conn,"SESS");
$term = SESSINFO($conn,"term");
$week = SESSINFO($conn,"week");
$firstday = SESSINFO($conn,"firstday");
$lastday = SESSINFO($conn,"lastday");

if ( sessinfo($conn,"sheight") > sessinfo($conn,"swidth"))
{
	$mobile = True;
	$mobscreen = 2.5;
	$dispday = sessinfo($conn,"dispday");
}
else
{
	$mobile = False;
	$mobscreen = 1;
}

	echo "<input type =\"hidden\" name = \"corsel\" value = \"".$coursenum."\">";

$sql = "select * from DAYS where termnum = ".$term." and weeknum = ".$week." order by daynum";

$sqltot = "";


$daysdata = qry($conn,$sql);

while ($days = arr($daysdata))
	{
	$daydate[$days['dayofweek']-1] = substr($days['thedate'],0,5);
	$daynum[$days['dayofweek']-1] = $days['daynum'];
	}

$sql = "select first_name,last_name from TUTOR where tenum = ".$tenum;

$tutordata = qry($conn,$sql);

while ($tutor = arr($tutordata))
	{
	$tefirst = $tutor['first_name'];
	$telast = $tutor['last_name'];	
	}	
//	divmaker(25,0,40,5,"white","blue","","font-size: 200%;position: fixed;
//text-align: center;" ,"Tutor: ".$tefirst." ".$telast." Term ".$term." Week ".$week);

$last_day = 0;
$last_block = 0;

$dayname = array("Monday","Tuesday","Wednesday","Thursday","Friday");

for ($i=0;$i <= 4;$i++)
{
	if ($mobile == True)
	{
		if ($dispday == $i + 1)
		{
		divmaker(10*$mobscreen,13,10*$mobscreen,10,"white","blue","1","font-size: 200%;text-align: center;" ,$dayname[$i]);
		}
	}
	else
	{
		divmaker(10*$mobscreen+($i*16),13,10*$mobscreen,10,"white","blue","1","font-size: 200%;text-align: center;" ,$dayname[$i]);
	}
}

$sql = "DELETE from wTTAB where SESS = '".$sessnum."'";

$ttut = qry($conn,$sql);

	$startblock = 97;

	$blocknum = $startblock;
	
for ($int=0;$int<=96;$int++)
{

		for ($across=0; $across<=4; $across++)
		{

			$sql = "INSERT INTO wTTAB (SESS,lookup,blocknum,daynum) values
			('".$sessnum."',".($blocknum+($across*288)).",".$blocknum.",".$daynum[$across].")";

			$ttut = qry($conn,$sql);
				
		}
		
		$blocknum = $blocknum + 1 ;
		 
}
		
	for ($int=0;$int<=7;$int++)
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
			divmaker(0*$mobscreen,($int*10)+18,6*$mobscreen,2,"white","blue","1","font-size: 150%;text-align: center;",$content);
			divmaker(6*$mobscreen,($int*10)+18,93,1,"white","blue","1","font-size: 150%;text-align: center;","<hr/>");
	}
	
	
	$sql = "select * from TRELLIS inner join COURSE on TRELLIS.coursenum = COURSE.coursenum where daynum >= ".$firstday." and daynum <= ".$lastday. " and tenum = ".$tenum;
	
	$sqltot = $sqltot." bbb <BR>".$sql;

$trellisdata = qry($conn,$sql);

while ($trellis = arr($trellisdata))
{
		$content = "";
			
		$content = "<button type=\"submit\" value = \"".$trellis['lessonnum']."\" name = \"sel\"";
//		title= \"".daytime($conn,$trellis['block'])."-".daytime($conn,$trellis['block']+$trellis['lesson_length'])."\"";
		
	if ($booking == 1)
	{
		$content = $content . " disabled";
		$boxwidth = 9;
	}
	else
	{
		$boxwidth = 15;
	}
			
	$content = $content .">". 	$trellis['description']."</button>";
	
	//	$content = $trellis['description'];
	
	if ($mobile == True)
	{
		if ($dispday == $i + 1)
		{
		$top = (($trellis['block']  - $startblock)*10/12-1)+20;
		$height = $trellis['lesson_length']*10/12;
		$left = 10*$mobscreen;
		$width = $boxwidth*$mobscreen;
	
		divmaker($left,$top,$width,$height,"white","blue","1","font-size: 100%;text-align: center;",$content); 	

		}
	}
	else
	{
		$top = (($trellis['block']  - $startblock)*10/12-1)+20;
		$height = $trellis['lesson_length']*10/12;
		$left = (($trellis['daynum'] - $daynum[0])*16 + 10)*$mobscreen;
		$width = $boxwidth*$mobscreen;
	
		divmaker($left,$top,$width,$height,"white","blue","1","font-size: 100%;text-align: center;",$content); 
	}		

		 	 
	$sql = "delete from wTTAB where SESS = '".$sessnum."' and daynum = ".$trellis['daynum']." and blocknum >= ".$trellis['block']." and blocknum < ".($trellis['block']+$trellis['lesson_length']);
	$timenum = qry($conn,$sql);
			//		$sqltot = $sqltot." bbb <BR>".$sql;
}	
	
	if ($booking == 1)
	{
		$sql = "select description from COURSE where coursenum = ".$coursenum;
		$cor = qry($conn,$sql);
		
		while ($co_array = arr($cor))
		{
			divmaker(25,6,40,5,"white","blue","1","font-size: 150%;text-align: center;" ,"Adding booking for ".$co_array['description']);
		}
		
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
			
				while ($trellis = arr($trellisdata))
				{
					$content = $trellis['first_name']." ".$trellis['last_name'];
					$top = (($trellis['block']  - $startblock)*10/12)+20;
					$height = $trellis['lesson_length']*10/12;
					$left = ($trellis['daynum'] - $daynum[0])*16 + 10;
					
					divmaker($left,$top,9,$height,"red","white","1","font-size: 100%;text-align: center;",$content);
					
					$sql = "delete from wTTAB where SESS = '".$sessnum."' and daynum = ".$trellis['daynum']." and blocknum >= ".$trellis['block']." and blocknum < ".($trellis['block']+$trellis['lesson_length']);
					
					$timenum = qry($conn,$sql);
				}
			}
		}
			for ($daydisp = 0;$daydisp <= 4;$daydisp++)
			{
			
				for ($hourdisp = 0;$hourdisp <= 7;$hourdisp++)
				{
				
					$sql = "select * from wTTAB where daynum = ".($daydisp+$firstday)." and blocknum >= ".($hourdisp*12+$startblock)." and blocknum <= ".($hourdisp*12+$startblock+12)." and SESS = '".$sessnum."' order by daynum,blocknum";
									
					$wTTABdata = qry($conn,$sql);
					
					$firstblock = 0;
					$firstlookup = 0;
					$blocks = 0;
					
					while ($wTTAB = arr($wTTABdata))
					{
						if ($firstblock == 0)
						{ 
							$firstblock = $wTTAB['blocknum'];
							$firstlookup = $wTTAB['lookup'];
						}
				
						$blocks++;
					}
				
					if ($firstblock <> 0)
					{
						$timedisp = daytime($conn,$firstblock)."-".daytime($conn,$firstblock+$blocks-1);
						$content = "<button type=\"submit\" class = \"period\" value = \"".$firstlookup."\" name = \"ttime\" >".$timedisp."</button>";
						//."-".daytime($conn,$firstblock+$blocks)
												
						$left = 10+$daydisp*16;	
						$top = ($firstblock-$startblock)*10/12+20;
						$height = ($blocks*10/12)-1;
						$width = 9;
						
						divmaker($left,$top,$width,$height,"white","black","1","",$content);
						
						//$sqltot = $sqltot."<BR>".$blocks;
					}
				}
			}
									
	

					
		$sql = "SELECT DISTINCT * FROM ROLL AS RL INNER JOIN CLASS AS CL ON RL.clnum = CL.clnum INNER JOIN STCLASS AS STC ON RL.clnum = STC.clnum AND RL.stnum = STC.stnum WHERE RL.stnum = ".$stnum." AND RL.daynum >= ".$firstday." AND RL.daynum <=".$lastday. "	ORDER BY RL.daynum, RL.pernum";
								divmaker(0,200,100,100,"white","blue","1","",$sql);
		$roll = qry($conn,$sql);
	
		while ($roll_array = arr($roll))
		{			
			$left = (($roll_array['daynum'] - $daynum[0])*16) + 19;
			$top = (($roll_array['perstart']-$startblock)*10/12)+20;
			$height = $roll_array['perlength']*10/12;
			$width = 7;
			
			if (($roll_array['clavail'] - $roll_array['clused']) > 0)
			{
				$content = "<button type=\"submit\" class = \"ttavail\" title= \"".daytime($conn,$roll_array['perstart'])."-".daytime($conn,$roll_array['perstart']+$roll_array['perlength'])."\" disabled>".$roll_array['class_desc']." ".$roll_array['clnum']."</button>" ;
			}
			else
			{
				$content = "<button type=\"submit\"	class = \"ttnotavail\" title= \"".daytime($conn,$roll_array['perstart'])."-".daytime($conn,$roll_array['perstart']+$roll_array['perlength'])."\" disabled>".$roll_array['class_desc']." ".$roll_array['clnum']."</button>" ;
			}
			
			divmaker($left,$top,$width,$height,"","","1","font-size: 100%;text-align: center;",$content);
		}
	}

	echo "</FORM>\n";
	
	
	divmaker(25,0,40,5,"white","blue","","font-size: 200%;position: fixed;
text-align: center;" ,"Tutor: ".$tefirst." ".$telast." Term ".$term." Week ".$week);


echo "</body>\n
</html>";
?>

