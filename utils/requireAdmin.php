<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
    exit();
}

if (!isset($_SESSION['privilege'])) {
    header('Location: ../index.php');
    exit();
}

if ($_SESSION['privilege'] < 3) {
    header('Location: ../index.php');
    exit();
}
?>