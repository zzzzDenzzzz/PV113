<?php

session_start();

$user_id = $_SESSION["user_id"] ?? null;

if (!isset($_SESSION["user_id"])) {
    echo "Пожалуйста войдите в систему, чтобы посмотреть свои заказы";
    exit;
}

require_once "../config/db.php";
require_once "../controllers/OrderController.php";

$orderController = new OrderController($pdo);
$orders = $orderController->getUserOrders($user_id);

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Товары</title>
</head>

<body>
    <a href="profile.php">Профиль</a><br>
    <?php
    if ($orders) {
        foreach ($orders_item as $item) {
            echo "<h2> Заказ №" . $item["id"] . "</h2>";
            echo "<p>Товар № " . $item["product_id"] . "</p>";
            echo "<p>Товар: " . $item["product_name"] . "</p>";
            echo "<p>Количество: " . $item["quantity"] . "</p>";
            echo "<p>Цена за 1 шт.: " . $item["price"] . "</p>";
            
        }
    } else {
        echo "У вас нет заказов";
    }
    ?>
</body>

</html>