<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

writehead("AUTO BOOK",$conn,"autobook1L",0);

$term = sessinfo($conn,'term');
$week = sessinfo($conn,'week');
$whichweek = sessinfo($conn,'whichweek');
$firstday = sessinfo($conn,'firstday');
$lastday = sessinfo($conn,'lastday');

sessupdate($conn,'addtutor',2);

$content = "<button type=\"submit\" class=\"label\" disabled><h300>Term ".$term." Week ".$week."</h300></button>";

divmaker(35,20,40,10,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);

$content = "<button type=\"submit\" class=\"label\" disabled><h300>Setting Priority</h300></button>";

divmaker(35,40,40,10,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);


?>
<script type="text/javascript">

window.location.href = "autobook1.php";

</script>


