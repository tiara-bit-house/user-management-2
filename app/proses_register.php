<?php

require_once 'database.php';

if (isset($_POST)) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

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
}
