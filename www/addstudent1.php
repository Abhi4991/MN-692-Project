<?php
include 'opendb.php';
include 'rollgen.php';
include "dbstuff.php";

writehead("SELECT STUDENT",$conn,"addstudent",0);

echo "<FORM METHOD=\"POST\" ACTION=\"addstudent2.php\">";

divmaker(40,0,60,12,"white","blue","1","","<button type=\"submit\" class= \"label\" disabled><h250>Click first letter of last name</h250></button>");

$x = 65;

for ($row =0; $row <= 3; $row++)
{
	for($col = 0; $col <= 6; $col++)
	{
		$content = "<button type=\"submit\" class=\"menu-button\" value = \"".chr($x)."\" name = \"sel\" >";

		$content = $content . chr($x)."</button>";

		divmaker(0 + $col*14,14+$row*14,14,14,"white","blue","1","",$content);

		$x = $x + 1;

		if ($x == 91) 
		{ 
			break ;  
		}
	}
}

echo "</FORM>";

$addstudent = sessinfo($conn,'addstudent');

if ($addstudent == 1)
{
	echo "<FORM METHOD=\"POST\" ACTION=\"students.php\">";

	divmaker(0,0,15,10,"white","blue","1","","<button type=\"submit\" class=\"menu-button\">Back</button>");

	echo "</FORM>";
}

if ($addstudent == 2)
{
	echo "<FORM METHOD=\"POST\" ACTION=\"modgroup.php\">";

	divmaker(0,0,27,10,"white","blue","1","","<button type=\"submit\" class=\"menu-button\">Back to Group</button>");

	echo "</FORM>";
}

if ($addstudent == 3)
{
	echo "<FORM METHOD=\"POST\" ACTION=\"groupbookingaction.php\">";

	divmaker(0,0,27,13,"white","blue","1","","<button type=\"submit\" class=\"menu-button\">Back to Group Booking</button>");

	echo "</FORM>";
}
echo "</body></html>";

?>
