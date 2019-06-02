<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";
include "ttstuff.php";

writehead("TIME TABLE",$conn,"timebook",0);



echo "<FORM METHOD=\"POST\" ACTION=\"addlesson1.php\">";

$coursenum = $_POST['sel'];
	
$tenum = SESSINFO($conn,"tenum");
$sessnum = SESSINFO($conn,"SESS");
$term = SESSINFO($conn,"term");
$week = SESSINFO($conn,"week");
$firstday = SESSINFO($conn,"firstday");
$lastday = SESSINFO($conn,"lastday");

$sql = "select * from DAYS where termnum = ".$term." and weeknum = ".$week." order by daynum";

$daysdata = qry($conn,$sql);

while ($days = arr($daysdata))
{
	$daydate[$days['dayofweek']-1] = substr($days['thedate'],0,5);
	$daynum[$days['dayofweek']-1] = $days['daynum'];
}

echo "<input type =\"hidden\" name = \"corsel\" value = \"".$coursenum."\">";

$startblock = 85;

drawtrellis($conn,$term,$week,1,$tenum,$sessnum,$startblock,$firstday,$lastday,$daynum);

coursebooking($conn,$sessnum,$firstday,$lastday,$coursenum,$daynum,$startblock,$term,$week);

divmaker(80,0,20,10,"","blue","1","font-size: 150%;text-align: center;position:fixed;" ,"<button type=\"submit\" class= \"labelwhite\" disabled></button>");

echo "</FORM>\n";	
	
echo "<FORM METHOD=\"POST\" ACTION=\"selection.php\">";

divmaker(0,0,20,10,"white","blue","1","text-align: center;position:fixed;","<button type=\"submit\" class = \"menu-button smallfont\">Back to Book Lessons</button>");

echo "</FORM>\n";
		
echo "</body>\n
</html>";
?>