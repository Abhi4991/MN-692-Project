<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

writehead("UPDATE COURSE",$conn,"update course",0);

$sql = "select * from COURSELIST";

$courselistdata = qry($conn,$sql);

while ($courselist = arr($courselistdata))
{
	$sql = "select * from STLIST where stnum = ".$courselist['stnum'];
	
	$stlistdata = qry($conn,$sql);
		
	while ($stlist = arr($stlistdata))
	{
		
		$sql = "select clnum from STCLASS where stnum = ".$stlist['stnum']. " and clnum = ".$stlist['clnum'];

		$stcl = qry($conn,$sql);
					
		$num_rows = mysqli_num_rows($stcl);
  
		if ($num_rows == 0)	
		{
				
			$sqlins = "insert into STCLASS (stnum,clnum,clavail) values (";

			$sqlins.= $stlist['stnum']. ",";
			$sqlins.= $stlist['clnum']. ",";
			$sqlins.= "9)";
			
			qry($conn,$sqlins);
		}
		
	}

}
	
echo "<FORM METHOD=\"POST\" ACTION=\"admin.php\">";

$content = "<button type=\"submit\">Admin Menu</button>";


divmaker(0,0,20,10,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);

echo "</FORM>";

?>