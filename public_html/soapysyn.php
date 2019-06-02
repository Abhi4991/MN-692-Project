<?php 

$paramlist = array ("Surname" =>array("Dowell","Smith"));

   $cars = array("Cars1" =>array("Volvo","BMW","Toyota"));

//Create the client object

$soapclient = new SoapClient('https://synapi.stcatherines.net.au/SynergeticWcfService.svc?wsdl');

$param = array(

'VendorTokenGuid' => 'E524F282-5C75-4EE7-821D-BD491F8AE343',
'VendorPassword' => '50EjWZ11MwqO',
'WebServiceMethodName' => 'UspsCommunityBySurname',
'WebServiceMethodVersionNo' => 1,
'ParameterList' => $paramlist,
'IncludeOutputXMLSchemaFlag' => 1,
'TenantCode' => ''

);

echo " soap client ";

var_dump($soapclient);

echo "<BR>";
echo "<BR>";
echo "<BR>";
print_r($param);



echo "<BR>";
echo "<BR>";
echo "<BR>";

print_r($cars);
echo "<BR>";
echo "<BR>";
echo "<BR>";
echo $cars[Cars1][2];
echo $paramlist[Surname][0];
echo $paramlist[Surname][1];
//$response = $soapclient->UspsCommunityBySurname($param);

$response = $soapclient->RunWebServiceMethod($param);

//print_r($response);

/*
try {
  var_dump($response);
} catch (Exception $e)  {
  var_dump($e->getMessage());
  var_dump($soapclient->__getLastRequest());
  var_dump($soapclient->__getLastResponse());
}
*/
//var_dump($param);

var_dump($response);


/*
$soapclient = new SoapClient('http://www.webservicex.net/ConverPower.asmx?WSDL');

$param = array(
'PowerValue' => '700',
'fromPowerUnit' => 'horsepower',
'toPowerUnit' => 'kilowatts'
);

$response = $soapclient->ChangePowerUnit($param);

var_dump($response);
/*
WcfServiceClient = new SynergeticWcfServiceClient();
           WcfServiceClient.Endpoint.Address = new System.ServiceModel.EndpointAddress(new Uri('https://synapi.stcatherines.net.au/SynergeticWcfService.svc?wsdl'));
           VendorTokenGuid = 'E524F282-5C75-4EE7-821D-BD491F8AE343';
           VendorPassword = '50EjWZ11MwqO';
           ForceTransactionRollbackFlag = 1;
           TenantCode = '';

WebServiceInputParameter inputParameter = new WebServiceInputParameter
           {
               VendorTokenGuid = 'E524F282-5C75-4EE7-821D-BD491F8AE343',
               VendorPassword = '50EjWZ11MwqO',
               ForceTransactionRollbackFlag = 1,
               WebServiceMethodName = ' UspsCommunityBySurname',
               WebServiceMethodVersionNo = 1,
			   
			   $cars = array("Volvo", "BMW", "Toyota");
               ParameterList = 'Dowell',
               IncludeOutputXMLSchemaFlag = 1,
               TenantCode = ''
           };            
 
WebServiceOutputParameter outputParam = WcfServiceClient.RunWebServiceMethod(inputParameter);

*/
?>