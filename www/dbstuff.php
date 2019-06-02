<?php
function qry($conn,$sql)
{
	if (! $res = mysqli_query($conn,$sql))
	{
		echo("Error description: " .$sql." ". mysqli_error($conn));
	}
	
	return $res;
	
}

function arr($query)
{
	$arr = mysqli_fetch_array($query);
	return $arr;
}

function rows($query)
{
	$numrow = mysqli_num_rows($query) or die(mysqli_error($conn));
	return $numrow;
}
?>