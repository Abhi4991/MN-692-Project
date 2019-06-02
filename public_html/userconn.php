<?php
include 'opendb.php';
include 'rollgen.php';
include 'dbstuff.php';

$user = $_POST['username'];
$pass = $_POST['password'];

$sql = "select * from SCHOOLINFO ";
		
$result = qry($conn,$sql);
		  
$week_array = arr($result);

$term = $week_array['term'];
$week = $week_array['week'];
$whichweek = $week_array['whichweek'];
$domainname = $week_array['domainname'];

$sql = "select * from USERS where USER_NAME = '$user'";
	
$query  = qry($conn,$sql);
$row = arr($query);

if (verify($pass,$row['P_WORD'])) 
{

	if ( strlen($row['first_name']) > 0) 
	{
	 
		$first_name = $row['first_name'];
		$last_name = $row['last_name'];
		$usertype = $row['user_type'];
		$username = $row['USER_NAME'];
		$tenum = $row['tenum'];
		  
		$sql = "select * from DAYS where termnum = ".$term." and weeknum = ".$week." order by daynum";
		  
		$result = qry($conn,$sql);
		 		 
		while ($day_array = arr($result))
		{
			$daydate[$day_array['dayofweek']-1] = $day_array['daynum'];
		}
		 
		$firstday = $daydate[0];
		$lastday = $daydate[4];
		  
		$a = session_id();
	  
		$sql = "update SESSINFO set User_type = ".$usertype.", SCHDOM = '".$schdom."', domainname = '".$domainname."', User_name = '".$username
		."',tenum = ".$tenum.",term = ".$term.",week = ".$week.",firstday = ".$firstday.",lastday = ".$lastday.",whichweek = ".$whichweek." where SESS = '".$a."'";
		
		$result = mysqli_query($conn,$sql);
	  
		sessupdate($conn,"loginmess","''");

		header("Location: menu.php");
	}
}
else 
{
	sessupdate($conn,"loginmess","'Unknown user name or password'");
	header("Location: https://$schdom.$domainname");
	exit;
}

?>


