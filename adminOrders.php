<?php require __DIR__ . '/utils/requireAdmin.php' ?>
<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
require __DIR__ .  '/db/ProductsDB.php';
require __DIR__ .  '/db/OrdersDB.php';
require __DIR__ .  '/db/UsersDB.php';
require __DIR__ . '/db/OrderedProductsDB.php';
    $usersDB = new UsersDB();
    $ordersDB = new OrdersDB();
    $orders = $ordersDB->fetchAll();
?>
<?php include __DIR__ . '/incl/head.php' ?>
<?php include __DIR__ . '/incl/navbar.php' ?>
<main class="container">
    <h1>Orders</h1>
    <br><br>
    <?php if (@$orders) : ?>
        <div class="orders">
            <?php foreach ($orders as $row) : ?>
                <div class="card product" style="width: calc(100% / 3)">
                    <div class="card-body">
                        <h5 class="card-title">User: <?php echo $row['email'] ?></h5>
                        <h5 class="card-title">Sum: <?php echo $row['price'] ?></h5>
                        <div class="card-subtitle">Date: <?php echo $row['date'] ?></div>
                        <form action="adminOrder.php" method="POST">
                            <input class="d-none" name="id" value="<?php echo $row['order_id'] ?>">
                            <input class="d-none" name="date" value="<?php echo $row['date'] ?>">
                            <input class="d-none" name="sum" value="<?php echo $row['price'] ?>">
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