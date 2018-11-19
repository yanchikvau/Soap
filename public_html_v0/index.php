<?php
  $mysqli = @new mysqli('localhost', 'cs35901_bd', 'cs35901_bd', 'cs35901_bd');
  if (mysqli_connect_errno()) {
    echo "Подключение невозможно: ".mysqli_connect_error();
  }
$dish = 'buter';
$quantity = 2;
   $result_set = $mysqli->query("SELECT * FROM `recipe` WHERE name_dishes='$dish'");
  while ($row = $result_set->fetch_assoc()) {
	$row["quantity_per_serving"] *= $quantity;
    print_r($row);
    echo "<br />";
  }
  echo "###";
  while ($row = $result_set->fetch_assoc()) {
	print_r($row);
    echo "<br />";
  }
  $result_set->close();
  $mysqli->close();
?>