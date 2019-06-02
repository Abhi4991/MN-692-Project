<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

if ($_POST['addmod'] == 0)
{
	writehead("ADD COURSE DETAILS",$conn,"addstudent",0);

	echo "<FORM METHOD=\"POST\" ACTION=\"addstudent4.php\">";

	$stnum = $_POST['sel'];

	$sql = "select * from STUDENTS where stnum = ".$stnum;

	$studs = qry($conn,$sql) ;

	$st_array = arr($studs);
	 
	divmaker(30,5,40,10,"","","","
	text-align: left;","<button type=\"submit\" class= \"label\" disabled><h200>Course for ".$st_array['st_first']." ".$st_array['st_last']."</h200></button>");

	$stfirst = $st_array['st_first'];
	$stlast = $st_array['st_last'];

	$description = $stfirst." ".$stlast;

	$sql = "select stl.clnum, stl.clavail, cl.class_code, cl.class_desc from STCLASS as stl 
			inner join CLASS as cl on stl.clnum = cl.clnum where stnum = ".$stnum;
	 
	$stcl = qry($conn,$sql);
}
else
{	
	writehead("MOD COURSE DETAILS",$conn,"modstudent",0);

	echo "<FORM METHOD=\"POST\" ACTION=\"modstudent.php\">";

	$coursenum = $_POST['sel'];

	echo "<input type=\"hidden\" name=\"course\" value= \"".$_POST['sel']."\" />";

	$sql = "select * from COURSE where coursenum = ".$coursenum;

	$coursedata = qry($conn,$sql);

	$course = arr($coursedata);
	
		divmaker(30,5,40,10,"","","","
		text-align: left;","<button type=\"submit\" class= \"label\" disabled><h200>Course for ".$course['description']."</h200></button>");
		$lessons = $course['lessons'];
		$courseactive = $course['courseactive'];
		$description = $course['description'];
		$length = $course['length'];
	
		
	$sql = "select * from COURSELIST where coursenum = ".$coursenum;
	$courselistdata = qry($conn,$sql);

	while ($courselist = arr($courselistdata))
	{
		$stnum = $courselist['stnum'];
		echo "<input type=\"hidden\" name=\"stnum\" value= \"".$courselist['stnum']."\" />";
	}
	
	 
}

if ($_POST['addmod'] == 0)
{
	echo "<FORM METHOD=\"POST\" ACTION=\"addstudent4.php\">";
}
else
{
	echo "<FORM METHOD=\"POST\" ACTION=\"modstudent.php\">";
}

$sql = "select stl.clnum, stl.clavail, cl.class_code, cl.class_desc from STCLASS as stl 
		inner join CLASS as cl on stl.clnum = cl.clnum where stnum = ".$stnum;

$stcl = qry($conn,$sql);
			
 $num_rows = mysqli_num_rows($stcl);
  
if ($num_rows == 0)
{
$newclass = 0;
  
$sql = "select stl.clnum, cl.class_code, cl.class_desc from STLIST as stl 
inner join CLASS as cl on stl.clnum = cl.clnum where stnum = ".$stnum;
$stcl = qry($conn,$sql);
}
else
{
  $newclass = 1;
}

$numbers = array(9,0,1,2,3,4,5,6,7,8,9);
$ins = 0;

echo "<input type=\"hidden\" name=\"studs\" value= \"".$_POST['sel']."\" />";

echo "<input type=\"hidden\" name=\"newclass\" value= \"".$newclass."\" />";

$nextline = 0;

while($st_array = arr($stcl))
{
	$width = strlen($st_array['class_desc'])+10;
	divmaker(10,20+$nextline,$width,5,"","","","","<button type=\"submit\" class= \"label\" disabled>".$st_array['class_desc'])."</button>";

	if ($newclass == 0)
	{
		$content = numsel("label","lessons".$ins,$numbers,1,0);
		divmaker(45,20+$nextline,5,5,"","","","",$content);
	}
	else
	{
		$numbers = array($st_array['clavail'],0,1,2,3,4,5,6,7,8,9);
		$content = numsel("label","lessons".$ins,$numbers,1,$st_array['clavail']);
		divmaker(40,20+$nextline,7,5,"","","","font-size: 150%;
		text-align: left;",$content);
		echo "<input type=\"hidden\" name=\"clnum".$ins."\" value= \"".$st_array['clavail']."\" />";
	}

	echo "<input type=\"hidden\" name=\"clnum".$ins."\" value= \"".$st_array['clnum']."\" />";
	$ins++;
	$nextline = $nextline + 5;
}
 
if ($nextline <> 0 )
{
	divmaker(10,15,20,5,"","","","
	text-align: left;","<button type=\"submit\" class= \"label\" disabled><h200>Classes</h200></button>");

	divmaker(40,15,30,5,"","","","
	text-align: left;","<button type=\"submit\" class= \"label\" disabled><h150>Periods available for lessons</h150></button>");
}
   
echo "<input type=\"hidden\" name=\"classnum\" value= \"".$ins."\" />";

	divmaker(50,25,25,5,"","","","
	text-align: left;","<button type=\"submit\" class= \"label\" disabled><h150>Number of Lessons:</h150></button>");

if ($_POST['addmod'] == 0)
{
	$numbers = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16);
	divmaker(65,25,7,5,"","","","","<button type=\"submit\" class= \"label\" disabled>".numsel("label","numles",$numbers,1,0)."</button>");
}
else
{
	$numbers = array($lessons,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16);
	divmaker(65,25,7,5,"","","","","<button type=\"submit\" class= \"label\" disabled>".numsel("label","numles",$numbers,1,$lessons)."</button>");
}
   
	divmaker(50,35,15,5,"","","","
	text-align: left;","<button type=\"submit\" class= \"label\" disabled><h150>Lesson Length:</h150></button>");

if ($_POST['addmod'] == 0)
{
	$numbers = lessonlength($conn);
	
	
	
	divmaker(65,35,7,5,"","","","","<button type=\"submit\" class= \"label\" disabled>".numsel("label","leslen",$numbers,1,0)."</button>");
}
else
{
	$lengtharr[] = $length;
	$numbers = array_merge($lengtharr,$numbers = lessonlength($conn));
	divmaker(65,35,7,5,"","","","","<button type=\"submit\" class= \"label\" disabled>".numsel("label","leslen",$numbers,1,0)."</button>");
}
  
divmaker(50,45,15,5,"","","","font-size: 150%;text-align: left;","<button type=\"submit\" class= \"label\"         disabled><h150>Description:</h150></button>");

divmaker(65,45,20,5,"","","","","<div ><button type=\"submit\" class= \"label\" disabled><INPUT TYPE=\"text\" NAME=\"description\" class= \"label\" value = \"".$description."\" ></button></div>");

$content = "<button type=\"submit\" name = \"sel\" class=\"menu-button\" >";

$content .= "<h200>Save Course</h200></button>";

divmaker(60,65,25,10,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);

echo "</FORM>";

if ($_POST['addmod'] <> 0)
{
	echo "<FORM METHOD=\"POST\" ACTION=\"delstudent1.php\">";

	echo "<input type=\"hidden\" name=\"course\" value= \"".$_POST['sel']."\" />";

	$content = "<button type=\"submit\" name = \"sel\" class=\"menu-button\" >";

	$content .= "<h200>Delete Course</h200></button>";

	divmaker(60,80,25,10,"white","blue","1","
	text-align: center;" 
	,$content);

	echo "</FORM>";
}


if ($_POST['addmod'] <> 0 and $courseactive == 1)
{
	echo "<FORM METHOD=\"POST\" ACTION=\"courseactive.php\">";

	echo "<input type=\"hidden\" name=\"course\" value= \"".$_POST['sel']."\" />";

	$content = "<button type=\"submit\" name = \"sel\" class=\"menu-button\" >";

	$content .= "<h200>Make Inactive</h200></button>";

	divmaker(80,0,20,10,"white","blue","1","
	text-align: center;" 
	,$content);

	echo "</FORM>";
}

if ($_POST['addmod'] <> 0 and $courseactive == 0)
{
	echo "<FORM METHOD=\"POST\" ACTION=\"courseactive.php\">";

	echo "<input type=\"hidden\" name=\"course\" value= \"".$_POST['sel']."\" />";

	$content = "<button type=\"submit\" name = \"sel\" class=\"menu-button\" >";

	$content .= "<h200>Make Active</h200></button>";

	divmaker(80,0,20,10,"white","blue","1","
	text-align: center;" 
	,$content);

	echo "</FORM>";
}


if ($_POST['addmod'] == 0)
{
	echo "<FORM METHOD=\"POST\" ACTION=\"addstudent1.php\">";
}
else
{
	echo "<FORM METHOD=\"POST\" ACTION=\"selstudent.php\">";
}
divmaker(0,0,20,10,"white","blue","1","
text-align: center;" 
,"<button type=\"submit\" class=\"menu-button\" ><h200>Back</h200></button>");

echo "</FORM>";
echo "</body>
</html>";

?>
