<?php
require __DIR__ . '/db/ProductsDB.php';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
if (!empty($_COOKIE) && !empty($_SESSION['privilege'])) {
    if (isset($_COOKIE['email'])) {
        $email = $_COOKIE['email'];
    } else {
        header('Location: login.php');
        exit();
    }
} else {
    header('Location: login.php');
    exit();
}

$nItemsPerPagination = 5;
$offset = 0;
if (!empty($_GET)) {
    $offset = $_GET['offset'];
}

$productsDB = new ProductsDB();

if (isset($_GET['category'])) {
    $category_id = $_GET['category'];

    $count = $productsDB->fetchIdCountByCategory($category_id);
    $products = $productsDB->fetchAllByCategoryPaginated($nItemsPerPagination, $offset, $category_id);
} else {
    $count = $productsDB->fetchIdCount();
    $products = $productsDB->fetchAllPaginated($nItemsPerPagination, $offset);
}
?>
<?php include __DIR__ . '/incl/head.php'; ?>
<?php include __DIR__ . '/incl/navbar.php'; ?>

<main class="container">
    <h1>Tea offerings</h1>
    Total product count: <?php echo $count ?>
    <br><br>
    <?php if ($_SESSION['privilege'] > 1) : ?>
        <a class="btn btn-primary" href="./utils/create-item.php">Add new product</a>
    <?php endif; ?>
    <a class="btn btn-primary" href="./index.php">All products</a>
    <br><br>

    <div class="pagination">
        <?php for ($i = 1; $i <= ceil($count / $nItemsPerPagination); $i++) { ?>
            <a class="<?php echo $offset / $nItemsPerPagination + 1 == $i ? "active" : ""; ?>" href="./index.php?offset=<?php echo ($i - 1) * $nItemsPerPagination; ?>">
                <?php echo $i; ?>
            </a>
        <?php } ?>
    </div>
    <?php if ($count) { ?>
        <div class="products">
            <?php foreach ($products as $row) : ?>
                <div class="card product" style="width: calc(100% / 3)">
                    <div class="card-img-top" style="background-image: url(<?php echo $row['img']; ?>)"></div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['name'] ?></h5>
                        <div class="card-subtitle"><?php echo $row['price'] ?></div>
                        <div class="card-text"><?php echo $row['description'] ?></div>
                        <div class="card-controls">
                            <a class="btn btn-secondary card-link" href='./utils/buy.php?id=<?php echo $row['product_id'] ?>'>Buy</a>
                            <?php if ($_SESSION['privilege'] > 1) : ?>
                                <a class="btn btn-secondary card-link" href='./utils/edit-item.php?id=<?php echo $row['product_id'] ?>'>Edit</a>
                                <a class="btn btn-secondary card-link" href='./utils/delete-item.php?id=<?php echo $row['product_id'] ?>'>Delete</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <br>
        <div class="pagination">
            <?php for ($i = 1; $i <= ceil($count / $nItemsPerPagination); $i++) { ?>
                <a class="<?php echo $offset / $nItemsPerPagination + 1 == $i ? "active" : ""; ?>" href="./index.php?offset=<?php echo ($i - 1) * $nItemsPerPagination; ?>">
                    <?php echo $i; ?>
                </a>
            <?php } ?>
        </div>
        <br>
    <?php } ?>
</main>

<?php include __DIR__ . '/incl/foot.php'; ?>