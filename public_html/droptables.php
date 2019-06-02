<?php
include "opendb.php";
echo "lets make some tables";
echo "<BR>";

$sql = "DROP TABLE STUDENT";

$result = mysql_query($sql,$conn) or die(mysql_error());

echo "<BR>";
echo "Removed Students Table!";

$sql = "DROP TABLE TEACHER";

$result = mysql_query($sql,$conn) or die(mysql_error());

echo "<BR>";
echo "Removed Teachers Table!";

$sql = "DROP TABLE CLASS";

$result = mysql_query($sql,$conn) or die(mysql_error());

echo "<BR>";
echo "Removed Class Table!";

$sql = "DROP TABLE STLIST";

$result = mysql_query($sql,$conn) or die(mysql_error());

echo "<BR>";
echo "Removed Stlist Table!";

$sql = "DROP TABLE HGROUP";

$result = mysql_query($sql,$conn) or die(mysql_error());

echo "<BR>";
echo "Removed Group Table!";

$sql = "DROP TABLE TIMETABLE";

$result = mysql_query($sql,$conn) or die(mysql_error());

echo "<BR>";
echo "Removed Timetable Table!";

$sql = "DROP TABLE ROLL";

$result = mysql_query($sql,$conn) or die(mysql_error());

echo "<BR>";
echo "Removed Roll Table!";


$sql = "DROP TABLE MARKED";

$result = mysql_query($sql,$conn) or die(mysql_error());

echo "<BR>";
echo "Removed Marked Table!";

$sql = "DROP TABLE DAYS";

$result = mysql_query($sql,$conn) or die(mysql_error());

echo "<BR>";
echo "Removed Days Table!";



echo "<ul><li><a href=\"menu.php\">back to user page</a></ul>";


?>