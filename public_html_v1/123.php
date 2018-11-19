<?php
class Cart_list{
	public $carts;
	public $order_id;
}
class Carts{
	public $cart;
}
class Cart{
	public $cart_id;
	public $product_list;
	public $date;
	public $total_price;
}
class Product_list{
	public $product;
}
class Product{
	public $name;
	public $weight;
	public $price;
}

?>
<?//_______________________________________________________________________________________________//?>
<?
function add_ingridient($cart_id,$productname,$amount,$delivery_date,$price,$order_id){
	$mysqli = @new mysqli('localhost', 'cs35901_bd', 'cs35901_bd', 'cs35901_bd');
	if (mysqli_connect_errno()) {
		echo "Подключение невозможно: ".mysqli_connect_error();
	}
	$result_set = $mysqli->query("INSERT INTO `cart_list` (`id`, `id_cart`,`product_name`, `amount`, `delivery_date`, `price`,`order_id`) VALUES (NULL, '$cart_id', '$productname', '$amount', '$delivery_date', '$price','$order_id')");
	echo "добавлена корзина $cart_id  <br/>";
	
 }


 function put_order_to_table($order_id,$dish_name,$number_of_servings){
	$mysqli = @new mysqli('localhost', 'cs35901_bd', 'cs35901_bd', 'cs35901_bd');
	if (mysqli_connect_errno()) {
		echo "Подключение невозможно: ".mysqli_connect_error();
	}
	$result_set = $mysqli->query("INSERT INTO `orders`(`id`, `order_id`, `name_dish`, `number_of_servings`) VALUES (NULL,'$order_id','$dish_name','$number_of_servings')");
	echo "добавлен заказ $order_id  <br/>";
	
	}
	
 function sum_info($cart_id){
	$mysqli = @new mysqli('localhost', 'cs35901_bd', 'cs35901_bd', 'cs35901_bd');
	if (mysqli_connect_errno()) {
		echo "Подключение невозможно: ".mysqli_connect_error();
	}
	$result_set = $mysqli->query(" SELECT  `id_cart`, SUM(`amount`)  AS `total_amount` ,SUM(`price`)  AS `total_price`, MAX(`delivery_date`) AS `date` FROM  `cart_list`  WHERE  `id_cart` = $cart_id GROUP   BY  `id_cart`");
	while ($row = $result_set->fetch_assoc()) {
		print_r($row);
		echo "<br />";
	}
	
 }
 
  function select_cart_id($order_id){
	$mysqli = @new mysqli('localhost', 'cs35901_bd', 'cs35901_bd', 'cs35901_bd');
	if (mysqli_connect_errno()) {
		echo "Подключение невозможно: ".mysqli_connect_error();
	}
	$result_set = $mysqli->query("SELECT `id_cart` FROM `cart_list` WHERE order_id ='$order_id' GROUP BY id_cart");
	$mas = array();
	while ($row = $result_set->fetch_assoc()) {
		foreach($row as $row){
		array_push($mas,$row);
		
	}
 }
 return $mas;
  }
 
function select_products_to_cart($cart_id){
	$mysqli = @new mysqli('localhost', 'cs35901_bd', 'cs35901_bd', 'cs35901_bd');
	if (mysqli_connect_errno()) {
		echo "Подключение невозможно: ".mysqli_connect_error();
	}
	$result_set = $mysqli->query("SELECT `product_name`,`amount`,`price` FROM `cart_list` WHERE `id_cart`='$cart_id'");
	$product_list = new \ArrayObject();
	while ($row = $result_set->fetch_assoc()) {
		$product = new Product();
		$product->name = $row["product_name"];
		$product->weight = $row["amount"];
		$product->price = $row["price"];
		//$soap_msg1 = new \SoapVar($product, SOAP_ENC_OBJECT, null, null, 'Product');
		$product_list->append($product);
	
	}
	return $product_list;
	
}

 
 function sum_data($cart_id){
	$mysqli = @new mysqli('localhost', 'cs35901_bd', 'cs35901_bd', 'cs35901_bd');
	if (mysqli_connect_errno()) {
		echo "Подключение невозможно: ".mysqli_connect_error();
	}
	$array = array();
	$result_set = $mysqli->query("SELECT  `id_cart`, SUM(`price`) AS `total_price`, MAX(`delivery_date`) AS `date` FROM  `cart_list`  WHERE  `id_cart` = '$cart_id' GROUP   BY  `id_cart`");
	while ($row = $result_set->fetch_assoc()) {
		$date = $row["date"];
		$total_price = $row["total_price"];
		array_push($array,$date);
		array_push($array,$total_price);
	}
	return $array;
 }

 
?>
 <?//_______________________________________________________________________________________________//?>
 
<?	$homepage = file_get_contents('http://cs35901.tmweb.ru/xml/from_Grisha.xml');
	$xml=simplexml_load_string($homepage) or die("Error: Cannot create object");

	$order_id = $xml->order_id[0];

		foreach(($xml->cart_list->cart) as $cart){
			$cart_id = $cart->cart_id;
			foreach(($cart->product_list->product) as $product){
				$productname = $product->name;
				$weigth = $product->weigth;
				$devilery_date = $product->devilery_date;
				$price = $product->price;
				//add_ingridient($cart_id,$productname,$weigth,$delivery_date,$price,$order_id);
			}
		}
		
$cart_list = new Cart_list(); 
$carts = new \ArrayObject();
$cart_list->order_id = $order_id;
$mass_or = select_cart_id($order_id);
foreach($mass_or as $id_cart){
	$cart = new Cart();
	select_products_to_cart($id_cart);
	$cart->cart_id = $id_cart;
	$product_list = select_products_to_cart($id_cart);
	$cart->product_list = $product_list;
	$date_price = sum_data($id_cart);
	
	$cart->date =  $date_price[0];
	$cart->total_price = $date_price[1]; 
	$carts->append($cart);
}
$cart_list->carts = $carts;
//$rawPost .= serialize($cart_list);
file_put_contents('filename.txt', print_r($cart_list, true));

?>
<pre><?print_r($cart_list)?></pre>
