<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

sessupdate($conn,"tenum",$_POST['sel']);

header('Refresh:0 ; URL=timetable.php');

?>
