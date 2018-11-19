<?php
// model
class Order
{
	public $order_id;
}

// create instance and set a book name
$order = new Order();
$order->order_id='17';

// initialize SOAP client and call web service function
$client=new SoapClient('http://cs35901.tmweb.ru/Pasha/server.php?wsdl',['trace'=>1,'cache_wsdl'=>WSDL_CACHE_NONE]);
$resp  =$client->DeliveryCart($order);

// dump response
var_dump($resp);