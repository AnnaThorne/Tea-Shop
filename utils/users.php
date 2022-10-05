<?php require dirname(__DIR__, 1) . '/db/UsersDB.php' ?>
<?php require __DIR__ . '/requireAdmin.php' ?>
<?php
$usersDB = new UsersDB();

if (!empty($_POST)) {
    if(!empty($_POST['user_id'])){
    $id = $_POST['user_id'];
    $privilege = $_POST['privilege'];
    $usersDB->updateById($id, 'privilege', $privilege);
    }
}
$users = $usersDB->fetchAll();
?>
<?php include dirname(__DIR__, 1) .  '/incl/head.php'; ?>
<main class="container">
    <h1>Users</h1>
    <?php foreach ($users as $user) : ?>
        <form method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input name="email" class="form-control" placeholder="Email" required value="<?php echo $user['email']; ?>" type="email">
                
                <label for="privilege">Privilege</label>
                <input name="privilege" type="number" class="form-control" placeholder="Privilege" required value="<?php echo $user['privilege']; ?>">

                <input type="hidden" name="id" value="<?php echo $user['user_id']; ?>">
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
            <a class="btn btn-primary" href="../adminOrders.php?user_id=<?php echo $user['user_id']; ?>">View orders</a>
        </form>
    <?php endforeach; ?>
    <div style="margin-bottom: 600px"></div>
</main>
<?php include dirname(__DIR__, 1) .  '/incl/foot.php'; ?>