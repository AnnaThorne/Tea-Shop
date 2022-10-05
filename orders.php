<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
require __DIR__ . '/db/ProductsDB.php';
require __DIR__ . '/db/OrdersDB.php';
require __DIR__ . '/db/OrderedProductsDB.php';
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $ordersDB = new OrdersDB();
    $orders = $ordersDB->fetchByUserId($id);
}

?>
<?php include __DIR__ . '/incl/head.php' ?>
<?php include __DIR__ . '/incl/navbar.php' ?>
<main class="container">
    <h1>Orders</h1>
    <br><br>
    <a href="index.php">Back to shopping</a>
    <br><br>
    <?php if (@$orders) : ?>
        <div class="orders">
            <?php foreach ($orders as $row) : ?>
                <div class="card product" style="width: calc(100% / 3)">
                    <div class="card-body">
                        <h5 class="card-title">Sum: <?php echo $row['price'] ?></h5>
                        <div class="card-subtitle">Date: <?php echo $row['date'] ?></div>
                        <form action="order.php" method="POST">
                            <input class="d-none" name="id" value="<?php echo $row['order_id'] ?>">
                            <button type="submit" class="btn btn-danger">View details</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div style="margin-bottom: 600px"></div>
    <?php else : ?>
        <h5>Empty</h5>
        <div style="margin-bottom: 600px"></div>
    <?php endif; ?>
</main>
<?php include __DIR__ . '/incl/foot.php'; ?>