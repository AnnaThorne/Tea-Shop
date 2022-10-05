<?php require __DIR__ . '/requireAdmin.php' ?>
<?php include dirname(__DIR__, 1) . '/incl/head.php' ?>
<?php require dirname(__DIR__, 1). '/db/ProductsDB.php' ?>
<?php
$productsDB = new ProductsDB();

if (!empty($_POST)) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $img = $_POST['img'];
    $category_id = $_POST['category_id'];

    $productsDB -> create(['name' => $name, 'description' => $description,
                          'price' => $price, 'img' => $img, 'category_id' => $category_id ]);

    echo 'Product added';
}
?>
<main class="container">
    <h1>Create a new product</h1>
    <br><br>
    <form method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" placeholder="name">
            <label for="name">Description</label>
            <input class="form-control" placeholder="description" name="description" type="text">
            <label for="name">Price</label>
            <input class="form-control" placeholder="price" name="price" type="text">
            <label for="name">Img</label>
            <input class="form-control" placeholder="img" name="img" type="text">
            <label for="name">Category ID</label>
            <input class="form-control" placeholder="category_id" name="category_id" type="text">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <a href="../index.php">Back to main page</a>
</main>
<?php include dirname(__DIR__, 1) . '/incl/foot.php'; ?>