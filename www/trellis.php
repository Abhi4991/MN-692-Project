<?php
include "opendb.php";
?>
<html>
<head>
<title>Fill the trellis</title>

<STYLE type="text/css">

table
{
width:75%;
border:5px solid blue; 
height:10px;
}

tr
{

background-color: yellow;
height:5px
}
td
{
width:15%;
border: 2px red;
}
th
{

align: center;
color: white;
background-color: blue;

}




</STYLE>


</head>
<body>

 
<?php


for ( $x = 1; $x <=96; $x++) {



	for ( $days = 1; $days <=5; $days++) {
	
	
	
	$sql = "insert into TRELLIS values (";
	
	$sql = $sql. $x;
		
	$sql = $sql. ",";
	
	$sql = $sql. ($days+47);
	
	$sql = $sql. ",0)";
	
	echo $sql."<br>";
	
	
	$result = mysql_query($sql,$conn) or die(mysql_error());
	}



echo "</tr>";




}

 
echo "</table>";

//echo "</div>";

?>

</body>
</html>
