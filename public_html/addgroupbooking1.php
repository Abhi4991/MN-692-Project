<?php
include 'opendb.php';
include 'rollgen.php';
include 'dbstuff.php';

writehead("ADD GROUP BOOKING",$conn,"addgroupbooking",0);

echo "<FORM METHOD=\"POST\" ACTION=\"addgroupbooking2.php\">";

$lookup = $_POST['ttime'];

$groupnum = $_POST['groupnum'];

$tenum = SESSINFO($conn,"tenum");

$sessnum = SESSINFO($conn,"SESS");

$sql = "select * from wTTAB where SESS = '".$sessnum."' and lookup = ".$lookup;

$lessinfo = qry($conn,$sql);

while ($lessinfo_array = arr($lessinfo))
{
	$daynum = $lessinfo_array['daynum'];
	$blocknum = $lessinfo_array['blocknum'];
	$timenum = $lessinfo_array['timenum'];
}

$sql = "select * from GROUPS where groupnum = ".$groupnum;

$content = "<button type=\"submit\" class= \"label\" disabled>"."<h200>".daydate($conn,$daynum)."</h200></button>";

divmaker(45,5,20,5,"white","blue","1","
text-align: center;",$content);

$groupdata = qry($conn,$sql);

$groups = arr($groupdata);
	
	$description = $groups['description'];

echo "<input type=\"hidden\" name=\"groupnum\" value=\"".$groupnum."\">";

echo "<input type=\"hidden\" name=\"daynum\" value=\"".$daynum."\">";

echo "<input type=\"hidden\" name=\"lookup\" value=\"".$lookup."\">";

$disptime = 540+($blocknum)+($timenum)." minutes";

$content = "<button type=\"submit\" class= \"label\" disabled><h200>Group:</h200></button>";

divmaker(10,20,35,5,"white","blue","1","",$content);

$content = "<button type=\"submit\" class= \"label\" disabled><h200>".$description."</h200></button>";

divmaker(30,20,25,5,"white","blue","1","",$content);

$content = "<button type=\"submit\" class= \"label\" disabled><h200>Start Time:</h200></button>";

divmaker(10,40,15,5,"white","blue","1","",$content);

$content = timesel($conn,($blocknum+$timenum));

divmaker(30,40,15,10,"white","blue","1","",$content);

$content = "<button type=\"submit\" class= \"label\" disabled><h200>Finish Time:</h200></button>";

divmaker(10,60,15,5,"white","blue","1","",$content);

$content = hoursel($conn,($blocknum));

divmaker(30,60,10,10,"white","blue","1","class= \"label\"",$content);

$content = minutesel();

divmaker(35,60,10,10,"white","blue","1","class= \"label\"",$content);

$content = "<button type=\"submit\" class= \"label\" disabled><h200>Repeat:</h200></button>";

divmaker(60,20,20,5,"white","blue","1","",$content);

$checkr = array("","");

$checkr[0] = "checked";

echo "<section id=\"accordion\">";

$content =  "<input type=\"radio\" name=\"repeat\" value=\"0\" id=\"repeat-1\" ".$checkr[0]."/><label for=\"repeat-1\"><h200>No</h200></label>";

divmaker(70,20,5,10,"white","blue","1","
text-align: left;" 
,$content);

$content =  "<input type=\"radio\" name=\"repeat\" value=\"1\" id=\"repeat-2\" ".$checkr[1]."/><label for=\"repeat-2\"><h200>Yes</h200></label>";

divmaker(80,20,5,10,"white","blue","1","
text-align: left;" 
,$content);

echo "</section>";

$content = "<button type=\"submit\" class= \"label\" disabled><h200>Number of Sessions:</h200></button>";

divmaker(60,40,25,5,"white","blue","1","",$content);

  $numbers = array(1,2,3,4,5,6,7,8,9,11,12,13,14,15,16);
divmaker(80,40,7,10,"","","","",numsel("timesel-button","numles",$numbers,1,0));

$content = "<button type=\"submit\" class= \"label\" disabled><h200>Interval:</h200></button>";

divmaker(60,60,15,5,"white","blue","1","",$content);

$checki = array("","");

$checki[0] = "checked";

echo "<section id=\"accordion\">";

$content =  "<input type=\"radio\" name=\"interval\" value=\"0\" id=\"interval-1\" ".$checki[0]."/><label for=\"interval-1\"><h200>Weekly</h200></label>";

divmaker(70,60,10,5,"white","blue","1","
text-align: left;" 
,$content);

$content =  "<input type=\"radio\" name=\"interval\" value=\"1\" id=\"interval-2\" ".$checki[1]."/><label for=\"interval-2\"><h200>Fortnightly</h200></label>";

divmaker(85,60,10,5,"white","blue","1","
text-align: left;" 
,$content);

echo "</section>";

$content = "<button type=\"submit\" class=\"menu-button\" >Add Session</button>";

divmaker(40,80,15,10,"white","blue","1","",$content);

echo "</FORM>";

echo "<FORM METHOD=\"POST\" ACTION=\"bookgroup.php\">";

divmaker(0,0,25,10,"white","blue","1","
text-align: center;" 
,"<button type=\"submit\" class=\"menu-button\" >Back to Groups</button>");

echo "</FORM>";

echo "</body>
</html>";

?>
