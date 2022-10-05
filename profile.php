<?php
require __DIR__ . '/db/UsersDB.php';
$usersDB = new UsersDB();
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
if (!isset($_COOKIE['email'])) {
   header('Location: login.php');
   exit();
}
$email = @$_COOKIE['email'];
$id = @$_SESSION['id'];
if (!empty($_POST)) {
   $email = $_POST['email'];
   $password = $_POST['password'];
   $confirmPassword = $_POST['confirmPassword'];
   $valid = TRUE;
   if (strlen($password) < 3) {
      echo ('Password must be at least 3 characters long');
      $valid = FALSE;
   }
   if ($password !== $confirmPassword) {
      echo (`Passwords don't match`);
      $valid = FALSE;
   }
   if ($valid) {
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $usersDB->updateById($id, 'password', $hashedPassword);

      header('Location: login.php');
      exit();
   }
}
?>
<?php include __DIR__ . '/incl/head.php'; ?>
<?php include __DIR__ . '/incl/navbar.php'; ?>
<main class="container">
   <h1>About me</h1>
   <form method="POST">
      <div class="form-group">
         <label for="name">Email</label>
         <input class="form-control" id="email" placeholder="Email" value="<?php echo $email; ?>" type="text">
         <label for="password">New password</label>
         <input class="form-control" name="password" placeholder="New password" type="password">
         <label for="confirmPassword">Confirm password</label>
         <input class="form-control" name="confirmPassword" placeholder="Confirm password" type="password">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button> or <a href="./">Go back to Homepage</a>
   </form>
   <div style="margin-bottom: 600px"></div>
</main>
<?php include __DIR__ . '/incl/foot.php'; ?>