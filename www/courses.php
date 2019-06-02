<?php
include "opendb.php";
include "rollgen.php";

writehead("COURSES",$conn,"courses",0);

echo "<table class = \"wrapper\">
<tr>
    <td class =  \"box\" ><a href=\"addcourse1.php\">ADD COURSE</a></td>
    <td class =  \"box\" ><a href=\"selcourse.php\">MODIFY COURSE</a></td>
  
</tr>

<tr>
<td class =  \"box\" colspan = \"2\"><a href=\"menu.php\">MAIN MENU</a></td>
</tr>
</table>";

?>

</body>
</html>
