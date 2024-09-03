<?php

require_once 'database.php';

if (isset($_POST)) {
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $point = $_POST['point'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, point = ? WHERE user_id = ?");
    $stmt->bind_param('ssii', $name, $email, $point, $user_id);

    if ($stmt->execute()) {
        header("Location: ../update_user.php?user_id=$user_id&message='berhasil edit'&status=1");
    } else {
        header("Location: ../update_user.php?user_id=$user_id&message='Gagal edit'&status=0");
    }
}
