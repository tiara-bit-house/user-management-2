<?php

require_once 'database.php';

if (isset($_POST)) {
    $user_id = $_POST['user_id'];
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param('i', $user_id);

    if ($stmt->execute()) {
        header('Location: ../users.php?status=1&message="berhasil delete"');
    } else {
        header('Location: ../users.php?status=0&message="gagal delete"');
    }
}
