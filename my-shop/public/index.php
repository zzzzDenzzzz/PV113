<?php

session_start();

require_once "../app/config/db.php";

$action = $_GET["action"] ?? null;
$controller = $_GET["controller"] ?? "user";

switch ($controller) {
    case "user":
        require_once "../app/controllers/UserController.php";
        $userController = new UserController($pdo);
        switch ($action) {
            case "register":
                $username = $_POST["username"] ?? "";
                $email = $_POST["email"] ?? "";
                $password = $_POST["password"] ?? "";
                $userController->register($username, $email, $password);
                break;
            case "login":
                $email = $_POST["email"] ?? "";
                $password = $_POST["password"] ?? "";
                $userController->login($email, $password);
                break;
            case "logout":
                $userController->logout();
                break;
            case "profile":
                $user_id = $_SESSION["user_id"] ?? null;
                $userController->profile($user_id);
                break;
            case "update_profile":
                $user_id = $_SESSION["user_id"] ?? null;
                $username = $_POST["username"] ?? "";
                $email = $_POST["email"] ?? "";
                $userController->updateProfile($user_id, $username, $email);
                break;
            default:
                header("Location: login.php");
                break;
        }
        break;
    case "admin":
        break;
    default:
        echo "Контроллер не найден";
        break;
}