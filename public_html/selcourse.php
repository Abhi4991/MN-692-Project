<?php
include 'opendb.php';
include 'rollgen.php';
include "dbstuff.php";

writehead("SELECT COURSE",$conn,"selcourse",0);
// create the SQL statement

echo "<BR>";
echo "<div id=\"stylized\" class=\"stdform\">";

echo "<FORM METHOD=\"POST\" ACTION=\"modcourse1.php\">";

selcourse($conn,1,"selcourse",30);

echo "<br>";

echo "<button type=\"submit\">Mod Course</button>";
echo "<div class=\"spacer\"></div>";

echo "</FORM>
</body>
</html>";

?>
