<?php
// model

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

$list_of_recipes = new List_of_recipes();
$list_of_recipes->list1 = new \ArrayObject();
for($i=0;i<3;i++){
	$recipe = new Recipe();
	$recipe->title = $i;
	$recipe->product_list = new \ArrayObject();
	$product = new Product();
	$product->name = "salmon";
	$product->weigth = "600";
	$soap_msg1 = new \SoapVar($product, SOAP_ENC_OBJECT, null, null, 'product');
	$recipe->product_list->append($soap_msg1);
}
 	$soap_msg1 = new \SoapVar($recipe, SOAP_ENC_OBJECT, null, null, 'recipe');
	$list_of_recipes->list1->append($soap_msg1);
print_r($list_of_recipes);
// initialize SOAP client and call web service function
$client=new SoapClient('http://cs35901.tmweb.ru/Havier2/server.php?wsdl',['trace'=>1,'cache_wsdl'=>WSDL_CACHE_NONE]);
$resp  =$client->push_recipe($list_of_recipes);

// dump response
var_dump($resp);