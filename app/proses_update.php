<?php

require_once 'database.php';

if (isset($_POST)) {
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $point = $_POST['point'];
    $email = $_POST['email'];
    $fileName = $_POST['oldImageUrl'];

    if ($_FILES['image']['size']) {
        $fileName = "photo_profiles/" . $_FILES['image']['name'];
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);

        $typeGambar = ['jpg', 'jpeg', 'png'];
        if (!in_array($fileExt, $typeGambar)) {
            header('Location: ../register.php?message="File bukan berbentuk gambar"');
            exit();
        }

        if (move_uploaded_file($_FILES['image']['tmp_name'], $fileName)) {
            unlink($_POST['oldImageUrl']);
        }
    }


    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, point = ?, image_url = ? WHERE user_id = ?");
    $stmt->bind_param('ssisi', $name, $email, $point, $fileName, $user_id);

    if ($stmt->execute()) {
        header("Location: ../update_user.php?user_id=$user_id&message='berhasil edit'&status=1");
    } else {
        header("Location: ../update_user.php?user_id=$user_id&message='Gagal edit'&status=0");
    }
}
