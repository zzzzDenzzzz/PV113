<?php

session_start();

if (!isset($_SESSION["is_admin"]) || !$_SESSION["is_admin"]) {
    echo "У вас нет доступа на эту страницу";
    exit;
}

require_once "../config/db.php";
require_once "../controllers/AdminController.php";

$adminController = new AdminController($pdo);
$orders = $adminController->getAllOrders();

?>

<!DOCTYPE html>
<html lang="ru">    

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление заказами</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Id заказа</th>
                <th>Пользователь</th>
                <th>Дата создания</th>
                <th>Общая сумма</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
        </thead>    
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo $order["id"] ?></td>
                    <td><?php echo $order["user_id"]; ?></td>
                    <td><?php echo $order["order_date"]; ?></td>
                    <td><?php echo $order["total_amount"]; ?></td>
                    <td><?php echo $order["status"]; ?></td>
                    <td><a href="order_items.php?order_id=<?php echo $order['id']; ?>">Товары в заказе</a></td>
                    <td>
                        <form action="/my-shop/public/index.php?controller=admin&action=changeOrderStatus" method="post">
                            <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                            <select name="status">
                                <option value="Pending">В обработке</option>
                                <option value="Shipped">Отправлен</option>
                                <option value="Delivered">Доставлен</option>
                            </select>
                            <input type="submit" value="Изменить статус">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/my-shop/public/index.php?controller=admin&action=logout">Выйти</a>
</body>

</html>