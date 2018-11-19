<?php
// turn off WSDL caching
ini_set("soap.wsdl_cache_enabled","0");

class List_of_recipes{
	public $list1;
}
class List1{
	public $recipe;
}
class Recipe{
	public $title;
	public $product_list;
}
class Product_list{
	public $product;
}
class Product{
	public $name;
	public $weigth;
}
 
 function get_dish_names(){
	 $mysqli = @new mysqli('localhost', 'cs35901_bd', 'cs35901_bd', 'cs35901_bd');
	 if (mysqli_connect_errno()) {
		echo "Подключение невозможно: ".mysqli_connect_error();
	 }
	   
	$result_set = $mysqli->query("SELECT `name_dishes` FROM `recipe` GROUP BY `name_dishes`");
	$mas = array();
	while ($row = $result_set->fetch_assoc()) {
		array_push($mas,$row["name_dishes"]);
	}
	return $mas;
 }

function get_recipe($title){
	$mysqli = @new mysqli('localhost', 'cs35901_bd', 'cs35901_bd', 'cs35901_bd');
	 if (mysqli_connect_errno()) {
		echo "Подключение невозможно: ".mysqli_connect_error();
	 }
	$recipe = new Recipe();
			$recipe->title = $title;
			$recipe->product_list = new \ArrayObject();
			
	$result_set = $mysqli->query("SELECT * FROM `recipe` WHERE `name_dishes` = '$title'");
	while ($row = $result_set->fetch_assoc()) {
		$product = new Product();
		$product->name = $row["name_product"];
		$product->weigth = $row["quantity_per_serving"];
		$soap_msg1 = new \SoapVar($product, SOAP_ENC_OBJECT, null, null, 'product');
		$recipe->product_list->append($soap_msg1);
	}
	
	return $recipe;
}
 
function SentRecipe($status_ok){
	$list_of_recipes = new List_of_recipes();
	$list_of_recipes->list1 = new \ArrayObject();
	$mas = get_dish_names();
	foreach($mas as $title){
		$recipe = get_recipe($title);	
		$soap_msg1 = new \SoapVar($recipe, SOAP_ENC_OBJECT, null, null, 'List1');
		$list_of_recipes->list1->append($soap_msg1);
	}
	file_put_contents("log2.txt",print_r($list_of_recipes->list1,true));
	return $list_of_recipes;
}
// initialize SOAP Server
$server=new SoapServer("test.wsdl"/*,[
	'classmap'=>[
		'book'=>'Book', // 'book' complex type in WSDL file mapped to the Book PHP class
	]
]*/);

// register available functions
$server->addFunction('SentRecipe');

// start handling requests
$server->handle();