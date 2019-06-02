<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";
include "writelesson.php";

$sessnum = sessinfo($conn,"SESS");

$xm = sessinfo($conn,"xm");

$school = sessinfo($conn,"SCHDOM");

$xmm = writexml($xm,$school,$conn);

addlesson($xm,$conn,$school);

 header('Refresh:0 ; URL=selection.php');

?>
