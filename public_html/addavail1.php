<?php
include 'opendb.php';
include 'rollgen.php';
include 'dbstuff.php';

writehead("ADD AVAILABILITY",$conn,"addavail1",0);

echo "<FORM METHOD=\"POST\" ACTION=\"addavail2.php\">";

$lookup = $_POST['ttime'];

$tenum = $_POST['tenum'];

$sessnum = SESSINFO($conn,"SESS");

$sql = "select * from wTTAB where SESS = '".$sessnum."' and lookup = ".$lookup;

$wTTABdata = qry($conn,$sql);

while ($wTTAB = arr($wTTABdata))
{
	$daynum = $wTTAB['daynum'];
	$blocknum = $wTTAB['blocknum'];
	$timenum = $wTTAB['timenum'];
}

echo "<input type =\"hidden\" name = \"tenum\" value = \"".$tenum."\">";
echo "<input type =\"hidden\" name = \"daynum\" value = \"".$daynum."\">";	
	
$content = "<button type=\"submit\" class= \"label\" disabled><h300>Add Availability</h300></button>";

divmaker(40,10,25,10,"white","blue","1","",$content);

$content = "<button type=\"submit\" class= \"label\" disabled><h200>Start Time:</h200></button>";

divmaker(20,30,15,10,"white","blue","1","",$content);

$content = timesel($conn,($blocknum+$timenum));

divmaker(40,30,10,10,"white","blue","1","",$content);

$content = "<button type=\"submit\" class= \"label\" disabled><h200>Finish Time:</h200></button>";

divmaker(20,50,15,10,"white","blue","1","",$content);

$content = hoursel($conn,($blocknum));

divmaker(40,50,15,10,"white","blue","1","class= \"label\"",$content);

$content = minutesel();

divmaker(45,50,5,10,"white","blue","1","class= \"label\"",$content);

$content = "<button type=\"submit\" class=\"menu-button\" ><h200>Add Availability</h200></button>";

divmaker(40,80,15,10,"white","blue","1","",$content);

echo "</FORM>";

echo "<FORM METHOD=\"POST\" ACTION=\"admin.php\">";

divmaker(0,0,25,15,"white","blue","1","
text-align: center;" 
,"<button type=\"submit\" class=\"menu-button\" ><h200>Back to Admin</h200></button>");

echo "</FORM>";

echo "</body>
</html>";
?>
