<?php
include 'opendb.php';
include 'rollgen.php';
include "dbstuff.php";

writehead("MOD COURSE",$conn,"modcourse",0);
// create the SQL statement

echo "<BR>";
echo "<div id=\"stylized\" class=\"stdform\">";

echo "<FORM METHOD=\"POST\" ACTION=\"modcourse2.php\">";

$coursenum = $_POST['selcourse'];

$coql = "Select * from COURSE where coursenum = ".$coursenum;

$cors = qry($conn,$coql) ;

$co_array = arr($cors);

echo "<input type=\"hidden\" name=\"coursenum\" value= \"".$coursenum."\" />";

intext("stdinput","description","Description: ",50,$co_array['description']);

echo "<br>";

//intnum("lessons","Number of Lessons: ",$cors[2);

$numbers = array(30,40,45,60,120);

numsel("stdselect","lessons","Minutes per Lesson: ",$numbers,1,$co_array['lessons']);


echo "<br>";

$numbers = array(1,2,3,4,5,6,7,8,9);

numsel("stdselect","length","Number of Lessons: ",$numbers,1,$co_array['length']);


echo "<br>";

intnum("stdinput","tutor","Tutor: ",2,$co_array['tutor']);

echo "<br>";

echo "<button type=\"submit\">Save Changes</button>";
echo "<div class=\"spacer\"></div>";

echo "</FORM>
</body>
</html>";

?>
