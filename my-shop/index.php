<?php

require_once "app/config/db.php";

$items_per_page = 2;
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$start = ($page - 1) * $items_per_page;

$stmt = $pdo->query("SELECT COUNT(*) FROM Products");
$total_items = $stmt->fetchColumn();

$stmt = $pdo->prepare("SELECT * FROM Products LIMIT ?, ?");
$stmt->bindValue(1, $start, PDO::PARAM_INT);
$stmt->bindValue(2, $items_per_page, PDO::PARAM_INT);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список товаров</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <style>
        .product-item {
            display: inline-block;
            margin: 10px;
        }

        .product-image {
            width: 100px;
        }
    </style>
    <h1>Список товаров</h1>
    <div id="product-list">
        <?php foreach ($products as $product): ?>
            <div class="product-item">
                <img class="product-image" src="<?php echo $product['img']; ?>">
                <p class="product-name"><?php echo $product['name']; ?></p>
                <p class="product-price"><?php echo $product['price']; ?></p>
                <button class="add-to-cart" data-product-id="<?php echo $product['id']; ?>">Добавить в корзину</button>
            </div>
        <?php endforeach; ?>
    </div>
    <div id="pagination">
        <?php for ($i = 1; $i <= ceil($total_items / $items_per_page); $i++): ?>
            <a href="#" class="page-link" data-page="<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>
    <div id="cart">
        Корзина(<span id="cart-count">0</span>)<br>
        <a href="cart.php">Перейти в корзину</a><br>
        <button id="clear-cart">Очистить корзину</button>
    </div>
    <script src="script.js"></script>
</body>

</html>