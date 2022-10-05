<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
require dirname(__DIR__, 1). '/db/OrdersDB.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [
        
    ];
}
$ordersDB = new OrdersDB();
$ordersDB -> create(['price' => $price, "user_id" => $id]);
$orders = $ordersDB -> fetchById($_GET['id'])[0];

if (!$products){
    exit("Unable to find products!");
}

$_SESSION['cart'][] = $products["product_id"];
header('Location: ../cart.php');
exit();
