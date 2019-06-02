<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";
include "writelesson.php";

$school = sessinfo($conn,"SCHDOM");
$tenum = sessinfo($conn,"tenum");
$sessnum = sessinfo($conn,"SESS");
$userip = sessinfo($conn,"userip");
$user = sessinfo($conn,"User_name");
$lookup = $_POST['lookup'];

$sql = "select * from wTTAB where SESS = '".$sessnum."' and lookup = ".$lookup;

$lessinfo = qry($conn,$sql);

while ($lessinfo_array = arr($lessinfo))
{
	$daynum = $lessinfo_array['daynum'];
	$blocknum = $lessinfo_array['blocknum'];
}

$blocknum = $_POST['lessontime'];
$lessonlength = $_POST['lessonlength'];
$corsel = $_POST['corsel'];
$repeat = $_POST['repeat'];
$numles = $_POST['numles'];
$interval = $_POST['interval'];

$sql = "select * from TRELLIS where block+lesson_length > ".$blocknum." and block < ".($blocknum+$lessonlength). " and tenum = ".$tenum." and daynum = ".$daynum;

$trellisinfo = qry($conn,$sql);

$num_rows = mysqli_num_rows($trellisinfo);

if ($num_rows == 0)
{
	$xm = '';

	$xm .=  "<inputs>\r";
	$xm .=  "<data_source>addlesson2.php</data_source>\r";
	$xm .= "<userip>".$userip."</userip>\r";
	$xm .= "<user>".$user."</user>\r";
	$xm .= "<date>".gmdate(DATE_RFC822)."</date>\r";
	$xm .= "<school>".$school."</school>\r";
	$xm .=  "<tutor>".$tenum."</tutor>\r";

	$xm .=  "<block>".$blocknum."</block>\r";
	$xm .=  "<daynum>".$daynum."</daynum>\r";
	$xm .=  "<lessonlength>".$lessonlength."</lessonlength>\r";
	$xm .=  "<coursenum>".$_POST['corsel']."</coursenum>\r";
	$xm .=  "<repeat>".$repeat."</repeat>\r";
	$xm .=  "<numles>".$numles."</numles>\r";
	$xm .=  "<interval>".$interval."</interval>\r";
	$xm .=  "</inputs>\r";

	sessupdate($conn,"xm","'".$xm."'");
	
	header('Refresh:0 ; URL=addlesson2.php');
}
else
{
	$trellis= arr($trellisinfo);
		
	$sql = "select * from TRELLIS inner join COURSE on TRELLIS.coursenum = COURSE.coursenum where lessonnum = ".
			$trellis['lessonnum'];
			
	$trellisinfo = qry($conn,$sql);
	$trellis= arr($trellisinfo);
			
	$content = "";
						
	$content = "<button type=\"submit\" class = \"smallmenu-button blue \" value = \"".$trellis['lessonnum']."\" name = \"sel\"";
	
	$content = $content ."<FORM METHOD=\"POST\" ACTION=\"selection.php\">";
	
	$description = "<h120>".$trellis['description']."</h120><BR>";
	$timedisp = "<h80>".daytime($conn,$trellis['block'])."-".daytime($conn,$trellis['block']+$trellis['lesson_length'])."</h80>";
	$content = $content ."<h200>This booking infringes</h200><BR><BR>".$description.$timedisp."<BR><BR><h200>Try again</h200></button>";	
				
	sessupdate($conn,"xm","'".$content."'");	
	sessupdate($conn,"nextpage","'selection.php'");

  header('Refresh:0 ; URL=warning.php');

}

?>
