<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

writehead("AUTO BOOK",$conn,"autobook",0);


$term = sessinfo($conn,'term');
$week = sessinfo($conn,'week');

$content = "<button type=\"submit\" class=\"label\" disabled><h300>Term ".$term." Week ".$week."</h300></button>";

divmaker(35,20,40,10,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);

$content = "<button type=\"submit\" class=\"label\" disabled><h300>Booking Lessons</h300></button>";

divmaker(35,40,40,10,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);

?>
<script type="text/javascript">

function autobook3()
{
	window.location.href = "autobook3.php";
}
setTimeout(autobook3,1);
//window.location.href = "autobook3.php";

</script>


