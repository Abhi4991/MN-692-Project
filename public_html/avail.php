<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

writehead("TUTOR AVAILABILTY",$conn,"redo stclass",0);

$startblock = 73;

$last_day = 0;
$last_block = 0;
$daynum = 1;
$sessnum = SESSINFO($conn,"SESS");

if (empty($_POST['tenum']))
{
$tenum = SESSINFO($conn,'tenum');
}
else
{
$tenum = $_POST['tenum'];
sessupdate($conn,'tenum',$tenum);
}


	
$firstday = 1;
$lastday = 5;

	for ($int=1;$int<=11;$int++)
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
				divmaker(5,($int*12)+4,94,1,"white","blue","1","text-align: left;","<hr/>");
				divmaker(1,($int*12)+5,4,3,"white","blue","1","text-align: center;","<h120>".$content."</h120>");
	}
	
	
		
	$sql = "DELETE from wTTAB where SESS = '".$sessnum."'";

$ttut = qry($conn,$sql);

	$blocknum = $startblock;
	
	for ($int=0;$int<=120;$int++)
	{

			for ($across=1; $across<=5; $across++)
			{

		
				$sql = "INSERT INTO wTTAB (SESS,lookup,blocknum,daynum) values
				('".$sessnum."',".($blocknum+($across*288)).",".$blocknum.",".$across.")";

				$ttut = qry($conn,$sql);
					
			}
			
			$blocknum = $blocknum + 1 ;
			 
	}
	
	for ($daydisp = 0;$daydisp <= 4;$daydisp++)
			{
			
				for ($hourdisp = 0;$hourdisp <= 9;$hourdisp++)
				{
				
					$sql = "select * from wTTAB where daynum = ".($daydisp+$firstday)." and blocknum >= ".
					($hourdisp*12+$startblock)." and blocknum < ".($hourdisp*12+$startblock+12).
					" and SESS = '".$sessnum."' order by lookup";
									
					$wTTABdata = qry($conn,$sql);
					
					$firstblock = 0;
					$firstlookup = 0;
					$blocks = 0;
					
					while ($wTTAB = arr($wTTABdata))
					{
						
							$firstblock = $wTTAB['blocknum'];
							$firstlookup = $wTTAB['lookup'];
						
						
								$blocks++;
					}	
		
					
					if ($blocks <> 0 and $firstblock <> 0)
					{
						$timedisp = daytime($conn,$firstblock+1)."-".daytime($conn,$firstblock+$blocks);
						$content = "<button type=\"submit\" class = \"period\" value = \"".($firstlookup+1).
						"\" name = \"ttime\" title  = \"".$timedisp."\"></button>";
														
						$left = 10+$daydisp*17;	
						$top = ($firstblock-$startblock)+5+1;
						$height = $blocks-0.5;
						$width = 9;
						
						echo "<FORM METHOD=\"POST\" ACTION=\"addavail1.php\">";
echo "<input type =\"hidden\" name = \"tenum\" value = \"".$tenum."\">";
echo "<input type =\"hidden\" name = \"daynum\" value = \"".$daynum."\">";
						divmaker($left,$top,$width,$height,"white","black","1","",$content);

						echo "</FORM>";
						
					}		
				}
			}
			
$sql = "select * from AVAILABILITY where tenum = ".$tenum." order by daynum,startblock";

		$availabilitydata = qry($conn,$sql);

		while ($availability = arr($availabilitydata))
		{
				$content = "";
					
				$content = "<button type=\"submit\" value = \"".$availability['availnum']."\" name = \"sel\" class=\"mediummenu-button\" ";
				
			$timedisp = "<h80>".daytime($conn,$availability['startblock'])."-".daytime($conn,$availability['startblock']+$availability['duration'])."</h80>";
				
			$content = $content .">"."<h120>".$timedisp."</h120></button>";

				$left = 10+(($availability['daynum']-1)*17);			
				$top = (($availability['startblock']  - $startblock))+5;
				$height = $availability['duration']-0.5;
				$width = 9;
			
				$posinfo = "line-height:0;text-align: center;";	
			
			echo "<FORM METHOD=\"POST\" ACTION=\"delavail.php\">";
echo "<input type =\"hidden\" name = \"tenum\" value = \"".$tenum."\">";
			divmaker($left,$top,$width,$height,"white","blue","1",$posinfo,$content); 
			
			echo "</FORM>";		
			
			$sql = "update wTTAB set lesson_num = ".$availability['availnum']." where SESS = '".$sessnum."' and daynum = ".$availability['daynum']." and blocknum >= ".$availability['startblock']." and blocknum < ".($availability['startblock']+$availability['duration']);
			
			$timenum = qry($conn,$sql);
					//		$sqltot = $sqltot." bbb <BR>".$sql;
		}	

divmaker(0,0,100,10,"","blue","1","font-size: 150%;text-align: center;position:fixed;" ,"<button type=\"submit\" class= \"labelwhite\" disabled></button>");
		

	$dayname = array("Monday","Tuesday","Wednesday","Thursday","Friday");

	for ($i=0;$i <= 4;$i++)
	{
		
		$posinfo = "font-size: 200%;text-align: left;position:fixed;";	
			divmaker(0,10,10,4,"","blue","1","font-size: 150%;text-align: center;position:fixed;" ,"<button type=\"submit\" class= \"labelwhite\" disabled></button>");
			divmaker(90,10,10,4,"","blue","1","font-size: 150%;text-align: center;position:fixed;" ,"<button type=\"submit\" class= \"labelwhite\" disabled></button>");
			
		divmaker(10+($i*17),10,17,4,"","blue","1","position:fixed;" ,"<button type=\"submit\" class= \"labelwhite\" disabled><h150>".$dayname[$i]."</h150></button>");
	}	
	
$sql = "select first_name,last_name from TUTOR where tenum = ".$tenum;

$tutordata = qry($conn,$sql);

while ($tutor = arr($tutordata))
	{
	$tefirst = $tutor['first_name'];
	$telast = $tutor['last_name'];	
	}	
	
$content = "<h200>Tutor: ".$tefirst." ".$telast."</h200>";

	divmaker(25,0,40,10,"","blue","1","font-size: 150%;text-align: center;position:fixed;" ,"<button type=\"submit\" class= \"labelwhite\" disabled>".$content."</button>");

$content = "Click grey to set availability";

	divmaker(60,0,40,5,"white","blue","1","position:fixed;" ,"<button type=\"submit\" class= \"labelwhite\" disabled><h150><center>".$content."</center></h150></button>");	
	
$content = "blue to delete availablity";
	
	divmaker(60,5,40,5,"white","blue","1","position:fixed;" ,"<button type=\"submit\" class= \"labelwhite\" disabled><h150><center>".$content."</center></h150></button>");		
	
	
	
	
$User_type = SESSINFO($conn,'User_type');
	
if ($User_type == 1)
{
echo "<FORM METHOD=\"POST\" ACTION=\"menu.php\">";

$content = "<button type=\"submit\" class=\"menu-button\" >Main Menu</button>";


divmaker(0,0,20,10,"white","blue","1","position:fixed;" 
,$content);

echo "</FORM>";
}
else
{
echo "<FORM METHOD=\"POST\" ACTION=\"admin.php\">";

$content = "<button type=\"submit\" class=\"menu-button\" >Admin Menu</button>";


divmaker(0,0,20,10,"white","blue","1","position:fixed;" 
,$content);

echo "</FORM>";

}
?>