<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";
include "writegroup.php";


writehead("ADD students",$conn,"add students",0);

echo "<BR>";
echo "<BR>";
echo "<BR>";
echo "<BR>";
echo "<BR>";
echo "<BR>";
echo "<BR>";
echo "<BR>";
echo "<BR>";
echo "<BR>";
echo "<BR>";
for ($mag = 1; $mag<=20; $mag++)
{

$points = ($mag*10)."," .($mag*10)." ".(20*$mag).",".(10*$mag)." ".(20*$mag).",".(20*$mag)." ".(10*$mag).",".(20*$mag)." ".(10*$mag).",".(10*$mag); 

$svg = "

<svg x=\"0\"
    y=\"0\"
    width=\"100%\"
    height=\"100%\"
    viewBox=\"0 0 900 440\"
    preserveAspectRatio=\"none\">
<!-- 
  <rect width=\"800\" height=\"100\" style=\"fill:rgb(0,0,255);\" /> 
-->

  <defs>
    <radialGradient id=\"grad1\" cx=\"50%\" cy=\"50%\" r=\"50%\" fx=\"50%\" fy=\"50%\">
      <stop offset=\"0%\" style=\"stop-color:#b3e6ff;stop-opacity:.4\" />
      <stop offset=\"100%\" style=\"stop-color:rgb(0,0,255);stop-opacity:1\" />
    </radialGradient>
	
  </defs>

 <polygon points=\"".$points." \" fill=\"url(#grad1)\" />


  
</svg>";

//$svg= "<button type=\"submit\">".$svg."</button>";


divmaker(20,20,100,100,"white","blue","1","font-size: 200%;
text-align: center;" 
,$svg);


//echo $svg;

}

for ($mag = 20; $mag<=1; $mag--)
{

$points = ($mag*10)."," .($mag*10)." ".(20*$mag).",".(10*$mag)." ".(20*$mag).",".(20*$mag)." ".(10*$mag).",".(20*$mag)." ".(10*$mag).",".(10*$mag); 

$svg = "

<svg x=\"0\"
    y=\"0\"
    width=\"100%\"
    height=\"100%\"
    viewBox=\"0 0 900 440\"
    preserveAspectRatio=\"none\">
<!-- 
  <rect width=\"800\" height=\"100\" style=\"fill:rgb(0,0,255);\" /> 
-->

  <defs>
    <radialGradient id=\"grad1\" cx=\"50%\" cy=\"50%\" r=\"50%\" fx=\"50%\" fy=\"50%\">
      <stop offset=\"0%\" style=\"stop-color:#b3e6ff;stop-opacity:.4\" />
      <stop offset=\"100%\" style=\"stop-color:rgb(0,0,255);stop-opacity:1\" />
    </radialGradient>
	
  </defs>

 <polygon points=\"".$points." \" fill=\"url(#grad1)\" />


  
</svg>";

//$svg= "<button type=\"submit\">".$svg."</button>";


divmaker(20,20,100,100,"white","blue","1","font-size: 200%;
text-align: center;" 
,$svg);


//echo $svg;

}
echo "<FORM METHOD=\"POST\" ACTION=\"admin.php\">";

$content = "<button type=\"submit\"><h200>Admin Menu</h200></button>";


divmaker(0,0,20,10,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);

echo "</FORM>";

?>