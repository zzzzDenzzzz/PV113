<?
require_once 'app/config/db.php';

$page = $_GET['page'] ?? 1;
$items_per_page = 2;

$start = ($page - 1) * $items_per_page;

$stmt = $pdo->prepare('SELECT * FROM Products LIMIT ?, ?');
$stmt->bindValue(1, $start, PDO::PARAM_INT);
$stmt->bindValue(2, $items_per_page, PDO::PARAM_INT);
$stmt->execute();
$products = $stmt->fetchAll(PDo::FETCH_ASSOC);

foreach ($products as $product): ?>
    <div class="product-item">
        <img class="product-image" src="<?php echo $product['img']; ?>">
        <p class="product-name"><?php echo $product['name']; ?></p>
        <p class="product-price"><?php echo $product['price']; ?>$</p>
        <button class="add-to-cart" data-product-id="<?php echo $product['id']; ?>">Добавить в корзину</button>
    </div>
<?php endforeach; ?>