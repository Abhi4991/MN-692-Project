<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

writehead("SELECTGROUP",$conn,"selectgroup",0);

$tenum = SESSINFO($conn,"tenum");

//$sql = "SELECT * FROM GROUPS GR INNER JOIN GROUPTUTORS AS GT ON GR.groupnum = GT.groupnum";
// where GT.tenum = ".$tenum;
$sql = "SELECT * FROM GROUPS ";
$sql .=  " order by description";

$grgtdata = qry($conn,$sql);

echo "<FORM METHOD=\"POST\" ACTION=\"modgroup.php\">";

$x = 1;

while ($grgt = arr($grgtdata))

{

	$content = "<button type=\"submit\" class=\"menu-button\" value = \"".$grgt['groupnum']."\" name = \"selgroup\" >";
		
	$content = $content ."<h150>".$grgt['description']."</h150></button>";

	divmaker(0,$x*10+5,25,10,"white","blue","1",""
	,$content);
	$x++;
}	

echo "</FORM>\n";

echo "<FORM METHOD=\"POST\" ACTION=\"groups.php\">";

		divmaker(0,0,20,10,"white","blue","1","" 
,"<button type=\"submit\" class=\"menu-button\" ><h200>Back to Group Menu</h200></button>");

echo "</FORM>\n";

echo "</body>\n
</html>";
?>