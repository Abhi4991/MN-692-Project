<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$severname = "localhost";
$username = "rolltut1_login";
$password =  "jji33LM";
$database = "rolltut1_schdoms";

$conn=mysqli_connect("localhost","rollcal1_login","jji33LM","rollcal1_schdoms");
// Check connection

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  
  $stmt = $conn->prepare("insert into testtable (runtime) values (?)");
  
$stmt->bind_param("s",$runtime);

$runtime = gmdate(DATE_RFC822);
 
$stmt->execute();

  $sql = "select * FROM SCHDOMS"; 
  
 $schdomsdata =  mysqli_query($conn,$sql);

 while ($schdoms = mysqli_fetch_array($schdomsdata))
 
 {
    
  $schusr = $schdoms['DBACCESS1'];
  $schpwd = $schdoms['DBACCESS2'];
  $schdb = $schdoms['schdb'];
 
  $conndb = mysqli_connect("localhost",
                            "rollcal1_".$schusr,
                            $schpwd,"rollcal1_".$schdb);
							
							
$stmt = $conndb->prepare("delete FROM wTTAB");
$stmt->execute();
							
$stmt = $conndb->prepare("delete FROM SESSINFO");
$stmt->execute();					
							
//		  $sql = "delete FROM wTTAB"; 					
							
//		$wdel =  mysqli_query($conndb,$sql);					
		
 }

echo "wTTAB cleared";
echo "SESSINFO cleared";

	session_write_close();

?>