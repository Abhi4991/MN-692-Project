<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";



$term = SESSINFO($conn,"term");
$week = SESSINFO($conn,"week");

$sql = "select distinct termnum,weeknum from DAYS where weeknum <> 0 order by termnum desc,weeknum desc";

//echo $sql."<BR>";

 $done = qry($conn,$sql);
 
 $i = 0;
 
 while ($day_array = arr($done))
 
 {
 
 If ($i == 1)
 {
  
 // echo $day_array['termnum']."<BR>";
  //echo $day_array['weeknum']."<BR>"; 
  
  break;
  
 }
 
	 If ($day_array['termnum'] == $term and $day_array['weeknum'] == $week)
	 {
	 $i = 1;
	 
	 }
 }



$sql = "update SESSINFO set term = ".$day_array['termnum'].", week =".$day_array['weeknum']." where sess = '".session_id()."'";

 $done = qry($conn,$sql);

 $term = SESSINFO($conn,"term");
 $week = SESSINFO($conn,"week");

 $sql = "select * from DAYS where termnum = ".$term." and weeknum = ".$week." order by daynum";  

 $result = qry($conn,$sql);
		 
		 while ($day_array = arr($result))
		{
		$daydate[$day_array['dayofweek']-1] = $day_array['daynum'];
		
		}
		 
		 $firstday = $daydate[0];
		 $lastday = $daydate[count($daydate)-1];
		  
	 $a = session_id();
	  
	  $sql = "update SESSINFO set firstday = ".$firstday.",lastday = ".$lastday." where SESS = '".$a."'";

	  $result = qry($conn,$sql);

$url = htmlspecialchars($_SERVER['HTTP_REFERER']);

header("Location:".$url ) ;

?>