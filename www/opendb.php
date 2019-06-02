<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

$conn=mysqli_connect("localhost","antarate_login","!fF7pu)5wiI!","antarate_schdoms");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  //$schdom = 'school1';
  
 $sql = "select * from SESSINFO where sess = '".session_id()."'";
 
  $result =  mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($result);
	

 $schdom = $row['schdom'];
  
 $sql = "select * FROM SCHDOMS where SUBDOM = '".$schdom."'"; 
  
   
//  echo session_id()." school ".$schdom;
  
 $result =  mysqli_query($conn,$sql);
 
   
  $row=mysqli_fetch_array($result);
  
  $schusr = $row['DBACCESS1'];
  $schpwd = $row['DBACCESS2'];
  $schdb = $row['schdb'];
  
  
//  echo $sql."<br>"."school ".$row['schdb'];
  
//    echo $sql."<br>"."pwd ".$schpwd;
	
	$conn = mysqli_connect("localhost",
                            "antarate_".$schusr,
                            $schpwd,"antarate_".$schdb);
							
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  //session_destroy();
  
  }

?>