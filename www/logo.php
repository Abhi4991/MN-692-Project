<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

writehead("LOGO",$conn,"logo",0);


divmaker(0,0,100,90,"","","","","<svg x=\"0\"
		y=\"0\"
		width=\"100%\"
		height=\"100%\"
		viewBox=\"0 0 900 600\"
		preserveAspectRatio=\"none\">

	<!-- 
	  <rect width=\"1000\" height=\"500\" style=\"fill:rgb(0,0,255);\" /> 
	-->

	  <defs>
		<radialGradient id=\"grad1\" cx=\"50%\" cy=\"50%\" r=\"50%\" fx=\"50%\" fy=\"50%\">
		  <stop offset=\"0%\" style=\"stop-color:#b3e6ff;stop-opacity:.8\" />
		  <stop offset=\"100%\" style=\"stop-color:rgb(0,0,255);stop-opacity:1\" />
		</radialGradient>
		
	  </defs>

	 <polygon points=\"280,130 400,220 520,130 410,230 520,340 400,240 280,340 390,230 280,130\" fill=\"url(#grad1)\" />
	  <polygon points=\"400,20 410,220 620,230 410,240 400,440 390,240 180,230 390,220 400,20\" fill=\"url(#grad1)\" />
	  
	<text x=\"230\" y=\"320\" fill=\"black\" font-family=\"Georgia
\" font-size=\"80\">Antarasky</text>

	<text x=\"280\" y=\"360\" fill=\"black\" font-family=\"Georgia\" font-size=\"25\">Software</text>

	<text x=\"280\" y=\"390\" fill=\"black\" font-family=\"Georgia\" font-size=\"25\">Design</text>

	  
	</svg>");




echo "</body>\n
</html>";

?>


