<?php
//Выводит всю таблицу
 function show_table(){
	$mysqli = @new mysqli('localhost', 'cs35901_bd', 'cs35901_bd', 'cs35901_bd');
	 if (mysqli_connect_errno()) {
		echo "Подключение невозможно: ".mysqli_connect_error();
	 }
	$result_set = $mysqli->query("SELECT * FROM `orders` ");
	echo "таблица cart_list <br/>";
	while ($row = $result_set->fetch_assoc()) {
		print_r($row);
		echo "<br />";
	}
	
 }

// Добавляет новый заказ в таблицу orders
//$order_id - номер заказа 
//$name_dish - наименование блюда
//$number_of_servings - количество порций
function add_order($order_id,$name_dish,$number_of_servings){
	$mysqli = @new mysqli('localhost', 'cs35901_bd', 'cs35901_bd', 'cs35901_bd');
	if (mysqli_connect_errno()) {
		echo "Подключение невозможно: ".mysqli_connect_error();
	}
	$result_set = $mysqli->query("INSERT INTO `orders`( `order_id`, `name_dish`, `number_of_servings`) VALUES ('$order_id','$name_dish','$number_of_servings')");
	echo "Создан заказ $order_id  <br/>";
	
 }
 

 
 function get_info($order_id){
	$mysqli = @new mysqli('localhost', 'cs35901_bd', 'cs35901_bd', 'cs35901_bd');
	 if (mysqli_connect_errno()) {
		echo "Подключение невозможно: ".mysqli_connect_error();
	 }
	$result_set = $mysqli->query("SELECT `id`, `order_id`, `name_dish`, `number_of_servings` FROM `orders` WHERE `order_id`= '$order_id'");
	echo "таблица cart_list <br/>";
	while ($row = $result_set->fetch_assoc()) {
		print_r($row);
		echo "<br />";
	}
	
 }
 
$order_id = 27;
$name_dish = 'www';
$number_of_servings = 10;
add_order($order_id,$name_dish,$number_of_servings);
echo "<br />";
show_table();
echo "<br />";
get_info($order_id);
 $result_set->close();
	$mysqli->close(); 
 ?>