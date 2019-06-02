<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";
include "ttstuff.php";

writehead("TIME TABLE",$conn,"timetable",0);

$coursenum = filter_input(INPUT_POST, 'sel', FILTER_DEFAULT);

$tenum = SESSINFO($conn,"tenum");
$sessnum = SESSINFO($conn,"SESS");
$term = SESSINFO($conn,"term");
$week = SESSINFO($conn,"week");
$firstday = SESSINFO($conn,"firstday");
$lastday = SESSINFO($conn,"lastday");

$sql = "select * from DAYS where termnum = ".$term." and weeknum = ".$week." order by daynum";

$sqltot = "";

$daysdata = qry($conn,$sql);

while ($days = arr($daysdata))
{
	$daydate[$days['dayofweek']-1] = substr($days['thedate'],0,5);
	$daynum[$days['dayofweek']-1] = $days['daynum'];
}

echo "<input type =\"hidden\" name = \"corsel\" value = \"".$coursenum."\">";

$startblock = 85;
$booking = 0;

drawtrellis($conn,$term,$week,$booking,$tenum,$sessnum,$startblock,$firstday,$lastday,$daynum);

$sql = "select first_name,last_name from TUTOR where tenum = $tenum";

$tutordata = qry($conn,$sql);

while ($tutor = arr($tutordata))
{
	$tefirst = $tutor['first_name'];
	$telast = $tutor['last_name'];	
}	
		
$bookdesc = "Tutor: $tefirst $telast Term $term Week $week";

headings($bookdesc,$conn);
updownweek(80,0);	
echo "<FORM METHOD=\"POST\" ACTION=\"menu.php\">";

divmaker(0,0,15,10,"white","blue","1","position:fixed;","<button type=\"submit\" class=\"menu-button\" ><h200>Main Menu</h200></button>");

echo "</FORM>\n";

echo "</body>\n
</html>";
?>