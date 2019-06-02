<?php
include 'opendb.php';
include 'rollgen.php';
include 'dbstuff.php';

writehead("LESSON ACTION",$conn,"lessonaction",0);

echo "<FORM METHOD=\"POST\" ACTION=\"lessonaction2.php\">";

$lessonnum = $_POST['sel'];

$tenum = sessinfo($conn,'tenum');


$sql = "select * from TRELLIS where tenum = ".$tenum." and lessonnum = ".$lessonnum;

 $trellisdata = qry($conn,$sql);
 
  while ($trellis = arr($trellisdata))
	  
	{
		$lessondate = daydate($conn,$trellis['daynum']);
		$lessontime = daytime($conn,$trellis['block']);
	}
	  
$sql = " select * from LESSON where lesson_num = ".$lessonnum;

//echo "lesson ".$sql."<br>";

 $result = qry($conn,$sql);
  
 while ($lesson_array = arr($result))
	  {
		$coursenum = $lesson_array['coursenum'];
		$lcomments = $lesson_array['lcomments'];
		$attendance = $lesson_array['attendance'];
		$late = $lesson_array['late'];
		$fetched = $lesson_array['fetched'];
		$emailed = $lesson_array['emailed'];
	  }
	  
$sql = "select description from COURSE where coursenum = ".$coursenum;
		
			$cor = qry($conn,$sql);
		
		while ($co_array = arr($cor))
		{
	
		divmaker(15,0,60,10,"white","blue","1","
	text-align: center;" ,"<h200>Lesson for: ".$co_array['description']." ".$lessondate." ".$lessontime."</h200>");
 
		}
		
$check = array("","","","","","","","","","","");

$check[$attendance] = "checked";



$checkf = array("","");

$checkf[$fetched] = "checked";

echo "<input type =\"hidden\" name = \"lesnum\" value = \"".$lessonnum."\">";

bmaker(False,10,15,20,7,"label","","","","disabled","<h200>Comments:</h200>");



bmaker(False,10,25,40,30,"label","","","","disabled","<h200><textarea rows=\"10\" cols=\"60\" name=\"lcomments\">".$lcomments."</textarea></h200>");

bmaker(False,70,20,20,7,"label","","","","disabled","<h200>Attendance:</h200>");

echo "<section id=\"accordion\">";

$content =  "<input type=\"radio\" name=\"attendance\" value=\"0\" id=\"option-1\" ".$check[0]."/><label for=\"option-1\"><h200>Unmarked</h200></label>";

divmaker(70,30,20,10,"white","blue","1","" 
,$content);

$content =  "<input type=\"radio\" name=\"attendance\" value=\"1\"  id=\"option-2\" ".$check[1]."/><label  for=\"option-2\"><h200>Present</h200></label>";

divmaker(70,40,20,5,"white","blue","1","font-size: 100%;
text-align: left;" 
,$content);

$content =  "<input type=\"radio\" name=\"attendance\" value=\"2\"  id=\"option-3\" ".$check[2]."/><label  for=\"option-3\"><h200>Absent Without Notice</h200></label>";

divmaker(70,50,25,5,"white","blue","1","font-size: 100%;
text-align: left;" 
,$content);

$content =  "<input type=\"radio\" name=\"attendance\" value=\"5\"  id=\"option-6\" ".$check[5]."/><label  for=\"option-6\"><h200>Absent With Notice</h200></label>";

divmaker(70,60,25,5,"white","blue","1","font-size: 100%;
text-align: left;" 
,$content);

$content =  "<input type=\"radio\" name=\"attendance\" value=\"3\"  id=\"option-4\" ".$check[3]."/><label  for=\"option-4\"><h200>Absent School Activity</h200></label>";

divmaker(70,70,25,5,"white","blue","1","font-size: 100%;
text-align: left;" 
,$content);

$content =  "<input type=\"radio\" name=\"attendance\" value=\"6\"  id=\"option-7\" ".$check[6]."/><label  for=\"option-7\"><h200>Absent Extra Lesson</h200></label>";

divmaker(70,80,20,5,"white","blue","1","font-size: 100%;
text-align: left;" 
,$content);

$content =  "<input type=\"radio\" name=\"attendance\" value=\"4\"  id=\"option-5\" ".$check[4]."/><label  for=\"option-5\"><h200>Tutor Absent</h200></label>";

divmaker(70,90,20,5,"white","blue","1","font-size: 100%;
text-align: left;" 
,$content);

echo "</section>";

$checkl = array("","");

$checkl[$late] = "checked";

echo "<section id=\"accordion\">";

$content =  "<input type=\"radio\" name=\"late\" value=\"0\" id=\"late-1\" ".$checkl[0]."/><label for=\"late-1\"><h200>On time</h200></label>";

divmaker(10,60,20,5,"white","blue","1","
text-align: left;" 
,$content);

$content =  "<input type=\"radio\" name=\"late\" value=\"1\" id=\"late-2\" ".$checkl[1]."/><label for=\"late-2\"><h200>Late</h200></label>";

divmaker(40,60,20,5,"white","blue","1","font-size: 100%;
text-align: left;" 
,$content);

echo "</section>";

echo "<section id=\"accordion\">";

$content =  "<input type=\"radio\" name=\"fetched\" value=\"0\" id=\"fetched-1\" ".$checkf[0]."/><label for=\"fetched-1\"><h200>Not fetched</h200></label>";

divmaker(10,70,20,5,"white","blue","1","
text-align: left;" 
,$content);

$content =  "<input type=\"radio\" name=\"fetched\" value=\"1\" id=\"fetched-2\" ".$checkf[1]."/><label for=\"fetched-2\"><h200>Fetched</h200></label>";

divmaker(40,70,20,5,"white","blue","1","font-size: 100%;
text-align: left;" 
,$content);

echo "</section>";

$sql = "SELECT DISTINCT * FROM ROLL AS RL INNER JOIN CLASS AS CL ON RL.clnum = CL.clnum INNER JOIN STCLASS AS STC ON RL.clnum = STC.clnum AND RL.stnum = STC.stnum WHERE RL.lessonnum = ".$lessonnum;

	$rolldata = qry($conn,$sql);

	$remclass = 80;
	
while ($roll = arr($rolldata))
{
$content = "<button type=\"submit\" class = \"mediummenu-button green\" disabled>"."Removed from ".$roll['class_desc']." ".daytime($conn,$roll['perstart'])."-".daytime($conn,$roll['perstart']+$roll['perlength'])."</button>" ;

divmaker(10,$remclass,50,5,"","","1","text-align: center;",$content);
	
	$remclass = $remclass + 5;
	
}

$content = "<button type=\"submit\" value = \"".$lessonnum."\" name = \"sel\" class=\"menu-button\" >";
	
$content .= 	"<h200>Save Lesson</h200></button>";

divmaker(70,00,15,10,"white","blue","1","font-size: 150%;
text-align: center;" 
,$content);

echo "</form>";


echo "<FORM METHOD=\"POST\" ACTION=\"lessondel.php\">";

echo "<input type =\"hidden\" name = \"lesnum\" value = \"".$lessonnum."\">";


$content = "<button type=\"submit\" value = \"".$lessonnum."\" name = \"sel\" class=\"menu-button\" >";
	
$content .= 	"<h200>Delete Lesson</h200></button>";

divmaker(85,00,15,10,"white","blue","1","" 
,$content);

echo "</form>";


if ($emailed == 0)
{

echo "<FORM METHOD=\"POST\" ACTION=\"lessonemail.php\">";

echo "<input type =\"hidden\" name = \"lesnum\" value = \"".$lessonnum."\">";


$content = "<button type=\"submit\" value = \"".$lessonnum."\" name = \"sel\" class=\"menu-button\" >";
	
$content .= 	"<h200>Email Lesson</h200></button>";

divmaker(50,10,15,10,"white","blue","1","" 
,$content);

echo "</form>";
}
else
{
$content .= 	"<h200>Lesson Emailed</h200></button>";

	divmaker(85,00,15,10,"white","blue","1","" 
	,$content);
}	

echo "<FORM METHOD=\"POST\" ACTION=\"timetable.php\">";

divmaker(0,0,15,10,"white","blue","1","position: fixed;" 
,"<button type=\"submit\" class = \"menu-button\" ><h200>Timetable</h200></button>");

echo "</FORM>\n";

echo "</body>
</html>";

?>
