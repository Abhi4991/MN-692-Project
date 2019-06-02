<?php
include "opendb.php";


$dirname = "C:/Inetpub/vhosts/rollcallonline.com/httpdocs/".$schdom."/import";

//$dirname = $schdom."/import";
echo $dirname."<BR>";
$dh = opendir($dirname) or die("couldn't open directory");

while (!(($file = readdir($dh)) === false)) {
   if (is_dir("$dirname/$file")) {
           echo "(D) ";
		   }
		   echo "$file<BR>";
		   }
		   closedir($dh);
echo $dirname."<BR>";
		   
echo "<ul><li><a href=\"menu.php\">back to user page</a></ul>";
?>
