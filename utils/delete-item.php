<?php require __DIR__ . '/requireAdmin.php' ?>
<?php
require dirname(__DIR__, 1). '/db/ProductsDB.php';

if (!empty($_GET)) {
    $id = $_GET['id'];
    $productsDB = new ProductsDB();
    $productsDB -> deleteById($id);
}

header('Location: ../index.php');
exit();

?>
