<?
class List_of_recipes{
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
	print_r($mas);
	return $mas;
 }


	get_dish_names();
	




?>