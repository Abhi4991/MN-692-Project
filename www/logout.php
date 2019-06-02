<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

$schdom = sessinfo($conn,"SCHDOM");
$domainname = sessinfo($conn,"domainname");

$sessnum = sessinfo($conn,"SESS");

unset($_SESSION[$sessnum]);  // where $_SESSION["nome"] is your own variable. if you do not have one use only this as follow **session_unset();**
header("Location: http://$schdom.$domainname");
exit;
?>


