<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
$id = @$_POST['id'];
foreach ($_SESSION['cart'] as $key => $value){
    if ($value == $id) {
        unset($_SESSION['cart'][$key]);
        break;
    }
}
header('Location: ../cart.php');
exit();
?>