<?php
include "opendb.php";
echo "lets make some tables";
echo "<BR>";

$sql = "CREATE TABLE STUDENT
(stnum int not null primary key auto_increment,
st_code char(10) not null,
st_first varchar(30),
st_last varchar(30),
st_dob varchar(10),
schnum int,
year_level varchar(3),
enrol_date varchar(10),
st_descent varchar(1),
st_parent varchar(50),
st_carer varchar(50),
st_teacher varchar(50),
home_group varchar(6) )";

$result = mysql_query($sql,$conn) or die(mysql_error());

echo "<BR>";
echo "Made Students Table!";


$sql = "CREATE TABLE TEACHER
(tenum int not null primary key auto_increment,
te_code char(10) not null,
te_first varchar(30),
te_last varchar(30),
home_group varchar(6) )";

$result = mysql_query($sql,$conn) or die(mysql_error());

echo "<BR>";
echo "Made Students Table!";

$sql = "CREATE TABLE CLASS
(clnum int not null primary key auto_increment,
class_code char(10) not null,
class_desc varchar(50) )";

$result = mysql_query($sql,$conn) or die(mysql_error());

echo "<BR>";
echo "Made Class Table!";

$sql = "CREATE TABLE STLIST
(recnum int not null primary key auto_increment,
clnum int not null,
stnum int not null )";

$result = mysql_query($sql,$conn) or die(mysql_error());

echo "<BR>";
echo "Made Stlist Table!";

$sql = "CREATE TABLE HGROUP
(recnum int not null primary key auto_increment,
home_group varchar(6) not null, 
home_desc varchar(30))";

$result = mysql_query($sql,$conn) or die(mysql_error());

echo "<BR>";
echo "Made Group Table!";

$sql = "CREATE TABLE TIMETABLE
(recnum int not null primary key auto_increment,
tenum int not null,
clnum int not null,
ttday tinyint,
ttper tinyint,
room varchar(10) )";

$result = mysql_query($sql,$conn) or die(mysql_error());

echo "<BR>";
echo "Made Timetable Table!";

$sql = "CREATE TABLE ROLL
(recnum int not null primary key auto_increment,
tenum int not null,
clnum int not null,
stnum int not null,
daynum int not null,
pernum int not null,
ststat tinyint,
stnote int,
extrac int,
resolv int,
notify int,
peroff int,
room varchar(10) )";

$result = mysql_query($sql,$conn) or die(mysql_error());

echo "<BR>";
echo "Made Roll Table!";

$sql = "CREATE TABLE MARKED
(recnum int not null primary key auto_increment,
tenum int not null,
clnum int not null,
daynum int not null,
pernum int not null,
marked tinyint,
peroff int,
room varchar(10) )";

$result = mysql_query($sql,$conn) or die(mysql_error());

echo "<BR>";
echo "Made Marked Table!";


$sql = "CREATE TABLE DAYS
(recnum int not null primary key auto_increment,
daynum int not null,
termnum tinyint,
weeknum tinyint,
thedate varchar(10),
schoolday tinyint )";

$result = mysql_query($sql,$conn) or die(mysql_error());

echo "<BR>";
echo "Made Days Table!";



echo "<ul>
	<li><a href=\"menu.php\">back to user page</a>
	
	</ul>";

?>