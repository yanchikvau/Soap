<?php
// turn off WSDL caching
ini_set("soap.wsdl_cache_enabled","0");

class Order_info{
	public $order_id;
	public $dish_name;
	public $number_of_servings;
	public $weigth;
	public $date;
	public $price;
}

// model, which uses in web service functions as parameter
function sum_info($order_id){
	$mysqli = @new mysqli('localhost', 'cs35901_bd', 'cs35901_bd', 'cs35901_bd');
	if (mysqli_connect_errno()) {
		echo "Подключение невозможно: ".mysqli_connect_error();
	}
	$mas = array();
	$result_set = $mysqli->query(" SELECT  `order_id`, SUM(`amount`)  AS `total_amount` ,SUM(`price`)  AS `total_price`, MAX(`delivery_date`) AS `date` FROM  `cart_list`  WHERE  `order_id` = '$order_id' GROUP   BY  `order_id`");
	while ($row = $result_set->fetch_assoc()) {
		array_push($mas,$row["total_amount"],$row["total_price"],$row["date"]);
	}
	return $mas;
 }
function dish_num($order_id){
	$mysqli = @new mysqli('localhost', 'cs35901_bd', 'cs35901_bd', 'cs35901_bd');
	if (mysqli_connect_errno()) {
		echo "Подключение невозможно: ".mysqli_connect_error();
	}
	$mas = array();
	$result_set = $mysqli->query("SELECT `name_dish`,`number_of_servings` FROM `orders` WHERE `order_id`='$order_id'");
	while ($row = $result_set->fetch_assoc()) {
		array_push($mas,$row["name_dish"],$row["number_of_servings"]);
	}
	return $mas;
 } 
 
function DeliveryCart($order){
	
	$mas = sum_info($order->order_id);
	$rawPost .= serialize($mas);
    $order_info = new Order_info();
	$order_info->order_id = $order->order_id;
	$mas2 = dish_num($order->order_id);
	$order_info->dish_name = $mas2[0];
	$order_info->number_of_servings = $mas2[1];
	$order_info->weigth = $mas[0];
	$order_info->price = $mas[1];
	$order_info->date = $mas[2];
	return $order_info;
}
// initialize SOAP Server
$server=new SoapServer("test.wsdl"/*,[
	'classmap'=>[
		'book'=>'Book', // 'book' complex type in WSDL file mapped to the Book PHP class
	]
]*/);

// register available functions
$server->addFunction('DeliveryCart');

// start handling requests
$server->handle();