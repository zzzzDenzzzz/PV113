<?php

session_start();

$user_id = $_SESSION["user_id"] ?? null;

if (!isset($_SESSION["user_id"])) {
    $user_id = null;
} else {
    require_once "../config/db.php";
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT username FROM Users WHERE id = :userId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":userId", $user_id, PDO::PARAM_INT);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title>Оформление заказа</title>
</head>

<body>
    <h1>Корзина</h1>
    <?php if ($user_id): ;?>
        <p><?php; ?></p>
    <?php endif; ?>
</body>

</html>