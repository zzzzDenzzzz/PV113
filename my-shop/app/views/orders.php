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
    <title>Мои заказы</title>
</head>

<body>
    <a href="profile.php">Профиль</a><br>
    <?php
    if ($orders) {
        foreach ($orders as $order) {
            echo "<h2> Заказ №" . $order["id"] . "</h2>";
            echo "<p>Дата заказа: " . $order["order_date"] . "</p>";
            echo "<p>Сумма: " . $order["total_amount"] . "</p>";
            echo "<p>Статус: " . $order["status"] . "</p>";
            $items = $orderController->getOrderItems($order["id"]);
            echo "<h3>Товары в заказе:</h3>";
            echo "<ul>";
            foreach ($items as $item) {
                echo "<li>" . $item["product_name"] . " - Количество: " . $item["quantity"] . " - Цена: " . $item["price"] . "рублей за 1 шт. </li>";
            }
            echo "</ul>";
        }
    } else {
        echo "У вас нет заказов";
    }
    ?>
</body>

</html>