<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";


 function sendSMS($content) {
        $ch = curl_init('https://api.smsbroadcast.com.au/api-adv.php');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec ($ch);
        curl_close ($ch);
        return $output;    
    }

    $username = 'ddowell327';
    $password = 'Mandy327';
    $destination = '0403501341'; //Multiple numbers can be entered, separated by a comma
    $source    = '0421429333';
    $text = 'Hi Andy,
	
You have a lesson at 10:am 9/2/2015

If I can charge $3,00.00 a year then 20 schools I make more than now.

';
    $ref = 'ref12345';
        
    $content =  'username='.rawurlencode($username).
                '&password='.rawurlencode($password).
                '&to='.rawurlencode($destination).
                '&from='.rawurlencode($source).
                '&message='.rawurlencode($text).
                '&ref='.rawurlencode($ref);
  
    $smsbroadcast_response = sendSMS($content);
    $response_lines = explode("\n", $smsbroadcast_response);
    
     foreach( $response_lines as $data_line){
        $message_data = "";
        $message_data = explode(':',$data_line);
        if($message_data[0] == "OK"){
            echo "The message to ".$message_data[1]." was successful, with reference ".$message_data[2]."\n";
        }elseif( $message_data[0] == "BAD" ){
            echo "The message to ".$message_data[1]." was NOT successful. Reason: ".$message_data[2]."\n";
        }elseif( $message_data[0] == "ERROR" ){
            echo "There was an error with this request. Reason: ".$message_data[1]."\n";
        }
    }





/*




ini_set("error_reporting", E_ALL);

//phpinfo();

$to1 = 'antarasky@gmail.com';

$to2 = 'ddowell327@gmail.com';

$subject = 'A test message about a lesson sent to both recipients';
$message = 'Hi Andy,

You have a lesson at 10:am 9/2/2015

Don`t forget your music!';


$headers = 'From: David Dowell<ddowell327@gmail.com>' . PHP_EOL .
    'Reply-To: JDavid Dowell<ddowell327@gmail.com>' . PHP_EOL .
    'X-Mailer: PHP/' . phpversion();
//$headers .= "Content-type: text/plain; charset=iso-8859-1";

mail($to1, $subject, $message, $headers);


mail($to2, $subject, $message, $headers);



/*
// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("ddowell327@gmail.com","My subject",$msg);

*/








//echo "Mail message sent";

	
	


?>



