<?php

class User
{

    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function createUser(string $username, string $email, string $password)
    {
        $stmt = $this->pdo->prepare("INSERT INTO Users (username, email, password) VALUES(?, ?, ?)");
        $stmt->execute([$username, $email, password_hash($password, PASSWORD_BCRYPT)]);
        return $this->pdo->lastInsertId();
    }

    public function updateUser(int $id, string $username, string $email)
    {
        $stmt = $this->pdo->prepare("UPDATE Users SET user_name = ?, email = ? WHERE id = ?");
        $stmt->execute([$username, $email, $id]);
    }

    public function getUserById(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByEmail(string $email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}