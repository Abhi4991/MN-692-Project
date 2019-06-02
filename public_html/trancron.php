<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);


$severname = "localhost";
$username = "rolltut1_login";
$password =  "jji33LM";
$database = "rolltut1_schdoms";
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
    echo "<BR><BR><BR>Doh! failed to copy $copy $local_file...\n";
	}
else{
    echo "<BR><BR><BR>WOOT! success to copy $copy $local_file...\n";
}



?>