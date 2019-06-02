<?php
session_start();
session_destroy();
session_set_cookie_params(0, '/', 'antaratest1.com');
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn=mysqli_connect("localhost","antarate_login","!fF7pu)5wiI!","antarate_schdoms");
// Check connection


if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  $sql = "select * from SESSINFO where sess = '".session_id()."'";
  
if (!mysqli_query($conn,$sql))
  {
  echo("Error description: " . mysqli_error($conn));
  }
		
  $result = mysqli_query($conn,$sql);
  
  $num_rows = mysqli_num_rows($result);
  
if ($num_rows == 0)
	{

  $sql = "insert into SESSINFO (sess,schdom) values ('".session_id()."','test')";
    
	}
	
	else
	
	{
	
	$sql = "update SESSINFO set schdom = 'test' where sess = '".session_id()."'";
	
	}
		
if (!mysqli_query($conn,$sql))
	{
	echo("Error description: " . mysqli_error($conn));
	}

mysqli_close($conn);

session_write_close();

?>

<script type="text/javascript">
window.location.href = "https://antaratest1.com/login.php";
exit();
</script>

