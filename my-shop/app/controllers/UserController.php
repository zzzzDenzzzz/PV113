<?php

require "../models/User.php";

class UserController
{
    private $userModel;

    public function __construct(PDO $pdo)
    {
        $this->userModel = new User($pdo);
    }

    public function register($username, $email, $password)
    {
        if ($this->userModel->getUserByEmail($email)) {
            echo "Пользователь с таким email уже существует";
            return;
        }

        $this->userModel->createUser($username, $email, $password);
        echo "Регистрация успешна";
    }

    public function login($email, $password)
    {
        $user = $this->userModel->getUserByEmail($email);
        if ($user && password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            echo "Вход успешен!";
        } else {
            echo "Неверный email или пароль";
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        echo "Вы вышли из аккаунта";
    }

    public function profile($user_id)
    {
        $user = $this->userModel->getUserById($user_id);
        if ($user) {
            return $user;
        } else {
            echo "Пользователь не найден";
        }
    }

    public function updateProfile($user_id, $username, $email)
    {
        $this->userModel->updateUser($user_id, $username, $email);
        echo "Профиль успешно обновлён";
    }
}