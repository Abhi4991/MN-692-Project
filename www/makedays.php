<?php
include "opendb.php";
include "dbstuff.php";


function dayofyear2date( $tDay, $tFormat = 'd-m-Y' ) {
    $day = intval( $tDay )-1;
    $day = ( $day == 0 ) ? $day : $day - 1;
    $offset = intval( intval( $tDay ) * 86400 );
    $str = date( $tFormat, strtotime( 'Jan 1, ' . date( 'Y' ) ) + $offset );
    return( $str );
}
 
echo "lets make some dates";
echo "<BR>";
/*
echo $_POST[start1]."<BR>";
echo $_POST[finish1]."<BR>";

echo $_POST[start2]."<BR>";
echo $_POST[finish2]."<BR>";

echo $_POST[start3]."<BR>";
echo $_POST[finish3]."<BR>";

echo $_POST[start4]."<BR>";
echo $_POST[finish4]."<BR>";

*/


$start1 = date('z', strtotime('03-02-2015'));

$start2 = date('z', strtotime('13-04-2015'));

$start3 = date('z', strtotime('14-07-2015'));

$start4 = date('z', strtotime('05-10-2015'));

$finish1 = date('z', strtotime('27-03-2015'));

$finish2 = date('z', strtotime('19-06-2015'));

$finish3 = date('z', strtotime('18-09-2015'));

$finish4 = date('z', strtotime('09-12-2015'));



$curdate = $start1;

echo $start1." ".$finish1."<br>";



//$start_date = strtotime("2015 01 01");

$start_date = '01/01/2015';

echo $start_date."<br>";


for ( $x = 1; $x <=365; $x++) 
{

//date("d",$date)+$days_to_add,

//echo date("d",$curdat)+$x."<BR>";

$dayofweek = DATE(w,intval( intval( $x-1 ) * 86400 ));

$sql = "Insert into DAYS values (";

$sql = $sql . $x;
$sql = $sql . ",0,0,'";
$sql = $sql . dayofyear2date($x-1);
$sql = $sql ."',0,";
$sql = $sql . $dayofweek.")";

$makeday = qry($conn,$sql);
 
//echo $result."<BR>";

//$start_date = strtotime($start_date."+ 1 days");

//$start_date = >add(new DateInterval('P1D'));



$start_date = strtotime($start_date);
$start_date = strtotime("+1 day", $start_date);
$start_date = date('d/m/Y', $start_date);
}

$sd1 = $start1;

echo $sd1."<br>";

$sql = "update DAYS set termnum = 1 ";

$sql = $sql . "where daynum >= $start1 and daynum <= $finish1";

$result = qry($conn,$sql);

$sql = "update DAYS set termnum = 2 ";

$sql = $sql . "where daynum >= $start2 and daynum <= $finish2";

$result = qry($conn,$sql);

$sql = "update DAYS set termnum = 3 ";

$sql = $sql . "where daynum >= $start3 and daynum <= $finish3";

$result = qry($conn,$sql);

$sql = "update DAYS set termnum = 4 ";

$sql = $sql . "where daynum >= $start4 and daynum <= $finish4";

$result = qry($conn,$sql);

$sql = "update DAYS set schoolday = 1 where termnum <> 0 and dayofweek <> 0 and dayofweek <> 6";

$result = qry($conn,$sql);


$sql = " select * from DAYS where termnum <> 0 order by daynum";

$result = qry($conn,$sql);

$last_term = 1;
$week_num = 1;
$count = 0;

while ($days_array = arr($result))
{
	if ($days_array['dayofweek'] == 0)
		{
		$week_num = $week_num + 1;	 
		
		}
if ($days_array['dayofweek'] <>  6 and $days_array['dayofweek'] <>  0)
{
	$sql = "update DAYS set weeknum = ".$week_num." where daynum = ".$days_array['daynum'];

}	
echo $sql."<BR>";

	$week = qry($conn,$sql);
	
	
	if ($last_term <> $days_array['termnum'])
	{
	$week_num = 1;
	$last_term = $days_array['termnum'];

	}
	
}




echo "<ul><li><a href=\"menu.php\">back to user page</a></ul>";
?>