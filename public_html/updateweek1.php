<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

echo "Updating roll<BR>";
echo "Updated roll<BR>";
echo "<ul><li><a href=\"admin.php\">back admin</a></ul>";


 $term = SESSINFO($conn,"term");
 $week = SESSINFO($conn,"week");
 $firstday = SESSINFO($conn,"firstday");
 $lastday = SESSINFO($conn,"lastday");
 $whichweek = SESSINFO($conn,"whichweek");
 
 $sql = "DELETE from ROLL where daynum >= ".$firstday." and daynum <= ".$lastday;
 
 $delroll = qry($conn,$sql);
		
$sql = "SELECT DISTINCT st.stnum,st.clnum,tt.ttday,tt.ttper,tt.perstart,tt.perlength FROM STLIST as st inner join TIMETABLE as tt on st.clnum = tt.clnum";

$ttdata = qry($conn,$sql);

while ($tt = arr($ttdata))
{
	if ($whichweek == 1 and $tt['ttday'] < 6)
	{		
	$addday = $tt['ttday']+$firstday-1;
	addroll($conn,1,$tt['clnum'],$tt['stnum'],$addday,$tt['ttper'],$tt['perstart'],$tt['perlength']);
	}
	if ($whichweek == 2 and $tt['ttday'] > 5)
	{
	$addday = $tt['ttday']-5+$firstday-1;
	addroll($conn,1,$tt['clnum'],$tt['stnum'],$addday,$tt['ttper'],$tt['perstart'],$tt['perlength']);
	}
}

function addroll($conn,$tenum,$clnum,$stnum,$ttday,$ttper,$perstart,$perlength)
{
			$sql = "INSERT INTO ROLL (tenum,clnum,stnum,daynum,pernum,perstart,perlength) values (".$tenum.",".$clnum.",".$stnum.",".$ttday.",".$ttper.",".$perstart.",".$perlength.")";
		
//		echo $sql."<BR>";

		$addttable = qry($conn,$sql);
	return;
	
}
?>