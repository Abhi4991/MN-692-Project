<?php

include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

/*
$sql = "delete from COURSE";

$delinfo = qry($conn,$sql);

$sql = "delete from COURSELIST";

$delinfo = qry($conn,$sql);
*/

$sql = "delete from TRELLIS";

$delinfo = qry($conn,$sql);
/*
$sql = "delete from STCLASS";

$delinfo = qry($conn,$sql);

$sql = "delete from COURSE";

$delinfo = qry($conn,$sql);
*/
$sql = "delete from LESSON";

$delinfo = qry($conn,$sql);

$sql = "delete from GROUPBOOKING";

$delinfo = qry($conn,$sql);

$sql = "update STCLASS set clused = 0";

$delinfo = qry($conn,$sql);

$sql = "update COURSE set lessonsbooked = 0";

$delinfo = qry($conn,$sql);


$sql = "update ROLL set lessonnum = 0";

$delinfo = qry($conn,$sql);



  header('Refresh:0 ; URL=menu.php');

?>
