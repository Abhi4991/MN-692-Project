<?php
include 'opendb.php';
include 'rollgen.php';
include 'dbstuff.php';

writehead("ADD LESSON",$conn,"addlesson",0);

echo "<FORM METHOD=\"POST\" ACTION=\"addlessonchk.php\">";

$lookup = $_POST['ttime'];

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

$sql = "select * from COURSE where coursenum = ".$_POST['corsel'];

$content = "<button type=\"submit\" class= \"label\" disabled>"."<h200>".daydate($conn,$daynum)."</h200></button>";

divmaker(45,5,20,5,"white","blue","1","
text-align: center;",$content);

$cor = qry($conn,$sql);

while ($cor_array = arr($cor))
{
	$coursedesc = $cor_array['description'];
	$length = $cor_array['length'];
}
	
echo "<input type=\"hidden\" name=\"corsel\" value=\"".$_POST['corsel']."\">";

echo "<input type=\"hidden\" name=\"lesdesc\" value=\"".$coursedesc."\">";

echo "<input type=\"hidden\" name=\"daynum\" value=\"".$daynum."\">";

echo "<input type=\"hidden\" name=\"lookup\" value=\"".$lookup."\">";

$disptime = 540+($blocknum)+($timenum)." minutes";

$content = "<button type=\"submit\" class= \"label\" disabled><h200>Course:</h200></button>";

divmaker(10,20,35,5,"white","blue","1","",$content);

$content = "<button type=\"submit\" class= \"label\" disabled><h200>".$coursedesc."</h200></button>";

divmaker(30,20,25,5,"white","blue","1","",$content);

$content = "<button type=\"submit\" class = \"label\" disabled><h200>Time:</h200></button>";

divmaker(10,35,15,10,"white","blue","1","",$content);


$content = timesel($conn,($blocknum+$timenum));

divmaker(30,37,15,10,"white","blue","1","",$content);

$content = "<button type=\"submit\" class= \"label\" disabled><h200>Duration:</h200></button>";

divmaker(10,50,15,10,"white","blue","1","",$content);

$numbers = lessonlength($conn);

$arrlength = count($numbers);

$standardlength = $length/5;

$content = "<h200><select name=\"lessonlength\" class = \"timesel-button\" >\n";

$content = $content . "<option value=\"".$standardlength."\">".$length." Minutes</option>/n";



	for($x = 0; $x < $arrlength; $x++)
	{
		$content = $content . "<option value=\"".(intval($numbers[$x])/5)."\">".$numbers[$x]." Minutes</option>/n";
	}


/*$content = $content . "<option value=\"".(intval($numbers[0])/5)."\">".$numbers[0]." Minutes</option>/n";
$content = $content . "<option value=\"".(intval($numbers[1])/5)."\">".$numbers[1]." Minutes</option>/n";
$content = $content . "<option value=\"".(intval($numbers[2])/5)."\">".$numbers[2]." Minutes</option>/n";
*/
$content = $content . "</select></h200>\n";

divmaker(30,52,15,10,"white","blue","1","",$content);

$content = "<button type=\"submit\" class= \"label\" disabled><h200>Repeat:</h200></button>";

divmaker(60,20,20,5,"white","blue","1","",$content);

$checkr = array("","");

$checkr[0] = "checked";

echo "<section id=\"accordion\">";

$content =  "<input type=\"radio\" name=\"repeat\" value=\"0\" id=\"repeat-1\" ".$checkr[0]." class = \"mediummenu-button\" /><label for=\"repeat-1\"><h200>No</h200></label>";

divmaker(70,20,5,10,"white","blue","1","" 
,$content);

$content =  "<input type=\"radio\" name=\"repeat\" value=\"1\" id=\"repeat-2\" ".$checkr[1]."/><label for=\"repeat-2\"><h200>Yes</h200></label>";

divmaker(80,20,5,10,"white","blue","1","
text-align: left;" 
,$content);

echo "</section>";

$content = "<button type=\"submit\" class= \"label\" disabled><h200>Number of Lessons:</h200></button>";

divmaker(60,35,25,10,"white","blue","1","",$content);

  $numbers = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16);
//    divmaker(80,40,7,10,"","","","","<button type=\"submit\" class= \"menu-button\" disabled>".numsel("label","numles",$numbers,1,0)."</button>");

divmaker(80,37,20,10,"","","","",numsel("timesel-button","numles",$numbers,1,0));


$content = "<button type=\"submit\" class= \"label\" disabled><h200>Interval:</h200></button>";

divmaker(60,50,15,10,"white","blue","1","",$content);

$checki = array("","");

$checki[0] = "checked";

echo "<section id=\"accordion\">";

$content =  "<input type=\"radio\" name=\"interval\" value=\"0\" id=\"interval-1\" ".$checki[0]."/><label for=\"interval-1\"><h200>Weekly</h200></label>";

divmaker(70,52,12,10,"white","blue","1","
text-align: left;" 
,$content);

$content =  "<input type=\"radio\" name=\"interval\" value=\"1\" id=\"interval-2\" ".$checki[1]."/><label for=\"interval-2\"><h200>Fortnightly</h200></label>";

divmaker(85,52,12,10,"white","blue","1","
text-align: left;" 
,$content);

echo "</section>";


$content = "<button type=\"submit\" class=\"menu-button\" ><h200>Add Lesson</h200></button>";

divmaker(40,80,15,10,"white","blue","1","",$content);

echo "</FORM>";



echo "<FORM METHOD=\"POST\" ACTION=\"selection.php\">";

divmaker(0,0,25,10,"white","blue","1","
text-align: center;" 
,"<button type=\"submit\" class=\"menu-button\" ><h200>Back to Courses</h200></button>");

echo "</FORM>";

echo "</body>
</html>";

?>
