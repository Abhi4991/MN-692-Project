<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

writehead("WARNING",$conn,"warning",1);

$content = sessinfo($conn,"xm");

$nextpage = sessinfo($conn,"nextpage");

echo "<FORM METHOD=\"POST\" ACTION=\"".$nextpage."\" >";

	divmaker(20,30,30,30,"","","1","",$content);

echo "</FORM>";

echo "</body>\n
</html>";

?>


