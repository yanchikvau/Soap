<?php
// turn off WSDL caching
ini_set("soap.wsdl_cache_enabled","0");


class Cart{
	public $cart_id;
	public $product_list;
}
class Cartlist{
	public $cart;
	
}
class Product_list{
	public $product;
}
class Product{
	public $name;
	public $weight;
	public $delivery_date;
	public $price;
}
class Warehouse{
	public $title;
	public $order_id;
	public $cart_list;

}


function get_info($book)
{
	$warehouse = new Warehouse();
	$warehouse->title = 'buter';
	$warehouse->order_id = '12';
	$warehouse->cart_list = new \ArrayObject();
		$cart = new Cart();
		$cart->cart_id = '123';
		$cart->product_list = new \ArrayObject();
			$product = new Product();
			$product->name = 'колбаса';
			$product->weight = '300';
			$product->delivery_date = '23-12-2019';
			$product->price = '20';
		$soap_msg1 = new \SoapVar($product, SOAP_ENC_OBJECT, null, null, 'Product');
		$cart->product_list->append($soap_msg1);
		$soap_msg2 = new \SoapVar($cart, SOAP_ENC_OBJECT, null, null, 'Cart');
		$warehouse->cart_list->append($soap_msg2);
	return $warehouse;
	
}

// initialize SOAP Server
$server=new SoapServer("warehouse.wsdl"/*,[
	classmap'=>[
		'order'=>'Order', // 'book' complex type in WSDL file mapped to the Book PHP class
	]
]*/);

// register available functions
$server->addFunction('get_info');

// start handling requests
$server->handle();