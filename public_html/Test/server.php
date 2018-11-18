<?php
// turn off WSDL caching
ini_set("soap.wsdl_cache_enabled","0");


	class Product{
	public $name;
	public $weigth;
}
class Cart{
	public $product;
}

class Warehouse{
	public $title;
	public $order_id;
	public $cart;

}

function show_table($dish,$order_id){
	$mysqli = @new mysqli('localhost', 'cs35901_bd', 'cs35901_bd', 'cs35901_bd');
	 if (mysqli_connect_errno()) {
		echo "Подключение невозможно: ".mysqli_connect_error();
	 }
	$result_set = $mysqli->query("SELECT * FROM `recipe` WHERE name_dishes='$dish'");
	$warehouse = new Warehouse();
	$warehouse->title = $dish;
	$warehouse->order_id = $order_id;
	$warehouse->cart = new \ArrayObject();
	echo "таблица cart_list <br/>";
	while ($row = $result_set->fetch_assoc()) {
			print_r($row);
		echo "<br />";
		$product = new Product();
		$product->name = $row['name_product'];
		$product->weight = $row['quantity_per_serving'];
		$soap_msg1 = new \SoapVar($product, SOAP_ENC_OBJECT, null, null, 'Product');
		$warehouse->cart->append($soap_msg1);
	
	}
	return $warehouse;
 }
 
 
function bookYear($book)
{
	$warehouse = show_table($book->dishname,$book->order_id);
	return $warehouse;
}

// initialize SOAP Server
$server=new SoapServer("test.wsdl"/*,[
	classmap'=>[
		'order'=>'Order', // 'book' complex type in WSDL file mapped to the Book PHP class
	]
]*/);

// register available functions
$server->addFunction('bookYear');

// start handling requests
$server->handle();