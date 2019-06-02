<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

writehead("AUTO BOOK",$conn,"autobook1",0);

$term = sessinfo($conn,'term');
$week = sessinfo($conn,'week');
$whichweek = sessinfo($conn,'whichweek');
$firstday = sessinfo($conn,'firstday');
$lastday = sessinfo($conn,'lastday');

$content = "<button type=\"submit\" class=\"label\" disabled><h300>Term ".$term." Week ".$week."</h300></button>";

divmaker(35,20,40,10,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);

$content = "<button type=\"submit\" class=\"label\" disabled><h300>Setting Priority</h300></button>";

divmaker(35,40,40,10,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);

$sql = "update COURSE set coursepriority = 0";

$courseclear = qry($conn,$sql);


$sql = "select * from COURSE co inner join COURSELIST cl on co.coursenum = cl.coursenum where co.tutor = ".sessinfo($conn,'tenum');
/*
$addtutor = sessinfo($conn,'addtutor');

if ($addtutor == 2)
{
	$sql .= " where tutor = ".sessinfo($conn,'tenum');
}
*/

$coursedata = qry($conn,$sql);

while ($courseinfo = arr($coursedata))
{

$sql = "select * from TRELLIS where coursenum = ".$courseinfo['coursenum']." and daynum >= ".$firstday." and daynum <= ".$lastday;

//echo $sql."<BR>";

$trellisdata = qry($conn,$sql);

$num_rows = mysqli_num_rows($trellisdata);
 

 
  if ($num_rows == 0)
  {

	$sql = "select * from STCLASS where stnum = ".$courseinfo['stnum'];
	
	$stclassdata = qry($conn,$sql); 
	
	while ($stclass = arr($stclassdata))
	{
	
		$priority = ($stclass['clavail'] - $stclass['clused'])*2;
		
		if ($priority <> 0)
			{
		
			$sql = "select clnum from ROLL where daynum >= ".$firstday." and daynum >= ".$lastday." and stnum = ".$courseinfo['stnum']." and clnum = ".$stclass['clnum']; 
			
			$rolldata = qry($conn,$sql); 
			
			while ($roll = arr($rolldata))
			
			{
			$priority = $priority + 1;
			
			}
		}
	
//	echo $stclass['stnum']." ".$stclass['clnum']." ".$priority."<br>";
	
	}
	
	$sql = "update COURSE set coursepriority = ".$priority." where coursenum = ".$courseinfo['coursenum'];
  }
  else
  {
	  	$sql = "update COURSE set coursepriority = -1 where coursenum = ".$courseinfo['coursenum'];
  }
	
	qry($conn,$sql);
	
}
?>
<script type="text/javascript">

window.location.href = "autobook2.php";

</script>



