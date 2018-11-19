<?php
// model
class Descision
{
	public $order_id;
	public $cart_id;
}

// create instance and set a book name
	$descision = new Descision();
	$descision->order_id='17';
	$descision->cart_id='2';

// initialize SOAP client and call web service function
$client=new SoapClient('http://cs35901.tmweb.ru/Kris2/server.php?wsdl',['trace'=>1,'cache_wsdl'=>WSDL_CACHE_NONE]);
$resp  =$client->validation($descision);

// dump response
var_dump($resp);