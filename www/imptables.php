<?php
include "opendb.php";

$dirname = "./$schdom/import";
// open in read-only mode


$handle = fopen("$dirname/STUDENTS.TXT", "r");
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
   $num = count($data);
//   echo "<p> $num fields in line $row: <br /></p>\n";
  
  // for ($c=0; $c < $num; $c++) {
  //     echo $data[$c] . " F= " . $c . "\n";
//}

$sql = "SELECT st_code FROM STUDENTS WHERE st_code = '$data[0]'";

//echo $sql;

$result = mysql_query($sql,$conn) or die(mysql_error());

$num_rows = mysql_num_rows($result);

if ($num_rows == 0) {

$respon = "record added!";

$sql = "INSERT INTO STUDENTS (
st_code,
st_first,
st_last,
home_group,
year_level)
values
('$data[0]','$data[2]','$data[1]','$data[3]',$data[4])";
} else {

$respon = "record changed!";

$sql = "UPDATE STUDENTS SET 
st_first = '$data[2]', 
st_last = '$data[1]',
home_group = '$data[3]',
year_level = $data[4] 
WHERE st_code = '$data[0]'";
}

//echo $sql;

if (mysql_query($sql, $conn)) {
	//echo $respon;
} else {
	//echo "something went wrong";
}

   
}
fclose($handle);

echo "Imported students<BR>";

 
 // open in read-only mode

$handle = fopen("$dirname/TEACHER.TXT", "r");
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
   $num = count($data);
//   echo "<p> $num fields in line $row: <br /></p>\n";
  
  // for ($c=0; $c < $num; $c++) {
  //     echo $data[$c] . " F= " . $c . "\n";
//}

$sql = "SELECT te_code FROM TEACHERS WHERE te_code = '$data[0]'";

//echo $sql;

$result = mysql_query($sql,$conn) or die(mysql_error());

$num_rows = mysql_num_rows($result);

if ($num_rows == 0) {

$respon = "record added!";

$sql = "INSERT INTO TEACHERS (
te_code,
te_last,
te_first)
values
('$data[0]','$data[1]','$data[2]')";
} else {

$respon = "record changed!";

$sql = "UPDATE TEACHERS SET 
te_first = '$data[2]', 
te_last = '$data[1]' 
WHERE te_code = '$data[0]'";
}

//echo $sql;

if (mysql_query($sql, $conn)) {
	//echo $respon;
} else {
	//echo "something went wrong";
}

   
}
fclose($handle);
 
echo "Imported teachers<BR>";

  // open in read-only mode

$handle = fopen("$dirname/CLASS.TXT", "r");
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
   $num = count($data);
//   echo "<p> $num fields in line $row: <br /></p>\n";
  
  // for ($c=0; $c < $num; $c++) {
  //     echo $data[$c] . " F= " . $c . "\n";
//}

$sql = "SELECT class_code FROM CLASS WHERE class_code = '$data[1]'";

//echo $sql;

$result = mysql_query($sql,$conn) or die(mysql_error());

$num_rows = mysql_num_rows($result);

if ($num_rows == 0) {

$respon = "record added!";

$sql = "INSERT INTO CLASS (
class_code,
class_desc)
values
('$data[1]','$data[2]')";
} else {

$respon = "record changed!";

$sql = "UPDATE CLASS SET 
class_desc = '$data[2]'
WHERE class_code = '$data[1]'";
}

//echo $sql;

if (mysql_query($sql, $conn)) {
	//echo $respon;
} else {
	//echo "something went wrong";
}

   
}
fclose($handle);

echo "Imported classes<BR>";


$sql = "DELETE FROM TIMETABLE";

//echo $sql;

$result = mysql_query($sql,$conn) or die(mysql_error());
 
   // open in read-only mode

$handle = fopen("$dirname/TTABLE.TXT", "r");
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
   $num = count($data);
//   echo "<p> $num fields in line $row: <br /></p>\n";
  
  // for ($c=0; $c < $num; $c++) {
  //     echo $data[$c] . " F= " . $c . "\n";
//}

$sql = "SELECT clnum FROM CLASS WHERE class_code = '$data[0]'";

$classres = mysql_query($sql,$conn) or die(mysql_error());

$sql = "SELECT tenum FROM TEACHERS WHERE te_code = '$data[1]'";

$teachres = mysql_query($sql,$conn) or die(mysql_error());

//echo $teachres;
//echo "<BR>";

$teachnum = mysql_result($teachres, 0, 'tenum');

//echo $teachnum;
//echo "<BR>";

$classnum = mysql_result($classres, 0, 'clnum');

//echo $classnum;
//echo "<BR>";


$sql = "INSERT INTO TIMETABLE (
tenum,
clnum,
ttday,
ttper,
room)
values
($teachnum,$classnum,$data[2],$data[3],'$data[7]')";

if (mysql_query($sql, $conn)) {
	//echo $respon;
} else {
	//echo "something went wrong";
}

   
}
fclose($handle);
 
echo "Imported time table<BR>";
 
 $sql = "DELETE FROM STLIST";

//echo $sql;

$result = mysql_query($sql,$conn) or die(mysql_error());
 
   // open in read-only mode

$handle = fopen("$dirname/STLIST.TXT", "r");
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
   $num = count($data);
//   echo "<p> $num fields in line $row: <br /></p>\n";
  
  // for ($c=0; $c < $num; $c++) {
  //     echo $data[$c] . " F= " . $c . "\n";
//}

$sql = "SELECT clnum FROM CLASS WHERE class_code = '$data[1]'";

$classres = mysql_query($sql,$conn) or die(mysql_error());

$sql = "SELECT stnum FROM STUDENTS WHERE st_code = '$data[0]'";

$studres = mysql_query($sql,$conn) or die(mysql_error());

$studnum = mysql_result($studres, 0, 'stnum');

$classnum = mysql_result($classres, 0, 'clnum');

$sql = "INSERT INTO STLIST (
clnum,
stnum)
values
($classnum,$studnum)";

if (mysql_query($sql, $conn)) {
	//echo $respon;
} else {
	//echo "something went wrong";
}

   
}
fclose($handle);
 
echo "Imported students subjects<BR>";

 $sql = "DELETE FROM DAYS";

//echo $sql;

$result = mysql_query($sql,$conn) or die(mysql_error());
 
   // open in read-only mode

$handle = fopen("$dirname/DAYS.TXT", "r");

while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
   $num = count($data);
//   echo "<p> $num fields in line $row: <br /></p>\n";
  
  // for ($c=0; $c < $num; $c++) {
  //     echo $data[$c] . " F= " . $c . "\n";
//}


$sql = "INSERT INTO DAYS (
daynum,
termnum,
weeknum,
thedate,
schoolday)
values
($data[0],$data[1],$data[2],'$data[4]',$data[3])";


echo $data[4];
echo "<BR>";

if (mysql_query($sql, $conn)) {
	echo $respon;
} else {
	echo "Something went wrong";
}

}
fclose($handle);
 
echo "Imported school days<BR>";











 
echo "<ul><li><a href=\"menu.php\">back to user page</a></ul>";
?>