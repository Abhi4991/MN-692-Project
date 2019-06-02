<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

writehead("UPLOAD iSAMS",$conn,"uploadisams",0);



divmaker(40,45,25,5,"","","","
text-align: left;","<button type=\"submit\"  class=\"label\"  disabled><h200>Uploading Students</h200></button>");

?>
<script type="text/javascript">

window.location.href = "uploadisams2.php";

</script>


