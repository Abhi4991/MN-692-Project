<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

$coursedisp = SESSINFO($conn,"coursedisp");

if ($coursedisp == 0)
{
	$coursedisp = 1;
}
else
{
	$coursedisp = 0;
}

$sql = "update SESSINFO set coursedisp = ".$coursedisp." where sess = '".session_id()."'";

 $done = qry($conn,$sql);

$url = htmlspecialchars($_SERVER['HTTP_REFERER']);

header("Location:".$url ) ;

?>