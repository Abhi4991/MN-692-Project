<?php

include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

writehead("Test XML",$conn,"testxml",0);

set_time_limit(200);

echo "<FORM METHOD=\"POST\" ACTION=\"admin.php\">";


$content = "<button type=\"submit\"class=\"menu-button\">Admin Menu</button>";

divmaker(0,0,19,10,"white","blue","1","",$content);
	
echo "</FORM>";	
echo  "<br>". "<br>". "<br>". "<br>";
echo  "<br>". "<br>". "<br>". "<br>";


	$filename = sessinfo($conn,"uploadfile");

	$filename = substr($filename,0,strlen($filename)-4);
			
	$filename = $filename.".sql";

//	echo $xmlnumber." ".$filename."<BR>";
	
$file = fopen($filename,"w");


$xmlqry = "CREATE TABLE element (level tinyint(4),parent varchar(100),ename   varchar(30),evalue varchar(500),att1 varchar(100),atv1 varchar(100),att2 varchar(100),atv2 varchar(100),att3 varchar(100),atv3 varchar(100),att4 varchar(100),atv4 varchar(100));";

fwrite($file,$xmlqry);



$sql = "select * from elements";

	$elementsdata = qry($conn,$sql);

		while ($elements = arr($elementsdata))
		{
     $xmlqry = "insert into element (level,parent,ename,evalue,att1,atv1,att2,atv2,att3,atv3,att4,atv4) values ("; 
		
		$xmlqry = $xmlqry . $elements['level'].",'".$elements['parent']."','".$elements['ename']."','".$elements['evalue']."','".$elements['att1']."','".$elements['atv1']."','".$elements['att2']."','".$elements['atv2']."','".$elements['att3']."','".$elements['atv4']."','".$elements['att4']."','".$elements['atv4']."');";
				fwrite($file,$xmlqry);
		}
		
	fclose($file);
$content = "<h200><a href=".$filename.">Link to get sql</a></h200>";

divmaker(30,30,40,10,"white","blue","1","",$content);
	
?>
