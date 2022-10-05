<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
require __DIR__ . '/db/ProductsDB.php';
require __DIR__ . '/db/OrdersDB.php';
require __DIR__ . '/db/OrderedProductsDB.php';
$ids = @$_SESSION['cart'];
if (is_array($ids) && count($ids)) {
    $question_marks = str_repeat('?,', count($ids) - 1) . '?';

    $productsDB = new ProductsDB();
    $products = $productsDB->fetchForCart($question_marks, $ids);
    $count = array_count_values($ids);
    $sum = 0;
    $totalProducts = 0;
    foreach ($products as $row) {
        $sum += $row['price'] * $count[$row['product_id']];
        $totalProducts += $count[$row['product_id']];
    }
}
if (!empty($_POST)) {
    $id = $_SESSION['id'];
    $ordersDB = new OrdersDB();
    $date = date("Y-m-d h:i:s");

    $ordersDB -> create(['price' => $sum, 'date' => $date, 'user_id' => $id]);
    $order = $ordersDB -> fetchByDateUserId($id, $date)[0];

    $orderedProductsDB = new OrderedProductsDB();
    foreach ($products as $row) {
        $orderedProductsDB -> create(['order_id' => $order['order_id'], 'product_id' => $row['product_id'], 'quantity' => $count[$row['product_id']]]);
    }

    foreach ($_SESSION['cart'] as $key => $value){
        unset($_SESSION['cart'][$key]);
    }
    header('Location: orders.php');
    exit();

}
?>



<?php include __DIR__ . '/incl/head.php' ?>
<?php include __DIR__ . '/incl/navbar.php' ?>
<main class="container">
    <h1>Shopping cart</h1>
    <?php if (@$products) : ?>
    <h5>Total products selected: <?php echo $totalProducts ?></h5>
    <h5>Sum: <?php echo $sum ?></h5>
    <br><br>
    <a href="index.php">Back to shopping</a>
    <br><br>
        <div class="products">
            <?php foreach ($products as $row) : ?>
                <div class="card product" style="width: calc(100% / 3)">
                    <div class="card-img-top" style="background-image: url(<?php echo $row['img']; ?>)"></div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['name'] ?></h5>
                        <div class="card-subtitle"><?php echo $row['price'] ?></div>
                        <div class="card-text"><?php echo $row['description'] ?></div>
                        <div class="card-text">Count: <?php echo $count[$row['product_id']] ?></div>
                        <form action="./utils/remove-item.php" method="POST">
                            <input class="d-none" name="id" value="<?php echo $row['product_id'] ?>">
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <form method="POST">
            <div class="form-group">
                <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
            </div>
            <button class="btn btn-primary" type="submit">Order!</button>
        </form>
        <div style="margin-bottom: 600px"></div>
    <?php else : ?>
        <a href="index.php">Back to shopping</a>
        <h5>Empty</h5>
        <div style="margin-bottom: 600px"></div>
    <?php endif; ?>
</main>
<?php include __DIR__ . '/incl/foot.php'; ?>
