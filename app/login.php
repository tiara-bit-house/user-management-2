<?php
require_once 'database.php';

if (isset($_POST)) {
    $email = $_POST['email'];
    $password_post = $_POST['password'];

    $stmt = $conn->prepare("SELECT name, point, email, password FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);

    $stmt->execute();
    $stmt->bind_result($name, $point, $email, $password);
    $stmt->fetch();
    if (password_verify($password_post, $password)) {
        session_start();
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;

        header('Location: ../dashboard.php');
    } else {
        header('Location: ../login.php?message="Gagal Login"');
    }
}
