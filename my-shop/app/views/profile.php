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
    echo "<p>Имя пользователя: " . $user["user_name"] . "</p>";
    echo "<p>Email: " . $user["email"] . "</p>";

    echo "<h1>Профиль пользователя</h1>";
    echo "<form method='POST' action=''>
            <input type='text' name='user_name'> value='" . $user["user_name"] . "'>";
    echo "<input type='email' name='email'> value='" . $user["email"] . "'>";
    echo "<input type='submit' value='Обновить'>";
    echo "</form>";
} else {
    echo "Пользователь не найден";
}