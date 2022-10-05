<?php require __DIR__ . '/utils/requireAdmin.php' ?>
<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
require __DIR__ .  '/db/ProductsDB.php';
require __DIR__ .  '/db/OrdersDB.php';
require __DIR__ . '/db/OrderedProductsDB.php';

if (!empty($_POST)) {
    $id = $_POST['id'];
    $sum = $_POST['sum'];
    $date = $_POST['date'];

    $orderedProductsDB = new OrderedProductsDB();
    $orderedProducts = $orderedProductsDB->fetchByOrderId($id);
    $productsDB = new ProductsDB();
    $products = array();
    $count = array();
    foreach ($orderedProducts as $row) {
        $products[] = $productsDB->fetchById($row['product_id'])[0];
        $count[$row['product_id']] = $row['quantity'];
    }
} else {
    header('Location: orders.php');
    exit();
}


?>
<?php include __DIR__. '/incl/head.php' ?>
<?php include __DIR__. '/incl/navbar.php' ?>
<main class="container">
    <h1>Orders</h1>
    <br><br>
    <?php if (@$products) : ?>
        <div class="products">    
        <h5 class="card-title">Sum: <?php echo $sum ?></h5>
        <div class="card-subtitle">Date: <?php echo $date ?></div>
            <?php foreach ($products as $row) : ?>
                <div class="card product" style="width: calc(100% / 3)">
                    <div class="card-img-top" style="background-image: url(<?php echo $row['img']; ?>)"></div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['name'] ?></h5>
                        <div class="card-subtitle"><?php echo $row['price'] ?></div>
                        <div class="card-text"><?php echo $row['description'] ?></div>
                        <div class="card-text">Count: <?php echo $count[$row['product_id']] ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div style="margin-bottom: 600px"></div>
    <?php else : ?>
        <h5>Empty</h5>
    <?php endif; ?>
</main>
<?php include __DIR__. '/incl/foot.php'; ?>