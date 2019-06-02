<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

writehead("MANAGE TUTORS",$conn,"mantutors",0);

$addtutor = sessinfo($conn,'addtutor');

echo $addtutor;

if ($addtutor == 1)
{
echo "<FORM METHOD=\"POST\" ACTION=\"admin.php\">";

$content = "<button type=\"submit\" class=\"menu-button\">Back to Admin</button>";

	divmaker(0,0,19,19,"white","blue","1",""  
,$content);

echo "</FORM>";	
	
echo "<FORM METHOD=\"POST\" ACTION=\"tutoradd1.php\">";

$content = "<button type=\"submit\" class=\"menu-button\">Add Tutor</button>";

	divmaker(80,0,19,19,"white","blue","1",""  
,$content);

echo "</FORM>";
	
	
echo "<FORM METHOD=\"POST\" ACTION=\"tutormod1.php\">";
$tenum = SESSINFO($conn,"tenum");
}

if ($addtutor == 2)
{
echo "<FORM METHOD=\"POST\" ACTION=\"addgrouptutor.php\">";

$groupnum = $_POST['groupnum'];

echo "<input type=\"hidden\" name=\"groupnum\" value= \"".$groupnum."\" />";

}

if ($addtutor == 3)
{
echo "<FORM METHOD=\"POST\" ACTION=\"addgroupbookingtutor.php\">";

$groupbookingnum = $_POST['groupbookingnum'];

echo "<input type=\"hidden\" name=\"groupbookingnum\" value= \"".$groupbookingnum."\" />";

}

if ($addtutor == 4)
{
echo "<FORM METHOD=\"POST\" ACTION=\"changetutor.php\">";

/*$groupbookingnum = $_POST['groupbookingnum'];

echo "<input type=\"hidden\" name=\"groupbookingnum\" value= \"".$groupbookingnum."\" />";
*/
}


$sql = "SELECT * FROM TUTOR order by last_name,first_name";

$tutor = qry($conn,$sql);

$x = 0;
$y = 0;

while ($tu_array = arr($tutor))

{

$content = "<button type=\"submit\" class = \"menu-button\" value = \" ".$tu_array['tenum']."\" name = \"sel\" >";
	
$content = $content ."<h150>". 	$tu_array['first_name']." ".$tu_array['last_name']."</h150></button>";

if ($x == 2)
{$x=0;$y++;}


divmaker(10+$x*35,30+$y*10,30,8,"white","blue","1","
text-align: center;" 
,$content);

$x = $x + 1;

}	


echo "</FORM>\n";


if ($addtutor == 2)

{
echo "<FORM METHOD=\"POST\" ACTION=\"modgroup.php\">";

$content = "<button type=\"submit\" class=\"menu-button\" >Back to Group</button>";


divmaker(0,0,19,19,"white","blue","1","
text-align: center;" 
,$content);

echo "</FORM>\n";
}

if ($addtutor == 3)
{

echo "<FORM METHOD=\"POST\" ACTION=\"groupbookingaction.php\">";

$content = "<button type=\"submit\" class=\"menu-button\" >Back to Group Booking</button>";


divmaker(0,0,19,19,"white","blue","1","
text-align: center;" 
,$content);

echo "</FORM>\n";

}

if ($addtutor == 4)
{

echo "<FORM METHOD=\"POST\" ACTION=\"timetable.php\">";

$content = "<button type=\"submit\" class=\"menu-button\" >Back to Timetable</button>";


divmaker(0,0,19,10,"white","blue","1","
text-align: center;" 
,$content);

echo "</FORM>\n";

}



echo "</body>\n
</html>";
?>