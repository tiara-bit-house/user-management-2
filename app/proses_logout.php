<?php

if (isset($_GET)) {
    session_start();
    session_unset();
    session_destroy();

    header('Location: ../login.php?message="berhasil logout"');
}
