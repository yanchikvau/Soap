<?php

//Выводит всю таблицу
 function show_table(){
	$mysqli = @new mysqli('localhost', 'cs35901_bd', 'cs35901_bd', 'cs35901_bd');
	 if (mysqli_connect_errno()) {
		echo "Подключение невозможно: ".mysqli_connect_error();
	 }
	$result_set = $mysqli->query("SELECT * FROM `recipe` ");
	echo "таблица recipe <br/>";
	while ($row = $result_set->fetch_assoc()) {
		print_r($row);
		echo "<br />";
	}
	$result_set->close();
	$mysqli->close();
 }
  
//получает список продуктов для рецепт $dish
 function get_recipe($dish){
	 $mysqli = @new mysqli('localhost', 'cs35901_bd', 'cs35901_bd', 'cs35901_bd');
	 if (mysqli_connect_errno()) {
		echo "Подключение невозможно: ".mysqli_connect_error();
	}
	$result_set = $mysqli->query("SELECT * FROM `recipe` WHERE name_dishes='$dish'");
	echo "реепт блюда $dish <br/>";
	while ($row = $result_set->fetch_assoc()) {
		print_r($row);
		echo "<br />";
	}
	$result_set->close();
	$mysqli->close();
 }
  
// Добавляет новый рецепт в таблицу
//$dishname - название блюда 
//$productname - наименование продукта
//$amount - количество продута, необходимое для одной порции блюда
function add_ingridient($dishname,$productname,$amount){
	$mysqli = @new mysqli('localhost', 'cs35901_bd', 'cs35901_bd', 'cs35901_bd');
	if (mysqli_connect_errno()) {
		echo "Подключение невозможно: ".mysqli_connect_error();
	}
	$result_set = $mysqli->query("INSERT INTO `recipe` (`id`, `name_dishes`, `name_product`, `quantity_per_serving`) VALUES (NULL, '$dishname', '$productname', '$amount')");
	echo "лобавлен ингридиент $productname к рецепту блюда $dish <br/>";
	$result_set->close();
	$mysqli->close();
 }
	
/*
//---добавить блюдо---
$dishname = 'pelmen';
$productname = 'testo';
$amount = 500;
add_ingridient($dishname,$productname,$amount);
*/

//---выводит рецепт блюда бутер---
$dish = 'buter';
get_recipe($dish ) ;
echo "<br /><br />";
//--показать таблицу---
show_table();
 
  
?>