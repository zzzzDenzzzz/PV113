<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    $user_id = NULL;
} else {
    require_once 'app/config/db.php';
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT username FROM Users WHERE id = :userID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':userID', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оформление заказа</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <h1>Корзина</h1>
    <?php if ($user_id): ?>
        <p>Оформляем заказ на имя пользователя: <?php echo $user['username']; ?></p>
    <?php else: ?>
        <p>Хотите отслеживать заказ? <a href="public/login.php">Войдите</a> или <a href="public/register.php">
                зарегистрируйтесь</a></p>
    <?php endif; ?>

    <table id="cart-table">
        <thead>
            <tr>
                <th>Название товара</th>
                <th>Цена за единицу</th>
                <th>Количество</th>
                <th>Итого</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <label for="deleviry-adress">Адрес доставки:</label>
    <input type="text" id="delivery-address" name="deleviry-address">
    <button id="checkout-btn">Оформить заказ</button>
    <div id="total-price" class="total">Общая стоимость: 0$</div>
</body>

</html>