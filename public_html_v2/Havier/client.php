<?php
// model
class Status_OK
{
	public $status_ok;
}

// create instance and set a book name
$status_ok = new Status_OK();
$status_ok->status_ok='OK';
// initialize SOAP client and call web service function 
$client=new SoapClient('http://cs35901.tmweb.ru/Havier/server.php?wsdl',['trace'=>1,'cache_wsdl'=>WSDL_CACHE_NONE]);
$resp  =$client->SentRecipe($status_ok);

// dump response
?><pre><?print_r($resp);?></pre><?