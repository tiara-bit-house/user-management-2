<?php

require_once 'database.php';

if (isset($_POST)) {
    $user_id = $_POST['user_id'];
    $stmt1 = $conn->prepare("SELECT image_url FROM users WHERE user_id = ?");
    $stmt1->bind_param('i', $user_id);
    $stmt1->execute();
    $stmt1->bind_result($image_url);
    $stmt1->fetch();

    unlink($image_url);

    $stmt1->close();

    $stmt2 = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt2->bind_param('i', $user_id);

    if ($stmt2->execute()) {
        header('Location: ../users.php?status=1&message="berhasil delete"');
    } else {
        header('Location: ../users.php?status=0&message="gagal delete"');
    }
}
