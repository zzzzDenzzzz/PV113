<?php

require __DIR__ . "/../models/User.php";

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
            $this->function_alert("Пользователь с таким email уже существует", "../public/login.html");
            return;
        }

        $this->userModel->createUser($username, $email, $password);
        $this->function_alert("Регистрация успешна", "../public/login.html");
    }

    public function login($email, $password)
    {
        $user = $this->userModel->getUserByEmail($email);
        if ($user && password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $this->function_alert("Вход успешен!", "../app/views/profile.php");
        } else {
            $this->function_alert("Неверный email или пароль", "../public/login.html");
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        $this->function_alert("Вы вышли из аккаунта", "../public/login.html");
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
        $this->function_alert("Профиль успешно обновлён", "../app/views/profile.php");
    }

    private function function_alert($message, $path)
    {
        echo "<script>alert('$message');window.location.href='$path';</script>";
    }
}