<?class Order_info{
	public $order_id;
	public $dish_name;
	public $number_of_servings;
	public $weigth;
	public $date;
	public $price;
}
class Order
{
	public $order_id;
}
$order = new Order();
$order->order_id='17';


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
	print_r($mas);
	return $mas;
 }
 
function DeliveryCart($order){
	//file_put_contents('log.txt', print_r($order,true));
	sum_info($order->order_id);
	
}
DeliveryCart($order);