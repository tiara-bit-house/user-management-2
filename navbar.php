<?php session_start(); ?>
<nav class="navbar navbar-expand-lg bg-body-tertiary mx-auto w-50">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">User Management</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php if (!isset($_SESSION['email'])): ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                <?php endif ?>
                <?php if (isset($_SESSION['email'])): ?>
                    <li class="nav-item">
                        <a href="app/proses_logout.php" class="nav-link">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="users.php">Users</a>
                    </li>
                <?php endif ?>

            </ul>
        </div>
    </div>
</nav>