<?php
include 'opendb.php';
include 'rollgen.php';
include 'dbstuff.php';


writehead("ADD TUTOR",$conn,"tutoradd1",0);


echo "<FORM METHOD=\"POST\" ACTION=\"tutors.php\">";

$content = "<button type=\"submit\" class=\"menu-button\">Back to Tutors</button>";

	divmaker(0,0,20,10,"white","blue","1",""  
,$content);

echo "</FORM>";
        

echo "<form METHOD=\"POST\" ACTION=\"tutoradd2.php\">";

//divmaker(40,40,10,15,"","","","","<div ><INPUT TYPE=\"text\" NAME=\"description\" class = \"mediuminput\" size = \"50\" autofocus/></div>");


//divmaker(25,15,15,7,"","","","","<div class = \"stdlabel\" >First Name: </div>");

divmaker(25,15,20,5,"","","","
text-align: left;","<button type=\"submit\" class= \"label\" disabled><h200>First Name:</h200></button>");



divmaker(43,15,20,15,"","","","","<INPUT TYPE=\"text\" NAME=\"first_name\" class = \"label\" size = \"70\"  autofocus/>");

divmaker(25,25,20,5,"","","","
text-align: left;","<button type=\"submit\" class= \"label\" disabled><h200>Last Name:</h200></button>");

divmaker(43,25,20,15,"","","","","<INPUT TYPE=\"text\" NAME=\"last_name\" class = \"label\" />");

divmaker(25,35,20,5,"","","","
text-align: left;","<button type=\"submit\" class= \"label\" disabled><h200>User Name:</h200></button>");;

divmaker(43,35,20,15,"","","","","<INPUT TYPE=\"text\" NAME=\"user_name\" onfocus=\"this.value=''\" value = \"\" class = \"label\" />");

divmaker(25,45,20,5,"","","","
text-align: left;","<button type=\"submit\" class= \"label\" disabled><h200>Password:</h200></button>");

divmaker(43,45,20,15,"","","","","<INPUT TYPE=\"password\" NAME=\"password\" onfocus=\"this.value=''\" value = \"\" class = \"label\">");


$content = "<button type=\"submit\" class=\"menu-button\" ><h200>Add Tutor</h200></button>";

divmaker(40,55,25,10,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);



echo "</form>

</body>
</html>";


?>