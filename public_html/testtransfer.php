<?php
include "opendb.php";
include 'rollgen.php';
include "dbstuff.php";
include "writegroup.php";

 /**
 * Transfer Files Server to Server using PHP Copy
 * @link https://shellcreeper.com/?p=1249
 */
 
/* Source File URL */
$remote_file_url = 'http://rolltutor.com/test/test.txt';
 
/* New file name and path for this file */
$local_file = 'test/from.txt';
 
/* Copy the file from source url to server */
$copy = copy( $remote_file_url, $local_file );
 
/* Add notice for success/failure */
if( !$copy ) {
    echo "<BR><BR><BR>Doh! failed to copy $copy...\n";
	}
else{
    echo "<BR><BR><BR>WOOT! success to copy $copy...\n";
}

echo "<FORM METHOD=\"POST\" ACTION=\"admin.php\">";

$content = "<button type=\"submit\"><h200>Admin Menu</h200></button>";

divmaker(0,0,20,10,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);

echo "</FORM>";

?>