<?php
include 'opendb.php';
include 'rollgen.php';
include 'dbstuff.php';

$school = sessinfo($conn,"SCHDOM");
$tenum = sessinfo($conn,"tenum");
$userip = sessinfo($conn,"userip");
$user = sessinfo($conn,"User_name");

$lessonnum = $_POST['sel'];

$xm = '<?xml version="1.0" ?>';

$xm .= "<inputs>\r";
$xm .= "<data_source>dellesson.php</data_source>\r";
$xm .= "<userip>".$userip."</userip>\r";
$xm .= "<user>".$user."</user>\r";
$xm .= "<date>".gmdate(DATE_RFC822)."</date>\r";
$xm .= "<school>".$school."</school>\r";
$xm .= "<tenum>".$tenum."</tenum>\r";
$xm .= "<lessonnum>".$lessonnum."</lessonnum>\r";

$xm .= "</inputs>\r";

$xmm = writexml($xm,$school,$conn);

$xm = simplexml_load_string($xm);

$sql = "select * from TRELLIS where lessonnum = ".$xm->lessonnum;

$trellisdata = qry($conn,$sql);

while ($trellis = arr($trellisdata))
{
$coursenum = $trellis['coursenum'];	
$daynum = $trellis['daynum'];	
$blocknum =   $trellis['block'];	
$lessonlength =   $trellis['lesson_length'];	
}

$sql = "select * from COURSELIST where coursenum = ".$coursenum;

$stinfo = qry($conn,$sql);

while ($stinfo_array = arr($stinfo))
	{
	
		$sql = "SELECT * FROM ROLL WHERE stnum = ".$stinfo_array['stnum']."	AND daynum = ".$daynum."	AND perstart <= ".$blocknum." and (perstart+perlength) >= ".$blocknum." and (perstart+perlength) <= ".($blocknum+$lessonlength);
	
	$rollinfo = qry($conn,$sql);
		
		while ($rollinfo_array = arr($rollinfo))

		
		{
			
			$sqlins = "update STCLASS set clused = clused - 1 where stnum = ".$stinfo_array['stnum']." and clnum = ".$rollinfo_array['clnum'];
		
		
		//echo $sqlins."<BR>";
		
		updatesql($sqlins,$conn);
		
		
		}
	
	}
	
$sql = "delete from LESSON where lesson_num = ".$xm->lessonnum;

updatesql($sql,$conn);

$sql = "delete from TRELLIS where lessonnum = ".$xm->lessonnum;

updatesql($sql,$conn);

header('Refresh:0 ; URL=selection.php');

?>
