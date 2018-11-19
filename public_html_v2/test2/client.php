<?php

class Order
{
	public $order_id;
	public $dish_name;
    public $number_of_servings;
}

// create instance and set a book name
$order = new Order();
$order ->order_id = '27';
$order->dish_name='buter';
$order->number_of_servings=12;



// initialize SOAP client and call web service function
$client=new SoapClient('http://cs35901.tmweb.ru/test2/server.php?wsdl',['trace'=>1,'cache_wsdl'=>WSDL_CACHE_NONE]);
$resp  =$client->bookYear($order);

// dump response
var_dump($resp);