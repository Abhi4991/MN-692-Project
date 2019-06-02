<?php
include 'opendb.php';
?>
<html>
<title>SCHOOL DATE PAGE</title>
<center>
<head>ROLLCALL PHP SYSTEM</head>
</center>
<body>

<FORM METHOD="POST" ACTION="makedays.php">
<P><STRONG>START TERM 1: </STRONG>
<INPUT TYPE="date" NAME="start1"></p>
<P><STRONG>END TERM 1: </STRONG>
<INPUT TYPE="date" NAME="finish1"></p>
<P><STRONG>START TERM 2: </STRONG>
<INPUT TYPE="date" NAME="start2"></p>
<P><STRONG>END TERM 2: </STRONG>
<INPUT TYPE="date" NAME="finish2"></p>
<P><STRONG>START TERM 3: </STRONG>
<INPUT TYPE="date" NAME="start3"></p>
<P><STRONG>END TERM 3: </STRONG>
<INPUT TYPE="date" NAME="finish3"></p>
<P><STRONG>START TERM 4: </STRONG>
<INPUT TYPE="date" NAME="start4"></p>
<P><STRONG>END TERM 1: </STRONG>
<INPUT TYPE="date" NAME="finish4"></p>

<P><INPUT TYPE="SUBMIT" NAME="submit" VALUE="ENTER"></P>
</FORM>

</body>
</html>