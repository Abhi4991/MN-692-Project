<?php

// Put in the domain name

session_start();

echo "<p> Your session ID is ".session_id()."<p>";

echo SID;



$_SESSION['schooldom1'] = "school1";
print $_SESSION['schooldom1'];

?>
<html>
<META HTTP-EQUIV="REFRESH" CONTENT="1; URL=http://rcphp.com/login.php?<?php echo SID; ?>">
</html>