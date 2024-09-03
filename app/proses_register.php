<?php

require_once 'database.php';

if (isset($_POST)) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password)
    VALUES (?,?,?)");
    $stmt->bind_param('sss', $name, $email, $password);

    if (!$stmt->execute()) {
        header('Location: ../register.php?message="gagal register"');
    } else {
        header('Location: ../register.php?message="berhasil register"');
    }
}
