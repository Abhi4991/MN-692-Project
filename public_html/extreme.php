<?php

include "opendb.php";
include "rollgen.php";
include "dbstuff.php";


$sql = "delete from AVAILABILITY";

$delinfo = qry($conn,$sql);

$sql = "ALTER TABLE AVAILABILITY AUTO_INCREMENT = 1";

$delinfo = qry($conn,$sql);

$sql = "delete from CLASS";

$delinfo = qry($conn,$sql);

$sql = "ALTER TABLE CLASS AUTO_INCREMENT = 1";

$delinfo = qry($conn,$sql);

$sql = "delete from COURSE";

$delinfo = qry($conn,$sql);

$sql = "ALTER TABLE COURSE AUTO_INCREMENT = 1";

$delinfo = qry($conn,$sql);


$sql = "delete from COURSELIST";

$delinfo = qry($conn,$sql);

$sql = "delete from GROUPBOOKING";

$delinfo = qry($conn,$sql);

$sql = "ALTER TABLE GROUPBOOKING AUTO_INCREMENT = 1";

$delinfo = qry($conn,$sql);

$sql = "delete from GROUPBOOKINGSTUDENTS";

$delinfo = qry($conn,$sql);

$sql = "delete from GROUPBOOKINGTUTORS";

$delinfo = qry($conn,$sql);

$sql = "delete from GROUPLIST";

$delinfo = qry($conn,$sql);

$sql = "delete from GROUPS";

$delinfo = qry($conn,$sql);

$sql = "ALTER TABLE GROUPS AUTO_INCREMENT = 1";

$delinfo = qry($conn,$sql);

$sql = "delete from GROUPSTUDENTS";

$delinfo = qry($conn,$sql);

$sql = "delete from GROUPTUTORS";

$delinfo = qry($conn,$sql);

$sql = "delete from LESSON";

$delinfo = qry($conn,$sql);

$sql = "ALTER TABLE LESSON AUTO_INCREMENT = 1";

$delinfo = qry($conn,$sql);

$sql = "delete from STCLASS";

$delinfo = qry($conn,$sql);

$sql = "delete from STLIST";

$delinfo = qry($conn,$sql);

$sql = "delete from STUDENTS";

$delinfo = qry($conn,$sql);

$sql = "ALTER TABLE STUDENTS AUTO_INCREMENT = 1";

$delinfo = qry($conn,$sql);
$sql = "delete from COURSE";

$delinfo = qry($conn,$sql);

$sql = "delete from COURSELIST";

$delinfo = qry($conn,$sql);

$sql = "delete from TRELLIS";

$delinfo = qry($conn,$sql);

  header('Refresh:0 ; URL=menu.php');

?>
