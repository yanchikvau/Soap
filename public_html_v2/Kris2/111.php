<?php
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

// create instance and set a book name
	$descision = new Descision();
	$descision->order_id='17';
	$descision->cart_id='2';

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
		return $descision2;
}

print_r(validation($descision));


?>