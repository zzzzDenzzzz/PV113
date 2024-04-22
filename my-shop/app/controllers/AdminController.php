<?php

class AdminController
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function login($email, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Admins WHERE email = ?");
        $stmt->execute([$email]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && $password == $admin["password"]) {
            $_SESSION["is_admin"] = true;
            $_SESSION["admin_id"] = $admin["id"];
            header("Location: ../app/views/manage_orders.php");
        } else {
            echo "Неправильный email или пароль";
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: ../public/admin/login.php");
    }

    public function getAllOrders() {
        if (!isset($_SESSION["is_admin"]) || !$_SESSION["is_admin"]) {
            echo "У вас нет доступа на эту страницу";
            exit;
        }
        $stmt = $this->pdo->query("SELECT * FROM Orders");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function changeOrderStatus($order_id, $status) {
        if (!isset($_SESSION["is_admin"]) || !$_SESSION["is_admin"]) {
            echo "У вас нет доступа на эту страницу";
            exit;
        }
        $stmt = $this->pdo->prepare("UPDATE Orders SET status = ? WHERE id = ?");
        $stmt->execute([$status, $order_id]);
    }
}