<?php
include 'opendb.php';
include 'rollgen.php';
include "dbstuff.php";
include "writegroup.php";

error_reporting(-1);
ini_set('display_errors', 'On');

writehead("GROUP BOOKING ACTION",$conn,"groupbookingaction",0);

$sessnum = SESSINFO($conn,"SESS");

if (empty ($_POST['sel']) == True)
{
	$groupbookingnum = sessinfo($conn,"tempnum");
}
else
{
	$groupbookingnum = $_POST['sel'];
}

sessupdate($conn,"tempnum",$groupbookingnum);

$sql = "select * from wTTAB where groupbookingnum = ".$groupbookingnum." and SESS = '".$sessnum."'";

$wttabdata = qry($conn,$sql);

$wttab = arr($wttabdata);

$groupnum = $wttab['groupnum'];

$daynum = $wttab['daynum'];


$blocknum = $wttab['blocknum'];

$sql = "select * from GROUPS where groupnum = ".$groupnum;

$groupsdata = qry($conn,$sql);

$groups = arr($groupsdata);

$description = $groups['description'];

$sql = "select * from TRELLIS where groupbookingnum = ".$groupbookingnum;

$trellisdata = qry($conn,$sql);

$trellis = arr($trellisdata);

$fixed =  $trellis['fixed'];

$bookingdate = daydate($conn,$trellis['daynum']);
$bookingtime = daytime($conn,$trellis['block']);
$bookingend = daytime($conn,$trellis['block']+$trellis['lesson_length']);
$description = $description;

$content = "<button type=\"submit\" class= \"label\" disabled><h250>".$description."</h250></button>";

divmaker(35,0,50,10,"","","","",$content);

$content = "<button type=\"submit\" class= \"label\" disabled><h200>".$bookingdate." ".$bookingtime."-".$bookingend."</h200></button>";
divmaker(35,10,50,10,"","","","",$content);

echo "<FORM METHOD=\"POST\" ACTION=\"delgroupbooking1.php\">";

echo "<input type=\"hidden\" name=\"groupbookingnum\" value= \"".$groupbookingnum."\" />";

divmaker(75,0,25,10,"white","blue","1","
text-align: center;" 
,"<button type=\"submit\" class=\"menu-button\"><h200>Delete Group Booking</h200></button>");

echo "</FORM>";	

divmaker(60,20,15,5,"","","","font-size: 150%;
text-align: left;","<button type=\"submit\" class= \"label\" disabled><h200>Tutors:</h200></button>");

echo "<FORM METHOD=\"POST\" ACTION=\"tutors.php\">";

echo "<input type=\"hidden\" name=\"groupbookingnum\" value= \"".$groupbookingnum."\" />";

divmaker(80,20,15,5,"white","blue","1","
text-align: center;" 
,"<button type=\"submit\" class=\"smallmenu-button blue\">Add Tutor to booking</button>");

sessupdate($conn,'addtutor',3);

echo "</FORM>";

$screenline = 0;

$sql = "select * from GROUPBOOKINGTUTORS gbt inner join TUTOR tu on gbt.tenum = tu.tenum where groupbookingnum = ".$groupbookingnum." order by last_name,first_name";

$groupbookingtutorsdata = qry($conn,$sql);

while ($groupbookingtutors = arr($groupbookingtutorsdata))
{
	
$tenum = $groupbookingtutors['tenum'];

echo "<FORM METHOD=\"POST\" ACTION=\"delgroupbookingtutor.php\">";

echo "<input type=\"hidden\" name=\"groupbookingtutor\" value= \"".$tenum."\" />";

divmaker(60,30+$screenline,35,5,"","","","","<button type=\"submit\" class= \"label\" disabled><h150>".$groupbookingtutors['first_name']." ".$groupbookingtutors['last_name']."</h150></button>");
	
echo "<input type=\"hidden\" name=\"groupbookingnum\" value= \"".$groupbookingnum."\" />";

divmaker(80,30+$screenline,5,5,"white","blue","1","","<button type=\"submit\" class=\"smallmenu-button blue\">Delete</button>");

echo "</FORM>";	
	
$screenline = $screenline + 5;	
	
}

$screenline = 0;

divmaker(5,20,15,5,"","","","","<button type=\"submit\" class= \"label\" disabled><h200>Students:</h200></button>");

echo "<FORM METHOD=\"POST\" ACTION=\"addstudent1.php\">";
echo "<input type=\"hidden\" name=\"groupbookingnum\" value= \"".$groupbookingnum."\" />";
divmaker(35,20,15,5,"white","blue","1","
text-align: center;" 
,"<button type=\"submit\" class=\"smallmenu-button blue\">Add Student to booking</button>");

sessupdate($conn,'addstudent',3);

echo "</FORM>";	

$sql = "select * from GROUPBOOKINGSTUDENTS gbs inner join STUDENTS st on gbs.stnum = st.stnum where groupbookingnum = ".$groupbookingnum." order by st_last,st_first";

$groupbookingstudentsdata = qry($conn,$sql);

while ($groupbookingstudents = arr($groupbookingstudentsdata))
{
	
	$stnum = $groupbookingstudents['stnum'];

echo "<FORM METHOD=\"POST\" ACTION=\"delgroupbookingstudent.php\">";

echo "<input type=\"hidden\" name=\"stnum\" value= \"".$stnum."\" />";
echo "<input type=\"hidden\" name=\"groupbookingnum\" value= \"".$groupbookingnum."\" />";

divmaker(5,30+$screenline,45,5,"","","","","<button type=\"submit\" class= \"label\" disabled><h150>".$groupbookingstudents['st_first']." ".$groupbookingstudents['st_last']."</h150></button>");


divmaker(45,30+$screenline,5,5,"","","1","","<button type=\"submit\" class=\"smallmenu-button blue\">Delete</button>");


echo "</FORM>";	

echo "<FORM METHOD=\"POST\" ACTION=\"presentgroupbookingstudent.php\">";

echo "<input type=\"hidden\" name=\"stnum\" value= \"".$stnum."\" />";
echo "<input type=\"hidden\" name=\"groupbookingnum\" value= \"".$groupbookingnum."\" />";

if ($groupbookingstudents['attendance'] == 1)
{$attend = "Present"; $bcol = "blue";}else{$attend = "Absent";$bcol = "red";}	

divmaker(35,30+$screenline,8,5,"white","","1","","<button type=\"submit\" class=\"smallmenu-button ".$bcol."\">".$attend."</button>");

echo "</FORM>";	
	
$screenline = $screenline + 5;	

}

echo "<FORM METHOD=\"POST\" ACTION=\"timetable.php\">";

divmaker(0,0,20,10,"white","blue","1","
text-align: center;" 
,"<button type=\"submit\" class=\"menu-button\"><h200>Time Table</h200></button>");

echo "</FORM>";

echo "</body></html>";

?>
