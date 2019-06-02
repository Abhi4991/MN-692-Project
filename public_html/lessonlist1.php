<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

$lessonorder =  SESSINFO($conn,"tempnum");

If ($lessonorder == 0)
{
	$lessonorder  = 1;
}
else
{
	$lessonorder  = 0;
}

sessupdate($conn,"tempnum",$lessonorder);

?>
<script type="text/javascript">

window.location.href = "lessonlist.php";

</script>