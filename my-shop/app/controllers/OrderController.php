<?php

class OrderController
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getUserOrders($user_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Orders WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderItems($order_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Order_items WHERE order_id = ?");
        $stmt->execute([$order_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function changeOrderStatus($order_id, $status)
    {
        $stmt = $this->pdo->prepare("UPDATE Orders SET status = ? WHERE id = ?");
        $stmt->execute([$status, $order_id]);
        echo "Статус заказа обновлен";
    }
}