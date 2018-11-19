<?php
// turn off WSDL caching
ini_set("soap.wsdl_cache_enabled","0");

class Descision
{
	public $order_id;
	public $cart_id;
}
class Descision2
{
	public $order_id;
	public $status;
}

function delete_cart($cart_id, $order_id){
	$mysqli = @new mysqli('localhost', 'cs35901_bd', 'cs35901_bd', 'cs35901_bd');
	if (mysqli_connect_errno()) {
		echo "Подключение невозможно: ".mysqli_connect_error();
	}
	$result_set = $mysqli->query("DELETE FROM `cart_list` WHERE (id_cart !='$cart_id')&&(order_id ='$order_id')");
	 echo "Удалены все корзины кроме $cart_id";  
 } 	
	
function validation($descision){
		delete_cart($descision->cart_id,$descision->order_id);
		
		$descision2 = new Descision2();
		$descision2->order_id = $descision->order_id;
		$descision2->status = "OK";
		//здесь мы отправляем запрос Грише (отправляем $descision)
		return $descision2;
}

// initialize SOAP Server
$server=new SoapServer("test.wsdl"/*,[
	'classmap'=>[
		'book'=>'Book', // 'book' complex type in WSDL file mapped to the Book PHP class
	]
]*/);

// register available functions
$server->addFunction('validation');

// start handling requests
$server->handle();