<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

writehead("IMPORT JUNIORTT",$conn,"junior timetable",0);

$sql = "delete from imptt1";

$imptt1data = qry($conn,$sql);

$sql = "select * from imptt";

$impttdata = qry($conn,$sql);

$imprec = 0;

while ($imptt = arr($impttdata))
{
				echo $imprec."<BR>";
	
	if ($imptt['menu'] == 'Contents')
	{
		$imprec = 0;
	}
	
	if ($imprec == 1)
	{
		$formname = $imptt['starttime'];
		
			echo $formname."<BR>";
	}

	if ($imprec > 2)
	{
	
		if($imptt['starttime'] <>'')
		{
			
			for ($i =1;$i<=5;$i++)
			{
				$cldesc = "cldesc".$i;
				if($imptt[$cldesc] <> '')
				{
				$class_code = $formname.substr($imptt[$cldesc],0,3);
				$class_desc = $imptt[$cldesc];
				
				$ttime = $imptt['starttime'];
				
				$sqlup = "insert into imptt1 (class_code,class_desc,ttday,ttime) values ('".$class_code."','".$class_desc."',".$i.",'".$ttime."')";
				
				echo $sqlup."<BR>";
							
				$imp1ttdata = qry($conn,$sqlup);
				}		
			}
		}
	}

$imprec = $imprec + 1;	
	
}

$sql = "update imptt1 set perstart = (select blocknum from times where ";

$imptt1data = qry($conn,$sql);

while ($imptt1 = arr($imptt1data))
{
	
$sql 
	
}


















echo "<FORM METHOD=\"POST\" ACTION=\"admin.php\">";

$content = "<button type=\"submit\">Admin Menu</button>";


divmaker(0,0,20,10,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);

echo "</FORM>";

?>