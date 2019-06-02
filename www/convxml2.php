<?php

include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";

writehead("Test XML",$conn,"testxml",0);



$sqlins = "DELETE FROM elements";

updatesql($sqlins,$conn);

$value="";
$att1="";
$atv1="";
$att2="";
$atv2="";
$att3="";
$atv3="";
$att4="";
$atv4= "";	

$convfile = sessinfo($conn,"uploadfile");



$xm = simplexml_load_file($convfile);

//echo  $xm->asXML(). "<br>". "<br>". "<br>". "<br>";
//echo  " xml stuff <br>";

//echo $xm->getName() . " top element <br>";
$parent = '';
clearvals();
addelement($conn,1,$parent,$xm->getName(),$value,$att1,$atv1,$att2,$atv2,$att3,$atv3,$att4,$atv4);

$parent1 = $xm->getName();

foreach ($xm->children() as $child)
{
// echo $child->getName() ." second element value ".$child. "<br> ";
$attcount = 0;
clearvals();
$a = '';$b = '';

	foreach($child->attributes() as $a => $b)
	{
	//	  echo $a. " ".$b." <br> ";
	$attcount = $attcount + 1;
	${att.$attcount} = $a;
	${atv.$attcount} = $b;
	}
	addelement($conn,2,$parent1,$child->getName(),$child,$att1,$atv1,$att2,$atv2,$att3,$atv3,$att4,$atv4);
$parent2 = $child->getName();
// echo $child->attributes(). "<br> ";
//   echo $child->getName()->attributes(). "<br> ";
	foreach ($child->children() as $child)
	{
	//	echo $child->getName() ." third element value ".$child. "<br> ";
	$attcount = 0;
	clearvals();
	$a = '';$b = '';
	  
		foreach($child->attributes() as $a => $b)
		{
		//	  echo $a. " ".$b." <br> ";
		$attcount = $attcount + 1;
		${'att'.$attcount} = $a;
		${'atv'.$attcount} = $b;
		}
		addelement($conn,3,$parent2,$child->getName(),$child,$att1,$atv1,$att2,$atv2,$att3,$atv3,$att4,$atv4);
		$parent3 = $child->getName();
//		
		foreach ($child->children() as $child)
		{
		//	  echo $child->getName() . " fourth element value ".$child. "<br> ";
		$attcount = 0;
		clearvals();
		$a = '';$b = '';
			foreach($child->attributes() as $a => $b)
			{
			//	  echo $a. " ".$b." <br> ";
			$attcount = $attcount + 1;
			${'att'.$attcount} = $a;
			${'atv'.$attcount} = $b;
			}
			addelement($conn,4,$parent3,$child->getName(),$child,$att1,$atv1,$att2,$atv2,$att3,$atv3,$att4,$atv4);
			$parent4 = $child->getName();
			
			foreach ($child->children() as $child)
			{
			//		  echo $child->getName() . " fifth element value ".$child. "<br> ";
			$attcount = 0;
			clearvals();
			$a = '';$b = '';
				foreach($child->attributes() as $a => $b)
				{
				//	  echo $a. " ".$b." <br> ";
				$attcount = $attcount + 1;
				${'att'.$attcount} = $a;
				${'atv'.$attcount} = $b;
				}
				addelement($conn,5,$parent4,$child->getName(),$child,$att1,$atv1,$att2,$atv2,$att3,$atv3,$att4,$atv4);
				$parent5 = $child->getName();
				
				foreach ($child->children() as $child)
				{
				//	  echo $child->getName() . " sixth element value ".$child. "<br> ";
				$attcount = 0;
				clearvals();
				$a = '';$b = '';
					foreach($child->attributes() as $a => $b)
					{
					//	  echo $a. " ".$b." <br> ";
					$attcount = $attcount + 1;
					${'att'.$attcount} = $a;
					${'atv'.$attcount} = $b;
					}
					addelement($conn,6,$parent5,$child->getName(),$child,$att1,$atv1,$att2,$atv2,$att3,$atv3,$att4,$atv4);
					$parent6 = $child->getName();		
					foreach ($child->children() as $child)
					{
					//	  echo $child->getName() . " seventh element value ".$child. "<br> ";
					$attcount = 0;
					clearvals();
					$a = '';$b = '';
						foreach($child->attributes() as $a => $b)
						{
						//	  echo $a. " ".$b." <br> ";
						$attcount = $attcount + 1;
						${'att'.$attcount} = $a;
						${'atv'.$attcount} = $b;
						}
						addelement($conn,7,$parent6,$child->getName(),$child,$att1,$atv1,$att2,$atv2,$att3,$atv3,$att4,$atv4);
						$parent7 = $child->getName();							
						foreach ($child->children() as $child)
						{
						//	  echo $child->getName() . " eigth element value ".$child. "<br> ";
						$attcount = 0;
						clearvals();
						$a = '';$b = '';
							foreach($child->attributes() as $a => $b)
							{
							//	  echo $a. " ".$b." <br> ";
							$attcount = $attcount + 1;
							${'att'.$attcount} = $a;
							${'atv'.$attcount} = $b;
							}
							addelement($conn,8,$parent7,$child->getName(),$child,$att1,$atv1,$att2,$atv2,$att3,$atv3,$att4,$atv4);
							$parent8 = $child->getName();							
							foreach ($child->children() as $child)
							{
							//	  echo $child->getName() . " ninth element value ".$child. "<br> ";
							$attcount = 0;
							clearvals();
							$a = '';$b = '';
								foreach($child->attributes() as $a => $b)
								{
								//	  echo $a. " ".$b." <br> ";
								$attcount = $attcount + 1;
								${'att'.$attcount} = $a;
								${'atv'.$attcount} = $b;
								}
								addelement($conn,9,$parent8,$child->getName(),$child,$att1,$atv1,$att2,$atv2,$att3,$atv3,$att4,$atv4);
								$parent9 = $child->getName();	
								
								foreach ($child->children() as $child)
								{
								//	  echo $child->getName() . " ninth element value ".$child. "<br> ";
								$attcount = 0;
								clearvals();
								$a = '';$b = '';
									foreach($child->attributes() as $a => $b)
									{
									//	  echo $a. " ".$b." <br> ";
									$attcount = $attcount + 1;
									${'att'.$attcount} = $a;
									${'atv'.$attcount} = $b;
									}
									addelement($conn,10,$parent9,$child->getName(),$child,$att1,$atv1,$att2,$atv2,$att3,$atv3,$att4,$atv4);
									$parent10 = $child->getName();	
								}
							}
						}
					}
				}
			}
		}
	}
}

$recs = qry($conn,"select count(*) as total from elements");

$numrecs = arr($recs);

$recs = number_format($numrecs['total']);

$content = "<button type=\"submit\" class=\"label\" disabled><h200>$recs Records Extracted</h200></button>";

divmaker(40,20,50,50,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);


$content = "<button type=\"submit\" class=\"label\" disabled><h200>Creating SQL</h200></button>";

divmaker(40,40,50,50,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);


function addelement($conn,$level,$parent,$name,$value,$att1,$atv1,$att2,$atv2,$att3,$atv3,$att4,$atv4)

{
	$value = cleaner($value);
	
	
	
	
	$sqlins = "insert into elements (level,parent,ename,evalue,att1,atv1,att2,atv2,att3,atv3,att4,atv4)
	values ('$level','$parent','$name','$value','$att1','$atv1','$att2','$atv2','$att3','$atv3','$att4','$atv4')";
	
//	echo $sqlins.'<BR>';

	updatesql($sqlins,$conn);
}

function cleaner($string)
{	


$string = str_replace("'", "`", $string);	


//$string = str_replace("'", "&#39;", $string);	

return $string;

}	
	
	
function clearvals()
{
	$value="";
$att1="";
$atv1="";
$att2="";
$atv2="";
$att3="";
$atv3="";
$att4="";
$atv4= "";	
}
?>
<script type="text/javascript">

window.location.href = "convxml3.php";

</script>
