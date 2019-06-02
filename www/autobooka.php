<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

writehead("AUTO BOOK",$conn,"autobook",0);


//updownweek(80,0);

$numweeks = $_POST['numles'];

if ($numweeks > 1)
{$s = 's';}
else
{$s='';}

sessupdate($conn,"numweeks",$numweeks);

sessupdate($conn,"weeksbooked",0);

$content = "<button type=\"submit\" class=\"label\" disabled><h200>Preparing to book ".$numweeks." week".$s."</h200></button>";

divmaker(40,30,40,10,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);

echo "</FORM>
</body>
</html>";


?>
<script type="text/javascript">

window.location.href = "autobook1.php";

</script>



