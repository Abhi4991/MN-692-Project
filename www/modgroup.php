<?php
include 'opendb.php';
include 'rollgen.php';
include "dbstuff.php";
include "writegroup.php";

error_reporting(-1);
ini_set('display_errors', 'On');

writehead("MOD GROUP",$conn,"modgroup",0);

sessupdate($conn,'addstudent',2);
sessupdate($conn,'addtutor',2);


if (empty ($_POST['selgroup']) == True)
{
	$groupnum = sessinfo($conn,"tempnum");
}
else
{
	$groupnum = $_POST['selgroup'];
}

sessupdate($conn,"tempnum",$groupnum);

$sql = "select * from GROUPS where groupnum = ".$groupnum;

$groupsdata = qry($conn,$sql);

$groups = arr($groupsdata);

$description = $groups['description'];
 
divmaker(45,0,40,10,"","","","
text-align: left;","<button type=\"submit\" class= \"label\" disabled><h200>Modify Group</h200></button>");

echo "<FORM METHOD=\"POST\" ACTION=\"modgroupdescription.php\">";

echo "<input type=\"hidden\" name=\"groupnum\" value= \"".$groups['groupnum']."\" />";

divmaker(10,10,15,10,"","","","","<button type=\"submit\" class= \"label\" disabled><h200>Description:</h200></button>");

$content = "<button type=\"submit\" class= \"label\" disabled><INPUT TYPE=\"text\" NAME=\"description\"  class= \"label\" value = \"".$description."\" ></button>";

divmaker(25,10,40,10,"","","","",$content);

$content = "<button type=\"submit\" class=\"menu-button\"><h200>Save</h200></button>";

divmaker(90,10,10,10,"white","blue","1","",$content);

echo "</FORM>";

echo "<FORM METHOD=\"POST\" ACTION=\"delgroup1.php\">";

echo "<input type=\"hidden\" name=\"groupnum\" value= \"".$groups['groupnum']."\" />";

divmaker(85,0,15,10,"white","blue","1","
text-align: center;" 
,"<button type=\"submit\" class=\"menu-button\"><h200>Delete Group</h200></button>");

echo "</FORM>";	

echo "<FORM METHOD=\"POST\" ACTION=\"tutors.php\">";

echo "<input type=\"hidden\" name=\"groupnum\" value= \"".$groups['groupnum']."\" />";

divmaker(80,20,10,5,"white","blue","1","
text-align: center;" 
,"<button type=\"submit\" class=\"smallmenu-button blue\">Add Tutor</button>");

echo "<input type=\"hidden\" name=\"camefrom\" value= \"2\" />";

echo "</FORM>";


divmaker(60,20,15,5,"","","","","<button type=\"submit\" class= \"label\" disabled><h200>Tutors:</h200></button>");

$screenline = 0;

$sql = "select * from GROUPTUTORS gt inner join TUTOR tu on gt.tenum = tu.tenum where groupnum = ".$groupnum." order by last_name,first_name";

$grouptutorsdata = qry($conn,$sql);

while ($grouptutors = arr($grouptutorsdata))
{
	
echo "<FORM METHOD=\"POST\" ACTION=\"delgrouptutor.php\">";

echo "<input type=\"hidden\" name=\"grouptutor\" value= \"".$grouptutors['tenum']."\" />";

divmaker(60,30+$screenline,40,5,"","","","","<button type=\"submit\" class= \"label\" disabled><h200>".$grouptutors['first_name']." ".$grouptutors['last_name']."</h200></button>");
	
echo "<input type=\"hidden\" name=\"groupnum\" value= \"".$groups['groupnum']."\" />";

divmaker(80,30+$screenline,5,5,"white","blue","1","
text-align: center;" 
,"<button type=\"submit\" class=\"smallmenu-button blue\">Delete</button>");

echo "</FORM>";	
	
$screenline = $screenline + 5;	
	
}

echo "<FORM METHOD=\"POST\" ACTION=\"addstudent1.php\">";

echo "<input type=\"hidden\" name=\"groupnum\" value= \"".$groups['groupnum']."\" />";

divmaker(45,20,10,5,"white","blue","1","
text-align: center;" 
,"<button type=\"submit\" class=\"smallmenu-button blue\">Add Student</button>");

echo "</FORM>";

$screenline = 0;

divmaker(5,20,15,5,"","","","","<button type=\"submit\" class= \"label\" disabled><h200>Students:</h200></button>");

$sql = "select * from GROUPSTUDENTS gs inner join STUDENTS st on gs.stnum = st.stnum where groupnum = ".$groupnum." order by st_last,st_first";

$groupstudentsdata = qry($conn,$sql);

while ($groupstudents = arr($groupstudentsdata))
{
	
	$stnum = $groupstudents['stnum'];

echo "<FORM METHOD=\"POST\" ACTION=\"delgroupstudent.php\">";

echo "<input type=\"hidden\" name=\"stnum\" value= \"".$stnum."\" />";
echo "<input type=\"hidden\" name=\"groupnum\" value= \"".$groups['groupnum']."\" />";
divmaker(5,30+$screenline,45,5,"","","","font-size: 150%;
text-align: left;","<button type=\"submit\" class= \"label\" disabled><h200>".$groupstudents['st_first']." ".$groupstudents['st_last']."</h200></button>");


divmaker(45,30+$screenline,5,5,"white","blue","1","
text-align: center;" 
,"<button type=\"submit\" class=\"smallmenu-button blue\">Delete</button>");

echo "</FORM>";	
	
$screenline = $screenline + 5;	
	
}

	

echo "<FORM METHOD=\"POST\" ACTION=\"groups.php\">";

divmaker(0,0,10,10,"white","blue","1","
text-align: center;" 
,"<button type=\"submit\" class=\"menu-button\"><h200>Back</h200></button>");

echo "</FORM>";

echo "</body></html>";

?>
