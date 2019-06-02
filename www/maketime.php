<?php
include "opendb.php";
include "dbstuff.php";


$starttime = '';

$tNow = strtotime($starttime,"00:00");

for ( $x = 1; $x <=288; $x++) 
{
$content = date("g:i a",$tNow);

$sql = "Insert into TIMES values (";

$sql = $sql . $x;
$sql = $sql . ",'";
$sql = $sql . $content;
$sql = $sql ."')";

$maketime = qry($conn,$sql);

$tNow = strtotime('+5 minutes',$tNow);


}




echo "<ul><li><a href=\"menu.php\">back to user page</a></ul>";
?>