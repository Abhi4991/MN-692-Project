<?php
include "writecss.php";


function writehead($title,$conn,$csstype,$full)
{
	$a = session_id();
	$sql = "update SESSINFO set lastint = now() - lasttime where SESS = '".$a."'";

	qry($conn,$sql);
	
	if (sessinfo($conn,"now() - lasttime") > 3600 or sessinfo($conn,"lasttime") == 0)
	{
		sessupdate($conn,"loginmess","'Session timed out'");
		$schdom = sessinfo($conn,"SCHDOM");	
		$domainname = sessinfo($conn,"domainname");	
		header("Location: http://$schdom.$domainname");
	}
	else
	{
		$sql = "update SESSINFO set lasttime = now() where SESS = '".$a."'";
		qry($conn,$sql);
	}
	

	echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"";
	echo "\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
	echo "<html lang=\"UTF-8\" xml:lang=\"UTF-8\" xmlns=\"http://www.w3.org/1999/xhtml\">\n";
	echo "<head>\n";

	writecss($conn,$csstype);

	echo "<title>".$title."</title>\n";

	if ($full == 1)
	{
		divmaker(30,1,40,7,"","","","","<h1>Booking System</h1>");
	}
	echo "</head>\n<body>\n";

	if ($full == 1)
	{
				
		$tenum = SESSINFO($conn,"tenum");

		$term = SESSINFO($conn,"term");

		$week = SESSINFO($conn,"week");
				
		$sql = "select School_name from SCHOOLINFO";

		$result = mysqli_query($conn,$sql); //  or die(mysql_error());

		while ($school = mysqli_fetch_array($result)) 
		{

			$schname = $school['School_name'];
			divmaker(30,8,40,7,"","","","","<h1>".$schname."</h1>");
					
			if ($term <> 0)
			{
				divmaker(30,15,40,7,"","","","","<h1> Term ".$term." Week ".$week);
			}
			
		}

	}
}

function sessinfo($conn,$varname)
{
	$a = session_id();

	$sql = "select ".$varname." from SESSINFO where SESS = '".$a."'";

	$selvar = qry($conn,$sql);

	$sql = "update SESSINFO set lasttime = now() where SESS = '".$a."'";

	qry($conn,$sql);

	while ($sess_array = arr($selvar))
	{
		$varval = $sess_array[0];
	}
		return $varval;

}

function sessupdate($conn,$varname,$updateval)
{

	$a = session_id();

	$sql = "select ".$varname." from SESSINFO where SESS = '".$a."'";

	$sql = "update SESSINFO set ".$varname." = ".$updateval." , lasttime = now() where SESS = '".$a."'";

	qry($conn,$sql);
	  
	return ;

}

function lessonlength($conn)
{
	$sql = "Select lessonlength from LESSONLENGTH order by lessonlength";

	$lessonlengtharr = qry($conn,$sql);

	while ($lessonlength = arr($lessonlengtharr))
	{
		$lessonlengtharray[] = $lessonlength['lessonlength'];
	}
	return $lessonlengtharray;
}




function updownweek($across,$down)
{

	$across = $across;
	$down = $down;
	$height = 10;
	$width = 10;
	$posinfo = "text-align: left;position:fixed;";
	

	echo "<FORM METHOD=\"POST\" ACTION=\"weekdown.php\">";

	divmaker($across,$down,$width,$height,"","","",$posinfo,"<button type=\"submit\" class=\"menu-button\" ><h130>Down Week</h130></button> ");

	echo "</FORM>";

	echo "<FORM METHOD=\"POST\" ACTION=\"weekup.php\">";

	divmaker($across+$width,$down,$width,$height,"","","",$posinfo,"<button type=\"submit\" class=\"menu-button\" ><h130>Up Week</h130></button> ");

	echo "</FORM>";

	return;
}

function changeweek($across,$down)
{ 

	echo "<FORM METHOD=\"POST\" ACTION=\"changeweekdown.php\">";

	divmaker($across,$down,10,10,"","","","font-size: 100%;
	text-align: center;","<button type=\"submit\">Update<BR>&#9668</button> ");

	echo "</FORM>";

	echo "<FORM METHOD=\"POST\" ACTION=\"changeweekup.php\">";

	divmaker($across+10,$down,10,10,"","","","font-size: 100%;
	text-align: center;","<button type=\"submit\">Week<BR>&#9658</button> ");

	echo "</FORM>";

	return;
}


function mobile($conn)
{
if ( sessinfo($conn,"sheight") > sessinfo($conn,"swidth"))
	{
		$mobile = True;
	}
	else
	{	
		$mobile = False;
	}
return $mobile;
}

function generateHash($password) 
{
    if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) 
	{
        $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
        return crypt($password, $salt);
	}
}

function verify($password, $hashedPassword) 
{
    return crypt($password, $hashedPassword) == $hashedPassword;
}


function daytime($conn,$blocknum)
{
	$timesql = "Select timedisplay from TIMES where blocknum = ".$blocknum;

	$timearr = qry($conn,$timesql);

	while ($sess_array = arr($timearr))
	{
		$timedisplay = $sess_array[0];
	}
	return $timedisplay;
}

function timesel($conn,$blocknum)
{

	$sql = "select * from TIMES where blocknum >= ".$blocknum." and blocknum <= ".($blocknum+11)." order by blocknum";

	$timedisp = qry($conn,$sql);

	$timesel = "<select name=\"lessontime\" class=\"timesel-button\" >\n";

	while ($time_array = arr($timedisp))
	{
		$timesel = $timesel ."<option value=\"".$time_array['blocknum']."\">"."&nbsp;".$time_array['timedisplay']."</option>\n";
	}

	$timesel = $timesel . "</select >\n";

	return $timesel;
}

function hoursel($conn,$blocknum)
{

	$sql = "select * from TIMES where blocknum >= ".$blocknum." and blocknum < 206 and timedisplay LIKE '%:00%' order by blocknum";

	$hourget = qry($conn,$sql);

	$hoursel = "<select name=\"hour\" class=\"timesel-button\" >\n";

		while ($hour = arr($hourget))
		{
			$hourdisp = $hour['hourdisplay'];
			
			if (strlen($hourdisp) == 1)
			{
				$hourdisp = "0".$hourdisp;
			}
		
			$hoursel = $hoursel ."<option value=\"".$hour['blocknum']."\">"."&nbsp;".$hourdisp.":&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$hour['ampm']."</option>\n";
			
//						$hoursel = $hoursel ."<option value=\"".$hour['blocknum']."\">"."&nbsp;".$hourdisp."<h0>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h0>".$hour['ampm']."</option>\n";
		}

	$hoursel = $hoursel . "</select >\n";

	return $hoursel;
}

function minutesel()
{

	$minsel = "<select name=\"minute\" class=\"timesel-button\" autofocus >\n";

	for ($blocknum = 0;$blocknum<=11;$blocknum++)
	{
		$mindisp = sprintf('%02d',($blocknum*5));
		$minsel = $minsel ."<option value=\"".$blocknum."\">&nbsp;".$mindisp."</option>\n";
	}
	$minsel = $minsel . "</select >\n";

	return $minsel;
}

function daydate($conn,$daynum)
{

	$sql = "select thedate from DAYS where daynum = ".$daynum." and schoolday = 1";

	$time = qry($conn,$sql);

	while($st_array = arr($time))
	{
	  $thedate = $st_array['thedate'];
	}

	return $thedate;
}

function selstudent($conn,$cid)
{
	$stql = "Select * from STUDENTS order by st_last";

	$stud = qry($conn,$stql);

	$sel = "<select name=\"".$cid."\" size = \"30\" >\n";

	while($st_array = arr($stud))
	{
		$sel = $sel . "<option value=\"".$st_array['stnum']."\">"."&nbsp;".$st_array['st_code']."&nbsp;".$st_array['st_first']."&nbsp;".$st_array['st_last']."</option>\n";
	}

	$sel = $sel ."</select>\n";

	return $sel;
}

/*function ttstudent($conn,$cid)
{

$stql = "SELECT * 
FROM COURSE AS CO
INNER JOIN COURSELIST AS CL 
ON CO.coursenum = CL.coursenum
INNER JOIN STUDENTS AS ST
ON CL.stnum = ST.stnum

where CO.tutor = 1

order by ST.st_first,ST.st_last
";

$stud = qry($conn,$stql);


$num_rows = rows($stud);


$sel = "<select name=\"".$cid."\" size = \"".$num_rows."\" >\n";

//size = \"30\"


while($st_array = arr($stud))
{
  $sel = $sel . "<option value=\"".$st_array['coursenum']."\">"."&nbsp;".$st_array['description']."</option>\n";
  
}

$sel = $sel ."</select>\n";

return $sel;

}
*/

function selcourse($conn,$tenum,$selname,$size)
{

	$coql = "Select * from COURSE where tutor = ".$tenum." order by description";

	$cors = qry($conn,$coql) ;

	echo "<select name=\"".$selname."\" size = \"".$size."\" class = \"".$cid."\">";

	while($co_array = arr($cors))
	{
		echo "<option value=\"".$co_array['coursenum']."\">"."&nbsp;".$co_array['description']."</option>\n ";
	}

	echo "</select>";
}

function writexml($xmlstuff,$school,$conn)
{
	$sql = "update xmlcount set xmlnum = xmlnum + 1";

	$xmlnum = qry($conn,$sql);

	$sql = "select xmlnum from xmlcount";

	$xmlnum = qry($conn,$sql);
	
	while ($xml_array = arr($xmlnum))
	{
		$xmlnumber = $xml_array['xmlnum'];
	}
	
	$filename = substr("000000".$xmlnumber,-7);

	$filename = $school."/log/".$filename.".xml";

	
	$file = fopen($filename,"a");
	fwrite($file,$xmlstuff);
	fclose($file);

	$sql = "INSERT INTO numxml (xmltxt) values ('".$xmlstuff."')";

	$result = qry($conn,$sql);

	$xm = simplexml_load_string($xmlstuff);

	return $xm;
}

function updatesql($sqlins,$conn)
{
	$school = SESSINFO($conn,'SCHDOM');
		
	$strlen = strlen($sqlins);

	$sql = "select xmlnum from xmlcount";

	$xmlnum = qry($conn,$sql);

	$xml_array = arr($xmlnum);

	$xmlnumber = $xml_array['xmlnum'];

	$filename = substr("000000".$xmlnumber,-7);

	$filename = $school."/log/".$filename.".txt";

	$file = fopen($filename,"a+");
	fwrite($file,$sqlins.";\r\n");
	fclose($file);	

	$result = qry($conn,$sqlins);

	$newnum = mysqli_insert_id($conn);

	return $newnum;
}

function intext($nametext,$sizenumber,$val)
	{
	
	$intext = "<input type=\"text\" name=\"".$nametext."\" size = ".$sizenumber." value= \"".$val."\"/>";
	return $intext;
 	}

function intnum($styleclass,$namenum,$labeltext,$sizenumber,$val)
{

 echo "<code class = \"".$styleclass."\"</code><label>".$labeltext."</label>";
 
echo "<input type=\"number\" name=\"".$namenum."\" size = \"".$sizenumber."\" value= \"".$val."\"/>";
 
 }
function numsel($styleclass,$namenum,$numbers,$sizenumber,$val)
{
	$numsel = "<select name=\"".$namenum."\" class = \"".$styleclass."\" size = \"".$sizenumber."\" value= \"".$val."\">";
 
	if ($val <> 0)
	{
		$numsel = $numsel .  "<option value=\"".$val."\">";
		$numsel = $numsel . $val;
	}
	for ($i = 0; $i < count($numbers); $i++)
	{
		$numsel = $numsel . "<option value=\"".$numbers[$i]."\">";
		$numsel = $numsel . $numbers[$i];
	}
 
	$numsel = $numsel . "</select>";
	return $numsel;
}
 
function divmaker($left,$top,$width,$height,$bcolor,$color,$border,$misc,$content)
{
	$div = " <div style=\"
	position: absolute; 
	 left: ".$left."%; 
	 top: ".$top."%; 
	 width: ".$width."%; 
	 height: ".$height."%;
	 ".$misc."
	 \">
	  ".$content." </div>\n ";
	  
	echo $div;
}

function bmaker($mobile,$left,$top,$width,$height,$class,$value,$name,$title,$state,$content)
{
	$but = " <div style=\"
	position: absolute; 
	left: ".$left."%; 
	top: ".$top."%; 
	width: ".$width."%; 
	height: ".$height."%; 
	\"><button type = \"submit\" class = \"".$class.
	"\" value = \"".$value.
	"\" name = \"".$name.
	"\" title = \"".$title.
	"\" ".$state.
	">".$content.
	"</button></div>\n ";
	  
	echo $but;
  
}
        
function weekdown($conn)
{
	$term = SESSINFO($conn,"term");
	$week = SESSINFO($conn,"week");

	$sql = "select distinct termnum,weeknum from DAYS where weeknum <> 0 order by termnum desc,weeknum desc";

	$done = qry($conn,$sql);
	 
	$i = 0;
 
	while ($day_array = arr($done))
	{
	 
		If ($i == 1)
		{
			break;
		}
	 
		If ($day_array['termnum'] == $term and $day_array['weeknum'] == $week)
		{
			$i = 1;
		}
	}
	
	$sql = "update SESSINFO set term = ".$day_array['termnum'].", week =".$day_array['weeknum']." where sess = '".session_id()."'";

	$done = qry($conn,$sql);

	$term = SESSINFO($conn,"term");
	$week = SESSINFO($conn,"week");

	$sql = "select * from DAYS where termnum = ".$term." and weeknum = ".$week." order by daynum";  

	$result = qry($conn,$sql);
		 
	while ($day_array = arr($result))
	{
		$daydate[$day_array['dayofweek']-1] = $day_array['daynum'];
	}
		 
	$firstday = $daydate[0];
	$lastday = $daydate[count($daydate)-1];
		  
	$a = session_id();
	  
	$sql = "update SESSINFO set firstday = ".$firstday.",lastday = ".$lastday." where SESS = '".$a."'";

	$result = qry($conn,$sql);
 
	return;	  
}
 
function weekup($conn)
{
	$term = SESSINFO($conn,"term");
	$week = SESSINFO($conn,"week");

	$sql = "select distinct termnum,weeknum from DAYS where weeknum <> 0 order by termnum,weeknum";

	$done = qry($conn,$sql);
 
	$i = 0;
 
	while ($day_array = arr($done))
	{
		If ($i == 1)
		{
			break;
		}
	 
		If ($day_array['termnum'] == $term and $day_array['weeknum'] == $week)
		{
			$i = 1;
		}
	}

	$sql = "update SESSINFO set term = ".$day_array['termnum'].", week =".$day_array['weeknum']." where sess = '".session_id()."'";

	$done = qry($conn,$sql);

	$term = SESSINFO($conn,"term");
	$week = SESSINFO($conn,"week");

	$sql = "select * from DAYS where termnum = ".$term." and weeknum = ".$week." order by daynum";  

	$result = qry($conn,$sql);
		 
		 while ($day_array = arr($result))
		{
			$daydate[$day_array['dayofweek']-1] = $day_array['daynum'];
		}
		 
		$firstday = $daydate[0];
		$lastday = $daydate[count($daydate)-1];
		  
		$a = session_id();
	  
		$sql = "update SESSINFO set firstday = ".$firstday.",lastday = ".$lastday." where SESS = '".$a."'";

		$result = qry($conn,$sql);
} 
  
function termweeksel($conn,$term,$week,$selname,$sizenumber)
{
	$sql = "select * from DAYS WHERE termnum <> 0 and weeknum <> 0 and schoolday = 1 and dayofweek = 1 order by termnum,weeknum";

	$daysdata = qry($conn,$sql);

	$termsel = "<select name=\"".$selname."\" class=\"timesel-button\" >\n";

	while($days = arr($daysdata))
	{
		if ($days['termnum'] == $term and $days['weeknum'] == $week)
		{
			$selected = " selected =\"selected\"";
		}
		else
		{
			$selected = "";
		}

		$termsel .= "<option value=\"".$days['daynum']."\"".$selected.">Term ".$days['termnum']."&nbsp;&nbsp;Week &nbsp;&nbsp;".$days['weeknum']."</option>\n";
	}
	
	$termsel .= "</select>\n";
	
	return $termsel;
}

function seltutor($conn,$selname)
{
	$tenum = sessinfo($conn,'tenum');

	$sql = "Select * from TUTOR order by last_name,first_name";

	$tutordata = qry($conn,$sql);

	$sel = "<select name=\"".$selname."\" class=\"timesel-button\" >\n";

	while($tutor = arr($tutordata))
	{
		if ($tutor['tenum'] == $tenum)
		{
			$selected = " selected ";
		}
		else
		{
			$selected = "";
		}
		
		$sel = $sel . "<option value=\"".$tutor['tenum']."\"".$selected.">"."&nbsp;".$tutor['first_name']."&nbsp;".$tutor['last_name']."</option>\n";
	}

	$sel = $sel ."</select>\n";

	return $sel;
}
/*
function writegrid($mag,$l,$t,$bcolor)
{
for ($x = $t;$x<=18; $x++)
{
	for ($y = $l;$y<=36; $y++)
	{
	
	$left = $y*$mag;
	$top = $x*$mag;
	$width = $mag;
	$height = $mag;
	$border = "solid white 1px";
	$bcolor = "red";
	$color = "";
	$content = $y." ".$x;
	
	
divmaker($left,$top,$width-1,$height-1,$bcolor,$color,$border,$content);
	
	}
	
}

} 
*/

function aslogo()
{
	$svg = "

	<svg x=\"0\"
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
	  
	<text x=\"230\" y=\"320\" fill=\"black\" font-family=\"font-family: Impact, Charcoal, fantasy\" font-size=\"80\">Antarasky</text>

	<text x=\"280\" y=\"360\" fill=\"black\" font-family=\"Verdana\" font-size=\"25\">Software</text>

	<text x=\"280\" y=\"390\" fill=\"black\" font-family=\"Verdana\" font-size=\"25\">Design</text>

	  
	</svg>";
	
	return $svg;
}
?>