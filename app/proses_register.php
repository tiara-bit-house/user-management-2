<?php

require_once 'database.php';
session_start();

if (isset($_POST) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    $_SESSION['csrf_token'] =  bin2hex(random_bytes(32));

    $name = $_POST['name'];
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'utf-8');
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'utf-8');

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: ../register.php?message="Email tidak valid"');
        exit();
    }

    $password = password_hash($password, PASSWORD_BCRYPT);

    if (!$_FILES['image']['size']) {
        header('Location: ../register.php?message="Gambar wajib diisi"');
        exit();
    }

    $fileName = "photo_profiles/" . $_FILES['image']['name'];
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);

    $typeGambar = ['jpg', 'jpeg', 'png'];

    if (!in_array($fileExt, $typeGambar)) {
        header('Location: ../register.php?message="File bukan berbentuk gambar"');
        exit();
    }

    move_uploaded_file($_FILES['image']['tmp_name'], $fileName);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, image_url)
    VALUES (?,?,?,?)");
    $stmt->bind_param('ssss', $name, $email, $password, $fileName);

    if (!$stmt->execute()) {
        header('Location: ../register.php?message="gagal register"');
    } else {
        header('Location: ../register.php?message="berhasil register"');
    }
} else {
    header('Location: ../register.php?message="CSRF token invalid"');
    exit();
}
