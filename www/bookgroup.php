<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

writehead("BOOKGROUP",$conn,"bookgroup",0);

updownweek(80,0,False);

$term = SESSINFO($conn,"term");
$week = SESSINFO($conn,"week");
$coursedisp = SESSINFO($conn,"coursedisp");
$tenum = SESSINFO($conn,"tenum");

echo "<FORM METHOD=\"POST\" ACTION=\"coursedisp.php\">";

if ($coursedisp == 0 )
{
	$content = "<button type=\"submit\" class=\"menu-button\" ><h150>Show All Groups</h150></button> ";
}
else
{
	$content = "<button type=\"submit\" class=\"menu-button\" ><h150>Show Unbooked Groups</h150></button> ";
}

divmaker(60,0,20,10,"","","","",$content);

echo "</FORM>";

	divmaker(25,0,35,10,"white","blue","","position: fixed;
" ,"<button type=\"submit\" class= \"labelwhite\" disabled><h200><center>Term ".$term." Week ".$week."</center></h200></button>");

$firstday = SESSINFO($conn,"firstday");

$lastday = SESSINFO($conn,"lastday");

$tenum = SESSINFO($conn,"tenum");

$sql = "SELECT * FROM GROUPS gr inner join GROUPTUTORS gt on gr.groupnum = gt.groupnum where tenum = ".$tenum;

if ($coursedisp == 0)
{	
$sql = $sql . "  and gr.groupnum not in (select groupnum from TRELLIS where daynum >= ".$firstday." and daynum <= ".$lastday.")";
}

$sql = $sql . "  order by description";

$groupsdata = qry($conn,$sql);

echo "<FORM METHOD=\"POST\" ACTION=\"bookgroup1.php\">";

$x = 1;
$y = 0;

while ($groups = arr($groupsdata))
	
{

	$content = "<button type=\"submit\" class=\"menu-button\" value = \"".$groups['groupnum']."\" name = \"sel\" >";
		
	$content = $content ."<h150>".$groups['description']."</h150></button>";

	divmaker(0 + $y,$x*10+5,25,10,"white","blue","1","" 
	,$content);
	
	if ($y < 75 )
	{
		$y = $y + 25;
	}
	else
	{
		$y = 0;
		$x = $x + 1;
	}	

}	

echo "</FORM>\n";

echo "<FORM METHOD=\"POST\" ACTION=\"menu.php\">";

		divmaker(0,0,25,10,"white","blue","1","font-size: 150%;
text-align: center;" 
,"<button type=\"submit\" class=\"menu-button\" ><h200>Main Menu</h200></button>");

echo "</FORM>\n";

echo "</body>\n
</html>";
?>