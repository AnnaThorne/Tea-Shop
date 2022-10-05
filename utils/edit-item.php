<?php require __DIR__ . '/requireAdmin.php' ?>
<?php include dirname(__DIR__, 1) . '/incl/head.php' ?>
<?php
require dirname(__DIR__, 1). '/db/ProductsDB.php';
$productsDB = new ProductsDB();
if (!empty($_GET)) {
    $id = $_GET['id'];
    $products = $productsDB -> fetchById($id)[0];

} else {
    header('Location: index.php');
    exit();
}

if (!empty($_POST)) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $img = $_POST['img'];
    $category_id = $_POST['category_id'];

    $productsDB -> updateEntireProductById($id, $name, $price, $description, $img, $category_id);

    echo 'product edited';

    $products = $productsDB -> fetchById($id)[0];

}
?>
<main class="container">
    <h1>Edit product</h1>
    <br><br>
    <form method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" placeholder="name" value="<?php echo $products['name']; ?>">
            <label for="name">Description</label>
            <input class="form-control" placeholder="description" name="description" type="text" value="<?php echo $products['description']; ?>">
            <label for="name">Price</label>
            <input class="form-control" placeholder="price" name="price" type="text" value="<?php echo $products['price']; ?>">
            <label for="name">Img</label>
            <input class="form-control" placeholder="img" name="img" type="text" value="<?php echo $products['img']; ?>">
            <label for="name">Category ID</label>
            <input class="form-control" placeholder="category_id" name="category_id" type="text">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <a href="../index.php">Back to main page</a>
</main>
<?php include dirname(__DIR__, 1) . '/incl/foot.php'; ?>