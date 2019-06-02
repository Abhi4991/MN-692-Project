<?php 
//Create the client object
$soapclient = new SoapClient('http://www.webservicex.net/ConverPower.asmx?WSDL');

$param = array(
'PowerValue' => '700',
'fromPowerUnit' => 'horsepower',
'toPowerUnit' => 'kilowatts'
);

$response = $soapclient->ChangePowerUnit($param);

var_dump($response);


?>