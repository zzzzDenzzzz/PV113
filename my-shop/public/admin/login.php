<?php
session_start();

$admin_id = $_SESSION["admin_id"] ?? null;
if ($admin_id) {
    header("Location: ../app/views/manage_orders.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/assets/style.css">
    <link rel="stylesheet" href="../../public/assets/bootstrap-5.3.3/css/bootstrap.min.css">
    <script defer src="../../public/assets/bootstrap-5.3.3/js/bootstrap.bundle.min.js"></script>
    <title>Авторизация</title>
</head>

<body>
    <section class="vh-100 bg-image" style="background-image: url('../assets/img/img4.webp')">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Вход в админ-панель</h2>
                                <form action="../index.php?controller=admin&action=login" method="post">
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control form-control-lg"
                                            required>
                                    </div>
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password" name="password"
                                            class="form-control form-control-lg" required>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <input type="submit" data-mdb-button-init data-mdb-ripple-init
                                            class="btn btn-success btn-block btn-lg gradient-custom-4 text-body"
                                            value="Войти">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>