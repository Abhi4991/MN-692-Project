<?php
include 'opendb.php';
include 'rollgen.php';
include 'dbstuff.php';

$a = session_id();
 
$sql = "select * from SESSINFO where SESS = '$a'";
   
$result = mysqli_query($conn,$sql);
  
$num_rows = mysqli_num_rows($result);
  
if ($num_rows == 0)
{
	$userip = $_SERVER["REMOTE_ADDR"];
  
  $sql = "insert into SESSINFO (SESS,SCHDOM,userip,lasttime,dispday) values 
  ('$a','$schdom','$userip',now(),1)";


/*  $sql = "insert into SESSINFO (SESS,SCHDOM,userip,lasttime,dispday) values 
  ('".$a."','".$schdom."','".$userip."',now(),1)";
*/
  
	$result = mysqli_query($conn,$sql);
}
	
	
	
writehead(
/* Title */ "LOGIN",
/* DB access */ $conn,
/* CSS write */ "login",
/* Full menu */0);

        
divmaker(30,20,35,7,"","","","","<div class = \"label\" ><center>".sessinfo($conn,"loginmess")."</center></div>");


$mobile = mobile($conn);

writehead("MAIN MENU",$conn,"mainmenu",1);

echo "<form METHOD=\"POST\" ACTION=\"userconn.php\">";


bmaker($mobile,25,40,20,7,"label","","","","disabled","<h200>USERNAME:</h200>");
bmaker($mobile,25,50,20,7,"label","","","","disabled","<h200>PASSWORD:</h200> ");

/*
bmaker($mobile,50,40,40,7,"label","","","","disabled","<INPUT TYPE=\"text\" NAME=\"username\" CLASS = \"label\" autofocus/>");

bmaker($mobile,50,50,40,7,"label","","","","disabled","<INPUT TYPE=\"password\" NAME=\"password\" class = \"label\">");

*/

divmaker(50,40,20,7,"","","","","<INPUT TYPE=\"text\" NAME=\"username\" CLASS = \"label\" autofocus />");

divmaker(50,50,20,7,"","","","","<INPUT TYPE=\"password\" NAME=\"password\" CLASS = \"label\" />");

divmaker(50,60,15,10,"","","","","<BUTTON class=\"menu-button\" type = \"submit\" >Enter</BUTTON>");

echo "</form>";

$svg = aslogo();

divmaker(75,75,25,23,"","","","",$svg);

//echo $svg;

echo "
</body>
</html>";

?>
