<?php

class User
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function createUser($username, $email, $password)
    {
        $stmt = $this->pdo->prepare("INSERT INTO Users (username, email, password) VALUES(?, ?, ?)");
        $stmt->execute([$username, $email, password_hash($password, PASSWORD_BCRYPT)]);
        return $this->pdo->lastInsertId();
    }

    public function updateUser($id, $username, $email)
    {
        $stmt = $this->pdo->prepare("UPDATE Users SET username = ?, email = ? WHERE id = ?");
        $stmt->execute([$username, $email, $id]);
    }

    public function getUserById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}