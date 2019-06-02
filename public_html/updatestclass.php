<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

writehead("UPDATE STCLASS",$conn,"update stclass",0);

$sql = "update STCLASS set clused = 0";

qry($conn,$sql);

$sql = "update ROLL set lessonnum = 0";

qry($conn,$sql);


$sql = "select * from TRELLIS where coursenum <> 0";

$trellisdata = qry($conn,$sql);

while ($trellis = arr($trellisdata))
{

	$sql = "select * from COURSELIST where coursenum = ".$trellis['coursenum'];

				$stinfo = qry($conn,$sql);

				$daynum = $trellis['daynum'];
				$blocknum =   $trellis['block'];
				$lessonlength =   $trellis['lesson_length'];
				$lessonnum = $trellis['lessonnum'];

				while ($stinfo_array = arr($stinfo))
					{
						
					$sql = "SELECT * FROM ROLL WHERE stnum = ".$stinfo_array['stnum']." AND daynum = ".$daynum." AND perstart+perlength > ".$blocknum." and perstart < ".($blocknum+$lessonlength);
						
					$rollinfo = qry($conn,$sql);
						
						while ($rollinfo_array = arr($rollinfo))
								
						{
							
							$sqlins = "update STCLASS set clused = clused + 1 where stnum = ".$stinfo_array['stnum']." and clnum = ".$rollinfo_array['clnum'];
								
						//echo $sqlins."<BR>";
						
						qry($conn,$sqlins);
								
						}
						
						$sqlins = "update ROLL set lessonnum = ".$lessonnum." WHERE stnum = ".$stinfo_array['stnum']." AND daynum = ".$daynum." AND perstart+perlength > ".$blocknum." and perstart < ".($blocknum+$lessonlength);
						
						updatesql($sqlins,$conn);
						
						
					}
					
							
					
						
}
					
						
echo "<FORM METHOD=\"POST\" ACTION=\"admin.php\">";

$content = "<button type=\"submit\">Admin Menu</button>";


divmaker(0,0,20,10,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);

echo "</FORM>";

?>