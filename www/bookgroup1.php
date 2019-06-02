<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";
include "ttstuff.php";

writehead("TIME TABLE",$conn,"bookgroup1",0);

$groupnum = filter_input(INPUT_POST, 'sel', FILTER_DEFAULT);

echo "<FORM METHOD=\"POST\" ACTION=\"addgroupbooking1.php\">";
	
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

echo "<input type =\"hidden\" name = \"groupnum\" value = \"".$groupnum."\">";

$startblock = 85;

drawtrellis($conn,$term,$week,1,$tenum,$sessnum,$startblock,$firstday,$lastday,$daynum);

groupbooking($conn,$sessnum,$firstday,$lastday,$groupnum,$daynum,$startblock,$term,$week);

divmaker(80,0,20,10,"","blue","1","font-size: 150%;text-align: center;position:fixed;" ,"<button type=\"submit\" class= \"labelwhite\" disabled></button>");

echo "</FORM>\n";	
	
echo "<FORM METHOD=\"POST\" ACTION=\"bookgroup.php\">";

divmaker(0,0,15,10,"white","blue","1","position:fixed;","<button type=\"submit\" class=\"menu-button\" ><h200>Back to Groups</h200></button>");

echo "</FORM>\n";
		
echo "</body>\n
</html>";
?>