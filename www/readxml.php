<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

writehead("READ XML",$conn,"readxml",0);

$xm = htmlentities($_POST['xmlstuff']);

echo $xm;

$xm = str_replace("/n", "<br>", $xm);

echo $xm;

?>






