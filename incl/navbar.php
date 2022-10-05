<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">TeaShop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'index') || preg_match('/\/$/', $_SERVER['REQUEST_URI']) ? ' active' : '' ?>">
                    <a class="nav-link" href="index.php">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <?php if (isset($_COOKIE['email']) && isset($_SESSION['privilege'])): ?>
                <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'cart') ? ' active' : '' ?>">
                    <a class="nav-link" href="cart.php">Cart</a>
                </li>
                <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'orders') ? ' active' : '' ?>">
                    <a class="nav-link" href="orders.php">Orders</a>
                </li>
                <?php if ($_SESSION['privilege'] > 1) : ?>
                <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'users') ? ' active' : '' ?>">
                    <a class="nav-link" href="./utils/users.php">Users</a>
                </li>
                <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'users') ? ' active' : '' ?>">
                    <a class="nav-link" href="adminOrders.php">Orders</a>
                </li>
                <?php endif; ?>
                <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'profile') ? ' active' : '' ?>">
                    <a class="nav-link" href="profile.php"><i class="fas fa-user"></i> <?php echo $_COOKIE['email']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
                </li>
                <?php else: ?>
                <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'login') ? ' active' : '' ?>">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>