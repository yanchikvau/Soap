<?php

//Выводит всю таблицу
 function show_table(){
	$mysqli = @new mysqli('localhost', 'cs35901_bd', 'cs35901_bd', 'cs35901_bd');
	 if (mysqli_connect_errno()) {
		echo "Подключение невозможно: ".mysqli_connect_error();
	 }
	$result_set = $mysqli->query("SELECT * FROM `cart_list` ");
	echo "таблица cart_list <br/>";
	while ($row = $result_set->fetch_assoc()) {
		print_r($row);
		echo "<br />";
	}
	
 }

// Добавляет ингридиент в корзину
//$cart_id - id корзины
//$productname - наименование продукта
//$amount - количество продута, необходимое для всех порций
//$delivery_date -  дата доставки в формате ГГГГ-ММ-ДД
//$price -  цена, за это количество продукта
//$order_id - заказа


function add_ingridient($cart_id,$productname,$amount,$delivery_date,$price,$order_id){
	$mysqli = @new mysqli('localhost', 'cs35901_bd', 'cs35901_bd', 'cs35901_bd');
	if (mysqli_connect_errno()) {
		echo "Подключение невозможно: ".mysqli_connect_error();
	}
	$result_set = $mysqli->query("INSERT INTO `cart_list` (`id`, `id_cart`,`product_name`, `amount`, `delivery_date`, `price`,`order_id`) VALUES (NULL, '$cart_id', '$productname', '$amount', '$delivery_date', '$price','$order_id')");
	echo "добавлена корзина $cart_id  <br/>";
	
 }

// Удаляет корзину по её id (id_cart) из таблицы cart_list
//$cart_id - id корзины 
function delete_cart($cart_id, $order_id){
	$mysqli = @new mysqli('localhost', 'cs35901_bd', 'cs35901_bd', 'cs35901_bd');
	if (mysqli_connect_errno()) {
		echo "Подключение невозможно: ".mysqli_connect_error();
	}
	$result_set = $mysqli->query("DELETE FROM `cart_list` WHERE (id_cart !='$cart_id')&&(order_id ='$order_id')");
	 echo "Удалены все корзины кроме $cart_id";  
	$result_set->close();
	$mysqli->close();
 } 
	
//delete_cart(18,20);


// собирает общую информацию о корзине $cart_id
//подсчитывает общий вес, итоговую дату доставки, общую стоимость
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
 


$cart_id = 18;
$order_id = 20;
$productname = 'www';
$amount = 10;
$delivery_date =  '2018-12-14';
$price = 200;
add_ingridient($cart_id,$productname,$amount,$delivery_date,$price,$order_id);

	

//--показать таблицу---
show_table();
echo "<br />";

$cart_id = 18;
sum_info($cart_id);


 
 $result_set->close();
	$mysqli->close(); 
?>