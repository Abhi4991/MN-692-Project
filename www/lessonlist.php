<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

writehead("LESSONS",$conn,"lessonlist",0);

updownweek(80,0,False);

$term = SESSINFO($conn,"term");
$week = SESSINFO($conn,"week");

$firstday = SESSINFO($conn,"firstday");

$lastday = SESSINFO($conn,"lastday");

$lastday = SESSINFO($conn,"lastday");

$lessonorder =  SESSINFO($conn,"tempnum");


divmaker(15,0,30,10,"white","blue","","position: fixed;
" ,"<button type=\"submit\" class= \"labelwhite\" disabled><h200><center>Term ".$term." Week ".$week."</center></h200></button>");

$sql = "SELECT * FROM LESSON le 
inner join COURSE co 
on le.coursenum = co.coursenum
inner join TUTOR tu
on co.tutor = tu.tenum
inner join COURSELIST cl 
on co.coursenum = cl.coursenum
inner join STUDENTS st 
on cl.stnum = st.stnum
inner join TRELLIS tr
on le.lesson_num = tr.lessonnum
inner join DAYS da 
on tr.daynum = da.daynum
inner join TIMES ti
on tr.block = ti.blocknum

where tr.daynum >= ".$firstday." and tr.daynum <= ".$lastday;

if ($lessonorder == 0)
{
	$sql .=" order by st_last,st_first,tr.daynum,tr.block";
}
else
{
	$sql .=" order by last_name,first_name,tr.daynum,tr.block";
}



$lessonarray = qry($conn,$sql);

$y = 15;

while ($lessoninfo = arr($lessonarray))

{

	$lineinfo = $lessoninfo['description']." with ".$lessoninfo['first_name']." ".$lessoninfo['last_name']." on ".$lessoninfo['thedate']." at ".$lessoninfo['timedisplay']." for ".(5*$lessoninfo['lesson_length'])." minutes" ;

	$content = "<button type=\"submit\" class=\"menu-button\" disabled >";
		
	$content = $content ."<h150>".$lineinfo."</h150></button>";

	divmaker(0,$y,80,10,"white","blue","1",""
	,$content);
	
	$y = $y + 10;

}	

echo "<FORM METHOD=\"POST\" ACTION=\"lessonlist1.php\">";

if ($lessonorder == 0)
{
	divmaker(50,0,25,10,"white","blue","1","
	text-align: center;" 
	,"<button type=\"submit\" class=\"menu-button\" ><h200>Order By Student</h200></button>");
}
else
{
	divmaker(50,0,25,10,"white","blue","1","
	text-align: center;" 
	,"<button type=\"submit\" class=\"menu-button\" ><h200>Order By Tutor</h200></button>");
}

echo "</FORM>\n";

echo "<FORM METHOD=\"POST\" ACTION=\"admin.php\">";

		divmaker(0,0,15,10,"white","blue","1","
text-align: center;" 
,"<button type=\"submit\" class=\"menu-button\" ><h200>Back to Admin</h200></button>");

echo "</FORM>\n";



echo "</body>\n
</html>";
?>