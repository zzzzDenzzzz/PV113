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
        require_once("../app/controllers/AdminController.php");
        $adminController = new AdminController($pdo);
        switch ($action) {
            case "login":
                $email = $_POST["email"] ?? "";
                $password = $_POST["password"] ?? "";
                $adminController->login($email, $password);
                break;
            case "logout":
                $adminController->logout();
                break;
            case "getAllOrders":
                $adminController->getAllOrders();
                break;
            case "changeOrderStatus":
                $order_id = $_POST["order_id"] ?? "";
                $status = $_POST["status"] ?? "";
                $adminController->changeOrderStatus($order_id, $status);
                break;
            default:
                // header("Location: ../admin/login.php");
                break;
        }
        break;
    case "order":
        require_once("../app/controllers/OrderController.php");
        $orderController = new OrderController($pdo);
        switch ($action) {
            case "getUserOrders":
                $user_id = $_SESSION["user_id"] ?? "";
                $orderController->getUserOrders($user_id);
                break;
            case "getOrderItems":
                $order_id = $_POST["order_id"] ?? "";
                $orderController->getOrderItems($order_id);
                break;
            case "changeOrderStatus":
                $order_id = $_POST["order_id"] ?? "";
                $status = $_POST["status"] ?? "";
                $orderController->changeOrderStatus($order_id, $status);
                break;
            default:
            break;
        }
    default:
        echo "Контроллер не найден";
        break;
}