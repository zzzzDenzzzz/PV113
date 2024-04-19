<?php

session_start();

$user_id = $_SESSION["user_id"] ?? null;

if (!$user_id) {
    echo "Пожалуйста, войдите в систему";
    exit;
}

require_once "../config/db.php";
require_once "../controllers/UserController.php";

$userController = new UserController($pdo);
$user = $userController->profile($user_id);

if ($user) {
    echo "<h1>Профиль пользователя</h1>";
    echo "<p>Имя пользователя: " . $user["username"] . "</p>";
    echo "<p>Email: " . $user["email"] . "</p>";
    echo "<a href='/my-shop/public/index.php?controller=user&action=logout'>Выйти</a>";

    echo "<h1>Обновление профиля</h1>";
    echo "<form method='POST' action='/my-shop/public/index.php?controller=user&action=update_profile'>
            <input type='text' name='username' value='" . $user["username"] . "'>";
    echo "<input type='email' name='email' value='" . $user["email"] . "'>";
    echo "<input type='submit' value='Обновить'>";
    echo "</form>";
} else {
    echo "Пользователь не найден";
}