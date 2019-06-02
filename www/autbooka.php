<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

writehead("AUTO BOOK",$conn,"autobook",0);


//updownweek(80,0);

$numweeks = $_POST['numles'];

sessupdate($conn,"numweeks",$numweeks);

sessupdate($conn,"weeksbooked",0);

sessupdate($conn,"addtutor",1);

$content = $numweeks


divmaker(40,30,20,10,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);

echo "</FORM>
</body>
</html>";


?>
<script type="text/javascript">

//window.location.href = "autobook1.php";

</script>



