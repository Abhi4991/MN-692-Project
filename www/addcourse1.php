<?php
include 'opendb.php';
include 'rollgen.php';

writehead("ADD COURSE",$conn,"addcourse",0);

echo "<FORM METHOD=\"POST\" ACTION=\"addcourse2.php\">";

divmaker(40,40,10,15,"","","","","<div ><INPUT TYPE=\"text\" NAME=\"description\" class = \"mediuminput\" size = \"50\" autofocus/></div>");

$numbers = array(30,40,45,60,120);

numsel("stdselect","length","Minutes per Lesson: ",$numbers,2,0);

echo "<br>";

$numbers = array(1,2,3,4,5,6,7,8,9);

numsel("stdselect","lessons","Number of Lessons: ",$numbers,1,0);

echo "<br>";

intnum("stdinput","tutor","Tutor: ",2,1);

$content = "<button type=\"submit\">Add Course</button>";

divmaker(40,80,15,10,"white","blue","1","",$content);

echo "</FORM>
</body>
</html>";

?>
