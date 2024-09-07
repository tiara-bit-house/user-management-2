<?php
require_once 'database.php';

if (isset($_POST)) {
    $email = $_POST['email'];
    $password_post = $_POST['password'];

    $stmt = $conn->prepare("SELECT user_id, name, point, email, password, is_admin FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);

    $stmt->execute();
    $stmt->bind_result($user_id, $name, $point, $email, $password, $is_admin);
    $stmt->fetch();
    if (password_verify($password_post, $password)) {
        session_start();
        $_SESSION['name'] = $name;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['email'] = $email;
        $_SESSION['is_admin'] = $is_admin;

        header('Location: ../dashboard.php');
    } else {
        header('Location: ../login.php?message="Gagal Login"');
    }
}
